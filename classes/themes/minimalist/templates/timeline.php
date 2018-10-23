<section class="wpt-timeline wpt-theme-minimalist">
	<?php 
	foreach ( $achievements as $achievement ) {
		$this->display_achievement( $achievement, $timeline );
	}
	?>
</section>