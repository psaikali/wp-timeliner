<?php

namespace WP_Timeliner\Schema;

use WP_Timeliner\Common\Interfaces\Has_Hooks;

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
}
