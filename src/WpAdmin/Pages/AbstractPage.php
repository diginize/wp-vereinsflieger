<?php


namespace Diginize\WpVereinsflieger\WpAdmin\Pages;


abstract class AbstractPage {

	/** @var array */
	private $messageStack = [];

	public abstract static function getSlug(): string;
	public static function getCapability(): string {
		return 'manage_options';
	}
	public abstract static function getTitle(): string;
	public abstract static function getMenuTitle(): string;

	public abstract static function setup(): void;

	protected static function setupMenuItem($title, $menuTitle, $capability, $slug): void {
		add_submenu_page(WpVereinsflieger::getSlug(), $title, $menuTitle, $capability, $slug, [get_called_class(), 'handleRequest']);
	}

	public static function handleRequest(): void {
		$childClass = get_called_class();

		/** @var self $page */
		$page = new $childClass();

		$page->processRequest();
		$page->printPage();
	}

	public abstract function processRequest(): void;
	public abstract function printPage(): void;

	public function printHeader(string $pageTitle = ''): void {
		?>
		<h1>WP Vereinsflieger</h1>

		<?php
		if ($pageTitle) {
			?>
			<h2><?=$pageTitle?></h2>
			<?php
		}

	}

	public function printDonationMessage(): void {
		?>
		<div class="notice-info notice">

			<p><?php _e('This plugin is available free of charge. Anyway maintaining and development takes time.<br>Therefore I\'d be very happy for some support in terms of a donation. You can simply follow this link:', WPVF_DOMAIN); ?> <a href="https://paypal.me/diginize">https://paypal.me/diginize</a></p>

		</div>
		<?php
	}

	/**
	 * @param string $type success|warning|error|info
	 * @param string $message
	 * @param bool   $isDismissible
	 */
	protected function addMessage(string $type, string $message, bool $isDismissible = true): void {
		$this->messageStack[] = [
			'type' => $type,
			'message' => $message,
			'dismissible' => $isDismissible
		];
	}

	protected function printMessages(): void {
		foreach ($this->messageStack as $i => $message) {
			?>
			<div id="message-<?=$i?>" class="notice-<?=$message['type']?> notice <?=$message['dismissible'] ? 'is-dismissible' : ''?>">

				<p><?=$message['message']?></p>

				<?php
				if ($message['dismissible']) {
					?>
					<button class="notice-dismiss" type="button"><span class="screen-reader-text"><?php _e('Dismiss', WPVF_DOMAIN); ?></span></button>
					<?php
				}
				?>

			</div>
			<?php
		}

		$this->messageStack = [];
	}

}