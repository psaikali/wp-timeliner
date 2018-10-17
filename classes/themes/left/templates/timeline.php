<?php 

var_dump( $timeline );
foreach ( $achievements as $a ) {
	var_dump( $a->get_start_date() );
}

?>