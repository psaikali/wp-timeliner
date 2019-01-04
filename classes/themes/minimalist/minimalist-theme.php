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
	 * Theme version, for assets cache busting.
	 */
	const THEME_VERSION = '1.0.0';

	/**
	 * Get assets path
	 *
	 * @return string Path to /assets folder for this theme.
	 */
	private function get_assets_path() {
		return trailingslashit( TIMELINER_THEMES_URL ) . 'minimalist' . DIRECTORY_SEPARATOR . 'assets';
	}

	/**
	 * Path to the icon used to choose this theme in the back-end.
	 *
	 * @return string Path to an actual image file.
	 */
	public function get_icon() {
		return $this->get_assets_path() . '/theme-icon.png';
	}

	/**
	 * Enqueue this theme assets (JS & CSS).
	 */
	public function enqueue_assets() {
		if ( apply_filters( 'wpt.theme.load_theme_css', true, 'minimalist' ) ) {
			wp_enqueue_style( 'wpt-theme-minimalist-css', $this->get_assets_path() . '/css/theme.css', [], self::THEME_VERSION );
		}
	}

	/**
	 * Helper to list tags
	 */
	public function list_tags( $achievement ) {
		return implode( 
			', ',
			array_map( function( $tag ) { return $tag->get_name(); }, $achievement->get_tags() )
		);
	}
}
