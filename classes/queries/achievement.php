<?php

namespace WP_Timeliner\Queries;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Schema\Post_Type_Achievement;
use WP_Timeliner\Schema\Taxonomy_Timeline;
use WP_Timeliner\Models\Achievement as Achievement_Post;

/**
 * Logic related to Achievements queries
 */
class Achievement implements Has_Hooks {
	/**
	 * Register necessary hooks.
	 */
	public function hooks() {
		add_action( 'pre_get_posts', [ $this, 'order_achievements_by_start_date' ] );
		add_action( 'the_post', [ $this, 'inject_achievement_data_into_post' ] );
	}

	/**
	 * Order Achievements by start date metadata
	 *
	 * @param WP_Query $query
	 */
	public function order_achievements_by_start_date( $query ) {
		if ( $query->is_main_query() && is_tax( Taxonomy_Timeline::TAXONOMY ) ) {
			$query->set( 'posts_per_page', 50 );
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'meta_key', '_achievement_start_date' );
			$query->set( 'order', 'DESC' );
		}
	}

	/**
	 * Directly inject a ready-to-use Achievement_Post object in the global $post variable.
	 *
	 * @param WP_Post $post A post currently looped on.
	 */
	public function inject_achievement_data_into_post( $post ) {
		if ( $post->post_type === Post_Type_Achievement::POST_TYPE ) {
			$post->achievement = new Achievement_Post( $post );
		}
	}

	/**
	 * Get achievements for a specific timeline
	 */
	public static function get_achievements_for_timeline( $timeline_id ) {
		$achievements = new \WP_Query( [
			'post_type'              => Post_Type_Achievement::POST_TYPE,
			'no_found_rows'          => false,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'posts_per_page'         => 50,
			'orderby'                => 'meta_value',
			'order'                  => 'DESC',
			'meta_key'               => '_achievement_start_date',
			'tax_query' => [
				[
					'taxonomy' => Taxonomy_Timeline::TAXONOMY,
					'field'    => 'term_id',
					'terms'    => (int) $timeline_id,
				],
			],
		] );

		if ( $achievements->have_posts() ) {
			return array_map( function( $achievement ) {
				return wpt_achievement( $achievement );
			}, $achievements->posts );
		}

		return [];
	}
}
