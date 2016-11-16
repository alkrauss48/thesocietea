<?php

class Ithemes_Sync_Verb_ITSEC_Malware_Do_Scan extends Ithemes_Sync_Verb {
	public static $name = 'itsec-do-malware-scan';
	public static $description = '';
	
	public $default_arguments = array();
	
	public function run( $arguments ) {
		$arguments = Ithemes_Sync_Functions::merge_defaults( $arguments, $this->default_arguments );
		
		require_once( dirname( __FILE__ ) . '/class-itsec-malware-scanner.php' );
		
		return ITSEC_Malware_Scanner::scan();
	}

}
