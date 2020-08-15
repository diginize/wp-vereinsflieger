<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface IAccessTokenDto {

		public function getAccesstoken(): string;

		public function setAccesstoken(string $accesstoken): void;

		public function getURL(): string;

		public function setURL(string $URL): void;

}