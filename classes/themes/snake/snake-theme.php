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
	/**
	 * Theme version, for assets cache busting.
	 */
	const THEME_VERSION = '1.0.0';

	/**
	 * Get assets path
	 *
	 * @return string Path to /assets folder for this theme.
	 */
	private function get_assets_path() {
		return trailingslashit( TIMELINER_THEMES_URL ) . 'snake' . DIRECTORY_SEPARATOR . 'assets';
	}

	/**
	 * Path to the icon used to choose this theme in the back-end.
	 *
	 * @return string Path to an actual image file.
	 */
	public function get_icon() {
		return $this->get_assets_path() . '/theme-icon.png';
	}
}
