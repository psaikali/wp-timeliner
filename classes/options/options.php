<?php

namespace WP_Timeliner\Options;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class Options implements Has_Hooks {

	/**
	 * Register necessary hooks
	 * 
	 * @todo Make an abstract class for that, to reuse for other options pages.
	 */
	public function hooks() {
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
		$theme_options->set_page_file( 'wp-timeliner-options' );

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
			'advanced' => __( 'Advanced', 'wp-timeliner' ),
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

		// Header blockquote.
		$fields[] = Field::make( 'rich_text', $this->field( 'header_quote' ), 'Top header quote' )
					->set_help_text( __( 'This content will be displayed in the top part of your site, below the main content of the page.', 'wp-timeliner' ) );

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

		$advanced_html_warning = sprintf(
			'<div class="wpt-alert warning"><p>%1$s</p></div>',
			__( 'These settings are for experienced WordPress users only. Please double check before altering one of this option.', 'wp-timeliner' )
		);

		$fields[] = Field::make( 'html', 'advanced_html_warning' )
					->set_html( $advanced_html_warning );

		$fields[] = Field::make( 'text', $this->field( 'achievement_slug' ), 'Achievement URL prefix' )
					->set_help_text( __( 'Override the default <em>/achievement/</em> URL slug for single achievements.', 'wp-timeliner' ) )
					->set_width( 50 );

		$fields[] = Field::make( 'text', $this->field( 'timeline_slug' ), 'Timeline URL prefix' )
					->set_help_text( __( 'Override the default <em>/timeline/</em> URL slug for timeline archive pages.', 'wp-timeliner' ) )
					->set_width( 50 );

		return $fields;
	}

	private static function field( $id ) {
		return "wpt_{$id}";
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

		return $option;
	}

}
