<?php

/**
 * Handles lockouts for modules and core
 *
 * @package iThemes-Security
 * @since   4.0
 */
final class ITSEC_Lockout {

	private
		$core,
		$lockout_modules;

	function __construct( $core ) {

		$this->core            = $core;
		$this->lockout_modules = array(); //array to hold information on modules using this feature

		//Run database cleanup daily with cron
		if ( ! wp_next_scheduled( 'itsec_purge_lockouts' ) ) {
			wp_schedule_event( time(), 'daily', 'itsec_purge_lockouts' );
		}

		add_action( 'itsec_purge_lockouts', array( $this, 'purge_lockouts' ) );

		//Check for host lockouts
		add_action( 'init', array( $this, 'check_lockout' ) );

		// Ensure that locked out users are prevented from checking logins.
		add_filter( 'authenticate', array( $this, 'check_authenticate_lockout' ), 30 );

		// Updated temp whitelist to ensure that admin users are automatically added.
		add_action( 'init', array( $this, 'update_temp_whitelist' ), 0 );

		//Register all plugin modules
		add_action( 'plugins_loaded', array( $this, 'register_modules' ) );

		//Set an error message on improper logout
		add_action( 'login_head', array( $this, 'set_lockout_error' ) );

		//Process clear lockout form
		add_action( 'itsec_admin_init', array( $this, 'release_lockout' ) );

		//Register Logger
		add_filter( 'itsec_logger_modules', array( $this, 'register_logger' ) );

		//Register Sync
		add_filter( 'itsec_sync_modules', array( $this, 'register_sync' ) );

		add_action( 'itsec-settings-page-init', array( $this, 'init_settings_page' ) );
		add_action( 'itsec-logs-page-init', array( $this, 'init_settings_page' ) );
	}

	public function init_settings_page() {
		require_once( dirname( __FILE__ ) . '/sidebar-widget-active-lockouts.php' );
	}

	public function check_authenticate_lockout( $user ) {
		if ( ! ( $user instanceof WP_User ) ) {
			return $user;
		}

		$this->check_lockout( $user->ID );

		return $user;
	}

	/**
	 * Checks if the host or user is locked out and executes lockout
	 *
	 * @since 4.0
	 *
	 * @param mixed $user     WordPress user object or false
	 * @param mixed $username the username to check
	 *
	 * @return void
	 */
	public function check_lockout( $user = false, $username = false ) {

		global $wpdb, $itsec_globals;

		$wpdb->hide_errors(); //Hide database errors in case the tables aren't there

		$host           = ITSEC_Lib::get_ip();
		$username       = sanitize_text_field( trim( $username ) );
		$username_check = false;
		$user_check     = false;
		$host_check     = false;

		if ( $user !== false && $user !== '' && $user !== null ) {

			$user    = get_userdata( intval( $user ) );
			$user_id = $user->ID;

		} else {

			$user    = wp_get_current_user();
			$user_id = $user->ID;

			if ( $username !== false && $username != '' ) {
				$username_check = $wpdb->get_var( "SELECT `lockout_username` FROM `" . $wpdb->base_prefix . "itsec_lockouts` WHERE `lockout_active`=1 AND `lockout_expire_gmt` > '" . date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ) . "' AND `lockout_username`='" . $username . "';" );
			}

			$host_check = $wpdb->get_var( "SELECT `lockout_host` FROM `" . $wpdb->base_prefix . "itsec_lockouts` WHERE `lockout_active`=1 AND `lockout_expire_gmt` > '" . date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ) . "' AND `lockout_host`='" . $host . "';" );

		}

		if ( $user_id !== 0 && $user_id !== null ) {

			$user_check = $wpdb->get_var( "SELECT `lockout_user` FROM `" . $wpdb->base_prefix . "itsec_lockouts` WHERE `lockout_active`=1 AND `lockout_expire_gmt` > '" . date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ) . "' AND `lockout_user`=" . intval( $user_id ) . ";" );

		}

		$error = $wpdb->last_error;

		if ( strlen( trim( $error ) ) > 0 ) {
			ITSEC_Lib::create_database_tables();
		}

		if ( $host_check !== null && $host_check !== false ) {

			$this->execute_lock();

		} elseif ( ( $user_check !== false && $user_check !== null ) || ( $username_check !== false && $username_check !== null ) ) {

			$this->execute_lock( true );

		}

	}

	/**
	 * Executes lockout and logging for modules
	 *
	 * @since 4.0
	 *
	 * @param string $module string name of the calling module
	 * @param string $user   username of user
	 *
	 * @return void
	 */
	public function do_lockout( $module, $user = null ) {

		global $wpdb, $itsec_globals;

		if ( ! isset( $this->lockout_modules[$module] ) ) {
			return;
		}

		$wpdb->hide_errors(); //Hide database errors in case the tables aren't there

		$lock_host     = null;
		$lock_user     = null;
		$lock_username = null;
		$options       = $this->lockout_modules[$module];

		$host = ITSEC_Lib::get_ip();

		if ( isset( $options['host'] ) && $options['host'] > 0 ) {

			$wpdb->insert(
				$wpdb->base_prefix . 'itsec_temp',
				array(
					'temp_type'     => $options['type'],
					'temp_date'     => date( 'Y-m-d H:i:s', $itsec_globals['current_time'] ),
					'temp_date_gmt' => date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ),
					'temp_host'     => $host,
				)
			);

			$host_count = $wpdb->get_var(
				$wpdb->prepare(
					"SELECT COUNT(*) FROM `" . $wpdb->base_prefix . "itsec_temp` WHERE `temp_date_gmt` > '%s' AND `temp_host`='%s';",
					date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] - ( $options['period'] * 60 ) ),
					$host
				)
			);

			if ( $host_count >= $options['host'] ) {

				$lock_host = $host;

			}

		}

		if ( $user !== null && isset( $options['user'] ) && $options['user'] > 0 ) {

			$user_id = username_exists( sanitize_text_field( $user ) );

			if ( $user_id !== false ) {

				$wpdb->insert(
					$wpdb->base_prefix . 'itsec_temp',
					array(
						'temp_type'     => $options['type'],
						'temp_date'     => date( 'Y-m-d H:i:s', $itsec_globals['current_time'] ),
						'temp_date_gmt' => date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ),
						'temp_user'     => intval( $user_id ),
						'temp_username' => sanitize_text_field( $user ),
					)
				);

				$user_count = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT COUNT(*) FROM `" . $wpdb->base_prefix . "itsec_temp` WHERE `temp_date_gmt` > '%s' AND `temp_username`='%s' OR `temp_user`=%s;",
						date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] - ( $options['period'] * 60 ) ),
						sanitize_text_field( $user ),
						intval( $user_id )
					)
				);

				if ( $user_count >= $options['user'] ) {

					$lock_user = $user_id;

				}

			} else {

				$user = sanitize_text_field( $user );

				$wpdb->insert(
					$wpdb->base_prefix . 'itsec_temp',
					array(
						'temp_type'     => $options['type'],
						'temp_date'     => date( 'Y-m-d H:i:s', $itsec_globals['current_time'] ),
						'temp_date_gmt' => date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ),
						'temp_username' => $user,
					)
				);

				$user_count = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT COUNT(*) FROM `" . $wpdb->base_prefix . "itsec_temp` WHERE `temp_date_gmt` > '%s' AND `temp_username`='%s';",
						date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] - ( $options['period'] * 60 ) ),
						$user
					)
				);

				if ( $user_count >= $options['user'] ) {

					$lock_username = $user;

				}

			}

		}

		$error = $wpdb->last_error;

		if ( strlen( trim( $error ) ) > 0 ) {
			ITSEC_Lib::create_database_tables();
		}

		if ( ! ITSEC_Lib::is_ip_whitelisted( $host ) && ( $lock_host !== null || $lock_user !== null || $lock_username !== null ) ) {

			$this->lockout( $options['type'], $options['reason'], $lock_host, $lock_user, $lock_username );

		} elseif ( $lock_host !== null || $lock_user !== null ) {

			global $itsec_logger;

			$itsec_logger->log_event( 'lockout', 10, array( __( 'A whitelisted host has triggered a lockout condition but was not locked out.', 'better-wp-security' ) ), sanitize_text_field( $host ) );

		}

	}

	/**
	 * Executes lockout (locks user out)
	 *
	 * @param boolean $user if we're locking out a user or not
	 *
	 * @return void
	 */
	public function execute_lock( $user = false, $network = false ) {

		if ( ITSEC_Lib::is_ip_whitelisted( ITSEC_Lib::get_ip() ) ) {
			return;
		}

		global $itsec_globals;

		$current_user = wp_get_current_user();

		if ( is_object( $current_user ) && isset( $current_user->ID ) ) {
			wp_logout();
		}

		@header( 'HTTP/1.0 403 Forbidden' );
		@header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
		@header( 'Expires: Thu, 22 Jun 1978 00:28:00 GMT' );
		@header( 'Pragma: no-cache' );

		if ( $network === true ) { //lockout triggered by iThemes Network

			$message = ITSEC_Modules::get_setting( 'global', 'community_lockout_message' );

			if ( ! empty( $message ) ) {
				die( $message );
			} else {

				die( __( "Your IP address has been flagged as a threat by the iThemes Security network.", 'better-wp-security' ) );

			}

		} elseif ( $user === true ) { //lockout the user

			$message = ITSEC_Modules::get_setting( 'global', 'user_lockout_message' );

			if ( ! empty( $message ) ) {
				die( $message );
			} else {

				die( __( 'You have been locked out due to too many invalid login attempts.', 'better-wp-security' ) );

			}

		} else { //just lockout the host

			$message = ITSEC_Modules::get_setting( 'global', 'lockout_message' );

			if ( ! empty( $message ) ) {
				die( $message );
			} else {

				die( __( 'error', 'better-wp-security' ) );

			}

		}

	}

	/**
	 * Provides a description of lockout configuration for use in module settings.
	 *
	 * @since 4.0
	 *
	 * @return string the description of settings.
	 */
	public function get_lockout_description() {
		$global_settings_url = add_query_arg( array( 'module' => 'global' ), ITSEC_Core::get_settings_page_url() ) . '#itsec-global-blacklist';
		// If the user is currently viewing "all" then let them keep viewing all
		if ( ! empty( $_GET['module_type'] ) && 'all' === $_GET['module_type'] ) {
			$global_settings_url = add_query_arg( array( 'module_type', 'all' ), $global_settings_url );
		}

		$description  = '<h4>' . __( 'About Lockouts', 'better-wp-security' ) . '</h4>';
		$description .= '<p>';
		$description .= sprintf( __( 'Your lockout settings can be configured in <a href="%s">Global Settings</a>.', 'better-wp-security' ), esc_url( $global_settings_url ) );
		$description .= '<br />';
		$description .= __( 'Your current settings are configured as follows:', 'better-wp-security' );
		$description .= '<ul><li>';
		$description .= sprintf( __( '<strong>Permanently ban:</strong> %s', 'better-wp-security' ), ITSEC_Modules::get_setting( 'global', 'blacklist' ) === true ? __( 'yes', 'better-wp-security' ) : __( 'no', 'better-wp-security' ) );
		$description .= '</li><li>';
		$description .= sprintf( __( '<strong>Number of lockouts before permanent ban:</strong> %s', 'better-wp-security' ), ITSEC_Modules::get_setting( 'global', 'blacklist_count' ) );
		$description .= '</li><li>';
		$description .= sprintf( __( '<strong>How long lockouts will be remembered for ban:</strong> %s', 'better-wp-security' ), ITSEC_Modules::get_setting( 'global', 'blacklist_period' ) );
		$description .= '</li><li>';
		$description .= sprintf( __( '<strong>Host lockout message:</strong> %s', 'better-wp-security' ), ITSEC_Modules::get_setting( 'global', 'lockout_message' ) );
		$description .= '</li><li>';
		$description .= sprintf( __( '<strong>User lockout message:</strong> %s', 'better-wp-security' ), ITSEC_Modules::get_setting( 'global', 'user_lockout_message' ) );
		$description .= '</li><li>';
		$description .= sprintf( __( '<strong>Is this computer white-listed:</strong> %s', 'better-wp-security' ), ITSEC_Lib::is_ip_whitelisted( ITSEC_Lib::get_ip() ) === true ? __( 'yes', 'better-wp-security' ) : __( 'no', 'better-wp-security' ) );
		$description .= '</li></ul>';

		return $description;

	}

	/**
	 * Shows all lockouts currently in the database.
	 *
	 * @since 4.0
	 *
	 * @param string $type    'all', 'host', or 'user'
	 * @param bool   $current false for all lockouts, true for current lockouts
	 * @param int    $limit   the maximum number of locks to return
	 *
	 * @return array all lockouts in the system
	 */
	public function get_lockouts( $type = 'all', $current = false, $limit = 0 ) {

		global $wpdb, $itsec_globals;

		if ( $type !== 'all' || $current === true ) {
			$where = " WHERE ";
		} else {
			$where = '';
		}

		switch ( $type ) {

			case 'host':
				$type_statement = "`lockout_host` IS NOT NULL && `lockout_host` != ''";
				break;
			case 'user':
				$type_statement = "`lockout_user` != 0";
				break;
			case 'username':
				$type_statement = "`lockout_username` IS NOT NULL && `lockout_username` != ''";
				break;
			default:
				$type_statement = '';
				break;

		}

		if ( $current === true ) {

			if ( $type_statement !== '' ) {
				$and = ' AND ';
			} else {
				$and = '';
			}

			$active = $and . " `lockout_active`=1 AND `lockout_expire_gmt` > '" . date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ) . "'";

		} else {

			$active = '';

		}

		if ( absint( $limit ) > 0 ) {

			$limit = " LIMIT " . absint( $limit );

		} else {

			$limit = '';

		}

		return $wpdb->get_results( "SELECT * FROM `" . $wpdb->base_prefix . "itsec_lockouts`" . $where . $type_statement . $active . $limit . ";", ARRAY_A );

	}

	public function get_temp_whitelist() {
		$whitelist = get_site_option( 'itsec_temp_whitelist_ip', false );

		if ( ! is_array( $whitelist ) ) {
			$whitelist = array();
		} else if ( isset( $whitelist['ip'] ) ) {
			// Update old format
			$whitelist = array(
				$whitelist['ip'] => $whitelist['exp'] - ITSEC_Core::get_time_offset(),
			);
		} else {
			return $whitelist;
		}

		update_site_option( 'itsec_temp_whitelist_ip', $whitelist );

		return $whitelist;
	}

	public function update_temp_whitelist() {
		if ( ! ITSEC_Core::current_user_can_manage() ) {
			// Only add IP's of users that can manage Security settings.
			return;
		}

		$ip = ITSEC_Lib::get_ip();
		$this->add_to_temp_whitelist( $ip );
	}

	public function add_to_temp_whitelist( $ip ) {
		$whitelist = $this->get_temp_whitelist();
		$expiration = ITSEC_Core::get_current_time_gmt() + DAY_IN_SECONDS;
		$refresh_expiration = $expiration - HOUR_IN_SECONDS;

		if ( isset( $whitelist[$ip] ) && $whitelist[$ip] > $refresh_expiration ) {
			// An update is not needed yet.
			return;
		}

		// Remove expired entries.
		foreach ( $whitelist as $cached_ip => $cached_expiration ) {
			if ( $cached_expiration < ITSEC_Core::get_current_time_gmt() ) {
				unset( $whitelist[$cached_ip] );
			}
		}

		$whitelist[$ip] = $expiration;

		update_site_option( 'itsec_temp_whitelist_ip', $whitelist );
	}

	public function remove_from_temp_whitelist( $ip ) {
		$whitelist = $this->get_temp_whitelist();

		if ( ! isset( $whitelist[$ip] ) ) {
			return;
		}

		unset( $whitelist[$ip] );

		update_site_option( 'itsec_temp_whitelist_ip', $whitelist );
	}

	public function clear_temp_whitelist( $ip ) {
		update_site_option( 'itsec_temp_whitelist_ip', array() );
	}

	public function is_visitor_temp_whitelisted() {
		global $itsec_globals;

		$whitelist = $this->get_temp_whitelist();
		$ip = ITSEC_Lib::get_ip();

		if ( isset( $whitelist[$ip] ) && $whitelist[$ip] > $itsec_globals['current_time'] ) {
			return true;
		}

		return false;
	}

	/**
	 * Locks out given user or host
	 *
	 * @since 4.0
	 *
	 * @param  string $type     The type of lockout (for user reference)
	 * @param  string $reason   Reason for lockout, for notifications
	 * @param  string $host     Host to lock out
	 * @param  int    $user     user id to lockout
	 * @param string  $username username to lockout
	 *
	 * @return void
	 */
	private function lockout( $type, $reason, $host = null, $user = null, $username = null ) {

		global $wpdb, $itsec_logger, $itsec_globals;

		$itsec_files = ITSEC_Core::get_itsec_files();

		$host_expiration = null;
		$user_expiration = null;
		$username        = sanitize_text_field( trim( $username ) );

		if ( $itsec_files->get_file_lock( 'lockout_' . $host . $user . $username ) ) {

			//Do we have a good host to lock out or not
			if ( ! is_null( $host ) && ITSEC_Lib::is_ip_whitelisted( sanitize_text_field( $host ) ) === false && ITSEC_Lib_IP_Tools::validate( $host ) ) {
				$good_host = sanitize_text_field( $host );
			} else {
				$good_host = false;
			}

			//Do we have a valid user to lockout or not
			if ( $user !== null && ITSEC_Lib::user_id_exists( intval( $user ) ) === true ) {
				$good_user = intval( $user );
			} else {
				$good_user = false;
			}

			//Do we have a valid username to lockout or not
			if ( $username !== null && $username != '' ) {
				$good_username = $username;
			} else {
				$good_username = false;
			}

			$blacklist_host = false; //assume we're not permanently blcking the host

			//Sanitize the data for later
			$type   = sanitize_text_field( $type );
			$reason = sanitize_text_field( $reason );

			//handle a permanent host ban (if needed)
			if ( ITSEC_Modules::get_setting( 'global', 'blacklist' ) && $good_host !== false ) { //permanent blacklist

				$blacklist_period = ITSEC_Modules::get_setting( 'global', 'blacklist_period', 7 );
				$blacklist_seconds = $blacklist_period * DAY_IN_SECONDS;

				$host_count = 1 + $wpdb->get_var(
					$wpdb->prepare(
						"SELECT COUNT(*) FROM `" . $wpdb->base_prefix . "itsec_lockouts` WHERE `lockout_expire_gmt` > '%s' AND `lockout_host`='%s';",
						date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] - $blacklist_seconds ),
						$host
					)
				);

				if ( $host_count >= ITSEC_Modules::get_setting( 'global', 'blacklist_count' ) && ITSEC_Files::can_write_to_files() ) {

					$host_expiration = false;

					$this->blacklist_ip( sanitize_text_field( $host ) );

					$blacklist_host = true; //flag it so we don't do a temp ban as well

				}

			}

			//We have temp bans to perform
			if ( $good_host !== false || $good_user !== false || $good_username || $good_username !== false ) {

				if ( ITSEC_Lib::is_ip_whitelisted( sanitize_text_field( $host ) ) ) {

					$whitelisted    = true;
					$expiration     = date( 'Y-m-d H:i:s', 1 );
					$expiration_gmt = date( 'Y-m-d H:i:s', 1 );

				} else {

					$whitelisted    = false;
					$exp_seconds    = ITSEC_Modules::get_setting( 'global', 'lockout_period' ) * MINUTE_IN_SECONDS;
					$expiration     = date( 'Y-m-d H:i:s', $itsec_globals['current_time'] + $exp_seconds );
					$expiration_gmt = date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] + $exp_seconds );

				}

				if ( $good_host !== false && $blacklist_host === false ) { //temp lockout host

					$host_expiration = $expiration;

					$wpdb->insert(
						$wpdb->base_prefix . 'itsec_lockouts',
						array(
							'lockout_type'       => $type,
							'lockout_start'      => date( 'Y-m-d H:i:s', $itsec_globals['current_time'] ),
							'lockout_start_gmt'  => date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ),
							'lockout_expire'     => $expiration,
							'lockout_expire_gmt' => $expiration_gmt,
							'lockout_host'       => sanitize_text_field( $host ),
						)
					);

					$itsec_logger->log_event( 'lockout', 10, array(
						'expires' => $expiration, 'expires_gmt' => $expiration_gmt, 'type' => $type
					), sanitize_text_field( $host ) );

				}

				if ( $good_user !== false ) { //blacklist host and temp lockout user

					$user_expiration = $expiration;

					$wpdb->insert(
						$wpdb->base_prefix . 'itsec_lockouts',
						array(
							'lockout_type'       => $type,
							'lockout_start'      => date( 'Y-m-d H:i:s', $itsec_globals['current_time'] ),
							'lockout_start_gmt'  => date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ),
							'lockout_expire'     => $expiration,
							'lockout_expire_gmt' => $expiration_gmt,
							'lockout_host'       => '',
							'lockout_user'       => intval( $user ),
						)
					);

					if ( $whitelisted === false ) {
						$itsec_logger->log_event( 'lockout', 10, array(
							'expires' => $expiration, 'expires_gmt' => $expiration_gmt, 'type' => $type
						), '', '', intval( $user ) );
					} else {
						$itsec_logger->log_event( 'lockout', 10, array(
							__( 'White Listed', 'better-wp-security' ), 'type' => $type
						), '', '', intval( $user ) );
					}

				}

				if ( $good_username !== false ) { //blacklist host and temp lockout username

					$user_expiration = $expiration;

					$wpdb->insert(
						$wpdb->base_prefix . 'itsec_lockouts',
						array(
							'lockout_type'       => $type,
							'lockout_start'      => date( 'Y-m-d H:i:s', $itsec_globals['current_time'] ),
							'lockout_start_gmt'  => date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] ),
							'lockout_expire'     => $expiration,
							'lockout_expire_gmt' => $expiration_gmt,
							'lockout_host'       => '',
							'lockout_username'   => $username,
						)
					);

					if ( $whitelisted === false ) {
						$itsec_logger->log_event( 'lockout', 10, array(
							'expires' => $expiration, 'expires_gmt' => $expiration_gmt, 'type' => $type
						), '', '', $username );
					} else {
						$itsec_logger->log_event( 'lockout', 10, array(
							__( 'White Listed', 'better-wp-security' ), 'type' => $type
						), '', '', $username );
					}

				}

				if ( $whitelisted === false ) {

					if ( ITSEC_Modules::get_setting( 'global', 'email_notifications' ) ) { //send email notifications
						$this->send_lockout_email( $good_host, $good_user, $good_username, $host_expiration, $user_expiration, $reason );
					}

					if ( $good_host !== false ) {

						$itsec_files->release_file_lock( 'lockout_' . $host . $user . $username );
						$this->execute_lock();

					} else {

						$itsec_files->release_file_lock( 'lockout_' . $host . $user . $username );
						$this->execute_lock( true );

					}

				}

			}

			$itsec_files->release_file_lock( 'lockout_' . $host . $user . $username );

		}

	}

	/**
	 * Inserts an IP address into the htaccess ban list.
	 *
	 * @since 4.0
	 *
	 * @param $ip
	 *
	 * @return boolean False if the IP is whitelisted, true otherwise.
	 */
	public function blacklist_ip( $ip ) {
		$ip = sanitize_text_field( $ip );

		if ( ITSEC_Lib::is_ip_blacklisted( $ip ) ) {
			// Already blacklisted.
			return true;
		}

		if ( ITSEC_Lib::is_ip_whitelisted( $ip ) ) {
			// Cannot blacklist a whitelisted IP.
			return false;
		}

		// The following action allows modules to handle the blacklist as needed. This is primarily useful for the Ban
		// Users module.
		do_action( 'itsec-new-blacklisted-ip', $ip );

		return true;
	}

	/**
	 * Purges lockouts more than 7 days old from the database
	 *
	 * @return void
	 */
	public function purge_lockouts() {

		global $wpdb, $itsec_globals;

		$wpdb->query( "DELETE FROM `" . $wpdb->base_prefix . "itsec_lockouts` WHERE `lockout_expire_gmt` < '" . date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] - ( ( ITSEC_Modules::get_setting( 'global', 'blacklist_period' ) + 1 ) * DAY_IN_SECONDS ) ) . "';" );
		$wpdb->query( "DELETE FROM `" . $wpdb->base_prefix . "itsec_temp` WHERE `temp_date_gmt` < '" . date( 'Y-m-d H:i:s', $itsec_globals['current_time_gmt'] - DAY_IN_SECONDS ) . "';" );

	}

	/**
	 * Register 404 and file change detection for logger
	 *
	 * @param  array $logger_modules array of logger modules
	 *
	 * @return array                   array of logger modules
	 */
	public function register_logger( $logger_modules ) {

		$logger_modules['lockout'] = array(
			'type'     => 'lockout',
			'function' => __( 'Host or User Lockout', 'better-wp-security' ),
		);

		return $logger_modules;

	}

	/**
	 * Register Lockouts for Sync
	 *
	 * @param  array $sync_modules array of logger modules
	 *
	 * @return array                   array of logger modules
	 */
	public function register_sync( $sync_modules ) {

		$sync_modules['lockout'] = array(
			'verbs'      => array(
				'itsec-get-lockouts'       => 'Ithemes_Sync_Verb_ITSEC_Get_Lockouts',
				'itsec-release-lockout'    => 'Ithemes_Sync_Verb_ITSEC_Release_Lockout',
				'itsec-get-temp-whitelist' => 'Ithemes_Sync_Verb_ITSEC_Get_Temp_Whitelist',
				'itsec-set-temp-whitelist' => 'Ithemes_Sync_Verb_ITSEC_Set_Temp_Whitelist',
			),
			'everything' => array(
				'itsec-get-lockouts',
				'itsec-get-temp-whitelist',
			),
			'path'       => dirname( __FILE__ ),
		);

		return $sync_modules;

	}

	/**
	 * Register modules that will use the lockout service
	 *
	 * @return void
	 */
	public function register_modules() {

		$this->lockout_modules = apply_filters( 'itsec_lockout_modules', $this->lockout_modules );

	}

	/**
	 * Process clearing lockouts on view log page
	 *
	 * @since 4.0
	 *
	 * @return bool true on success or false
	 */
	public function release_lockout( $id = null ) {

		global $wpdb;

		if ( $id !== null && trim( $id ) !== '' ) {

			$sanitized_id = intval( $id );

			$lockout = $wpdb->get_results( "SELECT * FROM `" . $wpdb->base_prefix . "itsec_lockouts` WHERE lockout_id = " . $sanitized_id . ";", ARRAY_A );

			if ( is_array( $lockout ) && sizeof( $lockout ) >= 1 ) {

				$success = $wpdb->update(
					$wpdb->base_prefix . 'itsec_lockouts',
					array(
						'lockout_active' => 0,
					),
					array(
						'lockout_id' => $sanitized_id,
					)
				);

				return $success === false ? false : true;

			} else {

				return false;

			}

		} elseif ( isset( $_POST['itsec_release_lockout'] ) && $_POST['itsec_release_lockout'] == 'true' ) {

			if ( ! wp_verify_nonce( $_POST['wp_nonce'], 'itsec_release_lockout' ) ) {
				die( __( 'Security error!', 'better-wp-security' ) );
			}

			$type    = 'updated';
			$message = __( 'The selected lockouts have been cleared.', 'better-wp-security' );

			foreach ( $_POST as $key => $value ) {

				if ( strstr( $key, "lo_" ) ) { //see if it's a lockout to avoid processing extra post fields

					$wpdb->update(
						$wpdb->base_prefix . 'itsec_lockouts',
						array(
							'lockout_active' => 0,
						),
						array(
							'lockout_id' => intval( $value ),
						)
					);

				}

			}

			ITSEC_Lib::clear_caches();

			if ( is_multisite() ) {

				$error_handler = new WP_Error();

				$error_handler->add( $type, $message );

				$this->core->show_network_admin_notice( $error_handler );

			} else {

				add_settings_error( 'itsec', esc_attr( 'settings_updated' ), $message, $type );

			}

		}

	}

	/**
	 * Sends an email to notify site admins of lockouts
	 *
	 * @since 4.0
	 *
	 * @param  string $host            the host to lockout
	 * @param  int    $user            the user id to lockout
	 * @param string  $username        the username to lockout
	 * @param  string $host_expiration when the host login expires
	 * @param  string $user_expiration when the user lockout expires
	 * @param  string $reason          the reason for the lockout to show to the user
	 *
	 * @return void
	 */
	private function send_lockout_email( $host, $user, $username, $host_expiration, $user_expiration, $reason ) {

		global $itsec_globals;

		$itsec_notify = ITSEC_Core::get_itsec_notify();

		if ( ! ITSEC_Modules::get_setting( 'global', 'digest_email' ) ) {

			$plural_text = __( 'has', 'better-wp-security' );

			//Tell which host was locked out
			if ( $host !== false ) {

				$host_text = sprintf( '%s, <a href="http://www.traceip.net/?query=%s"><strong>%s</strong></a>, ', __( 'host', 'better-wp-security' ), urlencode( $host ), sanitize_text_field( $host ) );

				$host_expiration_text = __( 'The host has been locked out ', 'better-wp-security' );

				if ( $host_expiration === false ) {

					$host_expiration_text .= '<strong>' . __( 'permanently', 'better-wp-security' ) . '</strong>';
					$release_text = sprintf( __( 'To release the host lockout you can remove the host from the <a href="%1$s">host list</a>.', 'better-wp-security' ), wp_login_url( ITSEC_Core::get_settings_page_url() ) );

				} else {

					$host_expiration_text .= sprintf( '<strong>%s %s</strong>', __( 'until', 'better-wp-security' ), sanitize_text_field( $host_expiration ) );
					$release_text = sprintf( __( 'To release the lockout please visit <a href="%1$s">the admin area</a>.', 'better-wp-security' ), wp_login_url( ITSEC_Core::get_settings_page_url() ) );

				}

			} else {

				$host_expiration_text = '';
				$host_text            = '';
				$release_text         = '';

			}

			$user_object = get_userdata( $user ); //try to get and actual user object

			//Tell them which user was locked out and setup the expiration copy
			if ( $user_object !== false || $username !== false ) {

				if ( $user_object !== false ) {
					$login = $user_object->user_login;
				} else {
					$login = sanitize_text_field( $username );
				}

				if ( $host_text === '' ) {

					$user_expiration_text = sprintf( '%s <strong>%s %s</strong>.', __( 'The user has been locked out', 'better-wp-security' ), __( 'until', 'better-wp-security' ), sanitize_text_field( $user_expiration ) );

					$user_text = sprintf( '%s, <strong>%s</strong>, ', __( 'user', 'better-wp-security' ), $login );

					$release_text = sprintf( __( 'To release the lockout please visit <a href="%1$s">the lockouts page</a>.', 'better-wp-security' ), wp_login_url( ITSEC_Core::get_settings_page_url() ) );

				} else {

					$user_expiration_text = sprintf( '%s <strong>%s %s</strong>.', __( 'and the user has been locked out', 'better-wp-security' ), __( 'until', 'better-wp-security' ), sanitize_text_field( $user_expiration ) );
					$plural_text          = __( 'have', 'better-wp-security' );
					$user_text            = sprintf( '%s, <strong>%s</strong>, ', __( 'and a user', 'better-wp-security' ), $login );

					if ( $host_expiration === false ) {

						$release_text = sprintf( __( 'To release the user lockout please visit <a href="%1$s">the lockouts page</a>.', 'better-wp-security' ), wp_login_url( ITSEC_Core::get_settings_page_url() ) );

					} else {

						$release_text = sprintf( __( 'To release the lockouts please visit <a href="%1$s">the lockouts page</a>.', 'better-wp-security' ), wp_login_url( ITSEC_Core::get_settings_page_url() ) );

					}

				}

			} else {

				$user_expiration_text = '.';
				$user_text            = '';
				$release_text         = '';

			}

			//Put the copy all together
			$body = sprintf(
				'<p>%s,</p><p>%s %s %s %s %s <a href="%s">%s</a> %s <strong>%s</strong>.</p><p>%s %s</p><p>%s</p><p><em>*%s %s. %s <a href="%s">%s</a>.</em></p>',
				__( 'Dear Site Admin', 'better-wp-security' ),
				__( 'A', 'better-wp-security' ),
				$host_text,
				$user_text,
				$plural_text,
				__( ' been locked out of the WordPress site at', 'better-wp-security' ),
				get_option( 'siteurl' ),
				get_option( 'siteurl' ),
				__( 'due to', 'better-wp-security' ),
				sanitize_text_field( $reason ),
				$host_expiration_text,
				$user_expiration_text,
				$release_text,
				__( 'This email was generated automatically by' ),
				$itsec_globals['plugin_name'],
				__( 'To change your email preferences please visit', 'better-wp-security' ),
				wp_login_url( ITSEC_Core::get_settings_page_url() ),
				__( 'the plugin settings', 'better-wp-security' ) );

			//Setup the remainder of the email
			$subject = '[' . get_option( 'siteurl' ) . '] ' . __( 'Site Lockout Notification', 'better-wp-security' );
			$subject = apply_filters( 'itsec_lockout_email_subject', $subject );
			$headers = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>' . "\r\n";

			$args = array(
				'headers' => $headers,
				'message' => $body,
				'subject' => $subject,
			);

			$itsec_notify->notify( $args );

		}

	}

	/**
	 * Sets an error message when a user has been forcibly logged out due to lockout
	 *
	 * @return string
	 */
	public function set_lockout_error() {

		global $itsec_globals;

		//check to see if it's the logout screen
		if ( isset( $_GET['itsec'] ) && $_GET['itsec'] == true ) {
			return '<div id="login_error">' . ITSEC_Modules::get_setting( 'global', 'user_lockout_message' ) . '</div>' . PHP_EOL;
		}

	}

}
