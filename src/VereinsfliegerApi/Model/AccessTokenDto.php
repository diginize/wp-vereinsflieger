<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


class AccessTokenDto implements IAccessTokenDto {

	/** @var string */
	private $accesstoken;

	/** @var string */
	private $URL;

	/**
	 * @return string
	 */
	public function getAccesstoken(): string {
		return $this->accesstoken;
	}

	/**
	 * @return string
	 */
	public function getURL(): string {
		return $this->URL;
	}

}