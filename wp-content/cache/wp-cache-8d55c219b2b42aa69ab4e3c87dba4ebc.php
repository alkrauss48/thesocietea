<?php die(); ?><!DOCTYPE html>
<html lang="en-US">
<!DOCTYPE html>
  <!--[if IE 8]>         <html lang="en" class="no-js ie8 lte-ie9"> <![endif]-->
  <!--[if lte IE 9]>     <html lang="en" class="no-js lte-ie9"> <![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Building a JSON API with Rails &#8211; Part 6: The JSON API Spec, Pagination, and Versioning | Aaron Krauss</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="https://thesocietea.org/xmlrpc.php">

    <meta name="description" content="Throughout this series so far, we&#8217;ve built a really solid JSON API that handles serialization and authentication &#8211; two core concepts that any serious API will need. With everything we&#8217;ve learned, you could easily build a stable API that accomplishes everything you need for phase 1 of your project &#8211; but if you&#8217;re building an API that&#8217;s...">
    <meta property="og:description" content="Throughout this series so far, we&#8217;ve built a really solid JSON API that handles serialization and authentication &#8211; two core concepts that any serious API will need. With everything we&#8217;ve learned, you could easily build a stable API that accomplishes everything you need for phase 1 of your project &#8211; but if you&#8217;re building an API that&#8217;s...">
        <meta property="og:image" content="https://thesocietea.org/wp-content/uploads/2017/02/societea-json-api-part-6.jpg">
    <meta property="og:title" content="Building a JSON API with Rails &#8211; Part 6: The JSON API Spec, Pagination, and Versioning | Aaron Krauss">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/ " />
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
  <body class="post-template-default single single-post postid-1580 single-format-standard m-scene">
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


			
<article id="post-1580" class="post-1580 post type-post status-publish format-standard hentry category-ruby">
            <div class="container-padding">
<div class="container">
  <header class="entry-header">
    <h1 class="entry-title">Building a JSON API with Rails &#8211; Part 6: The JSON API Spec, Pagination, and Versioning</h1>
    <div class="entry-meta">
      <span class="posted-on"><span><time class="entry-date published" datetime="2017-02-09T12:00:28+00:00">February 9, 2017</time></span></span>    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
<hr class="short" />

  <div class="entry-content">
    <div class="pre-post-content">
      <p><strong>Table of Contents</strong></p>
<ul>
<li><a href="https://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/">Part 1 &#8211; Getting Started</a></li>
<li><a href="https://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/">Part 2 &#8211; Serialization</a></li>
<li><a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-3-authentication-strategies/">Part 3 &#8211; Authentication Strategies</a></li>
<li><a href="https://thesocietea.org/2015/04/building-a-json-api-with-rails-part-4-implementing-authentication/">Part 4 &#8211; Implementing Authentication</a></li>
<li><a href="https://thesocietea.org/2015/12/building-a-json-api-with-rails-part-5-afterthoughts/">Part 5 &#8211; Afterthoughts</a></li>
<li>Part 6 &#8211; The JSON API Spec, Pagination, and Versioning</li>
</ul>
<hr />
    </div>
    <p>Throughout this series so far, we&#8217;ve built a really solid JSON API that handles serialization and authentication &#8211; two core concepts that any serious API will need. With everything we&#8217;ve learned, you could easily build a stable API that accomplishes everything you need for phase 1 of your project &#8211; but if you&#8217;re building an API that&#8217;s gonna be consumed by a large number of platforms and/or by a complex front-end, then you&#8217;ll probably run into some road blocks before too long. You might have questions like &#8220;what&#8217;s the best strategy to serialize data?,&#8221; or &#8220;how about pagination or versioning &#8211; should I be concerned that I haven&#8217;t implemented any of that yet?&#8221; Those are all good questions that we&#8217;re going to address in this post &#8211; so keep following along!</p>
<h2>The JSON API Spec</h2>
<p><a href="https://github.com/rails-api/active_model_serializers" target="_blank">Active Model Serializers</a> &#8211; my go-to Rails serialization gem of choice &#8211; makes it so simple to control what data your API returns in the body (check out my post on <a href="https://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/" target="_blank">Rails API serialization</a> to learn more about this topic). By default, however, there&#8217;s very little structure as to how your data is returned &#8211; and that&#8217;s on purpose; AMS isn&#8217;t meant to be opinionated &#8211; it just grants you, the developer, the power to manipulate what your Rails API is returning. This sounds pretty awesome, but when you start needing to serialize several resources, you might start wanting to follow a common JSON response format to give your API a little more structure as well as making documentation easier.</p>
<p>You can always create your own API response structure that fits your project&#8217;s needs &#8211; but then you&#8217;d have to go through and document why things are the way they are so that other developers can use the API and/or develop on it. This isn&#8217;t terrible &#8211; but it&#8217;s a pain that can easily be avoided because this need has already been addressed via the <a href="http://jsonapi.org/" target="_blank">JSON API Spec</a>.</p>
<p>The JSON API spec is a best-practice specification for building JSON APIs, and as of right now, it&#8217;s definitely the most commonly-used and most-documented format for how you should return data from your API. It was started in 2013 by <a href="http://yehudakatz.com/" target="_blank">Yehuda Katz</a> (former core Rails team member) as he was continuing to help build <a href="http://emberjs.com/" target="_blank">Ember.js</a>, and it officially hit a stable 1.0 release in May of 2015.</p>
<p>If you take a look at the actual spec, you&#8217;ll notice that it&#8217;s pretty in-depth and might look difficult to implement just right. Luckily, AMS has got our back by making it stupid-simple to abide by the JSON API spec. AMS determines JSON structure based on an <a href="https://github.com/rails-api/active_model_serializers/blob/master/docs/general/adapters.md" target="_blank">adapter</a>, and by default, it uses what&#8217;s called the &#8220;attributes adapter.&#8221; This is the simplest adapter and puts your raw data as high up in the JSON hierarchy as it can, without thinking about any sort of structure other than what you have set in the serializer file. For a simple API, this works; but for a complex API, we should use the JSON API spec.</p>
<p>To get AMS to use the JSON API spec, we literally have to add one line of code, and then we&#8217;ll automatically be blessed with some super sweet auto-formatting. You just need to create an initializer, add the following line, and restart your server:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef100da908292604" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">config/initializers/active_model_serializers.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef100da908292604-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef100da908292604-1"><span class="crayon-v">ActiveModelSerializers</span><span class="crayon-sy">.</span><span class="crayon-v">config</span><span class="crayon-sy">.</span><span class="crayon-v">adapter</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">json_api</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0006 seconds] -->
<p>Let&#8217;s do a quick show-and-tell, in case you want to see it in action before you try it. Assuming we have the following serializer for a <strong>post</strong>:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef100e8209115755" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/serializers/post_serializer.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef100e8209115755-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100e8209115755-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef100e8209115755-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100e8209115755-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef100e8209115755-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100e8209115755-6">6</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef100e8209115755-1"><span class="crayon-r">class</span><span class="crayon-h"> </span><span class="crayon-v">PostSerializer</span><span class="crayon-h"> </span><span class="crayon-o">&lt;</span><span class="crayon-h"> </span><span class="crayon-v">ActiveModel</span><span class="crayon-o">::</span><span class="crayon-i">Serializer</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100e8209115755-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">attributes</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">id</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">title</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">body</span></div><div class="crayon-line" id="crayon-58dc81ef100e8209115755-3">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100e8209115755-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">belongs_to</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">user</span></div><div class="crayon-line" id="crayon-58dc81ef100e8209115755-5"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">has_many</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">comments</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100e8209115755-6"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0012 seconds] -->
<p>Then our response will go from this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef100ee352594309" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">Attributes Adapter</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef100ee352594309-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100ee352594309-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef100ee352594309-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100ee352594309-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef100ee352594309-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100ee352594309-6">6</div><div class="crayon-num" data-line="crayon-58dc81ef100ee352594309-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100ee352594309-8">8</div><div class="crayon-num" data-line="crayon-58dc81ef100ee352594309-9">9</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100ee352594309-10">10</div><div class="crayon-num" data-line="crayon-58dc81ef100ee352594309-11">11</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100ee352594309-12">12</div><div class="crayon-num" data-line="crayon-58dc81ef100ee352594309-13">13</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100ee352594309-14">14</div><div class="crayon-num" data-line="crayon-58dc81ef100ee352594309-15">15</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100ee352594309-16">16</div><div class="crayon-num" data-line="crayon-58dc81ef100ee352594309-17">17</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef100ee352594309-1"><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100ee352594309-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-s">"id"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-cn">1</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef100ee352594309-3"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-s">"title"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"Ruby - for when Python just can't cut it."</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100ee352594309-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-s">"body"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef100ee352594309-5"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-s">"user"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100ee352594309-6"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"id"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-cn">1</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef100ee352594309-7"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"first_name"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"Johnny"</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100ee352594309-8"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"last_name"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"User"</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef100ee352594309-9"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"email"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"user@example.com"</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100ee352594309-10"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-sy">}</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef100ee352594309-11"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-s">"comments"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">[</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100ee352594309-12"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">{</span></div><div class="crayon-line" id="crayon-58dc81ef100ee352594309-13"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"id"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-cn">1</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100ee352594309-14"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"body"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"Ruby is pretty rootin' tootin' neat."</span></div><div class="crayon-line" id="crayon-58dc81ef100ee352594309-15"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100ee352594309-16"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-sy">]</span></div><div class="crayon-line" id="crayon-58dc81ef100ee352594309-17"><span class="crayon-sy">}</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0021 seconds] -->
<p>to this!</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef100f3438351023" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">JSON API Adapter</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-6">6</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-8">8</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-9">9</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-10">10</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-11">11</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-12">12</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-13">13</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-14">14</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-15">15</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-16">16</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-17">17</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-18">18</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-19">19</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-20">20</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-21">21</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-22">22</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-23">23</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-24">24</div><div class="crayon-num" data-line="crayon-58dc81ef100f3438351023-25">25</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100f3438351023-26">26</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef100f3438351023-1"><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-s">"data"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-3"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"id"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"1"</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-4"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"type"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"posts"</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-5"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"attributes"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-6"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"title"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"Ruby - for when Python just can't cut it."</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-7"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"body"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-8"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-9"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"relationships"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-10"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"user"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-11"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"data"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-12"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"id"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"1"</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-13"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"type"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"users"</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-14"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-15"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-16"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"comments"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-17"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"data"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">[</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-18"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">{</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-19"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"id"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"1"</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-20"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"type"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"comments"</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-21"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-22"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">]</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-23"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-24"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line" id="crayon-58dc81ef100f3438351023-25"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100f3438351023-26"><span class="crayon-sy">}</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0037 seconds] -->
<p>The JSON API spec also sets a precedent for how paginated resource queries should be structured in the url &#8211; which we&#8217;re getting to next!</p>
<h2>Pagination</h2>
<p>Pagination prevents a JSON response from returning every single record in a resource&#8217;s response all at once, and instead allows the client to request a filtered response that it can continue querying on as it needs more data. Pagination is one of those things where every project seems to do it differently; there&#8217;s very little standard across the board &#8211; but there is in fact a best practice way to do it in a JSON API. A paginated resource on the server should always at a minimum tell the client the total number of records that exist, the number of records returned in the current request, and the current page number of data returned. Better paginated resources will also create and return the paginated links that the client can use (i.e. first page, last page, previous page, next page), but they tend to do that in the response body &#8211; and that&#8217;s not good. The reason this is frowned upon is because while dumping pagination links in the response body may be easy, it really has nothing to do with the actual JSON payload that the client is requesting. Is it valuable information? Certainly &#8211; but it&#8217;s not raw data. It&#8217;s meta-data &#8211; and <a href="https://tools.ietf.org/html/rfc5988" target="_blank">RFC 5988</a> created a perfect place to put such paginated links: the HTTP <a href="https://www.w3.org/wiki/LinkHeader" target="_blank">Link</a> header.</p>
<p>Here&#8217;s an example of a link header:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef100fb797665015" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">Link Header</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef100fb797665015-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100fb797665015-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef100fb797665015-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef100fb797665015-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef100fb797665015-5">5</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef100fb797665015-1"><span class="crayon-v">Link</span><span class="crayon-o">:</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100fb797665015-2"><span class="crayon-o">&lt;</span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?page=1&gt;; rel="first",</span></div><div class="crayon-line" id="crayon-58dc81ef100fb797665015-3"><span class="crayon-o">&lt;</span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?page=1&gt;; rel="prev",</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef100fb797665015-4"><span class="crayon-o">&lt;</span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?page=4&gt;; rel="last",</span></div><div class="crayon-line" id="crayon-58dc81ef100fb797665015-5"><span class="crayon-o">&lt;</span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?page=3&gt;; rel="next"</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0007 seconds] -->
<p>That might seem like a large HTTP header &#8211; but it&#8217;s blatantly obvious what&#8217;s going on, and we&#8217;re keeping our response body clean in the process. Now, just like with the JSON API spec, you might be asking if you have to manually add these links in when returning any paginated response &#8211; and the answer is no! There are gems out there that do this automatically for you while following best practices! Let&#8217;s get into the code.</p>
<p>To start with, we&#8217;ll need to use one of the two most popular pagination libraries in Rails: <a href="https://github.com/mislav/will_paginate" target="_blank">will_paginate</a> or <a href="https://github.com/kaminari/kaminari" target="_blank">kaminari</a>. It literally doesn&#8217;t matter which we pick, and here&#8217;s why: both libraries take care of pagination &#8211; but they&#8217;re really geared towards paginating the older styles of Rails apps that also return server-side rendered HTML views, instead of JSON. On top of that, neither of them follow the best practice of returning paginated links in the Link header. So, are we out of luck? No! There&#8217;s a wonderful gem that sits on top of either of these gems called <a href="https://github.com/davidcelis/api-pagination" target="_blank">api-pagination</a> that takes care of what we need. Api-pagination doesn&#8217;t try to reinvent the wheel and create another implementation of pagination; instead, it uses either will_paginate or kaminari to do the actual logic behind pagination, and then it just automatically sets the Link header (as well as making the code changes that you as the developer have to make much, much simpler).</p>
<p>We&#8217;ll use will_paginate with api-pagination in this example. For starters, add this to your Gemfile:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef10101331928689" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">Gemfile</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef10101331928689-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10101331928689-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef10101331928689-1"><span class="crayon-i">gem</span><span class="crayon-h"> </span><span class="crayon-s">'will_paginate'</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10101331928689-2"><span class="crayon-i">gem</span><span class="crayon-h"> </span><span class="crayon-s">'api-pagination'</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0004 seconds] -->
<p>Next, install them and restart your server:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef10107242803378" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Shell</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef10107242803378-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10107242803378-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef10107242803378-1"><span class="crayon-e">bundle </span><span class="crayon-e">install</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10107242803378-2"><span class="crayon-i">rails</span><span class="crayon-h"> </span><span class="crayon-v">s</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>Let&#8217;s update our Post controller to add in pagination. Just like with the JSON API spec above, we only have to make a single line change. Update the post_controller&#8217;s <strong>index</strong> action from this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef1010c046869145" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/posts_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef1010c046869145-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1010c046869145-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef1010c046869145-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1010c046869145-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef1010c046869145-5">5</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef1010c046869145-1"><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-i">index</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1010c046869145-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">@posts</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">Post</span><span class="crayon-sy">.</span><span class="crayon-i">all</span></div><div class="crayon-line" id="crayon-58dc81ef1010c046869145-3">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1010c046869145-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-i">render</span><span class="crayon-h"> </span><span class="crayon-v">json</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">@posts</span></div><div class="crayon-line" id="crayon-58dc81ef1010c046869145-5"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0008 seconds] -->
<p>to this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef10111324587449" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/posts_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef10111324587449-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10111324587449-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef10111324587449-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10111324587449-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef10111324587449-5">5</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef10111324587449-1"><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-i">index</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10111324587449-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">@posts</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">Post</span><span class="crayon-sy">.</span><span class="crayon-i">all</span></div><div class="crayon-line" id="crayon-58dc81ef10111324587449-3">&nbsp;</div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10111324587449-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-i">paginate</span><span class="crayon-h"> </span><span class="crayon-v">json</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">@posts</span></div><div class="crayon-line" id="crayon-58dc81ef10111324587449-5"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0008 seconds] -->
<p>Do you see what we did? We just removed the <strong>render</strong> function call and instead added the <strong>paginate</strong> function call that api-pagination gives us. That&#8217;s literally it! Now if you query the following route, then you&#8217;ll receive a paginated response:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef10116726505077" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef10116726505077-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef10116726505077-1"><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?per_page=1&amp;page=2</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p></p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef1011b705519052" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">Paginated Response</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-6">6</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-8">8</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-9">9</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-10">10</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-11">11</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-12">12</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-13">13</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-14">14</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-15">15</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-16">16</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-17">17</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-18">18</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-19">19</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-20">20</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-21">21</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-22">22</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-23">23</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-24">24</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-25">25</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-26">26</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-27">27</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-28">28</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-29">29</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-30">30</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-31">31</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-32">32</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-33">33</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1011b705519052-34">34</div><div class="crayon-num" data-line="crayon-58dc81ef1011b705519052-35">35</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef1011b705519052-1"><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-s">"data"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">[</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-3"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-4"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"id"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"2"</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-5"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"type"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"posts"</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-6"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"attributes"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-7"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"title"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"Who would win between a Ruby Warrior or a Ruby Rogue?"</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-8"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"body"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-9"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-10"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"relationships"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-11"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"user"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-12"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"data"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-13"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"id"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"1"</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-14"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"type"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"users"</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-15"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-16"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-17"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"comments"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-18"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"data"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">[</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-19"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">{</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-20"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"id"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"2"</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-21"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"type"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"comments"</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-22"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-23"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">]</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-24"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-25"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-26"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-27"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-sy">]</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-28"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-s">"links"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-sy">{</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-29"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"self"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"http://localhost:3000/posts?page%5Bnumber%5D=2&amp;page%5Bsize%5D=1&amp;per_page=1"</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-30"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"first"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"http://localhost:3000/posts?page%5Bnumber%5D=1&amp;page%5Bsize%5D=1&amp;per_page=1"</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-31"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"prev"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"http://localhost:3000/posts?page%5Bnumber%5D=1&amp;page%5Bsize%5D=1&amp;per_page=1"</span><span class="crayon-sy">,</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-32"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"next"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"http://localhost:3000/posts?page%5Bnumber%5D=3&amp;page%5Bsize%5D=1&amp;per_page=1"</span><span class="crayon-sy">,</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-33"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-s">"last"</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-s">"http://localhost:3000/posts?page%5Bnumber%5D=4&amp;page%5Bsize%5D=1&amp;per_page=1"</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1011b705519052-34"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-sy">}</span></div><div class="crayon-line" id="crayon-58dc81ef1011b705519052-35"><span class="crayon-sy">}</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0044 seconds] -->
<p></p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef10121993497006" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">Link Header</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef10121993497006-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10121993497006-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef10121993497006-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10121993497006-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef10121993497006-5">5</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef10121993497006-1"><span class="crayon-v">Link</span><span class="crayon-o">:</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10121993497006-2"><span class="crayon-o">&lt;</span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?page=1&gt;; rel="first",</span></div><div class="crayon-line" id="crayon-58dc81ef10121993497006-3"><span class="crayon-o">&lt;</span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?page=1&gt;; rel="prev",</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10121993497006-4"><span class="crayon-o">&lt;</span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?page=4&gt;; rel="last",</span></div><div class="crayon-line" id="crayon-58dc81ef10121993497006-5"><span class="crayon-o">&lt;</span><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?page=3&gt;; rel="next"</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0007 seconds] -->
<p></p>
<h3>Bonus</h3>
<p>You&#8217;ll notice that after all my babbling about putting paginated links in the HTTP header instead of the response body, they still managed to find themselves in the response body! This is a neat feature of AMS if you&#8217;re using the JSON API adapter; it will recognize if you&#8217;re using either will_paginate or kaminari, and will automatically build the right pagination links and set them in the response body. While it&#8217;s not a best practice to do this &#8211; I&#8217;m not too worried about removing them because we&#8217;re still setting the HTTP Link header. We&#8217;re sort of in this transition period where many APIs are still placing paginated links in the response body &#8211; and if the AMS gem wants to place them in there with requiring no effort from the developer, then be my guest. It may help ease the burden of having new clients transition to parsing the Link header.</p>
<p>Now, here&#8217;s a little caveat. The JSON API spec has a preferred way of querying paginated resources, and it uses the <strong>page</strong> query object to do so, like in this example:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef10128284750619" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef10128284750619-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef10128284750619-1"><span class="crayon-v">http</span><span class="crayon-o">:</span><span class="crayon-c">//localhost:3000/posts?page[size]=1&amp;page[number]=2</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>This query is identical to our query above; we just swapped out <strong>per_page</strong> for <strong>page[size]</strong>, and <strong>page</strong> for <strong>page[number]</strong>. By default, the links that AMS creates follow this new pattern, but api-pagination by default doesn&#8217;t know how to parse that. Don&#8217;t worry though, it&#8217;s as easy as just adding a simple initializer to allow api-pagination to handle both methods of querying for paginated resources:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef1012e269336990" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">config/initializers/api_pagination.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1012e269336990-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1012e269336990-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1012e269336990-6">6</div><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1012e269336990-8">8</div><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-9">9</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1012e269336990-10">10</div><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-11">11</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1012e269336990-12">12</div><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-13">13</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1012e269336990-14">14</div><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-15">15</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1012e269336990-16">16</div><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-17">17</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1012e269336990-18">18</div><div class="crayon-num" data-line="crayon-58dc81ef1012e269336990-19">19</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef1012e269336990-1"><span class="crayon-v">ApiPagination</span><span class="crayon-sy">.</span><span class="crayon-i">configure</span><span class="crayon-h"> </span><span class="crayon-st">do</span><span class="crayon-h"> </span><span class="crayon-o">|</span><span class="crayon-v">config</span><span class="crayon-o">|</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1012e269336990-2">&nbsp;</div><div class="crayon-line" id="crayon-58dc81ef1012e269336990-3"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">config</span><span class="crayon-sy">.</span><span class="crayon-v">page</span><span class="crayon-sy">_</span>param<span class="crayon-h"> </span><span class="crayon-st">do</span><span class="crayon-h"> </span><span class="crayon-o">|</span><span class="crayon-v">params</span><span class="crayon-o">|</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1012e269336990-4"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">if</span><span class="crayon-h"> </span><span class="crayon-v">params</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">page</span><span class="crayon-sy">]</span><span class="crayon-sy">.</span><span class="crayon-v">is_a</span><span class="crayon-sy">?</span><span class="crayon-h"> </span><span class="crayon-v">ActionController</span><span class="crayon-o">::</span><span class="crayon-i">Parameters</span></div><div class="crayon-line" id="crayon-58dc81ef1012e269336990-5"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">params</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">page</span><span class="crayon-sy">]</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">number</span><span class="crayon-sy">]</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1012e269336990-6"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">else</span></div><div class="crayon-line" id="crayon-58dc81ef1012e269336990-7"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">params</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">page</span><span class="crayon-sy">]</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1012e269336990-8"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58dc81ef1012e269336990-9"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1012e269336990-10">&nbsp;</div><div class="crayon-line" id="crayon-58dc81ef1012e269336990-11"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-v">config</span><span class="crayon-sy">.</span><span class="crayon-v">per_page</span><span class="crayon-sy">_</span>param<span class="crayon-h"> </span><span class="crayon-st">do</span><span class="crayon-h"> </span><span class="crayon-o">|</span><span class="crayon-v">params</span><span class="crayon-o">|</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1012e269336990-12"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">if</span><span class="crayon-h"> </span><span class="crayon-v">params</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">page</span><span class="crayon-sy">]</span><span class="crayon-sy">.</span><span class="crayon-v">is_a</span><span class="crayon-sy">?</span><span class="crayon-h"> </span><span class="crayon-v">ActionController</span><span class="crayon-o">::</span><span class="crayon-i">Parameters</span></div><div class="crayon-line" id="crayon-58dc81ef1012e269336990-13"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">params</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">page</span><span class="crayon-sy">]</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">size</span><span class="crayon-sy">]</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1012e269336990-14"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">else</span></div><div class="crayon-line" id="crayon-58dc81ef1012e269336990-15"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">params</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">per_page</span><span class="crayon-sy">]</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1012e269336990-16"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58dc81ef1012e269336990-17"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1012e269336990-18">&nbsp;</div><div class="crayon-line" id="crayon-58dc81ef1012e269336990-19"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0037 seconds] -->
<p>And wallah &#8211; add this initializer, restart your server, and now your API can handle paginated query params passed in as either <strong>page/</strong><strong>per_page</strong>, and <strong>page[number]</strong>/<strong>page[size</strong><strong>]</strong>!</p>
<h2>Versioning</h2>
<p>The last best practice topic we&#8217;ll be covering here is how to properly version your API. The concept of versioning an API becomes important when you need to make non-backwards-compatible changes; ideally, an API will be used by various client applications &#8211; and it&#8217;s unfeasible to update them all at the same time, which is why your API neds to be able to support multiple versions simultaneously. Because you don&#8217;t really need a solid versioning system early-on in the development phase, this is often an overlooked topic &#8211; but I really implore you to start thinking about it early because it becomes increasingly more difficult to implement down the road. Spend the mental effort now on a plan to version your API, and save yourself a good deal of technical debt down the road.</p>
<p>Now that I&#8217;ve got my soap box out of the way, let&#8217;s get down to the best practices of implementing a versioning system. If you Google around, you&#8217;ll find that there are two predominant methodologies to how you can go about it:</p>
<ul>
<li>Version in your URLs (e.g. <strong>/v1/posts</strong>)</li>
<li>Version via the HTTP <a href="https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html" target="_blank">Accept</a> header</li>
</ul>
<p>Versioning through your URLs is the easier of the two to understand, and it&#8217;s got a big benefit: it&#8217;s much easier to test. I can send you a link to a <strong>v1</strong> path as well as a <strong>v2</strong> path &#8211; and you can check them both out instantaneously. The drawback however &#8211; which is why this way isn&#8217;t a best practice &#8211; is because the path in your URL should be completely representative of the resource you&#8217;re requesting (think <strong>/posts</strong>, <strong>/users/1</strong>, etc.), and which version of the API you&#8217;re using doesn&#8217;t really fit into that. It&#8217;s important &#8211; sure &#8211; but there&#8217;s a better place to put that information: the HTTP Accept header.</p>
<p>The Accept header specifies which <a href="https://en.wikipedia.org/wiki/Media_type" target="_blank">media types</a> (aka MIME types) are acceptable for the response; this is a perfect use-case for specifying which version of the API you want to hit, because responses from that version are the only ones that you&#8217;ll accept!</p>
<p>For our demo, we&#8217;re going to specify the version in a custom media type that looks like this:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef10136007055133" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef10136007055133-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef10136007055133-1"><span class="crayon-v">application</span><span class="crayon-o">/</span><span class="crayon-v">vnd</span><span class="crayon-sy">.</span><span class="crayon-v">example</span><span class="crayon-sy">.</span><span class="crayon-v">v1</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0003 seconds] -->
<p>Here, you can easily see how we set the version to <strong>v1</strong> (If you&#8217;d like to know how we got this format of media type, check out how MIME <a href="https://en.wikipedia.org/wiki/Media_type#Vendor_tree" target="_blank">vendor trees</a> work). If we want to query <strong>v2</strong>, then we&#8217;ll just swap out the last part of that media type.</p>
<p>Let&#8217;s get to some implementation. We won&#8217;t need any new gems, but there are a couple of things we do need to do first:</p>
<ul>
<li>Move all of the files in our <strong>app/controllers</strong> directory into a <strong>v1</strong> directory. So the full path of our controllers would then be <strong>app/controllers/v1</strong>.</li>
<li>Move all of the code in our controllers into a <strong>V1</strong> module. That looks like this:</li>
</ul>
<p></p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef1013c189651652" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">app/controllers/v1/posts_controller.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef1013c189651652-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1013c189651652-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef1013c189651652-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1013c189651652-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef1013c189651652-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef1013c189651652-6">6</div><div class="crayon-num" data-line="crayon-58dc81ef1013c189651652-7">7</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef1013c189651652-1"><span class="crayon-r">module</span><span class="crayon-h"> </span><span class="crayon-i">V1</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1013c189651652-2"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-r">class</span><span class="crayon-h"> </span><span class="crayon-v">PostsController</span><span class="crayon-h"> </span><span class="crayon-o">&lt;</span><span class="crayon-h"> </span><span class="crayon-i">ApplicationController</span></div><div class="crayon-line" id="crayon-58dc81ef1013c189651652-3"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-sy">.</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1013c189651652-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-sy">.</span></div><div class="crayon-line" id="crayon-58dc81ef1013c189651652-5"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-sy">.</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef1013c189651652-6"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58dc81ef1013c189651652-7"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0008 seconds] -->
<p></p>
<ul>
<li>Wrap all of our routes in a <strong>scope</strong> function call, and utilize an instantiated object from a new <strong>ApiConstraints</strong> class that we&#8217;ll add in (this will filter our routes based on the Accept header).</li>
</ul>
<p></p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef10142367244843" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">config/routes.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef10142367244843-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10142367244843-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef10142367244843-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10142367244843-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef10142367244843-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10142367244843-6">6</div><div class="crayon-num" data-line="crayon-58dc81ef10142367244843-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10142367244843-8">8</div><div class="crayon-num" data-line="crayon-58dc81ef10142367244843-9">9</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef10142367244843-1"><span class="crayon-i">require</span><span class="crayon-h"> </span><span class="crayon-s">'api_constraints'</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10142367244843-2">&nbsp;</div><div class="crayon-line" id="crayon-58dc81ef10142367244843-3"><span class="crayon-v">Rails</span><span class="crayon-sy">.</span><span class="crayon-v">application</span><span class="crayon-sy">.</span><span class="crayon-v">routes</span><span class="crayon-sy">.</span><span class="crayon-i">draw</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10142367244843-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-i">scope</span><span class="crayon-h"> </span><span class="crayon-r">module</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-v">v1</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">constraints</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-v">ApiConstraints</span><span class="crayon-sy">.</span><span class="crayon-e">new</span><span class="crayon-sy">(</span><span class="crayon-v">version</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-cn">1</span><span class="crayon-sy">,</span><span class="crayon-h"> </span><span class="crayon-v">default</span><span class="crayon-o">:</span><span class="crayon-h"> </span><span class="crayon-r">true</span><span class="crayon-sy">)</span><span class="crayon-h"> </span><span class="crayon-st">do</span></div><div class="crayon-line" id="crayon-58dc81ef10142367244843-5"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">resources</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">comments</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10142367244843-6"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">resources</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">posts</span></div><div class="crayon-line" id="crayon-58dc81ef10142367244843-7"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">resources</span><span class="crayon-h"> </span><span class="crayon-o">:</span><span class="crayon-i">users</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10142367244843-8"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line" id="crayon-58dc81ef10142367244843-9"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0021 seconds] -->
<p>We still need to add in the code for our ApiConstraints class, but you can kind of see what&#8217;s going on here. We&#8217;re specifying that this set of routes will specifically handle any <strong>v1</strong> calls &#8211; as well as being the default routes, in case a version isn&#8217;t specified.</p>
<p>The <strong>constraints</strong> option in the scope function is powerful and it works in a very specific way: it accepts any sort of object that can respond to a method called <strong>matches?</strong>, which it uses to determine if the constraint passes and allows access to those routes. Now for the last step; let&#8217;s add the logic for ApiConstraints. To do this, we&#8217;re going to add a file in the <strong>/lib</strong> directory called api_constraints.rb:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58dc81ef10147087960059" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title">lib/api_constraints.rb</span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58dc81ef10147087960059-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10147087960059-2">2</div><div class="crayon-num" data-line="crayon-58dc81ef10147087960059-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10147087960059-4">4</div><div class="crayon-num" data-line="crayon-58dc81ef10147087960059-5">5</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10147087960059-6">6</div><div class="crayon-num" data-line="crayon-58dc81ef10147087960059-7">7</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10147087960059-8">8</div><div class="crayon-num" data-line="crayon-58dc81ef10147087960059-9">9</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10147087960059-10">10</div><div class="crayon-num" data-line="crayon-58dc81ef10147087960059-11">11</div><div class="crayon-num crayon-striped-num" data-line="crayon-58dc81ef10147087960059-12">12</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58dc81ef10147087960059-1"><span class="crayon-c"># By Ryan Bates - http://railscasts.com/episodes/350-rest-api-versioning</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10147087960059-2">&nbsp;</div><div class="crayon-line" id="crayon-58dc81ef10147087960059-3"><span class="crayon-r">class</span><span class="crayon-h"> </span><span class="crayon-i">ApiConstraints</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10147087960059-4"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-e">initialize</span><span class="crayon-sy">(</span><span class="crayon-v">options</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58dc81ef10147087960059-5"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">@version</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">options</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">version</span><span class="crayon-sy">]</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10147087960059-6"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">@default</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">options</span><span class="crayon-sy">[</span><span class="crayon-o">:</span><span class="crayon-v">default</span><span class="crayon-sy">]</span></div><div class="crayon-line" id="crayon-58dc81ef10147087960059-7"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10147087960059-8">&nbsp;</div><div class="crayon-line" id="crayon-58dc81ef10147087960059-9"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-r">def</span><span class="crayon-h"> </span><span class="crayon-v">matches</span><span class="crayon-sy">?</span><span class="crayon-sy">(</span><span class="crayon-v">req</span><span class="crayon-sy">)</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10147087960059-10"><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="crayon-v">@default</span><span class="crayon-h"> </span><span class="crayon-o">||</span><span class="crayon-h"> </span><span class="crayon-v">req</span><span class="crayon-sy">.</span><span class="crayon-v">headers</span><span class="crayon-sy">[</span><span class="crayon-s">'Accept'</span><span class="crayon-sy">]</span><span class="crayon-sy">.</span><span class="crayon-v">include</span><span class="crayon-sy">?</span><span class="crayon-sy">(</span><span class="crayon-s">"application/vnd.example.v#{@version}"</span><span class="crayon-sy">)</span></div><div class="crayon-line" id="crayon-58dc81ef10147087960059-11"><span class="crayon-h">&nbsp;&nbsp;</span><span class="crayon-st">end</span></div><div class="crayon-line crayon-striped-line" id="crayon-58dc81ef10147087960059-12"><span class="crayon-st">end</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0021 seconds] -->
<p>You an see here that all this class does is handle the <strong>matches?</strong> method. In a nutshell, it parses the Accept header to see if the version matches the one you passed in &#8211; or it will just return true if the default option was set.</p>
<p>If you liked this neat little constraint &#8211; then I&#8217;m glad, but I take zero credit for this logic. Ryan Bates did a really great <a href="http://railscasts.com/episodes/350-rest-api-versioning" target="_blank">RailsCast</a> over versioning an API a few years ago, and this is by-the-books his recommendation about how to parse the Accept header.</p>
<p>You&#8217;re now all set up with the best practice of specifying an API version via the Accept header! When you need to add a new version, you&#8217;ll create new controllers inside of a version directory, as well as add new routes that are wrapped in a versioned constraint. You don&#8217;t need to version models.</p>
<h2>Final Thoughts</h2>
<p>We covered a lot, but I hope it wasn&#8217;t too exhausting. If there&#8217;s one common goal towards building a best-practice JSON API, it&#8217;s to use HTTP as it&#8217;s meant to be used. It&#8217;s easy to dump everything in your response body in an unorganized manner &#8211; but we can do better than that. Just do your best to follow RESTful practices, and if you have any questions about what you&#8217;re doing, then don&#8217;t be afraid to look it up; the Internet will quickly guide you down the right path.</p>
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
                    <li class="comment even thread-even depth-1" id="dsq-comment-287">
        <div id="dsq-comment-header-287" class="dsq-comment-header">
            <cite id="dsq-cite-287">
                <span id="dsq-author-user-287">Ogbonna Amanze</span>
            </cite>
        </div>
        <div id="dsq-comment-body-287" class="dsq-comment-body">
            <div id="dsq-comment-message-287" class="dsq-comment-message"><p>Lovely article. You saved my life 😀</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-2" id="dsq-comment-289">
        <div id="dsq-comment-header-289" class="dsq-comment-header">
            <cite id="dsq-cite-289">
                <span id="dsq-author-user-289">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-289" class="dsq-comment-body">
            <div id="dsq-comment-message-289" class="dsq-comment-message"><p>=D</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="comment even thread-odd thread-alt depth-1" id="dsq-comment-291">
        <div id="dsq-comment-header-291" class="dsq-comment-header">
            <cite id="dsq-cite-291">
                <span id="dsq-author-user-291">kishore</span>
            </cite>
        </div>
        <div id="dsq-comment-body-291" class="dsq-comment-body">
            <div id="dsq-comment-message-291" class="dsq-comment-message"><p>awesome master, thank you</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment odd alt thread-even depth-1" id="dsq-comment-298">
        <div id="dsq-comment-header-298" class="dsq-comment-header">
            <cite id="dsq-cite-298">
                <span id="dsq-author-user-298">Batman</span>
            </cite>
        </div>
        <div id="dsq-comment-body-298" class="dsq-comment-body">
            <div id="dsq-comment-message-298" class="dsq-comment-message"><p>How does form_for partial know to send a put vs. post request when editing a resource when talking to an api? In a normal rails app it checks if it is persisted. I&#8217;m currently connecting a rails front end using ActiveModel to a redmine(terrible CMS) rails backend for API and admin.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-2" id="dsq-comment-299">
        <div id="dsq-comment-header-299" class="dsq-comment-header">
            <cite id="dsq-cite-299">
                <span id="dsq-author-user-299">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-299" class="dsq-comment-body">
            <div id="dsq-comment-message-299" class="dsq-comment-message"><p>I must be misunderstanding something. To do what you&#8217;re talking about, you would need a Rails app that renders out the HTML from the server (that&#8217;s the only way you can use form_for) &#8211; but it for some reason is talking to an API to manage data as well? To answer directly, I don&#8217;t in depth know how form_for would work in that scenario &#8211; but you can&#8217;t even use form_for if your server is strictly a JSON API, since Rails wouldn&#8217;t generate any HTML for you.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment odd alt depth-3" id="dsq-comment-300">
        <div id="dsq-comment-header-300" class="dsq-comment-header">
            <cite id="dsq-cite-300">
                <span id="dsq-author-user-300">Batman</span>
            </cite>
        </div>
        <div id="dsq-comment-body-300" class="dsq-comment-body">
            <div id="dsq-comment-message-300" class="dsq-comment-message"><p>I have a Rails CMS called redmine. It stands as a project management system for admins and includes an API for certain resources. I also have a Rails app for all the non-admin users. The second app makes requests to the API. The non admins can do CRUD on the second app for things they have permission for.  I make a get request to populate a form to edit a resource. When submitted it keeps making a post request and creating a new object rather than updating it. Maybe I can&#8217;t reuse the form and should call a new partial with explicit method: :put on it. I&#8217;m a junior dev on this task so I&#8217;m learning while I do. Thanks for the help and great posts.</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment even depth-3" id="dsq-comment-301">
        <div id="dsq-comment-header-301" class="dsq-comment-header">
            <cite id="dsq-cite-301">
                <span id="dsq-author-user-301">Batman</span>
            </cite>
        </div>
        <div id="dsq-comment-body-301" class="dsq-comment-body">
            <div id="dsq-comment-message-301" class="dsq-comment-message"><p>I have figured it out for the most part. On the front end I render the partial in the new view with <code>method: :post</code> option and in the edit view I render the partial with <code>method: :patch</code>, then in the form_for I do <code>:model, :option1, method: method</code>. Now I&#8217;m getting ** No route matches [PATCH] &#8220;/qc_logs/1/edit&#8221; ** So I can just make my patch &#8216;qc_log/:id&#8217; route to patch &#8216;qc_log/:id/edit&#8217;</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='http://zerozone.com/mmp/aceinfoway/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning-/' rel='external nofollow' class='url'>Building a JSON API with Rails – Part 6: The JSON API Spec, Pagination, and Versioning | Ace Infoway</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="comment odd alt thread-odd thread-alt depth-1" id="dsq-comment-311">
        <div id="dsq-comment-header-311" class="dsq-comment-header">
            <cite id="dsq-cite-311">
                <span id="dsq-author-user-311">junk kerebereros</span>
            </cite>
        </div>
        <div id="dsq-comment-body-311" class="dsq-comment-body">
            <div id="dsq-comment-message-311" class="dsq-comment-message"><p>please sir how do we do joins between two models and show them in json ? Thank you for the best tutorial</p>
</div>
        </div>

    </li><!-- #comment-## -->
            </ul>


        </div>

    </div>

<script type="text/javascript">
var disqus_url = 'https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/';
var disqus_identifier = '1580 https://thesocietea.org/?p=1580';
var disqus_container_id = 'disqus_thread';
var disqus_shortname = 'thesocietea';
var disqus_title = "Building a JSON API with Rails &#8211; Part 6: The JSON API Spec, Pagination, and Versioning";
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
        script.src = '?cf_action=sync_comments&post_id=1580';

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

<!-- Dynamic page generated in 0.411 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-03-30 03:56:31 -->
