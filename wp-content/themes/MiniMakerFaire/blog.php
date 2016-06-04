<?php
/*
* Template name: Post Feed
*/
get_header(); ?>

  <div class="container">

    <?php query_posts('post_type=post&post_status=publish&posts_per_page=9&paged='. get_query_var('paged')); ?>

    <?php if( have_posts() ): ?>

      <div id="post-<?php get_the_ID(); ?>" <?php post_class(); ?>>

          <div class="row">

            <?php
            $i = 0;
            while( have_posts() ): the_post();
              echo '<div class="recent-post-post ';
              if($i == 0){
                echo 'first-post col-xs-12">';
              }
              else{
                echo 'col-xs-12 col-sm-3">';
              }
               
              echo   '<article class="recent-post-inner">
                        <a href="' . get_permalink() . '">';

              if ( get_the_post_thumbnail() != '' ) {
                $thumb_id = get_post_thumbnail_id();
                $url = wp_get_attachment_url($thumb_id);
                echo "<div class='recent-post-img' style='background-image: url(" . $url . ");'></div>";
              }

              echo '      <div class="recent-post-text">
                            <h4>' . get_the_title() . '</h4>
                            <p class="recent-post-date">' . get_the_time("M j, Y") . '</p>
                            <p class="recent-post-descripton">' . substr(get_the_excerpt(), 0,150) . '</p>
                          </div>
                        </a>
                      </article>
                    </div>';
              $i++;
            endwhile; ?>

          </div>

        </div> <?php //.blog ?>


      <div class="navigation bottom15">
        <span class="newer">
          <?php previous_posts_link(__('<i class="fa fa-chevron-left" aria-hidden="true"></i> Newer','example')) ?>
        </span>
        <span class="older pull-right">
          <?php next_posts_link(__('Older <i class="fa fa-chevron-right" aria-hidden="true"></i>','example')) ?>
        </span>
        <div class="clearfix"></div>
      </div><!-- /.navigation -->

    <?php else: ?>

    <div id="post-404" class="noposts">

      <p><?php _e('None found.','example'); ?></p>

    </div><!-- /#post-404 -->

  <?php endif; wp_reset_query(); ?>

  </div>

<?php get_footer(); ?>