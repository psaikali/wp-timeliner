<?php

namespace WP_Timeliner;

/**
 * Helpful utilities functions
 */
class Helpers {
	/**
	 * Write in debug log
	 *
	 * @param mixed $logs
	 */
	public static function debug( ...$logs ) {
		if ( true === WP_DEBUG && ! defined( 'WP_CURRENTLY_TESTING' ) ) {
			foreach ( $logs as $log ) {
				error_log( '--------------------------------- /!\ ' . __NAMESPACE__ . ' /!\ --------------------------------- ' );
				if ( is_array( $log ) || is_object( $log ) ) {
					error_log( print_r( $log, true ) );
				} else {
					error_log( $log );
				}
				error_log( '--------------------------------- /!\ ' . __NAMESPACE__ . ' /!\ --------------------------------- ' );
			}
		}
	}

	/**
	 * Return assets image path
	 *
	 * @param string $image The image file with extension.
	 * @return string Full image URL path.
	 */
	public static function asset_image( $image = 'image.jpg' ) {
		return esc_url( sprintf( '%1$s/images/%2$s', TIMELINER_ASSETS_URL, $image ) );
	}
}