<?php


namespace Diginize\WpVereinsflieger\DbSchema;


use Diginize\WpVereinsflieger\Options;

class Users implements IDbSchema {

	private static $column_vf_user_id = 'vf_uid';
	private static $unique_vf_user_id = 'vf_uid';

	public static function install(): void {
		$dbVersion = Options::getInstalledDbVersion();

		if ($dbVersion === null || $dbVersion < 1) {
			DbSchema::addColumn(self::getTableName(), self::getColumnVfUserId(), 'INT NULL DEFAULT NULL');
			DbSchema::addUnique(self::getTableName(), self::getUniqueVfUserId(), [self::getColumnVfUserId()]);
		}
	}

	public static function uninstall(): void {
		$dbVersion = Options::getInstalledDbVersion();

		if ($dbVersion >= 1) {
			DbSchema::removeColumn(self::getTableName(), self::getColumnVfUserId());
			DbSchema::removeIndex(self::getTableName(), self::getUniqueVfUserId());
		}
	}

	/**
	 * Gets the table name of the users table.
	 * @return string
	 */
	public static function getTableName(): string {
		return DbSchema::getWpdb()->users;
	}

	/**
	 * Gets the column name for the vereinsflieger.de user id.
	 * @return string
	 */
	public static function getColumnVfUserId(): string {
		return DbSchema::getTablePrefix() . self::$column_vf_user_id;
	}

	/**
	 * Gets the index name for the unique index of column vereinsflieger.de user id.
	 * @return string
	 */
	public static function getUniqueVfUserId(): string {
		return DbSchema::getTablePrefix() . self::$unique_vf_user_id;
	}

}