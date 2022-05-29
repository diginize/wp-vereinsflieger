<?php


namespace Diginize\WpVereinsflieger\Error;


use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\VereinsfliegerErrorDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\VereinsfliegerExtendedErrorDto;
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
			parent::__construct($response, $code, $previous);
		} else {
			parent::__construct('Api Error:' . $response->getError() . "\r\n" . json_encode($response), $response->getHttpstatuscode());
		}
	}

}