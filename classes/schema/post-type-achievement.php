<?php

namespace WP_Timeliner\Schema;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Helpers;

/**
 * Achievement post type
 */
class Post_Type_Achievement extends Abstract_Post_Type implements Has_Hooks {
	/**
	 * Post type slug.
	 *
	 * @var string
	 */
	const POST_TYPE = 'wpt-achievement';

	/**
	 * Register the Achievement post type
	 */
	public function __construct() {
		parent::__construct(
			[
				esc_html__( 'Achievement', 'wp-timeliner' ),
				esc_html__( 'Achievements', 'wp-timeliner' ),
				self::POST_TYPE,
			],
			[
				'supports'  => [
					'title',
					'editor',
					'excerpt',
					'thumbnail',
				],
				//'menu_icon'   => 'dashicons-list-view',
				//'menu_icon'   => TIMELINER_ASSETS_URL . '/images/wp-timeliner-icon.svg',
				'menu_icon'   => 'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill="black" d="m5.173 16.49c-0.197 0.653-0.812 1.135-1.531 1.135-0.876 0-1.597-0.714-1.599-1.582-0.018-0.733 0.491-1.383 1.213-1.547v-2.949c-0.732-0.158-1.258-0.805-1.258-1.547s0.526-1.389 1.258-1.547v-2.949c-0.722-0.164-1.231-0.814-1.213-1.548 2e-3 -0.868 0.723-1.581 1.599-1.581 0.662 0 1.236 0.408 1.477 0.983h1.819c4e-3 -0.016 7e-3 -0.031 0.011-0.046 0.228-0.883 1.066-1.547 1.989-1.582 1.183-0.015 2.367-0.022 3.551-0.023l0.222 1e-3c1.109 1e-3 2.219 8e-3 3.328 0.022 0.923 0.035 1.762 0.699 1.989 1.582 0.327 1.269-0.722 2.588-1.989 2.636-1.183 0.015-2.367 0.022-3.55 0.023l-0.222-1e-3c-1.11-1e-3 -2.219-8e-3 -3.329-0.022-0.926-0.035-1.736-0.75-1.977-1.627h-1.774l-2e-3 0.045c-0.151 0.559-0.605 1.007-1.194 1.138v2.949c0.56 0.126 0.996 0.542 1.16 1.065h1.787c4e-3 -0.015 7e-3 -0.03 0.011-0.045 0.228-0.883 1.066-1.547 1.989-1.582 1.183-0.015 2.367-0.022 3.551-0.023l0.222 1e-3c1.109 1e-3 2.219 8e-3 3.328 0.022 0.923 0.035 1.762 0.699 1.989 1.582 0.327 1.269-0.722 2.588-1.989 2.636-1.183 0.015-2.367 0.022-3.55 0.023l-0.222-1e-3c-1.11-1e-3 -2.219-8e-3 -3.329-0.022-0.926-0.035-1.736-0.75-1.977-1.627h-1.81c-0.164 0.523-0.6 0.939-1.16 1.065v2.949c0.551 0.122 0.984 0.523 1.161 1.031h1.786c4e-3 -0.015 7e-3 -0.03 0.011-0.045 0.228-0.883 1.066-1.547 1.989-1.582 1.183-0.015 2.367-0.022 3.551-0.023h0.222c1.109 1e-3 2.219 9e-3 3.328 0.023 0.923 0.035 1.762 0.699 1.989 1.582 0.327 1.269-0.722 2.587-1.989 2.636-1.183 0.015-2.367 0.022-3.55 0.022h-0.222c-1.11-1e-3 -2.219-8e-3 -3.329-0.022-0.926-0.036-1.736-0.75-1.977-1.628h-1.788zm7.426 0.722c1.139-9e-3 2.278-0.03 3.416-0.044 0.498-0.019 0.951-0.37 1.086-0.842 0.201-0.709-0.398-1.467-1.119-1.477-1.092 0-2.183-6e-3 -3.275-0.01h-0.218c-1.165 3e-3 -2.329 0.01-3.494 0.01-0.72 0.01-1.32 0.768-1.118 1.477 0.134 0.472 0.587 0.823 1.085 0.842 1.175 0.015 2.351 0.037 3.527 0.044h0.11zm-8.964-1.862c0.4 0 0.725 0.325 0.725 0.725 0 0.401-0.325 0.726-0.725 0.726-0.401 0-0.726-0.325-0.726-0.726 0-0.4 0.325-0.725 0.726-0.725zm8.964-4.147c1.139-8e-3 2.278-0.03 3.416-0.044 0.498-0.019 0.951-0.37 1.086-0.842 0.201-0.709-0.398-1.467-1.119-1.476-1.092 0-2.183-7e-3 -3.275-0.011h-0.218c-1.165 3e-3 -2.329 0.011-3.494 0.011-0.72 9e-3 -1.32 0.767-1.118 1.476 0.134 0.472 0.587 0.823 1.085 0.842 1.175 0.015 2.351 0.037 3.527 0.045l0.11-1e-3zm-8.964-1.92c0.4 0 0.725 0.325 0.725 0.725 0 0.401-0.325 0.726-0.725 0.726-0.401 0-0.726-0.325-0.726-0.726 0-0.4 0.325-0.725 0.726-0.725zm8.964-4.241c1.139-8e-3 2.278-0.03 3.416-0.044 0.498-0.019 0.951-0.37 1.086-0.842 0.201-0.709-0.398-1.467-1.119-1.476-1.092 0-2.183-7e-3 -3.275-0.011h-0.218c-1.165 3e-3 -2.329 0.011-3.494 0.011-0.72 9e-3 -1.32 0.767-1.118 1.476 0.134 0.472 0.587 0.823 1.085 0.842 1.175 0.015 2.351 0.037 3.527 0.045l0.11-1e-3zm-8.964-1.849c0.4 0 0.725 0.325 0.725 0.725s-0.325 0.725-0.725 0.725c-0.401 0-0.726-0.325-0.726-0.725s0.325-0.725 0.726-0.725z"/></svg>'),
				'public'      => true,
				'has_archive' => false,
				'rewrite'     => [
					'slug'       => $this->get_slug(),
					'with_front' => true,
				],
				'show_in_rest' => true,
				'labels'       => [
					'menu_name'    => esc_html__( 'Timelines', 'wp-timeliner' ),
					'add_new'      => esc_html__( 'New Achievement', 'wp-timeliner' ),
					'add_new_item' => esc_html__( 'New Achievement', 'wp-timeliner' ),
				],
			]
		);
	}

	/**
	 * Register necessary hooks.
	 */
	public function hooks() {
		parent::hooks();

		add_filter( 'gettext', [ $this, 'change_excerpt_title' ], 10, 3 );
		add_action( 'admin_head', [ $this, 'custom_css_on_achievement_edit_page' ] );
		add_action( 'admin_head', [ $this, 'fix_gutenberg410_metabox_visibility' ] );
	}

	/**
	 * Retrieve the Achievement slug in options
	 *
	 * @return string The slug defined by user/default slug.
	 */
	protected function get_slug() {
		return sanitize_title_with_dashes( Helpers::get_option( 'achievement_slug', 'achievement', false ) );
	}

	/**
	 * Change the exerpt metabox
	 *
	 * @param string $excerpt The default Excerpt title.
	 * @return string
	 */
	public function change_excerpt_title( $excerpt, $text, $domain ) {
		if ( $text === 'Excerpt' && $domain === 'default' ) {
			if ( $this->is_edit_admin_page() ) {
				return __( 'Achievement summary', 'wp-timeliner' );
			}
		}

		return $excerpt;
	}

	/**
	 * Add some custom CSS on the Achievement edit page.
	 */
	public function custom_css_on_achievement_edit_page() {
		if ( $this->is_edit_admin_page() ) {
			echo '<style>#postexcerpt textarea + p { display:none; }</style>';
		}
	}

	/**
	 * Fix Gutenberg 4.1.0 metabox-disappearing-bug
	 */
	public function fix_gutenberg410_metabox_visibility() {
		if ( $this->is_edit_admin_page() ) {
			echo '<style>[id^=carbon_fields_container_] { display:block !important; }</style>';
		}
	}
}
