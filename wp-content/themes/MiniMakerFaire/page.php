<?php get_header(); ?>

<div class="page-body">

  <?php // theloop
  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="container">

      <?php the_content(); ?>

    </div>

    <?php include('panels.php'); ?>

    <?php wp_link_pages(); ?>
    <?php comments_template(); ?>

  <?php endwhile; ?>
  <?php else: ?>

    <?php get_404_template(); ?>

  <?php endif; ?>

</div>
<!-- end .page-body -->

<?php get_footer(); ?>
