<?php

namespace Diginize\WpVereinsflieger;

class Options {

	private static $option_dbVersion = 'WpVereinsflieger_DbVersion';

	private static $option_appKey = 'WpVereinsflieger_AppKey';
	private static $option_cid = 'WpVereinsflieger_CID';

	/**
	 * Removes all options previously set by the class
	 */
	public static function uninstall() {
		delete_option(self::$option_dbVersion);
		delete_option(self::$option_appKey);
		delete_option(self::$option_cid);
	}

	/**
	 * Returns the db version of this plugin
	 * @return int|null
	 */
	public static function getInstalledDbVersion(): ?int {
		return get_option(self::$option_dbVersion, null);
	}

	/**
	 * Sets the db version of this plugin
	 * @param int $dbVersion
	 */
	public static function setInstalledDbVersion(int $dbVersion): void {
		if (self::getInstalledDbVersion() === null) {
			add_option(self::$option_dbVersion, $dbVersion, '', false);
		} else {
			update_option(self::$option_dbVersion, $dbVersion);
		}
	}

	/**
	 * Returns the app key needed for the Vereinsflieger.de rest api
	 * @return string|null
	 */
	public static function getAppKey(): ?string {
		return get_option(self::$option_appKey, null);
	}

	/**
	 * Sets the app key needed for the Vereinsflieger.de rest api
	 * @param string $appKey
	 */
	public static function setAppKey(string $appKey): void {
		if (self::getAppKey() === null) {
			add_option(self::$option_appKey, $appKey, '', false);
		} else {
			update_option(self::$option_appKey, $appKey);
		}
	}

	/**
	 * Returns the club id the api should connect to
	 * @return int|null
	 */
	public static function getCID(): ?int {
		return get_option(self::$option_cid, null);
	}

	/**
	 * Sets the club id the api should connect to
	 * @param int $cid
	 */
	public static function setCID(int $cid): void {
		if (self::getAppKey() === null) {
			add_option(self::$option_cid, $cid, '', false);
		} else {
			update_option(self::$option_cid, $cid);
		}
	}

}