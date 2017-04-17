<?php die(); ?><!DOCTYPE html>
<html lang="en-US">
<!DOCTYPE html>
  <!--[if IE 8]>         <html lang="en" class="no-js ie8 lte-ie9"> <![endif]-->
  <!--[if lte IE 9]>     <html lang="en" class="no-js lte-ie9"> <![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Building a JSON API with Rails &#8211; Part 5: Afterthoughts | Aaron Krauss</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="https://thesocietea.org/xmlrpc.php">

    <meta name="description" content="This post has been a long time coming, but I wanted to address some topics about building a JSON API with rails that didn&#8217;t fully fit into the actual building process of our API. If you&#8217;re unfamiliar about building a JSON API with rails at all, then I&#8217;ll direct you to the very first post in this...">
    <meta property="og:description" content="This post has been a long time coming, but I wanted to address some topics about building a JSON API with rails that didn&#8217;t fully fit into the actual building process of our API. If you&#8217;re unfamiliar about building a JSON API with rails at all, then I&#8217;ll direct you to the very first post in this...">
        <meta property="og:image" content="https://thesocietea.org/assets/images/dist/ak-smile-optimized.jpg">
    <meta property="og:title" content="Building a JSON API with Rails &#8211; Part 5: Afterthoughts | Aaron Krauss">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/ " />
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
  <body class="post-template-default single single-post postid-988 single-format-standard m-scene">
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


			
<article id="post-988" class="post-988 post type-post status-publish format-standard hentry category-ruby">
            <div class="container-padding">
<div class="container">
  <header class="entry-header">
    <h1 class="entry-title">Building a JSON API with Rails &#8211; Part 5: Afterthoughts</h1>
    <div class="entry-meta">
      <span class="posted-on"><span><time class="entry-date published" datetime="2015-12-11T12:00:09+00:00">December 11, 2015</time></span></span>    </div><!-- .entry-meta -->
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
<li><a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-4-implementing-authentication/">Part 4 &#8211; Implementing Authentication</a></li>
<li>Part 5 &#8211; Afterthoughts</li>
<li><a href="https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/">Part 6 &#8211; The JSON API Spec, Pagination, and Versioning</a></li>
</ul>
<hr />
    </div>
    <p>This post has been a long time coming, but I wanted to address some topics about building a JSON API with rails that didn&#8217;t fully fit into the actual building process of our API. If you&#8217;re unfamiliar about building a JSON API with rails at all, then I&#8217;ll direct you to the <a href="https://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/">very first post</a> in this series and you can start there. In this final post, I wanted to discuss some topics such as testing, CORS, filtering data, nested vs. flat routing architecture, and more. Basically things that I find valuable to know about as I build my own rails APIs. Let&#8217;s get to it!</p>
<h2>Flat vs Nested Routing Architecture</h2>
<p>Which is better to use &#8211; flat or nested routes? I get asked this question quite a bit, and before I get into it, let me demonstrate what each route type means. Let&#8217;s say that I have a <strong>comment</strong> with an ID of 4. Whether I use nested or flat routes, my GET request to this endpoint would look like this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d4875753275908" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d4875753275908-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d4875753275908-1"><span class="crayon-v">GET</span><span class="crayon-h"> </span><span class="crayon-o">/</span><span class="crayon-v">comments</span><span class="crayon-o">/</span><span class="crayon-cn">4</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0004 seconds] -->
<p>And that&#8217;s it &#8211; very easy. Now let&#8217;s take that up a notch. What if I want to find all <strong>comments</strong> that exist for a certain <strong>post</strong>, and that post has an ID of 1. Here is where we deviate between these two routing types. A nested route to this endpoint might look something like this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d48ce576562227" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">Nested Route</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d48ce576562227-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d48ce576562227-1"><span class="crayon-v">GET</span><span class="crayon-h"> </span><span class="crayon-o">/</span><span class="crayon-v">posts</span><span class="crayon-o">/</span><span class="crayon-cn">1</span><span class="crayon-o">/</span><span class="crayon-v">comments</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0004 seconds] -->
<p>While a flat route would look like this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d48e3378892707" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">Flat Route</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d48e3378892707-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d48e3378892707-1"><span class="crayon-v">GET</span><span class="crayon-h"> </span><span class="crayon-o">/</span><span class="crayon-v">comments</span><span class="crayon-sy">?</span><span class="crayon-v">post_id</span><span class="crayon-o">=</span><span class="crayon-cn">1</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0004 seconds] -->
<p>See the difference? Nested routes make use of nesting resource names and/or IDs, while flat routes limit the route endpoint to just one resource name and pass in the rest of the necessary information as URL parameters. So which one is better?</p>
<p>Well, nested routing looks prettier, I think we all agree there &#8211; but I prefer to use flat routing as I&#8217;m building out my API endpoints. Why, you might ask? Well, for two reasons:</p>
<p><strong>It keeps things simpler</strong>. With flat routes, I only have one way to access exactly the data that I need. This becomes important when we start dealing with <a href="https://en.wikipedia.org/wiki/Associative_entity" target="_blank">associative entities</a>. For example, a comment can belong to either a post or a user. With nested resources, that means I have multiple endpoints that I can access comments with: /comments, /users/1/comments, or /posts/1/comments. With flat routing &#8211; I just have one: /comments.</p>
<p><strong>It works better with client-side packages such as <a href="https://github.com/emberjs/data" target="_blank">Ember Data</a>, <a href="https://github.com/mgonto/restangular" target="_blank">RESTangular</a>, <a href="https://docs.angularjs.org/api/ngResource/service/$resource" target="_blank">ngResource</a>, etc.</strong> By default, these libraries like to use flat routes and are much easier to work with if you do keep the routes flat and just pass in the necessary data as URL params.</p>
<p>tl;dr &#8211; I like flat routes much better, and always use them over nested routes when building a JSON API.</p>
<h2>CORS</h2>
<p><a href="https://en.wikipedia.org/wiki/Cross-origin_resource_sharing" target="_blank">CORS</a> is short for Cross-Origin Resource Sharing, which is a mechanism that allows for resources to be accessed by domains that are outside of the host domain. By default, this is turned off, which means that if your API exists on another domain than where you&#8217;re requesting the data, then that request will be denied unless CORS is turned on for that domain. <strong>Note:</strong> This only affects client-side requests. Server-side requests or cURL will still work just fine, regardless of CORS.</p>
<p>Rails has a built-in way to configure CORS, and I used that for a bit, but it honestly got to be a pain to deal with after a while. Instead, I recommend you use the gem <a href="https://github.com/cyu/rack-cors" target="_blank">rack-cors</a> to handle all of your CORS needs. With this gem installed, for example, in order to allow GET, POST, and OPTIONS requests for all domains, this is all you need to add into your config/application.rb:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d48ee040280482" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">config/application.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d48ee040280482-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d48ee040280482-2">2</div><div class="crayon-num" data-line="crayon-58f50142d48ee040280482-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d48ee040280482-4">4</div><div class="crayon-num" data-line="crayon-58f50142d48ee040280482-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d48ee040280482-6">6</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d48ee040280482-1"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">config</span><span class="crayon-sy">.</span><span class="crayon-v">middleware</span><span class="crayon-sy">.</span><span class="crayon-v">insert</span><span class="crayon-sy">_</span>before<span class="crayon-h"> </span><span class="crayon-cn">0</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-s">"Rack::Cors"</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d48ee040280482-2"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">allow</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line" id="crayon-58f50142d48ee040280482-3"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">origins</span><span class="crayon-h"> </span><span class="crayon-s">'*'</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d48ee040280482-4"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">resource</span><span class="crayon-h"> </span><span class="crayon-s">'*'</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">headers</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">any</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">methods</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">get</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">post</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">options</span><span class="crayon-sy">]</span></div><div class="crayon-line" id="crayon-58f50142d48ee040280482-5"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d48ee040280482-6"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0020 seconds] -->
<p>See how easy that is! And with rack-cors&#8217; nice DSL, you can see it&#8217;s really easy to configure CORS just like you want to.</p>
<h2>No Views</h2>
<p>If you followed along with this series and built a JSON API alongside while reading, then you may have noticed that there are no views or layouts. This is completely intentional, and the reason we don&#8217;t have those are because we don&#8217;t need them! All we&#8217;re doing in a JSON API is returning JSON &#8211; no HTML/CSS/JS necessary. This simplifies things immensely compared to a full rails web app. You can sort of substitute serializers for views however, since they modify our response, but they&#8217;re still significantly easier to deal with than full view templates.</p>
<h2>No #edit or #new Controller Actions</h2>
<p>If you&#8217;ve built a rails app before, you may be familiar with the 7 default controller actions that a resource has: Index, Show, New, Create, Edit, Update, and Delete. But in our API, we&#8217;re missing two of those &#8211; Edit and New. Why?</p>
<p>Edit and New, contrary to their names, actually both correspond to GET requests and are specifically triggered when you access a page (typically that has a form) which will eventually submit a POST or PUT request. You need this preliminary GET request to happen in order to provide any necessary data prior to submitting your POST or PUT request.</p>
<p>With a JSON API, you don&#8217;t have any web pages that you&#8217;re interacting with, so you don&#8217;t need to load anything prior to submitting your POST or PUT request &#8211; you just submit it. Because of that simplicity, you don&#8217;t need the Edit or New actions anymore, so we just remove them all together. See, using rails just as an API is simpler than using it as a full web application platform!</p>
<h2>Filtering Resources</h2>
<p>Earlier, I recommended using flat routes over nested routes, and part of that is because of how easy it allows you to filter resources based on your URL params. In order to filter our resources by any data attribute at all, all we need to do is change one line in our index actions &#8211; let&#8217;s do an example with our comments controller.</p>
<p>This is the original code for the <strong>index</strong> action:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d48fb248595043" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/comments_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d48fb248595043-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d48fb248595043-2">2</div><div class="crayon-num" data-line="crayon-58f50142d48fb248595043-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d48fb248595043-4">4</div><div class="crayon-num" data-line="crayon-58f50142d48fb248595043-5">5</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d48fb248595043-1"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-i">index</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d48fb248595043-2"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">@comments</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">Comment</span><span class="crayon-sy">.</span><span class="crayon-i">all</span></div><div class="crayon-line" id="crayon-58f50142d48fb248595043-3">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d48fb248595043-4"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">render</span><span class="crayon-h"> </span><span class="crayon-v">json</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">@comments</span></div><div class="crayon-line" id="crayon-58f50142d48fb248595043-5"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0009 seconds] -->
<p>And we&#8217;re just going to change the first line of the action to this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d4901541463621" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/comments_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d4901541463621-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4901541463621-2">2</div><div class="crayon-num" data-line="crayon-58f50142d4901541463621-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4901541463621-4">4</div><div class="crayon-num" data-line="crayon-58f50142d4901541463621-5">5</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d4901541463621-1"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-i">index</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4901541463621-2"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">@comments</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">Comment</span><span class="crayon-sy">.</span><span class="crayon-e">where</span><span class="crayon-sy">(</span><span class="crayon-v">comment_params</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f50142d4901541463621-3">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4901541463621-4"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">render</span><span class="crayon-h"> </span><span class="crayon-v">json</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">@comments</span></div><div class="crayon-line" id="crayon-58f50142d4901541463621-5"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0011 seconds] -->
<p>And that&#8217;s it! Now, we can filter comments not only by post_id or user_id, but by any attribute that our strong parameters method whitelists &#8211; such as body. For example, any of these will work as expected:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d4907457824620" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d4907457824620-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4907457824620-2">2</div><div class="crayon-num" data-line="crayon-58f50142d4907457824620-3">3</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d4907457824620-1"><span class="crayon-v">GET</span><span class="crayon-h"> </span><span class="crayon-o">/</span><span class="crayon-v">comments</span><span class="crayon-sy">?</span><span class="crayon-v">user_id</span><span class="crayon-o">=</span><span class="crayon-cn">1</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4907457824620-2"><span class="crayon-v">GET</span><span class="crayon-h"> </span><span class="crayon-o">/</span><span class="crayon-v">comments</span><span class="crayon-sy">?</span><span class="crayon-v">post_id</span><span class="crayon-o">=</span><span class="crayon-cn">1</span></div><div class="crayon-line" id="crayon-58f50142d4907457824620-3"><span class="crayon-v">GET</span><span class="crayon-h"> </span><span class="crayon-o">/</span><span class="crayon-v">comments</span><span class="crayon-sy">?</span><span class="crayon-v">body</span><span class="crayon-o">=</span><span class="crayon-r">This</span><span class="crayon-h"> </span><span class="crayon-st">is</span><span class="crayon-h"> </span><span class="crayon-i">a</span><span class="crayon-h"> </span><span class="crayon-v">body</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0011 seconds] -->
<p></p>
<h2>Testing</h2>
<p>Last but not least, I wanted to cover testing a JSON API. This could easily be a blog post on its own &#8211; or a series of blog posts, really &#8211; so I just want to give the gist of how to begin testing your API. There are multiple libraries that provide testing features for your rails apps &#8211; some of the common ones being:</p>
<ul>
<li>TestUnit</li>
<li>Cucumber</li>
<li>Minitest</li>
<li>RSpec</li>
</ul>
<p>My personal preference for a testing library is <a href="http://rspec.info/" target="_blank">RSpec</a>. When you test an API, a majority of your tests will mostly likely test the controller, but there are more categories of tests that you should write than just controller tests. I&#8217;ll list out the categories that I test for, with an example of each (examples given using RSpec):</p>
<h3>Routing Tests</h3>
<p>Routing tests should be written in order to verify that each of your individual request types end up making it to their intended controller action:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d490d849371898" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">routing_test.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d490d849371898-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d490d849371898-2">2</div><div class="crayon-num" data-line="crayon-58f50142d490d849371898-3">3</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d490d849371898-1"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-i">it</span><span class="crayon-h"> </span><span class="crayon-s">"routes to #index"</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d490d849371898-2"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-e">expect</span><span class="crayon-sy">(</span><span class="crayon-v">get</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"/comments"</span><span class="crayon-sy">)</span><span class="crayon-sy">.</span><span class="crayon-i">to</span><span class="crayon-h"> </span><span class="crayon-e">route_to</span><span class="crayon-sy">(</span><span class="crayon-s">"comments#index"</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f50142d490d849371898-3"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0010 seconds] -->
<p></p>
<h3>Request Tests</h3>
<p>Request tests should be written in order to verify that your basic requests either respond successfully (200 status code) or unsuccessfully (400 status code) &#8211; due to good or bad authentication. These would need to be written with your specific API auth structure in mind, but here&#8217;s a simple example:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d4916135038819" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">request_test.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d4916135038819-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4916135038819-2">2</div><div class="crayon-num" data-line="crayon-58f50142d4916135038819-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4916135038819-4">4</div><div class="crayon-num" data-line="crayon-58f50142d4916135038819-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4916135038819-6">6</div><div class="crayon-num" data-line="crayon-58f50142d4916135038819-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4916135038819-8">8</div><div class="crayon-num" data-line="crayon-58f50142d4916135038819-9">9</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d4916135038819-1"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-i">it</span><span class="crayon-h"> </span><span class="crayon-s">"won't work without authentication"</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4916135038819-2"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">get</span><span class="crayon-h"> </span><span class="crayon-v">comments</span><span class="crayon-sy">_</span>path</div><div class="crayon-line" id="crayon-58f50142d4916135038819-3"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-e">expect</span><span class="crayon-sy">(</span><span class="crayon-v">response</span><span class="crayon-sy">.</span><span class="crayon-v">status</span><span class="crayon-sy">)</span><span class="crayon-sy">.</span><span class="crayon-i">to</span><span class="crayon-h"> </span><span class="crayon-e">be</span><span class="crayon-sy">(</span><span class="crayon-cn">401</span><span class="crayon-sy">)</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4916135038819-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58f50142d4916135038819-5">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4916135038819-6"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-i">it</span><span class="crayon-h"> </span><span class="crayon-s">"will work with authentication"</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line" id="crayon-58f50142d4916135038819-7"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">get</span><span class="crayon-h"> </span><span class="crayon-v">comments_path</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-k ">{</span><span class="crayon-k ">}</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">valid</span><span class="crayon-sy">_</span>session</div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4916135038819-8"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-e">expect</span><span class="crayon-sy">(</span><span class="crayon-v">response</span><span class="crayon-sy">.</span><span class="crayon-v">status</span><span class="crayon-sy">)</span><span class="crayon-sy">.</span><span class="crayon-i">to</span><span class="crayon-h"> </span><span class="crayon-e">be</span><span class="crayon-sy">(</span><span class="crayon-cn">200</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f50142d4916135038819-9"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0025 seconds] -->
<p></p>
<h3>Model Tests</h3>
<p>These are tests you may be familiar with, and are written in order to test out model methods, validations, scopes, and more things that are defined in the models. For our example, let&#8217;s assume that in order to successfully create a comment, it requires both a post_id and a user_id. To test for that, we could write a test like this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d491c427471680" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">model_test.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d491c427471680-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d491c427471680-2">2</div><div class="crayon-num" data-line="crayon-58f50142d491c427471680-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d491c427471680-4">4</div><div class="crayon-num" data-line="crayon-58f50142d491c427471680-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d491c427471680-6">6</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d491c427471680-1"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-i">it</span><span class="crayon-h"> </span><span class="crayon-s">"should have errors if created with no user or post id"</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d491c427471680-2"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">comment</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">Comment</span><span class="crayon-sy">.</span><span class="crayon-i">create</span></div><div class="crayon-line" id="crayon-58f50142d491c427471680-3"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-e">expect</span><span class="crayon-sy">(</span><span class="crayon-v">comment</span><span class="crayon-sy">.</span><span class="crayon-v">save</span><span class="crayon-sy">)</span><span class="crayon-sy">.</span><span class="crayon-i">to</span><span class="crayon-h"> </span><span class="crayon-e">eq</span><span class="crayon-sy">(</span><span class="crayon-r">false</span><span class="crayon-sy">)</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d491c427471680-4"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-e">expect</span><span class="crayon-sy">(</span><span class="crayon-v">comment</span><span class="crayon-sy">.</span><span class="crayon-v">errors</span><span class="crayon-sy">.</span><span class="crayon-v">messages</span><span class="crayon-sy">)</span><span class="crayon-sy">.</span><span class="crayon-i">to</span><span class="crayon-h"> </span><span class="crayon-e">have_key</span><span class="crayon-sy">(</span><span class="crayon-o">:</span><span class="crayon-v">user</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f50142d491c427471680-5"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-e">expect</span><span class="crayon-sy">(</span><span class="crayon-v">comment</span><span class="crayon-sy">.</span><span class="crayon-v">errors</span><span class="crayon-sy">.</span><span class="crayon-v">messages</span><span class="crayon-sy">)</span><span class="crayon-sy">.</span><span class="crayon-i">to</span><span class="crayon-h"> </span><span class="crayon-e">have_key</span><span class="crayon-sy">(</span><span class="crayon-o">:</span><span class="crayon-v">post</span><span class="crayon-sy">)</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d491c427471680-6"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0023 seconds] -->
<p></p>
<h3>Controller Tests</h3>
<p>Controller tests are going to be where all of your business logic should be tested &#8211; and thus these are usually the most complex. At the very least, you should test for both <strong>successes</strong> and <strong>failures</strong> for all of your controller actions &#8211; and thus test out all necessary request types such as GET, POST, PUT/PATCH, and DELETE. If you have any additional logic &#8211; which you probably will &#8211; then you&#8217;ll want to build tests for those too. 100% code coverage is the goal &#8211; so if you add in new logic, make sure you build some tests for it! Because there are a ton of different controller tests you can build, I&#8217;m just gonna show you two simple tests &#8211; one for a GET request to the #show action, and one for a POST request to the #create action:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50142d4922014713327" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" touchscreen no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">controller_tests.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50142d4922014713327-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4922014713327-2">2</div><div class="crayon-num" data-line="crayon-58f50142d4922014713327-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4922014713327-4">4</div><div class="crayon-num" data-line="crayon-58f50142d4922014713327-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4922014713327-6">6</div><div class="crayon-num" data-line="crayon-58f50142d4922014713327-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4922014713327-8">8</div><div class="crayon-num" data-line="crayon-58f50142d4922014713327-9">9</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4922014713327-10">10</div><div class="crayon-num" data-line="crayon-58f50142d4922014713327-11">11</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4922014713327-12">12</div><div class="crayon-num" data-line="crayon-58f50142d4922014713327-13">13</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4922014713327-14">14</div><div class="crayon-num" data-line="crayon-58f50142d4922014713327-15">15</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50142d4922014713327-16">16</div><div class="crayon-num" data-line="crayon-58f50142d4922014713327-17">17</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50142d4922014713327-1"><span class="crayon-v">RSpec</span><span class="crayon-sy">.</span><span class="crayon-i">describe</span><span class="crayon-h"> </span><span class="crayon-v">CommentsController</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">type</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">controller</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4922014713327-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-i">describe</span><span class="crayon-h"> </span><span class="crayon-s">"GET show"</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line" id="crayon-58f50142d4922014713327-3"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">it</span><span class="crayon-h"> </span><span class="crayon-s">"assigns the requested comment as @comment"</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4922014713327-4"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">comment</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">Comment</span><span class="crayon-sy">.</span><span class="crayon-v">create</span><span class="crayon-o">!</span><span class="crayon-h"> </span><span class="crayon-v">valid</span><span class="crayon-sy">_</span>attributes</div><div class="crayon-line" id="crayon-58f50142d4922014713327-5"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">get</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">show</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-k ">{</span><span class="crayon-v">id</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">comment</span><span class="crayon-sy">.</span><span class="crayon-v">to_param</span><span class="crayon-k ">}</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">valid</span><span class="crayon-sy">_</span>session</div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4922014713327-6"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-e">expect</span><span class="crayon-sy">(</span><span class="crayon-e">assigns</span><span class="crayon-sy">(</span><span class="crayon-o">:</span><span class="crayon-v">comment</span><span class="crayon-sy">)</span><span class="crayon-sy">)</span><span class="crayon-sy">.</span><span class="crayon-i">to</span><span class="crayon-h"> </span><span class="crayon-e">eq</span><span class="crayon-sy">(</span><span class="crayon-v">comment</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f50142d4922014713327-7"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4922014713327-8"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58f50142d4922014713327-9">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4922014713327-10"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-i">describe</span><span class="crayon-h"> </span><span class="crayon-s">"POST create"</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line" id="crayon-58f50142d4922014713327-11"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-i">it</span><span class="crayon-h"> </span><span class="crayon-s">"creates a new Comment"</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4922014713327-12"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-e">expect</span><span class="crayon-h"> </span><span class="crayon-k ">{</span></div><div class="crayon-line" id="crayon-58f50142d4922014713327-13"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">post</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">create</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">valid_attributes</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">valid</span><span class="crayon-sy">_</span>session</div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4922014713327-14"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-k ">}</span><span class="crayon-sy">.</span><span class="crayon-i">to</span><span class="crayon-h"> </span><span class="crayon-e">change</span><span class="crayon-sy">(</span><span class="crayon-v">Comment</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">count</span><span class="crayon-sy">)</span><span class="crayon-sy">.</span><span class="crayon-e">by</span><span class="crayon-sy">(</span><span class="crayon-cn">1</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58f50142d4922014713327-15"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50142d4922014713327-16"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58f50142d4922014713327-17"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0051 seconds] -->
<p>Like I said, these are pretty basic examples of how to write API tests, but you should always make sure that you do actually build tests for your project. Personally, I don&#8217;t practice TDD &#8211; I usually write my tests after I have written my actual logic, and then fix anything that came up, but regardless of what testing practices you follow, having your project supported by tests will make it much less brittle when updating and will be significantly easier for you and/or your team to manage in the future.</p>
<p>If your API has mailers, then you&#8217;ll want to write tests for those too. In addition to RSpec, I like to use the gems <a href="https://github.com/thoughtbot/factory_girl" target="_blank">Factory Girl</a> &#8211; to help spawn dummy objects easier &#8211; and <a href="https://github.com/DatabaseCleaner/database_cleaner" target="_blank">Database Cleaner</a> &#8211; to ensure that my testing environment stays clean between tests.</p>
<h2>Conclusion</h2>
<p>We covered a lot of various topics here, and this was kind of my concluding post to address the different things that might be important to know as you&#8217;re starting to build out your own JSON API using rails. This is officially the final post of this series, so I hope you enjoyed it! If you&#8217;re new to this series, then I highly recommend you begin back at <a href="https://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/" target="_blank">the first post</a> which talks about getting started on how to build a JSON API with rails.</p>
<p>Now that you have the skills &#8211; make sure you use them responsibly. Just like Captain Planet says, <em>the power is yours!</em></p>
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
                    <li class="comment even thread-even depth-1" id="dsq-comment-115">
        <div id="dsq-comment-header-115" class="dsq-comment-header">
            <cite id="dsq-cite-115">
                <span id="dsq-author-user-115">Xiao Yang</span>
            </cite>
        </div>
        <div id="dsq-comment-body-115" class="dsq-comment-body">
            <div id="dsq-comment-message-115" class="dsq-comment-message"><p>Hi, great series, I am running into a problem when I want to add user info in the post serialiser, and I add belongs_to :user at the end but returns a no method found error. I then try has_one :user and the server stops responding. Would you have any idea how to add information that a resource belongs to. Like /posts?user_id=1 comes with the user information?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-117">
        <div id="dsq-comment-header-117" class="dsq-comment-header">
            <cite id="dsq-cite-117">
                <span id="dsq-author-user-117">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-117" class="dsq-comment-body">
            <div id="dsq-comment-message-117" class="dsq-comment-message"><p>AMS v 0.8 doesn&#8217;t support belongs_to, but has_one should be fine. I tested it using your use case, and I was able to pull the user information (and it was filtered through the user serializer, so it only showed certain data). If that&#8217;s giving you issues, you could add the :user symbol to your attributes argument list, but that will dump all user fields in your json response since that won&#8217;t filter through the user serializer.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-3" id="dsq-comment-119">
        <div id="dsq-comment-header-119" class="dsq-comment-header">
            <cite id="dsq-cite-119">
                <span id="dsq-author-user-119">Xiao Yang</span>
            </cite>
        </div>
        <div id="dsq-comment-body-119" class="dsq-comment-body">
            <div id="dsq-comment-message-119" class="dsq-comment-message"><p>Hi, I took away has_many :posts in user_serializer and added has_one :user in post_serializer and it worked. I think it might be an infinite loop when user has_many :posts and post has_one :user that cause it.</p>
<p>&#8221;&#8217;</p>
<p>Started GET &#8220;/users&#8221; for ::1 at 2015-12-16 13:23:27 +0800</p>
<p>  ActiveRecord::SchemaMigration Load (2.3ms)  SELECT &#8220;schema_migrations&#8221;.* FROM &#8220;schema_migrations&#8221;</p>
<p>Processing by UsersController#index as */*</p>
<p>  User Load (4.9ms)  SELECT  &#8220;users&#8221;.* FROM &#8220;users&#8221; WHERE &#8220;users&#8221;.&#8221;auth_token&#8221; = ? LIMIT 1  [[&#8220;auth_token&#8221;, &#8220;97bdd2ec724c893704a41739e88ac0ee&#8221;]]</p>
<p>  User Load (0.2ms)  SELECT &#8220;users&#8221;.* FROM &#8220;users&#8221;</p>
<p>  Post Load (5.2ms)  SELECT &#8220;posts&#8221;.* FROM &#8220;posts&#8221; WHERE &#8220;posts&#8221;.&#8221;user_id&#8221; = ?  [[&#8220;user_id&#8221;, 1]]</p>
<p>  Comment Load (2.5ms)  SELECT &#8220;comments&#8221;.* FROM &#8220;comments&#8221; WHERE &#8220;comments&#8221;.&#8221;post_id&#8221; = ?  [[&#8220;post_id&#8221;, 1]]</p>
<p>Completed 500 Internal Server Error in 192ms (ActiveRecord: 14.4ms)</p>
<p>&#8221;&#8217;</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment odd alt thread-odd thread-alt depth-1" id="dsq-comment-123">
        <div id="dsq-comment-header-123" class="dsq-comment-header">
            <cite id="dsq-cite-123">
                <span id="dsq-author-user-123">AP</span>
            </cite>
        </div>
        <div id="dsq-comment-body-123" class="dsq-comment-body">
            <div id="dsq-comment-message-123" class="dsq-comment-message"><p>Thanks for the posts! Explanation was very clear. Quick question:  when I pass an id that does not exist (i.e. ActiveRecord::RecordNotFound), I noticed the error is returned as HTML. Any ideas on how to format the errors as json in application_controller?</p>
</div>
        </div>

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
    <li class="comment even thread-even depth-1" id="dsq-comment-165">
        <div id="dsq-comment-header-165" class="dsq-comment-header">
            <cite id="dsq-cite-165">
                <span id="dsq-author-user-165">andisowego</span>
            </cite>
        </div>
        <div id="dsq-comment-body-165" class="dsq-comment-body">
            <div id="dsq-comment-message-165" class="dsq-comment-message"><p>Excellent tutorial &#8211; one of the most comprehensive I&#8217;ve come across.  How would change if you were going to consume a JSON API using a gem like HTTParty, rest-client, faraday, or any of your other favorite REST API client gems?  Or consume a JSON API that requires authentication, filter out some of the fields (that you don&#8217;t want to make public), and rebroadcast via a JSON API you built.  What additional steps would you add to what you&#8217;ve laid out here to do that?  Have not seen good tutorials on that, and with your clear writing style I think you would do an excellent job with that.  Regardless &#8211; thanks again, very helpful.</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment odd alt thread-odd thread-alt depth-1" id="dsq-comment-175">
        <div id="dsq-comment-header-175" class="dsq-comment-header">
            <cite id="dsq-cite-175">
                <span id="dsq-author-user-175">Enrique Florendo</span>
            </cite>
        </div>
        <div id="dsq-comment-body-175" class="dsq-comment-body">
            <div id="dsq-comment-message-175" class="dsq-comment-message"><p>Great tutorial! Works like a charm. Can you expand on the tutorial and show how you POST to database? Thank you!</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-296">
        <div id="dsq-comment-header-296" class="dsq-comment-header">
            <cite id="dsq-cite-296">
                <span id="dsq-author-user-296">Batman</span>
            </cite>
        </div>
        <div id="dsq-comment-body-296" class="dsq-comment-body">
            <div id="dsq-comment-message-296" class="dsq-comment-message"><p>How do I store/get the data in a front-end form for new/edit? In rails you would make new @var = Var.new and then render &#8216;new&#8217; if there are errors in the #new. I guess maybe edit would be making a get request to the specific item and populating the form with the data.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-297">
        <div id="dsq-comment-header-297" class="dsq-comment-header">
            <cite id="dsq-cite-297">
                <span id="dsq-author-user-297">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-297" class="dsq-comment-body">
            <div id="dsq-comment-message-297" class="dsq-comment-message"><p>You don&#8217;t need to get any data prior to making a POST request, since you&#8217;re creating a new resource. You&#8217;re correct when editing a resource; you would just make a standard GET request to the #show action when your form loads so that you can pre-populate it before making the PUT/PATCH request.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
            </ul>


        </div>

    </div>

<script type="text/javascript">
var disqus_url = 'https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/';
var disqus_identifier = '988 https://thesocietea.org/?p=988';
var disqus_container_id = 'disqus_thread';
var disqus_shortname = 'thesocietea';
var disqus_title = "Building a JSON API with Rails &#8211; Part 5: Afterthoughts";
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
        script.src = '?cf_action=sync_comments&post_id=988';

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

<!-- Dynamic page generated in 0.351 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-04-17 17:54:11 -->
