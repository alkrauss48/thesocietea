<?php
/*
Plugin Name: Velvet Blues Update URLs
Plugin URI: https://justin-greer.com
Description: This plugin <strong>updates all urls in your website</strong> by replacing old urls with new urls. To get started: 1) Click the "Activate" link to the left of this description, and 2) Go to your <a href="tools.php?page=velvet-blues-update-urls.php">Update URLs</a> page to use it.
Author: justingreerbbi
Author URI: https://justin-greer.com
Author Email: info@justin-greer.com
Version: 3.2.5
License: GPLv2 or later
Text Domain: velvet-blues-update-urls
*/

/*
Copyright 2016  Justin Greer Interactive, LLC

Original Author Copyright! Kudos.
Copyright 2015  Velvet Blues Web Design

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
if ( !function_exists( 'add_action' ) ) { exit; 
}
function VelvetBluesUU_add_management_page(){
	add_management_page("Velvet Blues Update URLs", "Update URLs", "manage_options", basename(__FILE__), "VelvetBluesUU_management_page");
}
function VelvetBluesUU_load_textdomain(){
	load_plugin_textdomain( 'velvet-blues-update-urls', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
function VelvetBluesUU_management_page(){
	if ( !function_exists( 'VB_update_urls' ) ) {
		function VB_update_urls($options,$oldurl,$newurl){	
			global $wpdb;
			$results = array();
			$queries = array(
			'content' =>		array("UPDATE $wpdb->posts SET post_content = replace(post_content, %s, %s)",  __('Content Items (Posts, Pages, Custom Post Types, Revisions)','velvet-blues-update-urls') ),
			'excerpts' =>		array("UPDATE $wpdb->posts SET post_excerpt = replace(post_excerpt, %s, %s)", __('Excerpts','velvet-blues-update-urls') ),
			'attachments' =>	array("UPDATE $wpdb->posts SET guid = replace(guid, %s, %s) WHERE post_type = 'attachment'",  __('Attachments','velvet-blues-update-urls') ),
			'links' =>			array("UPDATE $wpdb->links SET link_url = replace(link_url, %s, %s)", __('Links','velvet-blues-update-urls') ),
			'custom' =>			array("UPDATE $wpdb->postmeta SET meta_value = replace(meta_value, %s, %s)",  __('Custom Fields','velvet-blues-update-urls') ),
			'guids' =>			array("UPDATE $wpdb->posts SET guid = replace(guid, %s, %s)",  __('GUIDs','velvet-blues-update-urls') )
			);
			foreach($options as $option){
				if( $option == 'custom' ){
					$n = 0;
					$row_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->postmeta" );
					$page_size = 10000;
					$pages = ceil( $row_count / $page_size );
					
					for( $page = 0; $page < $pages; $page++ ) {
						$current_row = 0;
						$start = $page * $page_size;
						$end = $start + $page_size;
						$pmquery = "SELECT * FROM $wpdb->postmeta WHERE meta_value <> ''";
						$items = $wpdb->get_results( $pmquery );
						foreach( $items as $item ){
						$value = $item->meta_value;
						if( trim($value) == '' )
							continue;
						
							$edited = VB_unserialize_replace( $oldurl, $newurl, $value );
						
							if( $edited != $value ){
								$fix = $wpdb->query("UPDATE $wpdb->postmeta SET meta_value = '".$edited."' WHERE meta_id = ".$item->meta_id );
								if( $fix )
									$n++;
							}
						}
					}
					$results[$option] = array($n, $queries[$option][1]);
				}
				else{
					$result = $wpdb->query( $wpdb->prepare( $queries[$option][0], $oldurl, $newurl) );
					$results[$option] = array($result, $queries[$option][1]);
				}
			}
			return $results;			
		}
	}
	if ( !function_exists( 'VB_unserialize_replace' ) ) {
		function VB_unserialize_replace( $from = '', $to = '', $data = '', $serialised = false ) {
			try {
				if ( false !== is_serialized( $data ) ) {
					$unserialized = unserialize( $data );
					$data = VB_unserialize_replace( $from, $to, $unserialized, true );
				}
				elseif ( is_array( $data ) ) {
					$_tmp = array( );
					foreach ( $data as $key => $value ) {
						$_tmp[ $key ] = VB_unserialize_replace( $from, $to, $value, false );
					}
					$data = $_tmp;
					unset( $_tmp );
				}
				else {
					if ( is_string( $data ) )
						$data = str_replace( $from, $to, $data );
				}
				if ( $serialised )
					return serialize( $data );
			} catch( Exception $error ) {
			}
			return $data;
		}
	}
	if ( isset( $_POST['VBUU_settings_submit'] ) && !check_admin_referer('VBUU_submit','VBUU_nonce')){
		if(isset($_POST['VBUU_oldurl']) && isset($_POST['VBUU_newurl'])){
			if(function_exists('esc_attr')){
				$vbuu_oldurl = esc_attr(trim($_POST['VBUU_oldurl']));
				$vbuu_newurl = esc_attr(trim($_POST['VBUU_newurl']));
			}else{
				$vbuu_oldurl = attribute_escape(trim($_POST['VBUU_oldurl']));
				$vbuu_newurl = attribute_escape(trim($_POST['VBUU_newurl']));
			}
		}
		echo '<div id="message" class="error fade"><p><strong>'.__('ERROR','velvet-blues-update-urls').' - '.__('Please try again.','velvet-blues-update-urls').'</strong></p></div>';
	}
	elseif( isset( $_POST['VBUU_settings_submit'] ) && !isset( $_POST['VBUU_update_links'] ) ){
		if(isset($_POST['VBUU_oldurl']) && isset($_POST['VBUU_newurl'])){
			if(function_exists('esc_attr')){
				$vbuu_oldurl = esc_attr(trim($_POST['VBUU_oldurl']));
				$vbuu_newurl = esc_attr(trim($_POST['VBUU_newurl']));
			}else{
				$vbuu_oldurl = attribute_escape(trim($_POST['VBUU_oldurl']));
				$vbuu_newurl = attribute_escape(trim($_POST['VBUU_newurl']));
			}
		}
		echo '<div id="message" class="error fade"><p><strong>'.__('ERROR','velvet-blues-update-urls').' - '.__('Your URLs have not been updated.','velvet-blues-update-urls').'</p></strong><p>'.__('Please select at least one checkbox.','velvet-blues-update-urls').'</p></div>';
	}
	elseif( isset( $_POST['VBUU_settings_submit'] ) ){
		$vbuu_update_links = $_POST['VBUU_update_links'];
		if(isset($_POST['VBUU_oldurl']) && isset($_POST['VBUU_newurl'])){
			if(function_exists('esc_attr')){
				$vbuu_oldurl = esc_attr(trim($_POST['VBUU_oldurl']));
				$vbuu_newurl = esc_attr(trim($_POST['VBUU_newurl']));
			}else{
				$vbuu_oldurl = attribute_escape(trim($_POST['VBUU_oldurl']));
				$vbuu_newurl = attribute_escape(trim($_POST['VBUU_newurl']));
			}
		}
		if(($vbuu_oldurl && $vbuu_oldurl != 'http://www.oldurl.com' && trim($vbuu_oldurl) != '') && ($vbuu_newurl && $vbuu_newurl != 'http://www.newurl.com' && trim($vbuu_newurl) != '')){
			$results = VB_update_urls($vbuu_update_links,$vbuu_oldurl,$vbuu_newurl);
			$empty = true;
			$emptystring = '<strong>'.__('Why do the results show 0 URLs updated?','velvet-blues-update-urls').'</strong><br/>'.__('This happens if a URL is incorrect OR if it is not found in the content. Check your URLs and try again.','velvet-blues-update-urls').'<br/><br/><strong>'.__('Want us to do it for you?','velvet-blues-update-urls').'</strong><br/>'.__('Contact us at','velvet-blues-update-urls').' <a href="mailto:info@velvetblues.com?subject=Move%20My%20WP%20Site">info@velvetblues.com</a>. '.__('We will backup your website and move it for $65 OR simply update your URLs for only $29.','velvet-blues-update-urls');

			$resultstring = '';
			foreach($results as $result){
				$empty = ($result[0] != 0 || $empty == false)? false : true;
				$resultstring .= '<br/><strong>'.$result[0].'</strong> '.$result[1];
			}
			
			if( $empty ):
			?>
<div id="message" class="error fade">
<table>
<tr>
	<td><p><strong>
			<?php _e('ERROR: Something may have gone wrong.','velvet-blues-update-urls'); ?>
			</strong><br/>
			<?php _e('Your URLs have not been updated.','velvet-blues-update-urls'); ?>
		</p>
		<?php
			else:
			?>
		<div id="message" class="updated fade">
			<table>
				<tr>
					<td><p><strong>
							<?php _e('Success! Your URLs have been updated.','velvet-blues-update-urls'); ?>
							</strong></p>
						<?php
			endif;
			?>
						<p><u>
							<?php _e('Results','velvet-blues-update-urls'); ?>
							</u><?php echo $resultstring; ?></p>
						<?php echo ($empty)? '<p>'.$emptystring.'</p>' : ''; ?></td>
					<td width="60"></td>
					<td align="center"></td>
				</tr>
			</table>
		</div>
		<?php
		}
		else{
			echo '<div id="message" class="error fade"><p><strong>'.__('ERROR','velvet-blues-update-urls').' - '.__('Your URLs have not been updated.','velvet-blues-update-urls').'</p></strong><p>'.__('Please enter values for both the old url and the new url.','velvet-blues-update-urls').'</p></div>';
		}
	}
?>
		<div class="wrap">
		<h2>Velvet Blues Update URLs</h2>
		<form method="post" action="tools.php?page=<?php echo basename(__FILE__); ?>">
			<?php wp_nonce_field('VBUU_submit','VBUU_nonce'); ?>
			<p><?php printf(__("After moving a website, %s lets you fix old URLs in content, excerpts, links, and custom fields.",'velvet-blues-update-urls'),'<strong>Update URLs</strong>'); ?></p>
			<p><strong>
				<?php _e('WE RECOMMEND THAT YOU BACKUP YOUR WEBSITE.','velvet-blues-update-urls'); ?>
				</strong><br/>
				<?php _e('You may need to restore it if incorrect URLs are entered in the fields below.','velvet-blues-update-urls'); ?>
			</p>
			<h3 style="margin-bottom:5px;">
				<?php _e('Step'); ?>
				1:
				<?php _e('Enter your URLs in the fields below','velvet-blues-update-urls'); ?>
			</h3>
			<table class="form-table">
				<tr valign="middle">
					<th scope="row" width="140" style="width:140px"><strong>
						<?php _e('Old URL','velvet-blues-update-urls'); ?>
						</strong><br/>
						<span class="description">
						<?php _e('Old Site Address','velvet-blues-update-urls'); ?>
						</span></th>
					<td><input name="VBUU_oldurl" type="text" id="VBUU_oldurl" value="<?php echo (isset($vbuu_oldurl) && trim($vbuu_oldurl) != '')? $vbuu_oldurl : 'http://www.oldurl.com'; ?>" style="width:300px;font-size:20px;" onfocus="if(this.value=='http://www.oldurl.com') this.value='';" onblur="if(this.value=='') this.value='http://www.oldurl.com';" /></td>
				</tr>
				<tr valign="middle">
					<th scope="row" width="140" style="width:140px"><strong>
						<?php _e('New URL','velvet-blues-update-urls'); ?>
						</strong><br/>
						<span class="description">
						<?php _e('New Site Address','velvet-blues-update-urls'); ?>
						</span></th>
					<td><input name="VBUU_newurl" type="text" id="VBUU_newurl" value="<?php echo (isset($vbuu_newurl) && trim($vbuu_newurl) != '')? $vbuu_newurl : 'http://www.newurl.com'; ?>" style="width:300px;font-size:20px;" onfocus="if(this.value=='http://www.newurl.com') this.value='';" onblur="if(this.value=='') this.value='http://www.newurl.com';" /></td>
				</tr>
			</table>
			<br/>
			<h3 style="margin-bottom:5px;">
				<?php _e('Step'); ?>
				2:
				<?php _e('Choose which URLs should be updated','velvet-blues-update-urls'); ?>
			</h3>
			<table class="form-table">
				<tr>
					<td><p style="line-height:20px;">
							<input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true" value="content" checked="checked" />
							<label for="VBUU_update_true"><strong>
								<?php _e('URLs in page content','velvet-blues-update-urls'); ?>
								</strong> (
								<?php _e('posts, pages, custom post types, revisions','velvet-blues-update-urls'); ?>
								)</label>
							<br/>
							<input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true1" value="excerpts" />
							<label for="VBUU_update_true1"><strong>
								<?php _e('URLs in excerpts','velvet-blues-update-urls'); ?>
								</strong></label>
							<br/>
							<input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true2" value="links" />
							<label for="VBUU_update_true2"><strong>
								<?php _e('URLs in links','velvet-blues-update-urls'); ?>
								</strong></label>
							<br/>
							<input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true3" value="attachments" />
							<label for="VBUU_update_true3"><strong>
								<?php _e('URLs for attachments','velvet-blues-update-urls'); ?>
								</strong> (
								<?php _e('images, documents, general media','velvet-blues-update-urls'); ?>
								)</label>
							<br/>
							<input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true4" value="custom" />
							<label for="VBUU_update_true4"><strong>
								<?php _e('URLs in custom fields and meta boxes','velvet-blues-update-urls'); ?>
								</strong></label>
							<br/>
							<input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true5" value="guids" />
							<label for="VBUU_update_true5"><strong>
								<?php _e('Update ALL GUIDs','velvet-blues-update-urls'); ?>
								</strong> <span class="description" style="color:#f00;">
								<?php _e('GUIDs for posts should only be changed on development sites.','velvet-blues-update-urls'); ?>
								</span> <a href="http://codex.wordpress.org/Changing_The_Site_URL#Important_GUID_Note" target="_blank">
								<?php _e('Learn More.','velvet-blues-update-urls'); ?>
								</a></label>
						</p></td>
				</tr>
			</table>
			<p>
				<input class="button-primary" name="VBUU_settings_submit" value="<?php _e('Update URLs NOW','velvet-blues-update-urls'); ?>" type="submit" />
			</p>
		</form>
		<?php
}
add_action('admin_menu', 'VelvetBluesUU_add_management_page');
add_action('admin_init','VelvetBluesUU_load_textdomain');
?>
