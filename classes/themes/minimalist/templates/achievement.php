<article class="wpt-achievement" data-color="<?php echo esc_attr( $achievement->get_color() ); ?>">
	<header class="wpt-title">
		<h2>
			<?php if ( $achievement->has_button() ) { ?>
			<a href="<?php echo esc_url( $achievement->get_permalink() ); ?>">
			<?php } ?>
				<?php echo wp_kses_post( $achievement->get_title() ); ?>
			<?php if ( $achievement->has_button() ) { ?>
			</a>
			<?php } ?>
		</h2>

		<p class="wpt-date">
			<?php echo wp_kses_post( $this->display_date( $achievement, $timeline ) ); ?>
		</p>
	</header>

	<?php if ( $achievement->has_summary() ) { ?>
	<div class="wpt-summary">
		<?php echo wp_kses_post( wpautop( $achievement->get_summary() ) ); ?>
	</div>
	<?php } ?>

	<?php if ( $achievement->has_button() ) { ?>
	<footer class="wpt-read-more-button">
		<a href="<?php echo esc_url( $achievement->get_permalink() ); ?>">
			<?php echo wp_kses_post( $timeline->get_button_label() ); ?>
		</a>
	</footer>
	<?php } ?>

	<div class="wpt-icon" data-color="<?php echo esc_attr( $achievement->get_color() ); ?>">
		<?php if ( $achievement->has_icon() ) { ?>
		<i class="<?php echo esc_attr( $achievement->get_icon()->class ); ?>"></i>
		<?php } ?>
	</div>
</article>