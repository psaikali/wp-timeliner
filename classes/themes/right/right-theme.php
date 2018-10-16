<?php

namespace WP_Timeliner\Themes\Right;

use WP_Timeliner\Helpers;
use WP_Timeliner\Themes\Abstract_Theme;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Right-aligned timeline theme
 */
class Right_Theme extends Abstract_Theme {
	public function get_icon() {
		return Helpers::asset_image( 'theme-right.png' );
	}
}