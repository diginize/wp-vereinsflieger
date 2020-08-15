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
	 * @return string
	 */
	public function getMemberid(): string {
		return $this->memberid;
	}

	/**
	 * @return string
	 */
	public function getFirstname(): string {
		return $this->firstname;
	}

	/**
	 * @return string
	 */
	public function getLastname(): string {
		return $this->lastname;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string {
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function getStatus(): string {
		return $this->status;
	}

	/**
	 * @return string[]
	 */
	public function getRoles(): array {
		return $this->roles;
	}

}