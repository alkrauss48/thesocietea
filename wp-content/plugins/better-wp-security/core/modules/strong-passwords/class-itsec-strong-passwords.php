<?php

class ITSEC_Strong_Passwords {

	function run() {

		add_action( 'user_profile_update_errors', array( $this, 'enforce_strong_password' ), 0, 3 );
		add_action( 'validate_password_reset', array( $this, 'enforce_strong_password' ), 10, 2 );

		if ( isset( $_GET['action'] ) && ( $_GET['action'] == 'rp' || $_GET['action'] == 'resetpass' ) && isset( $_GET['login'] ) ) {
			add_action( 'login_head', array( $this, 'enforce_strong_password' ) );
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'add_scripts' ) );

	}

	/**
	 * Enqueue script to check password strength
	 *
	 * @return void
	 */
	public function add_scripts() {

		global $itsec_globals;

		$module_path = ITSEC_Lib::get_module_path( __FILE__ );

		wp_enqueue_script( 'itsec_strong_passwords', $module_path . 'js/script.js', array( 'jquery' ), ITSEC_Core::get_plugin_build() );

	}

	/**
	 * Require strong passwords
	 *
	 * Requires new passwords set are strong passwords
	 *
	 * @param object $errors WordPress errors
	 *
	 * @return object WordPress error object
	 *
	 **/
	function enforce_strong_password( $errors ) {
		$args = func_get_args();

		$settings = ITSEC_Modules::get_settings( 'strong-passwords' );

		//determine the minimum role for enforcement
		$min_role = isset( $settings['role'] ) ? $settings['role'] : 'administrator';

		//all the standard roles and level equivalents
		$available_roles = array(
			'administrator' => '8',
			'editor'        => '5',
			'author'        => '2',
			'contributor'   => '1',
			'subscriber'    => '0'
		);

		//roles and subroles
		$subroles = array(
			'administrator' => array( 'subscriber', 'author', 'contributor', 'editor' ),
			'editor'        => array( 'subscriber', 'author', 'contributor' ),
			'author'        => array( 'subscriber', 'contributor' ),
			'contributor'   => array( 'subscriber' ),
			'subscriber'    => array(),
		);

		$requires_enforcement = false;
		$args                        = func_get_args();
		$user_id                     = isset( $args[2]->user_login ) ? $args[2]->user_login : false;

		if ( $user_id === false ) { //try to get a working user ID

			if ( isset( $args[1] ) && isset( $args[1]->ID ) ) {

				if ( isset( $args[1]->user_login ) ) {

					$user_id = $args[1]->user_login;

				} else {

					$user_id = $args[1]->get( 'user_login' );
				}

			}

		}

		if ( $user_id ) { //if updating an existing user

			if ( $user_info = get_user_by( 'login', $user_id ) ) {

				foreach ( $user_info->roles as $capability ) {

					if ( isset( $available_roles[ $capability ] ) && $available_roles[ $capability ] >= $available_roles[ $min_role ] ) {
						$requires_enforcement = true;
					}

				}

			} else { //a new user

				if ( ! empty( $_POST['role'] ) && ! in_array( $_POST["role"], $subroles[ $min_role ] ) ) {
					$requires_enforcement = true;
				}

			}

		}

		if ( ! isset( $_GET['action'] ) ) {

			//add to error array if the password does not meet requirements
			if ( $requires_enforcement && ! $errors->get_error_data( 'pass' ) && isset( $_POST['pass1'] ) && trim( strlen( $_POST['pass1'] ) ) > 0 && isset( $_POST['password_strength'] ) && $_POST['password_strength'] != 'strong' ) {
				$errors->add( 'pass', __( '<strong>ERROR</strong>: You MUST Choose a password that rates at least <em>Strong</em> on the meter. Your setting have NOT been saved.', 'better-wp-security' ) );
			}

		}

		return $errors;
	}

}
