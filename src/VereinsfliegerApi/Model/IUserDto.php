<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface IUserDto {

		public function getUid(): int;

		public function setUid(int $uid): void;

		public function getMemberid(): string;

		public function setMemberid(string $memberid): void;

		public function getFirstname(): string;

		public function setFirstname(string $firstname): void;

		public function getLastname(): string;

		public function setLastname(string $lastname): void;

		public function getEmail(): string;

		public function setEmail(string $email): void;

		public function getStatus(): string;

		public function setStatus(string $status): void;

		public function getRoles(): array;

		public function setRoles(array $roles): void;

}