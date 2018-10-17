<?php

namespace WP_Timeliner\Queries;

use WP_Timeliner\Schema\Taxonomy_Timeline;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Useful queries to deal with Timelines
 */
class Timeline {
	/**
	 * Find an associated timeline when user gives us an ID or slug
	 *
	 * @param string $something Could be a timeline ID or slug.
	 * @return WP_Timeliner\Models\Timeline|null
	 */
	public static function find_for( $something ) {
		if ( is_numeric( $something ) ) {
			return wpt_timeline( (int) $something );
		} elseif ( is_null( $something ) ) {
			return wpt_timeline();
		}

		return self::find_by_slug( $something );
	}

	/**
	 * Find a timeline term by its slug
	 *
	 * @param string $slug The timeline slug.
	 * @return WP_Timeliner\Models\Timeline
	 */
	public static function find_by_slug( $slug = null ) {
		$term = get_term_by( 'slug', $slug, Taxonomy_Timeline::TAXONOMY );

		if ( is_a( $term, 'WP_Term' ) ) {
			return wpt_timeline( $term );
		}

		return null;
	}
}
