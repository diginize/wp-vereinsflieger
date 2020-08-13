<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


class LoginFailedDto implements ILoginFailedDto {

	/** @var int */
	private $need_2fa;

	/**
	 * @return int
	 */
	public function getNeed2fa(): int {
		return $this->need_2fa;
	}

}