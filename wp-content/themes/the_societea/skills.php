<?php
/**
 * Template Name: Skills
 */

get_header(); ?>

	<div id="primary" class="content-area">
    <main id="main" class="site-main scene_element scene_element--fadein" role="main">
      <div class="subpage-header-image" style="background-image: url('<?php echo $cfs->get('header_image'); ?>');"
  data-start="background-position: 50% 55%;"
  data-400="background-position: 50% 40%;"
></div>
      <div class="subpage-header-overlay"></div>
      <div class="subpage-title">
        <div class="container">
          <div class="inner-title-wrapper">
            <div class="container-padding">
              <h1><?php the_title(); ?></h1>
            </div>
          </div>
        </div>
      </div>

      <div class="plain" id="main-content">
        <div class="container-padding">
          <div class="container">
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
            <?php $categories = $cfs->get('categories'); ?>
            <?php if($categories): ?>
              <?php foreach($categories as $category): ?>
                <div class="skill-category">
                  <h2 style="border-bottom: 3px solid <?php echo $category['color']; ?>"><?php echo $category['category_title']; ?></h2>
                  <ul class="category-skills-list">
                    <?php $skills = $category['skills']; ?>
                    <?php if($skills): ?>
                      <?php foreach($skills as $skill): ?>
                        <li>
                          <p><?php echo $skill['skill']; ?></p>
                          <div class="skill-bar-wrapper">
                            <div class="skill-bar <?php echo str_replace(' ', '-', strtolower($category['category_title'])); ?>-bar" style="width: <?php echo $skill['percentage']; ?>%;"
                              <!-- data&#45;bottom&#45;top="width: 0%;opacity: 0;" -->
                              <!-- data&#45;&#45;50&#45;bottom&#45;bottom="width: <?php // echo $skill['percentage']; ?>%; opacity: 1;" -->
                            ></div>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </ul>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
