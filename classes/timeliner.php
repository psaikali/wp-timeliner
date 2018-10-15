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
		//$this->include_libraries();
		$hooks = new Setup\Register_Hooks( __NAMESPACE__ );
		//$assets = new Setup\Enqueue_Assets();
	}

	/**
	 * Register required hooks.
	 */
	public function hooks() {
		add_action( 'after_setup_theme', [ $this, 'boot_carbon_fields' ] );
	}


	/**
	 * Executed when plugin is activated.
	 */
	public static function activate() {
		// TODO : check_requirements() (PHP version) and maybe automatically disable the plugin.
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
		// Include CarbonFields library if it does not exist.
		// if ( ! class_exists( '\Carbon_Fields' ) ) {
		// 	require_once TIMELINER_DIR . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'carbon-fields-plugins' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
		// 	require_once TIMELINER_DIR . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'carbon-fields-icon-field' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
		// }

		// // Register a new CarbonFields Icon field type.
		// require_once TIMELINER_DIR . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'carbon-fields-icon-field' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Icon_Field.php';
		// require_once TIMELINER_DIR . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'carbon-fields-icon-field' . DIRECTORY_SEPARATOR . 'field.php';
	}

	public function boot_carbon_fields() {
		if ( ! class_exists( '\Carbon_Fields' ) ) {
			require_once TIMELINER_DIR . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'carbon-fields-plugins' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
		}

		if ( ! class_exists( '\Carbon_Field_Icon\Icon_Field' ) ) {
			require_once TIMELINER_DIR . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'carbon-fields-icon-field' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
		}

		\Carbon_Fields\Carbon_Fields::boot();
	}
}
