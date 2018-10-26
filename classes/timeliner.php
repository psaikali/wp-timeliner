<?php

namespace WP_Timeliner;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Common\Traits\Is_Singleton;

/**
 * Our plugin loader, in charge of infrastructure stuff such as:
 * - defining & registering hooks
 * - loading localized languages files
 * - enqueueing scripts
 */
class Timeliner {
	use Is_Singleton;

	/**
	 * Fire our plugin: load hooks, localize language files, register assets
	 *
	 * @return void
	 */
	public function fire() {
		$this->hooks();
		$hooks = new Setup\Register_Hooks( __NAMESPACE__ );
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
	 * Include CarbonFields library manually, because using Composer could be risky in case
	 * of a shared dependency with another plugin.
	 *
	 * @return void
	 */
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
