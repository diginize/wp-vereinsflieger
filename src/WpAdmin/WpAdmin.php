<?php


namespace Diginize\WpVereinsflieger\WpAdmin;


use Diginize\WpVereinsflieger\WpAdmin\Pages\ConfigurePlugin;
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
		add_filter('plugin_action_links_wp-vereinsflieger/wp-vereinsflieger.php', [self::class, 'setupPluginActionLinks']);
	}

	public static function setupPluginActionLinks(array $links): array {
		// settings
		$settings_url = esc_url(add_query_arg(
			'page',
			ConfigurePlugin::getSlug(),
			get_admin_url() . 'admin.php'
		));
		array_unshift($links, '<a href="' . $settings_url . '">' . __('Settings') . '</a>');

		return $links;
	}

	private static $admin = null;
	public static function init(): self {
		if (!self::$admin) {
			self::$admin = new self();
		}

		return self::$admin;
	}

}