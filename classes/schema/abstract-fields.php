<?php

namespace WP_Timeliner\Schema;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Carbon_Fields\Container;
use WP_Timeliner\Helpers;

/**
 * Metaboxes & fields helper class.
 */
 abstract class Abstract_Fields {
	/**
	 * Context to display these fields
	 *
	 * @var string
	 */
	public $context = 'post';

	/**
	 * Register Carbon Fields fields.
	 */
	public function hooks() {
		add_action( 'carbon_fields_register_fields', [ $this, 'add_metaboxes_and_fields' ] );
	}

	/**
	 * Add fields to each registered metaboxes.
	 */
	public function add_metaboxes_and_fields() {
		$metaboxes         = apply_filters( "wpt.metaboxes.{$this->context}", $this->get_metaboxes() );
		$located_metaboxes = array_map( function( $metabox ) {
			return array_merge( $metabox, $this->get_metaboxes_location() );
		}, $metaboxes );

		foreach ( $located_metaboxes as $metabox_data ) {
			$metabox_data = wp_parse_args( $metabox_data, $this->get_default_metabox_data() );
			$metabox      = Container::make(
				$metabox_data['type'],
				$metabox_data['id'],
				$metabox_data['title']
			)->where( ...$metabox_data['condition'] );

			$this->add_fields_to_metabox( $metabox );
		}
	}

	/**
	 * Get default metabox data
	 *
	 * @return array
	 */
	protected function get_default_metabox_data() {
		return [
			'type'      => 'post_meta',
			'id'        => 'metabox_' . str_replace( '\\', '_', strtolower( __CLASS__ ) ),
			'title'     => sprintf( __( 'Fields for %1$s', 'wp-timeliner' ), __CLASS__ ),
			'condition' => [ 'post_type', '=', 'post' ],
		];
	}

	/**
	 * Add fields to single metabox via the `fields_for_{$metabox_id}` method.
	 *
	 * @param Carbon_Fields\Container $metabox CarbonFields container.
	 */
	protected function add_fields_to_metabox( $metabox ) {
		$metabox_id                 = $this->get_metabox_short_id( $metabox );
		$metabox_fields_method_name = 'fields_for_' . $metabox_id;

		if ( method_exists( $metabox, 'add_fields' ) && method_exists( $this, $metabox_fields_method_name ) ) {
			$fields = $this->{$metabox_fields_method_name}();
		} else {
			$fields = apply_filters( "wpt.fields.{$this->context}.{$metabox_id}", [] );
		}

		$metabox->add_fields( $fields );
	}

	/**
	 * Get CarbonFields Container short ID (without `carbon_fields_container_` in it).
	 *
	 * @param Carbon_Fields\Container $metabox CarbonFields container.
	 * @return string The short ID.
	 */
	private function get_metabox_short_id( $metabox ) {
		if ( method_exists( $metabox, 'get_id' ) ) {
			return str_replace( 'carbon_fields_container_', '', $metabox->get_id() );
		}

		return null;
	}

	/**
	 * Return the metaboxes to be created.
	 * The Container ID is used in the method name to add fields to each metabox.
	 *
	 * @return array An array of Carbon_Fields\Container.
	 * @link https://carbonfields.net/docs/containers-usage/?crb_version=2-2-0
	 */
	abstract protected function get_metaboxes();
}
