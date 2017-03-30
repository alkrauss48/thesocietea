<?php die(); ?><!DOCTYPE html>
<html lang="en-US">
<!DOCTYPE html>
  <!--[if IE 8]>         <html lang="en" class="no-js ie8 lte-ie9"> <![endif]-->
  <!--[if lte IE 9]>     <html lang="en" class="no-js lte-ie9"> <![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Building a JSON API with Rails – Part 4: Implementing Authentication | Aaron Krauss</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="https://thesocietea.org/xmlrpc.php">

    <meta name="description" content="After reading the last post discussing authentication strategies, we now have a firm understanding on how we&#8217;re going to add authentication into our API. To recap &#8211; we&#8217;re going to use basic authentication for our initial username/password submission, and then token-based authentication on every subsequent request in which we just pass around a token to authenticate ourselves. We didn&#8217;t...">
    <meta property="og:description" content="After reading the last post discussing authentication strategies, we now have a firm understanding on how we&#8217;re going to add authentication into our API. To recap &#8211; we&#8217;re going to use basic authentication for our initial username/password submission, and then token-based authentication on every subsequent request in which we just pass around a token to authenticate ourselves. We didn&#8217;t...">
        <meta property="og:image" content="https://thesocietea.org/assets/images/dist/ak-smile-optimized.jpg">
    <meta property="og:title" content="Building a JSON API with Rails – Part 4: Implementing Authentication | Aaron Krauss">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-4-implementing-authentication/ " />
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
  <body class="post-template-default single single-post postid-504 single-format-standard m-scene">
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


			
<article id="post-504" class="post-504 post type-post status-publish format-standard hentry category-ruby">
            <div class="container-padding">
<div class="container">
  <header class="entry-header">
    <h1 class="entry-title">Building a JSON API with Rails – Part 4: Implementing Authentication</h1>
    <div class="entry-meta">
      <span class="posted-on"><span><time class="entry-date published" datetime="2015-04-30T18:00:01+00:00">April 30, 2015</time></span></span>    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
<hr class="short" />

  <div class="entry-content">
    <div class="pre-post-content">
      <p><strong>Foreword</strong>:</p>
<p>This series has been rewritten as of <strong>November 11, 2016</strong> based on the new API features in Rails 5. Formerly, this post covered the use of the rails-api gem, which has now been merged into core Rails 5.</p>
<hr />
<p><strong>Table of Contents</strong></p>
<ul>
<li><a href="https://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/">Part 1 &#8211; Getting Started</a></li>
<li><a href="https://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/">Part 2 &#8211; Serialization</a></li>
<li><a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/">Part 3 &#8211; Authentication Strategies</a></li>
<li>Part 4 &#8211; Implementing Authentication</li>
<li><a href="https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/">Part 5 &#8211; Afterthoughts</a></li>
<li><a href="https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/">Part 6 &#8211; The JSON API Spec, Pagination, and Versioning</a></li>
</ul>
<hr />
    </div>
    <p>After reading the last post discussing <a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/" target="_blank">authentication strategies</a>, we now have a firm understanding on how we&#8217;re going to add authentication into our API. To recap &#8211; we&#8217;re going to use <strong>basic authentication</strong> for our initial username/password submission, and then <strong>token-based authentication</strong> on every subsequent request in which we just pass around a token to authenticate ourselves. We didn&#8217;t cover any code last time, but I promise it&#8217;ll be nothing but code this time.</p>
<h2>Phase 1: The Initial Request</h2>
<p>First off, we need to add a route that we can access in order to receive a token based on our submitted username and password. To do that, create this route in your <strong>routes.rb</strong> file:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e00724889613" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">config/routes.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e00724889613-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e00724889613-1"><span class="crayon-v">get</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">token</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">controller</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'application'</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0005 seconds] -->
<p>To handle this route, we&#8217;re going to add a <strong>token</strong> action in our <strong>application_controller.rb</strong>. We&#8217;re putting it there because this logic doesn&#8217;t belong to any specific controller:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e16844815718" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/application_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e16844815718-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e16844815718-2">2</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e16844815718-3">3</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e16844815718-1"><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-i">token</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e16844815718-2">&nbsp;</div><div class="crayon-line" id="crayon-58dc7cf2e3e16844815718-3"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>Simple so far, right? Now to add some actual logic to that action. Let&#8217;s update it with a handy rails method:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e1d516485294" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/application_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e1d516485294-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e1d516485294-2">2</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e1d516485294-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e1d516485294-4">4</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e1d516485294-1"><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-i">token</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e1d516485294-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">authenticate_with_http</span><span class="crayon-sy">_</span>basic<span class="crayon-h"> </span><span class="crayon-st">do</span><span class="crayon-h"> </span><span class="crayon-o">|</span><span class="crayon-v">email</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">password</span><span class="crayon-o">|</span></div><div class="crayon-line" id="crayon-58dc7cf2e3e1d516485294-3"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e1d516485294-4"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0012 seconds] -->
<p>The <strong>authenticate_with_http_basic</strong> method is incredibly helpful, and really shows how Rails can help build an awesome API application. This method will parse the incoming request and look specifically for basic authentication information &#8211; which is set in the <em>Authorization</em> header. Not only does it automatically gather data from that header, but it will parse out the Base64 encoded username and password and return them to you as parameters inside of a block! How cool is that! As you can see above, I&#8217;ve appropriately named the two block parameters to represent this data.</p>
<p>Now if you try navigating to your <strong>/token</strong> endpoint, you&#8217;ll receive an error. That&#8217;s because the &#8211;api flag you used when you first created the project prevented many modules from being automatically included (since you often don&#8217;t need them in an API), such as the modules to handle the authenticate_with_http_basic method. You&#8217;ll need to include these modules in your application_controller.rb.</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e23098628257" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/application_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e23098628257-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e23098628257-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e23098628257-1"><span class="crayon-i">include</span><span class="crayon-h"> </span><span class="crayon-v">ActionController</span><span class="crayon-o">::</span><span class="crayon-v">HttpAuthentication</span><span class="crayon-o">::</span><span class="crayon-v">Basic</span><span class="crayon-o">::</span><span class="crayon-i">ControllerMethods</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e23098628257-2"><span class="crayon-i">include</span><span class="crayon-h"> </span><span class="crayon-v">ActionController</span><span class="crayon-o">::</span><span class="crayon-v">HttpAuthentication</span><span class="crayon-o">::</span><span class="crayon-v">Token</span><span class="crayon-o">::</span><span class="crayon-v">ControllerMethods</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0009 seconds] -->
<p>The first module is the one we need right now. The second module is included to handle an equally awesome token-based authentication method that we&#8217;ll use here in a bit.</p>
<p>Let&#8217;s finish out this token action:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e29674371370" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/application_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e29674371370-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e29674371370-2">2</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e29674371370-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e29674371370-4">4</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e29674371370-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e29674371370-6">6</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e29674371370-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e29674371370-8">8</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e29674371370-9">9</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e29674371370-10">10</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e29674371370-1"><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-i">token</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e29674371370-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">authenticate_with_http</span><span class="crayon-sy">_</span>basic<span class="crayon-h"> </span><span class="crayon-st">do</span><span class="crayon-h"> </span><span class="crayon-o">|</span><span class="crayon-v">email</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">password</span><span class="crayon-o">|</span></div><div class="crayon-line" id="crayon-58dc7cf2e3e29674371370-3"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">user</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">User</span><span class="crayon-sy">.</span><span class="crayon-e">find_by</span><span class="crayon-sy">(</span><span class="crayon-v">email</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">email</span><span class="crayon-sy">)</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e29674371370-4"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">if</span><span class="crayon-h"> </span><span class="crayon-v">user</span><span class="crayon-h"> </span><span class="crayon-o">&amp;&amp;</span><span class="crayon-h"> </span><span class="crayon-v">user</span><span class="crayon-sy">.</span><span class="crayon-v">password</span><span class="crayon-h"> </span><span class="crayon-o">==</span><span class="crayon-h"> </span><span class="crayon-i">password</span></div><div class="crayon-line" id="crayon-58dc7cf2e3e29674371370-5"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">render</span><span class="crayon-h"> </span><span class="crayon-v">json</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-k ">{</span><span class="crayon-h"> </span><span class="crayon-v">token</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">user</span><span class="crayon-sy">.</span><span class="crayon-v">auth</span><span class="crayon-sy">_</span>token<span class="crayon-h"> </span><span class="crayon-k ">}</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e29674371370-6"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">else</span></div><div class="crayon-line" id="crayon-58dc7cf2e3e29674371370-7"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">render</span><span class="crayon-h"> </span><span class="crayon-v">json</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-k ">{</span><span class="crayon-h"> </span><span class="crayon-v">error</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'Incorrect credentials'</span><span class="crayon-h"> </span><span class="crayon-k ">}</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">status</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-cn">401</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e29674371370-8"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58dc7cf2e3e29674371370-9"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e29674371370-10"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0028 seconds] -->
<p>That&#8217;s all we need to add to our token action. With this code, we are authenticating the user to verify they exist in our database and that the submitted password matches up with what we have stored for them. If so, we&#8217;ll return their token; otherwise, we return an error.</p>
<p>For the duration of this post, we&#8217;ll authenticate ourselves as a user with the username <strong>user@example.com</strong> and a password of <strong>password</strong>. If you included the seeds in your database that&#8217;s specified in the <strong>db/seeds.rb</strong> file we discussed in the <a title="Building a JSON API with Rails – Part 1: Getting Started" href="http://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/" target="_blank">very first post</a>, then this user will already exist in your database.</p>
<p>Let&#8217;s make our first request to get this user&#8217;s token. First off, we need to get the Base64 encoded string of this user&#8217;s username and password. Open up your rails console and type in the following:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e30550873256" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e30550873256-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e30550873256-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e30550873256-1"><span class="crayon-v">Base64</span><span class="crayon-sy">.</span><span class="crayon-e">encode64</span><span class="crayon-sy">(</span><span class="crayon-s">"user@example.com:password"</span><span class="crayon-sy">)</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e30550873256-2"><span class="crayon-c"># This returns dXNlckBleGFtcGxlLmNvbTpwYXNzd29yZA==\n</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0004 seconds] -->
<p>Now we can build our request and issue it with cURL:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e36898092018" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e36898092018-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e36898092018-1"><span class="crayon-e">curl </span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-o">/</span><span class="crayon-o">/</span><span class="crayon-v">localhost</span><span class="crayon-o">:</span><span class="crayon-cn">3000</span><span class="crayon-o">/</span><span class="crayon-v">token</span><span class="crayon-h"> </span><span class="crayon-o">-</span><span class="crayon-i">H</span><span class="crayon-h"> </span><span class="crayon-s">'Authorization: Basic dXNlckBleGFtcGxlLmNvbTpwYXNzd29yZA==\n'</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0006 seconds] -->
<p>This is a complete and valid request using basic authentication. If everything is set up properly, we should receive this back from the API:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e3b691009675" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e3b691009675-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e3b691009675-1"><span class="crayon-sy">{</span><span class="crayon-v">token</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-t">null</span><span class="crayon-sy">}</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>Right off the bat it looks like we got an error, but everything&#8217;s working exactly as it&#8217;s supposed to. We just haven&#8217;t actually created any tokens for our users yet! By default, we want each user&#8217;s auth_token to be created when that user is created. To do that, we&#8217;ll need to update our user model:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e41023107815" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/models/user.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e41023107815-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e41023107815-1"><span class="crayon-v">before_create</span><span class="crayon-h"> </span><span class="crayon-o">-&gt;</span><span class="crayon-h"> </span><span class="crayon-k ">{</span><span class="crayon-h"> </span><span class="crayon-r">self</span><span class="crayon-sy">.</span><span class="crayon-v">auth_token</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">SecureRandom</span><span class="crayon-sy">.</span><span class="crayon-i">hex</span><span class="crayon-h"> </span><span class="crayon-k ">}</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0006 seconds] -->
<p>Easy enough, right? Now when a new user is created, their auth_token will be randomly generated. However, the easiest way to make this happen for our existing users is to reset the database and let the seeds run again. To do that, run:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e47365177420" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e47365177420-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e47365177420-1"><span class="crayon-e">rake </span><span class="crayon-v">db</span><span class="crayon-o">:</span><span class="crayon-v">reset</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>After the database is reset, we can rerun our initial request to get a valid token:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e4c377574737" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e4c377574737-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e4c377574737-2">2</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e4c377574737-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e4c377574737-4">4</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e4c377574737-1"><span class="crayon-e">curl </span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-o">/</span><span class="crayon-o">/</span><span class="crayon-v">localhost</span><span class="crayon-o">:</span><span class="crayon-cn">3000</span><span class="crayon-o">/</span><span class="crayon-v">token</span><span class="crayon-h"> </span><span class="crayon-o">-</span><span class="crayon-i">H</span><span class="crayon-h"> </span><span class="crayon-s">'Authorization: Basic dXNlckBleGFtcGxlLmNvbTpwYXNzd29yZA==\n'</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e4c377574737-2">&nbsp;</div><div class="crayon-line" id="crayon-58dc7cf2e3e4c377574737-3"><span class="crayon-c"># Returns ...</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e4c377574737-4"><span class="crayon-sy">{</span><span class="crayon-v">token</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"861af99a9dbf5e052b8b55cfc41e69d7"</span><span class="crayon-sy">}</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0008 seconds] -->
<p>And bam! We got our user&#8217;s token! Keep in mind, your token will not be this exact same one since it&#8217;s randomized, but it will be in a similar format. Now we can build our token-based authentication, and feel safe knowing that we&#8217;ll never need to include our personal password in a request again.</p>
<h2>Phase 2: Handling Every Other Request</h2>
<p>We now have our token for the user that we&#8217;re authenticating as. Since we&#8217;ll be using this token on every subsequent request to this API, you&#8217;ll want to store it in some storage structure like a cookie, session storage, local storage, etc. Now let&#8217;s say we want to make a GET request to <strong>/posts/1</strong> to receive data about the first post. Keeping in mind the token-based authentication format that we discussed in <a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/" target="_blank">the previous post</a>, we will build our request like so:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e53048980508" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e53048980508-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e53048980508-1"><span class="crayon-e">curl </span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-o">/</span><span class="crayon-o">/</span><span class="crayon-v">localhost</span><span class="crayon-o">:</span><span class="crayon-cn">3000</span><span class="crayon-o">/</span><span class="crayon-v">posts</span><span class="crayon-o">/</span><span class="crayon-cn">1</span><span class="crayon-h"> </span><span class="crayon-o">-</span><span class="crayon-i">H</span><span class="crayon-h"> </span><span class="crayon-s">'Authorization: Token token=861af99a9dbf5e052b8b55cfc41e69d7'</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0006 seconds] -->
<p>In fact, if you make that request right now, it will go through &#8211; but that&#8217;s because we haven&#8217;t built any authentication yet! We want to prevent any resources from being accessed unless the requestor is properly authenticated. To add in the handlers for this authentication, we will again be editing our application_controller.rb:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e58987413014" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/application_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e58987413014-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e58987413014-2">2</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e58987413014-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e58987413014-4">4</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e58987413014-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e58987413014-6">6</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e58987413014-7">7</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e58987413014-1"><span class="crayon-v">before_filter</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">authenticate_user_from_token</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">except</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">token</span><span class="crayon-sy">]</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e58987413014-2">&nbsp;</div><div class="crayon-line" id="crayon-58dc7cf2e3e58987413014-3"><span class="crayon-m">private</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e58987413014-4">&nbsp;</div><div class="crayon-line" id="crayon-58dc7cf2e3e58987413014-5"><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-v">authenticate_user_from</span><span class="crayon-sy">_</span>token</div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e58987413014-6">&nbsp;</div><div class="crayon-line" id="crayon-58dc7cf2e3e58987413014-7"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0009 seconds] -->
<p>We are adding a before_filter hook that will call our created <strong>authenticate_user_from_token</strong> method on every single request, except when the user is requesting the initial token (since they don&#8217;t know their token yet at that point). Let&#8217;s update that authenticate_user_from_token method now:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e5e747464254" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/application_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e5e747464254-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e5e747464254-2">2</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e5e747464254-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc7cf2e3e5e747464254-4">4</div><div class="crayon-num" data-line="crayon-58dc7cf2e3e5e747464254-5">5</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e5e747464254-1"><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-v">authenticate_user_from</span><span class="crayon-sy">_</span>token</div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e5e747464254-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">unless</span><span class="crayon-h"> </span><span class="crayon-v">authenticate_with_http</span><span class="crayon-sy">_</span>token<span class="crayon-h"> </span><span class="crayon-k ">{</span><span class="crayon-h"> </span><span class="crayon-o">|</span><span class="crayon-v">token</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">options</span><span class="crayon-o">|</span><span class="crayon-h"> </span><span class="crayon-v">User</span><span class="crayon-sy">.</span><span class="crayon-e">find_by</span><span class="crayon-sy">(</span><span class="crayon-v">auth_token</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">token</span><span class="crayon-sy">)</span><span class="crayon-h"> </span><span class="crayon-k ">}</span></div><div class="crayon-line" id="crayon-58dc7cf2e3e5e747464254-3"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">render</span><span class="crayon-h"> </span><span class="crayon-v">json</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-k ">{</span><span class="crayon-h"> </span><span class="crayon-v">error</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'Bad Token'</span><span class="crayon-k ">}</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">status</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-cn">401</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc7cf2e3e5e747464254-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58dc7cf2e3e5e747464254-5"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0019 seconds] -->
<p>And this is actually all we need to add. Remember how we used a fancy authenticate_with_http_basic method in our <em>token</em> action to handle basic authentication? We&#8217;re using a similar method here in this hook to handle token-based authentication. The <strong>authenticate_with_http_token</strong> method will look for an incoming request and parse the <em>Authorization</em> header again, but in this case, it looks specifically for a token-based authentication format. We only pass in one value with this form of authentication (which is the token), and you can see above how this method will parse out our token and provide it as a block parameter. We additionally also receive an <em>options</em> parameter, but we won&#8217;t be using that.</p>
<p>The logic that we added in our authenticate_user_from_token method will parse an incoming request and validate not only that it is using token-based authentication, but that the token corresponds to an actual user. If the token is valid, then the request continues as normal to <strong>/posts/1</strong>; if the token is invalid (or completely missing), then we will receive an error.</p>
<p>As an example, if we submit this request again that we did earlier:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e65278959154" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e65278959154-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e65278959154-1"><span class="crayon-e">curl </span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-o">/</span><span class="crayon-o">/</span><span class="crayon-v">localhost</span><span class="crayon-o">:</span><span class="crayon-cn">3000</span><span class="crayon-o">/</span><span class="crayon-v">posts</span><span class="crayon-o">/</span><span class="crayon-cn">1</span><span class="crayon-h"> </span><span class="crayon-o">-</span><span class="crayon-i">H</span><span class="crayon-h"> </span><span class="crayon-s">'Authorization: Token token=861af99a9dbf5e052b8b55cfc41e69d7'</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0007 seconds] -->
<p>It will work perfectly and return the first post&#8217;s data. But if we change up the token just a little bit and remove that last character like so:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e6a226498598" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e6a226498598-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e6a226498598-1"><span class="crayon-e">curl </span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts/1 -H 'Authorization: Token token=861af99a9dbf5e052b8b55cfc41e69d'</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>Then we will receive the following error:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e70105969761" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e70105969761-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e70105969761-1"><span class="crayon-sy">{</span><span class="crayon-v">error</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'Bad Token'</span><span class="crayon-sy">}</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>And that&#8217;s it! You now have a pretty secure API with all the benefits of token-based authentication (don&#8217;t remember those benefits? Review them in <a title="Building a JSON API with Rails – Part 3: Authentication Strategies" href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/" target="_blank">the last post</a>). For debugging purposes it&#8217;s often a pain to have to worry about authentication, and I kept that in mind as I was building this architecture. If you ever want to make a request to a resource without having to authenticate, then just comment out the <strong>before_filter</strong> line:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc7cf2e3e75809779976" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/application_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc7cf2e3e75809779976-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc7cf2e3e75809779976-1"><span class="crayon-c"># before_filter :authenticate_user_from_token, except: [:token]</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0002 seconds] -->
<p>And now all of your requests will go through without worrying about authentication. Just remember to turn it back on before you push anything to production!</p>
<h2>Finale</h2>
<p>You officially now have a thorough base API with a lot of the major concerns hammered out. This concludes the 3 major points that I wanted to discuss &#8211; scaffolding an API, serialization, and authentication. But, I still have a couple more parts I want to cover like <strong>writing tests for an API</strong> as well as a general overview of some other API topics such as <strong>Rails vs Rails API file structure, nested vs. flat routes, CORS, and filtering resources based on query parameters</strong> &#8211; so don&#8217;t think we&#8217;re quite done yet.</p>
<p>You can check out all those smaller concepts in the <a href="https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/">next post in this series</a> &#8211; Afterthoughts!</p>
<hr class="short" />
<p>P.S. If you want to see an example JSON API built with Rails using everything that we&#8217;ve discussed so far, check out my <a href="https://github.com/alkrauss48/talks/tree/master/okcrb-api" target="_blank">example API GitHub repo</a> based on a talk I gave at a local Ruby meetup.</p>
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
                    <li class="comment even thread-even depth-1" id="dsq-comment-42">
        <div id="dsq-comment-header-42" class="dsq-comment-header">
            <cite id="dsq-cite-42">
                <span id="dsq-author-user-42">TheAshwaniK</span>
            </cite>
        </div>
        <div id="dsq-comment-body-42" class="dsq-comment-body">
            <div id="dsq-comment-message-42" class="dsq-comment-message"><p>Thanks.. I have been waiting for this.  Great job.</p>
<p>The link is broken.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-44">
        <div id="dsq-comment-header-44" class="dsq-comment-header">
            <cite id="dsq-cite-44">
                <span id="dsq-author-user-44">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-44" class="dsq-comment-body">
            <div id="dsq-comment-message-44" class="dsq-comment-message"><p>Thanks! That link is fixed now</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/' rel='external nofollow' class='url'>Building a JSON API with Rails – Part 3: Authentication Strategies | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="comment even thread-odd thread-alt depth-1" id="dsq-comment-46">
        <div id="dsq-comment-header-46" class="dsq-comment-header">
            <cite id="dsq-cite-46">
                <a id="dsq-author-user-46" href="http://www.pixelsnatch.com" target="_blank" rel="nofollow">brandonpittman</a>
            </cite>
        </div>
        <div id="dsq-comment-body-46" class="dsq-comment-body">
            <div id="dsq-comment-message-46" class="dsq-comment-message"><p>Do you know of any tutorials for making an authentication system like this work with Ember?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-47">
        <div id="dsq-comment-header-47" class="dsq-comment-header">
            <cite id="dsq-cite-47">
                <span id="dsq-author-user-47">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-47" class="dsq-comment-body">
            <div id="dsq-comment-message-47" class="dsq-comment-message"><p>No, but I can give you the step-by-steps as to how you would do it. The client-side is much easier to build than the server-side.</p>
<p>1) Built a controller and template for a Login screen (just with a username/password form)</p>
<p>2) Create a &#8220;submit&#8221; action which makes a request to &#8220;/token&#8221; on your server with base64 encoded username and password &#8211; just like is discussed in this post. JS has a nice &#8220;btoa&#8221; function, so you don&#8217;t need Ember to do the encoding.</p>
<p>3) On the success callback of that request, save the token in the response as a cookie in your browser. From now on, in order to check if you&#8217;re logged in on the client-side, just check for the existence of that token.</p>
<p>4) Last thing in that same callback, hard refresh the page using JS. Then you can check for the existence of the token in your routes and redirect your main index route to another template.</p>
<p>5) Now on every other request, tell Ember you want to set the Authorization header to use the token authentication string that we discuss in this post. I know you can set default headers in Angular, so I&#8217;m sure you can do it in Ember too.</p>
<p>6) Now every request you make is authenticated. To add log out functionality, just create an action that deletes the cookie and then hard refreshes the page. Your routes will refresh, and since the cookie no longer exists, they should point back at the login template</p>
<p>BONUS:</p>
<p>Obviously you want to be able to access some type of currentUser properties in Ember after you log in. To do that, add a route on your server that responds to GET &#8220;/me&#8221; and have it just return the record of the logged-in user. Then, right when Ember loads and you&#8217;re logged in, have it make a GET request to &#8220;/me&#8221; and set the response to some sort of globally-accessible variable (In angular, for example, I do this with $rootScope). Now you can access a currentUser in Ember and do things like display current name, avatar, get the user&#8217;s ID, etc.</p>
<p>Hope this helps!</p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-3" id="dsq-comment-49">
        <div id="dsq-comment-header-49" class="dsq-comment-header">
            <cite id="dsq-cite-49">
                <a id="dsq-author-user-49" href="http://www.pixelsnatch.com" target="_blank" rel="nofollow">brandonpittman</a>
            </cite>
        </div>
        <div id="dsq-comment-body-49" class="dsq-comment-body">
            <div id="dsq-comment-message-49" class="dsq-comment-message"><p>Thank you very much! This should be very helpful.</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment odd alt depth-3" id="dsq-comment-50">
        <div id="dsq-comment-header-50" class="dsq-comment-header">
            <cite id="dsq-cite-50">
                <a id="dsq-author-user-50" href="http://www.pixelsnatch.com" target="_blank" rel="nofollow">brandonpittman</a>
            </cite>
        </div>
        <div id="dsq-comment-body-50" class="dsq-comment-body">
            <div id="dsq-comment-message-50" class="dsq-comment-message"><p>Started off with something like this&#8230;</p>
<p>import Ember from &#8217;ember&#8217;;<br />
export default Ember.Controller.extend({<br />
  actions: {<br />
    authenticate: function() {<br />
      $.ajax({<br />
        url: &#8216;http://localhost:3000/token&#8217;,<br />
        type: &#8216;GET&#8217;,<br />
        accepts: &#8216;application/json&#8217;,<br />
        success: function(data) {<br />
          result.set(&#8216;content&#8217;, data);<br />
          console.log(&#8216;DEBUG: GET Enquiries OK&#8217;);<br />
        },<br />
        error: function() {<br />
          console.log(&#8216;DEBUG: GET Enquiries Failed&#8217;);<br />
        }<br />
      });<br />
    }<br />
  }<br />
});</p>
<p>But I&#8217;m getting Access-Control-Allow-Origin errors. I added the &#8216;rack-cors&#8217; gem but I&#8217;m not sure what I&#8217;d have to do to the front end.</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment even depth-3" id="dsq-comment-279">
        <div id="dsq-comment-header-279" class="dsq-comment-header">
            <cite id="dsq-cite-279">
                <span id="dsq-author-user-279">kahina24</span>
            </cite>
        </div>
        <div id="dsq-comment-body-279" class="dsq-comment-body">
            <div id="dsq-comment-message-279" class="dsq-comment-message"><p>Hi Aaron<br />
What a great tutorial!<br />
Just one little issue I ran into that could be helpful for others. Using Base64.encode64 can create some problems because it is adding a n when the string submitted is longer. Better to use Base64.strict_encode64, no issue there!<br />
Thanks again!<br />
Kay</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment odd alt depth-2" id="dsq-comment-48">
        <div id="dsq-comment-header-48" class="dsq-comment-header">
            <cite id="dsq-cite-48">
                <span id="dsq-author-user-48">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-48" class="dsq-comment-body">
            <div id="dsq-comment-message-48" class="dsq-comment-message"><p>Actually, this post covers Ember Auth + Rails API really well <a href="http://johnmosesman.com/ember-simple-auth-tutorial-and-common-problems/" rel="nofollow">http://johnmosesman.com/ember-simple-auth-tutorial-and-common-problems/</a></p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-65">
        <div id="dsq-comment-header-65" class="dsq-comment-header">
            <cite id="dsq-cite-65">
                <span id="dsq-author-user-65">Lovish Choudhary</span>
            </cite>
        </div>
        <div id="dsq-comment-body-65" class="dsq-comment-body">
            <div id="dsq-comment-message-65" class="dsq-comment-message"><p>Awesome tutorial series !!!<br />
Quick question though, in your the tutorial a user can authenticate only if his record is present in system from before, but I also want to add the functionality of people being able to sign up through this api . Can you please throw some light on how should I do that ?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-66">
        <div id="dsq-comment-header-66" class="dsq-comment-header">
            <cite id="dsq-cite-66">
                <span id="dsq-author-user-66">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-66" class="dsq-comment-body">
            <div id="dsq-comment-message-66" class="dsq-comment-message"><p>Thanks for the kind words!</p>
<p>That wouldn&#8217;t be tough to do, you would just need to create another action similar to the token action which also bypasses the authenticate_user_from_token method. You would grab data from your user in the front-end (such as email and password) and submit that as a POST request to your action. You could probably stick this action in a User controller &#8211; maybe User#signup. From there you would create a User record based on the submitted POST data (which would create your auth_token), and then you could return the auth_token just like the token action does, and then proceed with your front-end logic just as if the user had initially logged in &#8211; such as saving the token as a cookie and using it on every subsequent request to authenticate.</p>
<p>Now your user would be created and they can just login as normal in the future like any other user.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-odd thread-alt depth-1" id="dsq-comment-68">
        <div id="dsq-comment-header-68" class="dsq-comment-header">
            <cite id="dsq-cite-68">
                <span id="dsq-author-user-68">Samuel Gladstone</span>
            </cite>
        </div>
        <div id="dsq-comment-body-68" class="dsq-comment-body">
            <div id="dsq-comment-message-68" class="dsq-comment-message"><p>This has been an absolutely fantastic introduction. I&#8217;m working on a personal project with Rails and KnockoutJS (primarily to review both of them, since I haven&#8217;t used either in a while), and this has been an invaluable resource. It&#8217;s tremendously helpful that you&#8217;ve taken the time to explain very plainly and directly the reasoning behind each step in the process. Thank you for putting this together. I will definitely be checking your blog (worth noting that I found this via a Google search) regularly from now on, and I will recommend this to several friends of mine. Thank you!</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-69">
        <div id="dsq-comment-header-69" class="dsq-comment-header">
            <cite id="dsq-cite-69">
                <span id="dsq-author-user-69">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-69" class="dsq-comment-body">
            <div id="dsq-comment-message-69" class="dsq-comment-message"><p>Thank you so much Samuel, this is definitely the most sincere comment I&#8217;ve gotten on any post and it makes me feel absolutely awesome. I post a new blog post every 3rd Friday (with the last one being last Friday), and it&#8217;s been really working out for me and my work/personal life schedule. Thanks again for the kind words!</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-76">
        <div id="dsq-comment-header-76" class="dsq-comment-header">
            <cite id="dsq-cite-76">
                <span id="dsq-author-user-76">Rared Dev</span>
            </cite>
        </div>
        <div id="dsq-comment-body-76" class="dsq-comment-body">
            <div id="dsq-comment-message-76" class="dsq-comment-message"><p>Great series, from start to finish. Keep &#8217;em coming!</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment odd alt thread-odd thread-alt depth-1" id="dsq-comment-80">
        <div id="dsq-comment-header-80" class="dsq-comment-header">
            <cite id="dsq-cite-80">
                <span id="dsq-author-user-80">Olatoyosi Khadijah</span>
            </cite>
        </div>
        <div id="dsq-comment-body-80" class="dsq-comment-body">
            <div id="dsq-comment-message-80" class="dsq-comment-message"><p>Great tutorial! Looking forward to future posts. Keep it up!</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-81">
        <div id="dsq-comment-header-81" class="dsq-comment-header">
            <cite id="dsq-cite-81">
                <a id="dsq-author-user-81" href="https://plus.google.com/+AnjanJagirdar" target="_blank" rel="nofollow">Anjan Jagirdar</a>
            </cite>
        </div>
        <div id="dsq-comment-body-81" class="dsq-comment-body">
            <div id="dsq-comment-message-81" class="dsq-comment-message"><p>Beautiful Tutorial, helped me immensely. Looking forward to your other tutorials.</p>
<p>You have explained it so simply I get each and every point. Thanks a ton again. 🙂</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment odd alt thread-odd thread-alt depth-1" id="dsq-comment-82">
        <div id="dsq-comment-header-82" class="dsq-comment-header">
            <cite id="dsq-cite-82">
                <span id="dsq-author-user-82">perry e</span>
            </cite>
        </div>
        <div id="dsq-comment-body-82" class="dsq-comment-body">
            <div id="dsq-comment-message-82" class="dsq-comment-message"><p>Awesome intro to both rails, api, and authentication/authorization concepts. Very &#8220;simple&#8221; and easy to understand. Thanks so much.</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-87">
        <div id="dsq-comment-header-87" class="dsq-comment-header">
            <cite id="dsq-cite-87">
                <span id="dsq-author-user-87">Erik</span>
            </cite>
        </div>
        <div id="dsq-comment-body-87" class="dsq-comment-body">
            <div id="dsq-comment-message-87" class="dsq-comment-message"><p>Great overview on the simple authentication. Are you planning on continuing the series?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-88">
        <div id="dsq-comment-header-88" class="dsq-comment-header">
            <cite id="dsq-cite-88">
                <span id="dsq-author-user-88">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-88" class="dsq-comment-body">
            <div id="dsq-comment-message-88" class="dsq-comment-message"><p>Thanks! I do have one final post tying up some loose ends that will post in early December. It&#8217;ll be a conclusion to this series that goes over things like nested vs. flat routes, CORS, testing, and more.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-odd thread-alt depth-1" id="dsq-comment-96">
        <div id="dsq-comment-header-96" class="dsq-comment-header">
            <cite id="dsq-cite-96">
                <span id="dsq-author-user-96">Rafael Tanaka</span>
            </cite>
        </div>
        <div id="dsq-comment-body-96" class="dsq-comment-body">
            <div id="dsq-comment-message-96" class="dsq-comment-message"><p>great job man!</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment odd alt thread-even depth-1" id="dsq-comment-110">
        <div id="dsq-comment-header-110" class="dsq-comment-header">
            <cite id="dsq-cite-110">
                <span id="dsq-author-user-110">Sukeshni</span>
            </cite>
        </div>
        <div id="dsq-comment-body-110" class="dsq-comment-body">
            <div id="dsq-comment-message-110" class="dsq-comment-message"><p>Hey Aaron,<br />
Amazing series to learn API in rails. Waiting for nested vs. flat routes, CORS, testing. Thanks.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-2" id="dsq-comment-111">
        <div id="dsq-comment-header-111" class="dsq-comment-header">
            <cite id="dsq-cite-111">
                <span id="dsq-author-user-111">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-111" class="dsq-comment-body">
            <div id="dsq-comment-message-111" class="dsq-comment-message"><p>Thank you! That one actually drops tomorrow, I&#8217;m really excited about it. That&#8217;ll be the final post in this series.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-3" id="dsq-comment-113">
        <div id="dsq-comment-header-113" class="dsq-comment-header">
            <cite id="dsq-cite-113">
                <span id="dsq-author-user-113">Sukeshni</span>
            </cite>
        </div>
        <div id="dsq-comment-body-113" class="dsq-comment-body">
            <div id="dsq-comment-message-113" class="dsq-comment-message"><p>Oh wow superb !!<br />
Can&#8217;t wait !<br />
Thanks a lot.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/' rel='external nofollow' class='url'>Building a JSON API with Rails – Part 2: Serialization | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/' rel='external nofollow' class='url'>Building a JSON API with Rails &#8211; Part 1: Getting Started | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="comment even thread-odd thread-alt depth-1" id="dsq-comment-168">
        <div id="dsq-comment-header-168" class="dsq-comment-header">
            <cite id="dsq-cite-168">
                <span id="dsq-author-user-168">Arunvel Sriram</span>
            </cite>
        </div>
        <div id="dsq-comment-body-168" class="dsq-comment-body">
            <div id="dsq-comment-message-168" class="dsq-comment-message"><p>Great tutorial. Am working on a mobile app that communicates with REST API. Can you suggest some ways to handle token expiry? What if the token is compromised? How do I know that the token is compromised?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-169">
        <div id="dsq-comment-header-169" class="dsq-comment-header">
            <cite id="dsq-cite-169">
                <span id="dsq-author-user-169">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-169" class="dsq-comment-body">
            <div id="dsq-comment-message-169" class="dsq-comment-message"><p>If you set the token via a cookie, then you can control how long the cookie lasts. You could do this for Cordova apps, and I imagine there&#8217;s something similar for native. For expiration, you could either just wait for your token to expire (and thus force a new login), set up a route which will just refresh the cookie or set up a new token for the user, etc. You have options. You won&#8217;t know the token is compromised unless you track the IP or physical location of the user and notice that it has changed drastically, or you just notice strange activity in general. When you get to those kinds of concerns though, then you&#8217;re looking at needing a QA team or some other unit of people to watch for that type of activity &#8211; regardless of what form of authentication you use.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-234">
        <div id="dsq-comment-header-234" class="dsq-comment-header">
            <cite id="dsq-cite-234">
                <span id="dsq-author-user-234">Naveen Kumar</span>
            </cite>
        </div>
        <div id="dsq-comment-body-234" class="dsq-comment-body">
            <div id="dsq-comment-message-234" class="dsq-comment-message"><p>great</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment odd alt thread-odd thread-alt depth-1" id="dsq-comment-243">
        <div id="dsq-comment-header-243" class="dsq-comment-header">
            <cite id="dsq-cite-243">
                <span id="dsq-author-user-243">kishore</span>
            </cite>
        </div>
        <div id="dsq-comment-body-243" class="dsq-comment-body">
            <div id="dsq-comment-message-243" class="dsq-comment-message"><p>excellent , i want to talk with you , can u please provide your personal mail please</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-293">
        <div id="dsq-comment-header-293" class="dsq-comment-header">
            <cite id="dsq-cite-293">
                <span id="dsq-author-user-293">Lars</span>
            </cite>
        </div>
        <div id="dsq-comment-body-293" class="dsq-comment-body">
            <div id="dsq-comment-message-293" class="dsq-comment-message"><p>The best tutorial EVER! Thank you so very much. This tutorial did for me in one day, what a whole lot of other tutorials couldn&#8217;t do in 1,5 week. I am so grateful. Thank you</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-295">
        <div id="dsq-comment-header-295" class="dsq-comment-header">
            <cite id="dsq-cite-295">
                <span id="dsq-author-user-295">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-295" class="dsq-comment-body">
            <div id="dsq-comment-message-295" class="dsq-comment-message"><p>Thank you &#8211; I&#8217;m really glad you enjoyed it! =D</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
            </ul>


        </div>

    </div>

<script type="text/javascript">
var disqus_url = 'https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-4-implementing-authentication/';
var disqus_identifier = '504 http://thesocietea.org/?p=504';
var disqus_container_id = 'disqus_thread';
var disqus_shortname = 'thesocietea';
var disqus_title = "Building a JSON API with Rails – Part 4: Implementing Authentication";
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
        script.src = '?cf_action=sync_comments&post_id=504';

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
<link rel='stylesheet' id='jetpack_css-css'  href='https://thesocietea.org/wp-content/plugins/jetpack/css/jetpack.css?ver=4.7.1' type='text/css' media='all' />
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

<!-- Dynamic page generated in 0.429 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-03-30 03:35:15 -->
