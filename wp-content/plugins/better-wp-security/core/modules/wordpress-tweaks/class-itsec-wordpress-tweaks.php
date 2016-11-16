<?php

final class ITSEC_WordPress_Tweaks {
	private static $instance = false;

	private $config_hooks_added = false;
	private $settings;
	private $first_xmlrpc_credentials;


	private function __construct() {
		$this->init();
	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function activate() {
		$self = self::get_instance();

		$self->add_config_hooks();
		ITSEC_Response::regenerate_server_config();
		ITSEC_Response::regenerate_wp_config();
	}

	public static function deactivate() {
		$self = self::get_instance();

		$self->remove_config_hooks();
		ITSEC_Response::regenerate_server_config();
		ITSEC_Response::regenerate_wp_config();
	}

	public function add_config_hooks() {
		if ( $this->config_hooks_added ) {
			return;
		}

		add_filter( 'itsec_filter_apache_server_config_modification', array( $this, 'filter_apache_server_config_modification' ) );
		add_filter( 'itsec_filter_nginx_server_config_modification', array( $this, 'filter_nginx_server_config_modification' ) );
		add_filter( 'itsec_filter_litespeed_server_config_modification', array( $this, 'filter_litespeed_server_config_modification' ) );
		add_filter( 'itsec_filter_wp_config_modification', array( $this, 'filter_wp_config_modification' ) );

		$this->config_hooks_added = true;
	}

	public function remove_config_hooks() {
		remove_filter( 'itsec_filter_apache_server_config_modification', array( $this, 'filter_apache_server_config_modification' ) );
		remove_filter( 'itsec_filter_nginx_server_config_modification', array( $this, 'filter_nginx_server_config_modification' ) );
		remove_filter( 'itsec_filter_litespeed_server_config_modification', array( $this, 'filter_litespeed_server_config_modification' ) );
		remove_filter( 'itsec_filter_wp_config_modification', array( $this, 'filter_wp_config_modification' ) );

		$this->config_hooks_added = false;
	}

	public function init() {
		$this->add_config_hooks();


		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			// Don't risk blocking anything with WP_CLI.
			return;
		}


		$this->settings = ITSEC_Modules::get_settings( 'wordpress-tweaks' );

		add_action( 'wp_print_scripts', array( $this, 'store_jquery_version' ) );

		// Functional code for the allow_xmlrpc_multiauth setting.
		if ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST && ! $this->settings['allow_xmlrpc_multiauth'] ) {
			add_filter( 'authenticate', array( $this, 'block_multiauth_attempts' ), 0, 3 );
		}

		//remove wlmanifest link if turned on
		if ( $this->settings['wlwmanifest_header'] ) {
			remove_action( 'wp_head', 'wlwmanifest_link' );
		}

		//remove rsd link from header if turned on
		if ( $this->settings['edituri_header'] ) {
			remove_action( 'wp_head', 'rsd_link' );
		}

		//Disable XML-RPC
		if ( 2 == $this->settings['disable_xmlrpc'] ) {
			add_filter( 'xmlrpc_enabled', '__return_null' );
			add_filter( 'bloginfo_url', array( $this, 'remove_pingback_url' ), 10, 2 );
		} else if ( 1 == $this->settings['disable_xmlrpc'] ) {
			add_filter( 'xmlrpc_methods', array( $this, 'xmlrpc_methods' ) );
		}

		if ( $this->settings['safe_jquery'] ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'current_jquery' ) );
		}

		//Process remove login errors
		if ( $this->settings['login_errors'] ) {
			add_filter( 'login_errors', '__return_null' );
		}

		//Process require unique nicename
		if ( $this->settings['force_unique_nicename'] ) {
			add_action( 'user_profile_update_errors', array( $this, 'force_unique_nicename' ), 10, 3 );
		}

		//Process remove extra author archives
		if ( $this->settings['disable_unused_author_pages'] ) {
			add_action( 'template_redirect', array( $this, 'disable_unused_author_pages' ) );
		}

	}

	public function block_multiauth_attempts( $filter_val, $username, $password ) {
		if ( empty( $this->first_xmlrpc_credentials ) ) {
			$this->first_xmlrpc_credentials = array(
				$username,
				$password
			);

			return $filter_val;
		}

		if ( $username === $this->first_xmlrpc_credentials[0] && $password === $this->first_xmlrpc_credentials[1] ) {
			return $filter_val;
		}

		status_header( 405 );
		header( 'Content-Type: text/plain' );
		die( __( 'XML-RPC services are disabled on this site.' ) );
	}

	public function current_jquery() {

		global $itsec_is_old_admin;

		if ( ! is_admin() && ! $itsec_is_old_admin ) {

			wp_deregister_script( 'jquery' );
			wp_deregister_script( 'jquery-core' );

			wp_register_script( 'jquery', false, array( 'jquery-core', 'jquery-migrate' ), '1.11.0' );
			wp_register_script( 'jquery-core', '/' . WPINC . '/js/jquery/jquery.js', false, '1.11.0' );

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-core' );

		}

	}

	/**
	 * Redirects to 404 page if the requested author has 0 posts.
	 *
	 * @since 4.0
	 *
	 * @return void
	 */
	public function disable_unused_author_pages() {

		global $wp_query;

		if ( is_author() && $wp_query->post_count < 1 ) {

			ITSEC_Lib::set_404();

		}

	}

	/**
	 * Requires a unique nicename on profile update or activate.
	 *
	 * @since 4.0
	 *
	 * @return void
	 */
	public function force_unique_nicename( &$errors, $update, &$user ) {

		$display_name = isset( $user->display_name ) ? $user->display_name : wp_generate_password( 14, false );

		if ( ! empty( $user->nickname ) ) {

			if ( $user->nickname == $user->user_login ) {

				$errors->add( 'user_error', __( 'Your Nickname must be different than your login name. Please choose a different Nickname.', 'better-wp-security' ) );

			} else {

				$user->user_nicename = sanitize_title( $user->nickname, $display_name );

			}

		} elseif ( ! empty( $user->first_name ) && ! empty( $user->last_name ) ) {

			$full_name = $user->first_name . ' ' . $user->last_name;

			$user->nickname = $full_name;

			$user->user_nicename = sanitize_title( $full_name, $display_name );

		} else {

			$errors->add( 'user_error', __( 'A Nickname is required. Please choose a nickname or fill out your first and last name.', 'better-wp-security' ) );

		}

	}

	/**
	 * Gets the version of jQuery enqueued
	 */
	function store_jquery_version() {
		global $wp_scripts;

		if ( ( is_home() || is_front_page() ) && is_user_logged_in() ) {
			$stored_jquery_version = ITSEC_Modules::get_setting( 'wordpress-tweaks', 'jquery_version' );
			$current_jquery_version = $wp_scripts->registered['jquery']->ver;

			if ( $current_jquery_version !== $stored_jquery_version ) {
				ITSEC_Modules::set_setting( 'wordpress-tweaks', 'jquery_version', $current_jquery_version );
			}
		}
	}

	/**
	 * Removes the pingback header
	 *
	 * @param string $output
	 * @param string $show
	 *
	 * @return array
	 */
	function remove_pingback_url( $output, $show ) {

		if ( $show == 'pingback_url' ) {
			$output = '';
		}

		return $output;
	}

	/**
	 * removes version number on header scripts
	 *
	 * @param string $src script source link
	 *
	 * @return string script source link without version
	 */
	function remove_script_version( $src ) {

		if ( strpos( $src, 'ver=' ) ) {
			return substr( $src, 0, strpos( $src, 'ver=' ) - 1 );
		} else {
			return $src;
		}

	}

	/**
	 * Removes the pingback ability from XML-RPC
	 *
	 * @since 4.0.20
	 *
	 * @param array $methods XML-RPC methods
	 *
	 * @return array XML-RPC methods
	 */
	public function xmlrpc_methods( $methods ) {

		if ( isset( $methods['pingback.ping'] ) ) {
			unset( $methods['pingback.ping'] );
		}

		if ( isset( $methods['pingback.extensions.getPingbacks'] ) ) {
			unset( $methods['pingback.extensions.getPingbacks'] );
		}

		return $methods;

	}


	public function filter_wp_config_modification( $modification ) {
		require_once( dirname( __FILE__ ) . '/config-generators.php' );

		return ITSEC_WordPress_Tweaks_Config_Generators::filter_wp_config_modification( $modification );
	}

	public function filter_apache_server_config_modification( $modification ) {
		require_once( dirname( __FILE__ ) . '/config-generators.php' );

		return ITSEC_WordPress_Tweaks_Config_Generators::filter_apache_server_config_modification( $modification );
	}

	public function filter_nginx_server_config_modification( $modification ) {
		require_once( dirname( __FILE__ ) . '/config-generators.php' );

		return ITSEC_WordPress_Tweaks_Config_Generators::filter_nginx_server_config_modification( $modification );
	}

	public function filter_litespeed_server_config_modification( $modification ) {
		require_once( dirname( __FILE__ ) . '/config-generators.php' );

		return ITSEC_WordPress_Tweaks_Config_Generators::filter_litespeed_server_config_modification( $modification );
	}
}


ITSEC_WordPress_Tweaks::get_instance();
