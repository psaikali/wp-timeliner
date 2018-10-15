<?php

namespace WP_Timeliner\Models;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Schema\Post_Type_Achievement;
use WP_Timeliner\Helpers;

/**
 * A model to get easy access to Achievement posts.
 */
class Achievement extends Abstract_Post {
	/**
	 * Define the Achievement post type.
	 */
	protected function set_post_type() {
		$this->post_type = Post_Type_Achievement::POST_TYPE;
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
		return ( $this->get_meta( 'achievement_show_button' ) === 1 );
	}

	/**
	 * Get Achievement tags.
	 *
	 * @return array Array of WP_Timeliner\Models\Tags
	 */
	public function get_tags() {
		return [];
	}
}
