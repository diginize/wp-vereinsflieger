<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface ISignInCredentialsDto {

	public function getAppkey(): string;

	public function setAppkey(string $appkey): void;

	public function getUsername(): string;

	public function setUsername(string $username): void;

	public function getPassword(): string;

	public function setPassword(string $password): void;

	public function getCid(): int;

	public function setCid(int $cid): void;

	public function getAuthSecret(): ?string;

	public function setAuthSecret(?string $auth_secret): void;

}