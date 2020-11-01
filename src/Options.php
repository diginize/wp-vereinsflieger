<?php

namespace Diginize\WpVereinsflieger;

class Options {

	private static $option_dbVersion = 'WpVereinsflieger_DbVersion';

	private static $option_appKey = 'WpVereinsflieger_AppKey';
	private static $option_cid = 'WpVereinsflieger_CID';

	private static $option_defaultRole = 'WpVereinsflieger_DefaultRole';

	private static $option_allowDefaultLogin = 'WpVereinsflieger_AllowDefaultLogin';

	/**
	 * Removes all options previously set by the class
	 */
	public static function uninstall() {
		delete_option(self::$option_dbVersion);
		delete_option(self::$option_appKey);
		delete_option(self::$option_cid);
		delete_option(self::$option_defaultRole);
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
	 * @return string|null
	 */
	public static function getCID(): ?string {
		return get_option(self::$option_cid, null);
	}

	/**
	 * Sets the club id the api should connect to
	 * @param string $cid
	 */
	public static function setCID(string $cid): void {
		if (self::getCID() === null) {
			add_option(self::$option_cid, $cid, '', false);
		} else {
			update_option(self::$option_cid, $cid);
		}
	}

	/**
	 * Returns the role a new user is added to
	 * @return string|null
	 */
	public static function getDefaultRole(): ?string {
		return get_option(self::$option_defaultRole, null);
	}

	/**
	 * Sets the role a new user is added to
	 * @param string $role
	 */
	public static function setDefaultRole(string $role): void {
		if (self::getDefaultRole() === null) {
			add_option(self::$option_defaultRole, $role, '', false);
		} else {
			update_option(self::$option_defaultRole, $role);
		}
	}

	/**
	 * Returns if a user linked to a vereinsflieger account should be able to also login with his wordpress credentials.
	 * Default is false.
	 * @return bool
	 */
	public static function getAllowDefaultLogin(): bool {
		return get_option(self::$option_allowDefaultLogin, false);
	}

	/**
	 * Sets if an account linked to a vereinsflieger user should be able to login using it's wordpress credentials
	 * @param bool $isAllowed
	 */
	public static function setAllowDefaultLogin(bool $isAllowed): void {
		if (self::getAllowDefaultLogin() === null) {
			add_option(self::$option_allowDefaultLogin, $isAllowed, '', false);
		} else {
			update_option(self::$option_allowDefaultLogin, $isAllowed);
		}
	}

	/**
	 * Checks if the plugin is set up correctly.
	 * This means only that all required options are set.
	 * @return bool
	 */
	public static function setupComplete(): bool {
		return !(empty(Options::getAppKey()) || empty(Options::getCID()));
	}



}