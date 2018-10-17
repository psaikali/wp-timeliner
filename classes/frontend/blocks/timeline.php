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
		add_action( 'init', [ $this, 'register_timeline_block' ] );
	}

	/**
	 * Register our timeline block
	 */
	public function register_timeline_block() {
		wp_register_script( 'wpt-timeline-gutenblock', TIMELINER_ASSETS_URL . '/js/gutenberg/dist/blocks.build.js', [ 'wp-blocks', 'wp-element', 'wp-data', 'wp-components' ] );

		register_block_type( 
			'wp-timeliner/timeline', 
			[ 
				'editor_script'   => 'wpt-timeline-gutenblock',
				'render_callback' => [ $this, 'render_timeline_block' ],
			] 
		);
	}

	/**
	 * Render our block.
	 *
	 * @param array $attributes The gutenblock attributes.
	 * @return string The timeline output.
	 */
	public function render_timeline_block( $attributes ) {
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
