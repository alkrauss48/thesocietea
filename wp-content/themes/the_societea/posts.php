<?php
/**
 * Template Name: Posts
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <div class="subpage-header-image" style="background-image: url('<?php echo $cfs->get('header_image'); ?>');"
  data-start="background-position: 50% 65%;"
  data-400="background-position: 50% 35%;"
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
            <?php the_post();the_content(); ?>
          </div>
        </div>
        <?php
          $post_type = $cfs->get('post_type');
          $args=array('post_type' => $post_type, 'post_status' => 'publish');
          $my_query = new WP_Query($args);
          while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
            <?php get_template_part( $post_type, 'page' ); ?>
          <?php endwhile; ?>
      </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>