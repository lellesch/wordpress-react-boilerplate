<?php
declare(strict_types=1);

namespace MyPluginNamespace;

defined( 'ABSPATH' ) || exit;

use WP_Error;
use WP_HTTP_Response;
use WP_REST_Response;

class Rest_Api {

	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Registers the REST API routes for the plugin.
	 *
	 * @return void
	 */
	public function register_routes(): void {
		register_rest_route(
			'my-plugin/v1',
			'/data/',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_data' ),
				'permission_callback' => array( $this, 'permissions_check' ),
			)
		);
	}

	/**
	 * Retrieves data and returns it as a REST API response.
	 *
	 * @return WP_Error|WP_REST_Response|WP_HTTP_Response The API response containing the message and status.
	 */
	public function get_data(): WP_Error|WP_REST_Response|WP_HTTP_Response {
		$data = array(
			'message' => 'Hello from the REST API!',
			'status'  => 'success',
		);

		return rest_ensure_response( $data );
	}


	/**
	 * Checks if the current user has permission to manage options.
	 *
	 * @return bool Returns true if the current user can manage options, otherwise false.
	 */
	public function permissions_check(): bool {
		return current_user_can( 'manage_options' );
	}
}
