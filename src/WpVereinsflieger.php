<?php

namespace Diginize\WpVereinsflieger;

use Diginize\WpVereinsflieger\DbSchema\DbSchema;
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
		if (self::$wpVereinsflieger !== null) {
			return self::$wpVereinsflieger;
		}

		load_plugin_textdomain(WPVF_DOMAIN, false, dirname( plugin_basename( WPVF_BASE_FILE ) ) . '/languages' );

		DbSchema::init();

		$public = WpPublic::init();

		$admin = null;
		if (is_admin()) {
			$admin = WpAdmin::init();
		}

		self::$wpVereinsflieger = new self($public, $admin);
		return self::$wpVereinsflieger;
	}

	public static function activate(): void {
	}

	public static function deactivate(): void {
	}

	public static function uninstall(): void {
		Options::uninstall();
		DbSchema::uninstall();
	}

}