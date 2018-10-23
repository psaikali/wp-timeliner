<?php

namespace WP_Timeliner\Compatibility\TwentyNineteen;

function before_loop_markup() {
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="entry-content">
	<?php
}
add_action( 'wpt.template.before-loop', __NAMESPACE__ . '\before_loop_markup' );

function after_loop_markup() {
	?>
			</div>
		</main>
	</div>
	<?php
}
add_action( 'wpt.template.after-loop', __NAMESPACE__ . '\after_loop_markup' );

function theme_specific_css() {
	?>
	<style>
		@media only screen and (min-width: 768px) {
  			section.wpt-timeline {
				margin: 0 calc(2 * (100vw / 12));
			}
		}
	</style>
	<?php
}
add_action( 'wp_head', __NAMESPACE__ . '\theme_specific_css' );