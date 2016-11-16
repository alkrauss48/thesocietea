<?php
/**
 * Sync verb for file change detection
 *
 * Allows for file scanning to be performed remotely via iThemes Sync.
 *
 * @since   4.0.0
 *
 * @package iThemes_Security
 */
class Ithemes_Sync_Verb_ITSEC_Perform_File_Scan extends Ithemes_Sync_Verb {
	/**
	 * The name of the verb that can be called via Sync.
	 *
	 * @since 4.0.0
	 * @access public
	 * @var string
	 */
	public static $name = 'itsec-perform-file-scan';
	
	/**
	 * A description of the verb for use in Sync.
	 *
	 * @since 4.0.0
	 * @access public
	 * @var string
	 */
	public static $description = 'Perform a one-time file scan';
	
	/**
	 * Array of default arguments to process
	 *
	 * @since 4.0.0
	 * @access public
	 * @var array
	 */
	public $default_arguments = array();
	
	/**
	 * Functionaly to execute when calling the verb
	 *
	 * Functionality to execute when calling this verb VIA Sync.
	 *
	 * @since 4.0.0
	 *
	 * @return array response indicating result of the file scan
	 */
	public function run( $arguments ) {
		require_once( dirname( __FILE__ ) . '/scanner.php' );
		
		return ITSEC_File_Change_Scanner::run_scan( false, true );
	}
}
