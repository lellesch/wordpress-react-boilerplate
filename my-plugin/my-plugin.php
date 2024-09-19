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

use MyPluginNamespace\Core_Init;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define Constants
 */
define( 'MY_PLUGIN_NAME', 'my-plugin' );
define( 'MY_PLUGIN_PREFIX', 'my_plugin_' );
define( 'MY_PLUGIN_VERSION', '1.0.0' );
define( 'MY_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'MY_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'MY_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Autoloader von Composer laden
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

register_activation_hook( __FILE__, [ 'MyPluginNamespace\Activate', 'activate' ] );
register_deactivation_hook( __FILE__, [ 'MyPluginNamespace\Deactivate', 'deactivate' ] );

Core_Init::get_instance( MY_PLUGIN_NAME, MY_PLUGIN_PREFIX, MY_PLUGIN_VERSION );
