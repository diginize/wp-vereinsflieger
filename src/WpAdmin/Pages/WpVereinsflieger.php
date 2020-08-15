<?php


namespace Diginize\WpVereinsflieger\WpAdmin\Pages;


class WpVereinsflieger extends AbstractPage {

	public static function getSlug(): string {
		return 'wp-vereinsflieger';
	}

	public static function getTitle(): string {
		return 'WP Vereinsflieger';
	}

	public static function getMenuTitle(): string {
		return 'WP Vereinsflieger';
	}

	public static function setup(): void {
		add_menu_page(self::getTitle(), self::getMenuTitle(), self::getCapability(), self::getSlug(), [self::class, 'handleRequest']);

		ConfigurePlugin::setup();
	}

	public function processRequest(): void { }

	public function printPage(): void {
		?>
		<script>
			window.location.href = '<?=$_SERVER['SCRIPT_NAME']?>' +  '?page=' + '<?=ConfigurePlugin::getSlug()?>';
		</script>
		<?php
	}

}