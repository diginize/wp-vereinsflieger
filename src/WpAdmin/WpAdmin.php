<?php


namespace Diginize\WpVereinsflieger\WpAdmin;


use Diginize\WpVereinsflieger\WpAdmin\Pages\WpVereinsflieger;

class WpAdmin {

	public function __construct() {
		$this->setupDependencies();
		$this->setupHooks();
	}

	private function setupDependencies(): void {
	}

	private function setupHooks(): void {
		add_action('admin_menu', [WpVereinsflieger::class, 'setup']);
	}

	private static $admin = null;
	public static function init(): self {
		if (!self::$admin) {
			self::$admin = new self();
		}

		return self::$admin;
	}

}