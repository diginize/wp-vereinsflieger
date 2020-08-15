<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Responses;


use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\IUserDto;
use Diginize\WpVereinsflieger\VereinsfliegerApi\Model\VereinsfliegerResponseDto;

class UserResponse extends VereinsfliegerResponseDto implements IUserDto {

	/** @var int */
	private $uid;

	/** @var string */
	private $memberid;

	/** @var string */
	private $firstname;

	/** @var string */
	private $lastname;

	/** @var string */
	private $email;

	/** @var string */
	private $status;

	/** @var string[] */
	private $roles;

	/**
	 * @return int
	 */
	public function getUid(): int {
		return $this->uid;
	}

	/**
	 * @param int $uid
	 */
	public function setUid(int $uid): void {
		$this->uid = $uid;
	}

	/**
	 * @return string
	 */
	public function getMemberid(): string {
		return $this->memberid;
	}

	/**
	 * @param string $memberid
	 */
	public function setMemberid(string $memberid): void {
		$this->memberid = $memberid;
	}

	/**
	 * @return string
	 */
	public function getFirstname(): string {
		return $this->firstname;
	}

	/**
	 * @param string $firstname
	 */
	public function setFirstname(string $firstname): void {
		$this->firstname = $firstname;
	}

	/**
	 * @return string
	 */
	public function getLastname(): string {
		return $this->lastname;
	}

	/**
	 * @param string $lastname
	 */
	public function setLastname(string $lastname): void {
		$this->lastname = $lastname;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string {
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void {
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getStatus(): string {
		return $this->status;
	}

	/**
	 * @param string $status
	 */
	public function setStatus(string $status): void {
		$this->status = $status;
	}

	/**
	 * @return string[]
	 */
	public function getRoles(): array {
		return $this->roles;
	}

	/**
	 * @param string[] $roles
	 */
	public function setRoles(array $roles): void {
		$this->roles = $roles;
	}

}