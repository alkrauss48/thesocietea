<?php
/**
 * Template Name: Posts
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
              <?php
                global $post;
                $slug = get_post( $post )->post_name;
              ?>
              <form id="searchform" action="/<?php echo $slug; ?>" method="get">
                <input id="search" class="text" type="text" placeholder="Search" name="search" value="<?php  echo $_GET['search']; ?>" />
              </form>
            </div>
          </div>
        </div>
        <?php
          $post_type = $cfs->get('post_type');
          $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
          $args=array('post_type' => $post_type, 's' => $_GET['search'], 'post_status' => 'publish', 'paged' => $paged, 'has_password' => false);
          $my_query = new WP_Query($args);
          if ( $my_query->have_posts() ) :
            while ( $my_query->have_posts() ) : $my_query->the_post();
              get_template_part( $post_type, 'page' );
            endwhile;
          ?>
          <div class="post-navigation">
            <div class="post-previous"><?php next_posts_link( 'Next ' . ucfirst($post_type) . 's', $my_query->max_num_pages ); ?></div>
            <div class="post-next"><?php previous_posts_link( 'Previous  ' . ucfirst($post_type) . 's' ); ?></div>
          </div>
          <?php
            wp_reset_postdata();
          ?>
        <?php else : ?>
            <div class="container">
              <p><?php _e('Sorry, no posts matched that search.'); ?></p>
            </div>
          <?php endif; ?>
      </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
