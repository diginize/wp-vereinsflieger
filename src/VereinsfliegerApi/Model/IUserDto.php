<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface IUserDto {

	/**
	 * @return int
	 */
	public function getUid(): int;

	/**
	 * @return string
	 */
	public function getMemberid(): string;

	/**
	 * @return string
	 */
	public function getFirstname(): string;

	/**
	 * @return string
	 */
	public function getLastname(): string;

	/**
	 * @return string
	 */
	public function getEmail(): string;

	/**
	 * @return string
	 */
	public function getStatus(): string;

	/**
	 * @return string[]
	 */
	public function getRoles(): array;

}