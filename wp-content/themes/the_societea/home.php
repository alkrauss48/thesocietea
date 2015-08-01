<?php 
/*
 * Template Name: Home
 *
*/

get_header(); ?>
    <div class="header-content-wrapper spanner">
      <main id="main" class="site-main scene_element scene_element--fadein" role="main">
      <div class="header-content-image"></div>
      <div class="header-text">
        <h2>Hi, I'm</h2>
        <h1>Aaron Krauss</h1>
        <hr class="header-hr" />
        <span class="typed"><h3>I'm a <span class="light-orange">Developer<span></h3></span>
        <ul class="header-icons">
          <li><a class="icon-linkedin" title="LinkedIn" target="linkedin"  href="https://linkedin.com/in/alkrauss48/"></a></li>
          <li><a class="icon-twitter" title="Twitter" target="twitter" href="https://twitter.com/thecodeboss"></a></li>
          <li><a class="icon-github" title="GitHub" target="github" href="https://github.com/alkrauss48"></a></li>
          <li><a class="icon-uniE603" title="Email" href="mailto:alkrauss48@gmail.com"></a></li>
        </ul>
      </div>
      </main><!-- #main -->
    </div>
    <div class="home-content">
      <div class="container-padding">
        <h2>Let me help you with your project</h2>
        <h3>Get in touch with me if you need help with development, design, or training</h3>
        <div class="home-offerings-wrapper">
          <div class="home-offerings">
            <div class="icon-wrapper"
              data-bottom-top="left: -15px; opacity:0;"
              data-center-center="left: 0px; opacity: 1;"
              ><i class="icon2-keyboard"></i></div>
            <a class="development" href="<?php echo get_permalink(13); ?>">Development</a>
          </div>
          <div class="home-offerings">
            <div class="icon-wrapper"
              data-bottom-top="opacity:0;"
              data-center-center="opacity: 1;"
              ><i class="icon2-pencil"></i></div>
            <a class="design" href="<?php echo get_permalink(13); ?>">Design</a>
          </div>
          <div class="home-offerings">
            <div class="icon-wrapper"
              data-bottom-top="left: 15px; opacity:0;"
              data-center-center="left: 0px; opacity: 1;"
              ><i class="icon2-users"></i></div>
            <a class="training" href="<?php echo get_permalink(13); ?>">Training</a>
          </div>
        </div>
      </div>
      <div class="home-about">
        <div class="down-triangle"></div>
        <div class="container-padding">
          <div class="container">
            <div class="home-picture">
              <img src="/assets/images/dist/aaronkrauss.png" alt="Aaron Krauss"
              data-bottom-top="left: -15px; opacity:0;"
              data-center-center="left: 0px; opacity: 1;"
              />
            </div>
            <div class="home-about-desc">
              <h2>Get to know me</h2>
              <?php the_content(); ?>
              <a class="orange-learn-more" href="<?php echo get_permalink(6); ?>">Learn More <i class="icon2-play"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="home-projects">
        <div class="down-triangle"></div>
        <h2>Check out some of my projects</h2>
        <div class="container-padding">
          <div class="home-projects-list">
            <?php
              $fields = $cfs->get('projects');
              if($fields):
            ?>
              <?php foreach($fields as $index => $field): ?>
                <div class="home-project"
                  <?php if(($index % 4) < 2): ?>
                    data-bottom-top="left: -15px; opacity:0;"
                  <?php else: ?>
                    data-bottom-top="left: 15px; opacity:0;"
                  <?php endif; ?>
                  data--50-bottom-bottom="left: 0px; opacity: 1;"
                  >
                  <div class="project-image" style="background-image: url('<?php echo $field['thumbnail']; ?>');">
                    <p class="site-title" href="#"><?php echo $field['label']; ?></p>
                    <a class="project-hover" href="<?php echo $field['url']; ?>" target="tle"><p>Visit Site <i class="icon2-play"></i></p></a>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
        <a class="orange-learn-more" href="<?php echo get_permalink(30); ?>">See More <i class="icon2-play"></i></a>
      </div>
    </div>
<?php get_footer(); ?>
