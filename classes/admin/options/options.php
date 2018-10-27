<?php

namespace WP_Timeliner\Admin\Options;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WP_Timeliner\Helpers;

/**
 * Handling stuff related to plugin admin options page.
 */
class Options implements Has_Hooks {
	/**
	 * The options page slug
	 */
	const OPTIONS_SLUG = 'wp-timeliner-options';

	/**
	 * Register necessary hooks
	 * 
	 * @todo Make an abstract class for that, to reuse for other options pages.
	 */
	public function hooks() {
		add_filter( 'plugin_action_links_' . TIMELINER_BASENAME, [ $this, 'plugin_settings_link' ] );

		add_action( 'carbon_fields_register_fields', [ $this, 'initialize_options_page' ] );
		add_filter( 'wpt.options.tabs', [ $this, 'get_tabs' ] );

		foreach ( $this->get_tabs( [] ) as $tab => $title ) {
			$method_name = "fields_for_options_tab_{$tab}";

			if ( method_exists( $this, $method_name ) ) {
				add_filter( "wpt.options.tab_{$tab}.fields", [ $this, $method_name ] );
			}
		}
	}

	/**
	 * Setup the admin theme options page with proper settings,
	 * and add fields.
	 *
	 * @link https://carbonfields.net/docs/containers-theme-options/
	 *
	 * @return void
	 */
	public function initialize_options_page() {
		$tabs = apply_filters( 'wpt.options.tabs', [] );

		if ( empty( $tabs ) ) {
			return;
		}

		// Create theme options container.
		$theme_options = Container::make( 'theme_options', __( 'WP Timeliner options', 'wp-timeliner' ) )->set_page_parent( 'options-general.php' );

		// Change its slug.
		$theme_options->set_page_file( self::OPTIONS_SLUG );

		// Change its menu title.
		$theme_options->set_page_menu_title( __( 'WP Timeliner', 'wp-timeliner' ) );

		// Load the tabs and their fields.
		foreach ( $tabs as $tab_slug => $tab_title ) {
			$theme_options->add_tab(
				esc_html( $tab_title ),
				apply_filters( "wpt.options.tab_{$tab_slug}.fields", [] )
			);
		}
	}

	/**
	 * Define the plugin options tabs
	 *
	 * @param array $tabs []
	 * @return array $tabs The tabs array: the key is the tab slug use in the filter (to load fields), the value is the tab title.
	 */
	public function get_tabs( $tabs ) {
		return [
			'general'  => __( 'General', 'wp-timeliner' ),
			//'advanced' => __( 'Advanced', 'wp-timeliner' ),
		];
	}

	/**
	 * Add fields to the General tab
	 *
	 * @return array $fields An array containing the options fields
	 * @link https://carbonfields.net/docs/fields-usage/
	 */
	public function fields_for_options_tab_general() {
		$fields = [];

		$advanced_html_warning = sprintf(
			'<div class="wpt-alert warning"><h4>%1$s</h4><p>%2$s</p></div>',
			__( 'Warning!', 'wp-timeliner' ),
			__( 'The settings below are for experienced WordPress users only. Please double check before altering one of this option and do not forget to flush rewrite rules and setup proper redirections afterwards.', 'wp-timeliner' )
		);

		$fields[] = Field::make( 'html', 'advanced_html_warning' )
					->set_html( $advanced_html_warning );

		$fields[] = Field::make( 'checkbox', $this->field( 'enable_timeline_archive_pages' ), __( 'Enable timeline archive pages', 'wpt-timeliner' ) )
					// ->set_option_value( 'on' )
					->set_help_text( __( 'By default, timelines are manually displayed via a shortcode or Gutenberg block. By enabling this setting, each timeline will automatically get its own URL.', 'wp-timeliner' ) );

		$fields[] = Field::make( 'text', $this->field( 'achievement_slug' ), __( 'Achievement URL prefix', 'wp-timeliner' ) )
					->set_help_text( __( 'Override the URL slug for single achievement pages. Leave blank for default <em>achievement</em> value.', 'wp-timeliner' ) )
					->set_width( 50 );

		$fields[] = Field::make( 'text', $this->field( 'timeline_slug' ), __( 'Timeline URL prefix', 'wp-timeliner' ) )
					->set_help_text( __( 'Override the URL slug for timeline archive pages. Leave blank for default <em>timeline</em> value.', 'wp-timeliner' ) )
					->set_width( 50 )
					->set_conditional_logic( [
						[
							'field'   => $this->field( 'enable_timeline_archive_pages' ),
							// 'value'   => 'on',
							'compare' => '!=',
						]
					] );

		return $fields;
	}

	/**
	 * Add fields to the Advanced tab
	 *
	 * @return array $fields An array containing the options fields
	 * @link https://carbonfields.net/docs/fields-usage/
	 */
	public function fields_for_options_tab_advanced() {
		$fields = [];

		return $fields;
	}

	/**
	 * Prefix a field ID
	 *
	 * @param string $id
	 * @return string The prefixed ID.
	 */
	private static function field( $id ) {
		return "wpt_{$id}";
	}

	/**
	 * Output the Settings link on the Plugins admin page
	 *
	 * @param array $links A list of existing links.
	 * @return array A new list of links.
	 */
	public function plugin_settings_link( $links ) {
		$settings_url = admin_url( 'options-general.php?page=' . self::OPTIONS_SLUG );
		$settings_link_tag = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( $settings_url ),
			__( 'Settings', 'wp-timeliner' )
		);

		array_unshift( $links, $settings_link_tag );

		return $links;
	}

	/**
	 * Proxy function to get a specific option
	 *
	 * @param string $option The option ID.
	 * @param string $default Pass a default value (if not using CarbonFields function).
	 * @param string $carbon Whether to use CarbonFields function or WP default one.
	 * @param string $container_id The container ID.
	 * @return mixed The option value.
	 */
	public static function get( $option, $default, $carbon ) {
		if ( $carbon ) {
			$option = \carbon_get_theme_option( self::field( $option ) );
		} else {
			$option_name = '_' . self::field( $option );
			$option      = get_option( $option_name, $default );
		}

		return ( strlen( $option ) > 0 ) ? $option : $default;
	}
}
