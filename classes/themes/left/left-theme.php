<?php

namespace WP_Timeliner\Themes\Left;

use WP_Timeliner\Helpers;
use WP_Timeliner\Themes\Abstract_Theme;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Left-aligned timeline theme
 */
class Left_Theme extends Abstract_Theme {
	public function get_icon() {
		return Helpers::asset_image( 'theme-left.png' );
	}
}