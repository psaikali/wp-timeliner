<?php

namespace WP_Timeliner;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Common\Interfaces\Has_Hooks;

/**
 * Our plugin loader, in charge of infrastructure stuff such as:
 * - defining & registering hooks
 * - loading localized languages files
 * - enqueueing scripts
 */
class Timeliner implements Has_Hooks {

	/**
	 * Fire our plugin: load hooks, localize language files, register assets
	 *
	 * @return void
	 */
	public function fire() {
		$this->include_libraries();
		$hooks = new Setup\Register_Hooks( __NAMESPACE__ );
		//$assets = new Setup\Enqueue_Assets();
	}

	public function hooks() {
		add_action( 'after_setup_theme', [ '\Carbon_Fields\Carbon_Fields', 'boot' ] );
	}


	/**
	 * Executed when plugin is activated.
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

	/**
	 * Executed when plugin is de-activated.
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

	/**
	 * Include our libraries manually, because using Composer could be risky in case
	 * of a shared dependency with another plugin.
	 *
	 * @return void
	 */
	protected function include_libraries() {
		if ( ! class_exists( '\Carbon_Fields' ) ) {
			require_once TIMELINER_DIR . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'carbon-fields-plugins' . DIRECTORY_SEPARATOR . 'carbon-fields-plugin.php';
		}
	}

	/**
	 * Boot Carbon Fields.
	 */
	public function boot_carbonfields() {
		\Carbon_Fields\Carbon_Fields::boot();
	}
}
