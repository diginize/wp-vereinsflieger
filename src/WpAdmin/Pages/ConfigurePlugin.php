<?php


namespace Diginize\WpVereinsflieger\WpAdmin\Pages;


use Diginize\WpVereinsflieger\Options;

class ConfigurePlugin extends AbstractPage {

	public static function getSlug(): string {
		return WpVereinsflieger::getSlug() . '-configure-plugin';
	}
	public static function getTitle(): string {
		return __('WP Vereinflieger') . ' - ' . __('Configuration');
	}
	public static function getMenuTitle(): string {
		return __('Configuration');
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

		if (
			!is_numeric($_POST['wpvf_cid']) ||
			!preg_match('/^[a-z0-9]+$/i', $_POST['wpvf_appKey']) ||
			!get_role($_POST['wpvf_defaultRole'])
		) {
			$this->addMessage('error', __('Some inputs are incorrect. Please check.'));
			return;
		}

		Options::setCID((int) $_POST['wpvf_cid']);
		Options::setAppKey(sanitize_key($_POST['wpvf_appKey']));
		Options::setDefaultRole(sanitize_text_field($_POST['wpvf_defaultRole']));

		$this->addMessage('success',__('Your changes were saved successfully.'));
	}

	private function checkConfiguration() {
		if (!Options::setupComplete()) {
			$this->addMessage('error', __('WP Vereinflieger is not configured completely.'), false);
		} else {
			$this->addMessage('success', __('WP Vereinflieger is configured correctly and ready for work.'), false);
		}
	}

	public function printPage(): void {
		$this->checkConfiguration();
		?>

		<?php $this->printHeader(__('Configuration')); ?>

		<?php $this->printDonationMessage(); ?>

		<?php $this->printMessages(); ?>

		<form action="" method="post">
			<table class="form-table">
				<tr>
					<th><?php _e('CID'); ?></th>
					<td>
						<input class="regular-text" name="wpvf_cid" type="number" value="<?=esc_attr(Options::getCID())?>">
						<p class="description">
							<?php _e('Please enter the ID number of your club in this field.'); ?><br>
							<?php _e('This ID can be found in Vereinsflieger at <a href="https://www.vereinsflieger.de/member/admin/community.php">Administration &gt; Verein</a>.'); ?>
						</p>
					</td>
				</tr>
				<tr>
					<th><?php _e('App Key'); ?></th>
					<td>
						<input class="regular-text" name="wpvf_appKey" type="text" value="<?=esc_attr(Options::getAppKey())?>">
						<p class="description">
							<?php _e('The App Key is required to authenticate against the interface of Vereinsflieger.'); ?><br>
							<?php _e('If you don\'t have one you can <a href="https://www.vereinsflieger.de/public/Kontakt.htm" target="_blank">contact the support</a> for one.'); ?>
						</p>
					</td>
				</tr>
				<tr>
					<th><?php _e('Role for new users'); ?></th>
					<td>
						<select name="wpvf_defaultRole"><?php wp_dropdown_roles( Options::getDefaultRole() ); ?></select>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" name="wpvf_submit" class="button button-primary" value="<?php __('Apply configuration'); ?>">
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
