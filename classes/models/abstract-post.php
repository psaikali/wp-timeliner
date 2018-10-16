<?php

namespace WP_Timeliner\Models;

use Carbon_Fields\Helper\Helper;
use WP_Timeliner\Common\Traits\Magic_Getter;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A model to get easy access to CPT posts, with superpowers.
 *
 * @link https://github.com/BeAPI/bea-plugin-boilerplate
 */
abstract class Abstract_Post {
	use Magic_Getter;

	/**
	 * The post type we are dealing with
	 *
	 * @var string
	 */
	protected $post_type = null;

	/**
	 * The WP_Post object
	 *
	 * @var WP_Post
	 */
	protected $object;

	/**
	 * The WP_Post ID
	 *
	 * @var int
	 */
	protected $object_id;

	/**
	 * Sub-classes are required to implement this in order to define the desired post type.
	 */
	abstract protected function set_post_type();

	/**
	 * Instantiate a Post model.
	 *
	 * @todo Instantiation could be done via a (int) ID only too, in some cases.
	 * @param \WP_Post $object The WP_Post to deal with.
	 */
	public function __construct( \WP_Post $object ) {
		if ( is_null( $this->post_type ) ) {
			$this->set_post_type();
		}

		if ( $object->post_type !== $this->post_type ) {
			throw new \Exception( sprintf( '%1$s post type does not match model post type %s.', $object->post_type, $this->post_type ) );
		}

		$this->object    = $object;
		$this->object_id = $object->ID;
	}

	/**
	 * Get WP_Post.
	 */
	public function get_post() {
		return $this->object;
	}

	/**
	 * Get WP_Post->ID.
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
		return Helper::get_value( $this->object_id, 'post_meta', '', $meta_key );
	}

	/**
	 * Get content.
	 *
	 * @return string The post content.
	 */
	public function get_content( $filtered = false ) {
		return $filtered ? apply_filters( 'the_content', $this->get_post()->post_content ) : $this->get_post()->post_content;
	}

	/**
	 * Get excerpt.
	 *
	 * @return string The post excerpt.
	 */
	public function get_excerpt() {
		return $this->get_post()->post_excerpt;
	}

	/**
	 * Get title.
	 *
	 * @return string The post title.
	 */
	public function get_title() {
		return $this->get_post()->post_title;
	}

	/**
	 * Get slug (post name).
	 *
	 * @return string The post slug.
	 */
	public function get_slug() {
		return $this->get_post()->post_name;
	}

	/**
	 * Get the post thumbnail.
	 *
	 * @param string $size The image size.
	 * @return string The post thumbnail image URL.
	 */
	public function get_thumbnail( $size = 'full' ) {
		return get_the_post_thumbnail_url( $this->get_id(), $size );
	}

	/**
	 * Return the post thumbnail ID
	 *
	 * @return int Thumbnail ID.
	 */
	public function get_thumbnail_id() {
		return get_post_thumbnail_id( $this->get_id() );
	}

	/**
	 * Check the current object has a thumbnail
	 *
	 * @return bool
	 */
	public function has_thumbnail() {
		return has_post_thumbnail( $this->get_id() );
	}
}
