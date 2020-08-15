<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Exceptions;


use Psr\Http\Message\ResponseInterface;
use Throwable;

class HttpException extends \Exception implements Exception {

	/**
	 * HttpException constructor.
	 * @param $exception Throwable|ResponseInterface
	 */
	public function __construct($exception) {
		if (is_a($exception, ResponseInterface::class)) {
			parent::__construct($exception->getBody()->getContents(), $exception->getStatusCode());
		} else {
			parent::__construct($exception->getMessage(), $exception->getCode(), $exception);
		}
	}

}