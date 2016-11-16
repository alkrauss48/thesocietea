<?php
/**
 * Handles the abstraction of sync integration.
 *
 * Registers modules with sync verbs and loads appropriate verb classes where applicable.
 *
 * @package iThemes_Security
 *
 * @since   4.0.0
 */
final class ITSEC_Sync {

	/**
	 * The module's that have registered with sync
	 *
	 * @since  4.1.0
	 * @access private
	 * @var array
	 */
	private $sync_modules = false;

	/**
	 * Loads sync modules
	 *
	 * Executes primary file actions at plugins_loaded.
	 *
	 * @since  4.1.0
	 *
	 * @return ITSEC_Sync
	 */
	public function __construct() {}

	/**
	 * Returns all modules registered with Sync.
	 *
	 * Returns an array of all modules containing sync verbs.
	 *
	 * @since 4.1.0
	 *
	 * @return array sync module registrations
	 */
	public function get_modules() {
		if ( is_array( $this->sync_modules ) ) {
			return $this->sync_modules;
		}
		
		$this->sync_modules = apply_filters( 'itsec_sync_modules', array() );
		
		if ( ! is_array( $this->sync_modules ) ) {
			$this->sync_modules = array();
		}
		
		return $this->sync_modules;

	}

	/**
	 * Register verbs for iThemes Sync.
	 *
	 * Registers all verbs for a given module.
	 *
	 * @since 4.1.0
	 *
	 * @param object $api iThemes Sync Object
	 *
	 * @return void
	 */
	public function register_verbs( $api ) {
		$modules = $this->get_modules();

		foreach ( $modules as $module ) {

			if ( isset( $module['verbs'] ) && isset( $module['path'] ) ) {

				foreach ( $module['verbs'] as $name => $class ) {

					$api->register( $name, $class, trailingslashit( $module['path'] ) . 'class-ithemes-sync-verb-' . $name . '.php' );

				}

			}

		}

		$api->register( 'itsec-get-everything', 'Ithemes_Sync_Verb_ITSEC_Get_Everything', dirname( __FILE__ ) . '/class-ithemes-sync-verb-itsec-get-everything.php' );

	}

}
