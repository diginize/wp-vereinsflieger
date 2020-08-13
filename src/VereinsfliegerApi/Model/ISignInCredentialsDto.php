<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface ISignInCredentialsDto {

	/**
	 * @return string
	 */
	public function getAppkey(): string;

	/**
	 * @param string $appkey
	 */
	public function setAppkey(string $appkey): void;

	/**
	 * @return string
	 */
	public function getUsername(): string;

	/**
	 * @param string $username
	 */
	public function setUsername(string $username): void;

	/**
	 * @return string
	 */
	public function getPassword(): string;

	/**
	 * @param string $password
	 */
	public function setPassword(string $password): void;

	/**
	 * @return int
	 */
	public function getCid(): int;

	/**
	 * @param int $cid
	 */
	public function setCid(int $cid): void;

	/**
	 * @return string
	 */
	public function getAuthSecret(): string;

	/**
	 * @param string $auth_secret
	 */
	public function setAuthSecret(string $auth_secret): void;

}