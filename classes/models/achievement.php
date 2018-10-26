<?php

namespace WP_Timeliner\Models;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Schema\Post_Type_Achievement;
use WP_Timeliner\Schema\Taxonomy_Tag;
use WP_Timeliner\Schema\Taxonomy_Timeline;

/**
 * A model to get easy access to Achievement posts data.
 */
class Achievement extends Abstract_Post {
	/**
	 * Define the Achievement post type.
	 */
	protected function set_post_type() {
		$this->post_type = Post_Type_Achievement::POST_TYPE;
	}

	/**
	 * Proxy function to get summary (or excerpt).
	 *
	 * @return string The achievement summary.
	 */
	public function get_summary() {
		return $this->get_excerpt();
	}

	/**
	 * Proxy function to has_excerpt()
	 */
	public function has_summary() {
		return $this->has_excerpt();
	}

	/**
	 * Get the Achievement start date.
	 *
	 * @return int The start date timestamp
	 */
	public function get_start_date() {
		return $this->get_meta( 'achievement_start_date' );
	}

	/**
	 * Get the Achievement end date.
	 *
	 * @return int The end date timestamp
	 */
	public function get_end_date() {
		return $this->get_meta( 'achievement_end_date' );
	}

	/**
	 * Does it have a end date?
	 *
	 * @return boolean
	 */
	public function has_end_date() {
		return strlen( $this->get_end_date() ) > 0;
	}

	/**
	 * Get the Achievement icon
	 *
	 * @return string The icon
	 */
	public function get_icon() {
		$icon = $this->get_meta( 'achievement_icon' );

		if ( strlen( $icon['value'] ) > 0 ) {
			return (object) [
				'value' => $icon['value'],
				'class' => $icon['class'],
				'name'  => $icon['name'],
			];
		}

		return null;
	}

	/**
	 * Does this achievement have an icon?
	 */
	public function has_icon() {
		return ! is_null( $this->get_icon() );
	}

	/**
	 * Get the Achievement main color
	 *
	 * @return string The color
	 */
	public function get_color() {
		return $this->get_meta( 'achievement_color' );
	}

	/**
	 * Should timeline display a button to single Achievement post page?
	 *
	 * @return boolean Whether to display the button or not
	 */
	public function has_button() {
		return ( $this->get_meta( 'achievement_show_button' ) == 1 );
	}

	/**
	 * Get the achievement button link (or achievement permalink if empty)
	 *
	 * @return string Button link
	 */
	public function get_button_link() {
		$achievement_button_link = $this->get_meta( 'achievement_button_link' );
		return ( strlen( $achievement_button_link ) > 0 ) ? $achievement_button_link : $this->get_permalink();
	}

	/**
	 * Get the achievement button label (or timeline button default label).
	 *
	 * @return string Button label
	 */
	public function get_button_label() {
		$achievement_button_label = $this->get_meta( 'achievement_button_label' );
		return ( strlen( $achievement_button_label ) > 0 ) ? $achievement_button_label : $this->get_timeline()->get_button_label();
	}

	/**
	 * Get Timeline
	 *
	 * @return WP_Timeliner\Models\Timeline|null The first timeline set for this achievement, or null.
	 */
	public function get_timeline() {
		$timelines = $this->get_terms( Taxonomy_Timeline::TAXONOMY );
		return ( ! empty( $timelines ) ) ? $timelines[0] : null;
	}

	/**
	 * Get Achievement tags.
	 *
	 * @todo
	 * @return array Array of WP_Timeliner\Models\Tags
	 */
	public function get_tags() {
		return $this->get_terms( Taxonomy_Tag::TAXONOMY );
	}
}
