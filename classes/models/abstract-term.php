<?php

namespace WP_Timeliner\Models;

use Carbon_Fields\Helper\Helper;
use WP_Timeliner\Common\Traits\Magic_Getter;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A model to get easy access to taxonomy terms, with superpowers.
 */
abstract class Abstract_Term {
	use Magic_Getter;

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
	 * Store meta values throughout our session.
	 *
	 * @var array
	 */
	protected $meta_values = [];

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
	 * @return int The Term ID.
	 */
	public function get_id() {
		return $this->object_id;
	}

	/**
	 * Get term taxonomy.
	 *
	 * @return string The term taxonomy.
	 */
	public function get_taxonomy() {
		return $this->taxonomy;
	}

	/**
	 * Get a post meta.
	 *
	 * @todo If get_meta_{$meta_key} method exists, use it.
	 * @param string $meta_key The meta to retrieve.
	 * @return mixed The post meta value.
	 */
	public function get_meta( $meta_key ) {
		if ( ! isset( $this->meta_values[ $meta_key ] ) ) {
			$this->meta_values[ $meta_key ] = Helper::get_value( $this->get_id(), 'term_meta', '', $meta_key );
		}

		return $this->meta_values[ $meta_key ];
	}

	/**
	 * Get name.
	 *
	 * @return string The term name.
	 */
	public function get_name() {
		return $this->get_term()->name;
	}

	/**
	 * Proxy function to get title (or name).
	 *
	 * @return string The term title.
	 */
	public function get_title() {
		return $this->get_name();
	}

	/**
	 * Get slug.
	 *
	 * @return string The term slug.
	 */
	public function get_slug() {
		return $this->get_term()->slug;
	}

	/**
	 * Get description.
	 *
	 * @return string The term description.
	 */
	public function get_description( $filtered = false ) {
		return $filtered ? apply_filters( 'the_content', $this->get_term()->description ) : $this->get_term()->description;
	}

	/**
	 * Proxy function to get content (or description).
	 *
	 * @return string The term description.
	 */
	public function get_content( $filtered = false ) {
		return $this->get_description( $filtered );
	}

	/**
	 * Get term archive permalink.
	 *
	 * @return string The term archive permalink.
	 */
	public function get_archive_permalink() {
		return get_term_link( $this->get_term(), $this->get_taxonomy() );
	}

	/**
	 * Proxy to get permalink (url).
	 *
	 * @return string The post permalink.
	 */
	public function get_url() {
		return $this->get_archive_permalink();
	}
}
