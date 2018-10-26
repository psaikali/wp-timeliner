<?php

namespace WP_Timeliner;

use WP_Timeliner\Admin\Options\Options;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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

	/**
	 * Proxy function to get a specific option
	 *
	 * @param string $option The option ID
	 * @param string $container_id The container ID
	 * @return mixed The option value.
	 */
	public static function get_option( $option, $default = null, $carbon = true ) {
		return Options::get( $option, $default, $carbon );
	}

	/**
	 * Retrieve a full class name from a simple "slug"
	 *
	 * @param string $name
	 * @return string Full class name.
	 */
	public static function get_class_name_from( $name ) {
		$classes = [
			'wpt-tag'         => 'WP_Timeliner\Models\Tag',
			'wpt-timeline'    => 'WP_Timeliner\Models\Timeline',
			'wpt-achievement' => 'WP_Timeliner\Models\Achievement',
		];

		return array_key_exists( $name, $classes ) ? $classes[ $name ] : false;
	}

	/**
	 * Is this an internal URL or external one?
	 *
	 * @author https://browse-tutorials.com/snippet/check-if-url-external-or-internal-php
	 * @param string $url The URL to analyze.
	 * @return boolean Whether the $url is from our current site, or not.
	 */
	public static function is_internal_url( $url ) {
		if ( strpos( $url, 'http' ) !== 0 ) {
			$url = "http://$url";
		}

		$url_host      = wp_parse_url( $url, PHP_URL_HOST );
		$base_url_host = wp_parse_url( home_url(), PHP_URL_HOST );

		return ( $url_host == $base_url_host || empty( $url_host ) );
	}
}
