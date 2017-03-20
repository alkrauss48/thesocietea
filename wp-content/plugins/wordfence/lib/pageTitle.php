<div class="wf-row">
	<div class="wf-col-xs-12">
		<div class="wordfence-lock-icon wordfence-icon32"><br /></div><h2 id="wfHeading"><?php echo $pageTitle; ?></h2>
	</div>
	<?php if (isset($wantsLiveActivity) && $wantsLiveActivity): ?><div class="wf-col-xs-12"><?php include('live_activity.php'); ?></div><?php endif; ?>
	<div class="wf-col-xs-12">
		<?php if (isset($options)): ?>
		<h2 class="nav-tab-wrapper<?php if (count($options) <= 1 || (isset($hideBar) && $hideBar)) { echo ' wf-hidden'; } ?>" id="wordfenceTopTabs">
			<?php foreach ($options as $info): ?>
				<a class="nav-tab" id="<?php echo esc_html($info['a']); ?>-tab" href="#top#<?php echo esc_html($info['a']); ?>"><?php echo esc_html($info['t']); ?></a>
			<?php endforeach; ?>
		</h2>
		<?php endif; ?>
		<?php if (isset($helpLink)): ?><div class="wordfenceHelpLink"><a href="<?php echo $helpLink; ?>" target="_blank" class="wfhelp"></a><a href="<?php echo $helpLink; ?>" target="_blank"><?php echo $helpLabel; ?></a></div><?php endif; ?>
	</div>
</div>