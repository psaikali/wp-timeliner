<?php

namespace WP_Timeliner;

/**
 * Helpful utilities functions
 */
class Helpers {
	/**
	 * Write in debug log
	 *
	 * @param mixed $logs Stuff to debug in log.
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

	/**
	 * Include template file
	 *
	 * @todo Make it extensible by themes/plugins to override /templates files.
	 * @param string         $template_file_name The template file name, without extension if needed.
	 * @param boolean|string $relative_to The relative base path to look for.
	 * @param string         $ext The file extension to append to filename.
	 * @return void
	 */
	public static function include_template( $template_file_name, $relative_to = false, $ext = '.php' ) {
		$base = ( ! $relative_to ) ? TIMELINER_DIR : $relative_to;
		include_once trailingslashit( $base ) . 'templates' . DIRECTORY_SEPARATOR . $template_file_name . $ext;
	}
}