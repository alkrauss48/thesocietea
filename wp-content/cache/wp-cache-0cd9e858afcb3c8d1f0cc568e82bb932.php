<?php die(); ?><!DOCTYPE html>
<html lang="en-US">
<!DOCTYPE html>
  <!--[if IE 8]>         <html lang="en" class="no-js ie8 lte-ie9"> <![endif]-->
  <!--[if lte IE 9]>     <html lang="en" class="no-js lte-ie9"> <![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Programming Concepts: Compiled and Interpreted Languages | Aaron Krauss</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="https://thesocietea.org/xmlrpc.php">

    <meta name="description" content="As with my previous Programming Concepts post over the Stack vs. the Heap, in this series I&#8217;m aiming to look back at core computing topics that affect everything about how we develop today, but are topics that most developers using higher level languages don&#8217;t ever need to deal with and thus may not fully understand them (myself included)....">
    <meta property="og:description" content="As with my previous Programming Concepts post over the Stack vs. the Heap, in this series I&#8217;m aiming to look back at core computing topics that affect everything about how we develop today, but are topics that most developers using higher level languages don&#8217;t ever need to deal with and thus may not fully understand them (myself included)....">
        <meta property="og:image" content="https://thesocietea.org/assets/images/dist/ak-smile-optimized.jpg">
    <meta property="og:title" content="Programming Concepts: Compiled and Interpreted Languages | Aaron Krauss">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://thesocietea.org/2015/07/programming-concepts-compiled-and-interpreted-languages/ " />
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
  <body class="post-template-default single single-post postid-607 single-format-standard m-scene">
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


			
<article id="post-607" class="post-607 post type-post status-publish format-standard hentry category-programming-concepts">
            <div class="container-padding">
<div class="container">
  <header class="entry-header">
    <h1 class="entry-title">Programming Concepts: Compiled and Interpreted Languages</h1>
    <div class="entry-meta">
      <span class="posted-on"><span><time class="entry-date published" datetime="2015-07-24T18:00:42+00:00">July 24, 2015</time></span></span>    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
<hr class="short" />

  <div class="entry-content">
    <div class="pre-post-content">
      <p><strong>Programming Concepts Series:</strong></p>
<ul>
<li><a href="https://thesocietea.org/2014/10/programming-concepts-the-stack-and-the-heap/">The Stack and the Heap</a></li>
<li>Compiled and Interpreted Languages</li>
<li><a href="https://thesocietea.org/2015/10/programming-concepts-concurrency/">Concurrency</a></li>
<li><a href="https://thesocietea.org/2015/11/programming-concepts-static-vs-dynamic-type-checking/">Static vs. Dynamic Type Checking</a></li>
<li><a href="https://thesocietea.org/2016/02/programming-concepts-type-introspection-and-reflection/">Type Introspection and Reflection</a></li>
<li><a href="https://thesocietea.org/2016/12/core-functional-programming-concepts/">Core Functional Programming Concepts</a></li>
<li><a href="https://thesocietea.org/2017/01/programming-concepts-garbage-collection/">Garbage Collection</a></li>
</ul>
<hr />
    </div>
    <p>As with my previous <strong>Programming Concepts</strong> post over <a title="Programming Concepts: The Stack and the Heap" href="https://thesocietea.org/2014/10/programming-concepts-the-stack-and-the-heap/">the Stack vs. the Heap</a>, in this series I&#8217;m aiming to look back at core computing topics that affect everything about how we develop today, but are topics that most developers using higher level languages don&#8217;t ever need to deal with and thus may not fully understand them (myself included). In the same way that learning another programming language will make you a better developer, understanding the core of how different programming languages work will teach you a lot. Today&#8217;s topic: <strong>Compiled Languages and Interpreted Languages</strong>.</p>
<p>As developers, we often come across terms such as the <em>compiler</em> or the <em>interpreter</em> as we read blog posts, articles, StackOverflow answers, etc., but I feel like these are terms that we gloss over these days without really understanding them. Compilation and Interpretation are at the core of how all programming languages are executed; let&#8217;s take a look at how these concepts really work.</p>
<h2>Introduction</h2>
<p>We depend on tools such as compilation and interpretation in order to get our written code into a form that the computer can execute. Code can either be executed natively through the operating system after it is converted to <em>machine code</em> (via compilation) or can be evaluated line by line through another program which handles executing the code instead of the operating system itself (via interpretation).</p>
<p>A <strong>compiled</strong> <strong>language</strong> is one where the program, once compiled, is expressed in the instructions of the target machine; this machine code is undecipherable by humans. An <strong>interpreted</strong> <strong>language</strong> is one where the instructions are not directly executed by the target machine, but instead read and executed by some other program (which normally <em>is</em> written in the language of the native machine). Both compilation and interpretation offer benefits and pitfalls, which is mainly what we&#8217;re going to talk about.</p>
<p>Before we get further, it needs to be said that most programming languages have both compiled implementations and interpretated implementations, and thus you can&#8217;t really classify an entire language as being compiled or interpreted &#8211; only a specific implementation. For the sake of simplicity however, I&#8217;ll be referring to either &#8220;compiled languages&#8221; or &#8220;interpreted languages&#8221; for the remainder of the post.</p>
<h2>Compiled Languages</h2>
<p>The major advantage of compiled languages over interpreted languages is their execution speed. Because compiled languages are converted directly into machine code, they run significantly faster and more efficiently than interpreted languages, especially considering the complexity of statements in some of the more modern scripting languages which are interpreted.</p>
<p>Lower-level languages tend to be compiled because efficiency is usually more of a concern than cross-platform support. Additionally, because compiled languages are converted directly into machine code, this gives the developer much more control over hardware aspects such as memory management and CPU usage. Examples of pure compiled languages include C, C++, Erlang, Haskell, and more modern languages such as Rust and Go.</p>
<p>Some of the pitfalls of compiled languages are pretty substantial however. In order to run a program written in a compiled language, you need to first manually compile it. Not only is this an extra step in order to run a program, but while you debug the program, you would need to recompile the program each time you want to test your new changes. That can make debugging very tedious. Another detriment of compiled languages is that they are not platform-independent, as the compiled machine code is specific to the machine that is executing it.</p>
<h2>Interpreted Languages</h2>
<p>In contrast to compiled languages, interpreted languages do not require machine code in order to execute the program; instead, interpreters will run through a program line by line and execute each command. In the early days of interpretation, this posed a disadvantage compared to compiled languages because it took significantly more time to execute the program, but with the advent of new technologies such as <a href="http://en.wikipedia.org/wiki/Just-in-time_compilation" target="_blank">just-in-time compilation</a>, this gap is narrowing. Examples of some common interpreted languages include PHP, Perl, Ruby, and Python. Some of the programming concepts that interpreted languages make easier are:</p>
<ul>
<li>Platform independence</li>
<li><a href="http://en.wikipedia.org/wiki/Reflection_%28computer_programming%29" target="_blank">Reflection</a></li>
<li><a href="http://en.wikipedia.org/wiki/Type_system#Dynamic_type-checking_and_runtime_type_information" target="_blank">Dynamic typing</a></li>
<li>Smaller executable program size</li>
<li><a href="http://en.wikipedia.org/wiki/Scope_%28computer_science%29#Dynamic_scoping" target="_blank">Dynamic scoping</a></li>
</ul>
<p>The main disadvantage of interpreted languages is a slower program execution speed compared to compiled languages. However, as mentioned earlier, just-in-time compilation helps by converting frequently executed sequences of interpreted instruction into host machine code.</p>
<hr class="short" />
<h2>Bonus: Bytecode Languages</h2>
<p>Bytecode languages are a type of programming language that fall under the categories of both compiled and interpreted languages because they employ both compilation and interpretation to execute code. Java and the .Net framework are easily the most common examples of bytecode languages (dubbed <strong>Common Intermediate Language</strong> in .Net). In fact, the <a href="http://en.wikipedia.org/wiki/Java_virtual_machine" target="_blank">Java Virtual Machine</a> (JVM) is such a common virtual machine to interpret bytecode that <a href="http://en.wikipedia.org/wiki/List_of_JVM_languages" target="_blank">several languages</a> have implementations built to run on the JVM.</p>
<p>In a bytecode language, the first step is to <span style="text-decoration: underline;">compile</span> the current program from its human-readable language into bytecode. <strong>Bytecode</strong> is a form of instruction set that is designed to be efficiently executed by an interpreter and is composed of compact numeric codes, constants, and memory references. From this point, the bytecode is passed to a virtual machine which acts as the interpreter, which then proceeds to <span style="text-decoration: underline;">interpret</span> the code as a standard interpreter would.</p>
<p>In bytecode languages, there is a delay when the program is first run in order to compile the code into bytecode, but the execution speed is increased considerably compared to standard interpreted languages because the bytecode is optimized for the interpreter. The largest benefit of bytecode languages is platform independence which is typically only available to interpreted languages, but the programs have a much faster execution speed than interpreted languages. Similar to how interpreted languages make use of just-in-time compilation, the virtual machines that interpret bytecode can also make use of this technique to enhance execution speed.</p>
<hr class="short" />
<h2>Overview</h2>
<p>Most languages today can either be compiled or interpreted through their various implementations, making the difference between the two less relevant. One language execution style isn&#8217;t better than the other, but they certainly have their strengths and weaknesses.</p>
<p>In a nutshell, compiled languages are the most efficient type of programming language because they execute directly as machine code and can easily utilize more of the hardware specs of the running machine. In turn, this forces a significantly stricter coding style and a single program usually can&#8217;t be run on different operating systems. Interpreted languages on the other hand offer much more diversity in coding style, are platform-independent, and easily allow for dynamic development techniques such as metaprogramming. However, interpreted languages execute much slower than compiled languages &#8211; though just-in-time compilation has been helping to speed this up.</p>
<p>Bytecode languages are common as well, and try to utilize the strong points in both compiled and interpreted languages. This allows for programming languages that are platform independent like interpreted languages, while still executing at a speed significantly faster than interpreted languages.</p>
<p>I know there were no code examples here &#8211; but I really wanted to dig into this topic because I feel that this is one of those programming concepts that will always be relevant to us, no matter how abstract our higher-level languages get from the hardware level. Feel free to leave a comment if you want to see any specific <strong>Programming Concepts</strong> posts in the future!</p>
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
                    <li class="comment even thread-even depth-1" id="dsq-comment-62">
        <div id="dsq-comment-header-62" class="dsq-comment-header">
            <cite id="dsq-cite-62">
                <span id="dsq-author-user-62">Paddy3118</span>
            </cite>
        </div>
        <div id="dsq-comment-body-62" class="dsq-comment-body">
            <div id="dsq-comment-message-62" class="dsq-comment-message"><p>A great and comprehensive overview. Thanks.</p>
</div>
        </div>

    </li><!-- #comment-## -->
    <li class="comment odd alt thread-odd thread-alt depth-1" id="dsq-comment-63">
        <div id="dsq-comment-header-63" class="dsq-comment-header">
            <cite id="dsq-cite-63">
                <a id="dsq-author-user-63" href="http://thefinelinestudios.com/" target="_blank" rel="nofollow">Nikola Novakovic</a>
            </cite>
        </div>
        <div id="dsq-comment-body-63" class="dsq-comment-body">
            <div id="dsq-comment-message-63" class="dsq-comment-message"><p>Really nice overview of the topic. I think generally software engineers on the web should learn more of these concepts, since that will make them better coders overall. I see too many &#8220;web devs&#8221; from 4 month bootcamps these days that really don&#8217;t know these things, but they really should.</p>
</div>
        </div>

    <ul class="children">
    <li class="comment even depth-2" id="dsq-comment-64">
        <div id="dsq-comment-header-64" class="dsq-comment-header">
            <cite id="dsq-cite-64">
                <span id="dsq-author-user-64">alkrauss48</span>
            </cite>
        </div>
        <div id="dsq-comment-body-64" class="dsq-comment-body">
            <div id="dsq-comment-message-64" class="dsq-comment-message"><p>Thank you! I feel that way too &#8211; as developers we have a lot of new &#8216;cool kid&#8217; tools coming out everyday, which is awesome, but it makes the difference between how we develop and how it all actually happens behind the scenes much more abstract. I love digging into these topics, and sharing what I learn about them.</p>
</div>
        </div>

    </li><!-- #comment-## -->
</ul><!-- .children -->
</li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/01/programming-concepts-static-vs-dynamic-type-checking/' rel='external nofollow' class='url'>Programming Concepts: Static vs. Dynamic Type Checking | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2014/10/programming-concepts-the-stack-and-the-heap/' rel='external nofollow' class='url'>Programming Concepts: The Stack and the Heap | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
    <li class="post pingback">
        <p>Pingback: <a href='https://thesocietea.org/2015/10/programming-concepts-concurrency/' rel='external nofollow' class='url'>Programming Concepts: Concurrency | Aaron Krauss</a>()</p>
    </li>
    </li><!-- #comment-## -->
            </ul>


        </div>

    </div>

<script type="text/javascript">
var disqus_url = 'https://thesocietea.org/2015/07/programming-concepts-compiled-and-interpreted-languages/';
var disqus_identifier = '607 https://thesocietea.org/?p=607';
var disqus_container_id = 'disqus_thread';
var disqus_shortname = 'thesocietea';
var disqus_title = "Programming Concepts: Compiled and Interpreted Languages";
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
        script.src = '?cf_action=sync_comments&post_id=607';

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

<!-- Dynamic page generated in 0.167 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-04-17 17:55:16 -->
