<?php

namespace WP_Timeliner\Frontend;

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Schema\Taxonomy_Timeline;
use WP_Timeliner\Helpers;

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
		add_action( 'init', [ $this, 'maybe_load_theme_compatibility_hooks' ] );
		add_filter( 'template_include', [ $this, 'load_timeliner_template' ] );
		add_filter( 'wp_enqueue_scripts', [ $this, 'enqueue_current_theme_assets' ] );
	}

	/**
	 * Load our timeliner taxonomy timeline archive file
	 *
	 * @param string $template The template file that WP would normally use.
	 * @return string A new template file path.
	 */
	public function load_timeliner_template( $template ) {
		if ( is_tax( Taxonomy_Timeline::TAXONOMY ) ) {
			$template_file_name = sprintf( '%1$s.php', self::TEMPLATE_ARCHIVE_TIMELINE );
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

	/**
	 * Enqueue current timeline theme assets on timeline archive pages.
	 *
	 * @todo Do the same for shortcodes/Gutenblock.
	 */
	public function enqueue_current_theme_assets() {
		if ( is_tax( Taxonomy_Timeline::TAXONOMY ) ) {
			$timeline = wpt_timeline( get_queried_object() );
			$theme    = $timeline->get_theme();

			if ( method_exists( $theme, 'enqueue_assets' ) ) {
				$theme->enqueue_assets();
			}
		}

		if ( apply_filters( 'wpt.theme.load_fontawesome', true ) ) {
			wp_enqueue_style( 'wpt-fontawesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', [], 470 );
		}
	}

	/**
	 * Maybe load specific compatibility hooks for the current theme
	 */
	public function maybe_load_theme_compatibility_hooks() {
		$current_theme = wp_get_theme()->template;
		$potential_file = TIMELINER_DIR . "/classes/frontend/themes-compatibility-hooks/{$current_theme}.php";

		if ( file_exists( $potential_file ) && apply_filters( 'wpt.theme.load_compatibility_hooks', true, $current_theme ) ) {
			include_once $potential_file;
		}
	}
}
