<?php
/**
 * Template Name: Projects
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <div class="subpage-header-image" style="background-image: url('<?php echo $cfs->get('header_image'); ?>');"
  data-start="background-position: 50% 60%;"
  data-400="background-position: 50% 40%;"
></div>
      <div class="subpage-header-overlay"></div>
      <div class="subpage-title">
        <div class="container">
          <div class="inner-title-wrapper">
            <h1><?php the_title(); ?></h1>
          </div>
        </div>
      </div>

      <div class="plain" id="main-content">
        <div class="container">
          <?php the_post();the_content(); ?>
        </div>
        <?php
          $args=array('post_type' => 'project', 'post_status' => 'publish');
          $my_query = new WP_Query($args);
          while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
            <?php get_template_part( 'project', 'page' ); ?>
          <?php endwhile; ?>
      </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
