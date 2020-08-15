<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface IVereinsfliegerResponseDto {

		public function getHttpstatuscode(): int;

		public function setHttpstatuscode(int $httpstatuscode): void;

}