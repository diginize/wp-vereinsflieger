<?php


namespace Diginize\WpVereinsflieger\WpPublic;


use Diginize\WpVereinsflieger\Api;
use Diginize\WpVereinsflieger\Db\Users;
use Diginize\WpVereinsflieger\Error\ApiError;
use Diginize\WpVereinsflieger\Error\InvalidLoginCredentialsError;
use Diginize\WpVereinsflieger\Error\TwoFactorAuthenticationRequiredError;
use Diginize\WpVereinsflieger\Options;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\IUserDto;

class Authentication {

	/** @var Api */
	protected $api = null;

	private $username = '';
	private $hashedPassword = '';

	protected function getApi(): Api {
		if ($this->api) {
			return $this->api;
		}

		$this->api = new Api();
		$this->api->init();
		return $this->api;
	}

	/**
	 * @param \WP_User|\WP_Error|null $user
	 * @param string $username
	 * @param string $password
	 * @return \WP_User|null The authenticated user or null if the authentication failed
	 */
	public function authenticationRequest($user, string $username, string $password) {
		// If is authenticated, allow the user to login
		if ($user instanceof \WP_User) {

			// check if user is linked to an Vereinsflieger account
			if (!Options::getAllowDefaultLogin() && Users::isVereinsfliegerUser($user)) {
				return null;
			}

			return $user;
		}

		// stop when no credentials were provided
		if (!$username || !$password) {
			return $user;
		}

		$this->username = $username;
		$this->hashedPassword = md5($password);

		if (array_key_exists('wpvf_hashed_password', $_REQUEST)) {
			$this->hashedPassword = $_REQUEST['wpvf_hashed_password'];
		}

		return $this->authenticateVereinsfliegerUser($user);
	}

	/**
	 * @param \WP_User|\WP_Error|null $user
	 * @return \WP_User|\WP_Error|null The authenticated user or null if the authentication failed
	 */
	protected function authenticateVereinsfliegerUser($user) {
		// Try to login with vereinsflieger
		$otp = null;
		try {
			if (array_key_exists('wpvf_otp', $_POST) && preg_match('/^[0-9]{6}$/', str_replace(' ', '', $_POST['wpvf_otp']))) {
				$otp = str_replace(' ', '', $_POST['wpvf_otp']);
			}

			$loginSuccessful = $this->tryLogin($this->username, $this->hashedPassword, $otp, $user);

			if (!$loginSuccessful) {
				return $user;
			}
		} catch (TwoFactorAuthenticationRequiredError $e) {
			if ($otp !== null) {
				return null;
			}

			if (!strpos($_SERVER['SCRIPT_NAME'], 'wp-login.php')) {
				wp_safe_redirect(wp_login_url($_SERVER['REQUEST_URI']));
			}

			return $this->twoFactorAuthenticationError();
		}

		try {
			// get user details
			$userDetails = $this->tryGetUser();

			// try to find user in users table
			$wpUser = Users::getUserByVereinsfliegerId($userDetails->getUid());

			// try to find existing user with same email
			if (!$wpUser) {
				$wpUser = Users::getUserByEmail($userDetails->getEmail());
			}

			// add new user
			if (!$wpUser) {
				$userId = Users::addVereinsfliegerUser($userDetails);
				if (!$userId) {
					return null;
				}

				$wpUser = Users::getUserByVereinsfliegerId($userDetails->getUid());
			}

			// update user meta data
			Users::updateMetaData($wpUser->ID, $wpUser, $userDetails);

			// return user to login
			return new \Wp_User($wpUser->ID);
		} catch (ApiError $e) {
			$this->tryLogout();
			return null;
		}
	}

	protected function twoFactorAuthenticationError(): \WP_Error {
		add_action('login_form', [$this, 'printTwoFactorForm'], 10, 0);

		$error = new \WP_Error();
		$error->add('2fa_needed', '<strong>' . __('Two factor authentication', WPVF_DOMAIN) . '</strong><br>' . __('Please enter the current one time password.', WPVF_DOMAIN));

		return $error;
	}

	/**
	 * @param string                  $username
	 * @param string                  $password
	 * @param string|null             $otp
	 * @param \WP_User|\WP_Error|null $user
	 * @return bool
	 * @throws TwoFactorAuthenticationRequiredError
	 */
	protected function tryLogin(string $username, string $password, ?string $otp = null, $user = null): bool {
		try {
			$this->getApi()->login($username, $password, $otp);
			return true;
		} catch (InvalidLoginCredentialsError $e) {
			return false;
		} catch (TwoFactorAuthenticationRequiredError $e) {
			throw $e;
		} catch (ApiError $e) {
			if (($e->getCode() >= 500 || $e->getCode() < 600) && $user instanceof \WP_Error) {
                $user->add(
						'vf_offline',
						sprintf(
								'<strong>' . __('Vereinsflieger is offline', WPVF_DOMAIN) . '</strong><br>'
								. __('We\'re unable to verify your login credentials with Vereinsflieger. The API returned with error <i>%d %s</i>.', WPVF_DOMAIN)
								. '<br>'
								. __('If this problem continues to exist, please contact the administrator.', WPVF_DOMAIN),
								$e->getCode(),
								$e->getMessage()
						)
                );
			}

			return false;
		}
	}

	protected function tryLogout(): void {
		$this->getApi()->logout();
	}

	/**
	 * @return IUserDto
	 * @throws ApiError
	 */
	protected function tryGetUser(): IUserDto {
		return $this->getApi()->getUser();
	}

	public function printTwoFactorForm(): void {
		add_filter('enable_login_autofocus', function () { return false; });
		?>
		<p id="wpvf_otp_form">
			<label for="wpvf_otp"><?=__('One time password', WPVF_DOMAIN)?></label>
			<input type="number" name="wpvf_otp" id="wpvf_otp" class="input" size="6" autocapitalize="off" />
		</p>

		<script>
			// remove username and password input and replace them with hidden inputs
			window.setTimeout(function() {
				const wpUser = document.getElementById('user_login');
				const wpPassword = document.getElementById('user_pass');
				const wpRememberme = document.getElementById('rememberme');

				// Fallback if this stops working due to wordpress updates.
				// In that case the user needs to enter the credentials again.
				if (!wpUser || !wpPassword) {
					return;
				}

				wpUser.parentElement.remove();
				wpPassword.parentElement.parentElement.remove()

				if (wpRememberme) {
					wpRememberme.parentElement.remove();
				}

				const username = document.createElement('input');
				username.setAttribute('type', 'hidden');
				username.setAttribute('name', 'log');
				username.setAttribute('value', '<?=esc_attr($this->username)?>');

				const password = document.createElement('input');
				password.setAttribute('type', 'hidden');
				password.setAttribute('name', 'pwd');
				password.setAttribute('value', 'user_pass');

				const password2 = document.createElement('input');
				password2.setAttribute('type', 'hidden');
				password2.setAttribute('name', 'wpvf_hashed_password');
				password2.setAttribute('value', '<?=esc_attr($this->hashedPassword)?>');

				<?php
				if (array_key_exists('rememberme', $_POST)) {
					?>
					const rememberme = document.createElement('input');
					rememberme.setAttribute('type', 'hidden');
					rememberme.setAttribute('name', 'rememberme');
					rememberme.setAttribute('value', '<?=esc_attr($_POST['rememberme'])?>');
					<?php
				}
				?>

				document.getElementById('wpvf_otp_form').append(username, password, password2);
				document.getElementById('wpvf_otp').focus();
			}, 200);
		</script>
		<style>
			#wpvf_otp::-webkit-outer-spin-button {
				-webkit-appearance: none;
				margin: 0;
			}
			#wpvf_otp {
				-moz-appearance: textfield;
			}
		</style>
		<?php
	}

}