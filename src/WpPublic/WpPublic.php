<?php


namespace Diginize\WpVereinsflieger\WpPublic;


class WpPublic {

	public function __construct() {
		$this->setupDependencies();
		$this->setupHooks();
	}

	private function setupDependencies(): void {
	}

	private function setupHooks(): void {
	}

	private static $public = null;
	public static function init(): self {
		if (!self::$public) {
			self::$public = new self();
		}

		return self::$public;
	}

}