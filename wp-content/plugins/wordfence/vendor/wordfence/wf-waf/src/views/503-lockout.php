<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>You are temporarily locked out</title>
</head>
<body>
<h1>You are temporarily locked out</h1>
<p style="width: 500px;">
	You have been temporarily locked out of this system. This means
	that you will not be able to sign-in or use several other features that may compromise security.
	Please try back in a short while.
<?php if (!empty($homeURL)): ?>
<ul>
	<li><a href="<?php echo $homeURL; ?>">Return to the site home page</a></li>
</ul>
<?php
endif;
$nonce = $waf->createNonce('wf-form');
if (!empty($homeURL) && !empty($nonce)) : ?>
	<br />
	
	If you are a site administrator and have been accidentally locked out, please enter your email in the box below and click "Send". If the email address you enter belongs to a known site administrator or someone set to receive Wordfence alerts, we will send you an email to help you regain access. <a href="https://docs.wordfence.com/en/Help!_I_locked_myself_out_and_can't_get_back_in._What_can_I_do%3F" target="_blank">Please read this FAQ entry if this does not work.</a>
	<br /><br />
	<form method="POST" action="<?php echo $homeURL; ?>?_wfsf=unlockEmail">
		<input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
		<input type="text" size="50" name="email" value="" maxlength="255" />&nbsp;<input type="submit" name="s" value="Send me an unlock email" />
	</form>
<?php endif; ?>
</p>
<p style="color: #999999;margin-top: 2rem;"><em>Generated by Wordfence at <?php echo gmdate('D, j M Y G:i:s T', wfWAFUtils::normalizedTime()); ?>.<br>Your computer's time: <script type="application/javascript">document.write(new Date().toUTCString());</script>.</em></p>
</body>
</html>
<?php exit(); ?>
