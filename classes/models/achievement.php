<?php

namespace WP_Timeliner\Models;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Schema\Post_Type_Achievement;

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
}
