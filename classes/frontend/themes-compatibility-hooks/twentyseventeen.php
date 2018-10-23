<?php

namespace WP_Timeliner\Compatibility\TwentySeventeen;

/**
 * Markup before achievements loop
 */
function before_loop_markup() {
	?>
	<div class="wrap">
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
	<?php
}
add_action( 'wpt.template.before-loop', __NAMESPACE__ . '\before_loop_markup' );

/**
 * Markup after achievements loop
 */
function after_loop_markup() {
	?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .wrap -->
	<?php
}
add_action( 'wpt.template.after-loop', __NAMESPACE__ . '\after_loop_markup' );
