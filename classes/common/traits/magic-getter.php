<?php

namespace WP_Timeliner\Common\Traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait Magic_Getter {
	/**
	 * Magic getter when trying to directly access some values.
	 *
	 * @param  string $field Field to get.
	 * @throws Exception     Throws an exception if the field is invalid.
	 * @return mixed         Value of the field.
	 */
	public function __get( $field ) {
		$method_name = strtolower( "get_{$field}" );

		if ( method_exists( $this, $method_name ) ) {
			return $this->$method_name();
		}

		throw new \Exception( sprintf( '%1$s taxonomy can not retrieve property %2$s.', $this->taxonomy, $field ) );
	}
}