<?php

namespace WP_Timeliner\Frontend;

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Helpers;
use WP_Timeliner\Schema\Taxonomy_Timeline;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load plugin templates first, or themes templates if existing
 */
class Templates implements Has_Hooks {
	const TEMPLATE_ARCHIVE_TIMELINE = 'taxonomy-wpt-timeline';

	/**
	 * Register necessary hooks.
	 */
	public function hooks() {
		//add_filter( 'archive_template', [ $this, 'load_timeliner_template' ] );
		add_filter( 'template_include', [ $this, 'load_timeliner_template' ] );
	}

	public function load_timeliner_template( $template ) {
		if ( is_tax( Taxonomy_Timeline::TAXONOMY ) ) {
			$template_file_name = sprintf( '%1$s.php', self::TEMPLATE_ARCHIVE_TIMELINE );
			$timeline           = wpt_timeline( get_queried_object() );
			$template           = self::locate_template( $template_file_name );

			return $template;
		}

		return $template;
	}

	/**
	 * Locate a template file, whether it's in the theme/child-theme folder or use plugin default template
	 *
	 * @link http://jeroensormani.com/how-to-add-template-files-in-your-plugin/
	 * @param string $template_name
	 * @param string $template_path
	 * @param string $default_path
	 * @return string Path to template.
	 */
	public static function locate_template( $template_name, $template_path = '', $default_path = '' ) {
		// Set variable to search in /templates/ folder of theme.
		if ( ! $template_path ) {
			$template_path = 'templates/';
		}

		// Set default plugin templates path.
		if ( ! $default_path ) {
			$default_path = TIMELINER_DIR . 'templates/';
		}

		// Search template file in theme folder.
		$template = locate_template( [
			$template_path . $template_name,
			$template_name,
		] );

		// Get plugins template file.
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		return apply_filters( 'wpt.template.locate', $template, $template_name, $template_path, $default_path );
	}


	/**
	 * Include a template file
	 *
	 * @author WooCommerce
	 * @param string Template file name.
	 * @param array $args Arguments to pass to template.
	 * @param string $template_path
	 * @param string $default_path
	 */
	public static function get_template( $template_name, $args = [], $template_path = '', $default_path = '' ) {
		if ( is_array( $args ) && isset( $args ) ) {
			extract( $args );
		}

		$located_template_file = self::locate_template( $template_name, $template_path, $default_path );

		if ( ! file_exists( $located_template_file ) ) {
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> template file does not exist.', $located_template_file ), '1.0.0' );
			return;
		}

		do_action( 'wpt.template.before-inclusion', $template_name, $template_path, $located_template_file, $args );

		include $located_template_file;

		do_action( 'wpt.template.after-inclusion', $template_name, $template_path, $located_template_file, $args );
	}
}