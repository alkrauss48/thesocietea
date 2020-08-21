<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package the_societea
 */
  wp_footer();
?>

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
          <li><a class="icon-linkedin" title="LinkedIn" target="linkedin"  href="https://www.linkedin.com/in/alkrauss48/"></a></li>
          <li><a class="icon-twitter" title="Twitter" target="twitter" href="https://twitter.com/thecodeboss"></a></li>
          <li><a class="icon-uniE603" title="Email" href="mailto:alkrauss48@gmail.com"></a></li>
          </ul>
        </div>
      </div>
    </div>
    </footer>

    <script src="/assets/js/min/scripts.min.js"></script>
    <script>
      window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
      ga('create', 'UA-38589428-1', 'thecodeboss.dev');
      ga('require', 'autotrack');
      ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    <script async src='/assets/js/autotrack.js'></script>
  </body>
</html>
