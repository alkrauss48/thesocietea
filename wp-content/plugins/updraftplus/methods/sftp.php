<?php

if (!defined('UPDRAFTPLUS_DIR')) die('No direct access allowed.');

if (class_exists('UpdraftPlus_Addons_RemoteStorage_sftp')) {

	class UpdraftPlus_BackupModule_sftp extends UpdraftPlus_Addons_RemoteStorage_sftp {
		public function __construct() {
			parent::__construct('sftp', 'SFTP/SCP');
		}
	}
	
} else {

	require_once(UPDRAFTPLUS_DIR.'/methods/addon-not-yet-present.php');
	
	// N.B. UpdraftPlus_BackupModule_AddonNotYetPresent extends UpdraftPlus_BackupModule
	class UpdraftPlus_BackupModule_sftp extends UpdraftPlus_BackupModule_AddonNotYetPresent {
		public function __construct() {
			parent::__construct('sftp', 'SFTP/SCP');
		}
	}

}
