<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


class SignInCredentialsDto implements ISignInCredentialsDto {

	/** @var string */
	private $appkey;

	/** @var string */
	private $username;

	/** @var string */
	private $password;

	/** @var int */
	private $cid;

	/** @var string|null */
	private $auth_secret;

	/**
	 * @return string
	 */
	public function getAppkey(): string {
		return $this->appkey;
	}

	/**
	 * @param string $appkey
	 */
	public function setAppkey(string $appkey): void {
		$this->appkey = $appkey;
	}

	/**
	 * @return string
	 */
	public function getUsername(): string {
		return $this->username;
	}

	/**
	 * @param string $username
	 */
	public function setUsername(string $username): void {
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string {
		return $this->password;
	}

	/**
	 * @param string $password
	 */
	public function setPassword(string $password): void {
		$this->password = $password;
	}

	/**
	 * @return int
	 */
	public function getCid(): int {
		return $this->cid;
	}

	/**
	 * @param int $cid
	 */
	public function setCid(int $cid): void {
		$this->cid = $cid;
	}

	/**
	 * @return string|null
	 */
	public function getAuthSecret(): ?string {
		return $this->auth_secret;
	}

	/**
	 * @param string|null $auth_secret
	 */
	public function setAuthSecret(?string $auth_secret): void {
		$this->auth_secret = $auth_secret;
	}

}