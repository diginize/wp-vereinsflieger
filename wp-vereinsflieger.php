<?php

/**
 * Plugin Name: WP Vereinsflieger
 * Plugin URI: https://github.com/diginize/wp-vereinsflieger
 * Donate link: https://paypal.me/diginize
 * Tags: sso, vereinsflieger, luftsport
 * Description: Allows users to login into wordpress using their Vereinsflieger login.
 * Version: 1.1.0
 * Author: Diginize
 * Author URI: https://www.diginize.de
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */


require_once(__DIR__ . '/vendor/autoload.php');

use Diginize\WpVereinsflieger\WpVereinsflieger;

if (!defined('WPVF_DOMAIN')) {
	define('WPVF_DOMAIN', 'wp-vereinsflieger');
}
if (!defined('WPVF_BASE_FILE')) {
	define('WPVF_BASE_FILE', __FILE__);
}
if (!defined('WPVF_DONATE_LINK')) {
	define('WPVF_DONATE_LINK', 'https://paypal.me/diginize');
}

register_activation_hook( __FILE__, [WpVereinsflieger::class, 'activate']);
register_deactivation_hook( __FILE__, [WpVereinsflieger::class, 'deactivate']);
register_uninstall_hook(__FILE__, [WpVereinsflieger::class, 'uninstall']);

WpVereinsflieger::init();
