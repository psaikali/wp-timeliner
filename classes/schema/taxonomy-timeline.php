<?php

namespace WP_Timeliner\Schema;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
				'public'       => $this->has_archives_pages(),
				'hierarchical' => false,
				'show_in_rest' => true,
				'rewrite'      => [
					'slug'       => $this->get_slug(),
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
	 * Retrieve the Timeline slug in options
	 *
	 * @return string The slug defined by user/default slug.
	 */
	protected function get_slug() {
		return sanitize_title_with_dashes( Helpers::get_option( 'timeline_slug', 'timeline', false ) );
	}

	/**
	 * Should we enable the archives front-end pages?
	 *
	 * @return boolean User choice. Default to false.
	 */
	protected function has_archives_pages() {
		return Helpers::get_option( 'enable_timeline_archive_pages', 'no', false ) === 'yes';
	}

	/**
	 * Display introduction before the Add Taxonomy form
	 */
	public function display_taxonomy_form_introduction() {
		Helpers::include_template( 'timeline-introduction', dirname( __FILE__ ) );
	}
}
