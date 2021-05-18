<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Responses;


use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\ILoginFailedDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\VereinsfliegerErrorDto;

class LoginFailedResponse extends VereinsfliegerErrorDto implements ILoginFailedDto {

	/** @var int|null */
	private $need_2fa;

	/**
	 * @return int|null
	 */
	public function getNeed2fa(): ?int {
		return $this->need_2fa;
	}

	/**
	 * @param int|null $need_2fa
	 */
	public function setNeed2fa(?int $need_2fa): void {
		$this->need_2fa = $need_2fa;
	}

}