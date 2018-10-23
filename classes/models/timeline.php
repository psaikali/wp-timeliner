<?php

namespace WP_Timeliner\Models;

use WP_Timeliner\Schema\Taxonomy_Timeline;
use WP_Timeliner\Frontend\Themes;
use WP_Timeliner\Queries\Achievement;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A model to get easy access to Timeline terms data.
 */
class Timeline extends Abstract_Term {
	/**
	 * Define the Timeline taxonomy.
	 */
	protected function set_taxonomy() {
		$this->taxonomy = Taxonomy_Timeline::TAXONOMY;
	}

	/**
	 * Get theme slug
	 *
	 * @return string
	 */
	public function get_theme_slug() {
		return $this->get_meta( 'timeline_theme' );
	}

	/**
	 * Get the Timeline theme object.
	 *
	 * @return object The theme object.
	 */
	public function get_theme() {
		return Themes::get_instance()->get_theme( $this->get_theme_slug() );
	}

	/**
	 * Get the Timeline date format.
	 *
	 * @return string The date format used.
	 */
	public function get_date_format() {
		return $this->get_meta( 'timeline_date_format' );
	}

	/**
	 * Does this timeline show year breaks?
	 *
	 * @return boolean Whether to show year breaks or not.
	 */
	public function has_year_breaks() {
		return ( $this->get_meta( 'timeline_show_year_breaks' ) == 1 );
	}

	/**
	 * Get the Timeline button label.
	 *
	 * @return string The button label.
	 */
	public function get_button_label() {
		return $this->get_meta( 'timeline_button_text' );
	}

	/**
	 * Get timeline achievements
	 *
	 * @return array Array of WP_Timeliner\Models\Achievement.
	 */
	public function get_achievements() {
		return Achievement::get_achievements_for_timeline( $this->get_id() );
	}
}
