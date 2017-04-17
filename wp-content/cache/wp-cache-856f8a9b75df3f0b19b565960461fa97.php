<?php die(); ?><!DOCTYPE html>
<html lang="en-US">
<!DOCTYPE html>
  <!--[if IE 8]>         <html lang="en" class="no-js ie8 lte-ie9"> <![endif]-->
  <!--[if lte IE 9]>     <html lang="en" class="no-js lte-ie9"> <![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Building a JSON API with Rails – Part 2: Serialization | Aaron Krauss</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="https://thesocietea.org/xmlrpc.php">

    <meta name="description" content="Welcome to part 2 of our API building adventure. If you haven&#8217;t read Part 1: Getting Started yet, then I highly recommend you go through that post real quick to make sure we&#8217;re all on the same page. We&#8217;ll be continuing to develop on our Blog API which uses three relational tables: User, Post, and Comment....">
    <meta property="og:description" content="Welcome to part 2 of our API building adventure. If you haven&#8217;t read Part 1: Getting Started yet, then I highly recommend you go through that post real quick to make sure we&#8217;re all on the same page. We&#8217;ll be continuing to develop on our Blog API which uses three relational tables: User, Post, and Comment....">
        <meta property="og:image" content="https://thesocietea.org/assets/images/dist/ak-smile-optimized.jpg">
    <meta property="og:title" content="Building a JSON API with Rails – Part 2: Serialization | Aaron Krauss">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/ " />
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
  <body class="post-template-default single single-post postid-443 single-format-standard m-scene">
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


			
<article id="post-443" class="post-443 post type-post status-publish format-standard hentry category-ruby">
            <div class="container-padding">
<div class="container">
  <header class="entry-header">
    <h1 class="entry-title">Building a JSON API with Rails – Part 2: Serialization</h1>
    <div class="entry-meta">
      <span class="posted-on"><span><time class="entry-date published" datetime="2015-03-27T14:00:16+00:00">March 27, 2015</time></span></span>    </div><!-- .entry-meta -->
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
<li>Part 2 &#8211; Serialization</li>
<li><a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/">Part 3 &#8211; Authentication Strategies</a></li>
<li><a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-4-implementing-authentication/">Part 4 &#8211; Implementing Authentication</a></li>
<li><a href="https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/">Part 5 &#8211; Afterthoughts</a></li>
<li><a href="https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/">Part 6 &#8211; The JSON API Spec, Pagination, and Versioning</a></li>
</ul>
<hr />
    </div>
    <p>Welcome to part 2 of our API building adventure. If you haven&#8217;t read <a title="Building a JSON API with Rails – Part 1: Getting Started" href="http://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/" target="_blank">Part 1: Getting Started</a> yet, then I highly recommend you go through that post real quick to make sure we&#8217;re all on the same page. We&#8217;ll be continuing to develop on our Blog API which uses three relational tables: <strong>User</strong>, <strong>Post</strong>, and <strong>Comment</strong>. In the last post, we focused on setting up a basic JSON API using Rails, preparing our database, and reviewing how to issue requests to that API. Today, we&#8217;re going to take the power of our API to another level with <a href="http://en.wikipedia.org/wiki/Serialization" target="_blank">serialization</a>.</p>
<h2>Serialization</h2>
<p>So what exactly does it mean to <em>serialize</em> our API? Currently when we make a GET request to one of our API endpoints (like <strong>/users/1</strong> or <strong>/posts/1</strong>), we get back all of that object&#8217;s attributes from the database record (or multiple objects&#8217; attributes, if querying an <em>index</em> action). This might seem okay at first, but let me give you an example of how this is undesirable. When we query <strong>/users/1</strong>, we will get all of that user&#8217;s data &#8211; including the unencrypted password. That&#8217;s a huge security flaw. Additionally, what if we wanted to query that same endpoint and return each of that user&#8217;s posts in addition to their user attributes? We can&#8217;t do that right now. That&#8217;s where serialization will help us.</p>
<p>We employ serialization in APIs to properly handle the response from our GET requests to the API and format the data exactly how we want. Could we handle this directly in the controllers? Yes, but that gets real messy real quick, and it all goes back to our concept of <a href="http://en.wikipedia.org/wiki/Service-oriented_architecture" target="_blank">SOA</a> &#8211; Service Oriented Architecture. Controllers are meant to handle the business logic of our app, and not focus on formatting a response &#8211; but handling response data is exactly what serializers are for, so let&#8217;s use them and keep our API clean and modular!</p>
<h2>Setting It Up</h2>
<p>There are different ways we can apply serialization in Rails, and all of them involve gems. The three most common serialization gems are:</p>
<ul>
<li><a href="https://github.com/rails-api/active_model_serializers" target="_blank">ActiveModelSerializers</a></li>
<li><a href="https://github.com/nesquena/rabl" target="_blank">Rabl</a></li>
<li><a href="https://github.com/rails/jbuilder" target="_blank">JBuilder</a></li>
</ul>
<p>Each of these gems are very well supported and have hundreds of forks on GitHub, but I prefer to use ActiveModelSerializers (AMS) &#8211; predominantly because right out of the box it plays very nicely with Ember.js via Ember Data&#8217;s <a href="https://github.com/ember-data/active-model-adapter" target="_blank">ActiveModel Adapter</a>. If you&#8217;ve used Ember, then you know it&#8217;s very powerful, but you have to play by its rules &#8211; and using AMS allows you to do that. If you don&#8217;t use Ember, AMS is still a wonderful serializer and is very Rails-esque in syntax.</p>
<p>Let&#8217;s install AMS by adding it to our Gemfile:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f502ad37fc9543084464" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">Gemfile</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f502ad37fc9543084464-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f502ad37fc9543084464-1"><span class="crayon-i">gem</span><span class="crayon-h"> </span><span class="crayon-s">'active_model_serializers'</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-s">'~&gt; 0.8.3'</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0004 seconds] -->
<p>Then run a bundle install. AMS comes built-in with generators, so to create a serializer for our User resource for instance, we just run:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f502ad37fde428730367" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f502ad37fde428730367-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f502ad37fde428730367-1"><span class="crayon-i">rails</span><span class="crayon-h"> </span><span class="crayon-i">g</span><span class="crayon-h"> </span><span class="crayon-e">serializer </span><span class="crayon-v">user</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0004 seconds] -->
<p>And that will create the following file:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f502ad37fe5821727373" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/serializers/user_serializer.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f502ad37fe5821727373-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad37fe5821727373-2">2</div><div class="crayon-num" data-line="crayon-58f502ad37fe5821727373-3">3</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f502ad37fe5821727373-1"><span class="crayon-r">class</span><span class="crayon-h"> </span><span class="crayon-v">UserSerializer</span><span class="crayon-h"> </span><span class="crayon-o">&lt;</span><span class="crayon-h"> </span><span class="crayon-v">ActiveModel</span><span class="crayon-o">::</span><span class="crayon-i">Serializer</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad37fe5821727373-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">attributes</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">id</span></div><div class="crayon-line" id="crayon-58f502ad37fe5821727373-3"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0006 seconds] -->
<p>Now, if you navigate to your <strong>/users</strong> URL, you should see JSON that looks like this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f502ad37feb668927732" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">http://localhost:3000/users</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f502ad37feb668927732-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f502ad37feb668927732-1"><span class="crayon-sy">{</span><span class="crayon-v">users</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">[</span><span class="crayon-sy">{</span><span class="crayon-v">id</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-cn">1</span><span class="crayon-sy">}</span><span class="crayon-sy">,</span><span class="crayon-sy">{</span><span class="crayon-v">id</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-cn">2</span><span class="crayon-sy">}</span><span class="crayon-sy">]</span><span class="crayon-sy">}</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0007 seconds] -->
<p>This is different from what we&#8217;ve seen in two ways.</p>
<ol>
<li>We now have a root <strong>users</strong> key and are returning a JSON object instead of an array of JSON objects.</li>
<li>We are only rendering the id, and no other data on the User objects. That means no more exposed passwords!</li>
</ol>
<p>See how simple that was? This same serialization pattern will also carry over for all of your controller actions that handle GET requests that return JSON. Now go ahead and run the serializers for the remaining Post and Comment resources, and then we&#8217;ll get into some configuration:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f502ad37ff1377546436" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f502ad37ff1377546436-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad37ff1377546436-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f502ad37ff1377546436-1"><span class="crayon-i">rails</span><span class="crayon-h"> </span><span class="crayon-i">g</span><span class="crayon-h"> </span><span class="crayon-e">serializer </span><span class="crayon-e">post</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad37ff1377546436-2"><span class="crayon-i">rails</span><span class="crayon-h"> </span><span class="crayon-i">g</span><span class="crayon-h"> </span><span class="crayon-e">serializer </span><span class="crayon-v">comment</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0005 seconds] -->
<p></p>
<h2>Configuring the Serializers</h2>
<p>We won&#8217;t go into full configuration options here, as you&#8217;re better off checking the AMS <a href="https://github.com/rails-api/active_model_serializers/tree/0-8-stable">documentation</a> for that, but we&#8217;ll go into the core options that will help you the most. If you want to return more model fields than just your ID, then you just need to add them to the <strong>attributes</strong> method call like so:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f502ad37ff7367533895" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/serializers/user_serializer.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f502ad37ff7367533895-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad37ff7367533895-2">2</div><div class="crayon-num" data-line="crayon-58f502ad37ff7367533895-3">3</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f502ad37ff7367533895-1"><span class="crayon-r">class</span><span class="crayon-h"> </span><span class="crayon-v">UserSerializer</span><span class="crayon-h"> </span><span class="crayon-o">&lt;</span><span class="crayon-h"> </span><span class="crayon-v">ActiveModel</span><span class="crayon-o">::</span><span class="crayon-i">Serializer</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad37ff7367533895-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">attributes</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">id</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">email</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">created</span><span class="crayon-sy">_</span>at</div><div class="crayon-line" id="crayon-58f502ad37ff7367533895-3"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0009 seconds] -->
<p>And now when you query your User endpoints, you&#8217;ll receive the <em>email</em> and <em>created_at</em> fields too &#8211; easy as pie! But that&#8217;s not all. Let&#8217;s say you wanted to query a User endpoint and return each of those user&#8217;s posts too. Well that&#8217;s easy, and here&#8217;s where you really see the Rails-y design of AMS:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f502ad38002685271348" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/serializers/user_serializer.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f502ad38002685271348-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad38002685271348-2">2</div><div class="crayon-num" data-line="crayon-58f502ad38002685271348-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad38002685271348-4">4</div><div class="crayon-num" data-line="crayon-58f502ad38002685271348-5">5</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f502ad38002685271348-1"><span class="crayon-r">class</span><span class="crayon-h"> </span><span class="crayon-v">UserSerializer</span><span class="crayon-h"> </span><span class="crayon-o">&lt;</span><span class="crayon-h"> </span><span class="crayon-v">ActiveModel</span><span class="crayon-o">::</span><span class="crayon-i">Serializer</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad38002685271348-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">attributes</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">id</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">email</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">created</span><span class="crayon-sy">_</span>at</div><div class="crayon-line" id="crayon-58f502ad38002685271348-3">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad38002685271348-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">has_many</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">posts</span></div><div class="crayon-line" id="crayon-58f502ad38002685271348-5"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0011 seconds] -->
<p>And wallah! You are now returning each user&#8217;s posts when you query a user &#8211; and the JSON data for each post will also follow the configuration in the serializer created for the Post resource.</p>
<p>I just have one last serializer configuration I wanted to share. Occasionally, you may want to modify the data that you return in JSON, but because this specific alteration is only meant for serialization cases, you don&#8217;t want to dirty up the model files by creating a model method. AMS provides a solution for that. You can create a method inside your serializer and therein access the current object being serialized, and then call that method with the same syntax as if it were an attribute on that object. Doesn&#8217;t make sense? Take a look at this example:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f502ad3800b159467692" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/serializers/user_serializer.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f502ad3800b159467692-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad3800b159467692-2">2</div><div class="crayon-num" data-line="crayon-58f502ad3800b159467692-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad3800b159467692-4">4</div><div class="crayon-num" data-line="crayon-58f502ad3800b159467692-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad3800b159467692-6">6</div><div class="crayon-num" data-line="crayon-58f502ad3800b159467692-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad3800b159467692-8">8</div><div class="crayon-num" data-line="crayon-58f502ad3800b159467692-9">9</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f502ad3800b159467692-1"><span class="crayon-r">class</span><span class="crayon-h"> </span><span class="crayon-v">UserSerializer</span><span class="crayon-h"> </span><span class="crayon-o">&lt;</span><span class="crayon-h"> </span><span class="crayon-v">ActiveModel</span><span class="crayon-o">::</span><span class="crayon-i">Serializer</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad3800b159467692-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">attributes</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">id</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">email</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">created_at</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">say</span><span class="crayon-sy">_</span>hello</div><div class="crayon-line" id="crayon-58f502ad3800b159467692-3">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad3800b159467692-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">has_many</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">posts</span></div><div class="crayon-line" id="crayon-58f502ad3800b159467692-5">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad3800b159467692-6"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-v">say</span><span class="crayon-sy">_</span>hello</div><div class="crayon-line" id="crayon-58f502ad3800b159467692-7"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"Hello #{object.email}!"</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad3800b159467692-8"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58f502ad3800b159467692-9"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0017 seconds] -->
<p>Now our serializer would spit out a <strong>say_hello</strong> JSON key that would have as its value the word &#8220;Hello&#8221; followed by that user&#8217;s email address. You access the current serialized object via the &#8216;object&#8217; variable inside of any method you define inside your serializer. Nifty, huh? <strong>Pro Tip</strong>: You can also add model methods into your <strong>attributes</strong> method call, and don&#8217;t have to redefine them in the serializer.</p>
<p>One last thing (didn&#8217;t I already say that above?): If you don&#8217;t like the JSON syntax of having a root key like <strong>user</strong> or whatever resource you&#8217;re querying, then you can go back to the old syntax we had where it strictly returns either just the JSON representation of the object (e.g. show), or an array of JSON objects (e.g. index). You just have to add a short method in your application_controller.rb to set it globally:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f502ad38012906702572" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-mac print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/application_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f502ad38012906702572-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f502ad38012906702572-2">2</div><div class="crayon-num" data-line="crayon-58f502ad38012906702572-3">3</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f502ad38012906702572-1"><span class="crayon-h"> </span><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-e">default_serializer_options</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f502ad38012906702572-2"><span class="crayon-h">&nbsp;&nbsp; </span><span class="crayon-k ">{</span><span class="crayon-h"> </span><span class="crayon-v">root</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-r">false</span><span class="crayon-h"> </span><span class="crayon-k ">}</span></div><div class="crayon-line" id="crayon-58f502ad38012906702572-3"><span class="crayon-h"> </span><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0007 seconds] -->
<p></p>
<h2>Wrap Up</h2>
<p>That&#8217;s it for serializer configuration that we&#8217;re going to cover in this post, but there&#8217;s a lot of other neat options you can play with using AMS. As I mentioned earlier, I initially chose AMS over other serialization gems because of how nicely it plays with Ember.js, but it&#8217;s built to be completely agnostic of whatever front-end framework you use. For example, I&#8217;m currently working on a large Angular.js app, and AMS is still my chosen serialization gem of choice because it does everything I need it to (and beautifully at that).</p>
<p>We&#8217;ve now covered the actual <a title="Building a JSON API with Rails – Part 1: Getting Started" href="http://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/" target="_blank">building of an API</a> and serializing our JSON response to format it exactly like we want. Technically this is all you need in your server-side API, but I want to review one more very important topic: <strong>Authentication</strong>. After all, there&#8217;s a big chance that you plan to build an API that houses personal data that you don&#8217;t want everybody in the whole world to be able to query. In the next post, we&#8217;ll cover how to authenticate your requests so that only you can access your personal data, and no one else can!</p>
<p><a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/">Continue on in part 3</a> of this series: Authentication Strategies.</p>
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
                    <li class="post pingback">
        <p>Pingback: <a href='http://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/' rel='external nofollow' class='url'>Building a JSON API with Rails &#8211; Part 1: Getting Started | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-34">
        <div id="dsq-comment-header-34" class="dsq-comment-header">
            <cite id="dsq-cite-34">
                <span id="dsq-author-user-34">Esteban</span>
            </cite>
        </div>
        <div id="dsq-comment-body-34" class="dsq-comment-body">
            <div id="dsq-comment-message-34" class="dsq-comment-message"><p>Looking forward to the Authentication post. When are you planning to release it?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-35">
        <div id="dsq-comment-header-35" class="dsq-comment-header">
            <cite id="dsq-cite-35">
                <span id="dsq-author-user-35">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-35" class="dsq-comment-body">
            <div id="dsq-comment-message-35" class="dsq-comment-message"><p>Thank you! Authentication will actually cover 2 posts, which will be released on April 17th and May 8th respectively. I&#8217;m on a 3 week schedule with blog posts, which works out really well for me.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-odd thread-alt depth-1" id="dsq-comment-38">
        <div id="dsq-comment-header-38" class="dsq-comment-header">
            <cite id="dsq-cite-38">
                <span id="dsq-author-user-38">Leigh Halliday</span>
            </cite>
        </div>
        <div id="dsq-comment-body-38" class="dsq-comment-body">
            <div id="dsq-comment-message-38" class="dsq-comment-message"><p>What do you think of the json:api standard? Have you ever tried JSONAPI::Resources?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-41">
        <div id="dsq-comment-header-41" class="dsq-comment-header">
            <cite id="dsq-cite-41">
                <span id="dsq-author-user-41">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-41" class="dsq-comment-body">
            <div id="dsq-comment-message-41" class="dsq-comment-message"><p>I think that standard is a good one when you&#8217;re dealing with a pretty large app, but most importantly one that has a public API for any developer to interact with. I haven&#8217;t ever tried JSONAPI::Resources, but its API looks similar to AMS. I mostly use AMS by default because it&#8217;s well supported and by default plays very well with Ember.js right out of the box.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-39">
        <div id="dsq-comment-header-39" class="dsq-comment-header">
            <cite id="dsq-cite-39">
                <span id="dsq-author-user-39">TheAshwaniK</span>
            </cite>
        </div>
        <div id="dsq-comment-body-39" class="dsq-comment-body">
            <div id="dsq-comment-message-39" class="dsq-comment-message"><p>Thank you for the series of blogs. I am trying to follow your blogs and looking forward for the rest of them to come.<br />
By the way, one step seems to be missing, although it may be obvious for some.<br />
updating Gemfile with<br />
gem &#8216;active_model_serializers&#8217;, &#8216;~&gt; 0.8.0&#8217;</p>
<p>I was getting an error without it.. </p>
<p>Could not find generator serializers:install.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-40">
        <div id="dsq-comment-header-40" class="dsq-comment-header">
            <cite id="dsq-cite-40">
                <span id="dsq-author-user-40">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-40" class="dsq-comment-body">
            <div id="dsq-comment-message-40" class="dsq-comment-message"><p>That&#8217;s a good call &#8211; I should have added it to the Gemfile instead of just installing it manually. That way the app would be aware of the new serializer generators. I&#8217;ll update that</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-odd thread-alt depth-1" id="dsq-comment-54">
        <div id="dsq-comment-header-54" class="dsq-comment-header">
            <cite id="dsq-cite-54">
                <span id="dsq-author-user-54">Ken</span>
            </cite>
        </div>
        <div id="dsq-comment-body-54" class="dsq-comment-body">
            <div id="dsq-comment-message-54" class="dsq-comment-message"><p>Thank you for the tutorial, you&#8217;ve done a great job explaining things. I&#8217;m testing the API in Postman at this point but keep receiving the same error when I try to do a POST to /posts. The error is &#8220;param is missing or the value is empty: post&#8221; and my JSON is: {&#8220;post&#8221;:{&#8220;title&#8221;:&#8221;The title&#8221;,&#8221;body&#8221;:&#8221;The body&#8221;}}. What might I be doing wrong?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-55">
        <div id="dsq-comment-header-55" class="dsq-comment-header">
            <cite id="dsq-cite-55">
                <span id="dsq-author-user-55">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-55" class="dsq-comment-body">
            <div id="dsq-comment-message-55" class="dsq-comment-message"><p>What does your post_params (or however you named your strong params method) look like? It looks like you may not be whitelisting your parameters correctly. In the posts_controller, I&#8217;m assuming you have something like this:</p>
<p>params.permit(:title, :body)</p>
<p>This will whitelist the &#8220;title&#8221; and &#8220;body&#8221; attributes, but only if they are at the top level of your JSON object. Given your JSON structure, you would need to use this instead:</p>
<p>params.require(:post).permit(:title, :body)</p>
<p>That will require you to always pass in a &#8220;post&#8221; key (like you are) and it will whitelist your params by looking inside of the &#8220;post&#8221; object for the &#8220;title&#8221; and &#8220;body&#8221; attributes.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-3" id="dsq-comment-56">
        <div id="dsq-comment-header-56" class="dsq-comment-header">
            <cite id="dsq-cite-56">
                <span id="dsq-author-user-56">Ken</span>
            </cite>
        </div>
        <div id="dsq-comment-body-56" class="dsq-comment-body">
            <div id="dsq-comment-message-56" class="dsq-comment-message"><p>Wow, thanks for such a quick response. My parameters are as you had them basically: &#8220;params.require(:post).permit(:title, :body, :user_id)&#8221;. After you confirmed that I wasn&#8217;t crazy I double checked all my settings in Postman. I was sending a content-type of jsonp instead of basic json. Once i switched that everything is working as it should I think. Thanks again for the helpful response and the informative tutorial.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment odd alt thread-even depth-1" id="dsq-comment-59">
        <div id="dsq-comment-header-59" class="dsq-comment-header">
            <cite id="dsq-cite-59">
                <span id="dsq-author-user-59">Brian Broom</span>
            </cite>
        </div>
        <div id="dsq-comment-body-59" class="dsq-comment-body">
            <div id="dsq-comment-message-59" class="dsq-comment-message"><p>To get the AMS serializer to run, I had to make a change to app/controllers/application_controller.rb, adding</p>
<p><code>include ::ActionController::Serialization</code></p>
<p>Maybe this is an issue since I&#8217;m using the most recent AMS (0.9.0 vs 0.8)?</p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-2" id="dsq-comment-60">
        <div id="dsq-comment-header-60" class="dsq-comment-header">
            <cite id="dsq-cite-60">
                <span id="dsq-author-user-60">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-60" class="dsq-comment-body">
            <div id="dsq-comment-message-60" class="dsq-comment-message"><p>Initally I tried using 0.9, but ran into issues. I found on StackOverflow that the stable version was .8, so I ran with it. I never included that module, which could have been why I never got .9 to run. Once .10 becomes stable (the current master branch of the project), I imagine my future projects will all use that.</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment odd alt depth-2" id="dsq-comment-121">
        <div id="dsq-comment-header-121" class="dsq-comment-header">
            <cite id="dsq-cite-121">
                <span id="dsq-author-user-121">dfjosh</span>
            </cite>
        </div>
        <div id="dsq-comment-body-121" class="dsq-comment-body">
            <div id="dsq-comment-message-121" class="dsq-comment-message"><p>omg thank you so much Brian. It actually does say this in the rails-api docs (<a href="https://github.com/rails-api/rails-api#serialization" rel="nofollow">https://github.com/rails-api/rails-api#serialization</a>)but I missed it. Been working at this for hours.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/' rel='external nofollow' class='url'>Building a JSON API with Rails &#8211; Part 1: Getting Started | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-4-implementing-authentication/' rel='external nofollow' class='url'>Building a JSON API with Rails – Part 4: Implementing Authentication | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/' rel='external nofollow' class='url'>Building a JSON API with Rails &#8211; Part 5: Afterthoughts | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/' rel='external nofollow' class='url'>Building a JSON API with Rails – Part 3: Authentication Strategies | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="comment even thread-odd thread-alt depth-1" id="dsq-comment-159">
        <div id="dsq-comment-header-159" class="dsq-comment-header">
            <cite id="dsq-cite-159">
                <span id="dsq-author-user-159">xk0rb0x</span>
            </cite>
        </div>
        <div id="dsq-comment-body-159" class="dsq-comment-body">
            <div id="dsq-comment-message-159" class="dsq-comment-message"><p>u can use this one to get AMS works gem non official but works fine&#8230;<br />
in your gemfile and then bundle it 🙂<br />
gem &#8220;active_model_serializers&#8221;, github: &#8220;rails-api/active_model_serializers&#8221;, branch: &#8220;master&#8221;</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/' rel='external nofollow' class='url'>Building a JSON API with Rails &#8211; Part 6: The JSON API Spec, Pagination, and Versioning | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
            </ul>


        </div>

    </div>

<script type="text/javascript">
var disqus_url = 'https://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/';
var disqus_identifier = '443 http://thesocietea.org/?p=443';
var disqus_container_id = 'disqus_thread';
var disqus_shortname = 'thesocietea';
var disqus_title = "Building a JSON API with Rails – Part 2: Serialization";
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
        script.src = '?cf_action=sync_comments&post_id=443';

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

<!-- Dynamic page generated in 0.298 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-04-17 18:00:13 -->
