<?php die(); ?><!DOCTYPE html>
<html lang="en-US">
<!DOCTYPE html>
  <!--[if IE 8]>         <html lang="en" class="no-js ie8 lte-ie9"> <![endif]-->
  <!--[if lte IE 9]>     <html lang="en" class="no-js lte-ie9"> <![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Controlling Spotify with Slack and a Raspberry Pi | Aaron Krauss</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="https://thesocietea.org/xmlrpc.php">

    <meta name="description" content="After moving to a newly constructed floor at Staplegun (where I work), the developers (all 4 of us) chose to switch to an open floor-plan. One of the big updates included in this move was that we now had a shared audio system with speakers all around, and with us working in very close proximity to one another, it...">
    <meta property="og:description" content="After moving to a newly constructed floor at Staplegun (where I work), the developers (all 4 of us) chose to switch to an open floor-plan. One of the big updates included in this move was that we now had a shared audio system with speakers all around, and with us working in very close proximity to one another, it...">
        <meta property="og:image" content="https://thesocietea.org/assets/images/dist/ak-smile-optimized.jpg">
    <meta property="og:title" content="Controlling Spotify with Slack and a Raspberry Pi | Aaron Krauss">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://thesocietea.org/2016/03/controlling-spotify-with-slack-and-a-raspberry-pi/ " />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@thecodeboss" />
    <meta name="twitter:creator" content="@thecodeboss" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimal-ui">

    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/images/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/images/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/images/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/images/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/images/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-196x196.png" sizes="196x196">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-TileImage" content="/assets/images/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="/assets/images/favicon/browserconfig.xml">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/screen.css">
    <script src="/assets/js/lib/modernizr-2.7.1.min.js"></script>
    <!--[if lt IE 9]>
      <script src="/assets/js/ie/selectivizr-min.js"></script>
    <![endif]-->
  </head>
  <body class="post-template-default single single-post postid-1148 single-format-standard m-scene">
    <!--[if lt IE 8]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div class="skipmenu" aria-hidden="true">
      <a href="#content" class="skipmenu__item">Skip to Main Content</a>
    </div>
    <header class="spanner sticky mini affixed">
      <div class="container-padding">
        <div class="container">
          <a href="/"><img src="/assets/images/dist/ak_logo_trimmed.png" alt="" /></a>
          <div class="nav-wrapper" id="navigation">
            <nav class="nav">
              <div class="menu-main-menu-container"><ul id="menu-main-menu" class="menu"><li id="menu-item-25" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-25"><a href="https://thesocietea.org/about/">About</a>
<ul class="sub-menu">
	<li id="menu-item-1341" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1341"><a href="https://thesocietea.org/about/">About Me</a></li>
	<li id="menu-item-1330" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1330"><a href="https://thesocietea.org/speaking/">Speaking</a></li>
	<li id="menu-item-1340" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1340"><a href="http://thesocietea.org/resume">Resume</a></li>
</ul>
</li>
<li id="menu-item-26" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-26"><a href="https://thesocietea.org/blog/">Blog</a></li>
<li id="menu-item-32" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-32"><a href="https://thesocietea.org/projects/">Projects</a>
<ul class="sub-menu">
	<li id="menu-item-1339" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1339"><a href="https://thesocietea.org/projects/">Big Projects</a></li>
	<li id="menu-item-335" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-335"><a href="http://labs.thesocietea.org">Labs</a></li>
</ul>
</li>
<li id="menu-item-27" class="nav-call-action menu-item menu-item-type-post_type menu-item-object-page menu-item-27"><a href="https://thesocietea.org/skills/">Skills</a></li>
</ul></div>            </nav>
          </div>
          <div class="nav-wrapper" id="mobile-navigation">
            <nav class="nav">
              <ul>
                <li>
                  <button id="responsive-menu-icon" class="hamburger hamburger--elastic" type="button">
                    <span class="hamburger-box">
                      <span class="hamburger-inner"></span>
                    </span>
                  </button>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <aside id="content" tabindex="-1"></aside>

	<div id="primary" class="single-post content-area">
		<main id="main" class="site-main" role="main">


			
<article id="post-1148" class="post-1148 post type-post status-publish format-standard hentry category-tools">
            <div class="container-padding">
<div class="container">
  <header class="entry-header">
    <h1 class="entry-title">Controlling Spotify with Slack and a Raspberry Pi</h1>
    <div class="entry-meta">
      <span class="posted-on"><span><time class="entry-date published" datetime="2016-03-04T12:00:20+00:00">March 4, 2016</time></span></span>    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
<hr class="short" />

  <div class="entry-content">
    <div class="pre-post-content">
          </div>
    <p>After moving to a newly constructed floor at <a href="http://staplegun.us" target="_blank">Staplegun</a> (where I work), the developers (all 4 of us) chose to switch to an open floor-plan. One of the big updates included in this move was that we now had a shared audio system with speakers all around, and with us working in very close proximity to one another, it became very important for each of us to easily be able to control the music selection. The sound system had no &#8220;smart&#8221; attributes or network connectivity, so at the most basic level, we could have just hooked up an audio cable from our phones to the auxiliary input and played music that way &#8211; but our sound system hub is in our server room, which is nowhere near where we work, so that quickly got thrown away as a plausible option. Other than hooking up a bluetooth connector or some other third-party-connection widget with cables going into the speaker, we were pretty much out of luck. Or so we thought.</p>
<p>We realized we had a spare Raspberry Pi lying around, which has an audio output as well as an ethernet cable input. Theoretically, we could somehow connect to the Pi over our network and stream music from the Pi. Now &#8220;how&#8221; was the big question. On top of that, we all use <a href="https://slack.com/" target="_blank">Slack</a> heavily at work, so could we take it one step further and control our music selection via Slack? Sounds farfetched, I know &#8211; but that&#8217;s exactly what we did, and I want to show you how you can do it too.</p>
<h2>Prerequisites</h2>
<p>As you&#8217;re following along, there are a few things you need in order to build everything in this post:</p>
<ul>
<li>You need a <strong>premium</strong> Spotify account (need this to get API access).</li>
<li>You need a Raspberry Pi (preferably at least a Pi 2, but any Pi should work).</li>
<li>You need a speaker to connect to your Pi.</li>
<li>Your Pi needs internet access, either wirelessly or via ethernet cable.</li>
<li>You need Node.js v0.10.x and <a href="https://developer.spotify.com/technologies/libspotify/" target="_blank">libspotify</a> installed on the Pi.</li>
</ul>
<p>That last one is very important &#8211; the library we&#8217;re going to use doesn&#8217;t work with later versions of Node (hopefully this gets updated in the future). All set? Good, let&#8217;s get to it.</p>
<h2>Getting Everything Set Up</h2>
<p>To allow our Slack channel to make requests to our Pi, and then for our Pi to make requests to Spotify, we need to use a package called <a href="https://github.com/crispymtn/crispyfi" target="_blank">crispyfi</a>. Navigate to your desired folder on your Pi, and clone the crispyfi repo:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f501dbc03c7253276112" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f501dbc03c7253276112-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f501dbc03c7253276112-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f501dbc03c7253276112-1"><span class="crayon-e">git </span><span class="crayon-r">clone</span><span class="crayon-h"> </span><span class="crayon-v">https</span><span class="crayon-o">:</span><span class="crayon-o">/</span><span class="crayon-o">/</span><span class="crayon-v">github</span><span class="crayon-e">.com</span><span class="crayon-o">/</span><span class="crayon-v">crispymtn</span><span class="crayon-o">/</span><span class="crayon-v">crispyfi</span><span class="crayon-e">.git</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f501dbc03c7253276112-2"><span class="crayon-r">cd</span><span class="crayon-h"> </span><span class="crayon-v">crispyfi</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0007 seconds] -->
<p>After you get this cloned, there&#8217;s quite a process you&#8217;ll have to go through to get the &#8220;Slack to Pi to Spotify&#8221; communication chain going; it&#8217;s very well documented on the <a href="https://github.com/crispymtn/crispyfi.git" target="_blank">crispyfi readme</a>, so I&#8217;ll direct you there to get things set up, but in a nutshell, this is what you&#8217;ll need to do:</p>
<ul>
<li>Sign up for a Spotify app and get a Spotify key file (you need a premium membership to do this).</li>
<li>Continue with crispyfi&#8217;s documentation on where to add in your Spotify username, password, and key file.</li>
<li>Create a custom outgoing webhook integration in Slack and set the trigger words to <strong>play, pause, stop, skip, list, vol, status, shuffle, help, reconnect, mute, unmute</strong>.</li>
<li>You can name your webhook (we called our&#8217;s <em>jukebox</em>), give it an emoji icon, and select if the webhook should listen globally on all channels. At Staplegun, we only have this webhook listening on a single channel that&#8217;s dedicated to controlling music.</li>
<li>Don&#8217;t worry about the webhook&#8217;s URL field for now &#8211; we&#8217;re going to edit that later (you&#8217;ll still probably need to fill it in with some dummy data though) &#8211; and make sure to copy the token that Slack gives you.</li>
<li>Add the Slack token in crispyfi&#8217;s config.json file.</li>
</ul>
<p>The idea here is that whenever you chat one of the trigger words in a channel, the outgoing webhook will fire and make a POST request to your designated URL (which we haven&#8217;t set yet) including the specific message that triggered it. That POST request will hit the crispyfi server we&#8217;re going to run, which will handle all communication to Spotify and back. The Pi will stream music from Spotify and send it to the audio output port, which you would hook up to a speaker.</p>
<p>Once we&#8217;ve added all of our config data into our crispyfi project, we can install the dependencies and spin up the server on port 8000:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f501dbc03db923071363" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f501dbc03db923071363-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f501dbc03db923071363-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f501dbc03db923071363-1"><span class="crayon-e">npm </span><span class="crayon-e">install</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f501dbc03db923071363-2"><span class="crayon-e">node </span><span class="crayon-v">index</span><span class="crayon-h"> </span><span class="crayon-c"># Defaults to running on port 8000</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0004 seconds] -->
<p>If you have everything set up properly, then you should see output stating that crispyfi successfully logged into Spotify with your credentials. Now here&#8217;s a problem: we have the server running, but our Slack webhook can&#8217;t reach it because our Pi doesn&#8217;t have a static IP. To get around this, we can use a wonderful library called <a href="https://ngrok.com/" target="_blank">ngrok</a> which will expose any port on our localhost to the outside world by providing an ngrok URL. Install ngrok via NPM and then run it for port 8000:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f501dbc03e3029549745" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f501dbc03e3029549745-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f501dbc03e3029549745-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f501dbc03e3029549745-1"><span class="crayon-e">npm </span><span class="crayon-v">install</span><span class="crayon-h"> </span><span class="crayon-o">-</span><span class="crayon-i">g</span><span class="crayon-h"> </span><span class="crayon-e">ngrok</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f501dbc03e3029549745-2"><span class="crayon-i">ngrok</span><span class="crayon-h"> </span><span class="crayon-cn">8000</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0005 seconds] -->
<p>This will take over your terminal pane and provide you with a URL such as <strong>http://10c06440.ngrok.com</strong>. This is the URL we want our Slack webhook to have &#8211; followed by the /handle route. So go back to Slack, edit your webhook, and change the URL to be:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f501dbc03ec304411007" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f501dbc03ec304411007-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f501dbc03ec304411007-1"><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//10c06440.ngrok.com/handle</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>You&#8217;ll have a different ngrok URL, so you&#8217;ll need to swap the above URL with the one that you&#8217;re provided. If you&#8217;ve done everything correctly, then your Slack should now fully be able to control your music selection through your Spotify account!</p>
<p><img class="aligncenter size-full wp-image-1163" src="https://i0.wp.com/thesocietea.org/wp-content/uploads/2016/01/crispyfi-screenshot.jpg?resize=640%2C148&#038;ssl=1" alt="crispyfi-screenshot" srcset="https://i0.wp.com/thesocietea.org/wp-content/uploads/2016/01/crispyfi-screenshot.jpg?w=1200&amp;ssl=1 1200w, https://i0.wp.com/thesocietea.org/wp-content/uploads/2016/01/crispyfi-screenshot.jpg?resize=300%2C70&amp;ssl=1 300w, https://i0.wp.com/thesocietea.org/wp-content/uploads/2016/01/crispyfi-screenshot.jpg?resize=1024%2C237&amp;ssl=1 1024w" sizes="(max-width: 640px) 100vw, 640px" data-recalc-dims="1" /></p>
<h2>Taking It a Step Further</h2>
<p>Crispyfi is a great service &#8211; but it currently only works with Spotify URIs. That means you can&#8217;t play music based on a search for title, artist, album name, etc. &#8211; you have to copy the exact URI from Spotify to play a certain song or playlist. We wanted to add this &#8220;music query&#8221; feature at Staplegun, and we were able to pretty easily get it through a <a href="https://hubot.github.com/" target="_blank">hubot</a> script called <a href="https://www.npmjs.com/package/hubot-spotify-me" target="_blank">hubot-spotify-me</a>.</p>
<p>If you use Slack at work &#8211; or any other instant messaging application &#8211; and you don&#8217;t use hubot, then I highly recommend you check it out. Not only is it a fun bot that can make your team interactions more lively, but you can program it with some sweet scripts that really boost productivity; that in itself is a topic that warrants its own blog post, so I&#8217;ll just stick to discussing the hubot-spotify-me script for now.</p>
<p>If you install this script, then you can trigger it in Slack with the following format:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f501dbc03f3580786874" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f501dbc03f3580786874-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f501dbc03f3580786874-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f501dbc03f3580786874-1"><span class="crayon-e">hubot </span><span class="crayon-e">spotify </span><span class="crayon-e">me </span><span class="crayon-v">test</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f501dbc03f3580786874-2"><span class="crayon-o">&gt;</span><span class="crayon-h"> </span><span class="crayon-v">https</span><span class="crayon-o">:</span><span class="crayon-c">//open.spotify.com/track/0yA1MBQ60SoiYt7xqdS3H1</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0006 seconds] -->
<p>And it will return to you a spotify URL. If we convert this into a spotify URI (which is simple to do), then all we&#8217;re missing is the trigger word <strong>play</strong> in order to automatically issue a webhook request to our crispyfi server to play this song. Well &#8211; there&#8217;s no simple way to edit the hubot script to reformat the spotify URL and prefix it with the word <strong>play</strong>, so we&#8217;ll have to actually edit some code here. Here&#8217;s the exact file path and changes you need to make:</p>
<p><img class="aligncenter wp-image-1157 size-full" src="https://i2.wp.com/thesocietea.org/wp-content/uploads/2016/01/hubot-spotify-changes.jpg?resize=640%2C157&#038;ssl=1" alt="hubot-spotify-changes" srcset="https://i2.wp.com/thesocietea.org/wp-content/uploads/2016/01/hubot-spotify-changes.jpg?w=1300&amp;ssl=1 1300w, https://i2.wp.com/thesocietea.org/wp-content/uploads/2016/01/hubot-spotify-changes.jpg?resize=300%2C73&amp;ssl=1 300w, https://i2.wp.com/thesocietea.org/wp-content/uploads/2016/01/hubot-spotify-changes.jpg?resize=1024%2C250&amp;ssl=1 1024w" sizes="(max-width: 640px) 100vw, 640px" data-recalc-dims="1" /></p>
<p>After you make these changes and deploy them to hubot &#8211; you&#8217;re good to go! Your new-and-improved spotify hubot command will look like this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f501dbc0409590317959" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f501dbc0409590317959-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f501dbc0409590317959-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f501dbc0409590317959-1"><span class="crayon-e">hubot </span><span class="crayon-e">spotify </span><span class="crayon-e">me </span><span class="crayon-v">test</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f501dbc0409590317959-2"><span class="crayon-o">&gt;</span><span class="crayon-h"> </span><span class="crayon-e">play </span><span class="crayon-v">spotify</span><span class="crayon-o">:</span><span class="crayon-v">track</span><span class="crayon-o">:</span><span class="crayon-cn">0yA1MBQ60SoiYt7xqdS3H1</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0005 seconds] -->
<p>And this will trigger your outging webhook to perform a request to your crispyfi server! Boom!</p>
<h2>Final Thoughts</h2>
<p>This setup is really powerful, and after you get it all in place, you definitely deserve a few beers. There&#8217;s a lot of devops work going on here, which is tough stuff. While it&#8217;s a really awesome service to have going for our personal team, there are a few things I don&#8217;t like.</p>
<ul>
<li>Crispyfi uses libspotify, which is currently the only way to make CLI requests to the Spotify API. Spotify has openly stated that libspotify isn&#8217;t actively maintained anymore &#8211; BUT they haven&#8217;t released an alternate library to take its place yet. How they stopped supporting something without providing a replacement is beyond me &#8211; but that&#8217;s how it is right now.</li>
<li>Crispyfi itself isn&#8217;t super maintained either, with a majority of the commits having occured during a few-month period at the end of 2014. Still, it&#8217;s the only valid library we could find that accomplished what we needed, and it sure beat spending the several man-hours to build the same thing ourselves!</li>
</ul>
<p>Even with these concerns, this setup is a game changer. To fully control all of our music (play, pause, control volume, manage playlists, etc.), we now just issue commands in a Slack channel, and it happens instantly. There&#8217;s no single way that works better for us, and I bet you&#8217;ll discover the same thing too for your team. Plus &#8211; this way we can Rick Roll our team if one of us is working from home!</p>
   </div><!-- .entry-content -->

</div>
</div>

  <footer class="entry-footer">
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->

			
      <div class="container">
        <div class="container-padding">
          
<div id="disqus_thread">
            <div id="dsq-content">


            <ul id="dsq-comments">
                    <li class="comment even thread-even depth-1" id="dsq-comment-133">
        <div id="dsq-comment-header-133" class="dsq-comment-header">
            <cite id="dsq-cite-133">
                <a id="dsq-author-user-133" href="http://geekindulgence.com/" target="_blank" rel="nofollow">Jeff French</a>
            </cite>
        </div>
        <div id="dsq-comment-body-133" class="dsq-comment-body">
            <div id="dsq-comment-message-133" class="dsq-comment-message"><p>My team is completely remote. A cool extension of this project would be to setup the Pi / speakers at multiple locations all synced to the same thing playing. Would probably be as simple as just broadcasting the Slack webhook to multiple endpoints. Hmmm&#8230;I smell a project in my future!</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='http://www.recantha.co.uk/blog/?p=14322' rel='external nofollow' class='url'>Controlling Spotify with Slack and a Raspberry Pi &#8211; Raspberry Pi Pod</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://blog.adafruit.com/2016/03/18/how-to-control-spotify-with-slack-and-raspberry-pi-piday-iluvpi2-raspberrypi-raspberry_pi/' rel='external nofollow' class='url'>How to Control Spotify with Slack and Raspberry Pi #piday #iLuvPi2 #raspberrypi @Raspberry_Pi &laquo; Adafruit Industries &#8211; Makers, hackers, artists, designers and engineers!</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='http://rasp-pi.com/how-to-control-spotify-with-slack-and-raspberry-pi-piday-iluvpi2-raspberrypi-raspberry_pi/' rel='external nofollow' class='url'>How to Control Spotify with Slack and Raspberry Pi #piday #iLuvPi2 #raspberrypi @Raspberry_Pi - Raspberry Pi News</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='http://michaelr.me/2016/03/18/how-to-control-spotify-with-slack-and-raspberry-pi-piday-iluvpi2-raspberrypi-raspberry_pi/' rel='external nofollow' class='url'>How to Control Spotify with Slack and Raspberry Pi #piday #iLuvPi2 #raspberrypi @Raspberry_Pi | The Michael R</a>()</p>
    </li>
    </li><!-- #comment-## -->
            </ul>


        </div>

    </div>

<script type="text/javascript">
var disqus_url = 'https://thesocietea.org/2016/03/controlling-spotify-with-slack-and-a-raspberry-pi/';
var disqus_identifier = '1148 https://thesocietea.org/?p=1148';
var disqus_container_id = 'disqus_thread';
var disqus_shortname = 'thesocietea';
var disqus_title = "Controlling Spotify with Slack and a Raspberry Pi";
var disqus_config_custom = window.disqus_config;
var disqus_config = function () {
    /*
    All currently supported events:
    onReady: fires when everything is ready,
    onNewComment: fires when a new comment is posted,
    onIdentify: fires when user is authenticated
    */
    
    
    this.language = '';
        this.callbacks.onReady.push(function () {

        // sync comments in the background so we don't block the page
        var script = document.createElement('script');
        script.async = true;
        script.src = '?cf_action=sync_comments&post_id=1148';

        var firstScript = document.getElementsByTagName('script')[0];
        firstScript.parentNode.insertBefore(script, firstScript);
    });
    
    if (disqus_config_custom) {
        disqus_config_custom.call(this);
    }
};

(function() {
    var dsq = document.createElement('script'); dsq.type = 'text/javascript';
    dsq.async = true;
    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
})();
</script>

        </div>
      </div>


		</main><!-- #main -->
	</div><!-- #primary -->

        <script type="text/javascript">
        // <![CDATA[
        var disqus_shortname = 'thesocietea';
        (function () {
            var nodes = document.getElementsByTagName('span');
            for (var i = 0, url; i < nodes.length; i++) {
                if (nodes[i].className.indexOf('dsq-postid') != -1 && nodes[i].parentNode.tagName == 'A') {
                    nodes[i].parentNode.setAttribute('data-disqus-identifier', nodes[i].getAttribute('data-dsqidentifier'));
                    url = nodes[i].parentNode.href.split('#', 1);
                    if (url.length == 1) { url = url[0]; }
                    else { url = url[1]; }
                    nodes[i].parentNode.href = url + '#disqus_thread';
                }
            }
            var s = document.createElement('script');
            s.async = true;
            s.type = 'text/javascript';
            s.src = '//' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
        // ]]>
        </script>
        	<div style="display:none">
	</div>
<link rel='stylesheet' id='crayon-css'  href='https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/css/min/crayon.min.css?ver=_2.7.2_beta' type='text/css' media='all' />
<link rel='stylesheet' id='crayon-theme-tomorrow-night-css'  href='https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css?ver=_2.7.2_beta' type='text/css' media='all' />
<link rel='stylesheet' id='crayon-font-monaco-css'  href='https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css?ver=_2.7.2_beta' type='text/css' media='all' />
<link rel='stylesheet' id='jetpack_css-css'  href='https://thesocietea.org/wp-content/plugins/jetpack/css/jetpack.css?ver=4.8.2' type='text/css' media='all' />
<script type='text/javascript' src='https://thesocietea.org/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='https://thesocietea.org/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var CrayonSyntaxSettings = {"version":"_2.7.2_beta","is_admin":"0","ajaxurl":"https:\/\/thesocietea.org\/wp-admin\/admin-ajax.php","prefix":"crayon-","setting":"crayon-setting","selected":"crayon-setting-selected","changed":"crayon-setting-changed","special":"crayon-setting-special","orig_value":"data-orig-value","debug":""};
var CrayonSyntaxStrings = {"copy":"Press %s to Copy, %s to Paste","minimize":"Click To Expand Code"};
/* ]]> */
</script>
<script type='text/javascript' src='https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/js/min/crayon.min.js?ver=_2.7.2_beta'></script>

    <footer class="main-footer">
    <div class="container-padding">
      <div class="container">
        <div class="down-triangle"></div>
        <div class="footer-content">
          <p>&copy;<script>document.write(new Date().getFullYear())</script><noscript>2015</noscript> Aaron Krauss. All Rights Reserved.</p>
        </div>
        <div class="footer-logos">
          <ul class="footer-icons">
          <li><a class="icon-github" title="GitHub" target="github" href="https://github.com/alkrauss48"></a></li>
          <li><a class="icon-twitter" title="Twitter" target="twitter" href="https://twitter.com/thecodeboss"></a></li>
          <li><a class="icon3-untappd" title="Untappd" target="untappd"  href="https://untappd.com/user/thecodeboss"></a></li>
          <li><a class="icon-uniE603" title="Email" href="mailto:alkrauss48@gmail.com"></a></li>
          </ul>
        </div>
      </div>
    </div>
    </footer>

    <script src="/assets/js/min/scripts.min.js"></script>
    <!--[if lt IE 9]>
      <script src="/assets/js/ie/ie.js"></script>
    <![endif]-->
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <!-- <script> -->
    <!--   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ -->
    <!--   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), -->
    <!--   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) -->
    <!--   })(window,document,'script','//www.google&#45;analytics.com/analytics.js','ga'); -->
    <!--   ga('create', 'UA&#45;38589428&#45;1', 'thesocietea.org'); -->
    <!--   ga('send', 'pageview'); -->
    <!-- </script> -->
    <script>
      window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
      ga('create', 'UA-38589428-1', 'thesocietea.org');
      ga('require', 'autotrack');
      ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    <script async src='/assets/js/autotrack.js'></script>
  </body>
</html>

<!-- Dynamic page generated in 0.234 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-04-17 17:56:43 -->
