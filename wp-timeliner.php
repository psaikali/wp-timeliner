<?php
/**
 * Plugin Name: WP Timeliner
 * Plugin URI: https://wp-timeliner.com
 * Description: Create highly-customizable timelines in WordPress and display achievements in a chronological way.
 * Author: Pierre Saïkali
 * Author URI: https://mosaika.fr
 * Text Domain: wp-timeliner
 * Domain Path: /languages/
 * Version: 1.0.0
 */

namespace WP_Timeliner;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define plugin constants
 */
define( 'TIMELINER_VERSION', '1.0.0' );
define( 'TIMELINER_MIN_PHP_VERSION', '5.6' );
define( 'TIMELINER_URL', plugin_dir_url( __FILE__ ) );
define( 'TIMELINER_DIR', plugin_dir_path( __FILE__ ) );
define( 'TIMELINER_PLUGIN_DIRNAME', basename( rtrim( dirname( __FILE__ ), '/' ) ) );
define( 'TIMELINER_BASENAME', plugin_basename( __FILE__ ) );
define( 'TIMELINER_ASSETS_URL', TIMELINER_URL . '/assets' );

/**
 * Load Composer dependencies.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

/**
 * Register our autoloader logic.
 */
require_once TIMELINER_DIR . DIRECTORY_SEPARATOR . 'autoloader.php';
Autoloader::register();

/**
 * Include our globally usable functions.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions.php';

/**
 * Activation and de-activation hooks
 */
register_activation_hook( __FILE__, array( wp_timeliner(), 'activate' ) );
register_deactivation_hook( __FILE__, array( wp_timeliner(), 'deactivate' ) );

/**
 * Fire the fun stuff!
 */
add_action( 'plugins_loaded', array( wp_timeliner(), 'fire' ) );
