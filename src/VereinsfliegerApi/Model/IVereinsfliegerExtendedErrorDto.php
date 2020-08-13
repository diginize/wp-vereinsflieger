<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface IVereinsfliegerExtendedErrorDto extends IVereinsfliegerErrorDto {

	/**
	 * @return string
	 */
	public function getUrl(): string;

	/**
	 * @return string
	 */
	public function getPHPSESSID(): string;

	/**
	 * @return string
	 */
	public function getUrlpath(): string;

	/**
	 * @return string
	 */
	public function getUrlfile(): string;

	/**
	 * @return string
	 */
	public function getPassphrase(): string;

	/**
	 * @return string
	 */
	public function getAccesstoken(): string;

}