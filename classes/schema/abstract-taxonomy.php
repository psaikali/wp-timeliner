<?php

namespace WP_Timeliner\Schema;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Taxonomy creation helper class.
 *
 * @author WebDevStudios
 * @link https://github.com/WebDevStudios/Taxonomy_Core
 */
abstract class Abstract_Taxonomy {
	/**
	 * Singlur Taxonomy label.
	 *
	 * @var string
	 */
	protected $singular;

	/**
	 * Plural Taxonomy label
	 *
	 * @var string
	 */
	protected $plural;

	/**
	 * Registered Taxonomy name/slug
	 *
	 * @var string
	 */
	protected $taxonomy;

	/**
	 * Optional argument overrides passed in from the constructor.
	 *
	 * @var array
	 */
	protected $arg_overrides = [];

	/**
	 * All Taxonomy registration arguments
	 *
	 * @var array
	 */
	protected $taxonomy_args = [];

	/**
	 * Objects to register this taxonomy against
	 *
	 * @var array
	 */
	protected $object_types;

	/**
	 * An array of each Taxonomy_Core object registered with this class
	 *
	 * @var array
	 */
	protected static $taxonomies = [];

	/**
	 * Constructor. Builds our Taxonomy.
	 *
	 * @param mixed $taxonomy      Singular Taxonomy name, or array with Singular, Plural, and Registered.
	 * @param array $arg_overrides Taxonomy registration override arguments.
	 * @param array $object_types  Post types to register this taxonomy for.
	 */
	public function __construct( $taxonomy, $arg_overrides = [], $object_types = ['post' ] ) {

		if ( ! is_array( $taxonomy ) ) {
			wp_die( __( 'It is required to pass a single, plural and slug string to Taxonomy_Core', 'wp-timeliner' ) );
		}

		if ( ! isset( $taxonomy[0], $taxonomy[1], $taxonomy[2] ) ) {
			wp_die( __( 'It is required to pass a single, plural and slug string to Taxonomy_Core', 'wp-timeliner' ) );
		}

		if ( ! is_string( $taxonomy[0] ) || ! is_string( $taxonomy[1] ) || ! is_string( $taxonomy[2] ) ) {
			wp_die( __( 'It is required to pass a single, plural and slug string to Taxonomy_Core', 'wp-timeliner' ) );
		}

		$this->singular      = $taxonomy[0];
		$this->plural        = ! isset( $taxonomy[1] ) || ! is_string( $taxonomy[1] ) ? $taxonomy[0] .'s' : $taxonomy[1];
		$this->taxonomy      = ! isset( $taxonomy[2] ) || ! is_string( $taxonomy[2] ) ? sanitize_title( $this->plural ) : $taxonomy[2];
		$this->arg_overrides = (array) $arg_overrides;
		$this->object_types  = (array) $object_types;
	}

	/**
	 * Register all the hooks!
	 *
	 * @return void
	 */
	public function hooks() {
		add_action( 'init', [ $this, 'register_taxonomy' ], 5 );
	}

	/**
	 * Gets the passed in arguments combined with our defaults.
	 *
	 * @return array  Taxonomy arguments array
	 */
	public function get_args() {
		if ( ! empty( $this->taxonomy_args ) ) {
			return $this->taxonomy_args;
		}

		// Hierarchical check that will be used multiple times below.
		$hierarchical = true;

		if ( isset( $this->arg_overrides['hierarchical'] ) ) {
			$hierarchical = (bool) $this->arg_overrides['hierarchical'];
		}

		// Generate CPT labels.
		$labels = [
			'name'                       => $this->plural,
			'singular_name'              => $this->singular,
			'search_items'               => sprintf( __( 'Search %s', 'wp-timeliner' ), $this->plural ),
			'all_items'                  => sprintf( __( 'All %s', 'wp-timeliner' ), $this->plural ),
			'edit_item'                  => sprintf( __( 'Edit %s', 'wp-timeliner' ), $this->singular ),
			'view_item'                  => sprintf( __( 'View %s', 'wp-timeliner' ), $this->singular ),
			'update_item'                => sprintf( __( 'Update %s', 'wp-timeliner' ), $this->singular ),
			'add_new_item'               => sprintf( __( 'Add New %s', 'wp-timeliner' ), $this->singular ),
			'new_item_name'              => sprintf( __( 'New %s Name', 'wp-timeliner' ), $this->singular ),
			'not_found'                  => sprintf( __( 'No %s found.', 'wp-timeliner' ), $this->plural ),
			'no_terms'                   => sprintf( __( 'No %s', 'wp-timeliner' ), $this->plural ),

			// Hierarchical stuff.
			'parent_item'       => $hierarchical ? sprintf( __( 'Parent %s', 'wp-timeliner' ), $this->singular ) : null,
			'parent_item_colon' => $hierarchical ? sprintf( __( 'Parent %s:', 'wp-timeliner' ), $this->singular ) : null,

			// Non-hierarchical stuff.
			'popular_items'              => $hierarchical ? null : sprintf( __( 'Popular %s', 'wp-timeliner' ), $this->plural ),
			'separate_items_with_commas' => $hierarchical ? null : sprintf( __( 'Separate %s with commas', 'wp-timeliner' ), $this->plural ),
			'add_or_remove_items'        => $hierarchical ? null : sprintf( __( 'Add or remove %s', 'wp-timeliner' ), $this->plural ),
			'choose_from_most_used'      => $hierarchical ? null : sprintf( __( 'Choose from the most used %s', 'wp-timeliner' ), $this->plural ),
		];

		$defaults = [
			'labels'            => [],
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'rewrite'           => [ 'hierarchical' => $hierarchical, 'slug' => $this->taxonomy ],
		];

		$this->taxonomy_args           = wp_parse_args( $this->arg_overrides, $defaults );
		$this->taxonomy_args['labels'] = wp_parse_args( $this->taxonomy_args['labels'], $labels );

		return $this->taxonomy_args;
	}

	/**
	 * Actually registers our Taxonomy with the merged arguments
	 */
	public function register_taxonomy() {
		global $wp_taxonomies;

		// Register our Taxonomy.
		$args = register_taxonomy( $this->taxonomy, $this->object_types, $this->get_args() );

		// If error, yell about it.
		if ( is_wp_error( $args ) ) {
			wp_die( $args->get_error_message() );
		}

		// Success. Set args to what WP returns.
		$this->taxonomy_args = $wp_taxonomies[ $this->taxonomy ];

		// Add this taxonomy to our taxonomies array
		self::$taxonomies[ $this->taxonomy ] = $this;
	}
}
