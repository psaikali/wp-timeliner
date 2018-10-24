<?php

namespace WP_Timeliner\Frontend\Blocks;

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Helpers;
use WP_Timeliner\Queries\Timeline as Timeline_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Our Timeline Gutenberg block.
 * 
 * @todo Make an abstract class for Gutenblocks.
 */
class Timeline implements Has_Hooks {
	const BLOCK_NAME = 'wp-timeliner/timeline';

	public function hooks() {
		add_action( 'init', [ $this, 'register_timeline_gutenblock' ] );
		//add_action( 'enqueue_block_editor_assets', [ $this, 'register_timeline_gutenblock_assets' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'load_timelines_themes_assets' ] );
	}

	/**
	 * Load timelines themes assets by looping throught all current page Gutenblocks
	 * and (maybe) loading our theme assets.
	 * 
	 * @todo Optimize this when Gutenberg will let us properly load block assets.
	 */
	public function load_timelines_themes_assets() {
		if ( ! is_singular() || ! function_exists( 'gutenberg_parse_blocks' ) ) {
			return;
		}

		global $post;
		$has_timeline = false;

		$timeline_blocks = array_filter( gutenberg_parse_blocks( $post->post_content ), function( $block ) {
			return ( $block['blockName'] === self::BLOCK_NAME );
		} );

		foreach ( $timeline_blocks as $timeline_block ) {
			if ( ! isset( $timeline_block['attrs']['timelineId'] ) ) {
				continue;
			}

			$has_timeline = true;
			wpt_timeline( (int) $timeline_block['attrs']['timelineId'] )->get_theme()->enqueue_assets();
		}

		if ( $has_timeline && apply_filters( 'wpt.theme.load_fontawesome', true ) ) {
			wp_enqueue_style( 'wpt-fontawesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', [], 470 );
		}
	}

	/**
	 * Register our timeline gutenblock
	 */
	public function register_timeline_gutenblock() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		register_block_type( 
			self::BLOCK_NAME, 
			[ 
				'editor_script'   => 'wpt-timeline-gutenblock',
				'render_callback' => [ $this, 'render_timeline_gutenblock' ],
			] 
		);

		wp_register_script(
			'wpt-timeline-gutenblock',
			TIMELINER_ASSETS_URL . '/js/gutenberg/dist/blocks.build.js',
			[ 'wp-blocks', 'wp-element', 'wp-data', 'wp-components' ]
		);

		wp_enqueue_style(
			'wpt-timeline-block-editor-css',
			TIMELINER_ASSETS_URL . '/js/gutenberg/dist/blocks.editor.build.css',
			[ 'wp-edit-blocks' ]
		);
	}

	/**
	 * Register back-end gutenblock assets
	 *
	 * @todo
	 */
	public function register_timeline_gutenblock_assets() {
		// Todo.
	}

	/**
	 * Render our block.
	 *
	 * @param array $attributes The gutenblock attributes.
	 * @return string The timeline output.
	 */
	public function render_timeline_gutenblock( $attributes ) {
		if ( ! isset( $attributes['timelineId'] ) ) {
			return;
		}

		/**
		 * @todo Shared logic with the shortcode outputing. Needs refactoring.
		 */
		$timeline = Timeline_Query::find_for( (int) $attributes['timelineId'] );

		if ( is_null( $timeline ) ) {
			return;
		}

		$theme        = $timeline->get_theme();
		$achievements = $timeline->get_achievements();

		ob_start();
		$theme->display_timeline( $timeline, $achievements );
		return ob_get_clean();
	}
}
