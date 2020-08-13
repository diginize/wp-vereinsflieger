<?php


namespace Diginize\WpVereinsflieger\WpAdmin;


use Diginize\VereinsfliegerApi\Api\AuthApi;
use Diginize\VereinsfliegerApi\ApiException;
use Diginize\VereinsfliegerApi\Model\AccessTokenDto;
use Diginize\VereinsfliegerApi\Model\VereinsfliegerResponseDto;
use Diginize\WpVereinsflieger\Error\ApiError;
use Diginize\WpVereinsflieger\Options;

class Api {

	/** @var Options */
	protected $options;

	/** @var AuthApi */
	protected $auth;

	/** @var string */
	protected $accessToken = null;

	/** @var string */
	protected $cid = null;

	/** @var string */
	protected $appKey = null;

	function __construct(Options $options) {
		$this->options = $options;
		$this->auth = new AuthApi();
	}

	/**
	 * @throws ApiError
	 * @return void
	 */
	function init(): void {
		// get access token
		try {
			/** @var VereinsfliegerResponseDto & AccessTokenDto $result */
			$result = $this->auth->getAccesstoken();

			if ($result->getHttpstatuscode() == 200) {
				$this->accessToken = $result->getAccesstoken();
			} else {
				throw new ApiError($result);
			}
		} catch (\Exception $e) {
			throw new ApiError($e->getMessage(), $e->getCode(), $e);
		}
	}

	function login($username, $password): void {
		$this->auth->signin();
	}

}