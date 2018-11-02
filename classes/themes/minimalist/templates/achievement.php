<article class="wpt-achievement" data-color="<?php echo esc_attr( $achievement->get_color() ); ?>">
	<header class="wpt-title">
		<h2>
			<?php if ( $achievement->has_button() ) { ?>
			<a href="<?php echo esc_url( $achievement->get_button_link() ); ?>" <?php if ( ! WP_Timeliner\Helpers::is_internal_url( $achievement->get_button_link() ) ) { ?>target="_blank" rel="noopener"<?php } ?>>
			<?php } ?>
				<?php echo wp_kses_post( $achievement->get_title() ); ?>
			<?php if ( $achievement->has_button() ) { ?>
			</a>
			<?php } ?>
		</h2>

		<p class="wpt-meta">
			<span class="wpt-date">
				<i class="fa fa-calendar"></i> <?php echo wp_kses_post( $this->display_date( $achievement, $timeline ) ); ?>
			</span>
			<?php if ( ! empty( $achievement->get_tags() ) ) { ?>
			<span class="wpt-tags">
			<i class="fa fa-tags"></i> <?php echo wp_kses_post( $this->list_tags( $achievement ) ); ?>
			</span>
			<?php } ?>
		</p>
	</header>

	<?php if ( $achievement->has_summary() ) { ?>
	<div class="wpt-summary">
		<?php echo wp_kses_post( wpautop( $achievement->get_summary() ) ); ?>
	</div>
	<?php } ?>

	<?php if ( $achievement->has_button() ) { ?>
	<footer class="wpt-read-more-button">
		<a href="<?php echo esc_url( $achievement->get_button_link() ); ?>" <?php if ( ! WP_Timeliner\Helpers::is_internal_url( $achievement->get_button_link() ) ) { ?>target="_blank" rel="noopener"<?php } ?>>
			<?php echo wp_kses_post( $achievement->get_button_label() ); ?>
		</a>
	</footer>
	<?php } ?>

	<div class="wpt-icon" style="background-color: <?php echo esc_attr( $achievement->get_color() ); ?>;--icon-bg-color:<?php echo esc_attr( $achievement->get_color() ); ?>;">
		<?php if ( $achievement->has_icon() ) { ?>
		<i class="<?php echo esc_attr( $achievement->get_icon()->class ); ?>"></i>
		<?php } ?>
	</div>
</article>