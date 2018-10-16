<?php

namespace WP_Timeliner\Themes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Base abstract class for a Timeline theme.
 */
abstract class Abstract_Theme {
	abstract public function display_timeline( \WP_Timeliner\Models\Timeline $timeline );
	abstract public function display_achievement( \WP_Timeliner\Models\Achievement $achievement );
}
