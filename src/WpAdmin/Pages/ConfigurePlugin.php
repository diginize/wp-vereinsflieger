<?php


namespace Diginize\WpVereinsflieger\WpAdmin\Pages;


use Diginize\WpVereinsflieger\Options;

class ConfigurePlugin extends AbstractPage {

	public static function getSlug(): string {
		return WpVereinsflieger::getSlug() . '-configure-plugin';
	}
	public static function getTitle(): string {
		return 'WP Vereinflieger - Konfiguration';
	}
	public static function getMenuTitle(): string {
		return 'Konfiguration';
	}

	public static function setup(): void {
		self::setupMenuItem(self::getTitle(), self::getMenuTitle(), self::getCapability(), self::getSlug());
	}

	public function processRequest(): void {
		if (
			!array_key_exists('wpvf_submit', $_POST) ||
			!array_key_exists('wpvf_cid', $_POST) ||
			!array_key_exists('wpvf_appKey', $_POST) ||
			!array_key_exists('wpvf_defaultRole', $_POST)
		) {
			return;
		}

		Options::setCID($_POST['wpvf_cid']);
		Options::setAppKey($_POST['wpvf_appKey']);
		Options::setDefaultRole($_POST['wpvf_defaultRole']);

		$this->addMessage('success','Die Änderungen wurden erfolgreich gespeichert.');
	}

	private function checkConfiguration() {
		if (!Options::getCID() || !Options::getAppKey()) {
			$this->addMessage('error', 'WP Vereinflieger ist noch nicht richtig konfiguriert.', false);
		} else {
			$this->addMessage('success', 'WP Vereinflieger ist richtig konfiguriert und einsatzbereit.', false);
		}
	}

	public function printPage(): void {
		$this->checkConfiguration();
		?>

		<?php $this->printHeader('Konfiguration'); ?>

		<?php $this->printMessages(); ?>

		<form action="" method="post">
			<table class="form-table">
				<tr>
					<th>CID</th>
					<td>
						<input class="regular-text" name="wpvf_cid" type="number" value="<?=esc_attr(Options::getCID())?>">
						<p class="description">
							Gib hier die ID deines Vereins aus Vereinsflieger an.<br>
							Diesen findest du in Vereisflieger unter <a href="https://www.vereinsflieger.de/member/admin/community.php">Administration &gt; Verein</a>.
						</p>
					</td>
				</tr>
				<tr>
					<th>App Key</th>
					<td>
						<input class="regular-text" name="wpvf_appKey" type="text" value="<?=esc_attr(Options::getAppKey())?>">
						<p class="description">
							Der App Key wird benötigt, um die Schnittstelle von Vereinsflieger nutzen zu können.<br>
							Solltest du noch keinen haben, kontaktiere bitte den Support von <a href="https://www.vereinsflieger.de/public/Kontakt.htm" target="_blank">Vereinsflieger.de</a>.
						</p>
					</td>
				</tr>
				<tr>
					<th>Rolle für neue Nutzer</th>
					<td>
						<select name="wpvf_defaultRole"><?php wp_dropdown_roles( Options::getDefaultRole() ); ?></select>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" name="wpvf_submit" class="button button-primary" value="Änderungen speichern">
			</p>
		</form>
		<style>
			input[type=number]::-webkit-outer-spin-button {
				-webkit-appearance: none;
				margin: 0;
			}
			input[type=number] {
				-moz-appearance: textfield;
			}
		</style>
		<?php
	}

}