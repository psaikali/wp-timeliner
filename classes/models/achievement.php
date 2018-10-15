<?php

namespace WP_Timeliner\Models;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Common\Interfaces\Has_Hooks;

class Achievement implements Has_Hooks {
	/**
	 * Necessary method to register the hooks.
	 */
	public function hooks() {
		add_action( 'admin_footer', [ $this, 'debug_hook' ] );
	}

	public function debug_hook() {
		error_log( 'debugging hook' );
	}
}
