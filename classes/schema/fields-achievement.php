<?php

namespace WP_Timeliner\Schema;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use Carbon_Fields\Field;

/**
 * Register Achievement fields
 */
class Fields_Achievement extends Abstract_Fields implements Has_Hooks {
	/**
	 * Context to display these fields
	 *
	 * @var string
	 */
	public $context = 'achievement';

	/**
	 * Get metaboxes location, where they will appear.
	 *
	 * @return array Valid CarbonFields metabox conditional display array.
	 */
	protected function get_metaboxes_location() {
		return [
			'type'      => 'post_meta',
			'condition' => [ 'post_type', '=', Post_Type_Achievement::POST_TYPE ],
		];
	}

	/**
	 * Register the Achievement metaboxes.
	 *
	 * @return array An array of Carbon_Fields\Container settings.
	 */
	protected function get_metaboxes() {
		return [
			[
				'id'    => 'achievements_details',
				'title' => __( 'Achievement details', 'wp-timeliner' ),
			],
		];
	}

	/**
	 * List fields for the "Achievement details" page
	 *
	 * @return array An array of Carbon_Fields\Field fields.
	 */
	protected function fields_for_achievements_details() {
		$fields = [];

		$fields[] = Field::make( 'date', 'achievement_start_date', __( 'Start date', 'wp-timeliner' ) )
					->set_storage_format( 'U' )
					->set_attribute( 'placeholder', __( 'Start date for this achievement', 'wp-timeliner' ) )
					->set_picker_options( [ 'allowInput' => false ] )
					->set_help_text( __( 'This date will be used to position this achievement in its timeline.', 'wp-timeliner' ) )
					->set_required( true )
					->set_width( 50 );

		$fields[] = Field::make( 'date', 'achievement_end_date', __( 'End date', 'wp-timeliner' ) )
					->set_storage_format( 'U' )
					->set_attribute( 'placeholder', __( 'End date for this achievement', 'wp-timeliner' ) )
					->set_picker_options( [ 'allowInput' => false ] )
					->set_width( 50 );

		$fields[] = Field::make( 'icon', 'achievement_icon', __( 'Icon', 'wp-timeliner' ) )
					->add_fontawesome_options()
					->set_width( 50 );

		$fields[] = Field::make( 'color', 'achievement_color', __( 'Main color', 'wp-timeliner' ) )
					->set_palette( apply_filters( 'wpt.achievements.color_palette', [ '#00171F', '#5BC0EB', '#FDE74C', '#9BC53D', '#FA7921', '#D90429', '#7D5CD1', '#FF80D9' ] ) )
					->set_width( 50 );

		$fields[] = Field::make( 'checkbox', 'achievement_show_button', __( 'Show a button', 'wp-timeliner' ) )
					->set_option_value( 'on' )
					->set_help_text( __( 'Enable this option in order to display a button in this achievement timeline.', 'wp-timeliner' ) );

		$fields[] = Field::make( 'text', 'achievement_button_link', __( 'Button link', 'wp-timeliner' ) )
					->set_help_text( __( 'Leave blank to link directly to this achievement single page URL.', 'wp-timeliner' ) )
					->set_width( 50 )
					->set_conditional_logic( [
						[
							'field'   => 'achievement_show_button',
							// 'value'   => 'on',
							'compare' => '!=',
						]
					] );

		$fields[] = Field::make( 'text', 'achievement_button_label', __( 'Button label', 'wp-timeliner' ) )
					->set_help_text( __( 'Leave blank to link to use the default button label set in the timeline setting.', 'wp-timeliner' ) )
					->set_width( 50 )
					->set_conditional_logic( [
						[
							'field'   => 'achievement_show_button',
							// 'value'   => 'on',
							'compare' => '!=',
						]
					] );

		return $fields;
	}
}
