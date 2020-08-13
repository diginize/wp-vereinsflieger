<?php


namespace Diginize\WpVereinsflieger\Error;


use Diginize\VereinsfliegerApi\Model\VereinsfliegerErrorDto;
use Diginize\VereinsfliegerApi\Model\VereinsfliegerExtendedErrorDto;
use Throwable;

class ApiError extends \Exception {

	/**
	 * ApiError constructor.
	 * @param                $response VereinsfliegerErrorDto|VereinsfliegerExtendedErrorDto|string Error response or message of error
	 * @param int            $code
	 * @param Throwable|null $previous
	 */
	public function __construct($response, int $code = 0, ?Throwable $previous = null) {
		if (is_string($response)) {
			parent::__construct('Api Error:' . $response, $code, $previous);
		} else {
			parent::__construct('Api Error:' . $response->getError(), $response->getHttpstatuscode(), $response);
		}
	}

}