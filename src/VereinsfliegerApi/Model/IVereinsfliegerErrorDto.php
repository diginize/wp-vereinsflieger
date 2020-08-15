<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface IVereinsfliegerErrorDto extends IVereinsfliegerResponseDto {

		public function getError(): string;

		public function setError(string $error): void;

}