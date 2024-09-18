<?php
/**
 * Plugin Name:       My Plugin Name
 * Description:       A boilerplate plugin for React applications in WordPress.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Requires at least: 6.5
 * Requires PHP:      8.1
 * Author URI:        http://example.com
 * Text Domain:       my-plugin
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

use MyPluginNamespace\Activate;
use MyPluginNamespace\Core_Init;
use MyPluginNamespace\Deactivate;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define Constants
 */
define( 'MY_PLUGIN_NAME', 'my-plugin-name' );
define( 'MY_PLUGIN_PREFIX', 'my_plugin_name_' );
define( 'MY_PLUGIN_VERSION', '1.0.0' );
define( 'MY_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'MY_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'MY_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Autoloader von Composer laden
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

function my_plugin_activate(): void {
	Activate::activate();
}

register_activation_hook( __FILE__, 'my_plugin_activate' );

function my_plugin_deactivate(): void {
	Deactivate::deactivate();
}

register_deactivation_hook( __FILE__, 'my_plugin_deactivate' );

function my_plugin_load_textdomain(): void {
	load_plugin_textdomain( 'my-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

add_action( 'plugins_loaded', 'my_plugin_load_textdomain' );

function my_plugin_init(): void {
	Core_Init::get_instance( MY_PLUGIN_NAME, MY_PLUGIN_PREFIX, MY_PLUGIN_VERSION );
}

add_action( 'plugins_loaded', 'my_plugin_init' );
