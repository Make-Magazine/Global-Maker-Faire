<?php get_header();


if(get_current_blog_id()==211 && !is_user_logged_in()){
  //if not logged in
  echo '<h2 class="text-center">You must be logged in to view this site.<br/>Please log into your home site.</h2>';
}else{
?>

<div class="page-body">
  <?php // theloop
  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="container">
      <?php the_content(); ?>
    </div>
    <?php
    if(isset($home_ID)){
      // check if the flexible content field has rows of data
      if( have_rows('content_panels', $home_ID)) {
        // loop through the rows of data
        while ( have_rows('content_panels', $home_ID) ) {
          the_row();
          $row_layout = get_row_layout();
          echo dispLayout($row_layout);
        }
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
<?php } ?>
<!-- end .page-body -->
<?php get_footer(); ?>
