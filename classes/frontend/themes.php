<?php

namespace WP_Timeliner\Frontend;

use WP_Timeliner\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Manage the timeline visual themes
 */
class Themes {
	protected static $themes = null;

	/**
	 * Default free timeline themes.
	 * Key is the theme slug, value is the class name to be used.
	 *
	 * @var array
	 */
	protected static $default_themes = [
		'left'  => '\WP_Timeliner\Themes\Left\Left_Theme',
		'right' => '\WP_Timeliner\Themes\Right\Right_Theme',
		'snake' => '\WP_Timeliner\Themes\Snake\Snake_Theme',
	];

	/**
	 * Get the available timeline themes.
	 *
	 * @return array An array of instantiated Theme objects.
	 */
	public static function get_themes() {
		if ( is_null( self::$themes ) ) {
			$themes_classes = apply_filters( 'wpt.timeline.themes', self::get_default_themes() );
			$themes         = [];

			foreach ( $themes_classes as $theme_slug => $theme_class ) {
				if ( class_exists( $theme_class ) ) {
					$themes[ $theme_slug ] = new $theme_class();
				}
			}

			self::$themes = $themes;
		}

		Helpers::debug( $themes );
		return self::$themes;
	}

	/**
	 * Return a list of our default themes.
	 *
	 * @return array Default themes.
	 */
	protected static function get_default_themes() {
		return self::$default_themes;
	}
}
