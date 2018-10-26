<?php

use WP_Timeliner\Frontend\Templates;

$timeline = wpt_timeline();

do_action( 'wpt.template.before-header', $timeline );
get_header();
do_action( 'wpt.template.after-header', $timeline );

if ( have_posts() ) {

	do_action( 'wpt.template.before-loop', $timeline );
	?>
	<section class="wpt-timeline wpt-theme-<?php echo esc_attr( $timeline->get_theme_slug() ); ?>">
	<?php
	while ( have_posts() ) {
		the_post();
		do_action( 'wpt.template.start-loop-item', $timeline, $post->achievement );
		Templates::get_template( 'content-wpt-achievement.php', [ 'timeline' => $timeline, 'achievement' => $post->achievement ] );
		do_action( 'wpt.template.end-loop-item', $timeline, $post->achievement );
	}
	?>
	</section>
	<?php
	do_action( 'wpt.timeline.after-loop', $timeline );

} else {

	do_action( 'wpt.template.before-no-achievement-found', $timeline );
	Templates::get_template( 'no-achievement-found.php', [ 'timeline' => $timeline ] );
	do_action( 'wpt.template.after-no-achievement-found', $timeline );

}

do_action( 'wpt.timeline.before-footer', $timeline );
get_footer();
do_action( 'wpt.timeline.after-footer', $timeline );
