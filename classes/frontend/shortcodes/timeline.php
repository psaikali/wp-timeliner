<?php

namespace WP_Timeliner\Frontend\Shortcodes;

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Helpers;
use WP_Timeliner\Queries\Timeline as Timeline_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A model to get easy access to Tag terms data.
 */
class Timeline extends Abstract_Shortcode {
	/**
	 * The shortcode tag.
	 *
	 * @var string
	 */
	protected $tag = 'wpt-timeline';

	/**
	 * The default attributes for this shortcode.
	 *
	 * @var array
	 */
	protected $default_attributes = [
		'id' => null,
	];

	/**
	 * Here comes the fun: render the shortcode content.
	 *
	 * @param object $attributes The attributes.
	 * @param string $content The potentious content.
	 */
	public function render( $attributes, $content ) {
		$timeline = Timeline_Query::find_for( $attributes->id );

		if ( is_null( $timeline ) ) {
			return;
		}

		$theme        = $timeline->get_theme();
		$achievements = $timeline->get_achievements();

		$theme->display_timeline( $timeline, $achievements );
	}
}
