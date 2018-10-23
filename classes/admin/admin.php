<?php

namespace WP_Timeliner\Admin;

use WP_Timeliner\Common\Interfaces\Has_Hooks;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin plugin things, like custom JS or CSS
 */
class Admin implements Has_Hooks {
	/**
	 * Register necessary hooks
	 */
	public function hooks() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
	}

	/**
	 * Load admin CSS
	 */
	public function enqueue_admin_scripts() {
		wp_enqueue_style( 'wpt-admin-css', TIMELINER_ASSETS_URL . '/css/admin.css', [], TIMELINER_VERSION );
	}
}
