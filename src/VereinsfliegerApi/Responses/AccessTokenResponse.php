<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Responses;


use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\IAccessTokenDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\VereinsfliegerResponseDto;

class AccessTokenResponse extends VereinsfliegerResponseDto implements IAccessTokenDto {

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
	 * @param string $accesstoken
	 */
	public function setAccesstoken(string $accesstoken): void {
		$this->accesstoken = $accesstoken;
	}

	/**
	 * @return string
	 */
	public function getURL(): string {
		return $this->URL;
	}

	/**
	 * @param string $URL
	 */
	public function setURL(string $URL): void {
		$this->URL = $URL;
	}

}