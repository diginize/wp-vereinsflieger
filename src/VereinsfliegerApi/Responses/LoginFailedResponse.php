<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Responses;


use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\ILoginFailedDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\VereinsfliegerResponseDto;

class LoginFailedResponse extends VereinsfliegerResponseDto implements ILoginFailedDto {

	/** @var int */
	private $need_2fa;

	/**
	 * @return int
	 */
	public function getNeed2fa(): int {
		return $this->need_2fa;
	}

}