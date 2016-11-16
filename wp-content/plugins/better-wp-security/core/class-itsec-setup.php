<?php

/**
 * Plugin activation, upgrade, deactivation and uninstall
 *
 * @package iThemes-Security
 * @since   4.0
 */
class ITSEC_Setup {

	private
		$defaults;

	/**
	 * Establish setup object
	 *
	 * Establishes set object and calls appropriate execution function
	 *
	 * @param bool $case [optional] Appropriate execution module to call
	 *
	 * */
	function __construct( $case = false, $upgrading = false ) {

		global $itsec_globals;

		$this->defaults = array(
			'notification_email'        => array( get_option( 'admin_email' ) ),
			'backup_email'              => array( get_option( 'admin_email' ) ),
			'lockout_message'           => __( 'error', 'better-wp-security' ),
			'user_lockout_message'      => __( 'You have been locked out due to too many invalid login attempts.', 'better-wp-security' ),
			'community_lockout_message' => __( "Your IP address has been flagged as a threat by the iThemes Security network.", 'better-wp-security' ),
			'blacklist'                 => true,
			'blacklist_count'           => 3,
			'blacklist_period'          => 7,
			'email_notifications'       => true,
			'lockout_period'            => 15,
			'lockout_white_list'        => array(),
			'log_rotation'              => 14,
			'log_type'                  => 0,
			'log_location'              => ITSEC_Core::get_storage_dir( 'logs' ),
			'allow_tracking'            => false,
			'write_files'               => false,
			'nginx_file'                => ABSPATH . 'nginx.conf',
			'infinitewp_compatibility'  => false,
			'did_upgrade'               => false,
			'lock_file'                 => false,
			'digest_email'              => false,
			'proxy_override'            => false,
			'hide_admin_bar'            => false,
		);

		if ( ! $case ) {
			die( 'error' );
		}

		switch ( $case ) {

			case 'activate': //active plugin
				$this->activate_execute();
				break;

			case 'upgrade': //upgrade plugin
				$this->upgrade_execute( $upgrading );
				break;

			case 'deactivate': //deactivate plugin
				$this->deactivate_execute();
				break;

			case 'uninstall': //uninstall plugin
				$this->uninstall_execute();
				break;

		}

	}

	/**
	 * Execute setup script for each module installed
	 *
	 * @return void
	 */
	function do_modules() {
		$itsec_modules = ITSEC_Modules::get_instance();
		$itsec_modules->run_activation();
	}

	/**
	 * Public function to activate
	 *
	 * */
	static function on_activate() {

		global $itsec_setup_action;

		$itsec_setup_action = 'activate';

		define( 'ITSEC_DO_ACTIVATION', true );

		new ITSEC_Setup( 'activate' );

	}

	/**
	 * Public function to deactivate
	 *
	 * */
	static function on_deactivate() {

		global $itsec_setup_action;

		if ( defined( 'ITSEC_DEVELOPMENT' ) && ITSEC_DEVELOPMENT == true ) { //set ITSEC_DEVELOPMENT to true to reset settings on deactivation for development

			$itsec_setup_action = 'uninstall';

		} else {

			$itsec_setup_action = 'deactivate';

		}

		new ITSEC_Setup( $itsec_setup_action );
	}

	/**
	 * Public function to uninstall
	 *
	 * */
	static function on_uninstall() {

		global $itsec_setup_action;

		$itsec_setup_action = 'uninstall';

		new ITSEC_Setup( 'uninstall' );

	}

	/**
	 * Execute activation.
	 *
	 * @since 4.0
	 *
	 * @param boolean $upgrade true if the plugin is updating
	 *
	 * @return void
	 */
	private function activate_execute() {

		global $itsec_globals;

		//if this is multisite make sure they're network activating or die
		if ( defined( 'ITSEC_DO_ACTIVATION' ) && ITSEC_DO_ACTIVATION == true && is_multisite() && ! strpos( $_SERVER['REQUEST_URI'], 'wp-admin/network/plugins.php' ) ) {

			die ( __( '<strong>ERROR</strong>: You must activate this plugin from the network dashboard.', 'better-wp-security' ) );

		}

		if ( ( $site_data = get_site_option( 'itsec_data' ) ) === false ) {
			add_site_option( 'itsec_data', array(), false );
		}

		if ( get_site_option( 'itsec_initials' ) === false ) {
			add_site_option( 'itsec_initials', array(), false );
		}

		if ( get_site_option( 'itsec_api_nag' ) === false ) { //show the nag to activate an API key
			add_site_option( 'itsec_api_nag', true, false );
		}

		$options = get_site_option( 'itsec_global' );

		if ( $options === false || ( isset( $options['log_info'] ) && sizeof( $options ) <= 2 ) ) {

			$this->defaults['log_info'] = substr( sanitize_title( get_bloginfo( 'name' ) ), 0, 20 ) . '-' . wp_generate_password( 30, false );

			$itsec_globals['settings'] = $this->defaults;

			update_site_option( 'itsec_global', $this->defaults );

		}

		//load utility functions
		if ( ! class_exists( 'ITSEC_Lib' ) ) {
			require( $itsec_globals['plugin_dir'] . 'core/class-itsec-lib.php' );
		}

		ITSEC_Lib::create_database_tables();

		$this->do_modules();

	}

	/**
	 * Update Execution
	 *
	 * @since 4.0
	 *
	 * @param string $old_version Old version number
	 *
	 * @return void
	 */
	private function upgrade_execute( $upgrade = false ) {

		global $itsec_old_version, $itsec_globals, $wpdb, $itsec_setup_action;
		$tables_updated = false;

		$itsec_setup_action = 'upgrade';
		$itsec_old_version  = $upgrade;

		if ( $itsec_old_version < 4000 ) {

			global $itsec_bwps_options;

			if ( wp_next_scheduled( 'bwps_backup' ) ) {
				wp_clear_scheduled_hook( 'bwps_backup' );
			}

			if ( is_multisite() ) {

				switch_to_blog( 1 );

				$itsec_bwps_options = get_option( 'bit51_bwps' );
				delete_option( 'bit51_bwps' );
				delete_option( 'bwps_intrusion_warning' );
				delete_option( 'bit51_bwps_data' );
				delete_site_transient( 'bit51_bwps_backup' );
				delete_site_transient( 'bwps_away' );

				restore_current_blog();

			} else {

				$itsec_bwps_options = get_option( 'bit51_bwps' );
				delete_option( 'bit51_bwps' );
				delete_option( 'bwps_intrusion_warning' );
				delete_option( 'bit51_bwps_data' );
				delete_site_transient( 'bit51_bwps_backup' );
				delete_site_transient( 'bwps_away' );

			}

			if ( $itsec_bwps_options !== false ) {

				$current_options = get_site_option( 'itsec_global' );

				if ( $current_options === false ) {
					$current_options = $this->defaults;
				}

				$current_options['notification_email']    = array( isset( $itsec_bwps_options['ll_emailaddress'] ) && strlen( $itsec_bwps_options['ll_emailaddress'] ) ? $itsec_bwps_options['ll_emailaddress'] : get_option( 'admin_email' ) );
				$current_options['backup_email']          = array( isset( $itsec_bwps_options['backup_emailaddress'] ) && strlen( $itsec_bwps_options['backup_emailaddress'] ) ? $itsec_bwps_options['backup_emailaddress'] : get_option( 'admin_email' ) );
				$current_options['blacklist']             = isset( $itsec_bwps_options['ll_blacklistip'] ) && $itsec_bwps_options['ll_blacklistip'] == 0 ? false : true;
				$current_options['blacklist_count']       = isset( $itsec_bwps_options['ll_blacklistipthreshold'] ) && intval( $itsec_bwps_options['ll_blacklistipthreshold'] ) > 0 ? intval( $itsec_bwps_options['ll_blacklistipthreshold'] ) : 3;
				$current_options['write_files']           = isset( $itsec_bwps_options['st_writefiles'] ) && $itsec_bwps_options['st_writefiles'] == 1 ? true : false;
				$itsec_globals['settings']['write_files'] = $current_options['write_files'];
				$current_options['did_upgrade']           = true;

				if ( isset( $itsec_bwps_options['id_whitelist'] ) && ! is_array( $itsec_bwps_options['id_whitelist'] ) && strlen( $itsec_bwps_options['id_whitelist'] ) > 1 ) {

					$raw_hosts = explode( PHP_EOL, $itsec_bwps_options['id_whitelist'] );

					foreach ( $raw_hosts as $host ) {

						if ( strlen( $host ) > 1 ) {
							$current_options['lockout_white_list'][] = $host;
						}

					}

				}

				if ( $current_options['write_files'] === false ) {
					set_site_transient( 'ITSEC_SHOW_WRITE_FILES_TOOLTIP', true, 600 );
				}

				update_site_option( 'itsec_global', $current_options );

			}

			$wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->base_prefix . "bwps_lockouts`;" );
			$wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->base_prefix . "bwps_log`;" );
			$wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->base_prefix . "BWPS_d404`;" );
			$wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->base_prefix . "BWPS_ll`;" );
			$wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->base_prefix . "BWPS_lockouts`;" );

			delete_option( 'bwps_file_log' );
			delete_option( 'bwps_awaymode' );
			delete_option( 'bwps_filecheck' );
			delete_option( 'BWPS_Login_Slug' );
			delete_option( 'BWPS_options' );
			delete_option( 'BWPS_versions' );
			delete_option( 'bit51_bwps_data' );

		}

		$this->do_modules();

		$itsec_globals['data']['build'] = ITSEC_Core::get_plugin_build();

		update_site_option( 'itsec_data', $itsec_globals['data'] );

		if ( $itsec_old_version < 4030 ) {

			ITSEC_Lib::create_database_tables(); //adds username field to lockouts and temp
			$tables_updated = true;
			ITSEC_Response::regenerate_server_config();

		}

		if ( $itsec_old_version < 4031 ) {

			$banned_option = get_site_option( 'itsec_ban_users' );

			if ( isset( $banned_option['white_list'] ) ) {

				$banned_white_list = $banned_option['white_list'];
				$options           = get_site_option( 'itsec_global' );
				$white_list        = isset( $options['lockout_white_list'] ) ? $options['lockout_white_list'] : array();

				if ( ! is_array( $white_list ) ) {
					$white_list = explode( PHP_EOL, $white_list );
				}

				if ( ! is_array( $banned_white_list ) ) {
					$banned_white_list = explode( PHP_EOL, $banned_white_list );
				}

				$new_white_list = array_merge( $white_list, $banned_white_list );

				$options['lockout_white_list'] = $new_white_list;

				update_site_option( 'itsec_global', $options );

			}

		}

		if ( $itsec_old_version < 4033 ) {

			if ( get_site_option( 'itsec_api_nag' ) === false ) { //show the nag to activate an API key
				add_site_option( 'itsec_api_nag', true, false );
			}

		}

		//IPv6 support was added in 4039
		if ( $itsec_old_version < 4039 && ! $tables_updated ) {
			ITSEC_Lib::create_database_tables();
			$tables_updated = true;
		}

		if ( $itsec_old_version < 4040 ) {
			$options = get_site_option( 'itsec_global' );

			if ( $options['log_info'] ) {
				$new_log_info = substr( sanitize_title( get_bloginfo( 'name' ) ), 0, 20 ) . '-' . wp_generate_password( 30, false );
				$old_file = path_join( $options['log_location'], 'event-log-' . $options['log_info'] . '.log' );
				$new_file = path_join( $options['log_location'], 'event-log-' . $new_log_info . '.log' );

				// If the file exists already, don't update the location unless we successfully move it.
				if ( file_exists( $old_file ) && rename( $old_file, $new_file ) ) {
					$options['log_info'] = $new_log_info;
				}
			}

			// Make sure we have an index files to block directory listing in logs directory
			if ( is_dir( $options['log_location'] ) && ! file_exists( path_join( $options['log_location'], 'index.php' ) ) ) {
				file_put_contents( path_join( $options['log_location'], 'index.php' ), "<?php\n// Silence is golden." );
			}

			$backup_options = get_site_option( 'itsec_backup' );
			// Make sure we have an index files to block directory listing in backups directory
			if ( is_dir( $backup_options['location'] ) && ! file_exists( path_join( $backup_options['location'], 'index.php' ) ) ) {
				file_put_contents( path_join( $backup_options['location'], 'index.php' ), "<?php\n// Silence is golden." );
			}

			update_site_option( 'itsec_global', $options );
		}

		$itsec_modules = ITSEC_Modules::get_instance();
		$itsec_modules->run_upgrade( $itsec_old_version, ITSEC_Core::get_plugin_build() );

	}

	/**
	 * Deactivate execution
	 *
	 * @since 4.0
	 *
	 * @return void
	 * */
	private function deactivate_execute() {

		global $itsec_globals, $wpdb;

		wp_clear_scheduled_hook( 'itsec_purge_lockouts' );

		require_once( $itsec_globals['plugin_dir'] . 'core/class-itsec-modules.php' );
		$itsec_modules = ITSEC_Modules::get_instance();
		$itsec_modules->run_deactivation();

		$itsec_files = ITSEC_Core::get_itsec_files();
		$itsec_files->do_deactivate();

		delete_site_option( 'itsec_flush_old_rewrites' );
		delete_site_option( 'itsec_manual_update' );
		delete_site_option( 'itsec_rewrites_changed' );
		delete_site_option( 'itsec_config_changed' );
		delete_site_option( 'itsec_had_other_version' );
		delete_site_option( 'itsec_no_file_lock_release' );
		delete_site_option( 'itsec_clear_login' );
		delete_site_option( 'itsec_temp_whitelist_ip' );
		delete_site_option( 'itsec_api_nag' );
		delete_site_transient( 'ITSEC_SHOW_WRITE_FILES_TOOLTIP' );
		delete_site_transient( 'itsec_upload_dir' );
		delete_site_transient( 'itsec_notification_running' );
		wp_clear_scheduled_hook( 'itsec_digest_email' );

		$htaccess = ITSEC_Lib::get_htaccess();

		//Make sure we can write to the file
		$perms = substr( sprintf( '%o', @fileperms( $htaccess ) ), - 4 );

		if ( $perms == '0444' ) {
			@chmod( $htaccess, 0664 );
		}

		flush_rewrite_rules();

		//reset file permissions if we changed them
		if ( $perms == '0444' ) {
			@chmod( $htaccess, 0444 );
		}

		ITSEC_Lib::clear_caches();

	}

	/**
	 * Uninstall execution
	 *
	 * @since 4.0
	 *
	 * @return void
	 * */
	private function uninstall_execute() {

		global $itsec_globals, $wpdb;

		$this->deactivate_execute();

		require_once( $itsec_globals['plugin_dir'] . 'core/class-itsec-modules.php' );
		ITSEC_Modules::run_uninstall();

		$itsec_files = ITSEC_Core::get_itsec_files();
		$itsec_files->do_deactivate();

		delete_site_option( 'itsec-storage' );
		delete_site_option( 'itsec_global' );
		delete_site_option( 'itsec_data' );
		delete_site_option( 'itsec_initials' );
		delete_site_option( 'itsec_jquery_version' );
		delete_site_option( 'itsec_message_queue' );

		$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->base_prefix . "itsec_log;" );
		$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->base_prefix . "itsec_lockouts;" );
		$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->base_prefix . "itsec_temp;" );

		if ( is_dir( ITSEC_Core::get_storage_dir() ) ) {
			require_once( ITSEC_Core::get_core_dir() . '/lib/class-itsec-lib-directory.php' );

			ITSEC_Lib_Directory::remove( ITSEC_Core::get_storage_dir() );
		}

		ITSEC_Lib::clear_caches();
	}

}
