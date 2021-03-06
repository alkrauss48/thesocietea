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
        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
        <?php
          $link = CFS()->get('link');
          if($link):
        ?>
          <p class="entry-title-link-extra"><a href="<?php echo $link; ?>" target="_blank">Visit <i class="icon2-play"></i></a></p>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <div class="entry-content">
    <div class="container-padding">
      <div class="container">
        <p><strong>Project Type: </strong><?php echo CFS()->get('project_type'); ?></p>
        <p><strong>Languages Used: </strong><?php echo CFS()->get('languages'); ?></p>
        <!-- <p><strong>Role: </strong><?php echo CFS()->get('role'); ?></p> -->
        <p><strong>Company: </strong>
        <?php if(CFS()->get('company_link')): ?>
          <a class="project-link" target="_blank" href="<?php echo CFS()->get('company_link') ?>"><?php echo CFS()->get('company') ?></a>
        <?php else: ?>
          <?php echo CFS()->get('company') ?>
        <?php endif; ?>
        </p>
        <!-- <br /> -->
        <!-- <?php the_content(); ?> -->
      </div>
    </div>
  </div>
  <footer class="project-screenshots">
    <div class="down-triangle"></div>
    <div class="container-padding">
    <div class="container">
      <div>
        <?php
          $fields = CFS()->get('screenshots');
          if($fields):
        ?>
          <?php foreach($fields as $field): ?>
            <div class="project-screenshot">
              <a href="<?php echo $field['image']; ?>" title="<?php echo $field['caption']; ?>">
                <div class="project-main" style="background-image: url('<?php echo $field['thumbnail']; ?>');"></div>
                <div class="project-overlay"><i class="icon2-search-plus"></i></div>
              </a>
            </div>
        <?php
            endforeach;
          else:
?>
  <p class="no-screenshots">No screenshots to show for this project</p>
<?php
          endif;
        ?>
      </div>
    </div>
    </div>
    <div class="down-triangle triangle-second"></div>
  </footer>
</article>
