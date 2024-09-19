<?php
declare( strict_types = 1 );

namespace MyPluginNamespace\Frontend;

defined( 'ABSPATH' ) || exit;

class Frontend {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private string $plugin_name;

	/**
	 * The Prefix ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_prefix The prefix used for this plugin.
	 */
	private string $plugin_prefix;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private string $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $plugin_prefix
	 * @param string $version The version of this plugin.
	 *
	 * @since       1.0.0
	 */
	public function __construct( string $plugin_name, string $plugin_prefix, string $version ) {
		$this->plugin_name   = $plugin_name;
		$this->plugin_prefix = $plugin_prefix;
		$this->version       = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles(): void {
		$style_path = MY_PLUGIN_DIR_URL . 'assets/css/frontend.css';

		if ( file_exists( MY_PLUGIN_DIR_PATH . 'assets/css/frontend.css' ) ) {
			wp_enqueue_style( $this->plugin_name, $style_path, array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts(): void {
		$script_path = MY_PLUGIN_DIR_URL . 'assets/js/frontend.js';

		if ( file_exists( MY_PLUGIN_DIR_PATH . 'assets/js/frontend.js' ) ) {
			wp_enqueue_script( $this->plugin_name, $script_path, array( 'jquery' ), $this->version, false );
		}
	}

	/**
	 * Register the JavaScript and stylesheets for the public-facing side of the site using React.
	 *
	 * @return void
	 */
	public function enqueue_scripts_react(): void {
		$asset_file = MY_PLUGIN_DIR_PATH . 'assets/public/build/index.asset.php';

		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$asset = include $asset_file;

		wp_enqueue_script(
			'my-plugin-public-script',
			MY_PLUGIN_DIR_URL . 'assets/public/build/index.js',
			$asset['dependencies'],
			$asset['version'],
			array(
				'in_footer' => true,
			)
		);

		wp_enqueue_style(
			'my-plugin-public-style',
			MY_PLUGIN_DIR_URL . 'assets/public/build/index.css',
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
	 * Displays a shortcode for embedding a React application in a WordPress post or page.
	 *
	 * @return string The HTML string to embed the React application.
	 */
	public function display_shortcode_my_react_app(): string {
		return ( '<div id="my-plugin-frontend"></div>' );
	}
}
