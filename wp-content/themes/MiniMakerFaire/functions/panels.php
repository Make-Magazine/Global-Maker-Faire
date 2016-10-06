<?php
/**************************************************/
/* Determine correct layout                       */
/**************************************************/
function dispLayout($row_layout) {
  $return = '';
  switch ($row_layout) {
    case 'featured_makers_panel':                // FEATURED MAKERS (SQUARE)
    case 'featured_makers_panel_dynamic':        // FEATURED MAKERS (SQUARE) - dynamic
    case 'featured_makers_panel_circle':         //featured makers (circle)
    case 'featured_makers_panel_circle_dynamic': //featured makers (circle) - dynamic
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = getFeatMkPanel($row_layout);
      }
      break;
    case 'featured_events':           //featured_events
    case 'featured_events_dynamic':   //featured_events - dynamic
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = getFeatEvPanel($row_layout);
      }
      break;
    case 'post_feed':
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = getPostFeed();
      }
      break;
    case '2_column_photo_and_text_panel': // 2 COLUMN LAYOUT
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = get2ColLayout();
      }
      break;
    case '1_column': // 1 COLUMN LAYOUT
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = get1ColLayout();
      }
      break;
    case 'what_is_maker_faire':   // WHAT IS MAKER FAIRE PANEL
      $return = getWhatisMF();
      break;
    case 'call_to_action_panel':  // CTA PANEL
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = getCTApanel();
      }
      break;
    case 'static_or_carousel': // IMAGE CAROUSEL (RECTANGLE)
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = getImgCarousel();
      }
      break;
    case 'square_image_carousel': // IMAGE CAROUSEL (SQUARE)
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = getImgCarouselSquare();
      }
      break;
    case 'newsletter_panel':  // NEWSLETTER PANEL
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = getNewsletterPanel();
      }
      break;
    case 'sponsors_panel':   // SPONSOR PANEL
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = getSponsorPanel();
      }
      break;
    case 'social_media': //social media panel
      $activeinactive = get_sub_field('activeinactive');
      if( $activeinactive == 'Active') {
        $return = getSocialPanel();
      }
      break;
  }
  return $return;
}

/**************************************************/
/*   Function to build the featured maker panel   */
/**************************************************/
function getFeatMkPanel($row_layout) {
  $dynamic = ($row_layout=='featured_makers_panel_dynamic' || $row_layout=='featured_makers_panel_circle_dynamic' ? true : false);
  $circle  = ($row_layout=='featured_makers_panel_circle'  || $row_layout=='featured_makers_panel_circle_dynamic' ? true : false);

  $makers_to_show     = get_sub_field('makers_to_show');
  $more_makers_button = get_sub_field('more_makers_button');
  $background_color   = (!$circle ? get_sub_field('background_color'): '');

  //set the class to featured-maker0panel-circle if a circle panel was selected
  //if not a circle panel, check if the background color selected was red
  echo '<section class="featured-maker-panel'.($circle?'-circle':($background_color == "Red"?' red-back':'')).'"> ';
  echo '<div class="container">';
  if(get_sub_field('title')){
    if($circle){
      echo '<div class="row padtop text-center">
              <img class="robot-head" src="' . get_bloginfo("template_directory") . '/img/news-icon.png" alt="News icon" />
              <div class="title-w-border-r">
                <h2>' . get_sub_field('title') . '</h2>
              </div>
            </div>';
    } else {
      echo '<div class="row text-center">
              <div class="title-w-border-y">
                <h2>' . get_sub_field('title') . '</h2>
              </div>
            </div>';
    }
  }

  echo '<div class="row padbottom">';

  //build makers array
  $makerArr = array();
  if($dynamic){
    $formIDarr = array_map('intval', explode(",", $formIDs));
    $search_criteria['status'] = 'active';
    $search_criteria['field_filters'][] = array( 'key' => '303', 'value' => 'Accepted');
    $search_criteria['field_filters'][] = array( 'key' => '304', 'value' => 'Featured Maker');

    $entries = GFAPI::get_entries(0, $search_criteria, null, array('offset' => 0, 'page_size' => 999));

    //randomly order entries
    shuffle ($entries);
    foreach($entries as $entry) {
      $projPhoto = $entry['22'];
      $fitPhoto  = legacy_get_fit_remote_image_url($projPhoto,262,234);
      if($fitPhoto==NULL) $fitPhoto = $projPhoto;

      $makerArr[] = array('image'      => array('url'=>$fitPhoto),
                          'name'       => $entry['151'],
                          'desc'       => $entry['16'],
                          'maker_url'  => '/maker/entry/'.$entry['id']
                          );
    }
  }else{
    // check if the nested repeater field has rows of data
    if( have_rows('featured_makers') ) {
      // loop through the rows of data
      while ( have_rows('featured_makers') ) {
        the_row();
        $makerArr[] = array('image'      => get_sub_field('maker_image'),
                            'name'       => get_sub_field('maker_name'),
                            'desc'       => get_sub_field('maker_short_description'),
                            'maker_url'  => get_sub_field('maker_url')
                          );
      }
    }
  } //end check dynamic

  //limit the number returned to $makers_to_show
  $makerArr = array_slice($makerArr, 0, $makers_to_show);

  //loop thru maker data and build the table
  foreach($makerArr as $maker) {
    if(!empty($maker['maker_url'])){
      echo '<a href="' . $maker['maker_url'] . '">';
    }

    echo '<div class="featured-maker col-xs-6 col-sm-3">
            <div class="maker-img" style="background-image: url(' . $maker['image']["url"] . ');">
            </div>
            <div class="maker-panel-text">
              <h4>' . $maker['name'] . '</h4>
              <p class="hidden-xs">' . $maker['desc'] . '</p>
            </div>
          </div>';

    if(!empty($maker['maker_url'])){
      echo '</a>';
    }
  }
  echo '</div>';  //end div.row

  //check if we should display a more maker button
  if(get_sub_field('more_makers_button')) {
    echo '<div class="row padbottom">
            <div class="col-xs-12 padbottom text-center">
              <a class="btn ' .($circle?'btn-b-ghost':'btn-w-ghost').'" href="' . $more_makers_button . '">More Makers</a>
            </div>
          </div>';
  }
  echo '</div>'; //end div.container
  echo '<div class="flag-banner"></div></section>';
}

/**************************************************/
/*   Function to build the featured event panel   */
/**************************************************/
function getFeatEvPanel($row_layout) {
  global $wpdb;
  $dynamic = ($row_layout=='featured_events_dynamic' ? true : false);
  echo '<section class="featured-events-panel">
          <div class="container">';
  if(get_sub_field('title')){
    echo '<div class="row padtop text-center">
            <div class="title-w-border-r">
              <h2>' . get_sub_field('title') . '</h2>
            </div>
          </div>';
  }

  echo '<div class="row padbottom">';

  //build event array
  $eventArr = array();
  if($dynamic){
    $formid = get_sub_field('enter_formid_here');
    $query = "SELECT schedule.entry_id, schedule.start_dt as time_start, schedule.end_dt as time_end, schedule.type,
              lead_detail.value as entry_status, DAYNAME(schedule.start_dt) as day,location.location,
              (select value from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND field_number like '304.3' and value like 'Featured Maker')  as flag,
              (select value from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND field_number like '22')  as photo,
              (select value from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND field_number like '151') as name,
              (select value from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND field_number like '16')  as short_desc
               FROM {$wpdb->prefix}mf_schedule as schedule
               left outer join {$wpdb->prefix}mf_location as location on location_id = location.id
               left outer join {$wpdb->prefix}rg_lead as lead on schedule.entry_id = lead.id
               left outer join {$wpdb->prefix}rg_lead_detail as lead_detail on
                   schedule.entry_id = lead_detail.lead_id and field_number = 303
               where lead.status = 'active' and lead_detail.value='Accepted'";

    foreach($wpdb->get_results($query) as $row){
      //only write schedule for featured events
      if($row->flag != NULL){
        $startDate = date_create($row->time_start);
        $startDate = date_format($startDate,'g:i a');

        $endDate = date_create($row->time_end);
        $endDate = date_format($endDate,'g:i a');

        $projPhoto = $row->photo;
        $fitPhoto  = legacy_get_fit_remote_image_url($projPhoto,230,181);
        if($fitPhoto==NULL) $fitPhoto = $projPhoto;
        $eventArr[] = array(
            'image'       => array('url'=>$fitPhoto),
            'event'       => $row->name,
            'description' => $row->short_desc,
            'day'         => $row->day,
            'time'        => $startDate.' - '.$endDate,
            'location'    => $row->location,
            'maker_url'  => '/maker/entry/'.$row->entry_id
          );
      }
    }
  } else {
    // check if the nested repeater field has rows of data
    if( have_rows('featured_events') ) {
      // loop through the rows of data
      while ( have_rows('featured_events') ) {
        the_row();
        $eventArr[] = array(
          'image'       => get_sub_field('event_image'),
          'event'       => get_sub_field('event_name'),
          'description' => get_sub_field('event_short_description'),
          'day'         => get_sub_field('day'),
          'time'        => get_sub_field('time'),
          'location'    => get_sub_field('location'),
          'maker_url'   => ''
        );
      }
    }
  }

  //build event display
  foreach($eventArr as $event) {
    echo '<div class="featured-event col-xs-6">'.
            ($event['maker_url']!=''?'<a href="'.$event['maker_url'].'">':'').
           '<div class="col-xs-12 col-sm-4 nopad">
              <div class="event-img" style="background-image: url(' . $event['image']["url"] . ');"></div>
            </div>
            <div class="col-xs-12 col-sm-8">
              <div class="event-description">
                <h4>' . $event['event'] . '</h4>
                <p class="event-desc">' . $event['description'] . '</p>
              </div>
              <div class="event-details">
                <p class="event-day">' . $event['day'] . ' '. $event['time'] . '</p>
                <p class="event-location">' . $event['location'] . '</p>
              </div>
            </div>'.
            ($event['maker_url']!=''?'</a>':'').
         '</div>';
  }

  echo '</div>'; //end div.row
  if(get_sub_field('all_events_button')) {
    $all_events_button = get_sub_field('all_events_button');
    echo '<div class="row padbottom">
            <div class="col-xs-12 padbottom text-center">
              <a class="btn btn-b-ghost" href="' . $all_events_button . '">All Events</a>
            </div>
          </div>';
  }
  echo '</div>'; //end div.container
  echo '<div class="flag-banner"></div></section>';
}

/************************************/
/*   Function to return post feed   */
/************************************/
function getPostFeed() {
  $post_feed_quantity = get_sub_field('post_quantity');
  $args = array( 'numberposts' => $post_feed_quantity, 'post_status' => 'publish' );
  $recent_posts = wp_get_recent_posts( $args );

  // Get the blog template page ID
  $news_pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'blog.php'
  ));
  foreach($news_pages as $news_page) {
    $news_ID = $news_page->ID;
  }
  $news_slug = get_post( $news_ID )->post_name;

  echo '<section class="recent-post-panel"><div class="container">';

  if(get_sub_field('title')) {
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
}

/******************************************************/
/*  Function to return 2_column_photo_and_text_panel  */
/******************************************************/
function get2ColLayout() {
  $column_1 = get_sub_field('column_1');
  $column_2 = get_sub_field('column_2');
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
}

/******************************************************/
/*  Function to return 2_column_photo_and_text_panel  */
/******************************************************/
function get1ColLayout() {
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

  if(get_sub_field('cta_button')) {
    echo '  <div class="row text-center padtop">
              <a class="btn btn-b-ghost" href="' . $cta_button_url . '">' . $cta_button . '</a>
            </div>';
  }

  echo '  </div>
          <div class="flag-banner"></div>
        </section>';
}

/******************************************************/
/*  Function to return WHAT IS MAKER FAIRE PANEL      */
/******************************************************/
function getWhatisMF() {
  $widget_radio = get_sub_field('show_what_is_maker_faire');
  if( $widget_radio == 'show') {
    echo '<section class="what-is-maker-faire">
            <div class="container">
              <div class="row text-center">
                <div class="title-w-border-y">
                  <h2>What is Maker Faire?</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">'
                  .get_site_option( 'what-is-makerfaire' ).
               '</div>
              </div>
            </div>
            <div class="wimf-border">
              <div class="wimf-triangle"></div>
            </div>
            <img src="' . get_bloginfo('template_directory') . '/img/makey.png" alt="Maker Faire information Makey icon" />
          </section>';
  }
}

/*********************************************/
/*  Function to return Call to Action panel  */
/*********************************************/
function getCTApanel() {
  $cta_title = get_sub_field('text');
  $cta_url = get_sub_field('url');
  $background_color = get_sub_field('background_color');

  echo '<section class="cta-panel'.($background_color == "Red"?' red-back':'').'">';
  echo '<div class="container">
          <div class="row text-center">
            <div class="col-xs-12">
              <h3><a href="' . $cta_url . '">' . $cta_title . ' <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
            </div>
          </div>
        </div>
      </section>';
}

/***************************************************/
/*  Function to return IMAGE CAROUSEL (RECTANGLE)  */
/***************************************************/
function getImgCarousel() {
  // IMAGE CAROUSEL (RECTANGLE)
  $width = get_sub_field('width');
  // check if the nested repeater field has rows of data
  if( have_rows('images') ) {

    echo '<section class="rectangle-image-carousel ';
    if ($width == 'Content Width') { echo 'container">'; } else { echo '">'; }
    echo     '<div id="carouselPanel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">';
    $i = 0;

    // loop through the rows of data
    while ( have_rows('images') ) {
      the_row();

      $text = get_sub_field('text');
      $url  = get_sub_field('url');
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
    } ?>

    </div> <!-- close carousel-inner-->

    <?php if( $i > 1 ){ ?>
      <a class="left carousel-control" href="#carouselPanel" role="button" data-slide="prev">
        <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_left.png" alt="Image Carousel button left" />
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carouselPanel" role="button" data-slide="next">
        <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_right.png" alt="Image Carousel button right" />
        <span class="sr-only">Next</span>
      </a>
<?php } ?>
          </div> <!-- close carouselPanel-->
        </section> <?php

  }
}

/***************************************************/
/*  Function to return IMAGE CAROUSEL (SQUARE)     */
/***************************************************/
function getImgCarouselSquare() {
  // IMAGE CAROUSEL (SQUARE)
  $width = get_sub_field('width');

  if( have_rows('images') ) {
    echo '<section class="square-image-carousel '.($width == 'Content Width' ? 'container nopad':'').'">';
    ?>

    <div class="mtm-carousel owl-carousel">
      <?php while ( have_rows('images') ) {
        the_row();

        $text  = get_sub_field('text');
        $url   = get_sub_field('url');
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
    </section>

    <script>
    jQuery( document ).ready(function() {
      // Carousel init
      jQuery('.square-image-carousel .mtm-carousel').owlCarousel({
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
      jQuery( ".square-image-carousel #right-trigger" ).click(function( event ) {
        event.preventDefault();
        jQuery( ".square-image-carousel .owl-next" ).click();
      });
      jQuery( ".square-image-carousel #left-trigger" ).click(function( event ) {
        event.preventDefault();
        jQuery( ".square-image-carousel .owl-prev" ).click();
      });
    });
    </script>
    <?php
  }
}

function getNewsletterPanel() {
    ?>
    <section class="newsletter-panel">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <p><strong>Stay in Touch:</strong><br />Get Local and Global Maker Faire Community updates.</p>
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
}


function getSponsorPanel() {
  // Get the sponsors template page ID
  $sponsor_pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-sponsors.php'
  ));
  foreach($sponsor_pages as $sponsor_page) {
    $sponsor_ID = $sponsor_page->ID;
  }

  $sponsor_panel_field_1 = get_sub_field('title_sponsor_panel');
  $sponsor_panel_field_3 = get_sub_field('become_a_sponsor_button');

  // check if the nested repeater field has rows of data
  if( have_rows('sponsors', $sponsor_ID)) {
    ?>
    <section class="sponsor-slide">
      <div class="container">
        <div class="row sponsor_panel_title">
          <div class="col-xs-12 text-center">
            <div class="title-w-border-r">
              <h2 class="sponsor-slide-title"><?php echo $sponsor_panel_field_1;?></h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div id="carousel-sponsors-slider" class="carousel slide" data-ride="carousel">
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox"><?php
                // loop through the rows of data
                while ( have_rows('sponsors', $sponsor_ID) ) {
                  the_row();
                  $sponsor_group_title = get_sub_field('sponsor_group_title'); //Sponsor group title

                  if( get_row_layout() == 'sponsors_with_image' ) {
                    $sub_field_3 = get_sub_field('sponsors_image_size'); //size option

                    // check if the nested repeater field has rows of data
                    if( have_rows('sponsors_with_image') ) { ?>
                      <div class="item">
                        <div class="row spnosors-row">
                          <div class="col-xs-12">
                            <?php
                            if(!empty($sponsor_group_title)) {
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
                                if( $sub_field_2 ) {
                                  echo '<a href="' . $sub_field_2 . '" target="_blank">';
                                }
                                echo '<img src="' . $sub_field_1 . '" alt="Maker Faire sponsor logo" class="img-responsive" />';
                                if( $sub_field_2 ) {
                                  echo '</a>';
                                }
                                echo '</div>';

                              }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                    } // end if image
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
              if(!empty($sponsor_panel_field_3)) {
                echo '<a href="' . $sponsor_panel_field_3 . '">Become a Sponsor</a><span>&bull;</span>';
              }
              ?>
              <a href="/sponsors">All Sponsors</a>
            </p>
          </div>
        </div>
      </div>
    </section>
    <script>
      jQuery(".sponsor-slide .carousel-inner .item:first-child").addClass("active");
      jQuery(function() {
        var title = jQuery(".item.active .sponsors-type").html();
      });
    </script><?php
  }
}

/***************************************************/
/*  Function to return Social Media Panel          */
/***************************************************/
function getSocialPanel() {
  if( have_rows('active_feeds') ) { ?>
    <section class="social-feeds-panel">
      <div class="container">
        <?php if( $panel_title ) { ?>
          <div class="row">
            <div class="col-xs-12 text-center">
              <div class="title-w-border-r">
                <h2><?php echo $panel_title; ?></h2>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="social-row"> <?php
          while ( have_rows('active_feeds') ) {
            the_row();

            if( get_row_layout() == 'facebook' ) {
              $facebook_title = get_sub_field('fb_title');
              $facebook_url = get_sub_field('facebook_url');
              $facebook_url_2 = rawurlencode($facebook_url);
              echo '
              <div class="social-panel-fb social-panel-feed">
                <h5>' . $facebook_title . '</h5>
                <iframe src="https://www.facebook.com/plugins/page.php?href=' . $facebook_url_2 . '&tabs=timeline&height=468&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
              </div>';

            } elseif( get_row_layout() == 'twitter' ) {
              $twitter_title = get_sub_field('tw_title');
              $twitter_id = get_sub_field('twitter_id');
              echo '
              <div class="social-panel-tw social-panel-feed">
                <div class="twitter-feed-parent">
                  <h5>' . $twitter_title . '</h5>
                  <script type="text/javascript" src="' . get_bloginfo('template_directory') . '/js/twitterFetcher.min.js"></script>
                  <h4>Tweets <span>by <a href="https://twitter.com/' . $twitter_id . '" target="_bank">@' . $twitter_id . '</a></span></h4>
                  <hr />
                  <div id="twitter-feed-body"></div>
                  <script>
                    var twitter_handle = "' . $twitter_id . '";
                    var configProfile = {
                      "profile": {"screenName": twitter_handle},
                      "domId": "twitter-feed-body",
                      "maxTweets": 10,
                      "enableLinks": true,
                      "showUser": true,
                      "showTime": true,
                      "showImages": true,
                      "lang": "en"
                    };
                    twitterFetcher.fetch(configProfile);
                  </script>
                </div>
              </div>';

            } elseif( get_row_layout() == 'instagram' ) {
              $instagram_title = get_sub_field('ig_title');
              $instagram_iframe = get_sub_field('instagram_iframe'); ?>
              <div class="social-panel-ig social-panel-feed">
                <h5><?php echo $instagram_title; ?></h5>
                <?php echo $instagram_iframe; ?>
              </div> <?php
            }
          }?>
        </div>
      </div>
    </section>
  <?php
  }
}