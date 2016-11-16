<?php
/**
 * iThemes Security Core.
 *
 * Core class for iThemes Security sets up globals and other items and dispatches modules.
 *
 * @package iThemes_Security
 *
 * @since   4.0
 *
 * @global array  $itsec_globals Global variables for use throughout iThemes Security.
 * @global object $itsec_logger  iThemes Security logging class.
 * @global object $itsec_lockout Class for handling lockouts.
 *
 */
if ( ! class_exists( 'ITSEC_Core' ) ) {

	final class ITSEC_Core {

		/**
		 * @var ITSEC_Core - Static property to hold our singleton instance
		 */
		static $instance = false;

		private
			$itsec_files,
			$itsec_notify,
			$itsec_sync,
			$plugin_build,
			$plugin_file,
			$plugin_dir,
			$current_time,
			$current_time_gmt,
			$is_iwp_call,
			$interactive,
			$request_type,
			$wp_upload_dir,
			$notices_loaded,
			$doing_data_upgrade,
			$storage_dir;

		/**
		 * Private constructor to make this a singleton
		 *
		 * @access private
		 */
		private function __construct() {}

		/**
		 * Function to instantiate our class and make it a singleton
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Loads core functionality across both admin and frontend.
		 *
		 * Creates all plugin globals, registers activation and related hooks,
		 * loads the text domain and loads all plugin modules
		 *
		 * @since 4.0
		 *
		 * @access private
		 *
		 * @param string $plugin_file The main plugin file
		 * @param string $plugin_name The plugin name
		 *
		 */
		public function init( $plugin_file, $plugin_name ) {
			global $itsec_globals, $itsec_logger, $itsec_lockout;

			$this->plugin_build = 4044; // used to trigger updates
			$this->plugin_file = $plugin_file;
			$this->plugin_dir = dirname( $plugin_file ) . '/';
			$this->current_time = current_time( 'timestamp' );
			$this->current_time_gmt = current_time( 'timestamp', true );
			$this->notices_loaded = false;
			$this->doing_data_upgrade = false;

			$this->interactive = false; // Used to distinguish between a user modifying settings and the API modifying
			                            // settings (such as from Sync requests).

			$itsec_globals = array(
				'plugin_name'      => sanitize_text_field( $plugin_name ),
				'plugin_dir'       => $this->plugin_dir,
				'current_time'     => $this->current_time,
				'current_time_gmt' => $this->current_time_gmt,
			);


			require( $this->plugin_dir . 'core/class-itsec-modules.php' );
			add_action( 'itsec-register-modules', array( $this, 'register_modules' ) );
			ITSEC_Modules::init_modules();

			require( $this->plugin_dir . 'core/class-itsec-lib.php' );
			require( $this->plugin_dir . 'core/class-itsec-logger.php' );
			require( $this->plugin_dir . 'core/class-itsec-lockout.php' );
			require( $this->plugin_dir . 'core/class-itsec-files.php' );
			require( $this->plugin_dir . 'core/class-itsec-notify.php' );
			require( $this->plugin_dir . 'core/class-itsec-response.php' );
			require( $this->plugin_dir . 'core/lib/class-itsec-lib-user-activity.php' );

			$this->itsec_files = ITSEC_Files::get_instance();
			$this->itsec_notify = new ITSEC_Notify();
			$itsec_logger = new ITSEC_Logger();
			$itsec_lockout = new ITSEC_Lockout( $this );


			//Determine if we need to run upgrade scripts
			$plugin_data = get_site_option( 'itsec_data' );

			if ( false === $plugin_data ) {
				$plugin_data = $this->save_plugin_data();
			}

			$itsec_globals['data'] = $plugin_data;

			if ( ( isset( $plugin_data['build'] ) && $plugin_data['build'] !== $this->plugin_build ) ) {
				// We need to upgrade the data. Delay init of the rest of the plugin until the upgrade is complete.

				$this->doing_data_upgrade = true;

				// Run the actions early so that the rest of the code can still use the plugins_loaded hook.
				add_action( 'plugins_loaded', array( $this, 'execute_upgrade' ), -100 );
				add_action( 'plugins_loaded', array( $this, 'continue_init' ), -90 );
			} else {
				$this->continue_init();
			}
		}

		public function continue_init() {
			ITSEC_Modules::run_active_modules();


			add_action( 'ithemes_sync_register_verbs', array( $this, 'register_sync_verbs' ) );

			if ( is_admin() ) {
				require( $this->plugin_dir . 'core/admin-pages/init.php' );

				//add action link
				add_filter( 'plugin_action_links', array( $this, 'add_action_link' ), 10, 2 );

				//add plugin meta links
				add_filter( 'plugin_row_meta', array( $this, 'add_plugin_meta_links' ), 10, 4 );

			}

			register_activation_hook( $this->plugin_file, array( 'ITSEC_Core', 'on_activate' ) );
			register_deactivation_hook( $this->plugin_file, array( 'ITSEC_Core', 'on_deactivate' ) );
			register_uninstall_hook( $this->plugin_file, array( 'ITSEC_Core', 'on_uninstall' ) );

			//Admin bar links
			if ( ! ITSEC_Modules::get_setting( 'global', 'hide_admin_bar' ) ) {
				add_action( 'admin_bar_menu', array( $this, 'admin_bar_links' ), 99 );
			}

			//See if they're upgrade from Better WP Security
			if ( is_multisite() && true === ITSEC_Modules::get_setting( 'global', 'did_upgrade' ) ) {

				switch_to_blog( 1 );

				$bwps_options = get_option( 'bit51_bwps' );

				restore_current_blog();

			} else {

				$bwps_options = get_option( 'bit51_bwps' );

			}

			if ( $bwps_options !== false ) {
				add_action( 'plugins_loaded', array( $this, 'do_upgrade' ) );
			}


			do_action( 'itsec_initialized' );
		}

		public static function get_itsec_files() {
			$self = self::get_instance();
			return $self->itsec_files;
		}

		public static function get_itsec_notify() {
			$self = self::get_instance();
			return $self->itsec_notify;
		}

		public static function get_itsec_sync() {
			$self = self::get_instance();

			if ( ! isset( $self->itsec_sync ) ) {
				require( dirname( __FILE__ ) . '/class-itsec-sync.php' );
				$self->itsec_sync = new ITSEC_Sync();
			}

			return $self->itsec_sync;
		}

		public function register_sync_verbs( $sync_api ) {
			$itsec_sync = self::get_itsec_sync();
			$itsec_sync->register_verbs( $sync_api );
		}

		public function register_modules() {
			$path = dirname( __FILE__ );

			include( "$path/modules/security-check/init.php" );
			include( "$path/modules/global/init.php" );
			include( "$path/modules/404-detection/init.php" );
			include( "$path/modules/away-mode/init.php" );
			include( "$path/modules/ban-users/init.php" );
			include( "$path/modules/brute-force/init.php" );
			include( "$path/modules/core/init.php" );
			include( "$path/modules/backup/init.php" );
			include( "$path/modules/file-change/init.php" );
			include( "$path/modules/file-permissions/init.php" );
			include( "$path/modules/hide-backend/init.php" );
			include( "$path/modules/ipcheck/init.php" );
			include( "$path/modules/malware/init.php" );
			include( "$path/modules/ssl/init.php" );
			include( "$path/modules/strong-passwords/init.php" );
			include( "$path/modules/system-tweaks/init.php" );
			include( "$path/modules/wordpress-tweaks/init.php" );
			include( "$path/modules/multisite-tweaks/init.php" );

			include( "$path/modules/admin-user/init.php" );
			include( "$path/modules/salts/init.php" );
			include( "$path/modules/content-directory/init.php" );
			include( "$path/modules/database-prefix/init.php" );
			include( "$path/modules/file-writing/init.php" );
			if ( ! ITSEC_Core::is_pro() ) {
				include( "$path/modules/pro/init.php" );
			}
		}

		/**
		 * Add action link to plugin page.
		 *
		 * Adds plugin settings link to plugin page in WordPress admin area.
		 *
		 * @since 4.0
		 *
		 * @param object $links Array of WordPress links
		 * @param string $file  String name of current file
		 *
		 * @return object Array of WordPress links
		 *
		 */
		function add_action_link( $links, $file ) {

			static $this_plugin;

			global $itsec_globals;

			if ( empty( $this_plugin ) ) {
				$this_plugin = str_replace( WP_PLUGIN_DIR . '/', '', self::get_plugin_file() );
			}

			if ( $file == $this_plugin ) {
				$settings_link = '<a href="' . esc_url( self::get_settings_page_url() ) . '">' . __( 'Settings', 'better-wp-security' ) . '</a>';
				array_unshift( $links, $settings_link );
			}

			return $links;
		}

		/**
		 * Adds links to the plugin row meta
		 *
		 * @since 4.0
		 *
		 * @param array  $meta        Existing meta
		 * @param string $plugin_file the wp plugin slug (path)
		 *
		 * @return array
		 */
		public function add_plugin_meta_links( $meta, $plugin_file ) {

			global $itsec_globals;
			$plugin_base = str_replace( WP_PLUGIN_DIR . '/', '', self::get_plugin_file() );

			if ( $plugin_base == $plugin_file ) {

				$meta = apply_filters( 'itsec_meta_links', $meta );

			}

			return $meta;
		}

		/**
		 * Add admin bar item
		 *
		 * @since 4.0
		 *
		 * @return void
		 */
		public function admin_bar_links() {

			global $wp_admin_bar, $itsec_globals;

			if ( ! ITSEC_Core::current_user_can_manage() ) {
				return;
			}

			// Add the Parent link.
			$wp_admin_bar->add_menu(
				array(
					'title' => __( 'Security', 'better-wp-security' ),
					'href'  => self::get_settings_page_url(),
					'id'    => 'itsec_admin_bar_menu',
				)
			);

			$wp_admin_bar->add_menu(
				array(
					'id'     => 'itsec_admin_bar_settings',
					'title'  => __( 'Settings', 'better-wp-security' ),
					'href'   => self::get_settings_page_url(),
					'parent' => 'itsec_admin_bar_menu',
				)
			);

			$wp_admin_bar->add_menu(
				array(
					'id'     => 'itsec_admin_bar_security_check',
					'title'  => __( 'Security Check', 'better-wp-security' ),
					'href'   => self::get_security_check_page_url(),
					'parent' => 'itsec_admin_bar_menu',
				)
			);

			$wp_admin_bar->add_menu(
				array(
					'id'     => 'itsec_admin_bar_logs',
					'title'  => __( 'Logs', 'better-wp-security' ),
					'href'   => self::get_logs_page_url(),
					'parent' => 'itsec_admin_bar_menu',
				)
			);
		}

		/**
		 * Calls upgrade script for older versions (pre 4.x).
		 *
		 * @since 4.0
		 *
		 * @return void
		 */
		public function do_upgrade() {

			global $itsec_globals;

			//require plugin setup information
			if ( ! class_exists( 'ITSEC_Setup' ) ) {
				require( self::get_core_dir() . '/class-itsec-setup.php' );
			}

			new ITSEC_Setup( 'upgrade', 3064 ); //run upgrade scripts

		}

		/**
		 * Execute upgrade for version after 4.0
		 *
		 * @since 4.0.6
		 *
		 * @return void
		 */
		public function execute_upgrade( $current_data_build = false ) {

			global $itsec_globals;

			$this->doing_data_upgrade = true;

			//require plugin setup information
			if ( ! class_exists( 'ITSEC_Setup' ) ) {
				require( self::get_core_dir() . '/class-itsec-setup.php' );
			}

			if ( empty( $current_data_build ) ) {
				$current_data_build = $itsec_globals['data']['build'];
			}

			new ITSEC_Setup( 'upgrade', $current_data_build ); //run upgrade scripts

			$itsec_modules = ITSEC_Modules::get_instance();
			$itsec_modules->run_activation();

		}

		/**
		 * Call activation script
		 *
		 * @since 4.5
		 *
		 * @return void
		 */
		public static function on_activate() {

			//require plugin setup information
			if ( ! class_exists( 'ITSEC_Setup' ) ) {
				require( self::get_core_dir() . '/class-itsec-setup.php' );
			}

			ITSEC_Setup::on_activate();

		}

		/**
		 * Call deactivation script
		 *
		 * @since 4.5
		 *
		 * @return void
		 */
		public static function on_deactivate() {

			//require plugin setup information
			if ( ! class_exists( 'ITSEC_Setup' ) ) {
				require( self::get_core_dir() . '/class-itsec-setup.php' );
			}

			ITSEC_Setup::on_deactivate();

		}

		/**
		 * Call uninstall script
		 *
		 * @since 4.5
		 *
		 * @return void
		 */
		public static function on_uninstall() {

			// Ensure that the uninstall routines are run only if there are no other iThemes Security plugins active.
			$active_plugins = get_option( 'active_plugins', array() );
			if ( ! is_array( $active_plugins ) ) {
				$active_plugins = array();
			}

			if ( is_multisite() ) {
				$network_plugins = (array) get_site_option( 'active_sitewide_plugins', array() );
				$active_plugins = array_merge( $active_plugins, array_keys( $network_plugins ) );
			}

			foreach ( $active_plugins as $active_plugin ) {
				$file = basename( $active_plugin );

				if ( in_array( $file, array( 'better-wp-security.php', 'ithemes-security-pro.php' ) ) ) {
					return;
				}
			}

			require_once( self::get_core_dir() . '/class-itsec-setup.php' );
			ITSEC_Setup::on_uninstall();

		}

		/**
		 * Saves general plugin data to determine global items.
		 *
		 * Sets up general plugin data such as build, and others.
		 *
		 * @since 4.0
		 *
		 * @return array plugin data
		 */
		public function save_plugin_data() {

			global $itsec_globals;

			$save_data = false; //flag to avoid saving data if we don't have to

			$plugin_data = get_site_option( 'itsec_data' );

			//Update the build number if we need to
			if ( ! isset( $plugin_data['build'] ) || ( isset( $plugin_data['build'] ) && $plugin_data['build'] !== $this->plugin_build ) ) {
				$plugin_data['build'] = $this->plugin_build;
				$save_data            = true;
			}

			//update the activated time if we need to in order to tell when the plugin was installed
			if ( ! isset( $plugin_data['activation_timestamp'] ) ) {
				$plugin_data['activation_timestamp'] = self::get_current_time_gmt();
				$save_data                           = true;
			}

			//update the activated time if we need to in order to tell when the plugin was installed
			if ( ! isset( $plugin_data['already_supported'] ) ) {
				$plugin_data['already_supported'] = false;
				$save_data                        = true;
			}

			//update the activated time if we need to in order to tell when the plugin was installed
			if ( ! isset( $plugin_data['setup_completed'] ) ) {
				$plugin_data['setup_completed'] = false;
				$save_data                      = true;
			}

			//update the tooltips dismissed
			if ( ! isset( $plugin_data['tooltips_dismissed'] ) ) {
				$plugin_data['tooltips_dismissed'] = false;
				$save_data                         = true;
			}

			//update the options table if we have to
			if ( $save_data === true ) {
				update_site_option( 'itsec_data', $plugin_data );
			}

			return $plugin_data;

		}

		public static function add_notice( $callback, $all_pages = false ) {
			global $pagenow, $plugin_page;

			if ( ! $all_pages && ! in_array( $pagenow, array( 'plugins.php', 'update-core.php' ) ) && ( ! isset( $plugin_page ) || ! in_array( $plugin_page, array( 'itsec', 'itsec-logs' ) ) ) ) {
				return;
			}

			$self = self::get_instance();

			if ( ! $self->notices_loaded ) {
				wp_enqueue_style( 'itsec-notice', plugins_url( 'core/css/itsec_notice.css', ITSEC_Core::get_core_dir() ), array(), '20160609' );
				wp_enqueue_script( 'itsec-notice', plugins_url( 'core/js/itsec-notice.js', ITSEC_Core::get_core_dir() ), array(), '20160512' );

				$self->notices_loaded = true;
			}

			if ( is_multisite() ) {
				add_action( 'network_admin_notices', $callback );
			} else {
				add_action( 'admin_notices', $callback );
			}
		}

		public static function get_required_cap() {
			return apply_filters( 'itsec_cap_required', is_multisite() ? 'manage_network_options' : 'manage_options' );
		}

		public static function current_user_can_manage() {
			return current_user_can( self::get_required_cap() );
		}

		public static function get_plugin_file() {
			$self = self::get_instance();
			return $self->plugin_file;
		}

		public static function set_plugin_file( $plugin_file ) {
			$self = self::get_instance();
			$self->plugin_file = $plugin_file;
			$self->plugin_dir = dirname( $plugin_file ) . '/';
		}

		public static function get_plugin_build() {
			$self = self::get_instance();
			return $self->plugin_build;
		}

		public static function get_plugin_dir() {
			$self = self::get_instance();
			return $self->plugin_dir;
		}

		public static function get_core_dir() {
			return self::get_plugin_dir() . 'core/';
		}

		public static function is_pro() {
			return is_dir( self::get_plugin_dir() . 'pro' );
		}

		public static function get_current_time() {
			$self = self::get_instance();
			return $self->current_time;
		}

		public static function get_current_time_gmt() {
			$self = self::get_instance();
			return $self->current_time_gmt;
		}

		public static function get_time_offset() {
			$self = self::get_instance();
			return $self->current_time - $self->current_time_gmt;
		}

		public static function get_settings_page_url() {
			$url = network_admin_url( 'admin.php?page=itsec' );

			return $url;
		}

		public static function get_logs_page_url( $filter = false ) {
			$url = network_admin_url( 'admin.php?page=itsec-logs' );

			if ( ! empty( $filter ) ) {
				$url = add_query_arg( array( 'filter' => $filter ), $url );
			}

			return $url;
		}

		public static function get_backup_creation_page_url() {
			$url = network_admin_url( 'admin.php?page=itsec&module=backup' );

			$url = apply_filters( 'itsec-filter-backup-creation-page-url', $url );

			return $url;
		}

		public static function get_security_check_page_url() {
			return network_admin_url( 'admin.php?page=itsec&module=security-check' );
		}

		public static function set_interactive( $interactive ) {
			$self = self::get_instance();
			$self->interactive = (bool) $interactive;
		}

		public static function is_interactive() {
			$self = self::get_instance();
			return $self->interactive;
		}

		public static function is_iwp_call() {
			$self = self::get_instance();

			if ( isset( $self->is_iwp_call ) ) {
				return $self->is_iwp_call;
			}


			$self->is_iwp_call = false;

			if ( false && ! ITSEC_Modules::get_setting( 'global', 'infinitewp_compatibility' ) ) {
				return false;
			}


			$post_data = @file_get_contents( 'php://input' );

			if ( ! empty( $post_data ) ) {
				$data = base64_decode( $post_data );

				if ( false !== strpos( $data, 's:10:"iwp_action";' ) ) {
					$self->is_iwp_call = true;
				}
			}

			return $self->is_iwp_call;
		}

		public static function get_wp_upload_dir() {
			$self = self::get_instance();

			if ( isset( $self->wp_upload_dir ) ) {
				return $self->wp_upload_dir;
			}

			$wp_upload_dir = get_site_transient( 'itsec_wp_upload_dir' );

			if ( ! is_array( $wp_upload_dir ) || ! isset( $wp_upload_dir['basedir'] ) || ! is_dir( $wp_upload_dir['basedir'] ) ) {
				if ( is_multisite() ) {
					switch_to_blog( 1 );
					$wp_upload_dir = wp_upload_dir();
					restore_current_blog();
				} else {
					$wp_upload_dir = wp_upload_dir();
				}

				set_site_transient( 'itsec_wp_upload_dir', $wp_upload_dir, DAY_IN_SECONDS );
			}

			$self->wp_upload_dir = $wp_upload_dir;

			return $self->wp_upload_dir;
		}

		public static function update_wp_upload_dir( $old_dir, $new_dir ) {
			$self = self::get_instance();

			// Prime caches.
			self::get_wp_upload_dir();

			$self->wp_upload_dir = str_replace( $old_dir, $new_dir, $self->wp_upload_dir );

			// Ensure that the transient will be regenerated on the next page load.
			delete_site_transient( 'itsec_wp_upload_dir' );
		}

		public static function get_storage_dir( $dir = '' ) {
			$self = self::get_instance();

			require_once( self::get_core_dir() . '/lib/class-itsec-lib-directory.php' );

			if ( ! isset( $self->storage_dir ) ) {
				$wp_upload_dir = self::get_wp_upload_dir();

				$self->storage_dir = $wp_upload_dir['basedir'] . '/ithemes-security/';
			}

			$dir = $self->storage_dir . $dir;
			$dir = rtrim( $dir, '/' );

			ITSEC_Lib_Directory::create( $dir );

			return $dir;
		}

		public static function doing_data_upgrade() {
			$self = self::get_instance();

			return $self->doing_data_upgrade;
		}
	}
}
