<?php

use WP_Timeliner\Frontend\Templates;

$timeline = wpt_timeline();

do_action( 'wpt.template.before-header' );
get_header();
do_action( 'wpt.template.before-loop' );

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		do_action( 'wpt.template.start-loop-item' );
		Templates::get_template( 'content-wpt-achievement.php', [ 'timeline' => $timeline, 'achievement' => $post->achievement ] );
		do_action( 'wpt.template.end-loop-item' );
	}
} else {
	do_action( 'wpt.template.before-no-achievement-found' );
	Templates::get_template( 'no-achievement-found.php', [ 'timeline' => $timeline ] );
	do_action( 'wpt.template.after-no-achievement-found' );
}

do_action( 'wpt.timeline.after.loop' );
get_footer();
