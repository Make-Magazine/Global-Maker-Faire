<?php get_header(); ?>

  <div class="container">

    <?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

    <?php if( have_posts() ): ?>

      <div id="post-<?php get_the_ID(); ?>" <?php post_class(); ?>>

        <?php //Large first post 

          $args = array( 'numberposts' => '1' );
          $recent_posts = wp_get_recent_posts( $args );
          foreach( $recent_posts as $recent ){
            echo '<div class="row">
                    <div class="recent-post-post first-post col-xs-12">
                      <article class="recent-post-inner">
                        <a href="' . get_permalink($recent["ID"]) . '">';
                        if ( get_the_post_thumbnail($recent['ID']) != '' ) {
                          $thumb_id = get_post_thumbnail_id($recent['ID']);
                          $url = wp_get_attachment_url($thumb_id);
                          echo "<div class='recent-post-img' style='background-image: url(" . $url . ");'></div>";
                        }

            echo  '       <div class="recent-post-text">
                            <h4>' . $recent["post_title"] . '</h4>
                            <p class="recent-post-date">' . mysql2date('M j, Y',  $recent["post_date"]) . '</p>
                            <p class="recent-post-descripton">' . sanitize_text_field(substr($recent["post_content"], 0 , 150)) . '</p>
                          </div>
                        </a>
                      </article>
                    </div>
                  </div>';
          } ?>

          <div class="row">

            <?php //All the other posts after the 1st

            $args = array( 'offset' => 1 );
            $recent_posts = wp_get_recent_posts( $args );
            foreach( $recent_posts as $recent ){
              echo '<div class="recent-post-post col-xs-12 col-sm-3">
                      <article class="recent-post-inner">
                        <a href="' . get_permalink($recent["ID"]) . '">';
                        if ( get_the_post_thumbnail($recent['ID']) != '' ) {
                          $thumb_id = get_post_thumbnail_id($recent['ID']);
                          $url = wp_get_attachment_url($thumb_id);
                          echo "<div class='recent-post-img' style='background-image: url(" . $url . ");'></div>";
                        }

              echo '      <div class="recent-post-text">
                            <h4>' . $recent["post_title"] . '</h4>
                            <p class="recent-post-date">' . mysql2date('M j, Y',  $recent["post_date"]) . '</p>
                            <p class="recent-post-descripton">' . sanitize_text_field(substr($recent["post_content"], 0 , 150)) . '</p>
                          </div>
                        </a>
                      </article>
                    </div>';
            } ?>

          </div>



          <?php //All other posts 4 column ?>
          <div class="row">

<!--           foreach( $recent_posts as $recent ){
            echo '<div class="recent-post-post col-xs-12 col-sm-3">
                    <article class="recent-post-inner">
                      <a href="' . get_permalink($recent["ID"]) . '">';
                      if ( get_the_post_thumbnail($recent['ID']) != '' ) {
                        $thumb_id = get_post_thumbnail_id($recent['ID']);
                        $url = wp_get_attachment_url($thumb_id);
                        echo "<div class='recent-post-img' style='background-image: url(" . $url . ");'></div>";
                      }

            echo  '     <div class="recent-post-text">
                          <h4>' . $recent["post_title"] . '</h4>
                          <p class="recent-post-date">' . mysql2date('M j, Y',  $recent["post_date"]) . '</p>
                          <p class="recent-post-descripton">' . sanitize_text_field(substr($recent["post_content"], 0 , 150)) . '</p>
                        </div>
                      </a>
                    </article>
                  </div>';
          } -->

          </div>    


        </div> <?php //.blog ?>


      <div class="navigation">
        <span class="newer"><?php previous_posts_link(__('« Newer','example')) ?></span> <span class="older"><?php next_posts_link(__('Older »','example')) ?></span>
      </div><!-- /.navigation -->

    <?php else: ?>

    <div id="post-404" class="noposts">

      <p><?php _e('None found.','example'); ?></p>

    </div><!-- /#post-404 -->

  <?php endif; wp_reset_query(); ?>

  </div>

<?php get_footer(); ?>