<?php

/**
 * Backup execution.
 *
 * Handles database backups at scheduled interval.
 *
 * @since   4.0.0
 *
 * @package iThemes_Security
 */
class ITSEC_Backup {

	/**
	 * The module's saved options
	 *
	 * @since  4.0.0
	 * @access private
	 * @var array
	 */
	private $settings;

	/**
	 * Setup the module's functionality.
	 *
	 * Loads the backup detection module's unpriviledged functionality including
	 * performing the scans themselves.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	function run() {

		global $itsec_globals;

		$this->settings = ITSEC_Modules::get_settings( 'backup' );

		add_action( 'itsec_execute_backup_cron', array( $this, 'do_backup' ) );
		add_filter( 'itsec_logger_modules', array( $this, 'register_logger' ) );

		if ( defined( 'ITSEC_BACKUP_CRON' ) && true === ITSEC_BACKUP_CRON ) {
			if ( ! wp_next_scheduled( 'itsec_execute_backup_cron' ) ) {
				wp_schedule_event( time(), 'daily', 'itsec_execute_backup_cron' );
			}

			// When ITSEC_BACKUP_CRON is enabled, skip the regular scheduling system.
			return;
		}

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			// Don't run on AJAX requests.
			return;
		}

		if ( class_exists( 'pb_backupbuddy' ) ) {
			// Don't run when BackupBuddy is active.
			return;
		}

		if ( $this->settings['interval'] <= 0 ) {
			// Don't run when the interval is zero or less.
			return;
		}


		$next_run = $this->settings['last_run'] + $this->settings['interval'] * DAY_IN_SECONDS;

		if ( $next_run <= $itsec_globals['current_time_gmt'] ) {
			add_action( 'init', array( $this, 'do_backup' ), 10, 0 );
		}
	}

	/**
	 * Public function to get lock and call backup.
	 *
	 * Attempts to get a lock to prevent concurrant backups and calls the backup function itself.
	 *
	 * @since 4.0.0
	 *
	 * @param  boolean $one_time whether this is a one time backup
	 *
	 * @return mixed false on error or nothing
	 */
	public function do_backup( $one_time = false ) {
		ITSEC_Lib::set_minimum_memory_limit( '256M' );

		$itsec_files = ITSEC_Core::get_itsec_files();

		if ( $itsec_files->get_file_lock( 'backup' ) ) {

			$this->execute_backup( $one_time );

			$itsec_files->release_file_lock( 'backup' );

			switch ( $this->settings['method'] ) {

				case 0:
					return __( 'Backup complete. The backup was sent to the selected email recipients and was saved locally.', 'better-wp-security' );
				case 1:
					return __( 'Backup complete. The backup was sent to the selected email recipients.', 'better-wp-security' );
				default:
					return __( 'Backup complete. The backup was saved locally.', 'better-wp-security' );

			}
		} else {
			return new WP_Error( 'itsec-backup-do-backup-already-running', __( 'Unable to create a backup at this time since a backup is currently being created. If you wish to create an additional backup, please wait a few minutes before trying again.', 'better-wp-security' ) );
		}
	}

	/**
	 * Executes backup function.
	 *
	 * Handles the execution of database backups.
	 *
	 * @since 4.0.0
	 *
	 * @param bool $one_time whether this is a one-time backup
	 *
	 * @return void
	 */
	private function execute_backup( $one_time = false ) {

		global $wpdb, $itsec_globals, $itsec_logger;

		//get all of the tables
		if ( isset( $this->settings['all_sites'] ) && true === $this->settings['all_sites'] ) {

			$tables = $wpdb->get_results( 'SHOW TABLES', ARRAY_N ); //retrieve a list of all tables in the DB

		} else {

			$tables = $wpdb->get_results( 'SHOW TABLES LIKE "' . $wpdb->base_prefix . '%"', ARRAY_N ); //retrieve a list of all tables for this WordPress installation

		}

		$return = '';

		//cycle through each table
		foreach ( $tables as $table ) {

			$num_fields = sizeof( $wpdb->get_results( 'DESCRIBE `' . $table[0] . '`;' ) );

			$return .= 'DROP TABLE IF EXISTS `' . $table[0] . '`;';

			$row2 = $wpdb->get_row( 'SHOW CREATE TABLE `' . $table[0] . '`;', ARRAY_N );

			$return .= PHP_EOL . PHP_EOL . $row2[1] . ";" . PHP_EOL . PHP_EOL;

			if ( ! in_array( substr( $table[0], strlen( $wpdb->prefix ) ), $this->settings['exclude'] ) ) {

				$result = $wpdb->get_results( 'SELECT * FROM `' . $table[0] . '`;', ARRAY_N );

				foreach ( $result as $row ) {

					$return .= 'INSERT INTO `' . $table[0] . '` VALUES(';

					for ( $j = 0; $j < $num_fields; $j ++ ) {

						$row[$j] = addslashes( $row[$j] );
						$row[$j] = preg_replace( '#' . PHP_EOL . '#', "\n", $row[$j] );

						if ( isset( $row[$j] ) ) {

							$return .= '"' . $row[$j] . '"';

						} else {

							$return .= '""';

						}

						if ( $j < ( $num_fields - 1 ) ) {
							$return .= ',';
						}

					}

					$return .= ");" . PHP_EOL;

				}

			}

			$return .= PHP_EOL . PHP_EOL;

		}

		$return .= PHP_EOL . PHP_EOL;

		//save file
		$file = 'backup-' . substr( sanitize_title( get_bloginfo( 'name' ) ), 0, 20 ) . '-' . current_time( 'Ymd-His' ) . '-' . wp_generate_password( 30, false );

		require_once( ITSEC_Core::get_core_dir() . 'lib/class-itsec-lib-directory.php' );

		$dir = $this->settings['location'];
		ITSEC_Lib_Directory::create( $dir );


		$fileext = '.sql';

		$handle = @fopen( $dir . '/' . $file . '.sql', 'w+' );

		@fwrite( $handle, $return );
		@fclose( $handle );

		//zip the file
		if ( true === $this->settings['zip'] ) {

			if ( ! class_exists( 'PclZip' ) ) {
				require( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
			}

			$zip = new PclZip( $dir . '/' . $file . '.zip' );

			if ( 0 != $zip->create( $dir . '/' . $file . '.sql', PCLZIP_OPT_REMOVE_PATH, $dir ) ) {

				//delete .sql and keep zip
				@unlink( $dir . '/' . $file . '.sql' );

				$fileext = '.zip';

			}

		}

		if ( 2 !== $this->settings['method'] || true === $one_time ) {
			require_once( ITSEC_Core::get_core_dir() . 'lib/class-itsec-mailer.php' );
			$mail = new ITSEC_Mail();
			$mail->add_header( esc_html__( 'Database Backup', 'better-wp-security' ), sprintf( wp_kses( __( 'Site Database Backup for <b>%s</b>', 'better-wp-security' ), array( 'b' => array() ) ), date_i18n( get_option( 'date_format' ) ) ) );
			$mail->add_info_box( esc_html__( 'Attached is the database backup file for your site.', 'better-wp-security' ), 'attachment' );


			$mail->add_section_heading( esc_html__( 'Website', 'better-wp-security' ) );
			$mail->add_text( esc_html( network_home_url() ) );

			$mail->add_section_heading( esc_html__( 'Date', 'better-wp-security' ) );
			$mail->add_text( esc_html( date_i18n( get_option( 'date_format' ) ) ) );

			$mail->add_footer();


			$raw_recipients = ITSEC_Modules::get_setting( 'global', 'backup_email' );
			$recipients = array();

			foreach ( $raw_recipients as $recipient ) {
				$recipient = trim( $recipient );

				if ( is_email( $recipient ) ) {
					$recipients[] = $recipient;
				}
			}

			$subject = sprintf( esc_html__( '[%s] Database Backup', 'better-wp-security' ), esc_url( network_home_url() ) );
			$subject = apply_filters( 'itsec_backup_email_subject', $subject );

			$attachment = array( "$dir/$file$fileext" );

			$mail_success = $mail->send( $recipients, $subject, $attachment );
		}

		if ( 1 === $this->settings['method'] ) {

			@unlink( $dir . '/' . $file . $fileext );

		} else {

			$retain = isset( $this->settings['retain'] ) ? absint( $this->settings['retain'] ) : 0;

			//delete extra files
			if ( 0 < $retain ) {

				$files = scandir( $dir, 1 );

				$count = 0;

				if ( is_array( $files ) && 0 < count( $files ) ) {

					foreach ( $files as $file ) {

						if ( strstr( $file, 'backup' ) ) {

							if ( $count >= $retain ) {
								@unlink( trailingslashit( $dir ) . $file );
							}

							$count ++;
						}

					}

				}

			}

		}

		if ( false === $one_time ) {
			ITSEC_Modules::set_setting( 'backup', 'last_run', ITSEC_Core::get_current_time_gmt() );
		}

		switch ( $this->settings['method'] ) {

			case 0:

				if ( false === $mail_success ) {

					$status = array(
						'status'  => __( 'Error', 'better-wp-security' ),
						'details' => __( 'saved locally but email to backup recipients could not be sent.', 'better-wp-security' ),
					);

				} else {

					$status = array(
						'status'  => __( 'Success', 'better-wp-security' ),
						'details' => __( 'emailed to backup recipients and saved locally', 'better-wp-security' ),
					);

				}

				break;
			case 1:

				if ( false === $mail_success ) {

					$status = array(
						'status'  => __( 'Error', 'better-wp-security' ),
						'details' => __( 'email to backup recipients could not be sent.', 'better-wp-security' ),
					);

				} else {

					$status = array(
						'status'  => __( 'Success', 'better-wp-security' ),
						'details' => __( 'emailed to backup recipients', 'better-wp-security' ),
					);

				}

				break;
			default:
				$status = array(
					'status'  => __( 'Success', 'better-wp-security' ),
					'details' => __( 'saved locally', 'better-wp-security' ),
				);
				break;

		}

		$itsec_logger->log_event( 'backup', 3, array( $status ) );

	}

	/**
	 * Register backups for logger.
	 *
	 * Adds the backup module to ITSEC_Logger.
	 *
	 * @since 4.0.0
	 *
	 * @param  array $logger_modules array of logger modules
	 *
	 * @return array                   array of logger modules
	 */
	public function register_logger( $logger_modules ) {

		$logger_modules['backup'] = array(
			'type'     => 'backup',
			'function' => __( 'Database Backup Executed', 'better-wp-security' ),
		);

		return $logger_modules;

	}

}
