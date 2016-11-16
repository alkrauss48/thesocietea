<?php

final class ITSEC_Ban_Users_Settings_Page extends ITSEC_Module_Settings_Page {
	private $script_version = 1;


	public function __construct() {
		$this->id = 'ban-users';
		$this->title = __( 'Banned Users', 'better-wp-security' );
		$this->description = __( 'Block specific IP addresses and user agents from accessing the site.', 'better-wp-security' );
		$this->type = 'recommended';

		parent::__construct();
	}

	protected function render_description( $form ) {

?>
	<p><?php _e( 'This feature allows you to completely ban hosts and user agents from your site without having to manage any configuration of your server. Any IP addresses or user agents found in the lists below will not be allowed any access to your site.', 'better-wp-security' ); ?></p>
<?php

	}

	protected function render_settings( $form ) {

?>
	<table class="form-table itsec-settings-section">
		<tr>
			<th scope="row"><label for="itsec-ban-users-default"><?php _e( 'Default Blacklist', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_checkbox( 'default' ); ?>
				<label for="itsec-ban-users-default"><?php _e( 'Enable HackRepair.com\'s blacklist feature', 'better-wp-security' ); ?></label>
				<p class="description"><?php printf( __( 'As a getting-started point you can include the blacklist developed by Jim Walker of <a href="%s" target="_blank">HackRepair.com</a>.', 'better-wp-security' ), 'http://hackrepair.com/blog/how-to-block-bots-from-seeing-your-website-bad-bots-and-drive-by-hacks-explained' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="itsec-ban-users-enable_ban_lists"><?php _e( 'Ban Lists', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_checkbox( 'enable_ban_lists', array( 'class' => 'itsec-settings-toggle' ) ); ?>
				<label for="itsec-ban-users-enable_ban_lists"><?php _e( 'Enable Ban Lists', 'better-wp-security' ); ?></label>
			</td>
		</tr>
		<tr class="itsec-ban-users-enable_ban_lists-content">
			<th scope="row"><label for="itsec-ban-users-host_list"><?php _e( 'Ban Hosts', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_textarea( 'host_list', array( 'wrap' => 'off' ) ); ?>
				<p><?php _e( 'Use the guidelines below to enter hosts that will not be allowed access to your site.', 'better-wp-security' ); ?></p>
				<ul>
					<li>
						<?php _e( 'You may ban users by individual IP address or IP address range using wildcards or CIDR notation.', 'better-wp-security' ); ?>
						<ul>
							<li><?php _e( 'Individual IP addresses must be in IPv4 or IPv6 standard format (###.###.###.### or ####:####:####:####:####:####:####:####).', 'better-wp-security' ); ?></li>
							<li><?php _e( 'CIDR notation is allowed to specify a range of IP addresses (###.###.###.###/## or ####:####:####:####:####:####:####:####/###).', 'better-wp-security' ); ?></li>
							<li><?php _e( 'Wildcards are also supported with some limitations. If using wildcards (*), you must start with the right-most chunk in the IP address. For example ###.###.###.* and ###.###.*.* are permitted but ###.###.*.### is not. Wildcards are only for convenient entering of IP addresses, and will be automatically converted to their appropriate CIDR notation format on save.', 'better-wp-security' ); ?></li>
						</ul>
					</li>
					<li><?php _e( 'Enter only 1 IP address or 1 IP address range per line.', 'better-wp-security' ); ?></li>
					<li><?php _e( 'Note: You cannot ban yourself.', 'better-wp-security' ); ?></li>
				</ul>
				<p><?php printf( __( '<a href="%s" target="_blank">Lookup IP Address.</a>', 'better-wp-security' ), 'http://ip-lookup.net/domain-lookup.php' ); ?></p>
			</td>
		</tr>
		<tr class="itsec-ban-users-enable_ban_lists-content">
			<th scope="row"><label for="itsec-ban-users-agent_list"><?php _e( 'Ban User Agents', 'better-wp-security' ); ?></label></th>
			<td>
				<?php $form->add_textarea( 'agent_list', array( 'wrap' => 'off' ) ); ?>
				<p><?php _e( 'Use the guidelines below to enter user agents that will not be allowed access to your site.', 'better-wp-security' ); ?></p>
				<ul>
					<li><?php _e( 'Enter only 1 user agent per line.', 'better-wp-security' ); ?></li>
				</ul>
			</td>
		</tr>
	</table>
<?php

	}
}

new ITSEC_Ban_Users_Settings_Page();
