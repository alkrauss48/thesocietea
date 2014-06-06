<?php
/**
 * The template used for displaying project content
 *
 * @package the_societea
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
  </header>

  <div class="entry-content">
    <?php the_content(); ?>
  </div>
  <footer class="project-screenshots">
    <div class="container">
      <div>
        <?php
          $fields = $cfs->get('screenshots');
          if($fields):
        ?>
          <?php foreach($fields as $field): ?>
            <div class="project-screenshot">
              <a href="<?php echo $field['image']; ?>" title="<?php echo $field['caption']; ?>">
                <div style="background-image: url('<?php echo $field['thumbnail']; ?>');"></div>
              </a>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </footer>
</article>
