<?php get_header(); ?>

<div class="container">

  <div class="row">

    <div class="col-xs-12">

      <?php

      //if this was a search we display a page header with the results count. If there were no results we display the search form.
      if (is_search()) :

        $total_results = $wp_query->found_posts;

        echo "<h2 class='page-header'>" . sprintf( __('%s Search Results for "%s"','devdmbootstrap3'),  $total_results, get_search_query() ) . "</h2>";

        if ($total_results == 0) :
          get_search_form(true);
        endif;

      endif;

      ?>

      <?php // theloop
        if ( have_posts() ) : while ( have_posts() ) : the_post();

          // single post
          if ( is_single() ) : 

            // Get the blog/news page unique URL
            $news_pages = get_pages(array(
              'meta_key' => '_wp_page_template',
              'meta_value' => 'blog.php'
            ));
            foreach($news_pages as $news_page){
              $news_ID = $news_page->ID;
            } 
            $news_slug = get_post( $news_ID )->post_name; ?>

            <div <?php post_class(); ?>>

              <div class="all-posts-btn">
                <a href="/<?php echo $news_slug; ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> All News</a>
              </div>

              <?php if ( has_post_thumbnail() ) : 

              if (get_field('post_featured_image_placement') == 'Top') {
                $image_css = 'background-position: top;';
              } else if (get_field('post_featured_image_placement') == 'Center') {
                $image_css = '';
              } else if (get_field('post_featured_image_placement') == 'Bottom') {
                $image_css = 'background-position: bottom;';
              } else if (get_field('post_featured_image_placement') == 'Contain') {
                $image_css = 'background-size: contain;';
              } ?>
                <div class="post-thumb-hero" style="background-image: url( <?php the_post_thumbnail_url( 'full' ); ?> );<?php echo $image_css; ?>"></div>
              <?php endif; ?>

              <h2 class="page-header"><?php the_title() ;?></h2>

              <p class="post-author">By <?php the_author(); ?>, <span><?php the_date('M j, Y'); ?></span></p>

              <?php the_content(); ?>
              <?php wp_link_pages(); ?>
              <?php comments_template(); ?>

            </div>
          <?php
          // list of posts
          else : ?>
            <div <?php post_class(); ?>>

              <h2 class="page-header">
                  <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'devdmbootstrap3' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
              </h2>

              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail(); ?>
                <div class="clear"></div>
              <?php endif; ?>

              <?php the_content(); ?>
              <?php wp_link_pages(); ?>
              <?php  if ( comments_open() ) : ?>
                <div class="clear"></div>
                <p class="text-right">
                  <a class="btn btn-success" href="<?php the_permalink(); ?>#comments"><?php comments_number(__('Leave a Comment','devdmbootstrap3'), __('One Comment','devdmbootstrap3'), '%' . __(' Comments','devdmbootstrap3') );?> <span class="glyphicon glyphicon-comment"></span></a>
                </p>
              <?php endif; ?>
            </div>

          <?php  endif; ?>

        <?php endwhile; ?>
        <?php posts_nav_link(); ?>
        <?php else: ?>

          <?php get_404_template(); ?>

      <?php endif; ?>

    </div>

  </div>

</div>

<?php get_footer(); ?>