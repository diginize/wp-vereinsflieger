<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface ILoginFailedDto {

	/**
	 * @return int
	 */
	public function getNeed2fa(): int;

}