<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface IVereinsfliegerExtendedErrorDto extends IVereinsfliegerErrorDto {

		public function getUrl(): string;

		public function setUrl(string $url): void;

		public function getPHPSESSID(): string;

		public function setPHPSESSID(string $PHPSESSID): void;

		public function getUrlpath(): string;

		public function setUrlpath(string $urlpath): void;

		public function getUrlfile(): string;

		public function setUrlfile(string $urlfile): void;

		public function getPassphrase(): string;

		public function setPassphrase(string $passphrase): void;

		public function getAccesstoken(): string;

		public function setAccesstoken(string $accesstoken): void;

}