<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


class VereinsfliegerResponseDto implements IVereinsfliegerResponseDto {

	/** @var int */
	private $httpstatuscode;

	/**
	 * @return int
	 */
	public function getHttpstatuscode(): int {
		return $this->httpstatuscode;
	}

	/**
	 * @param int $httpstatuscode
	 */
	public function setHttpstatuscode(int $httpstatuscode): void {
		$this->httpstatuscode = $httpstatuscode;
	}

}