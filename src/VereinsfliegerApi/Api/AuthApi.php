<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Api;


use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\SignInCredentialsDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Responses\AccessTokenResponse;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Responses\LoginFailedResponse;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Responses\OkResponse;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Responses\UnauthorizedResponse;
use GuzzleHttp\ClientInterface;

class AuthApi extends AbstractApi {

	/** @var string */
	public $accesstoken = null;

	public function __construct(?ClientInterface $client = null) {
		parent::__construct($client);
	}

	/**
	 * @return AccessTokenResponse
	 */
	public function getAccesstoken() {
		try {
			$response = $this->client->request('GET', $this->baseUrl . '/auth/accesstoken');

			switch ($response->getStatusCode()) {
				case 200:
					return $this->deserializeResponse($response->getBody(), AccessTokenResponse::class);
					break;

				default:
					throw new \Exception($response->getStatusCode(), $response->getStatusCode());
					break;
			}
		} catch (\Exception $e) {
			// TODO: implement catch
		}
	}

	/**
	 * @param SignInCredentialsDto $credentials
	 * @return OkResponse|LoginFailedResponse
	 */
	public function Signin(SignInCredentialsDto $credentials) {
		try {
			$response = $this->client->request('POST', $this->baseUrl . '/auth/signin', [
				'form_params' => $this->serializeRequestParams($credentials),
				'query' => ['accesstoken' => $this->accesstoken]
			]);

			switch ($response->getStatusCode()) {
				case 200:
					return $this->deserializeResponse($response->getBody(), OkResponse::class);
					break;

				case 403:
					return $this->deserializeResponse($response->getBody(), LoginFailedResponse::class);
					break;

				default:
					throw new \Exception($response->getStatusCode(), $response->getStatusCode());
					break;
			}
		} catch (\Exception $e) {
			// TODO: implement catch
		}
	}

	/**
	 * @return OkResponse|UnauthorizedResponse
	 */
	public function Signout() {
		try {
			$response = $this->client->request('DELETE', $this->baseUrl . '/auth/signout', [
				'query' => ['accesstoken' => $this->accesstoken]
			]);

			switch ($response->getStatusCode()) {
				case 200:
					return $this->deserializeResponse($response->getBody(), OkResponse::class);
					break;

				case 401:
					return $this->deserializeResponse($response->getBody(), UnauthorizedResponse::class);
					break;

				default:
					throw new \Exception($response->getStatusCode(), $response->getStatusCode());
					break;
			}
		} catch (\Exception $e) {
			// TODO: implement catch
		}
	}

}