<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface ILoginFailedDto {

		public function getNeed2fa(): ?int;

		public function setNeed2fa(?int $need_2fa): void;

}