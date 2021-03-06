<?php
/**
 * The template used for displaying project content
 *
 * @package the_societea
 */
?>

<a aria-labelledby="post-title-<?php the_ID() ?>'" id="post-<?php the_ID(); ?>" <?php post_class(array('blog-item')); ?> href="<?php the_permalink( get_the_ID() ) ?>">
  <div class="blog-item__overlay">
    <?php the_title( '<h2 class="blog-item__title" id="post-title-'.get_the_ID().'">', '</h2>' ); ?>
    <div class="blog-item__excerpt">
      <?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?>
    </div>
  </div>
</a>
