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

if (class_exists('WpVereinsflieger')) {
	return;
}

class WpVereinsflieger {

	public static function autoloadClass(string $class) {
		try {
			include_once(__DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php');
		} catch (Exception $e) {}
	}

	public static function install() {}

	public static function activate() {}

	public static function deactivate() {}

}

spl_autoload_register('\WpVereinsflieger::autoloadClass');

register_activation_hook( __FILE__, '\WpVereinsflieger::activate' );
register_deactivation_hook( __FILE__, '\WpVereinsflieger::deactivate' );