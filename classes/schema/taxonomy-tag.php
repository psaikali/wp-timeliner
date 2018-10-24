<?php

namespace WP_Timeliner\Schema;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Helpers;

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
				'public'       => false,
				'hierarchical' => false,
				'show_in_rest' => true,
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
		Helpers::include_template( 'tag-introduction', dirname( __FILE__ ) );
	}
}
