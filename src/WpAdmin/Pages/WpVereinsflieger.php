<?php


namespace Diginize\WpVereinsflieger\WpAdmin\Pages;


use Diginize\WpVereinsflieger\WpAdmin\WpAdmin;

class WpVereinsflieger extends AbstractPage {

	public static function getSlug(): string {
		return 'wp-vereinsflieger';
	}

	public static function getTitle(): string {
		return 'Vereinsflieger';
	}

	public static function getMenuTitle(): string {
		return 'Vereinsflieger';
	}

	public static function getMenuIcon(): string {
		return 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0NzYuNTMgNTEyIiBzdHlsZT0iZmlsbDogI2EwYTVhYSI+Cgk8cGF0aCBkPSJNMjA4LjYyLDM0NC42MmMtMjQuMTYtNjkuNDgtNTYtMTM1LjU1LTM3LjQxLTIwOC4xLDguNTctMzMuNTEsMTUuMDctNzAuODMsMjIuNi0xMDUuMjIsNC43NS0yMS42Nyw0LjItMjcuNDItMjEtMjguMDZDMTQxLjU5LDIuNDYsMTA1LDEuNjksNzUuMzQuMTMsNTIuNDUtMS4wOCw1MCw2LjIsNDYuMiwyNi4zMiwzNy44LDcxLjEsMjcuNDIsMTE1LjU3LDIwLjY4LDE2MC41OGMtMy4yNywyMS44OC00Ljg2LDQ2LC44NSw2Ni45LDI0LDg3LjkxLDUxLjI1LDE3NC45NCw3Ni44NiwyNjIuNDIsNS4yMSwxNy43OSwxOS4xOCwyMSwzNy43NSwyMS41MiwyOC44NC43Nyw0OS4xLjc3LDc2LjM4LDAsMTQuNDUtLjQyLDMyLjgzLTguMjQsNDEuMzUtMTkuMjcsNDEuOS01NC4yMiw4Mi4wNy0xMDkuODMsMTIxLjY5LTE2NS43NSwzMS44MS00NC45MSw3Ni4yNC0xMjIuMDcsODIuNjQtMTM2LjMyLDExLjQ2LTI1LjUyLDE3LTQ2LjU0LDI5LjQ1LTEyNS4yNiwzLTE5LDMuNDYtMTYuNzYsNi4yMy0zOSwyLjM0LTE4LjcxLTYuNDYtMjMuNjMtMTQuODEtMjMuMzktMjUuOTQuNzYtNDEuMTMuODctOTAuNDEsMS41Ni00MS4zMy41OS00MC41Mi0zLjg5LTQ5LjMzLDYzLjgtNC43NiwzNi41Ny04LjE4LDczLjY4LTIwLDEwOS4yM0MzMTUuNCwxODguNzQsMjQ5LjkzLDI4OC41MSwyMDguNjIsMzQ0LjYyWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTE3LjczIDApIi8+Cjwvc3ZnPg==';
	}

	public static function setup(): void {
		add_menu_page(self::getTitle(), self::getMenuTitle(), self::getCapability(), self::getSlug(), [self::class, 'handleRequest'], self::getMenuIcon());

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