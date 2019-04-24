<?php
/**
 * @package the_societea
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container-padding">
<div class="container">
  <header class="entry-header">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

    <div class="entry-meta">
      <?php the_societea_posted_on(); ?>
    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
<hr class="short" />

  <div class="entry-content">
    <div class="pre-post-content">
      <?php echo CFS()->get('pre_post_content'); ?>
    </div>
    <?php the_content(); ?>
    <div class="post-post-content">
      <h2>A Genuine Request</h2>
      <p>
        Hello there - thank you for reading my post! If you enjoyed it, I'd
        love it if you considered supporting me. I'm not asking for money
        or any of that "buy me a beer" crap; I would just love it if you
        would consider downloading (and using) the Brave browser using
        <a href="https://brave.com/the124">my referral code</a>!
      </p>
      <p>
        <img class="brave-icon" src="/assets/images/dist/brave.png" alt="The Brave Browser" />
        <a href="https://brave.com/">Brave</a> has a focus on
        security and privacy - and is hardcore against ads.
        That means that sites like mine wouldn't generate any revenue
        if you viewed them in Brave - but that's okay; I only make about
        $10 / month with ads, and that goes right to hosting. If you use
        my referral code to download Brave and minimally use it for 30 days though,
        I get about $5 with Brave's currency - Basic Attention Token, or
        BAT for short.
      </p>
      <p>
        Whether you consider using it or not, I'm just glad you read this post. Thanks again!
      </p>
      <p>Referral Code: <a href="https://brave.com/the124">https://brave.com/the124</a></p>
    </div>
 <?php
// 	wp_link_pages( array(
// 		'before' => '<div class="page-links">' . __( 'Pages:', 'the_societea' ),
// 		'after'  => '</div>',
// 	) );
// ?>
  </div><!-- .entry-content -->

</div>
</div>

  <footer class="entry-footer">
<?php
//   /* translators: used between list items, there is a space after the comma */
//   $category_list = get_the_category_list( __( ', ', 'the_societea' ) );
//
// /* translators: used between list items, there is a space after the comma */
// $tag_list = get_the_tag_list( '', __( ', ', 'the_societea' ) );
//
// if ( ! the_societea_categorized_blog() ) {
//   // This blog only has 1 category so we just need to worry about tags in the meta text
//   if ( '' != $tag_list ) {
//     $meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'the_societea' );
//   } else {
//     $meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'the_societea' );
//   }
//
// } else {
//   // But this blog has loads of categories so we should probably display them here
//   if ( '' != $tag_list ) {
//     $meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'the_societea' );
//   } else {
//     $meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'the_societea' );
//   }
//
// } // end check for categories on this blog
//
// printf(
//   $meta_text,
//   $category_list,
//   $tag_list,
//   get_permalink()
// );
// edit_post_link( __( 'Edit', 'the_societea' ), '<span class="edit-link">', '</span>' ); 
// ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
