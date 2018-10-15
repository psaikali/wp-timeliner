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
				'menu_icon' => 'dashicons-exerpt-view',
				'public'    => true,
				'rewrite'   => [
					'slug'       => $this->get_slug(),
					'with_front' => true,
				],
				'labels'    => [
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
}
