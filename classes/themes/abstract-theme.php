<?php

namespace WP_Timeliner\Themes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Base abstract class for a Timeline theme.
 */
abstract class Abstract_Theme {
	/**
	 * Find the path of the theme class.
	 *
	 * @return string Path to class.
	 */
	private function get_path_to_theme_class() {
		$full_class_path = ( new \ReflectionClass( get_class( $this ) ) )->getFileName();
		return dirname( $full_class_path );
	}

	/**
	 * Find the templates directory relative to theme class file location.
	 *
	 * @return string /templates directory.
	 */
	public function get_templates_path() {
		return $this->get_path_to_theme_class() . DIRECTORY_SEPARATOR . 'templates';
	}

	/**
	 * Display a timeline.
	 *
	 * @param \WP_Timeliner\Models\Timeline $timeline
	 * @param array $achievements
	 */
	public function display_timeline( \WP_Timeliner\Models\Timeline $timeline, array $achievements ) {
		$template = $this->get_templates_path() . DIRECTORY_SEPARATOR . 'timeline.php';

		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	/**
	 * Display an achievement.
	 *
	 * @param \WP_Timeliner\Models\Achievement $achievement
	 */
	public function display_achievement( \WP_Timeliner\Models\Achievement $achievement ) {
		$template = $this->get_templates_path() . DIRECTORY_SEPARATOR . 'achievement.php';

		if ( file_exists( $template ) ) {
			include $template;
		}
	}
}
