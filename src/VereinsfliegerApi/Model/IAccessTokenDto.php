<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Model;


interface IAccessTokenDto {

	public function getAccesstoken(): string;

	public function getURL(): string;

}