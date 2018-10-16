<?php

namespace WP_Timeliner\Themes\Snake;

use WP_Timeliner\Helpers;
use WP_Timeliner\Themes\Abstract_Theme;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Snake-aligned timeline theme
 */
class Snake_Theme extends Abstract_Theme {
	public function get_icon() {
		return Helpers::asset_image( 'theme-snake.png' );
	}
}