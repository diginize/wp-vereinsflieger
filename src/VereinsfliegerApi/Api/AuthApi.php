<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Api;


use Diginize\WpVereinsflieger\VereinsfliegerApi\Exceptions\HttpException;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Exceptions\ApiException;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\SignInCredentialsDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Responses\AccessTokenResponse;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Responses\LoginFailedResponse;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Responses\OkResponse;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Responses\UnauthorizedResponse;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class AuthApi extends AbstractApi {

	public function __construct(?ClientInterface $client = null) {
		parent::__construct($client);
	}

	/**
	 * @return AccessTokenResponse
	 * @throws HttpException
	 * @throws ApiException
	 */
	public function getAccesstoken() {
		try {
			$response = $this->client->get('/auth/accesstoken', $this->getHttpOptions([], false));

			switch ($response->getStatusCode()) {
				case 200:
					return $this->deserializeResponse($response, AccessTokenResponse::class);
					break;

				default:
					throw new ApiException($response);
					break;
			}
		} catch (GuzzleException $e) {
			throw new HttpException($e);
		}
	}

	/**
	 * @param SignInCredentialsDto $credentials
	 * @return OkResponse
	 * @throws HttpException
	 * @throws ApiException
	 */
	public function Signin(SignInCredentialsDto $credentials) {
		try {
			$response = $this->client->post('/auth/signin', $this->getHttpOptions([
				'form_params' => $this->serializeRequestParams($credentials)
			]));

			switch ($response->getStatusCode()) {
				case 200:
					return $this->deserializeResponse($response, OkResponse::class);
					break;

				case 403:
					throw new ApiException(
						$response,
						$this->deserializeResponse($response, LoginFailedResponse::class)
					);
					break;

				default:
					throw new ApiException($response);
					break;
			}
		} catch (GuzzleException $e) {
			throw new HttpException($e);
		}
	}

	/**
	 * @return OkResponse|UnauthorizedResponse
	 * @throws HttpException
	 * @throws ApiException
	 */
	public function Signout() {
		try {
			$response = $this->client->delete('/auth/signout', $this->getHttpOptions());

			switch ($response->getStatusCode()) {
				case 200:
					return $this->deserializeResponse($response, OkResponse::class);
					break;

				case 401:
					throw new ApiException(
						$response,
						$this->deserializeResponse($response, UnauthorizedResponse::class)
					);
					break;

				default:
					throw new ApiException($response);
					break;
			}
		} catch (GuzzleException $e) {
			throw new HttpException($e);
		}
	}

}