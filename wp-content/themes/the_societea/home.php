<?php 
/*
 * Template Name: Home
 *
*/

get_header(); ?>
    <div class="header-content-wrapper spanner">
      <main id="main" class="site-main scene_element scene_element--fadein" role="main">
      <div id="header-wrapper" class="header-content-image"></div>
      <div class="header-text">
        <h2>Hi, I'm</h2>
        <h1>Aaron Krauss</h1>
        <hr class="header-hr" />
        <span class="typed"><h3>I'm a <span class="orange">Developer<span></h3></span>
        <ul class="header-icons">
          <li><a class="icon-github" title="GitHub" target="github" href="https://github.com/alkrauss48"></a></li>
          <li><a class="icon-twitter" title="Twitter" target="twitter" href="https://twitter.com/thecodeboss"></a></li>
          <li><a class="icon3-untappd" title="Untappd" target="untappd"  href="https://untappd.com/user/thecodeboss"></a></li>
          <li><a class="icon-uniE603" title="Email" href="mailto:alkrauss48@gmail.com"></a></li>
        </ul>
      </div>
      </main><!-- #main -->
    </div>
    <div class="home-content">
      <div class="container-padding">
        <h2>Probably the coolest developer you'll ever meet</h2>
        <h3>I build amazing things all day - every day</h3>
        <div class="home-offerings-wrapper">
          <div class="home-offerings">
            <div class="icon-wrapper"><i class="icon2-keyboard"></i></div>
            <a class="development" href="<?php echo get_permalink(30); ?>">Projects</a>
          </div>
          <div class="home-offerings">
            <div class="icon-wrapper"><i class="icon2-pencil"></i></div>
            <a class="design" href="<?php echo get_permalink(16); ?>">Blog</a>
          </div>
          <div class="home-offerings">
            <div class="icon-wrapper"><i class="icon3-lab"></i></div>
            <a class="training" href="http://labs.thesocietea.org">Labs</a>
          </div>
        </div>
      </div>
      <div class="home-about">
        <div class="down-triangle"></div>
        <div class="container-padding">
          <div class="container">
            <div class="home-picture">
              <img src="/assets/images/dist/aaron-krauss.jpg" alt="Aaron Krauss" />
            </div>
            <div class="home-about-desc">
              <h2>Get to know me</h2>
              <?php the_content(); ?>
              <a class="orange-learn-more" href="<?php echo get_permalink(6); ?>">About Me <i class="icon2-play"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="home-projects">
        <div class="down-triangle"></div>
        <h2 class="home-projects-title">This is where you may know me from</h2>
        <div class="container">
          <a href="https://labs.thesocietea.org/carnegie-chart" class="home-popular-list popular-item-1">
            <span>Dale Carnegie 30-Day Practice Chart</span>
          </a>
          <a href="http://resumehaus.com" class="home-popular-list popular-item-2">
            <span>ResumeHaus</span>
          </a>
          <a href="https://thesocietea.org/2015/02/building-a-json-api-with-rails-part-1-getting-started/" class="home-popular-list popular-item-3">
            <span>Building a JSON API with Rails Series</span>
          </a>
        </div>
        <h2>But I built these too - and more</h2>
        <div class="container-padding">
          <div class="home-projects-list">
            <?php
              $fields = $cfs->get('projects');
              if($fields):
            ?>
              <?php foreach($fields as $index => $field): ?>
                <div class="home-project">
                  <div class="project-image" style="background-image: url('<?php echo $field['thumbnail']; ?>');">
                    <p class="site-title" href="#"><?php echo $field['label']; ?></p>
                    <a class="project-hover" href="<?php echo $field['url']; ?>" target="tle"><p>Visit Site <i class="icon2-play"></i></p></a>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
        <a class="orange-learn-more" href="<?php echo get_permalink(13); ?>">Hire Me <i class="icon2-play"></i></a>
      </div>
    </div>
  <script src="/assets/js/lib/three.min.js"type="text/javascript" charset="utf-8"></script>
<?php get_footer(); ?>
