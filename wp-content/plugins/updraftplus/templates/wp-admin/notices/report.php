<?php if (!defined('UPDRAFTPLUS_DIR')) die('No direct access allowed'); ?>

<strong><?php
	if (!empty($prefix)) echo $prefix.' ';
	echo $title;
?></strong>: 
<?php 
	echo $text;

	if (isset($discount_code)) echo ' <b>' . $discount_code . '</b>';

// 	if (isset($text2)) {
// 		echo '</p><p>' . $text2 . '</p><p>';
// 	}
	
	if (!empty($button_link) && !empty($button_meta)) {
?>
 <a class="updraft_notice_link" href="<?php esc_attr_e(apply_filters('updraftplus_com_link',$button_link));?>"><?php 
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
	?></a><br> <br>
	
<?php }
