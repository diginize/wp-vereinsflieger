<?php


namespace Diginize\WpVereinsflieger\WpPublic;


use Diginize\WpVereinsflieger\Api;
use Diginize\WpVereinsflieger\Db\Users;
use Diginize\WpVereinsflieger\Error\ApiError;
use Diginize\WpVereinsflieger\Error\InvalidLoginCredentialsError;
use Diginize\WpVereinsflieger\Error\TwoFactorAuthenticationRequiredError;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\IUserDto;

class Authentication {

	/** @var Api */
	protected $api = null;

	protected function getApi(): Api {
		if ($this->api) {
			return $this->api;
		}

		$this->api = new Api();
		$this->api->init();
	}

	/**
	 * @param \WP_User|\WP_Error|null $user
	 * @param string $username
	 * @param string $password
	 * @return \WP_User|false The authenticated user or false if the authentication failed
	 */
	public function authenticationRequest($user, string $username, string $password) {
		// If is authenticated, allow the user to login
		if ($user instanceof \WP_User) {
			return $user;
		}

		// Try to login with vereinsflieger
		try {
			$hashedPassword = md5($password);
			$loginSuccessful = $this->tryLogin($username, $hashedPassword);

			if (!$loginSuccessful) {
				return null;
			}
		} catch (TwoFactorAuthenticationRequiredError $e) {
			// TODO: handle 2FA
			return null;
		}

		try {
			// get user details
			$userDetails = $this->tryGetUser();

			// try to find user in users table
			$wpUser = Users::getUserByVereinsfliegerId($userDetails->getUid());

			// try to find existing user with same email
			if (!$wpUser) {
				$wpUser = Users::getUserByEmail($userDetails->getUid());
			}

			// add new user
			if (!$wpUser) {
				$userId = Users::addVereinsfliegerUser($userDetails);
				if (!$userId) {
					// TODO: handle error
					return null;
				}

				$wpUser = Users::getUserByVereinsfliegerId($userDetails->getUid());
			}

			// update user meta data
			Users::updateMetaData($wpUser->ID, $userDetails);

			// return user to login
			return new \Wp_User($wpUser->ID);
		} catch (ApiError $e) {
			$this->tryLogout();
			return null;
		}
	}

	/**
	 * @param \Wp_Error $errors
	 * @param \Wp_User|false $user_data
	 */
	public function lostPasswordRequest(\Wp_Error $errors, $user_data): void {
		// TODO: check if user is allowed to reset password via wordpress
	}

	/**
	 * @param string      $username
	 * @param string      $password
	 * @param string|null $otp
	 * @return bool
	 * @throws TwoFactorAuthenticationRequiredError
	 */
	protected function tryLogin(string $username, string $password, ?string $otp = null): bool {
		try {
			$this->getApi()->login($username, $password, $otp);
			return true;
		} catch (InvalidLoginCredentialsError $e) {
			return false;
		} catch (TwoFactorAuthenticationRequiredError $e) {
			throw $e;
		} catch (ApiError $e) {
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

}