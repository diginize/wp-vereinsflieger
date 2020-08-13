<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


class VereinsfliegerExtendedErrorDto extends VereinsfliegerErrorDto implements IVereinsfliegerExtendedErrorDto {

	/** @var string */
	private $url;

	/** @var string */
	private $PHPSESSID;

	/** @var string */
	private $urlpath;

	/** @var string */
	private $urlfile;

	/** @var string */
	private $passphrase;

	/** @var string */
	private $accesstoken;

	/**
	 * @return string
	 */
	public function getUrl(): string {
		return $this->url;
	}

	/**
	 * @return string
	 */
	public function getPHPSESSID(): string {
		return $this->PHPSESSID;
	}

	/**
	 * @return string
	 */
	public function getUrlpath(): string {
		return $this->urlpath;
	}

	/**
	 * @return string
	 */
	public function getUrlfile(): string {
		return $this->urlfile;
	}

	/**
	 * @return string
	 */
	public function getPassphrase(): string {
		return $this->passphrase;
	}

	/**
	 * @return string
	 */
	public function getAccesstoken(): string {
		return $this->accesstoken;
	}

}