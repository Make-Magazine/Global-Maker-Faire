<?php
  // check if the flexible content field has rows of data
  if( have_rows('content_panels')) {
    // loop through the rows of data
    while ( have_rows('content_panels') ) {
      the_row();
      $panel = get_row_layout();
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active' ) {
        switch($panel) {
          case 'featured_makers_panel': // FEATURED MAKERS (SQUARE)
            $makers_to_show = get_sub_field('makers_to_show');
            $more_makers_button = get_sub_field('more_makers_button');
            $background_color = get_sub_field('background_color');
            echo '<section class="featured-maker-panel'.($background_color == "Red"?' red-back':'').'">';
            echo '<div class="container">';
            if(get_sub_field('title')) {
              echo '<div class="row text-center">
                      <div class="title-w-border-y">
                        <h2>' . get_sub_field('title') . '</h2>
                      </div>
                    </div>';
            }

            // check if the nested repeater field has rows of data
            if( have_rows('featured_makers') ) {
              echo '<div class="row padbottom">';
              // loop through the rows of data
              while ( have_rows('featured_makers') ) {
                the_row();
                $image = get_sub_field('maker_image');
                $maker = get_sub_field('maker_name');
                $decription = get_sub_field('maker_short_description');

                echo '<div class="featured-maker col-xs-6 col-sm-3">
                        <div class="maker-img" style="background-image: url(' . $image["url"] . ');">
                        </div>
                        <div class="maker-panel-text">
                          <h4>' . $maker . '</h4>
                          <p class="hidden-xs">' . $decription . '</p>
                        </div>
                      </div>';
              };
              echo '</div>';

              if(get_sub_field('more_makers_button')) {
                echo '<div class="row padbottom">
                        <div class="col-xs-12 padbottom text-center">
                          <a class="btn btn-w-ghost" href="' . $more_makers_button . '">More Makers</a>
                        </div>
                      </div>';
              }
              echo '</div><div class="flag-banner"></div></section>';
            } //if have rows featured maker
            break;
            
          case 'featured_makers_panel_dynamic':   // DYNAMIC FEATURED MAKERS (SQUARE)
            $more_makers_button = get_sub_field('more_makers_button');
            $background_color = get_sub_field('background_color');
            $formid = get_sub_field('enter_formid_here');
            echo '<section class="featured-maker-panel'.($background_color == "Red"?' red-back':'').'">';
            echo '<div class="container">';
            if(get_sub_field('title')){
              echo '<div class="row text-center">
                      <div class="title-w-border-y">
                        <h2>' . get_sub_field('title') . '</h2>
                      </div>
                    </div>';
            }

            echo '<div class="row padbottom">';
            //Add GF loop here
            //Add the GF data to these variables
            $image = 'http://lorempixel.com/400/400/technics/';
            $maker = 'Maker Name';
              $decription = 'Maker description';
              $maker_url = '#';

              if( $maker_url ) {
                echo '<a href="' . $maker_url . '">';
              }

              echo '<div class="featured-maker col-xs-6 col-sm-3">
                      <div class="maker-img" style="background-image: url(' . $image . ');">
                      </div>
                      <div class="maker-panel-text">
                        <h4>' . $maker . '</h4>
                        <p class="hidden-xs">' . $decription . '</p>
                      </div>
                    </div>';

              if( $maker_url ) {
                echo '</a>';
              }

            //End add GF loop here
            echo '</div>';
            if(get_sub_field('more_makers_button')) {
              echo '<div class="row padbottom">
                      <div class="col-xs-12 padbottom text-center">
                        <a class="btn btn-w-ghost" href="' . $more_makers_button . '">More Makers</a>
                      </div>
                    </div>';
            }
            echo '</div><div class="flag-banner"></div></section>';
            break;
          case 'featured_makers_panel_circle':  // FEATURED MAKERS (CIRCLE)
            $makers_to_show = get_sub_field('makers_to_show');
            $more_makers_button = get_sub_field('more_makers_button');
            echo '<section class="featured-maker-panel-circle">
                    <div class="container">';
            if(get_sub_field('title')) {
              echo '<div class="row padtop text-center">
                      <img class="robot-head" src="' . get_bloginfo("template_directory") . '/img/news-icon.png" alt="News icon" />
                      <div class="title-w-border-r">
                        <h2>' . get_sub_field('title') . '</h2>
                      </div>
                    </div>';
            }

            // check if the nested repeater field has rows of data
            if( have_rows('featured_makers') ) {
              echo '<div class="row padbottom">';
              // loop through the rows of data
              while ( have_rows('featured_makers') ) {
                the_row();
                $image = get_sub_field('maker_image');
                $maker = get_sub_field('maker_name');
                $decription = get_sub_field('maker_short_description');
                echo '<div class="featured-maker col-xs-6 col-sm-3">
                        <div class="maker-img" style="background-image: url(' . $image["url"] . ');">
                        </div>
                        <div class="maker-panel-text">
                          <h4>' . $maker . '</h4>
                          <p class="hidden-xs">' . $decription . '</p>
                        </div>
                      </div>';
              }
              echo '</div>';
              if(get_sub_field('more_makers_button')){
                echo '<div class="row padbottom">
                        <div class="col-xs-12 padbottom text-center">
                          <a class="btn btn-b-ghost" href="' . $more_makers_button . '">More Makers</a>
                        </div>
                      </div>';
              }
            }
            echo '</div><div class="flag-banner"></div></section>';
            break;
          case 'featured_makers_panel_circle_dynamic':  // DYNAMIC FEATURED MAKERS (CIRCLE)
            $more_makers_button = get_sub_field('more_makers_button');
            $formid = get_sub_field('enter_formid_here');
            echo '<section class="featured-maker-panel-circle">
                    <div class="container">';
            if(get_sub_field('title')){
              echo '<div class="row padtop text-center">
                      <img class="robot-head" src="' . get_bloginfo("template_directory") . '/img/news-icon.png" alt="News icon" />
                      <div class="title-w-border-r">
                        <h2>' . get_sub_field('title') . '</h2>
                      </div>
                    </div>';
            }
            echo '<div class="row padbottom">';
            //Add GF loop here
            //Add the GF data to these variables
            $image = 'http://lorempixel.com/400/400/technics/';
            $maker = 'Maker Name';
            $decription = 'Maker description';
            $maker_url = '#';
            if( $maker_url ) {
              echo '<a href="' . $maker_url . '">';
            }

            echo '<div class="featured-maker col-xs-6 col-sm-3">
                    <div class="maker-img" style="background-image: url(' . $image . ');">
                    </div>
                    <div class="maker-panel-text">
                      <h4>' . $maker . '</h4>
                      <p class="hidden-xs">' . $decription . '</p>
                    </div>
                  </div>';

            if( $maker_url ) {
              echo '</a>';
            }
            //End add GF loop here
            echo '</div>';
            if(get_sub_field('more_makers_button')) {
              echo '<div class="row padbottom">
                      <div class="col-xs-12 padbottom text-center">
                        <a class="btn btn-b-ghost" href="' . $more_makers_button . '">More Makers</a>
                      </div>
                    </div>';
            }

            echo '</div><div class="flag-banner"></div></section>';
            break;
          case 'featured_events': // FEATURED EVENTS
            $more_makers_button = get_sub_field('more_makers_button');
            echo '<section class="featured-events-panel">
                    <div class="container">';
            if(get_sub_field('title')) {
              echo '<div class="row padtop text-center">
                      <div class="title-w-border-r">
                        <h2>' . get_sub_field('title') . '</h2>
                      </div>
                    </div>';
            }

            // check if the nested repeater field has rows of data
            if( have_rows('featured_events') ) {
              echo '<div class="row padbottom">';
              // loop through the rows of data
              while ( have_rows('featured_events') ) {
                the_row();
                $image = get_sub_field('event_image');
                $event = get_sub_field('event_name');
                $decription = get_sub_field('event_short_description');
                $day = get_sub_field('day');
                $time = get_sub_field('time');
                $location = get_sub_field('location');
                echo '<div class="featured-event col-xs-6">
                        <div class="col-xs-12 col-sm-4 nopad">
                          <div class="event-img" style="background-image: url(' . $image["url"] . ');"></div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="event-description">
                            <p class="event-day">' . $day . '</p>
                            <h4>' . $event . '</h4>
                            <p class="event-desc">' . $decription . '</p>
                          </div>
                          <div class="event-details">
                            <p class="event-time">' . $time . '</p>
                            <p class="event-location">' . $location . '</p>
                          </div>
                        </div>
                      </div>';
              }
              echo '</div>';
              if(get_sub_field('all_events_button')) {
                $all_events_button = get_sub_field('all_events_button');
                echo '<div class="row padbottom">
                        <div class="col-xs-12 padbottom text-center">
                          <a class="btn btn-b-ghost" href="' . $all_events_button . '">All Events</a>
                        </div>
                      </div>';
              }
            }
            echo '</div><div class="flag-banner"></div></section>';
            break;
          case 'featured_events_dynamic':    // DYNAMIC FEATURED EVENTS
            $panel_title = get_sub_field('title');
            $all_events_button = get_sub_field('all_events_button');
            $formid = get_sub_field('enter_formid_here');
            echo '<section class="featured-events-panel">
                    <div class="container">';
            if( $panel_title ){
              echo '<div class="row padtop text-center">
                      <div class="title-w-border-r">
                        <h2>' . $panel_title . '</h2>
                      </div>
                    </div>';
            }

            echo '<div class="row padbottom">';
            //Add GF loop here
            //Add the GF data to these variables
            $image = 'http://lorempixel.com/400/400/technics/';
            $event = 'Event Name Here';
            $decription = 'Description goes here.';
            $day = 'Day';
            $time = 'Time';
            $location = 'location';

            echo '<div class="featured-event col-xs-6">
                    <div class="col-xs-12 col-sm-4 nopad">
                      <div class="event-img" style="background-image: url(' . $image . ');"></div>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                      <div class="event-description">
                        <p class="event-day">' . $day . '</p>
                        <h4>' . $event . '</h4>
                        <p class="event-desc">' . $decription . '</p>
                      </div>
                      <div class="event-details">
                        <p class="event-time">' . $time . '</p>
                        <p class="event-location">' . $location . '</p>
                      </div>
                    </div>
                  </div>';

            //End add GF loop here

            echo '</div>';

            if( $all_events_button ) {
              echo '<div class="row padbottom">
                      <div class="col-xs-12 padbottom text-center">
                        <a class="btn btn-b-ghost" href="' . $all_events_button . '">All Events</a>
                      </div>
                    </div>';
            }

            echo '</div><div class="flag-banner"></div></section>';
            break;
          case 'post_feed':   // RECENT POSTS
            $post_feed_quantity = get_sub_field('post_quantity');
            $args = array( 'numberposts' => $post_feed_quantity, 'post_status' => 'publish' );
            $recent_posts = wp_get_recent_posts( $args );

            // Get the blog template page ID
            $news_pages = get_pages(array(
              'meta_key' => '_wp_page_template',
              'meta_value' => 'blog.php'
            ));
            foreach($news_pages as $news_page){
              $news_ID = $news_page->ID;
            }
            $news_slug = get_post( $news_ID )->post_name;

            echo '<section class="recent-post-panel"><div class="container">';

            if(get_sub_field('title')){
              echo '<div class="row padbottom text-center">
                      <img class="robot-head" src="' . get_bloginfo("template_directory") . '/img/news-icon.png" alt="News icon" />
                      <div class="title-w-border-r">
                        <h2>' . get_sub_field('title') . '</h2>
                      </div>
                    </div>';
            }

            echo '<div class="row">';

            foreach( $recent_posts as $recent ) {
              echo '<div class="recent-post-post col-xs-12 col-sm-3">
                      <article class="recent-post-inner">
                        <a href="' . get_permalink($recent["ID"]) . '">';
              if ( get_the_post_thumbnail($recent['ID']) != '' ) {
                $thumb_id = get_post_thumbnail_id($recent['ID']);
                $url = wp_get_attachment_url($thumb_id);
                echo "<div class='recent-post-img' style='background-image: url(" . $url . ");'></div>";
              } else {
                echo get_first_post_image($recent);
              }

              echo  '     <div class="recent-post-text">
                            <h4>' . $recent["post_title"] . '</h4>
                            <p class="recent-post-date">' . mysql2date('M j, Y',  $recent["post_date"]) . '</p>
                            <p class="recent-post-descripton">' . substr(wp_strip_all_tags($recent["post_content"]), 0 , 150) . '</p>
                          </div>
                        </a>
                      </article>
                    </div>';
            }

            echo '<div class="col-xs-12 padtop padbottom text-center">
                    <a class="btn btn-b-ghost" href="/' . $news_slug . '">More News</a>
                  </div>';

            echo '</div></div><div class="flag-banner"></div></section>';
            break;
          case '2_column_photo_and_text_panel': // 2 COLUMN LAYOUT
            $column_1 = get_sub_field('column_1');
            $column_2 = get_sub_field('column_2');
            $cta_button = get_sub_field('cta_button');
            $cta_button_url = get_sub_field('cta_button_url');
            echo '<section class="content-panel">
                    <div class="container">';

            if(get_sub_field('title')){
              echo '  <div class="row">
                        <div class="col-xs-12 text-center padbottom">
                          <h2>' . get_sub_field('title') . '</h2>
                        </div>
                      </div>';
            }

            echo '    <div class="row">
                        <div class="col-sm-6">' . $column_1 . '</div>
                        <div class="col-sm-6">' . $column_2 . '</div>
                      </div>';

            if(get_sub_field('cta_button')){
              echo '  <div class="row text-center padtop">
                        <a class="btn btn-b-ghost" href="' . $cta_button_url . '">' . $cta_button . '</a>
                      </div>';
            }

            echo '  </div>
                    <div class="flag-banner"></div>
                  </section>';
            break;
          case '1_column':    // 1 COLUMN LAYOUT
            $column_1 = get_sub_field('column_1');
            $cta_button = get_sub_field('cta_button');
            $cta_button_url = get_sub_field('cta_button_url');
            echo '<section class="content-panel">
                    <div class="container">';

            if(get_sub_field('title')) {
              echo '  <div class="row">
                        <div class="col-xs-12 text-center padbottom">
                          <h2>' . get_sub_field('title') . '</h2>
                        </div>
                      </div>';
            }

            echo '    <div class="row">
                        <div class="col-xs-12">' . $column_1 . '</div>
                      </div>';

            if(get_sub_field('cta_button')){
              echo '  <div class="row text-center padtop">
                        <a class="btn btn-b-ghost" href="' . $cta_button_url . '">' . $cta_button . '</a>
                      </div>';
            }

            echo '  </div>
                    <div class="flag-banner"></div>
                  </section>';
            break;
          case  'what_is_maker_faire': // WHAT IS MAKER FAIRE PANEL
            $widget_radio = get_sub_field('show_what_is_maker_faire');
            if( $widget_radio == 'show' ) {
              echo '<section class="what-is-maker-faire">
                      <div class="container">
                        <div class="row text-center">
                          <div class="title-w-border-y">
                            <h2>What is Maker Faire?</h2>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-10 col-md-offset-1">
                            <p class="text-center">Maker Faire is a gathering of fascinating, curious people who enjoy learning and who love sharing what they can do. From engineers to artists to scientists to crafters, Maker Faire is a venue to for these “makers” to show hobbies, experiments, projects.</p>
                            <p class="text-center">We call it the Greatest Show (& Tell) on Earth — a family-friendly showcase of invention, creativity, and resourcefulness.</p>
                            <p class="text-center">Glimpse the future and get inspired!</p>
                          </div>
                        </div>
                      </div>
                      <div class="wimf-border">
                        <div class="wimf-triangle"></div>
                      </div>
                      <img src="' . get_bloginfo('template_directory') . '/img/makey.png" alt="Maker Faire information Makey icon" />
                    </section>';
            }
            break;
          case 'call_to_action_panel': // CTA PANEL
            $cta_title = get_sub_field('text');
            $cta_url = get_sub_field('url');
            $background_color = get_sub_field('background_color');
            echo '<section class="cta-panel" ';
            if( $background_color == "Red" ):
              echo 'style="background: -webkit-linear-gradient(left,#930d14,#B52A31,#930d14);background: linear-gradient(to right,#930d14,#B52A31,#930d14);"';
            endif;
            echo '>
                    <div class="container">
                      <div class="row text-center">
                        <div class="col-xs-12">
                          <h3><a href="' . $cta_url . '">' . $cta_title . ' <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
                        </div>
                      </div>
                    </div>
                  </section>';
            break;
          case 'static_or_carousel':  // IMAGE CAROUSEL (RECTANGLE)
            $width = get_sub_field('width');
            // check if the nested repeater field has rows of data
            if( have_rows('images') ) { ?>
              <section class="rectangle-image-carousel <?php echo ($width == 'Content Width' ? 'container' : '');?>">
                <div id="carouselPanel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner" role="listbox">
                    <?php
                    $i = 0;

                    // loop through the rows of data
                    while ( have_rows('images') ) {
                      the_row();
                      $text = get_sub_field('text');
                      $url = get_sub_field('url');
                      $image = get_sub_field('image');

                      if ($i == 0) { ?>
                        <div class="item active">
                          <?php if(get_sub_field('url')){ ?>
                            <a href="<?php echo $url ?>">
                          <?php } ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            <?php if (get_sub_field('text')){ ?>
                              <div class="carousel-caption">
                                <h3><?php echo $text; ?></h3>
                              </div>
                            <?php }
                          if(get_sub_field('url')){
                            echo '</a>';
                          } ?>
                        </div> <?php
                      } else { ?>
                        <div class="item">
                          <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                          <div class="carousel-caption">
                            <h3><?php echo $text; ?></h3>
                          </div>
                        </div> <?php
                      }
                      $i++;
                    } //end while ?>
                  </div> <!-- //carousel-inner -->
                  <?php if( $i > 1 ) { ?>
                    <a class="left carousel-control" href="#carouselPanel" role="button" data-slide="prev">
                      <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_left.png" alt="Image Carousel button left" />
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carouselPanel" role="button" data-slide="next">
                      <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_right.png" alt="Image Carousel button right" />
                      <span class="sr-only">Next</span>
                    </a>
                  <?php } ?>
                </div><!-- /.carousel -->
              </section> <?php
            } //end check for images
            break;
          case 'square_image_carousel':   // IMAGE CAROUSEL (SQUARE)
            $width = get_sub_field('width');

            if( have_rows('images') ) { ?>
              <section class="square-image-carousel<?php echo ($width == 'Content Width' ?' container nopad': ''); ?>">
                <div class="mtm-carousel owl-carousel">
                  <?php while ( have_rows('images') ) {
                    the_row();
                    $text = get_sub_field('text');
                    $url = get_sub_field('url');
                    $image = get_sub_field('image'); ?>
                    <div class="mtm-car-image" style="background: url('<?php echo $image["url"]; ?>') no-repeat center center;background-size: cover;"></div>
                  <?php } ?>
                </div>

                <a id="left-trigger" class="left carousel-control" href="#" role="button" data-slide="prev">
                  <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_left.png" alt="Image Carousel button left" />
                  <span class="sr-only">Previous</span>
                </a>
                <a id="right-trigger" class="right carousel-control" href="#" role="button" data-slide="next">
                  <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_right.png" alt="Image Carousel button right" />
                  <span class="sr-only">Next</span>
                </a>

                <script>
                jQuery( document ).ready(function() {
                  // Carousel init
                  jQuery('.mtm-carousel').owlCarousel({
                    center: true,
                    autoWidth:true,
                    items:2,
                    loop:true,
                    margin:0,
                    nav:true,
                    //navContainer:true,
                    autoplay:true,
                    autoplayHoverPause:true,
                    responsive:{
                      600:{
                        items:3
                      }
                    }
                  });
                  // Carousel left right
                  jQuery( "#right-trigger" ).click(function( event ) {
                    event.preventDefault();
                    jQuery( ".owl-next" ).click();
                  });
                  jQuery( "#left-trigger" ).click(function( event ) {
                    event.preventDefault();
                    jQuery( ".owl-prev" ).click();
                  });
                });
                </script>
              </section>
            <?php
            } //end if( have_rows('images') )
            break;
          case 'newsletter_panel': // NEWSLETTER PANEL

            ?>
            <section class="newsletter-panel">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <p><strong>Stay in Touch:</strong> Get Local and Global Maker Faire Community updates.</p>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <form class="form-inline sub-form whatcounts-signup1" action="http://whatcounts.com/bin/listctrl" method="POST">
                      <input type="hidden" name="slid_1" value="6B5869DC547D3D46E66DEF1987C64E7A" /><!-- Maker Faire Newsletter -->
                      <input type="hidden" name="slid_2" value="6B5869DC547D3D46941051CC68679543" /><!-- Maker Media Newsletter -->
                      <input type="hidden" name="multiadd" value="1" />
                      <input type="hidden" name="cmd" value="subscribe" />
                      <input type="hidden" name="custom_source" value="footer" />
                      <input type="hidden" name="custom_incentive" value="none" />
                      <input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
                      <input type="hidden" id="format_mime" name="format" value="mime" />
                      <input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
                      <input id="wc-email" class="form-control nl-panel-input" name="email" placeholder="Enter your Email" required type="email">
                      <input class="form-control btn-w-ghost" value="GO" type="submit">
                    </form>
                  </div>
                </div>
              </div>
            </section>

            <div class="fancybox-thx" style="display:none;">
              <div class="col-sm-4 hidden-xs nl-modal">
                <span class="fa-stack fa-4x">
                  <i class="fa fa-circle-thin fa-stack-2x"></i>
                  <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
                </span>
              </div>
              <div class="col-sm-8 col-xs-12 nl-modal">
                <h3>Awesome!</h3>
                <p>Thanks for signing up.</p>
              </div>
              <div class="clearfix"></div>
            </div>

            <script>
              jQuery(document).ready(function(){
                jQuery(".fancybox-thx").fancybox({
                  autoSize : false,
                  width  : 400,
                  autoHeight : true,
                  padding : 0,
                  afterLoad   : function() {
                    this.content = this.content.html();
                  }
                });
                jQuery(document).on('submit', '.whatcounts-signup1', function (e) {
                  e.preventDefault();
                  var bla = jQuery('#wc-email').val();
                  globalNewsletterSignup(bla);
                  jQuery.post('http://whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup1').serialize());
                  jQuery('.fancybox-thx').trigger('click');
                  //jQuery('.nl-modal-email-address').text(bla);
                  //jQuery('.whatcounts-signup2 #email').val(bla);
                });
              });
            </script>
            <?php
            break;
          case 'sponsors_panel' : // SPONSOR PANEL
            // Get the sponsors template page ID
            $sponsor_pages = get_pages(array(
              'meta_key' => '_wp_page_template',
              'meta_value' => 'page-sponsors.php'
            ));
            foreach($sponsor_pages as $sponsor_page){
              $sponsor_ID = $sponsor_page->ID;
            }

            $sponsor_panel_field_1 = get_sub_field('title_sponsor_panel');
            $sponsor_panel_field_3 = get_sub_field('become_a_sponsor_button');

            // check if the nested repeater field has rows of data
            if( have_rows('sponsors', $sponsor_ID) ) {  ?>
              <section class="sponsor-slide">
                <div class="container">
                  <div class="row sponsor_panel_title">
                    <div class="col-xs-12 text-center">
                      <div class="title-w-border-r">
                        <h2 class="sponsor-slide-title"><?php echo $sponsor_panel_field_1; ?></h2>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <div id="carousel-sponsors-slider" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                          <?php
                          // loop through the rows of data
                          while ( have_rows('sponsors', $sponsor_ID) ) {
                            the_row();
                            $sponsor_group_title = get_sub_field('sponsor_group_title'); //Sponsor group title
                            if( get_row_layout() == 'sponsors_with_image' ) {
                              $sub_field_3 = get_sub_field('sponsors_image_size'); //size option
                              // check if the nested repeater field has rows of data
                              if( have_rows('sponsors_with_image') ) {  ?>
                                <div class="item">
                                  <div class="row spnosors-row">
                                    <div class="col-xs-12">';
                                      <?php
                                      if(!empty($sponsor_group_title)){
                                        echo '<h5 class="text-center sponsors-type">' . $sponsor_group_title . '</h5>';
                                      }
                                      ?>
                                      <div class="sponsors-box">
                                        <?php
                                        // loop through the rows of data
                                        while ( have_rows('sponsors_with_image') ) {
                                          the_row();
                                          $sub_field_1 = get_sub_field('image'); //Photo
                                          $sub_field_2 = get_sub_field('url'); //URL
                                          echo '<div class="' . $sub_field_3 . '">';
                                          if( get_sub_field('url') ) {
                                            echo '<a href="' . $sub_field_2 . '" target="_blank">';
                                          }
                                          echo '<img src="' . $sub_field_1 . '" alt="Maker Faire sponsor logo" class="img-responsive" />';
                                          if( get_sub_field('url') ) {
                                            echo '</a>';
                                          }
                                          echo '</div>';
                                        } //end while
                                       ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                              } // end have_rows('sponsors_with_image'
                            } // end row layout
                          }
                        ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row sponsor_panel_bottom">
                    <div class="col-xs-12 text-center">
                      <p>
                        <?php
                        if(!empty($sponsor_panel_field_3))
                          echo '<a href="' . $sponsor_panel_field_3 . '">Become a Sponsor</a><span>&bull;</span>';
                        ?>
                        <a href="/sponsors">All Sponsors</a>
                      </p>
                    </div>
                  </div>
                </div> <!-- //end .container -->
              </section>
              <script>
                jQuery(".sponsor-slide .carousel-inner .item:first-child").addClass("active");
                jQuery(function() {
                  var title = jQuery(".item.active .sponsors-type").html();
                });
              </script>
              <?php
            }
            break;
          default;
            ?><!-- no layout found--><?php
            break;
        }
      } //end if active/inactive check
    } //   end while have_rows
  } // end have_rows('content_panels')
?>