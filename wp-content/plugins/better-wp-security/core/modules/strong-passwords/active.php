<?php

require_once( 'class-itsec-strong-passwords.php' );
$itsec_strong_passwords = new ITSEC_Strong_Passwords();
$itsec_strong_passwords->run( ITSEC_Core::get_instance() );
