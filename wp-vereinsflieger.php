<?php

/**
 * Plugin Name: WP Vereinsflieger
 * Plugin URI: https://github.com/silviokennecke/wp-vereinsflieger
 * Description: Allows users to login into wordpress using their Vereinsflieger login.
 * Version: 0.0.1
 * Author: Silvio Kennecke
 * License: GPLv3
 * License URI: https://github.com/silviokennecke/wp-vereinsflieger/blob/master/LICENSE
 */


require_once(__DIR__ . '/vendor/autoload.php');

if (class_exists('WpVereinsflieger')) {
	return;
}

use Diginize\WpVereinsflieger\DbSchema\DbSchema;
use Diginize\WpVereinsflieger\Options;
use Diginize\WpVereinsflieger\WpAdmin\WpAdmin;
use Diginize\WpVereinsflieger\WpPublic\WpPublic;

class WpVereinsflieger {

	/**
	 * @var WpPublic
	 */
	private $public;
	/**
	 * @var WpAdmin|null
	 */
	private $admin;

	public function __construct(WpPublic $public, ?WpAdmin $admin) {
		$this->public = $public;
		$this->admin = $admin;
	}

	/**
	 * @var WpVereinsflieger|null
	 */
	private static $wpVereinsflieger = null;
	public static function init(): self {
		if (self::$wpVereinsflieger === null) {
			return self::$wpVereinsflieger;
		}

		DbSchema::init();

		$public = WpPublic::init();

		$admin = null;
		if (is_admin()) {
			$admin = WpAdmin::init();
		}

		self::$wpVereinsflieger = new self($public, $admin);
		return self::$wpVereinsflieger;
	}

	public static function activate(): void {}

	public static function deactivate(): void {}

	public static function uninstall(): void {
		Options::uninstall();
		DbSchema::uninstall();
	}

}

WpVereinsflieger::init();

register_activation_hook( __FILE__, '\WpVereinsflieger::activate' );
register_deactivation_hook( __FILE__, '\WpVereinsflieger::deactivate' );
register_uninstall_hook(__FILE__, '\WpVereinsflieger::uninstall');