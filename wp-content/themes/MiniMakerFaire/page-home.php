<?php
/*
* Template name: Home Page
*/

get_header();

  // Get the home template page ID
  $home_pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-home.php'
  ));
  foreach($home_pages as $home_page){
    $home_ID = $home_page->ID;
  } ?>

  <section class="slideshow-panel">

    <div class="header-logo-div text-center" itemprop="event" itemscope itemtype="http://schema.org/Event">
      <?php $faire_location = get_field('faire_location', $home_ID);
      if( $faire_location ): ?>
        <h2 class="event-location" itemprop="location"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $faire_location ?></h2> <?php
      endif;

      $faire_date = get_field('faire_date', $home_ID);
      if( $faire_date ): ?>
        <h2 class="event-date" itemprop="startDate"><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $faire_date ?></h2> <?php
      endif; ?>

      <img class="img-responsive header-logo" src="<?php echo get_theme_mod( 'header_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?> logo" />
      <?php $call_to_action_text = get_field('call_to_action_text', $home_ID);
            $call_to_action_text_url = get_field('call_to_action_text_url', $home_ID);
      if( $call_to_action_text ):
        if( $call_to_action_text_url ): ?>
          <a href="<?php echo $call_to_action_text_url ?>">
        <?php endif; ?>
        <h3 class="call_to_action_text"><?php echo $call_to_action_text ?></h3> <?php
        if( $call_to_action_text_url ): ?>
          </a>
        <?php endif;
      endif; ?>
    </div>

    <?php $images = get_field('image_carousel', $home_ID);
    if( $images ): ?>

      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <?php $i = 0;
          foreach( $images as $image ):
            if ($i == 0) { ?>
              <div class="item active">
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
              </div> <?php
            } else { ?>
              <div class="item">
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
              </div> <?php
            }
            $i++;
          endforeach; ?>
        </div>

        <?php if( $i > 1 ): ?>
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_left.png" alt="Image Carousel button left" />
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_right.png" alt="Image Carousel button right" />
            <span class="sr-only">Next</span>
          </a>
        <?php endif; ?>
      </div><!-- /.carousel -->

    <?php endif; ?>

  </section>

  <?php
  // check if the flexible content field has rows of data
  if( have_rows('home_page_panels', $home_ID)) {
    // loop through the rows of data
    while ( have_rows('home_page_panels', $home_ID) ) {
      the_row();
      $row_layout = get_row_layout();
      echo dispLayout($row_layout);
    }
  }
  ?>

  <?php // FIND OUT MORE PANEL
  $url1 = str_replace( "SITE_URL", esc_url( network_home_url() ), get_site_option( 'find-out-more-url1' ) );
  $url2 = str_replace( "SITE_URL", esc_url( network_home_url() ), get_site_option( 'find-out-more-url2' ) );
  ?>
  <aside class="fom-panel">
    <div class="container">
      <div class="row text-center">
        <div class="title-w-border-y">
          <h2 class="text-center">Find Out More</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-4 text-center">
          <a href="<?php echo $url1;?>" target="_blank">
            <img src="<?php echo get_site_option( 'find-out-more-img1' ); ?>" alt="Click here to get subscritions to Make: Magazine" class="img-responsive" />
          </a>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-4 text-center">
          <a href="<?php echo $url2;?>" target="_blank">
            <img src="<?php echo get_site_option( 'find-out-more-img2' ); ?>" alt="Click here to see our global Maker Faires" class="img-responsive" />
          </a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 text-center house-ad">
          <!-- /11548178/GlobalMakerFaire -->
          <div id='div-gpt-ad-1464723042021-2'>
            <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1464723042021-2'); });
            </script>
          </div>
        </div>
      </div>
    </div>
  </aside>

<?php get_footer(); ?>
