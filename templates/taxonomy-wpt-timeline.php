<?php

use WP_Timeliner\Frontend\Templates;

$timeline = wpt_timeline();

do_action( 'wpt.template.before-header', $timeline );
get_header();
do_action( 'wpt.template.before-loop', $timeline );

if ( have_posts() ) {
	?>
	<section class="wpt-timeline wpt-theme-<?php echo esc_attr( $timeline->get_theme_slug() ); ?>">
	<?php
	while ( have_posts() ) {
		the_post();
		do_action( 'wpt.template.start-loop-item', $timeline );
		Templates::get_template( 'content-wpt-achievement.php', [ 'timeline' => $timeline, 'achievement' => $post->achievement ] );
		do_action( 'wpt.template.end-loop-item', $timeline );
	}
	?>
	</section>
	<?php
} else {
	do_action( 'wpt.template.before-no-achievement-found', $timeline );
	Templates::get_template( 'no-achievement-found.php', [ 'timeline' => $timeline ] );
	do_action( 'wpt.template.after-no-achievement-found', $timeline );
}

do_action( 'wpt.timeline.after.loop', $timeline );
get_footer();
