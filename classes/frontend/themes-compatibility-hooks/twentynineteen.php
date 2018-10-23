<?php

namespace WP_Timeliner\Compatibility\TwentyNineteen;

/**
 * Markup before achievements loop
 */
function before_loop_markup() {
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="page-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<div class="entry-content">
	<?php
}
add_action( 'wpt.template.before-loop', __NAMESPACE__ . '\before_loop_markup' );

/**
 * Markup after achievements loop
 */
function after_loop_markup() {
	?>
			</div>
		</main>
	</div>
	<?php
}
add_action( 'wpt.template.after-loop', __NAMESPACE__ . '\after_loop_markup' );

/**
 * Specific CSS for this theme
 */
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
