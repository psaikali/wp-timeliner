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
	/**
	 * Path to the icon used to choose this theme in the back-end.
	 *
	 * @return string Path to an actual image file.
	 */
	public function get_icon() {
		return Helpers::asset_image( 'theme-right.png' );
	}
}