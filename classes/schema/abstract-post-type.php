<?php

namespace WP_Timeliner\Schema;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Post type creation helper class.
 *
 * @author WebDevStudios
 * @link https://github.com/WebDevStudios/Abstract_Post_Type
 */
abstract class Abstract_Post_Type {
	/**
	 * Singular CPT label.
	 *
	 * @var string
	 */
	protected $singular;

	/**
	 * Plural CPT label.
	 *
	 * @var string
	 */
	protected $plural;

	/**
	 * Registered CPT name/slug.
	 *
	 * @var string
	 */
	protected $post_type;

	/**
	 * Optional argument overrides passed in from the constructor.
	 *
	 * @var array
	 */
	protected $arg_overrides = [];

	/**
	 * All CPT registration arguments.
	 *
	 * @var array
	 */
	protected $cpt_args = [];

	/**
	 * An array of each Abstract_Post_Type object registered with this class.
	 *
	 * @var array
	 */
	protected static $custom_post_types = [];

	/**
	 * Constructor. Builds our CPT.
	 *
	 * @param array $cpt           Array with Singular, Plural, and Registered (slug).
	 * @param array $arg_overrides CPT registration override arguments.
	 */
	public function __construct( array $cpt, $arg_overrides = [] ) {
		if ( ! is_array( $cpt ) ) {
			wp_die( __( 'It is required to pass a single, plural and slug string to Abstract_Post_Type', 'wp-timeliner' ) );
		}

		if ( ! isset( $cpt[0], $cpt[1], $cpt[2] ) ) {
			wp_die( __( 'It is required to pass a single, plural and slug string to Abstract_Post_Type', 'wp-timeliner' ) );
		}

		if ( ! is_string( $cpt[0] ) || ! is_string( $cpt[1] ) || ! is_string( $cpt[2] ) ) {
			wp_die( __( 'It is required to pass a single, plural and slug string to Abstract_Post_Type', 'wp-timeliner' ) );
		}

		$this->singular  = $cpt[0];
		$this->plural    = ! isset( $cpt[1] ) || ! is_string( $cpt[1] ) ? $cpt[0] . 's' : $cpt[1];
		$this->post_type = ! isset( $cpt[2] ) || ! is_string( $cpt[2] ) ? sanitize_title( $this->plural ) : $cpt[2];
		$this->arg_overrides = (array) $arg_overrides;
	}

	/**
	 * Register all the hooks!
	 *
	 * @return void
	 */
	public function hooks() {
		add_action( 'init', [ $this, 'register_post_type' ] );
		add_filter( 'post_updated_messages', [ $this, 'messages' ] );
		add_filter( 'bulk_post_updated_messages', [ $this, 'bulk_messages' ], 10, 2 );
		add_filter( 'manage_edit-' . $this->post_type . '_columns', [ $this, 'columns' ] );
		add_filter( 'manage_edit-' . $this->post_type . '_sortable_columns', [ $this, 'sortable_columns' ] );

		// Different column registration for pages/posts.
		$h = isset( $this->arg_overrides['hierarchical'] ) && $this->arg_overrides['hierarchical'] ? 'pages' : 'posts';
		add_action( "manage_{$h}_custom_column", [ $this, 'columns_display' ], 10, 2 );
		add_filter( 'enter_title_here', [ $this, 'title' ] );
	}

	/**
	 * Get the requested CPT argument
	 *
	 * @param string $arg The argument to get.
	 * @return array|false CPT argument
	 */
	public function get_arg( $arg ) {
		$args = $this->get_args();

		if ( isset( $args->{$arg} ) ) {
			return $args->{$arg};
		}

		if ( is_array( $args ) && isset( $args[ $arg ] ) ) {
			return $args[ $arg ];
		}

		return false;
	}

	/**
	 * Gets the passed in arguments combined with our defaults.
	 *
	 * @return array CPT arguments array
	 */
	public function get_args() {
		if ( ! empty( $this->cpt_args ) ) {
			return $this->cpt_args;
		}

		// Generate CPT labels.
		$labels = [
			'name'                  => $this->plural,
			'singular_name'         => $this->singular,
			'add_new'               => sprintf( __( 'Add New %s', 'wp-timeliner' ), $this->singular ),
			'add_new_item'          => sprintf( __( 'Add New %s', 'wp-timeliner' ), $this->singular ),
			'edit_item'             => sprintf( __( 'Edit %s', 'wp-timeliner' ), $this->singular ),
			'new_item'              => sprintf( __( 'New %s', 'wp-timeliner' ), $this->singular ),
			'all_items'             => sprintf( __( 'All %s', 'wp-timeliner' ), $this->plural ),
			'view_item'             => sprintf( __( 'View %s', 'wp-timeliner' ), $this->singular ),
			'search_items'          => sprintf( __( 'Search %s', 'wp-timeliner' ), $this->plural ),
			'not_found'             => sprintf( __( 'No %s', 'wp-timeliner' ), $this->plural ),
			'not_found_in_trash'    => sprintf( __( 'No %s found in Trash', 'wp-timeliner' ), $this->plural ),
			'parent_item_colon'     => isset( $this->arg_overrides['hierarchical'] ) && $this->arg_overrides['hierarchical'] ? sprintf( __( 'Parent %s:', 'wp-timeliner' ), $this->singular ) : null,
			'menu_name'             => $this->plural,
			'insert_into_item'      => sprintf( __( 'Insert into %s', 'wp-timeliner' ), strtolower( $this->singular ) ),
			'uploaded_to_this_item' => sprintf( __( 'Uploaded to this %s', 'wp-timeliner' ), strtolower( $this->singular ) ),
			'items_list'            => sprintf( __( '%s list', 'wp-timeliner' ), $this->plural ),
			'items_list_navigation' => sprintf( __( '%s list navigation', 'wp-timeliner' ), $this->plural ),
			'filter_items_list'     => sprintf( __( 'Filter %s list', 'wp-timeliner' ), strtolower( $this->plural ) )
		];

		// Set default CPT parameters.
		$defaults = [
			'labels'             => [],
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'has_archive'        => true,
			'supports'           => [ 'title', 'editor', 'excerpt' ],
		];

		$this->cpt_args           = wp_parse_args( $this->arg_overrides, $defaults );
		$this->cpt_args['labels'] = wp_parse_args( $this->cpt_args['labels'], $labels );

		return $this->cpt_args;
	}

	/**
	 * Actually registers our CPT with the merged arguments
	 */
	public function register_post_type() {
		// Register our CPT.
		$args = register_post_type( $this->post_type, $this->get_args() );

		// If error, yell about it.
		if ( is_wp_error( $args ) ) {
			wp_die( $args->get_error_message() );
		}

		// Success. Set args to what WP returns.
		$this->cpt_args = $args;

		// Add this post type to our custom_post_types array.
		self::$custom_post_types[ $this->post_type ] = $this;
	}

	/**
	 * Modifies CPT based messages to include our CPT labels
	 *
	 * @param  array  $messages Array of messages.
	 * @return array            Modified messages array
	 */
	public function messages( $messages ) {
		global $post, $post_ID;

		$cpt_messages = [
			0 => '', // Unused. Messages start at index 1.
			2 => __( 'Custom field updated.' ),
			3 => __( 'Custom field deleted.' ),
			4 => sprintf( __( '%1$s updated.', 'wp-timeliner' ), $this->singular ),
			5 => isset( $_GET['revision'] ) ? sprintf( __( '%1$s restored to revision from %2$s', 'wp-timeliner' ), $this->singular , wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			7 => sprintf( __( '%1$s saved.', 'wp-timeliner' ), $this->singular ),
		];

		if ( $this->get_arg( 'public' ) ) {
			$cpt_messages[1] = sprintf( __( '%1$s updated. <a href="%2$s">View %1$s</a>', 'wp-timeliner' ), $this->singular, esc_url( get_permalink( $post_ID ) ) );
			$cpt_messages[6] = sprintf( __( '%1$s published. <a href="%2$s">View %1$s</a>', 'wp-timeliner' ), $this->singular, esc_url( get_permalink( $post_ID ) ) );
			$cpt_messages[8] = sprintf( __( '%1$s submitted. <a target="_blank" href="%2$s">Preview %1$s</a>', 'wp-timeliner' ), $this->singular, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) );
			$cpt_messages[9] = sprintf( __( '%1$s scheduled for: <strong>%2$s</strong>. <a target="_blank" href="%3$s">Preview %1$s</a>', 'wp-timeliner' ), $this->singular, date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) );
			$cpt_messages[10] = sprintf( __( '%1$s draft updated. <a target="_blank" href="%2$s">Preview %1$s</a>', 'wp-timeliner' ), $this->singular, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) );
		} else {
			$cpt_messages[1] = sprintf( __( '%1$s updated.', 'wp-timeliner' ), $this->singular );
			$cpt_messages[6] = sprintf( __( '%1$s published.', 'wp-timeliner' ), $this->singular );
			$cpt_messages[8] = sprintf( __( '%1$s submitted.', 'wp-timeliner' ), $this->singular );
			$cpt_messages[9] = sprintf( __( '%1$s scheduled for: <strong>%2$s</strong>.', 'wp-timeliner' ), $this->singular, date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) );
			$cpt_messages[10] = sprintf( __( '%1$s draft updated.', 'wp-timeliner' ), $this->singular );
		}

		$messages[ $this->post_type ] = $cpt_messages;

		return $messages;
	}

	/**
	 * Custom bulk actions messages for this post type.
	 *
	 * @author Neil Lowden
	 * @param array $bulk_messages Array of messages.
	 * @param array $bulk_counts   Array of counts under keys 'updated', 'locked', 'deleted', 'trashed' and 'untrashed'.
	 * @return array               Modified array of messages
	 */
	public function bulk_messages( $bulk_messages, $bulk_counts ) {
		$bulk_messages[ $this->post_type ] = [
			'updated'   => sprintf( _n( '%1$s %2$s updated.', '%1$s %3$s updated.', $bulk_counts['updated'], 'wp-timeliner' ), $bulk_counts['updated'], $this->singular, $this->plural ),
			'locked'    => sprintf( _n( '%1$s %2$s not updated, somebody is editing it.', '%1$s %3$s not updated, somebody is editing them.', $bulk_counts['locked'], 'wp-timeliner' ), $bulk_counts['locked'], $this->singular, $this->plural ),
			'deleted'   => sprintf( _n( '%1$s %2$s permanently deleted.', '%1$s %3$s permanently deleted.', $bulk_counts['deleted'], 'wp-timeliner' ), $bulk_counts['deleted'], $this->singular, $this->plural ),
			'trashed'   => sprintf( _n( '%1$s %2$s moved to the Trash.', '%1$s %3$s moved to the Trash.', $bulk_counts['trashed'], 'wp-timeliner' ), $bulk_counts['trashed'], $this->singular, $this->plural ),
			'untrashed' => sprintf( _n( '%1$s %2$s restored from the Trash.', '%1$s %3$s restored from the Trash.', $bulk_counts['untrashed'], 'wp-timeliner' ), $bulk_counts['untrashed'], $this->singular, $this->plural ),
		];
		return $bulk_messages;
	}

	/**
	 * PLACEHOLDER: Registers admin columns to display. To be overridden by an extended class.
	 *
	 * @param array $columns Array of registered column names/labels.
	 * @return array Modified array.
	 */
	public function columns( $columns ) {
		return $columns;
	}

	/**
	 * PLACEHOLDER: Registers which columns are sortable. To be overridden by an extended class.
	 *
	 * @param array $sortable_columns Array of registered column keys => data-identifier.
	 * @return array Modified array.
	 */
	public function sortable_columns( $sortable_columns ) {
		return $sortable_columns;
	}

	/**
	 * PLACEHOLDER: Handles admin column display. To be overridden by an extended class.
	 *
	 * @param array $column  Array of registered column names.
	 * @param int   $post_id The Post ID.
	 */
	public function columns_display( $column, $post_id ) {}

	/**
	 * Filter CPT title entry placeholder text
	 * @since  0.1.0
	 * @param  string $title Original placeholder text
	 * @return string        Modified placeholder text
	 */
	public function title( $title ) {
		if ( $this->is_edit_admin_page() ) {
			return sprintf( __( '%s Title', 'wp-timeliner' ), $this->singular );
		}

		return $title;
	}

	/**
	 * Are we currently creating/editing a $this->post_type post?
	 *
	 * @return boolean
	 */
	protected function is_edit_admin_page() {
		/**
		 * @todo See https://github.com/WordPress/gutenberg/issues/9899
		 */
		if ( function_exists( 'get_current_screen' ) ) {
			$screen = get_current_screen();
			return ( isset( $screen->post_type ) && $screen->post_type == $this->post_type );
		}

		return ( isset( $_GET['post_type'] ) && $_GET['post_type'] === $this->post_type ) || ( isset( $_GET['post'] ) && get_post_type( (int) $_GET['post'] ) === $this->post_type );
	}
}
