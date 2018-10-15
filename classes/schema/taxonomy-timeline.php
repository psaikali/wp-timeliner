<?php

namespace WP_Timeliner\Schema;

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Helpers;

/**
 * Timeline taxonomy
 */
class Taxonomy_Timeline extends Abstract_Taxonomy implements Has_Hooks {
	/**
	 * Taxonomy slug.
	 *
	 * @var string
	 */
	const TAXONOMY = 'wpt-timeline';

	/**
	 * Register the Timeline taxonomy.
	 */
	public function __construct() {
		parent::__construct(
			[
				__( 'Timeline', 'wp-timeliner' ),
				__( 'Timelines', 'wp-timeliner' ),
				self::TAXONOMY,
			],
			[
				'hierarchical' => false,
				'rewrite'      => [
					'slug'       => 'timeline',
					'with_front' => false,
				],
			],
			[
				Post_Type_Achievement::POST_TYPE,
			]
		);
	}

	/**
	 * Register necessary hooks.
	 */
	public function hooks() {
		parent::hooks();

		$taxonomy = self::TAXONOMY;
		add_action( "{$taxonomy}_pre_add_form", [ $this, 'display_taxonomy_form_introduction' ] );
	}

	/**
	 * Display introduction before the Add Taxonomy form
	 */
	public function display_taxonomy_form_introduction() {
		Helpers::include_template( 'timeline-introduction', dirname( __FILE__ ) );
	}
}
