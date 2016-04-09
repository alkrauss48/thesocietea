<?php
/**
 * The template used for displaying project content
 *
 * @package the_societea
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <div class="container-padding">
      <div class="container">
        <?php the_title( '<a class="blog-link entry-title-link" href="'. get_permalink( get_the_ID() ) .'"><h2 class="">', ' <i class="icon2-play"></i></h2></a>' ); ?>
		<div class="entry-meta">
			<?php the_societea_posted_on(); ?>
		</div><!-- .entry-meta -->
<hr class="short" />
	<div class="entry-content">
		<?php the_excerpt(); ?>
</div>
      </div>
    </div>
  </header>
</article>
