<?php

if ( is_multisite() ) {
	ITSEC_Modules::register_module( 'multisite-tweaks', dirname( __FILE__ ) );
}
