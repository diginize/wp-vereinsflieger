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
	 * @param string $url
	 */
	public function setUrl(string $url): void {
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	public function getPHPSESSID(): string {
		return $this->PHPSESSID;
	}

	/**
	 * @param string $PHPSESSID
	 */
	public function setPHPSESSID(string $PHPSESSID): void {
		$this->PHPSESSID = $PHPSESSID;
	}

	/**
	 * @return string
	 */
	public function getUrlpath(): string {
		return $this->urlpath;
	}

	/**
	 * @param string $urlpath
	 */
	public function setUrlpath(string $urlpath): void {
		$this->urlpath = $urlpath;
	}

	/**
	 * @return string
	 */
	public function getUrlfile(): string {
		return $this->urlfile;
	}

	/**
	 * @param string $urlfile
	 */
	public function setUrlfile(string $urlfile): void {
		$this->urlfile = $urlfile;
	}

	/**
	 * @return string
	 */
	public function getPassphrase(): string {
		return $this->passphrase;
	}

	/**
	 * @param string $passphrase
	 */
	public function setPassphrase(string $passphrase): void {
		$this->passphrase = $passphrase;
	}

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

}