<?php
declare( strict_types = 1 );

namespace MyPluginNamespace;

use MyPluginNamespace\Admin\Admin;
use MyPluginNamespace\Frontend\Frontend;

defined( 'ABSPATH' ) || exit;

class Core_Init {
	private static $instance;

	private string $plugin_name;
	private string $plugin_prefix;
	private string $version;

	public static function get_instance( string $plugin_name, string $plugin_prefix, string $version ): Core_Init {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self( $plugin_name, $plugin_prefix, $version );
		}

		return self::$instance;
	}

	public function __construct( string $plugin_name, string $plugin_prefix, string $version ) {
		$this->plugin_name   = $plugin_name;
		$this->plugin_prefix = $plugin_prefix;
		$this->version       = $version;

		if ( is_admin() ) {
			$this->define_admin_hooks();
		} else {
			$this->define_public_hooks();
		}

		$this->load_rest_api();
	}

	private function define_admin_hooks(): void {
		$plugin_admin = new Admin( $this->plugin_name, $this->plugin_prefix, $this->version );

		// Standard Admin js css Files.
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ) );

		// React files.
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts_react' ) );
		add_action( 'admin_menu', array( $plugin_admin, 'add_react_settings_page' ) );
	}

	private function define_public_hooks(): void {
		$plugin_public = new Frontend( $this->plugin_name, $this->plugin_prefix, $this->version );

		// Standard Frontend Js Css.
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts' ) );

		// React Files.
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts_react' ) );
		add_shortcode( 'my_react_app', array( $plugin_public, 'display_shortcode_my_react_app' ) );
	}

	private function load_rest_api(): void {
		new Rest_Api();
	}
}
