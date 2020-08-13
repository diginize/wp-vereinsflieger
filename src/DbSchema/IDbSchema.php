<?php

namespace Diginize\WpVereinsflieger\DbSchema;

interface IDbSchema {

	public static function install(): void;

	public static function uninstall(): void;

}