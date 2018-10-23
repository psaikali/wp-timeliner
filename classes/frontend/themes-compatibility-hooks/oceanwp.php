<?php

namespace WP_Timeliner\Compatibility\OceanWP;

/**
 * Markup before achievements loop
 */
function before_loop_markup() {
	?>
	<?php do_action( 'ocean_before_content_wrap' ); ?>
	<div id="content-wrap" class="container clr">
		<?php do_action( 'ocean_before_primary' ); ?>
		<div id="primary" class="content-area clr">
			<?php do_action( 'ocean_before_content' ); ?>
			<div id="content" class="site-content clr">
				<?php do_action( 'ocean_before_content_inner' ); ?>
	<?php
}
add_action( 'wpt.template.before-loop', __NAMESPACE__ . '\before_loop_markup' );

/**
 * Markup after achievements loop
 */
function after_loop_markup() {
	?>
				<?php do_action( 'ocean_after_content_inner' ); ?>
			</div><!-- #content -->
			<?php do_action( 'ocean_after_content' ); ?>
		</div><!-- #primary -->
		<?php do_action( 'ocean_after_primary' ); ?>
	<?php do_action( 'ocean_display_sidebar' ); ?>
	</div><!-- #content-wrap -->
	<?php do_action( 'ocean_after_content_wrap' ); ?>
	<?php
}
add_action( 'wpt.template.after-loop', __NAMESPACE__ . '\after_loop_markup' );
