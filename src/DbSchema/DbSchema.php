<?php


namespace Diginize\WpVereinsflieger\DbSchema;


use Diginize\WpVereinsflieger\Options;

class DbSchema implements IDbSchema {

	private static $table_prefix = 'wpvf_';
	private static $db_version = 1;
	private static $wpdb = null;

	public static function init(): void {
		self::$wpdb = $GLOBALS['wpdb'];
		self::install();
	}

	public static function install(): void {
		if (Options::getInstalledDbVersion() === self::getDbVersion()) {
			return;
		}

		Users::install();

		Options::setInstalledDbVersion(self::getDbVersion());
	}

	public static function uninstall(): void {
		Users::uninstall();
	}

	/**
	 * Gets table prefix for tables and columns of this plugin.
	 * @return string
	 */
	public static function getTablePrefix(): string {
		return self::$table_prefix;
	}

	/**
	 * Get sthe current database version.
	 * @return string
	 */
	public static function getDbVersion(): string {
		return self::$db_version;
	}

	/**
	 * Gets the wordpress database object.
	 * @return \wpdb
	 */
	public static function getWpdb(): \wpdb {
		return self::$wpdb;
	}

	/**
	 * Appends a column to a table.
	 * @param string $table
	 * @param string $name
	 * @param string $definition
	 * @return bool
	 */
	public static function addColumn(string $table, string $name, string $definition): bool {
		return self::getWpdb()->query(
			'ALTER TABLE `' . $table . '` ADD COLUMN `' . $name . '` ' . $definition . ';'
		);
	}

	/**
	 * Removes a column from a table.
	 * @param string $table
	 * @param string $name
	 * @return bool
	 */
	public static function removeColumn(string $table, string $name): bool {
		return self::getWpdb()->query(
			'ALTER TABLE `' . $table . '` DROP COLUMN `' . $name . '`;'
		);
	}

	/**
	 * Adds a unique key to a table
	 * @param string $table
	 * @param string $name
	 * @param string[]  $columns
	 * @return bool
	 */
	public static function addUnique(string $table, string $name, array $columns): bool {
		return self::getWpdb()->query(
			'ALTER TABLE `' . $table . '` ADD CONSTRAINT `' . $name . '` UNIQUE (`' . implode('`,`', $columns) . '`);'
		);
	}

	/**
	 * Removes an index from a table
	 * @param string $table
	 * @param string $name
	 * @return bool
	 */
	public static function removeIndex(string $table, string $name): bool {
		return self::getWpdb()->query(
			'ALTER TABLE `' . $table . '` DROP INDEX `' . $name . '`;'
		);
	}

}