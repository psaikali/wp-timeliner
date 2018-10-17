<?php

namespace WP_Timeliner\Themes\Minimalist;

use WP_Timeliner\Helpers;
use WP_Timeliner\Themes\Abstract_Theme;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Minimalist timeline theme
 */
class Minimalist_Theme extends Abstract_Theme {
	/**
	 * Path to the icon used to choose this theme in the back-end.
	 *
	 * @return string Path to an actual image file.
	 */
	public function get_icon() {
		return trailingslashit( TIMELINER_THEMES_URL ) . 'minimalist' . DIRECTORY_SEPARATOR . 'theme-icon.png';
	}
}