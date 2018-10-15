<?php

use WP_Timeliner\Models\Timeline;
use WP_Timeliner\Models\Achievement;
use WP_Timeliner\Schema\Taxonomy_Timeline;

/**
 * Return a usable Timeline model.
 *
 * @param mixed A specific $timeline (WP_Term, Term_ID or null to get current queried object).
 * @return WP_Timeliner\Models\Timeline|null A Timeline object or null.
 */
function wpt_timeline( $timeline = null ) {
	if ( is_null( $timeline ) ) {
		if ( ( $timeline = get_queried_object() ) && is_a( $timeline, 'WP_Term' ) ) {
			return new Timeline( $timeline );
		}
	} elseif ( is_a( $timeline, 'WP_Term' ) ) {
		return new Timeline( $timeline );
	} elseif ( is_int( $timeline ) ) {
		$timeline = get_term_by( 'id', (int) $timeline, Taxonomy_Timeline::TAXONOMY );
		return $timeline ? ( new Timeline( $timeline ) ) : null;
	}

	return null;
}

/**
 * Return a usable Achievement model.
 *
 * @param mixed A specific $achievement (WP_Post, Post_ID or null to get current queried object).
 * @return WP_Timeliner\Models\Achievement|null An Achievement object or null.
 */
function wpt_achievement( $achievement = null ) {
	if ( is_null( $achievement ) ) {
		if ( ( $achievement = get_queried_object() ) && is_a( $achievement, 'WP_Post' ) ) {
			return new Achievement( $achievement );
		}
	} elseif ( is_a( $achievement, 'WP_Post' ) ) {
		return new Achievement( $achievement );
	} elseif ( is_int( $achievement ) ) {
		$achievement = get_post( (int) $achievement );
		return $achievement ? ( new Achievement( $achievement ) ) : null;
	}

	return null;
}
