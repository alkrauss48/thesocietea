<?php

final class ITSEC_WordPress_Tweaks_Settings_Page extends ITSEC_Module_Settings_Page {
	public function __construct() {
		$this->id = 'wordpress-tweaks';
		$this->title = __( 'WordPress Tweaks', 'better-wp-security' );
		$this->description = __( 'Advanced settings that improve security by changing default WordPress behavior.', 'better-wp-security' );
		$this->type = 'recommended';
		
		parent::__construct();
	}
	
	protected function render_description( $form ) {
		
?>
	<p><?php _e( 'These are advanced settings that may be utilized to further strengthen the security of your WordPress site.', 'better-wp-security' ); ?></p>
<?php
		
	}
	
	protected function render_settings( $form ) {
		$settings = $form->get_options();
		
		
		$xmlrpc_options = array(
			'2' => __( 'Disable XML-RPC (recommended)', 'better-wp-security' ),
			'1' => __( 'Disable Pingbacks', 'better-wp-security' ),
			'0' => __( 'Enable XML-RPC', 'better-wp-security' ),
		);
		
		$allow_xmlrpc_multiauth_options = array(
			false => __( 'Block (recommended)', 'better-wp-security' ),
			true  => __( 'Allow', 'better-wp-security' ),
		);
		
		
		$jquery_version = ITSEC_Modules::get_setting( $this->id, 'jquery_version' );
		$jquery_version_is_safe = ITSEC_Lib::is_jquery_version_safe();
		
		if ( empty( $jquery_version ) ) {
			$jquery_description = sprintf( __( 'Your current jQuery version is undetermined. Please <a href="%1$s" target="_blank">check your homepage</a> to see if you even need this feature' ), site_url() );
		} else {
			$jquery_description = sprintf( __( 'Your current jQuery version is %1$s' ), $jquery_version );
		}
		
		if ( $jquery_version_is_safe ) {
			$jquery_description_color = 'green';
		} else {
			$jquery_description_color = 'red';
		}
		
?>
	<p><?php _e( 'Note: These settings are listed as advanced because they block common forms of attacks but they can also block legitimate plugins and themes that rely on the same techniques. When activating the settings below, we recommend enabling them one by one to test that everything on your site is still working as expected.', 'better-wp-security' ); ?></p>
	<p><?php _e( 'Remember, some of these settings might conflict with other plugins or themes, so test your site after enabling each setting.', 'better-wp-security' ); ?></p>
	<table class="form-table">
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-wlwmanifest_header"><?php _e( 'Windows Live Writer Header', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_checkbox( 'wlwmanifest_header' ); ?>
				<label for="itsec-wordpress-tweaks-wlwmanifest_header"><?php _e( 'Remove the Windows Live Writer header.', 'better-wp-security' ); ?></label>
				<p class="description"><?php _e( 'This is not needed if you do not use Windows Live Writer or other blogging clients that rely on this file.', 'better-wp-security' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-edituri_header"><?php _e( 'EditURI Header', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_checkbox( 'edituri_header' ); ?>
				<label for="itsec-wordpress-tweaks-edituri_header"><?php _e( 'Remove the RSD (Really Simple Discovery) header.', 'better-wp-security' ); ?></label>
				<p class="description"><?php _e( 'Removes the RSD (Really Simple Discovery) header. If you don\'t integrate your blog with external XML-RPC services such as Flickr then the "RSD" function is pretty much useless to you.', 'better-wp-security' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-comment_spam"><?php _e( 'Comment Spam', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_checkbox( 'comment_spam' ); ?>
				<label for="itsec-wordpress-tweaks-comment_spam"><?php _e( 'Reduce Comment Spam', 'better-wp-security' ); ?></label>
				<p class="description"><?php _e( 'This option will cut down on comment spam by denying comments from bots with no referrer or without a user-agent identified.', 'better-wp-security' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-file_editor"><?php _e( 'File Editor', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_checkbox( 'file_editor' ); ?>
				<label for="itsec-wordpress-tweaks-file_editor"><?php _e( 'Disable File Editor', 'better-wp-security' ); ?></label>
				<p class="description"><?php _e( 'Disables the file editor for plugins and themes requiring users to have access to the file system to modify files. Once activated you will need to manually edit theme and other files using a tool other than WordPress.', 'better-wp-security' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-disable_xmlrpc"><?php _e( 'XML-RPC', 'better-wp-security' ); ?></label></th>
			<td>
				<p><?php printf( __( 'WordPress\' XML-RPC feature allows external services to access and modify content on the site. Common example of services that make use of XML-RPC are <a href="%1$s">the Jetpack plugin</a>, <a href="%2$s">the WordPress mobile app</a>, and <a href="%3$s">pingbacks</a>. If the site does not use a service that requires XML-RPC, select the "Disable XML-RPC" setting as disabling XML-RPC prevents attackers from using the feature to attack the site.', 'better-wp-security' ), esc_url( 'https://jetpack.me/' ), esc_url( 'https://apps.wordpress.org/' ), esc_url( 'https://make.wordpress.org/support/user-manual/building-your-wordpress-community/trackbacks-and-pingbacks/#pingbacks' ) ); ?></p>
				<?php $form->add_select( 'disable_xmlrpc', $xmlrpc_options ); ?>
				<ul>
					<li><?php _e( '<strong>Disable XML-RPC</strong> - XML-RPC is disabled on the site. This setting is highly recommended if Jetpack, the WordPress mobile app, pingbacks, and other services that use XML-RPC are not used.', 'better-wp-security' ); ?></li>
					<li><?php _e( '<strong>Disable Pingbacks</strong> - Only disable pingbacks. Other XML-RPC features will work as normal. Select this setting if you require features such as Jetpack or the WordPress Mobile app.', 'better-wp-security' ); ?></li>
					<li><?php _e( '<strong>Enable XML-RPC</strong> - XML-RPC is fully enabled and will function as normal. Use this setting only if the site must have unrestricted use of XML-RPC.', 'better-wp-security' ); ?></li>
				</ul>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-allow_xmlrpc_multiauth"><?php _e( 'Multiple Authentication Attempts per XML-RPC Request', 'better-wp-security' ); ?></label></th>
			<td>
				<p><?php _e( 'WordPress\' XML-RPC feature allows hundreds of username and password guesses per request. Use the recommended "Block" setting below to prevent attackers from exploiting this feature.', 'better-wp-security' ); ?></p>
				<?php $form->add_select( 'allow_xmlrpc_multiauth', $allow_xmlrpc_multiauth_options ); ?>
				<ul>
					<li><?php _e( '<strong>Block</strong> - Blocks XML-RPC requests that contain multiple login attempts. This setting is highly recommended.', 'better-wp-security' ); ?></li>
					<li><?php _e( '<strong>Allow</strong> - Allows XML-RPC requests that contain multiple login attempts. Only use this setting if a service requires it.', 'better-wp-security' ); ?></li>
				</ul>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-safe_jquery"><?php _e( 'Replace jQuery With a Safe Version', 'better-wp-security' ); ?></label></th>
			<td>
				<?php if ( $jquery_version_is_safe ) : ?>
					<?php $form->add_checkbox( 'safe_jquery' ); ?>
					<label for="itsec-wordpress-tweaks-safe_jquery"><?php _e( 'Enqueue a safe version of jQuery', 'better-wp-security' ); ?></label>
					<p class="description"><?php _e( 'Remove the existing jQuery version used and replace it with a safe version (the version that comes default with WordPress).', 'better-wp-security' ); ?></p>
				<?php endif; ?>
				
				<p class="description" style="color: <?php echo esc_attr( $jquery_description_color ); ?>"><?php echo $jquery_description; ?></p>
				<p class="description"><?php printf( __( 'Note that this only checks the homepage of your site and only for users who are logged in. This is done intentionally to save resources. If you think this is in error <a href="%s" target="_blank">click here to check again.</a> This will open your homepage in a new window allowing the plugin to determine the version of jQuery actually being used. You can then come back here and reload this page to see your version.', 'better-wp-security' ), site_url() ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-login_errors"><?php _e( 'Login Error Messages', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_checkbox( 'login_errors' ); ?>
				<label for="itsec-wordpress-tweaks-login_errors"><?php _e( 'Disable login error messages', 'better-wp-security' ); ?></label>
				<p class="description"><?php _e( 'Prevents error messages from being displayed to a user upon a failed login attempt.', 'better-wp-security' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-force_unique_nicename"><?php _e( 'Force Unique Nickname', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_checkbox( 'force_unique_nicename' ); ?>
				<label for="itsec-wordpress-tweaks-force_unique_nicename"><?php _e( 'Force users to choose a unique nickname', 'better-wp-security' ); ?></label>
				<p class="description"><?php _e( 'This forces users to choose a unique nickname when updating their profile or creating a new account which prevents bots and attackers from easily harvesting user\'s login usernames from the code on author pages. Note this does not automatically update existing users as it will affect author feed urls if used.', 'better-wp-security' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-wordpress-tweaks-disable_unused_author_pages"><?php _e( 'Disable Extra User Archives', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_checkbox( 'disable_unused_author_pages' ); ?>
				<label for="itsec-wordpress-tweaks-disable_unused_author_pages"><?php _e( 'Disables a user\'s author page if their post count is 0.', 'better-wp-security' ); ?></label>
				<p class="description"><?php _e( 'This makes it harder for bots to determine usernames by disabling post archives for users that don\'t post to your site.', 'better-wp-security' ); ?></p>
			</td>
		</tr>
	</table>
<?php
		
	}
}

new ITSEC_WordPress_Tweaks_Settings_Page();
