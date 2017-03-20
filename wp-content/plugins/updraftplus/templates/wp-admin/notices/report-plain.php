<?php

if (!defined('UPDRAFTPLUS_DIR')) die('No direct access allowed');

if (!empty($prefix)) echo $prefix.' ';
echo $title.': ';

echo empty($text_plain) ? $text : $text_plain;

if (!empty($discount_code)) echo $discount_code.' ';

// 	if (isset($text2)) {
// 		echo "\r\n\r\n" . $text2 . "\r\n\r\n";
// 	}

if (!empty($button_link) && !empty($button_meta)) {

	echo ' ';

	$link = apply_filters('updraftplus_com_link', $button_link);

	if ($button_meta == 'updraftcentral') {
		_e('Get UpdraftCentral', 'updraftplus');
	} elseif ($button_meta == 'review') {
		_e('Review UpdraftPlus', 'updraftplus');
	} elseif ($button_meta == 'updraftplus') {
		_e('Get Premium', 'updraftplus');
	} elseif ($button_meta == 'signup') {
		_e('Sign up', 'updraftplus');
	} elseif ($button_meta == 'go_there') {
		_e('Go there', 'updraftplus');
	} else {
		_e('Read more', 'updraftplus');
	}

	echo ' - '.$link;
	echo "\r\n";
	
}
