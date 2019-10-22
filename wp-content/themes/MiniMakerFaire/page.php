<?php get_header();
//go full width on page if using gutenburg, otherwise use the container class 
$divClass = (is_block_editor_active() ? "" : "container");

?>
<div class="page-body">
  <?php // theloop
  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>    
    <div class="<?php echo $divClass;?>">
      <?php the_content(); ?>
    </div>
    <?php
    // check if the flexible content field has rows of data
    if( have_rows('content_panels')) {
      // loop through the rows of data
      while ( have_rows('content_panels') ) {
        the_row();
        $row_layout = get_row_layout();
        echo dispLayout($row_layout);
			error_log(print_r($row_layout, TRUE));
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
<?php //} ?>
<!-- end .page-body -->
<?php get_footer(); ?>
