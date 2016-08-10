<?php get_header(); ?>

<div class="page-body">
  <?php // theloop
  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="container">
      <?php the_content(); ?>
    </div>
      <?php
  // check if the flexible content field has rows of data
  if( have_rows('content_panels', $home_ID)) {
    // loop through the rows of data
    while ( have_rows('content_panels', $home_ID) ) {
      the_row();
      $row_layout = get_row_layout();
      echo dispLayout($row_layout);
    }
  }
  ?>
    <?php wp_link_pages(); ?>
    <?php comments_template(); ?>
  <?php endwhile; ?>
  <?php else: ?>
    <?php get_404_template(); ?>
  <?php endif; ?>
</div>
<!-- end .page-body -->
<?php get_footer(); ?>
