<?php
/**
 * The Template for displaying all single posts.
 *
 * @package the_societea
 */

get_header(); ?>

	<div id="primary" class="single-post content-area">
		<main id="main" class="site-main" role="main">


			<?php get_template_part( 'content', 'single' ); ?>

			<?php //the_societea_post_nav(); ?>

      <div class="container">
        <div class="container-padding">
          <?php
            if ( comments_open() || '0' != get_comments_number() ) :
              comments_template();
            endif;
          ?>
        </div>
      </div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
