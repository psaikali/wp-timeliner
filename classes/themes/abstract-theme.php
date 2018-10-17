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
	public function display_achievement( \WP_Timeliner\Models\Achievement $achievement, \WP_Timeliner\Models\Timeline $timeline ) {
		$template = $this->get_templates_path() . DIRECTORY_SEPARATOR . 'achievement.php';

		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	/**
	 * Display date in correct format
	 *
	 * @param \WP_Timeliner\Models\Achievement $achievement
	 * @param \WP_Timeliner\Models\Timeline $timeline
	 * @return string The date string to display.
	 */
	public function display_date( \WP_Timeliner\Models\Achievement $achievement, \WP_Timeliner\Models\Timeline $timeline ) {
		$timeline_date_format = $timeline->get_date_format();

		switch ( $timeline_date_format ) {
			case 'year':
				$date_format = 'Y';
				break;

			case 'month_year':
				$date_format = 'm-Y';
				break;

			case 'full_date':
			default:
				$date_format = get_option( 'date_format' );
				break;
		}

		$date_format = apply_filters( 'wpt.timeline.date_format', $date_format, $timeline_date_format, $achievement, $timeline );

		if ( $achievement->has_end_date() ) {
			$string_format = apply_filters( 'wpt.timeline.date_string_format_for_two_dates', __( 'From %1$s to %2$s', 'wp-timeliner' ), $timeline_date_format, $achievement, $timeline );

			$displayed_date = sprintf(
				$string_format,
				date( $date_format, $achievement->get_start_date() ),
				date( $date_format, $achievement->get_end_date() )
			);
		} else {
			$string_format = apply_filters( 'wpt.timeline.date_string_format_for_one_date', '%1$s', $timeline_date_format, $achievement, $timeline );

			$displayed_date = sprintf(
				$string_format,
				date( $date_format, $achievement->get_start_date() )
			);
		}

		return $displayed_date;
	}
}
