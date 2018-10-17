<?php

namespace WP_Timeliner\Frontend\Shortcodes;

use WP_Timeliner\Common\Interfaces\Has_Hooks;
use WP_Timeliner\Helpers;

/**
 * Shortcode abstract class with superpowers.
 * 
 * @link https://github.com/BeAPI/bea-plugin-boilerplate
 */
abstract class Abstract_Shortcode implements Has_Hooks {
	/**
	 * The shortcode [tag]
	 */
	protected $tag = '';

	/**
	 * List of supported attributes and their defaults
	 *
	 * @var array
	 */
	protected $default_attributes = [];

	/**
	 * Add a shortcode in the system.
	 */
	public function register_shortcode() {
		add_shortcode( $this->tag, [ $this, 'display' ] );
	}

	/**
	 * Register the shortcode.
	 */
	public function hooks() {
		$this->register_shortcode();
	}

	/**
	 * Combine the user-give attributes with the defaults attributes.
	 *
	 * @param array $attributes
	 * @return mixed
	 */
	public function get_attributes( $attributes = array() ) {
		return shortcode_atts( $this->default_attributes, $attributes, $this->tag );
	}

	/**
	 * Display the shortcode content. Pass to render() with ready-to-use attributes.
	 *
	 * @param array  $attributes
	 * @param string $content
	 *
	 * @return string
	 */
	public function display( $attributes = [], $content = '' ) {
		ob_start();
		$this->render(
			(object) $this->get_attributes( $attributes ),
			$content
		);
		return ob_get_clean();
	}

	/**
	 * Render the content.
	 *
	 * @param array $attributes
	 * @param string $content
	 * @return string The content of the shortcode. DO NOT ECHO.
	 */
	protected abstract function render( $attributes, $content );
}
