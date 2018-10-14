<?php

namespace WP_Timeliner\Schema;

use WP_Timeliner\Common\Interfaces\Has_Hooks;

/**
 * Achievement post type
 */
class Post_Type_Achievement extends Abstract_Post_Type implements Has_Hooks {
	/**
	 * Post type slug.
	 *
	 * @var string
	 */
	const POST_TYPE = 'wpt-achievement';

	/**
	 * Register the Achievement post type
	 */
	public function __construct() {
		parent::__construct(
			[
				esc_html__( 'Achievement', 'wp-timeliner' ),
				esc_html__( 'Achievements', 'wp-timeliner' ),
				self::POST_TYPE,
			],
			[
				'supports'  => [
					'title',
					'editor',
					'excerpt',
					'thumbnail',
				],
				'menu_icon' => 'dashicons-exerpt-view',
				'public'    => true,
				'rewrite'   => [
					'slug'       => 'achievement',
					'with_front' => true,
				],
				'labels'    => [
					'menu_name'    => esc_html__( 'Timelines', 'wp-timeliner' ),
					'add_new'      => esc_html__( 'New Achievement', 'wp-timeliner' ),
					'add_new_item' => esc_html__( 'New Achievement', 'wp-timeliner' ),
				],
			]
		);
	}
}
