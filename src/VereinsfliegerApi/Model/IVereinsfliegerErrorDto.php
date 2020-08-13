<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface IVereinsfliegerErrorDto extends IVereinsfliegerResponseDto {

	/**
	 * @return string
	 */
	public function getError(): string;

}