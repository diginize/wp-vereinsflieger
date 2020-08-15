<?php


namespace Diginize\WpVereinsflieger;


use Diginize\WpVereinsflieger\Error\ApiError;
use Diginize\WpVereinsflieger\Error\InvalidLoginCredentialsError;
use Diginize\WpVereinsflieger\Error\TwoFactorAuthenticationRequiredError;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Api\AuthApi;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Exceptions\ApiException;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Exceptions\Exception;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Exceptions\HttpException;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\AccessTokenDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\IUserDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\SignInCredentialsDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\VereinsfliegerResponseDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Responses\LoginFailedResponse;

class Api {

	/** @var AuthApi */
	protected $auth;

	/** @var string */
	protected $accessToken = null;

	/** @var string */
	protected $cid = null;

	/** @var string */
	protected $appKey = null;

	function __construct() {
		$this->auth = new AuthApi();
	}

	/**
	 * @throws ApiError
	 */
	function init(): void {
		// get access token
		try {
			/** @var VereinsfliegerResponseDto & AccessTokenDto $result */
			$result = $this->auth->getAccesstoken();
			$this->auth->accesstoken = $result->getAccesstoken();
		} catch (\Exception $e) {
			throw new ApiError($e->getMessage(), $e->getCode(), $e);
		}
	}

	/**
	 * @param string      $username Username
	 * @param string      $password Password
	 * @param string|null $otp      One Time Password (only if 2FA is needed)
	 * @throws ApiError
	 * @throws InvalidLoginCredentialsError
	 * @throws TwoFactorAuthenticationRequiredError
	 */
	function login(string $username, string $password, ?string $otp = null): void {
		$credentials = new SignInCredentialsDto();

		$credentials->setAppkey(Options::getAppKey());
		$credentials->setCid(Options::getCID());
		$credentials->setUsername($username);
		$credentials->setPassword($password);
		if ($otp) {
			$credentials->setAuthSecret($otp);
		}

		try {
			$this->auth->Signin($credentials);
		} catch (HttpException $e) {
			throw new ApiError($e->getMessage(), $e->getCode(), $e);
		} catch (ApiException $e) {
			if ($e->getSerializedBody() && is_a($e->getSerializedBody(), LoginFailedResponse::class)) {
				/** @var LoginFailedResponse $response */
				$response = $e->getSerializedBody();

				if ($response->getNeed2fa() == 1) {
					throw new TwoFactorAuthenticationRequiredError($response);
				} else {
					throw new InvalidLoginCredentialsError($response);
				}
			}
		}
	}

	/**
	 * @return true
	 * @throws ApiError
	 */
	function logout(): bool {
		try {
			$this->auth->Signout();
		} catch (HttpException $e) {
			throw new ApiError($e->getMessage(), $e->getCode(), $e);
		} catch (ApiException $e) {
			if ($e->getResponse()->getStatusCode() !== 401) {
				throw new ApiError($e->getResponse());
			}
		} finally {
			return true;
		}
	}

	/**
	 * @return IUserDto
	 * @throws ApiError
	 */
	function getUser(): IUserDto {
		try {
			return $this->auth->GetUser();
		} catch (Exception $e) {
			throw new ApiError($e->getMessage(), $e->getCode(), $e);
		}
	}

}