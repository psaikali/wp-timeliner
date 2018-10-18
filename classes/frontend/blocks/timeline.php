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
	public function hooks() {
		add_action( 'init', [ $this, 'register_timeline_gutenblock' ] );
		//add_action( 'enqueue_block_editor_assets', [ $this, 'register_timeline_gutenblock_assets' ] );
	}

	/**
	 * Register our timeline gutenblock
	 */
	public function register_timeline_gutenblock() {
		register_block_type( 
			'wp-timeliner/timeline', 
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
	public function render_timeline_gutenlock( $attributes ) {
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
