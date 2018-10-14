<?php

namespace WP_Timeliner\Schema;

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use Carbon_Fields\Field;

/**
 * Register Achievement fields
 */
class Fields_Achievement extends Abstract_Fields implements Has_Hooks {
	/**
	 * Register the Achievement metaboxes.
	 *
	 * @return array An array of Carbon_Fields\Container.
	 */
	protected function get_metaboxes() {
		return [
			[
				'type'      => 'post_meta',
				'id'        => 'achievements_details',
				'title'     => __( 'Achievement details', 'wp-timeliner' ),
				'condition' => [ 'post_type', '=', Post_Type_Achievement::POST_TYPE ],
			],
		];
	}

	protected function fields_for_achievements_details() {
		$fields = [];

		$fields[] = Field::make( 'date', 'achievement_start_date', __( 'Start date', 'wp-timeliner' ) )
					->set_attribute( 'placeholder', __( 'Start date for this achievement', 'wp-timeliner' ) )
					->set_help_text( __( 'This achievement will be positioned in its timeline based on the start date.', 'wp-timeliner' ) )
					->set_required( true )
					->set_width( 50 );

		$fields[] = Field::make( 'date', 'achievement_end_date', __( 'End date', 'wp-timeliner' ) )
					->set_attribute( 'placeholder', __( 'End date for this achievement', 'wp-timeliner' ) )
					->set_width( 50 );

		$fields[] = Field::make( 'icon', 'achievement_icon', __( 'Icon', 'wp-timeliner' ) )
					->add_fontawesome_options()
					->set_width( 50 );

		$fields[] = Field::make( 'color', 'achievement_color', __( 'Main color', 'wp-timeliner' ) )
					->set_palette( apply_filters( 'wpt.achievements.color_palette', [ '#00171F', '#5BC0EB', '#FDE74C', '#9BC53D', '#FA7921', '#D90429' ] ) )
					->set_width( 50 );

		return $fields;
	}
}
