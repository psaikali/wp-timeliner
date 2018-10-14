<?php

namespace WP_Timeliner\Schema;

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use Carbon_Fields\Field;
use WP_Timeliner\Helpers;

/**
 * Register Timeline fields
 */
class Fields_Timeline extends Abstract_Fields implements Has_Hooks {
	/**
	 * Register the Timeline metaboxes.
	 *
	 * @return array An array of Carbon_Fields\Container.
	 */
	protected function get_metaboxes() {
		return [
			[
				'type'      => 'term_meta',
				'id'        => 'timeline_settings',
				'title'     => __( 'Timeline settings', 'wp-timeliner' ),
				'condition' => [ 'term_taxonomy', '=', Taxonomy_Timeline::TAXONOMY ],
			],
		];
	}

	protected function fields_for_timeline_settings() {
		$fields = [];

		$themes = apply_filters(
			'wpt.timeline.themes',
			[
				'left'  => Helpers::asset_image( 'theme-left.png' ),
				'right' => Helpers::asset_image( 'theme-right.png' ),
				'snake' => Helpers::asset_image( 'theme-snake.png' ),
			]
		);

		$fields[] = Field::make( 'radio_image', 'timeline_theme', __( 'Theme', 'wp-timeliner' ) )
					->add_options( $themes );

		return $fields;
	}
}
