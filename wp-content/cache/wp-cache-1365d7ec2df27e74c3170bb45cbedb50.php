<?php die(); ?><!DOCTYPE html>
<html lang="en-US">
<!DOCTYPE html>
  <!--[if IE 8]>         <html lang="en" class="no-js ie8 lte-ie9"> <![endif]-->
  <!--[if lte IE 9]>     <html lang="en" class="no-js lte-ie9"> <![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Building a JSON API with Rails &#8211; Part 1: Getting Started | Aaron Krauss</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="https://thesocietea.org/xmlrpc.php">

    <meta name="description" content="How can you go about supporting your Angular/Ember/Backbone app, iOS app, Android app, Windows phone app, etc., all with a single back-end? Here’s how: by breaking up your backend server into its own API service, and Rails is just the framework to help make it simple and awesome. This service separation is dubbed Service Oriented Architecture...">
    <meta property="og:description" content="How can you go about supporting your Angular/Ember/Backbone app, iOS app, Android app, Windows phone app, etc., all with a single back-end? Here’s how: by breaking up your backend server into its own API service, and Rails is just the framework to help make it simple and awesome. This service separation is dubbed Service Oriented Architecture...">
        <meta property="og:image" content="https://thesocietea.org/assets/images/dist/ak-smile-optimized.jpg">
    <meta property="og:title" content="Building a JSON API with Rails &#8211; Part 1: Getting Started | Aaron Krauss">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/ " />
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
  <body class="post-template-default single single-post postid-381 single-format-standard m-scene">
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


			
<article id="post-381" class="post-381 post type-post status-publish format-standard hentry category-ruby">
            <div class="container-padding">
<div class="container">
  <header class="entry-header">
    <h1 class="entry-title">Building a JSON API with Rails &#8211; Part 1: Getting Started</h1>
    <div class="entry-meta">
      <span class="posted-on"><span><time class="entry-date published" datetime="2015-02-20T21:18:13+00:00">February 20, 2015</time></span></span>    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
<hr class="short" />

  <div class="entry-content">
    <div class="pre-post-content">
      <p><strong>Foreword</strong>:</p>
<p>This series has been rewritten as of <strong>November 11, 2016</strong> based on the new API features in Rails 5. Formerly, this post covered the use of the rails-api gem, which has now been merged into core Rails 5.</p>
<p>If you want to skip all the reading and just see an example API built using the exact technologies I&#8217;ll be discussing in this series of posts, check out my <a href="https://github.com/alkrauss48/talks/tree/master/okcrb-api" target="_blank">GitHub repo</a> over a Ruby talk I gave where we live-coded a full API.</p>
<hr class="short" />
<p><strong>Table of Contents</strong></p>
<ul>
<li>Part 1 &#8211; Getting Started</li>
<li><a href="https://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/">Part 2 &#8211; Serialization</a></li>
<li><a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/">Part 3 &#8211; Authentication Strategies</a></li>
<li><a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-4-implementing-authentication/">Part 4 &#8211; Implementing Authentication</a></li>
<li><a href="https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/">Part 5 &#8211; Afterthoughts</a></li>
<li><a href="https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/">Part 6 &#8211; The JSON API Spec, Pagination, and Versioning</a></li>
</ul>
<hr />
    </div>
    <p>How can you go about supporting your Angular/Ember/Backbone app, iOS app, Android app, Windows phone app, etc., all with a single back-end? Here’s how: by breaking up your backend server into its own API service, and Rails is just the framework to help make it simple and awesome.</p>
<p>This service separation is dubbed Service Oriented Architecture (<a href="http://en.wikipedia.org/wiki/Service-oriented_architecture" target="_blank">SOA</a>), and by following it and building a JSON API that&#8217;s separate from the front-end, you&#8217;ll be able to support all of your related apps with this single service and keep your back-end incredibly simple, logical, and easily maintainable.</p>
<p>In order to build a solid API, we&#8217;re going to break our goal up into 3 different tasks:</p>
<ul>
<li>Build out our models and our data</li>
<li>Serialize our data</li>
<li>Add Authentication</li>
</ul>
<p>Adding authentication is always an optional step, but most of the time you&#8217;re going to want to prevent unauthorized users from accessing your API. We&#8217;re going to tackle just the first task in this post, and save the rest for the next two parts. Ready to start? Good.</p>
<h2>Starting Out</h2>
<p>First off, we install rails similarly to how you&#8217;ve always done it &#8211; but with the new Rails 5 API flag.</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f4fe4cccb7b825517453" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f4fe4cccb7b825517453-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccb7b825517453-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f4fe4cccb7b825517453-1"><span class="crayon-e">rails </span><span class="crayon-r">new</span><span class="crayon-h"> </span><span class="crayon-v">my_blog</span><span class="crayon-h"> </span><span class="crayon-o">--</span><span class="crayon-e">api</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccb7b825517453-2"><span class="crayon-r">cd</span><span class="crayon-h"> </span><span class="crayon-v">my_blog</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0005 seconds] -->
<p>As you can probably see, we&#8217;re going to be creating a blog, and it will have the following database structure:</p>
<ul>
<li>User has many Posts</li>
<li>User has many Comments</li>
<li>Posts has many Comments</li>
</ul>
<h2>Building the API</h2>
<p>Just a simple 3-table database will suffice, so let&#8217;s use the rails generators to scaffold out our 3 models:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f4fe4cccbdb359070120" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f4fe4cccbdb359070120-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccbdb359070120-2">2</div><div class="crayon-num" data-line="crayon-58f4fe4cccbdb359070120-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccbdb359070120-4">4</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f4fe4cccbdb359070120-1"><span class="crayon-i">rails</span><span class="crayon-h"> </span><span class="crayon-i">g</span><span class="crayon-h"> </span><span class="crayon-e">scaffold </span><span class="crayon-e">user </span><span class="crayon-v">email</span><span class="crayon-o">:</span><span class="crayon-t">string</span><span class="crayon-h"> </span><span class="crayon-v">password</span><span class="crayon-o">:</span><span class="crayon-t">string</span><span class="crayon-h"> </span><span class="crayon-v">auth_token</span><span class="crayon-o">:</span><span class="crayon-t">string</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccbdb359070120-2"><span class="crayon-i">rails</span><span class="crayon-h"> </span><span class="crayon-i">g</span><span class="crayon-h"> </span><span class="crayon-e">scaffold </span><span class="crayon-e">post </span><span class="crayon-v">title</span><span class="crayon-o">:</span><span class="crayon-t">string</span><span class="crayon-h"> </span><span class="crayon-v">body</span><span class="crayon-o">:</span><span class="crayon-e">text </span><span class="crayon-v">user</span><span class="crayon-o">:</span><span class="crayon-e">references</span></div><div class="crayon-line" id="crayon-58f4fe4cccbdb359070120-3"><span class="crayon-i">rails</span><span class="crayon-h"> </span><span class="crayon-i">g</span><span class="crayon-h"> </span><span class="crayon-e">scaffold </span><span class="crayon-e">comment </span><span class="crayon-v">body</span><span class="crayon-o">:</span><span class="crayon-e">text </span><span class="crayon-v">user</span><span class="crayon-o">:</span><span class="crayon-e">references </span><span class="crayon-v">post</span><span class="crayon-o">:</span><span class="crayon-e">references</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccbdb359070120-4"><span class="crayon-e">rake </span><span class="crayon-v">db</span><span class="crayon-o">:</span><span class="crayon-v">migrate</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0017 seconds] -->
<p>If you&#8217;re familiar with Rails, then this looks very familiar to you. In fact, you can probably tell very easily what each attribute&#8217;s purpose is &#8211; except for <strong>auth_token</strong> perhaps. We&#8217;re going to make use of that attribute later on when we discuss and build in authentication, so don&#8217;t worry about it for now.</p>
<p>After you migrate your database, then you have a fully functioning API! Start up your local rails server and navigate to</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f4fe4cccbe8032936169" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f4fe4cccbe8032936169-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f4fe4cccbe8032936169-1"><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/users</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>to see your API live. It should look like an empty array set, which is what we want &#8211; just pure JSON.</p>
<h2>Seeding the Database</h2>
<p>If you want to add some seeds to populate your database, you can add this code to your db/seeds.rb file:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f4fe4cccbf2461068076" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">db/seeds.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f4fe4cccbf2461068076-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccbf2461068076-2">2</div><div class="crayon-num" data-line="crayon-58f4fe4cccbf2461068076-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccbf2461068076-4">4</div><div class="crayon-num" data-line="crayon-58f4fe4cccbf2461068076-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccbf2461068076-6">6</div><div class="crayon-num" data-line="crayon-58f4fe4cccbf2461068076-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccbf2461068076-8">8</div><div class="crayon-num" data-line="crayon-58f4fe4cccbf2461068076-9">9</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccbf2461068076-10">10</div><div class="crayon-num" data-line="crayon-58f4fe4cccbf2461068076-11">11</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f4fe4cccbf2461068076-1"><span class="crayon-v">u1</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">User</span><span class="crayon-sy">.</span><span class="crayon-e">create</span><span class="crayon-sy">(</span><span class="crayon-v">email</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'user@example.com'</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">password</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'password'</span><span class="crayon-sy">)</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccbf2461068076-2"><span class="crayon-v">u2</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">User</span><span class="crayon-sy">.</span><span class="crayon-e">create</span><span class="crayon-sy">(</span><span class="crayon-v">email</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'user2@example.com'</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">password</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'password'</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f4fe4cccbf2461068076-3">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccbf2461068076-4"><span class="crayon-v">p1</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">u1</span><span class="crayon-sy">.</span><span class="crayon-v">posts</span><span class="crayon-sy">.</span><span class="crayon-e">create</span><span class="crayon-sy">(</span><span class="crayon-v">title</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'First Post'</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">body</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'An Airplane'</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f4fe4cccbf2461068076-5"><span class="crayon-v">p2</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">u1</span><span class="crayon-sy">.</span><span class="crayon-v">posts</span><span class="crayon-sy">.</span><span class="crayon-e">create</span><span class="crayon-sy">(</span><span class="crayon-v">title</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'Second Post'</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">body</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'A Train'</span><span class="crayon-sy">)</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccbf2461068076-6">&nbsp;</div><div class="crayon-line" id="crayon-58f4fe4cccbf2461068076-7"><span class="crayon-v">p3</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">u2</span><span class="crayon-sy">.</span><span class="crayon-v">posts</span><span class="crayon-sy">.</span><span class="crayon-e">create</span><span class="crayon-sy">(</span><span class="crayon-v">title</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'Third Post'</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">body</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'A Truck'</span><span class="crayon-sy">)</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccbf2461068076-8"><span class="crayon-v">p4</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">u2</span><span class="crayon-sy">.</span><span class="crayon-v">posts</span><span class="crayon-sy">.</span><span class="crayon-e">create</span><span class="crayon-sy">(</span><span class="crayon-v">title</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'Fourth Post'</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">body</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">'A Boat'</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f4fe4cccbf2461068076-9">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccbf2461068076-10"><span class="crayon-v">p3</span><span class="crayon-sy">.</span><span class="crayon-v">comments</span><span class="crayon-sy">.</span><span class="crayon-e">create</span><span class="crayon-sy">(</span><span class="crayon-v">body</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"This post was terrible"</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">user</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">u1</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f4fe4cccbf2461068076-11"><span class="crayon-v">p4</span><span class="crayon-sy">.</span><span class="crayon-v">comments</span><span class="crayon-sy">.</span><span class="crayon-e">create</span><span class="crayon-sy">(</span><span class="crayon-v">body</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"This post was the best thing in the whole world"</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">user</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">u1</span><span class="crayon-sy">)</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0046 seconds] -->
<p>Now, all you need to do to run these seeds is update your User and Post model files with the necessary <b>has_many</b> relationships like so:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f4fe4cccbfd526097929" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/model/user.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f4fe4cccbfd526097929-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccbfd526097929-2">2</div><div class="crayon-num" data-line="crayon-58f4fe4cccbfd526097929-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccbfd526097929-4">4</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f4fe4cccbfd526097929-1"><span class="crayon-r">class</span><span class="crayon-h"> </span><span class="crayon-v">User</span><span class="crayon-h"> </span><span class="crayon-o">&lt;</span><span class="crayon-h"> </span><span class="crayon-v">ActiveRecord</span><span class="crayon-o">::</span><span class="crayon-i">Base</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccbfd526097929-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">has_many</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">posts</span></div><div class="crayon-line" id="crayon-58f4fe4cccbfd526097929-3"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">has_many</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">comments</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccbfd526097929-4"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0009 seconds] -->
<p></p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f4fe4cccc08577155961" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/model/post.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f4fe4cccc08577155961-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccc08577155961-2">2</div><div class="crayon-num" data-line="crayon-58f4fe4cccc08577155961-3">3</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f4fe4cccc08577155961-1"><span class="crayon-r">class</span><span class="crayon-h"> </span><span class="crayon-v">Post</span><span class="crayon-h"> </span><span class="crayon-o">&lt;</span><span class="crayon-h"> </span><span class="crayon-v">ActiveRecord</span><span class="crayon-o">::</span><span class="crayon-i">Base</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccc08577155961-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">has_many</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">comments</span></div><div class="crayon-line" id="crayon-58f4fe4cccc08577155961-3"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0007 seconds] -->
<p>And then run the seed command to pre-populate your database:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f4fe4cccc12471109864" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f4fe4cccc12471109864-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f4fe4cccc12471109864-1"><span class="crayon-e">rake </span><span class="crayon-v">db</span><span class="crayon-o">:</span><span class="crayon-v">seed</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>Now your database has real data!</p>
<h2>Issuing Requests</h2>
<p>Because we scaffolded our resources, we created controllers that are fully capable of handling the standard HTTP requests types: <strong>GET</strong>, <strong>POST</strong>, <strong>PUT/PATCH</strong>, and <strong>DELETE</strong>. If you&#8217;re a little unfamiliar with these names, you can map it to the common <strong>CRUD</strong> acronym:</p>
<ul>
<li><strong>C</strong>reate (POST)</li>
<li><strong>R</strong>ead (GET)</li>
<li><strong>U</strong>pdate (PUT/PATCH)</li>
<li><strong>D</strong>elete (DELETE)</li>
</ul>
<p>The URLs for issuing any of these requests are:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f4fe4cccc1e240447605" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f4fe4cccc1e240447605-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f4fe4cccc1e240447605-2">2</div><div class="crayon-num" data-line="crayon-58f4fe4cccc1e240447605-3">3</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f4fe4cccc1e240447605-1"><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/users</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f4fe4cccc1e240447605-2"><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts</span></div><div class="crayon-line" id="crayon-58f4fe4cccc1e240447605-3"><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/comments</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0008 seconds] -->
<p>You can obviously issue GET requests by visiting these pages in your browser, or you can use the <strong>curl</strong> command from your terminal (or similar command) to issue any of these requests. Everything will work as expected.</p>
<h2>That&#8217;s it?</h2>
<p>No, of course that&#8217;s not it, but look at what we&#8217;ve done so far &#8211; we&#8217;ve built a relational database with a fully functioning JSON API on top that can handle any of the 4 main request types, and we did it in practically no time flat. We have a lot more to talk about such as serialization, authentication, and an overview post discussing some of the bigger questions that come up when you&#8217;re building an API, so if you&#8217;re ready, feel free to <a title="Building a JSON API with Rails – Part 2: Serialization" href="http://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/">move onto part 2</a>.</p>
<p>Happy API Building!</p>
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
                    <li class="comment even thread-even depth-1" id="dsq-comment-23">
        <div id="dsq-comment-header-23" class="dsq-comment-header">
            <cite id="dsq-cite-23">
                <span id="dsq-author-user-23">Nate McGuire</span>
            </cite>
        </div>
        <div id="dsq-comment-body-23" class="dsq-comment-body">
            <div id="dsq-comment-message-23" class="dsq-comment-message"><p>Very clean, nicely done. Have been thinking more about using rails like this and backbone/react on the front end. </p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-24">
        <div id="dsq-comment-header-24" class="dsq-comment-header">
            <cite id="dsq-cite-24">
                <span id="dsq-author-user-24">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-24" class="dsq-comment-body">
            <div id="dsq-comment-message-24" class="dsq-comment-message"><p>Thank you! We barely just got our feet wet here, so check back in a couple weeks as we continue on. I&#8217;ve built 2 large projects using rails-api (one angular, one ember), and it is so, so nice and super developer friendly (just like the full Rails framework).</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-odd thread-alt depth-1" id="dsq-comment-25">
        <div id="dsq-comment-header-25" class="dsq-comment-header">
            <cite id="dsq-cite-25">
                <span id="dsq-author-user-25">cappie013</span>
            </cite>
        </div>
        <div id="dsq-comment-body-25" class="dsq-comment-body">
            <div id="dsq-comment-message-25" class="dsq-comment-message"><p>And as always, no testing &#8230;</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-26">
        <div id="dsq-comment-header-26" class="dsq-comment-header">
            <cite id="dsq-cite-26">
                <span id="dsq-author-user-26">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-26" class="dsq-comment-body">
            <div id="dsq-comment-message-26" class="dsq-comment-message"><p>I wasn&#8217;t originally planning to cover testing, but that&#8217;s a great idea for another post. Testing is SUPER simple with an API; I mean think about it, you don&#8217;t have any html views so you don&#8217;t have to do any integration testing which means less complex tests that run quicker (especially if you normally use a JavaScript driver for your integration tests). My latest rails API project has over 430 tests, and the whole suite runs regularly in 12 seconds!</p>
<p>If you scaffold API resources like we did here, then you actually have some tests already written for you using TestUnit (though I prefer using RSpec). I&#8217;ll add testing as part 4 &#8211; thanks for the motivation!</p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-3" id="dsq-comment-52">
        <div id="dsq-comment-header-52" class="dsq-comment-header">
            <cite id="dsq-cite-52">
                <span id="dsq-author-user-52">Ismail Akram</span>
            </cite>
        </div>
        <div id="dsq-comment-body-52" class="dsq-comment-body">
            <div id="dsq-comment-message-52" class="dsq-comment-message"><p>Late to party, but I think integration tests are one you would use for testing apis, rspec call these as request spec. We use actions/command pattern with integration test to test apis. And it works  so well for APIs. </p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='http://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/' rel='external nofollow' class='url'>Building a JSON API with Rails – Part 2: Serialization | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="comment odd alt thread-even depth-1" id="dsq-comment-57">
        <div id="dsq-comment-header-57" class="dsq-comment-header">
            <cite id="dsq-cite-57">
                <span id="dsq-author-user-57">Brian Broom</span>
            </cite>
        </div>
        <div id="dsq-comment-body-57" class="dsq-comment-body">
            <div id="dsq-comment-message-57" class="dsq-comment-message"><p>I&#8217;m having trouble coming up with the correct syntax for cURL requests for creating a user. It seems like the problem is in how the payload is structured. </p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-2" id="dsq-comment-58">
        <div id="dsq-comment-header-58" class="dsq-comment-header">
            <cite id="dsq-cite-58">
                <span id="dsq-author-user-58">Brian Broom</span>
            </cite>
        </div>
        <div id="dsq-comment-body-58" class="dsq-comment-body">
            <div id="dsq-comment-message-58" class="dsq-comment-message"><p>I figured it out. Two important parts are &#8211; make sure you set the content-type of your request, and the combination of single/double quotes has to be right (not sure if that is a curl thing, a ruby/rails thing, or a os thing)</p>
<p>I used<br />
<code>curl -d '{"user":{"email":"user6@example.com","password":"password"}}' -H "Content-Type: application/json" -X POST localhost:3000/users</code></p>
<p>The JSON string for the post data has key/values with double quotes, and the whole thing is inside single quotes. Maybe this is common knowledge, but hope it helps someone.</p>
<p>The -X is the http command to use (default is GET, pretty sure that -d defaults to POST, but I included it anyway).</p>
<p>For DELETE it would be<br />
<code>curl -X DELETE localhost/users/id</code><br />
where id is the record to be deleted</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment odd alt thread-odd thread-alt depth-1" id="dsq-comment-112">
        <div id="dsq-comment-header-112" class="dsq-comment-header">
            <cite id="dsq-cite-112">
                <span id="dsq-author-user-112">Ahmad Ayyaz</span>
            </cite>
        </div>
        <div id="dsq-comment-body-112" class="dsq-comment-body">
            <div id="dsq-comment-message-112" class="dsq-comment-message"><p>And how I can make a call from android app to this json??? I am trying to do it but it is returning nothing. Please help</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/' rel='external nofollow' class='url'>Building a JSON API with Rails &#8211; Part 5: Afterthoughts | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-130">
        <div id="dsq-comment-header-130" class="dsq-comment-header">
            <cite id="dsq-cite-130">
                <span id="dsq-author-user-130">Vincent H</span>
            </cite>
        </div>
        <div id="dsq-comment-body-130" class="dsq-comment-body">
            <div id="dsq-comment-message-130" class="dsq-comment-message"><p>Not having trouble with POST &amp; GET for user, post, or comment individually but what if I&#8217;m trying to POST or GET a post to a user? or a comment to a specific post? using JSON in alamofire would i POST the post to localhost:3000/users/userNumber ? This has been about 3 days for me, I seem to be inching along but no luck&#8230;</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-131">
        <div id="dsq-comment-header-131" class="dsq-comment-header">
            <cite id="dsq-cite-131">
                <span id="dsq-author-user-131">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-131" class="dsq-comment-body">
            <div id="dsq-comment-message-131" class="dsq-comment-message"><p>To make a particular HTTP request to a specific resource (such as user with the ID of 2), you would hit <a href="http://localhost:3000/users/1" rel="nofollow">http://localhost:3000/users/1</a>. To make a comment to a specific post, you could just make a POST to /comments with the post_id passed in as data. To answer your other question, if you wanted to make a GET request to access all comments for a post, that&#8217;s not explained in this post, but if you hop over to Part 5 (linked below), I discuss how to filter resources like that. Basically, you would make a GET request to /comments?post_id=5 to get all comments for the post with the ID of 5.</p>
<p><a href="https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/" rel="nofollow">https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/</a></p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-3" id="dsq-comment-132">
        <div id="dsq-comment-header-132" class="dsq-comment-header">
            <cite id="dsq-cite-132">
                <span id="dsq-author-user-132">Vincent H</span>
            </cite>
        </div>
        <div id="dsq-comment-body-132" class="dsq-comment-body">
            <div id="dsq-comment-message-132" class="dsq-comment-message"><p>Thanks! Worked with what you told me and all of the resources interact</p>
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
        <p>Pingback: <a href='https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/' rel='external nofollow' class='url'>Building a JSON API with Rails – Part 3: Authentication Strategies | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-4-implementing-authentication/' rel='external nofollow' class='url'>Building a JSON API with Rails – Part 4: Implementing Authentication | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="comment odd alt thread-odd thread-alt depth-1" id="dsq-comment-292">
        <div id="dsq-comment-header-292" class="dsq-comment-header">
            <cite id="dsq-cite-292">
                <span id="dsq-author-user-292">Lindani Pani</span>
            </cite>
        </div>
        <div id="dsq-comment-body-292" class="dsq-comment-body">
            <div id="dsq-comment-message-292" class="dsq-comment-message"><p>Is the a way to download all the Parts series as some kind of a PDF or eBook please?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-2" id="dsq-comment-294">
        <div id="dsq-comment-header-294" class="dsq-comment-header">
            <cite id="dsq-cite-294">
                <span id="dsq-author-user-294">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-294" class="dsq-comment-body">
            <div id="dsq-comment-message-294" class="dsq-comment-message"><p>Alas, not right now. That&#8217;s an interesting thought though.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
            </ul>


        </div>

    </div>

<script type="text/javascript">
var disqus_url = 'https://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/';
var disqus_identifier = '381 http://thesocietea.org/?p=381';
var disqus_container_id = 'disqus_thread';
var disqus_shortname = 'thesocietea';
var disqus_title = "Building a JSON API with Rails &#8211; Part 1: Getting Started";
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
        script.src = '?cf_action=sync_comments&post_id=381';

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

<!-- Dynamic page generated in 0.344 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-04-17 17:41:33 -->
