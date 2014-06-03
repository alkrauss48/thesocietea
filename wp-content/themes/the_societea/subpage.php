<?php
/**
 * Template Name: Subpage
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

    <div class="subpage-header-image" style="background-image: url('<?php echo $cfs->get('header_image'); ?>');"></div>
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
    </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
