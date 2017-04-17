<?php die(); ?><!DOCTYPE html>
<html lang="en-US">
<!DOCTYPE html>
  <!--[if IE 8]>         <html lang="en" class="no-js ie8 lte-ie9"> <![endif]-->
  <!--[if lte IE 9]>     <html lang="en" class="no-js lte-ie9"> <![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Programming Concepts: Static vs. Dynamic Type Checking | Aaron Krauss</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="https://thesocietea.org/xmlrpc.php">

    <meta name="description" content="When learning about programming languages, you&#8217;ve probably heard phrases like statically-typed or dynamically-typed when referring to a specific language. These terms describe the action of type checking, and both static type checking and dynamic type checking refer to two different type systems. A type system is a collection of rules that assign a property called type to various constructs in a computer...">
    <meta property="og:description" content="When learning about programming languages, you&#8217;ve probably heard phrases like statically-typed or dynamically-typed when referring to a specific language. These terms describe the action of type checking, and both static type checking and dynamic type checking refer to two different type systems. A type system is a collection of rules that assign a property called type to various constructs in a computer...">
        <meta property="og:image" content="https://thesocietea.org/assets/images/dist/ak-smile-optimized.jpg">
    <meta property="og:title" content="Programming Concepts: Static vs. Dynamic Type Checking | Aaron Krauss">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://thesocietea.org/2015/11/programming-concepts-static-vs-dynamic-type-checking/ " />
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
  <body class="post-template-default single single-post postid-732 single-format-standard m-scene">
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


			
<article id="post-732" class="post-732 post type-post status-publish format-standard hentry category-programming-concepts">
            <div class="container-padding">
<div class="container">
  <header class="entry-header">
    <h1 class="entry-title">Programming Concepts: Static vs. Dynamic Type Checking</h1>
    <div class="entry-meta">
      <span class="posted-on"><span><time class="entry-date published" datetime="2015-11-20T12:00:10+00:00">November 20, 2015</time></span></span>    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
<hr class="short" />

  <div class="entry-content">
    <div class="pre-post-content">
      <p><strong>Programming Concepts Series:</strong></p>
<ul>
<li><a href="https://thesocietea.org/2014/10/programming-concepts-the-stack-and-the-heap/">The Stack and the Heap</a></li>
<li><a href="https://thesocietea.org/2015/07/programming-concepts-compiled-and-interpreted-languages/">Compiled and Interpreted Languages</a></li>
<li><a href="https://thesocietea.org/2015/10/programming-concepts-concurrency/">Concurrency</a></li>
<li>Static vs. Dynamic Type Checking</li>
<li><a href="https://thesocietea.org/2016/02/programming-concepts-type-introspection-and-reflection/">Type Introspection and Reflection</a></li>
<li><a href="https://thesocietea.org/2016/12/core-functional-programming-concepts/">Core Functional Programming Concepts</a></li>
<li><a href="https://thesocietea.org/2017/01/programming-concepts-garbage-collection/">Garbage Collection</a></li>
</ul>
<hr />
    </div>
    <p>When learning about programming languages, you&#8217;ve probably heard phrases like <em>statically-typed</em> or <em>dynamically-typed</em> when referring to a specific language. These terms describe the action of <strong>type checking</strong>, and both static type checking and dynamic type checking refer to two different <strong>type systems</strong>. A type system is a collection of rules that assign a property called <span style="text-decoration: underline;">type</span> to various constructs in a computer program, such as variables, expressions, functions or modules, with the end goal of reducing the number of bugs by verifying that data is represented properly throughout a program.</p>
<p>Don&#8217;t worry, I know that all sounds confusing, so before we get further let&#8217;s start at the beginning. What is type checking, and while we&#8217;re at it, what&#8217;s a type?</p>
<h2>A Type</h2>
<p>A <a href="https://en.wikipedia.org/wiki/Data_type" target="_blank">type</a>, also known as a data type, is a classification identifying one of various types of data. I hate to use the word type in its own definition, so in a nutshell a type describes the possible values of a structure (such as a variable), the semantic meaning of that structure, and how the values of that structure can be stored in memory. If this sounds confusing, just think about Integers, Strings, Floats, and Booleans &#8211; those are all types. Types can be broken down into categories:</p>
<ul>
<li><strong>Primitive types</strong> &#8211; these range based on language, but some common primitive types are integers, booleans, floats, and characters.</li>
<li><strong>Composite types</strong> &#8211; these are composed of more than one primitive type, e.g. an array or record (not a hash, however). All composite types are considered <a href="https://en.wikipedia.org/wiki/Data_structure" target="_blank">data structures</a>.</li>
<li><strong>Abstract types</strong> &#8211; types that do not have a specific implementation (and thus can be represented via multiple types), such as a hash, set, queue, and stack.</li>
<li><strong>Other types</strong> &#8211; such as <a href="https://en.wikipedia.org/wiki/Pointer_(computer_programming)">pointers</a> (a type which holds as its value a reference to a different memory location) and functions.</li>
</ul>
<p>Certain languages offer built-in support for different primitive types or data structures than other languages, but the concepts are the same. A type merely defines a set of rules and protocols behind how a piece of data is supposed to behave.</p>
<h2>Type Checking</h2>
<p>The existence of types is useless without a process of verifying that those types make logical sense in the program so that the program can be executed successfully. This is where type checking comes in. <a href="https://en.wikipedia.org/wiki/Type_system#Type_checking" target="_blank">Type checking</a> is the process of verifying and enforcing the constraints of types, and it can occur either at compile time (i.e. statically) or at runtime (i.e. dynamically). Type checking is all about ensuring that the program is <a href="https://en.wikipedia.org/wiki/Type_safety" target="_blank">type-safe</a>, meaning that the possibility of type errors is kept to a minimum. A type error is an erroneous program behavior in which an operation occurs (or trys to occur) on a particular data type that it&#8217;s not meant to occur on. This could be a situation where an operation is performed on an integer with the intent that it is a float, or even something such as adding a string and an integer together:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50360dde9c830661326" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50360dde9c830661326-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50360dde9c830661326-1"><span class="crayon-v">x</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-cn">1</span><span class="crayon-h"> </span><span class="crayon-o">+</span><span class="crayon-h"> </span><span class="crayon-s">"2"</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0008 seconds] -->
<p>While in many languages both strings and integers can make use of the <strong>+</strong> operator, this would often result in a type error because this expression is usually not meant to handle multiple data types.</p>
<p>When a program is considered not type-safe, there is no single standard course of action that happens upon reaching a type error. Many programming languages throw type errors which halt the runtime or compilation of the program, while other languages have built-in safety features to handle a type error and continue running (allowing developers to exhibit poor type safety). Regardless of the aftermath, the process of type checking is a necessity.</p>
<hr class="short" />
<p>Now that we have a basic understanding of what types are and how type checking works, we can start getting into the two primary methods of type checking: <strong>static type checking</strong> and <strong>dynamic type checking</strong>.</p>
<h2>Static Type Checking</h2>
<p>A language is statically-typed if the type of a variable is known at <strong>compile time</strong> instead of at runtime. Common examples of statically-typed languages include Ada, C, C++, C#, JADE, Java, Fortran, Haskell, ML, Pascal, and Scala.</p>
<p>The big benefit of static type checking is that it allows many type errors to be caught early in the development cycle. Static typing usually results in compiled code that executes more quickly because when the compiler knows the exact data types that are in use, it can produce optimized machine code (i.e. faster and/or using less memory). Static type checkers evaluate only the type information that can be determined at compile time, but are able to verify that the checked conditions hold for all possible executions of the program, which eliminates the need to repeat type checks every time the program is executed.</p>
<p>A static type-checker will quickly detect type errors in rarely used code paths. Without static type checking, even code coverage tests with 100% coverage may be unable to find such type errors. However, a detriment to this is that static type-checkers make it nearly impossible to manually raise a type error in your code because even if that code block hardly gets called &#8211; the type-checker would almost always find a situation to raise that type error and thus would prevent you from executing your program (because a type error was raised).</p>
<h2>Dynamic Type Checking</h2>
<p>Dynamic type checking is the process of verifying the type safety of a program at <strong>runtime</strong>. Common dynamically-typed languages include Groovy, JavaScript, Lisp, Lua, Objective-C, PHP, Prolog, Python, Ruby, Smalltalk and Tcl.</p>
<p>Most type-safe languages include some form of dynamic type checking, even if they also have a static type checker. The reason for this is that many useful features or properties are difficult or impossible to verify statically. For example, suppose that a program defines two types, A and B, where B is a subtype of A. If the program tries to convert a value of type A to type B, which is known as <a title="Downcasting" href="https://en.wikipedia.org/wiki/Downcasting" target="_blank">downcasting</a>, then the operation is legal only if the value being converted is actually a value of type B. Therefore, a dynamic check is needed to verify that the operation is safe. Other language features that dynamic-typing enable include <a title="Dynamic dispatch" href="https://en.wikipedia.org/wiki/Dynamic_dispatch" target="_blank">dynamic dispatch</a>, <a title="Late binding" href="https://en.wikipedia.org/wiki/Late_binding" target="_blank">late binding</a>, and <a title="Reflection (computer programming)" href="https://en.wikipedia.org/wiki/Reflection_(computer_programming)" target="_blank">reflection</a>.</p>
<p>In contrast to static type checking, dynamic type checking may cause a program to fail at runtime due to type errors. In some programming languages, it is possible to anticipate and recover from these failures &#8211; either by error handling or poor type safety. In others, type checking errors are considered fatal. Because type errors are more difficult to determine in dynamic type checking, it is a common practice to supplement development in these languages with <a href="https://en.wikipedia.org/wiki/Unit_testing" target="_blank">unit testing</a>.</p>
<p>All in all, dynamic type checking typically results in less optimized code than does static type checking; it also includes the possibility of runtime type errors and forces runtime checks to occur for every execution of the program (instead of just at compile-time). However, it opens up the doors for more powerful language features and makes certain other development practices significantly easier. For example, <a href="https://en.wikipedia.org/wiki/Metaprogramming">metaprogramming</a> &#8211; especially when using <a href="https://en.wikipedia.org/wiki/Eval" target="_blank"><i>eval</i> functions</a> &#8211; is not impossible in statically-typed languages, but it is much, much easier to work with in dynamically-typed languages.</p>
<h2>Common Misconceptions</h2>
<h4>Myth #1: Static/Dynamic Type Checking == Strong/Weak Type Systems</h4>
<p>A common misconception is to assume that all statically-typed languages are also strongly-typed languages, and that dynamically-typed languages are also weakly-typed languages. This isn&#8217;t true, and here&#8217;s why:</p>
<p>A <strong>strongly-typed language</strong> is one in which variables are bound to specific data types, and will result in type errors if types to not match up as expected in the expression &#8211; regardless of when type checking occurs. A simple way to think of strongly-typed languages is to consider them to have high degrees of type safety. To give an example, in the following code block repeated from above, a strongly-typed language would result in an explicit type error which ends the program&#8217;s execution, thus forcing the developer to fix the bug:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50360ddeb6524451123" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50360ddeb6524451123-1">1</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50360ddeb6524451123-1"><span class="crayon-v">x</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-cn">1</span><span class="crayon-h"> </span><span class="crayon-o">+</span><span class="crayon-h"> </span><span class="crayon-s">"2"</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0005 seconds] -->
<p>We often associate statically-typed languages such as Java and C# as strongly-typed (which they are) because data types are explicitly defined when initializing a variable &#8211; such as the following example in Java:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50360ddebd647608148" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Java</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50360ddebd647608148-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50360ddebd647608148-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50360ddebd647608148-1"><span class="crayon-c">// Java</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50360ddebd647608148-2"><span class="crayon-t">String</span><span class="crayon-h"> </span><span class="crayon-v">foo</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-r">new</span><span class="crayon-h"> </span><span class="crayon-t">String</span><span class="crayon-sy">(</span><span class="crayon-s">"hello world"</span><span class="crayon-sy">)</span><span class="crayon-sy">;</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0008 seconds] -->
<p>However, ruby, python, and javascript (all of which are dynamically-typed) are also strongly-typed languages and the developer makes no verbose statement of data type when declaring a variable. Below is the same java example above, but written in ruby.</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50360ddec3436151113" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50360ddec3436151113-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50360ddec3436151113-2">2</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50360ddec3436151113-1"><span class="crayon-c"># Ruby</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50360ddec3436151113-2"><span class="crayon-v">foo</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-s">"hello world"</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0006 seconds] -->
<p>Both of the languages in these examples are strongly-typed, but employ different type checking methods. Languages such as ruby, python, and javascript which do not require manually defining a type when declaring a variable make use of <a href="https://en.wikipedia.org/wiki/Strong_and_weak_typing#Type_inference" target="_blank">type inference</a> &#8211; the ability to programmatically infer the type of a variable based on its value. Some programmers automatically use the term weakly typed to refer to languages that make use of type inference, often without realizing that the type information is present but implicit. Type inference is a separate feature of a language that is unrelated to any of its type systems.</p>
<p>A <strong>weakly-typed language</strong> on the other hand is a language in which variables are not bound to a specific data type; they still have a type, but type safety constraints are lower compared to strongly-typed languages. Take the following PHP code for example:</p><!-- Crayon Syntax Highlighter v_2.7.2_beta -->
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/themes/tomorrow-night/tomorrow-night.css" />
<link rel="stylesheet" type="text/css" href="https://thesocietea.org/wp-content/plugins/crayon-syntax-highlighter/fonts/monaco.css" />

		<div id="crayon-58f50360ddec9153785499" class="crayon-syntax crayon-theme-tomorrow-night crayon-font-monaco crayon-os-pc print-yes notranslate" data-settings=" no-popup minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 14px !important; line-height: 18px !important;">
		
			<div class="crayon-toolbar" data-settings=" show" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><span class="crayon-title"></span>
			<div class="crayon-tools" style="font-size: 14px !important;height: 21px !important; line-height: 21px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><span class="crayon-language">PHP</span></div></div>
			<div class="crayon-info" style="min-height: 19.6px !important; line-height: 19.6px !important;"></div>
			<div class="crayon-plain-wrap"></div>
			<div class="crayon-main" style="">
				<table class="crayon-table">
					<tr class="crayon-row">
				<td class="crayon-nums " data-settings="show">
					<div class="crayon-nums-content" style="font-size: 14px !important; line-height: 18px !important;"><div class="crayon-num" data-line="crayon-58f50360ddec9153785499-1">1</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50360ddec9153785499-2">2</div><div class="crayon-num" data-line="crayon-58f50360ddec9153785499-3">3</div><div class="crayon-num crayon-striped-num" data-line="crayon-58f50360ddec9153785499-4">4</div></div>
				</td>
						<td class="crayon-code"><div class="crayon-pre" style="font-size: 14px !important; line-height: 18px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-58f50360ddec9153785499-1"><span class="crayon-c">// PHP</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50360ddec9153785499-2"><span class="crayon-v">$foo</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-s">"x"</span><span class="crayon-sy">;</span></div><div class="crayon-line" id="crayon-58f50360ddec9153785499-3"><span class="crayon-v">$foo</span><span class="crayon-h"> </span><span class="crayon-o">=</span><span class="crayon-h"> </span><span class="crayon-v">$foo</span><span class="crayon-h"> </span><span class="crayon-o">+</span><span class="crayon-h"> </span><span class="crayon-cn">2</span><span class="crayon-sy">;</span><span class="crayon-h"> </span><span class="crayon-c">// not an error</span></div><div class="crayon-line crayon-striped-line" id="crayon-58f50360ddec9153785499-4"><span class="crayon-k ">echo</span><span class="crayon-h"> </span><span class="crayon-v">$foo</span><span class="crayon-sy">;</span><span class="crayon-h">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span class="crayon-c">// 2</span></div></div></td>
					</tr>
				</table>
			</div>
		</div>
<!-- [Format Time: 0.0014 seconds] -->
<p>Because PHP is weakly-typed, this would not error. Just as the assumption that all strongly-typed languages are statically-typed, not all weakly-typed languages are dynamically-typed; PHP is a dynamically-typed language, but C &#8211; also a weakly-typed language &#8211; is indeed statically-typed.</p>
<p>Myth officially busted.</p>
<p>While they are two separate topics, static/dynamic type systems and strong/weak type systems are related on the issue of type safety. One way you can compare them is that a language&#8217;s static/dynamic type system tells <em>when</em> type safety is enforced, and its strong/weak type system tells <em>how</em> type safety is enforced.</p>
<h4>Myth #2: Static/Dynamic Type Checking == Compiled/Interpreted Languages</h4>
<p>It is true that most statically-typed languages are usually compiled when executed, and most dynamically-typed languages are interpreted when executed &#8211; but you can&#8217;t always assume that, and there&#8217;s a simple reason for this:</p>
<p>When we say that a language is statically- or dynamically-typed, we are referring to that <strong>language as a whole</strong>. For example, no matter what version of Java you use &#8211; it will always be statically-typed. This is different from whether a language is compiled or interpreted, because in that statement we are referring to a <strong>specific language implementation</strong>. Thus in theory, any language can be compiled or interpreted. The most common implementation of Java is to compile to bytecode, and have the JVM interpret that bytecode &#8211; but there are other implementations of Java that compile directly to machine code or that just interpret Java code as is.</p>
<p>If this still is unclear, hop on over to my previous post on <a href="https://thesocietea.org/2015/07/programming-concepts-compiled-and-interpreted-languages/">Compiled vs. Interpreted Languages</a>, where we dig into this topic at length.</p>
<h2>Conclusion</h2>
<p>I know we went over a lot &#8211; but you&#8217;re a good developer, so I knew you could handle it. I debated on breaking strongly-typed and weakly-typed languages out from this post, but that topic alone isn&#8217;t large enough to warrant its own post &#8211; plus I needed to break up the myths that a strong/weak type system is related to type checking.</p>
<p>There&#8217;s no answer to if statically-typed languages are better than dynamically-typed languages, and vice versa &#8211; they&#8217;re just different type systems with their own sets of pros and cons. Some languages  &#8211; like Perl and C# &#8211; even allow you to choose between static and dynamic type safety throughout your code. Understanding the type systems of your favorite programming languages will allow you to better understand why some errors may or may not pop up in the places that they do, and why.</p>
<p>I hope you learned a little bit today &#8211; I promise reviewing core programming concepts like these will help make you a better developer because you&#8217;re getting more of a grip on what&#8217;s going on behind the scenes of your code. Thanks for reading, and stick around for more posts in this Programming Concepts series!</p>
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
        <p>Pingback: <a href='http://blog.explodingads.com/1-programming-concepts-static-vs-dynamic-type-checking/' rel='external nofollow' class='url'>1 – Programming Concepts: Static vs. Dynamic Type Checking - Exploding Ads</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="comment even thread-even depth-1" id="dsq-comment-109">
        <div id="dsq-comment-header-109" class="dsq-comment-header">
            <cite id="dsq-cite-109">
                <a id="dsq-author-user-109" href="http://www.systematicdaytrading.com" target="_blank" rel="nofollow">Fil Lorinc</a>
            </cite>
        </div>
        <div id="dsq-comment-body-109" class="dsq-comment-body">
            <div id="dsq-comment-message-109" class="dsq-comment-message"><p>Good stuff man. Well explained</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2016/02/programming-concepts-type-introspection-and-reflection/' rel='external nofollow' class='url'>Programming Concepts: Type Introspection and Reflection | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
            </ul>


        </div>

    </div>

<script type="text/javascript">
var disqus_url = 'https://thesocietea.org/2015/11/programming-concepts-static-vs-dynamic-type-checking/';
var disqus_identifier = '732 https://thesocietea.org/?p=732';
var disqus_container_id = 'disqus_thread';
var disqus_shortname = 'thesocietea';
var disqus_title = "Programming Concepts: Static vs. Dynamic Type Checking";
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
        script.src = '?cf_action=sync_comments&post_id=732';

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

<!-- Dynamic page generated in 0.291 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-04-17 18:03:13 -->
