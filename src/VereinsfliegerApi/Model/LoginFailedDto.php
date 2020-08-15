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

	/**
	 * @param int $need_2fa
	 */
	public function setNeed2fa(int $need_2fa): void {
		$this->need_2fa = $need_2fa;
	}

}