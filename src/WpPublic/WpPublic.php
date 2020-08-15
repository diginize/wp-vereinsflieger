<?php


namespace Diginize\WpVereinsflieger\WpPublic;


use Diginize\WpVereinsflieger\Options;

class WpPublic {

	/** @var Authentication */
	private $authentication;

	public function __construct() {
		$this->setupDependencies();
		$this->setupHooks();
	}

	private function setupDependencies(): void {
		$this->authentication = new Authentication();
	}

	private function setupHooks(): void {
		if (Options::setupComplete()) {
			add_filter('authenticate', [$this->authentication, 'authenticationRequest'], 50, 3);
		}

		// TODO: add config option to disable password changes for vereinsflieger users
		// add_action('lostpassword_post', [$this->authentication, 'lostPasswordRequest'], 50, 2);
	}

	private static $public = null;
	public static function init(): self {
		if (!self::$public) {
			self::$public = new self();
		}

		return self::$public;
	}

}