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
    case 'call_to_action':  // CTA PANEL
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
  $return  = '';
  $dynamic = ($row_layout=='featured_makers_panel_dynamic' || $row_layout=='featured_makers_panel_circle_dynamic' ? true : false);
  $circle  = ($row_layout=='featured_makers_panel_circle'  || $row_layout=='featured_makers_panel_circle_dynamic' ? true : false);

  $makers_to_show     = get_sub_field('makers_to_show');
  $more_makers_button = get_sub_field('more_makers_button');
  $background_color   = (!$circle ? get_sub_field('background_color'): '');

  //set the class to featured-maker0panel-circle if a circle panel was selected
  //if not a circle panel, check if the background color selected was red
  $return .= '<section class="featured-maker-panel'.($circle?'-circle':($background_color == "Red"?' red-back':'')).'"> ';
  $return .=  '<div class="container">';
  if(get_sub_field('title')){
    if($circle){
      $return .=  '<div class="row padtop text-center">
              <img class="robot-head" src="' . get_bloginfo("template_directory") . '/img/news-icon.png" alt="News icon" />
              <div class="title-w-border-r">
                <h2>' . get_sub_field('title') . '</h2>
              </div>
            </div>';
    } else {
      $return .=  '<div class="row text-center">
              <div class="title-w-border-y">
                <h2>' . get_sub_field('title') . '</h2>
              </div>
            </div>';
    }
  }

  $return .=  '<div class="row padbottom">';

  //build makers array
  $makerArr = array();
  if($dynamic){
    $formid = (int) get_sub_field('enter_formid_here');

    $search_criteria['status'] = 'active';
    $search_criteria['field_filters'][] = array( 'key' => '303', 'value' => 'Accepted');
    $search_criteria['field_filters'][] = array( 'key' => '304', 'value' => 'Featured Maker');

    $entries = GFAPI::get_entries($formid, $search_criteria, null, array('offset' => 0, 'page_size' => 999));

    //randomly order entries
    shuffle ($entries);
    foreach($entries as $entry) {
      $url = $entry['22'];
      $args = array(
        'resize' => '300,300',
        'quality' => '80',
        'strip' => 'all',
      );
      $photon = jetpack_photon_url($url, $args);

      $makerArr[] = array('image'      => $photon,
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
        $url = get_sub_field('maker_image');
        $args = array(
          'resize' => '300,300',
          'quality' => '80',
          'strip' => 'all',
        );
        $photon = jetpack_photon_url($url['url'], $args);
        $makerArr[] = array('image'      => $photon,
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
      $return .=  '<a href="' . $maker['maker_url'] . '">';
    }

    $return .=  '<div class="featured-maker col-xs-6 col-sm-3">
            <div class="maker-img" style="background-image: url(' . $maker['image'] . ');">
            </div>
            <div class="maker-panel-text">
              <h4>' . $maker['name'] . '</h4>
              <p class="hidden-xs">' . $maker['desc'] . '</p>
            </div>
          </div>';

    if(!empty($maker['maker_url'])){
      $return .=  '</a>';
    }
  }
  $return .=  '</div>';  //end div.row

  //check if we should display a more maker button
  if(get_sub_field('more_makers_button')) {
    $return .=  '<div class="row padbottom">
            <div class="col-xs-12 padbottom text-center">
              <a class="btn ' .($circle?'btn-b-ghost':'btn-w-ghost').'" href="' . $more_makers_button . '">'.__('More Makers','MiniMakerFaire').'</a>
            </div>
          </div>';
  }
  $return .=  '</div>'; //end div.container
  $return .=  '<div class="flag-banner"></div></section>';
  return $return;
}

/**************************************************/
/*   Function to build the featured event panel   */
/**************************************************/
function getFeatEvPanel($row_layout) {
  global $wpdb;
  $return = '';
  $dynamic = ($row_layout=='featured_events_dynamic' ? true : false);
  $return .=  '<section class="featured-events-panel">
          <div class="container">';
  if(get_sub_field('title')){
    $return .=  '<div class="row padtop text-center">
            <div class="title-w-border-r">
              <h2>' . get_sub_field('title') . '</h2>
            </div>
          </div>';
  }

  $return .=  '<div class="row padbottom">';

  //build event array
  $eventArr = array();
  if($dynamic){
    $formid = get_sub_field('enter_formid_here');
    $query = "SELECT schedule.entry_id, schedule.start_dt as time_start, schedule.end_dt as time_end, schedule.type,
              lead_detail.value as entry_status, DAYNAME(schedule.start_dt) as day,location.location,
              (select value from {$wpdb->prefix}gf_entry_meta where entry_id = schedule.entry_id AND field_number like '304.3' and value like 'Featured Maker')  as flag,
              (select value from {$wpdb->prefix}gf_entry_meta where entry_id = schedule.entry_id AND field_number like '22')  as photo,
              (select value from {$wpdb->prefix}gf_entry_meta where entry_id = schedule.entry_id AND field_number like '151') as name,
              (select value from {$wpdb->prefix}gf_entry_meta where entry_id = schedule.entry_id AND field_number like '16')  as short_desc
               FROM {$wpdb->prefix}mf_schedule as schedule
               left outer join {$wpdb->prefix}mf_location as location on location_id = location.id
               left outer join {$wpdb->prefix}gf_entry as lead on schedule.entry_id = lead.id
               left outer join {$wpdb->prefix}gf_entry_meta as lead_detail on
                   schedule.entry_id = lead_detail.entry_id and field_number = 303
               where lead.status = 'active' and lead_detail.value='Accepted'";

    foreach($wpdb->get_results($query) as $row){
      //only write schedule for featured events
      if($row->flag != NULL){
        $startDate = date_create($row->time_start);
        $startDate = date_format($startDate,'g:i a');

        $endDate = date_create($row->time_end);
        $endDate = date_format($endDate,'g:i a');

        $projPhoto = $row->photo;
        $args = array(
          'resize' => '300,300',
          'quality' => '80',
          'strip' => 'all',
        );
        $photon = jetpack_photon_url($projPhoto, $args);
        $eventArr[] = array(
            'image'       => $photon,
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
        $url = get_sub_field('event_image');
        $args = array(
          'resize' => '300,300',
          'quality' => '80',
          'strip' => 'all',
        );
        $photon = jetpack_photon_url($url['url'], $args);
        $eventArr[] = array(
          'image'       => $photon,
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
    $return .=  '<div class="featured-event col-xs-6">'.
            ($event['maker_url']!=''?'<a href="'.$event['maker_url'].'">':'').
           '<div class="col-xs-12 col-sm-4 nopad">
              <div class="event-img" style="background-image: url(' . $event['image'] . ');"></div>
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

  $return .=  '</div>'; //end div.row
  if(get_sub_field('all_events_button')) {
    $all_events_button = get_sub_field('all_events_button');
    $return .=  '<div class="row padbottom">
            <div class="col-xs-12 padbottom text-center">
              <a class="btn btn-b-ghost" href="' . $all_events_button . '">All Events</a>
            </div>
          </div>';
  }
  $return .=  '</div>'; //end div.container
  $return .=  '<div class="flag-banner"></div></section>';
  return $return;
}

/************************************/
/*   Function to return post feed   */
/************************************/
function getPostFeed() {
  $return = '';
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
  if(isset($news_ID)){
    $news_slug = get_post( $news_ID )->post_name;
  }
  $return .=  '<section class="recent-post-panel"><div class="container">';

  if(get_sub_field('title')) {
    $return .=  '<div class="row padbottom text-center">
            <img class="robot-head" src="' . get_bloginfo("template_directory") . '/img/news-icon.png" alt="News icon" />
            <div class="title-w-border-r">
              <h2>' . get_sub_field('title') . '</h2>
            </div>
          </div>';
  }

  $return .=  '<div class="row">';

  foreach( $recent_posts as $recent ) {
    $return .=  '<div class="recent-post-post col-xs-12 col-sm-3">
            <article class="recent-post-inner">
              <a href="' . get_permalink($recent["ID"]) . '">';
    if ( get_the_post_thumbnail($recent['ID']) != '' ) {
      $thumb_id = get_post_thumbnail_id($recent['ID']);
      $url = wp_get_attachment_url($thumb_id);
      $args = array(
        'resize' => '300,300',
        'quality' => '80',
        'strip' => 'all',
      );
      $photon = jetpack_photon_url($url, $args);
      $return .=  "<div class='recent-post-img' style='background-image: url(" . $photon . ");'></div>";
    } else {
      $return .=  get_first_post_image($recent);
    }

    $return .=   '     <div class="recent-post-text">
                  <h4>' . $recent["post_title"] . '</h4>
                  <p class="recent-post-date">' . mysql2date('M j, Y',  $recent["post_date"]) . '</p>
                  <p class="recent-post-descripton">' . substr(wp_strip_all_tags($recent["post_content"]), 0 , 150) . '</p>
                </div>
              </a>
            </article>
          </div>';
  }
  if(isset($news_slug)){
    $return .=  '<div class="col-xs-12 padtop padbottom text-center">
            <a class="btn btn-b-ghost" href="/' . $news_slug . '">'.__('More News','MiniMakerFaire').'</a>
          </div>';
  }
  $return .=  '</div></div><div class="flag-banner"></div></section>';
  return $return;
}

/******************************************************/
/*  Function to return 2_column_photo_and_text_panel  */
/******************************************************/
function get2ColLayout() {
  $return = '';
  $column_1 = get_sub_field('column_1');
  $column_2 = get_sub_field('column_2');
  $cta_button = get_sub_field('cta_button');
  $cta_button_url = get_sub_field('cta_button_url');
  $return .=  '<section class="content-panel">
          <div class="container">';

  if(get_sub_field('title')) {
    $return .=  '  <div class="row">
              <div class="col-xs-12 text-center padbottom">
                <h2>' . get_sub_field('title') . '</h2>
              </div>
            </div>';
  }

  $return .=  '    <div class="row">
              <div class="col-sm-6">' . $column_1 . '</div>
              <div class="col-sm-6">' . $column_2 . '</div>
            </div>';

  if(get_sub_field('cta_button')){
    $return .=  '  <div class="row text-center padtop">
              <a class="btn btn-b-ghost" href="' . $cta_button_url . '">' . $cta_button . '</a>
            </div>';
  }

  $return .=  '  </div>
          <div class="flag-banner"></div>
        </section>';
  return $return;
}

/******************************************************/
/*  Function to return 2_column_photo_and_text_panel  */
/******************************************************/
function get1ColLayout() {
  $return = '';
  $column_1 = get_sub_field('column_1');
  $cta_button = get_sub_field('cta_button');
  $cta_button_url = get_sub_field('cta_button_url');
  $return .=  '<section class="content-panel">
          <div class="container">';

  if(get_sub_field('title')) {
    $return .=  '  <div class="row">
              <div class="col-xs-12 text-center padbottom">
                <h2>' . get_sub_field('title') . '</h2>
              </div>
            </div>';
  }

  $return .=  '    <div class="row">
              <div class="col-xs-12">' . $column_1 . '</div>
            </div>';

  if(get_sub_field('cta_button')) {
    $return .=  '  <div class="row text-center padtop">
              <a class="btn btn-b-ghost" href="' . $cta_button_url . '">' . $cta_button . '</a>
            </div>';
  }

  $return .=  '  </div>
          <div class="flag-banner"></div>
        </section>';
  return $return;
}

/******************************************************/
/*  Function to return WHAT IS MAKER FAIRE PANEL      */
/******************************************************/
function getWhatisMF() {
  $return = '';
  $widget_radio = get_sub_field('show_what_is_maker_faire');
  if( $widget_radio == 'show') {
    $return .=  '<section class="what-is-maker-faire">
            <div class="container">
              <div class="row text-center">
                <div class="title-w-border-y">
                  <h2>'.__('What is Maker Faire?','MiniMakerFaire').'</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <p class="text-center">'.
                    __('Maker Faire is a gathering of fascinating, curious people who enjoy learning and who love sharing what they can do. From engineers to artists to scientists to crafters, Maker Faire is a venue for these "makers" to show hobbies, experiments, projects.','MiniMakerFaire') .
                  '</p>'.
                  '<p class="text-center">'.
                    __('We call it the Greatest Show (& Tell) on Earth - a family-friendly showcase of invention, creativity, and resourcefulness.','MiniMakerFaire').
                  '</p>'.
                  '<p class="text-center">'.
                    __('Glimpse the future and get inspired!','MiniMakerFaire') .
                  '</p>'.
                  //.get_site_option( 'what-is-makerfaire' ).
               '</div>
              </div>
            </div>
            <div class="wimf-border">
              <div class="wimf-triangle"></div>
            </div>
            <img src="' . get_bloginfo('template_directory') . '/img/makey.png" alt="Maker Faire information Makey icon" />
          </section>';
  }
  return $return;
}

/*********************************************/
/*  Function to return Call to Action panel  */
/*********************************************/
function getCTApanel() {
  $return           = '';
  $cta_title        = get_sub_field('text');
  $cta_url          = get_sub_field('url');
  $background_color = get_sub_field('background_color');

  $return .=  '<section class="cta-panel'.($background_color == "Red"?' red-back':'').'">';
  $return .=  '<div class="container">
          <div class="row text-center">
            <div class="col-xs-12">
              <h3><a href="' . $cta_url . '">' . $cta_title . ' <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
            </div>
          </div>
        </div>
      </section>';
  return $return;
}

/***************************************************/
/*  Function to return IMAGE CAROUSEL (RECTANGLE)  */
/***************************************************/
function getImgCarousel() {
  $return = '';
  // IMAGE CAROUSEL (RECTANGLE)
  $width = get_sub_field('width');
  // check if the nested repeater field has rows of data
  if( have_rows('images') ) {

    $return .=  '<section class="rectangle-image-carousel ';
    if ($width == 'Content Width') { $return .=   'container">'; } else { $return .=   '">'; }
    $return .=      '<div id="carouselPanel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">';
    $i = 0;

    // loop through the rows of data
    while ( have_rows('images') ) {
      the_row();

      $text = get_sub_field('text');
      $url  = get_sub_field('url');
      $image = get_sub_field('image');

      if ($i == 0) {
        $return .= '
        <div class="item active">';
          if(get_sub_field('url')){
            $return .= '<a href="'. $url .'">';
          }
          $return .= '
            <img src="'. $image['url'].'" alt="'. $image['alt'] .'" />';
          if (get_sub_field('text')){
            $return .= '
              <div class="carousel-caption">
                <h3>'. $text.'</h3>
              </div>';
          }
          if(get_sub_field('url')){
            $return .=  '</a>';
          }
        $return .= '
        </div>';
      } else {
        $return .=
        '<div class="item">
          <img src="'. $image['url'] .'" alt="'. $image['alt'].'" />
          <div class="carousel-caption">
            <h3>'. $text .'</h3>
          </div>
        </div>';
      }
      $i++;
    }
    $return .=
    '</div> <!-- close carousel-inner-->';

    if( $i > 1 ){
      $return .=
      '<a class="left carousel-control" href="#carouselPanel" role="button" data-slide="prev">
        <img class="glyphicon-chevron-right" src="'. get_bloginfo('template_directory').'/img/arrow_left.png" alt="Image Carousel button left" />
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carouselPanel" role="button" data-slide="next">
        <img class="glyphicon-chevron-right" src="'. get_bloginfo('template_directory').'/img/arrow_right.png" alt="Image Carousel button right" />
        <span class="sr-only">Next</span>
      </a>';
    }
    $return .= '
          </div> <!-- close carouselPanel-->
        </section>';
  }
  return $return;
}

/***************************************************/
/*  Function to return IMAGE CAROUSEL (SQUARE)     */
/***************************************************/
function getImgCarouselSquare() {
  $return = '';
  // IMAGE CAROUSEL (SQUARE)
  $width = get_sub_field('width');

  if( have_rows('images') ) {
    $return .=  '<section class="square-image-carousel '.($width == 'Content Width' ? 'container nopad':'').'">';
    $return .=    '<div class="mtm-carousel owl-carousel">';
    while ( have_rows('images') ) {
        the_row();

        $text  = get_sub_field('text');
        $url   = get_sub_field('url');
        $image = get_sub_field('image');
        $return .=
        '<div class="mtm-car-image" style="background: url(\''. $image["url"].'\') no-repeat center center;background-size: cover;"></div>';

    }
    $return .= '
    </div>

    <a id="left-trigger" class="left carousel-control" href="#" role="button" data-slide="prev">
      <img class="glyphicon-chevron-right" src="'. get_bloginfo('template_directory').'/img/arrow_left.png" alt="Image Carousel button left" />
      <span class="sr-only">'. __('Previous','MiniMakerFaire').'</span>
    </a>
    <a id="right-trigger" class="right carousel-control" href="#" role="button" data-slide="next">
      <img class="glyphicon-chevron-right" src="'. get_bloginfo('template_directory').'/img/arrow_right.png" alt="Image Carousel button right" />
      <span class="sr-only">'. __('Next','MiniMakerFaire').'</span>
    </a>
    </section>

    <script>
    jQuery( document ).ready(function() {
      // Carousel init
      jQuery(\'.square-image-carousel .mtm-carousel\').owlCarousel({
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
    </script>';
  }
  return $return;
}

function getNewsletterPanel() {
  $return = '
    <section class="newsletter-panel">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <p><strong>'. __('Stay in Touch:','MiniMakerFaire').'</strong><br />'. __('Get Local and Global Maker Faire Community updates.','MiniMakerFaire').'</strong></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <form class="form-inline sub-form whatcounts-signup1" action="https://secure.whatcounts.com/bin/listctrl" method="POST">
              <input type="hidden" name="slid" value="6B5869DC547D3D46E66DEF1987C64E7A" /><!-- MakerFaire -->
              <input type="hidden" name="cmd" value="subscribe" />
              <input type="hidden" name="custom_source" value="Panel" />
              <input type="hidden" name="custom_incentive" value="none" />
              <input type="hidden" name="custom_url" value="'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'" />
              <input type="hidden" id="format_mime" name="format" value="mime" />
              <input type="hidden" name="custom_host" value="'. $_SERVER["HTTP_HOST"].'" />
              <div id="recapcha-panel" class="g-recaptcha" data-size="invisible"></div>
              <input id="wc-email" class="form-control nl-panel-input" name="email" placeholder="'. __('Enter your Email','MiniMakerFaire').'" required type="email">
              <input class="form-control btn-w-ghost" value="'. __('GO','MiniMakerFaire').'" type="submit">
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
        <h3>'. __('Awesome!','MiniMakerFaire').'</h3>
        <p>'. __('Thanks for signing up.','MiniMakerFaire').'</p>
      </div>
      <div class="clearfix"></div>
    </div>

    <div class="nl-modal-error" style="display:none;">
        <div class="col-xs-12 nl-modal padtop">
            <p class="lead">The reCAPTCHA box was not checked. Please try again.</p>
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
        jQuery(".nl-modal-error").fancybox({
          autoSize : false,
          width  : 250,
          autoHeight : true,
          padding : 0,
          afterLoad   : function() {
            this.content = this.content.html();
          }
        });
      });
      var onSubmitPanel = function(token) {
        var bla = jQuery("#wc-email").val();
        globalNewsletterSignup(bla);
        jQuery.post("https://secure.whatcounts.com/bin/listctrl", jQuery(".whatcounts-signup1").serialize());
        jQuery(".fancybox-thx").trigger("click");
        //jQuery(".nl-modal-email-address").text(bla);
        //jQuery(".whatcounts-signup2 #email").val(bla);
      }
      jQuery(document).on("submit", ".whatcounts-signup1", function (e) {
        e.preventDefault();
        onSubmitPanel();
      });
      var recaptchaKey = "6Lf_-kEUAAAAAHtDfGBAleSvWSynALMcgI1hc_tP";
      onloadCallback = function() {
        if ( jQuery("#recapcha-panel").length ) {
          grecaptcha.render("recapcha-panel", {
            "sitekey" : recaptchaKey,
            "callback" : onSubmitPanel
          });
        }
      };
    </script>';
  return $return;
}


function getSponsorPanel() {
  $return = '';
  $sponsor_ID = 0;
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
    $return .= '
    <section class="sponsor-slide">
      <div class="container">
        <div class="row sponsor_panel_title">
          <div class="col-xs-12 text-center">
            <div class="title-w-border-r">
              <h2 class="sponsor-slide-title">'. $sponsor_panel_field_1.'</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div id="carousel-sponsors-slider" class="carousel slide" data-ride="carousel">
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">';
                // loop through the rows of data
                while ( have_rows('sponsors', $sponsor_ID) ) {
                  the_row();
                  $sponsor_group_title = get_sub_field('sponsor_group_title'); //Sponsor group title

                  if( get_row_layout() == 'sponsors_with_image' ) {
                    $sub_field_3 = get_sub_field('sponsors_image_size'); //size option

                    // check if the nested repeater field has rows of data
                    if( have_rows('sponsors_with_image') ) {
                      $return .= '
                      <div class="item">
                        <div class="row spnosors-row">
                          <div class="col-xs-12">';
                            if(!empty($sponsor_group_title)) {
                              $return .= '<h5 class="text-center sponsors-type">' . $sponsor_group_title . '</h5>';
                            }
                            $return .= '
                            <div class="faire-sponsors-box">';

                              // loop through the rows of data
                              while ( have_rows('sponsors_with_image') ) {
                                the_row();

                                $sub_field_1 = get_sub_field('image'); //Photo
                                $sub_field_2 = get_sub_field('url'); //URL
                                $args = array(
                                  'w' => '300',
                                  'quality' => '80',
                                  'strip' => 'all',
                                );
                                $photon = jetpack_photon_url($sub_field_1['url'], $args);

                                $return .= '<div class="' . $sub_field_3 . '">';
                                if( $sub_field_2 ) {
                                  $return .= '<a href="' . $sub_field_2 . '" target="_blank">';
                                }
                                $return .= '<img src="' . $photon . '" alt="Maker Faire sponsor logo" class="img-responsive" />';
                                if( $sub_field_2 ) {
                                  $return .= '</a>';
                                }
                                $return .= '</div>';
                              }
                            $return .= '
                            </div>
                          </div>
                        </div>
                      </div>';
                    } // end if image
                } // end row layout
              }
              $return .= '
              </div>
            </div>
          </div>
        </div>
        <div class="row sponsor_panel_bottom">
          <div class="col-xs-12 text-center">
            <p>';
              if(!empty($sponsor_panel_field_3)) {
                $return .= '<a href="' . $sponsor_panel_field_3 . '">'. __('Become a Sponsor','MiniMakerFaire').'</a><span>&bull;</span>';
              }
              $return .= '
              <a href="/sponsors">'. __('All Sponsors','MiniMakerFaire').'</a>
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
    </script>';
  }
  return $return;
}

/***************************************************/
/*  Function to return Social Media Panel          */
/***************************************************/
function getSocialPanel() {
  $return = '';
  $panel_title = get_sub_field('panel_title');
  if( have_rows('active_feeds') ) {
    $return .= '
    <section class="social-feeds-panel">
      <div class="container">';
        if( $panel_title!='' ) {
          $return .= '
          <div class="row">
            <div class="col-xs-12 text-center">
              <div class="title-w-border-r">
                <h2>'. $panel_title.'</h2>
              </div>
            </div>
          </div>';
        }
        $return .= '
        <div class="social-row">';
          while ( have_rows('active_feeds') ) {
            the_row();

            if( get_row_layout() == 'facebook' ) {
              $facebook_title = get_sub_field('fb_title');
              $facebook_url   = get_sub_field('facebook_url');
              $facebook_url_2 = rawurlencode($facebook_url);
              $return .= '
              <div class="social-panel-fb social-panel-feed">
                <h5>' . $facebook_title . '</h5>
                <iframe src="https://www.facebook.com/plugins/page.php?href=' . $facebook_url_2 . '&tabs=timeline&height=468&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
              </div>';

            } elseif( get_row_layout() == 'twitter' ) {
              $twitter_title = get_sub_field('tw_title');
              $twitter_id = get_sub_field('twitter_id');
              $return .= '
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
              $instagram_iframe = get_sub_field('instagram_iframe');
              $return .= '
              <div class="social-panel-ig social-panel-feed">
                <h5>'. $instagram_title.'</h5>
                '.$instagram_iframe .'
              </div>';
            }
          }
          $return .= '
        </div>
      </div>
    </section>';
  }
  return $return;
}