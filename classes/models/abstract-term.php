<?php

namespace WP_Timeliner\Models;

use Carbon_Fields\Helper\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A model to get easy access to taxonomy terms, with superpowers.
 */
abstract class Abstract_Term {
	/**
	 * The taxonomy we are dealing with
	 *
	 * @var string
	 */
	protected $taxonomy = null;

	/**
	 * The WP_Term object
	 *
	 * @var WP_Term
	 */
	protected $object;

	/**
	 * The WP_Term term_ID
	 *
	 * @var int
	 */
	protected $object_id;

	/**
	 * Sub-classes are required to implement this in order to define the desired taxonomy.
	 */
	abstract protected function set_taxonomy();

	/**
	 * Instantiate a Term model.
	 *
	 * @todo Instantiation could be done via a (int) ID only too, in some cases.
	 * @param \WP_Term $object The WP_Term to deal with.
	 */
	public function __construct( \WP_Term $object ) {
		if ( is_null( $this->taxonomy ) ) {
			$this->set_taxonomy();
		}

		if ( $object->taxonomy !== $this->taxonomy ) {
			throw new \Exception( sprintf( '%1$s taxonomy does not match model taxonomy %s.', $object->taxonomy, $this->taxonomy ) );
		}

		$this->object    = $object;
		$this->object_id = $object->term_id;
	}

	/**
	 * Get WP_Term.
	 */
	public function get_term() {
		return $this->object;
	}

	/**
	 * Get WP_Term->ID.
	 *
	 * @return int The Post ID.
	 */
	public function get_id() {
		return $this->object_id;
	}

	/**
	 * Get a post meta.
	 *
	 * @todo If get_meta_{$meta_key} method exists, use it.
	 * @param string $meta_key The meta to retrieve.
	 * @return mixed The post meta value.
	 */
	public function get_meta( $meta_key ) {
		return Helper::get_value( $this->object_id, 'term_meta', '', $meta_key );
	}

	/**
	 * Set metadata.
	 *
	 * @todo Implement this, when needed.
	 * @param string $meta_key
	 * @param mixed $meta_value
	 */
	public function set_meta( $meta_key, $meta_value ) {
		// Todo.
	}

	
}
