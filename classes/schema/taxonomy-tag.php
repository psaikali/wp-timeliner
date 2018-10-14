<?php

namespace WP_Timeliner\Schema;

use WP_Timeliner\Common\Interfaces\Has_Hooks;

/**
 * Tag taxonomy
 */
class Taxonomy_Tag extends Abstract_Taxonomy implements Has_Hooks {
	/**
	 * Taxonomy slug.
	 *
	 * @var string
	 */
	const TAXONOMY = 'wpt-tag';

	/**
	 * Register the Tag taxonomy.
	 */
	public function __construct() {
		parent::__construct(
			[
				__( 'Tag', 'wp-timeliner' ),
				__( 'Tags', 'wp-timeliner' ),
				self::TAXONOMY,
			],
			[
				'hierarchical' => false,
				'rewrite'      => [
					'slug'       => 'tag',
					'with_front' => false,
				],
			],
			[
				Post_Type_Achievement::POST_TYPE,
			]
		);
	}
}
