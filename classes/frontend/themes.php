<?php

namespace WP_Timeliner\Frontend;

use WP_Timeliner\Helpers;
use WP_Timeliner\Common\Traits\Is_Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Manage the timeline visual themes
 */
class Themes {
	use Is_Singleton;

	/**
	 * List of available themes.
	 *
	 * @var null|array
	 */
	protected static $themes = null;

	/**
	 * Get the available timeline themes.
	 *
	 * @return array An array of instantiated Theme objects.
	 */
	public function get_themes() {
		if ( is_null( self::$themes ) ) {
			self::$themes = [
				'minimalist' => new \WP_Timeliner\Themes\Minimalist\Minimalist_Theme(),
				//'snake'      => new \WP_Timeliner\Themes\Snake\Snake_Theme(),
			];
		}

		return apply_filters( 'wpt.timeline.themes', self::$themes );
	}

	/**
	 * Retrieve a single theme object from a slug.
	 *
	 * @param string $theme_slug
	 * @return Abstract_Theme A theme object.
	 */
	public function get_theme( $theme_slug ) {
		$themes = $this->get_themes();

		if ( array_key_exists( $theme_slug, $themes ) ) {
			return $themes[ $theme_slug ];
		}

		return null;
	}
}
