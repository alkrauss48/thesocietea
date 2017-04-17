<?php

if (!defined('UPDRAFTPLUS_DIR')) die('No direct access allowed.');

if (class_exists('UpdraftPlus_Addons_RemoteStorage_webdav')) {

	class UpdraftPlus_BackupModule_webdav extends UpdraftPlus_Addons_RemoteStorage_webdav {
		public function __construct() {
			parent::__construct('webdav', 'WebDAV');
		}
	}
	
} else {

	require_once(UPDRAFTPLUS_DIR.'/methods/addon-not-yet-present.php');
	
	// N.B. UpdraftPlus_BackupModule_AddonNotYetPresent extends UpdraftPlus_BackupModule
	class UpdraftPlus_BackupModule_webdav extends UpdraftPlus_BackupModule_AddonNotYetPresent {
		public function __construct() {
			parent::__construct('webdav', 'WebDAV');
		}
	}

}
