<?php
declare( strict_types = 1 );

namespace MyPluginNamespace\Admin;

defined( 'ABSPATH' ) || exit;

class Admin {
	private string $plugin_name;
	private string $plugin_prefix;
	private string $version;

	public function __construct( string $plugin_name, string $plugin_prefix, string $version ) {
		$this->plugin_name   = $plugin_name;
		$this->plugin_prefix = $plugin_prefix;
		$this->version       = $version;
	}

	/**
	 * Enqueues the admin JavaScript file for the plugin.
	 *
	 * Checks if the admin JavaScript file exists, and if so, enqueues it.
	 *
	 * @return void
	 */
	public function enqueue_scripts(): void {

		$script_path = MY_PLUGIN_DIR_URL . 'assets/admin/admin.js';

		if ( file_exists( MY_PLUGIN_DIR_PATH . 'assets/admin/admin.js' ) ) {
			wp_enqueue_script( $this->plugin_name, $script_path, array( 'jquery' ), $this->version, false );
		}
	}

	/**
	 * Enqueues the React scripts and styles for the admin section of the plugin.
	 *
	 * Checks if the asset file exists, and if so, enqueues the corresponding
	 * JavaScript and CSS files with their dependencies and versioning.
	 *
	 * @return void
	 */
	public function enqueue_scripts_react(): void {
		$asset_file = MY_PLUGIN_DIR_PATH . 'assets/admin/build/index.asset.php';

		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$asset = include $asset_file;

		wp_enqueue_script(
			'my-plugin-name-script',
			MY_PLUGIN_DIR_URL . 'assets/admin/build/index.js',
			$asset['dependencies'],
			$asset['version'],
			array(
				'in_footer' => true,
			)
		);

		wp_enqueue_style(
			'my-plugin-name-style',
			MY_PLUGIN_DIR_URL . 'assets/admin/build/index.css',
			array_filter(
				$asset['dependencies'],
				function ( $style ) {
					return wp_style_is( $style, 'registered' );
				}
			),
			$asset['version'],
		);
	}

	/**
	 * Enqueues the admin stylesheet for the plugin.
	 *
	 * Checks if the admin stylesheet file exists, and if so, enqueues it.
	 *
	 * @return void
	 */
	public function enqueue_styles(): void {
		$style_path = MY_PLUGIN_DIR_URL . 'assets/admin/admin.css';

		if ( file_exists( MY_PLUGIN_DIR_PATH . 'assets/admin/admin.css' ) ) {
			wp_enqueue_style( $this->plugin_name, $style_path, array(), $this->version, 'all' );
		}
	}

	/**
	 * Registers a React-based settings page in the WordPress admin area.
	 *
	 * This method adds a new page under the "Settings" menu
	 * in the WordPress admin dashboard using the 'add_options_page' function.
	 *
	 * @return void
	 */
	public function add_react_settings_page(): void {
		add_options_page(
			__( 'Plugin Settings', 'my-plugin-name' ),
			__( 'My React Plugin', 'my-plugin-name' ),
			'manage_options',
			'my-plugin-name-settings',
			array( $this, 'display_options_page' )
		);
	}

	/**
	 * Displays the options page for the plugin.
	 *
	 * @return void
	 */
	public function display_options_page(): void {
		printf(
			'<div class="wrap" id="my-plugin-name-settings">%s</div>',
			esc_html__( 'Loading…', 'my-plugin-name' )
		);
	}
}
