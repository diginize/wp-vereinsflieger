<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Exceptions;


use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\VereinsfliegerErrorDto;
use Psr\Http\Message\ResponseInterface;

class ApiException extends \Exception implements Exception {

	/** @var ResponseInterface */
	private $response;

	/** @var VereinsfliegerErrorDto|null */
	private $serializedBody;

	public function __construct(ResponseInterface $response, ?VereinsfliegerErrorDto $serializedBody = null) {
		$this->response = $response;
		$this->serializedBody = $serializedBody;

		parent::__construct($response->getBody()->getContents(), $response->getStatusCode());
	}

	/**
	 * @return ResponseInterface
	 */
	public function getResponse(): ResponseInterface {
		return $this->response;
	}

	/**
	 * @return VereinsfliegerErrorDto|null
	 */
	public function getSerializedBody(): ?VereinsfliegerErrorDto {
		return $this->serializedBody;
	}

}