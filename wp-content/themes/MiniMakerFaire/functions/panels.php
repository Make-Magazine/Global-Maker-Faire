<?php

/* * *************************************************** */
/* Determine correct layout */
/* * *************************************************** */

function dispLayout($row_layout) {
    $return = '';
    GLOBAL $acf_blocks;
    $activeinactive = ($acf_blocks ? get_field('activeinactive') : get_sub_field('activeinactive'));

    switch ($row_layout) {
        case 'buy_tickets_float': // floating buy tickets banner            
            if ($activeinactive == 'Active') {
                $return = getBuyTixPanel($row_layout);
            }
            break;
        case 'featured_makers_panel': // FEATURED MAKERS (SQUARE)
        case 'featured_makers_panel_dynamic': // FEATURED MAKERS (SQUARE) - dynamic
        case 'featured_makers_panel_circle': // featured makers (circle)
        case 'featured_makers_panel_circle_dynamic': // featured makers (circle) - dynamic            
            if ($activeinactive == 'Active') {
                $return = getFeatMkPanel($row_layout);
            }
            break;
        case 'featured_events': // featured_events
        case 'featured_events_dynamic': // featured_events - dynamic            
            if ($activeinactive == 'Active') {
                $return = getFeatEvPanel($row_layout);
            }
            break;
        case 'post_feed':
            if ($activeinactive == 'Active') {
                $return = getPostFeed();
            }
            break;
        case '1_column': // 1 COLUMN LAYOUT
            if ($activeinactive == 'Active') {
                $return = get1ColLayout();
            }
            break;
        case '2_column_photo_and_text_panel': // 2 COLUMN LAYOUT
            if ($activeinactive == 'Active') {
                $return = get2ColLayout();
            }
            break;
        case '3_column': // 3 COLUMN LAYOUT
            if ($activeinactive == 'Active') {
                $return = get3ColLayout();
            }
            break;
        case 'what_is_maker_faire': // WHAT IS MAKER FAIRE PANEL          
            $return = getWhatisMF();
            break;
        case 'call_to_action_panel': // CTA PANEL
        case 'call_to_action': // CTA PANEL
            if ($activeinactive == 'Active') {
                $return = getCTApanel();
            }
            break;
        case 'static_or_carousel': // IMAGE CAROUSEL (RECTANGLE)
            if ($activeinactive == 'Active') {
                $return = getImgCarousel();
            }
            break;
        case 'square_image_carousel': // IMAGE CAROUSEL (SQUARE)
            if ($activeinactive == 'Active') {
                $return = getImgCarouselSquare();
            }
            break;
        case 'newsletter_panel':  // NEWSLETTER PANEL
            if ($activeinactive == 'Active') {
                $return = getNewsletterPanel();
            }
            break;
        case 'sponsors_panel':   // SPONSOR PANEL
            if ($activeinactive == 'Active') {
                $return = getSponsorPanel();
            }
            break;
        case 'social_media': //social media panel
            if ($activeinactive == 'Active') {
                $return = getSocialPanel();
            }
            break;
        case 'two_column_video':
            if ($activeinactive == 'Active') {
                $return = getVideoPanel();
            }
            break;
        case 'two_column_image':
            if ($activeinactive == 'Active') {
                $return = getImagePanel();
            }
            break;
    }
    return $return;
}

/* * *********************************************** */
/* Function to return Buy Tickets Floating Banner */
/* * *********************************************** */

function getBuyTixPanel() {
//gutenburg blocks use get_field, ACF panels use get_sub_field
    GLOBAL $acf_blocks;
    $buy_ticket_url = ($acf_blocks ? get_field('buy_ticket_url') : get_sub_field('buy_ticket_url'));
    $buy_ticket_text = ($acf_blocks ? get_field('buy_ticket_text') : get_sub_field('buy_ticket_text'));

    return '<a href="' . $buy_ticket_url . '" target="_blank"><div class="floatBuyTix">' . $buy_ticket_text . '</div></a>';
}

/* * *********************************************** */
/* Function to build the featured maker panel     */
/* * *********************************************** */

function getFeatMkPanel($row_layout) {
    $return = '';

    $dynamic = ($row_layout == 'featured_makers_panel_dynamic' || $row_layout == 'featured_makers_panel_circle_dynamic' ? true : false);
    $circle = ($row_layout == 'featured_makers_panel_circle' || $row_layout == 'featured_makers_panel_circle_dynamic' ? true : false);

//gutenburg blocks use get_field, ACF panels use get_sub_field
    GLOBAL $acf_blocks;

    $makers_to_show = ($acf_blocks ? get_field('makers_to_show') : get_sub_field('makers_to_show'));
    $more_makers_button = ($acf_blocks ? get_field('more_makers_button') : get_sub_field('more_makers_button'));

    $background_color = (!$circle ? ($acf_blocks ? get_field('background_color') : get_sub_field('background_color')) : '');
    $title = ($acf_blocks ? get_field('title') : get_sub_field('title'));
// set the class to featured-maker0panel-circle if a circle panel was selected
// if not a circle panel, check if the background color selected was red
    $return .= '<section class="featured-maker-panel' . ($circle ? '-circle' : ($background_color == "Red" ? ' red-back' : '')) . '"> ';
    $return .= '<div class="container">';
    if ($title) {
        if ($circle) {
            $return .= '<div class="row padtop text-center">
              <img class="robot-head" src="' . get_bloginfo("template_directory") . '/img/news-icon.png" alt="News icon" />
              <div class="title-w-border-r">
                <h2>' . $title . '</h2>
              </div>
            </div>';
        } else {
            $return .= '<div class="row text-center">
              <div class="title-w-border-y">
                <h2>' . $title . '</h2>
              </div>
            </div>';
        }
    }

    $return .= '<div class="row padbottom">';

// build makers array
    $makerArr = array();
    if ($dynamic) {
        $makers_to_show = ($acf_blocks ? get_field('makers_to_show') : get_sub_field('makers_to_show'));
        $formid = (int) ($acf_blocks ? get_field('enter_formid_here') : get_sub_field('enter_formid_here'));

        $search_criteria['status'] = 'active';
        $search_criteria['field_filters'][] = array(
            'key' => '303',
            'value' => 'Accepted'
        );
        $search_criteria['field_filters'][] = array(
            'key' => '304',
            'value' => 'Featured Maker'
        );

        $entries = GFAPI::get_entries($formid, $search_criteria, null, array('offset' => 0, 'page_size' => 999));

// # Check for No data allow for pull accepted
        $pullAccepted = ($acf_blocks ? get_field('pull_accepted') : get_sub_field('pull_accepted'));

        if (empty($entries) && $pullAccepted) {
// # Reset Criteria
            $search_criteria['field_filters'] = array();
// # Only want the accepted ones
            $search_criteria['field_filters'][] = array(
                'key' => '303',
                'value' => 'Accepted'
            );
// # Re-Run Entries
            $entries = GFAPI::get_entries($formid, $search_criteria, null, array('offset' => 0, 'page_size' => 999));
        }

// randomly order entries
        shuffle($entries);
        foreach ($entries as $entry) {
            $url = $entry['22'];
            $args = array(
                'resize' => '300,300',
                'quality' => '80',
                'strip' => 'all'
            );
            $photon = jetpack_photon_url($url, $args);

            $makerArr[] = array(
                'image' => $photon,
                'name' => $entry['151'],
                'desc' => $entry['16'],
                'maker_url' => '/maker/entry/' . $entry['id']
            );
        }
    } else {
// check if the nested repeater field has rows of data
        if (have_rows('featured_makers')) {
// loop through the rows of data
            while (have_rows('featured_makers')) {
                the_row();
                $url = get_sub_field('maker_image');
                $args = array(
                    'resize' => '300,300',
                    'quality' => '80',
                    'strip' => 'all'
                );
                $photon = jetpack_photon_url($url['url'], $args);
                $makerArr[] = array(
                    'image' => $photon,
                    'name' => get_sub_field('maker_name'),
                    'desc' => get_sub_field('maker_short_description'),
                    'maker_url' => get_sub_field('maker_url')
                );
            }
        }
    } // end check dynamic
// limit the number returned to $makers_to_show
    $makerArr = array_slice($makerArr, 0, $makers_to_show);

// loop thru maker data and build the table
    foreach ($makerArr as $maker) {
        if (!empty($maker['maker_url'])) {
            $return .= '<a href="' . $maker['maker_url'] . '">';
        }

        $return .= '<div class="featured-maker col-xs-6 col-sm-3">
            <div class="maker-img" style="background-image: url(' . $maker['image'] . ');">
            </div>
            <div class="maker-panel-text">
              <h4>' . $maker['name'] . '</h4>
              <p class="hidden-xs">' . $maker['desc'] . '</p>
            </div>
          </div>';

        if (!empty($maker['maker_url'])) {
            $return .= '</a>';
        }
    }
    $return .= '</div>'; // end div.row
// check if we should display a more maker button    
    if ($more_makers_button !== '') {
        $return .= '<div class="row padbottom">
            <div class="col-xs-12 padbottom text-center">
              <a class="btn ' . ($circle ? 'btn-b-ghost' : 'btn-w-ghost') . '" href="' . $more_makers_button . '">' . __('More Makers', 'MiniMakerFaire') . '</a>
            </div>
          </div>';
    }
    $return .= '</div>'; // end div.container
    $return .= '<div class="flag-banner"></div></section>';
    return $return;
}

/* * *********************************************** */
/* Function to build the featured event panel     */
/* * *********************************************** */

function getFeatEvPanel($row_layout) {
    global $wpdb;
    $return = '';
    $dynamic = ($row_layout == 'featured_events_dynamic' ? true : false);
    $return .= '<section class="featured-events-panel">
          <div class="container">';

//gutenburg blocks use get_field, ACF panels use get_sub_field
    GLOBAL $acf_blocks;
    $title = ($acf_blocks ? get_field('title') : get_sub_field('title'));

    if ($title) {
        $return .= '<div class="row padtop text-center">
            <div class="title-w-border-r">
              <h2>' . $title . '</h2>
            </div>
          </div>';
    }

    $return .= '<div class="row padbottom">';

// build event array
    $eventArr = array();
    if ($dynamic) {
        $formid = ($acf_blocks ? get_field('enter_formid_here') : get_sub_field('enter_formid_here'));
        $query = "SELECT schedule.entry_id, schedule.start_dt as time_start, schedule.end_dt as time_end, schedule.type,
                       lead_detail.meta_value as entry_status, DAYNAME(schedule.start_dt) as day,location.location,
                       (SELECT meta_value FROM {$wpdb->prefix}gf_entry_meta 
                         WHERE entry_id = schedule.entry_id AND meta_key like '304.3' AND meta_value like 'Featured Maker')  as flag,
                       (SELECT meta_value FROM {$wpdb->prefix}gf_entry_meta 
                         WHERE entry_id = schedule.entry_id AND meta_key like '22')  as photo,
                       (SELECT meta_value from {$wpdb->prefix}gf_entry_meta 
                         WHERE entry_id = schedule.entry_id AND meta_key like '151') as name,
                       (SELECT meta_value from {$wpdb->prefix}gf_entry_meta 
                         WHERE entry_id = schedule.entry_id AND meta_key like '16')  as short_desc
                  FROM {$wpdb->prefix}mf_schedule as schedule
                       left outer join {$wpdb->prefix}mf_location as location on location_id = location.id
                       left outer join {$wpdb->prefix}gf_entry as lead on schedule.entry_id = lead.id
                       left outer join {$wpdb->prefix}gf_entry_meta as lead_detail on
                       schedule.entry_id = lead_detail.entry_id and meta_key = 303
                 WHERE lead.status = 'active' and lead_detail.meta_value = 'Accepted'";

        foreach ($wpdb->get_results($query) as $row) {
// only write schedule for featured events
            if ($row->flag != NULL) {
                $startDate = date_create($row->time_start);
                $startDate = date_format($startDate, 'g:i a');

                $endDate = date_create($row->time_end);
                $endDate = date_format($endDate, 'g:i a');

                $projPhoto = $row->photo;
                $args = array(
                    'resize' => '300,300',
                    'quality' => '80',
                    'strip' => 'all'
                );
                $photon = jetpack_photon_url($projPhoto, $args);
                $eventArr[] = array(
                    'image' => $photon,
                    'event' => $row->name,
                    'description' => $row->short_desc,
                    'day' => $row->day,
                    'time' => $startDate . ' - ' . $endDate,
                    'location' => $row->location,
                    'maker_url' => '/maker/entry/' . $row->entry_id
                );
            }
        }
    } else {
// check if the nested repeater field has rows of data
        if (have_rows('featured_events')) {
// loop through the rows of data
            while (have_rows('featured_events')) {
                the_row();

                $url = get_sub_field('event_image');
                $args = array(
                    'resize' => '300,300',
                    'quality' => '80',
                    'strip' => 'all'
                );
                $photon = jetpack_photon_url($url['url'], $args);
                $eventArr[] = array(
                    'image' => $photon,
                    'event' => get_sub_field('event_name'),
                    'description' => get_sub_field('event_short_description'),
                    'day' => get_sub_field('day'),
                    'time' => get_sub_field('time'),
                    'location' => get_sub_field('location'),
                    'maker_url' => ''
                );
            }
        }
    }

// build event display
    foreach ($eventArr as $event) {
        $return .= '<div class="featured-event col-xs-6">' . ($event['maker_url'] != '' ? '<a href="' . $event['maker_url'] . '">' : '') . '<div class="col-xs-12 col-sm-4 nopad">
              <div class="event-img" style="background-image: url(' . $event['image'] . ');"></div>
            </div>
            <div class="col-xs-12 col-sm-8">
              <div class="event-description">
                <h4>' . $event['event'] . '</h4>
                <p class="event-desc">' . $event['description'] . '</p>
              </div>
              <div class="event-details">
                <p class="event-day">' . $event['day'] . ' ' . $event['time'] . '</p>
                <p class="event-location">' . $event['location'] . '</p>
              </div>
            </div>' . ($event['maker_url'] != '' ? '</a>' : '') . '</div>';
    }

    $return .= '</div>'; // end div.row

    $all_events_button = ($acf_blocks ? get_field('all_events_button') : get_sub_field('all_events_button'));

    if ($all_events_button) {
        $return .= '<div class="row padbottom">
            <div class="col-xs-12 padbottom text-center">
              <a class="btn btn-b-ghost" href="' . $all_events_button . '">All Events</a>
            </div>
          </div>';
    }
    $return .= '</div>'; // end div.container
    $return .= '<div class="flag-banner"></div></section>';
    return $return;
}

/* * ********************************* */
/* Function to return post feed     */
/* * ********************************* */

function getPostFeed() {
    $return = '';
//gutenburg blocks use get_field, ACF panels use get_sub_field
    GLOBAL $acf_blocks;

    $post_feed_quantity = ($acf_blocks ? get_field('post_quantity') : get_sub_field('post_quantity'));
    $args = array(
        'numberposts' => $post_feed_quantity,
        'post_status' => 'publish'
    );
    $recent_posts = wp_get_recent_posts($args);

// Get the blog template page ID
    $news_pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'blog.php'
    ));
    foreach ($news_pages as $news_page) {
        $news_ID = $news_page->ID;
    }
    if (isset($news_ID)) {
        $news_slug = get_post($news_ID)->post_name;
    }
    $return .= '<section class="recent-post-panel"><div class="container">';

    $title = ($acf_blocks ? get_field('title') : get_sub_field('title'));
    if ($title) {
        $return .= '<div class="row padbottom text-center">
            <img class="robot-head" src="' . get_bloginfo("template_directory") . '/img/news-icon.png" alt="News icon" />
            <div class="title-w-border-r">
              <h2>' . $title . '</h2>
            </div>
          </div>';
    }

    $return .= '<div class="row">';

    foreach ($recent_posts as $recent) {
        $return .= '<div class="recent-post-post col-xs-12 col-sm-3">
            <article class="recent-post-inner">
              <a href="' . get_permalink($recent["ID"]) . '">';
        if (get_the_post_thumbnail($recent['ID']) != '') {
            $thumb_id = get_post_thumbnail_id($recent['ID']);
            $url = wp_get_attachment_url($thumb_id);
            $args = array(
                'resize' => '300,300',
                'quality' => '80',
                'strip' => 'all'
            );
            $photon = jetpack_photon_url($url, $args);
            $return .= "<div class='recent-post-img' style='background-image: url(" . $photon . ");'></div>";
        } else {
            $return .= get_first_post_image($recent);
        }

        $return .= '     <div class="recent-post-text">
                  <h4>' . $recent["post_title"] . '</h4>
                  <p class="recent-post-date">' . mysql2date('M j, Y', $recent["post_date"]) . '</p>
                  <p class="recent-post-descripton">' . substr(wp_strip_all_tags($recent["post_content"]), 0, 150) . '</p>
                </div>
              </a>
            </article>
          </div>';
    }
    if (isset($news_slug)) {
        $return .= '<div class="col-xs-12 padtop padbottom text-center">
            <a class="btn btn-b-ghost" href="/' . $news_slug . '">' . __('More News', 'MiniMakerFaire') . '</a>
          </div>';
    }
    $return .= '</div></div><div class="flag-banner"></div></section>';
    return $return;
}

/* * ************************************************* */
/* Function to return 3_column_photo_and_text_panel */
/* * ************************************************* */

function get3ColLayout() {
    $return = '';

    $return .= '<section class="content-panel three-column">
                <div class="flag-banner"></div>
                <div class="container">';

//gutenburg blocks use get_field, ACF panels use get_sub_field
    GLOBAL $acf_blocks;
    $panelTitle = ($acf_blocks ? get_field('panel_title') : get_sub_field('panel_title'));

    if ($panelTitle) {
        $return .= ' <div class="row">
                    <div class="col-xs-12 text-center padbottom">
                      <h2 class="title yellow-underline">' . $panelTitle . '</h2>
                    </div>
                  </div>';
    }

    $return .= '   <div class="row">'; // start row
// get requested data for each column

    $columns = ($acf_blocks ? get_field('column') : get_sub_field('column'));
    foreach ($columns as $column) {
        $return .= '   <div class="col-sm-4">'; // start column
        $data = $column['data'];
        $columnInfo = '';
        switch ($column['column_type']) {
            case 'image': // Image with optional link
                $alignment = $data['column_list_alignment'];
                $image = '<img class="img-responsive" src="' . $data['column_image_field'] . '" />';
                $cta_link = $data['image_cta'];
                $ctaText = $data['image_cta_text'];

                if (!empty($cta_link)) {
                    $columnInfo = '<a href="' . $cta_link . '">' . $image . '</a>';
                    if (!empty($ctaText)) {
                        $columnInfo .= '<p class="text-' . $alignment . ' sub-caption-dark"><a href="' . $cta_link . '" target="_blank">' . $ctaText . '</a></p>';
                    }
                } else {
                    $columnInfo = $image;
                }
                break;
            case 'paragraph': // Paragraph text
                $columnInfo = '<p>' . $data['column_paragraph'] . '</p>';
                break;
            case 'list': // List of items with optional links
                $columnInfo = '<div class="panel-list">';
                if (!empty($data['list_title'])) {
                    $columnInfo .= '<p class="line-item list-title">' . $data['list_title'] . '</p>';
                }
// $columnInfo .= ' <ul>';
                foreach ($data['column_list_fields'] as $list_fields) {
                    $list_text = $list_fields['list_text'];
                    $list_link = $list_fields['list_link'];
                    $columnInfo .= (!empty($list_link) ? '<a class="line-item" href="' . $list_link . '">' . $list_text . '</a>' : $list_text);
                }
// $columnInfo .= ' </ul>';
                $columnInfo .= '</div>';
                break;
        }
        $return .= $columnInfo;
        $return .= '</div>'; // end column
    }

    $return .= '</div>'; // end row

    $return .= ' </div>
              </section>'; // end div.container and section.content-panel
    return $return;
}

/* * *************************************************** */
/* Function to get 2 column layout                    */
/* * *************************************************** */

function get2ColLayout() {
    $return = '';
//gutenburg blocks use get_field, ACF panels use get_sub_field
    GLOBAL $acf_blocks;

    $column_1 = ($acf_blocks ? get_field('column_1') : get_sub_field('column_1'));
    $column_2 = ($acf_blocks ? get_field('column_2') : get_sub_field('column_2'));
    $cta_button = ($acf_blocks ? get_field('cta_button') : get_sub_field('cta_button'));
    $cta_button_url = ($acf_blocks ? get_field('cta_button_url') : get_sub_field('cta_button_url'));
    $title = ($acf_blocks ? get_field('title') : get_sub_field('title'));

    $return .= '<section class="content-panel">
          <div class="container">';

    if ($title) {
        $return .= '  <div class="row">
              <div class="col-xs-12 text-center padbottom">
                <h2>' . $title . '</h2>
              </div>
            </div>';
    }

    $return .= '    <div class="row">
              <div class="col-sm-6">' . $column_1 . '</div>
              <div class="col-sm-6">' . $column_2 . '</div>
            </div>';

    if ($cta_button) {
        $return .= '  <div class="row text-center padtop">
              <a class="btn btn-b-ghost" href="' . $cta_button_url . '">' . $cta_button . '</a>
            </div>';
    }

    $return .= '  </div>
          <div class="flag-banner"></div>
        </section>';
    return $return;
}

/* * *************************************************** */
/* Function to get1ColLayout                          */
/* * *************************************************** */

function get1ColLayout() {
    $return = '';
    $column_1 = get_sub_field('column_1');
    $cta_button = get_sub_field('cta_button');
    $cta_button_url = get_sub_field('cta_button_url');
    $return .= '<section class="content-panel">
          <div class="container">';

    if (get_sub_field('title')) {
        $return .= '  <div class="row">
              <div class="col-xs-12 text-center padbottom">
                <h2>' . get_sub_field('title') . '</h2>
              </div>
            </div>';
    }

    $return .= '    <div class="row">
              <div class="col-xs-12">' . $column_1 . '</div>
            </div>';

    if (get_sub_field('cta_button')) {
        $return .= '  <div class="row text-center padtop">
              <a class="btn btn-b-ghost" href="' . $cta_button_url . '">' . $cta_button . '</a>
            </div>';
    }

    $return .= '  </div>
          <div class="flag-banner"></div>
        </section>';
    return $return;
}

/* * *************************************************** */
/* Function to return WHAT IS MAKER FAIRE PANEL       */
/* * *************************************************** */

function getWhatisMF() {
    $return = '';

    $widget_radio = get_field('show_what_is_maker_faire'); //gutenburg block
    if ($widget_radio == '')
        $widget_radio = get_sub_field('show_what_is_maker_faire'); //regular panel

    if ($widget_radio == 'show') {
        $return .= '<section class="what-is-maker-faire">
            <div class="container">
              <div class="row text-center">
                <div class="title-w-border-y">
                  <h2>' . __('What is Maker Faire?', 'MiniMakerFaire') . '</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <p class="text-center">' .
                __('Maker Faire is a gathering of fascinating, curious people who enjoy learning and who love sharing what they can do. From engineers to artists to scientists to crafters, Maker Faire is a venue for these "makers" to show hobbies, experiments, projects.', 'MiniMakerFaire') .
                '</p>' .
                '<p class="text-center">' .
                __('We call it the Greatest Show (& Tell) on Earth - a family-friendly showcase of invention, creativity, and resourcefulness.', 'MiniMakerFaire') .
                '</p>' .
                '<p class="text-center">' .
                __('Glimpse the future and get inspired!', 'MiniMakerFaire') .
                '</p>' .
// .get_site_option( 'what-is-makerfaire' ).
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

/* * ****************************************** */
/* Function to return Call to Action panel   */
/* * ****************************************** */

function getCTApanel() {
    GLOBAL $acf_blocks;

    $return = '';
    $cta_title = ($acf_blocks ? get_field('text') : get_sub_field('text'));
    $cta_url = ($acf_blocks ? get_field('url') : get_sub_field('url'));
    $background_color = ($acf_blocks ? get_field('background_color') : get_sub_field('background_color'));

    $return .= '<section class="cta-panel' . ($background_color == "Red" ? ' red-back' : '') . '">';
    $return .= '<div class="container">
          <div class="row text-center">
            <div class="col-xs-12">
              <h3><a href="' . $cta_url . '">' . $cta_title . ' <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
            </div>
          </div>
        </div>
      </section>';
    return $return;
}

/* * ************************************************ */
/* Function to return IMAGE CAROUSEL (RECTANGLE)   */
/* * ************************************************ */

function getImgCarousel() {
    $return = '';
// IMAGE CAROUSEL (RECTANGLE)
    GLOBAL $acf_blocks;
    $width = ($acf_blocks ? get_field('width') : get_sub_field('width'));
// check if the nested repeater field has rows of data
    if (have_rows('images')) {

        $return .= '<section class="rectangle-image-carousel ';
        if ($width == 'Content Width') {
            $return .= 'container">';
        } else {
            $return .= '">';
        }
        $return .= '<div id="carouselPanel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">';
        $i = 0;

// loop through the rows of data
        while (have_rows('images')) {
            the_row();

            $text = get_sub_field('text');
            $url = get_sub_field('url');
            $image = get_sub_field('image');

            if ($i == 0) {
                $return .= '
        <div class="item active">';
                if (get_sub_field('url')) {
                    $return .= '<a href="' . $url . '">';
                }
                $return .= '
            <img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />';
                if (get_sub_field('text')) {
                    $return .= '
              <div class="carousel-caption">
                <h3>' . $text . '</h3>
              </div>';
                }
                if (get_sub_field('url')) {
                    $return .= '</a>';
                }
                $return .= '
        </div>';
            } else {
                $return .= '<div class="item">
          <img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />
          <div class="carousel-caption">
            <h3>' . $text . '</h3>
          </div>
        </div>';
            }
            $i ++;
        }
        $return .= '</div> <!-- close carousel-inner-->';

        if ($i > 1) {
            $return .= '<a class="left carousel-control" href="#carouselPanel" role="button" data-slide="prev">
        <img class="glyphicon-chevron-right" src="' . get_bloginfo('template_directory') . '/img/arrow_left.png" alt="Image Carousel button left" />
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carouselPanel" role="button" data-slide="next">
        <img class="glyphicon-chevron-right" src="' . get_bloginfo('template_directory') . '/img/arrow_right.png" alt="Image Carousel button right" />
        <span class="sr-only">Next</span>
      </a>';
        }
        $return .= '
          </div> <!-- close carouselPanel-->
        </section>';
    }
    return $return;
}

/* * ************************************************ */
/* Function to return IMAGE CAROUSEL (SQUARE)      */
/* * ************************************************ */

function getImgCarouselSquare() {
    $return = '';
// IMAGE CAROUSEL (SQUARE)
    GLOBAL $acf_blocks;
    $width = ($acf_blocks ? get_field('width') : get_sub_field('width'));    

    if (have_rows('images')) {
        $return .= '<section class="square-image-carousel ' . ($width == 'Content Width' ? 'container nopad' : '') . '">';
        $return .= '<div class="mtm-carousel owl-carousel">';
        while (have_rows('images')) {
            the_row();
            
            $text = get_sub_field('text');            
            $url = get_sub_field('url');
            $image = get_sub_field('image');
            if($url!='')    $return .= '<a href="'.$url.'" target="_none">';
            $return .= '<div title="'.$text.'" class="mtm-car-image" style="background: url(\'' . $image["url"] . '\') no-repeat center center;background-size: cover;"></div>';
            if($url!='')    $return .= '</a>';
        }
        $return .= '
    </div>

    <a id="left-trigger" class="left carousel-control" href="#" role="button" data-slide="prev">
      <img class="glyphicon-chevron-right" src="' . get_bloginfo('template_directory') . '/img/arrow_left.png" alt="Image Carousel button left" />
      <span class="sr-only">' . __('Previous', 'MiniMakerFaire') . '</span>
    </a>
    <a id="right-trigger" class="right carousel-control" href="#" role="button" data-slide="next">
      <img class="glyphicon-chevron-right" src="' . get_bloginfo('template_directory') . '/img/arrow_right.png" alt="Image Carousel button right" />
      <span class="sr-only">' . __('Next', 'MiniMakerFaire') . '</span>
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

/* * *************************************************** */
/* Function to return NewsLetter Panel                */
/* * *************************************************** */

function getNewsletterPanel() {
    $return = '
    <section class="newsletter-panel">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <p><strong>' . __('Stay in Touch:', 'MiniMakerFaire') . '</strong><br />' . __('Get Local and Global Maker Faire Community updates.', 'MiniMakerFaire') . '</strong></p>
          </div>
          <div class="col-xs-12 col-sm-6">
            <form class="form-inline sub-form whatcounts-signup1" action="https://secure.whatcounts.com/bin/listctrl" method="POST">
              <input type="hidden" name="slid" value="6B5869DC547D3D46E66DEF1987C64E7A" /><!-- MakerFaire -->
              <input type="hidden" name="cmd" value="subscribe" />
              <input type="hidden" name="custom_source" value="Panel" />
              <input type="hidden" name="custom_incentive" value="none" />
              <input type="hidden" name="custom_url" value="' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '" />
              <input type="hidden" id="format_mime" name="format" value="mime" />
              <input type="hidden" name="custom_host" value="' . $_SERVER["HTTP_HOST"] . '" />
              <div id="recapcha-panel" class="g-recaptcha" data-size="invisible"></div>
              <input id="wc-email" class="form-control nl-panel-input" name="email" placeholder="' . __('Enter your Email', 'MiniMakerFaire') . '" required type="email">
              <input class="form-control btn-w-ghost" value="' . __('GO', 'MiniMakerFaire') . '" type="submit">
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
        <h3>' . __('Awesome!', 'MiniMakerFaire') . '</h3>
        <p>' . __('Thanks for signing up.', 'MiniMakerFaire') . '</p>
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

/* * *************************************************** */
/* Function to return Sponser Panel                   */
/* * *************************************************** */

function getSponsorPanel() {
    $return = '';
    $sponsor_ID = 0;
// Get the sponsors template page ID
    $sponsor_pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-sponsors.php'
    ));
    foreach ($sponsor_pages as $sponsor_page) {
        $sponsor_ID = $sponsor_page->ID;
    }
    GLOBAL $acf_blocks;
    $sponsor_panel_field_1 = ($acf_blocks ? get_field('title_sponsor_panel') : get_sub_field('title_sponsor_panel'));    
    $sponsor_panel_field_3 = ($acf_blocks ? get_field('become_a_sponsor_button') : get_sub_field('become_a_sponsor_button'));    

// check if the nested repeater field has rows of data
    if (have_rows('sponsors', $sponsor_ID)) {
        $return .= '
    <section class="sponsor-slide">
      <div class="container">
        <div class="row sponsor_panel_title">
          <div class="col-xs-12 text-center">
            <div class="title-w-border-r">
              <h2 class="sponsor-slide-title">' . $sponsor_panel_field_1 . '</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div id="carousel-sponsors-slider" class="carousel slide" data-ride="carousel">
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">';
// loop through the rows of data
        while (have_rows('sponsors', $sponsor_ID)) {
            the_row();
            $sponsor_group_title = get_sub_field('sponsor_group_title'); // Sponsor group title

            if (get_row_layout() == 'sponsors_with_image') {
                $sub_field_3 = get_sub_field('sponsors_image_size'); // size option
// check if the nested repeater field has rows of data
                if (have_rows('sponsors_with_image')) {
                    $return .= '
                      <div class="item">
                        <div class="row sponsors-row">
                          <div class="col-xs-12">';
                    if (!empty($sponsor_group_title)) {
                        $return .= '<h5 class="text-center sponsors-type">' . $sponsor_group_title . '</h5>';
                    }
                    $return .= '
                            <div class="faire-sponsors-box">';

// loop through the rows of data
                    while (have_rows('sponsors_with_image')) {
                        the_row();

                        $sub_field_1 = get_sub_field('image'); // Photo
                        $sub_field_2 = get_sub_field('url'); // URL
                        $args = array(
                            'w' => '300',
                            'quality' => '80',
                            'strip' => 'all'
                        );
                        $photon = jetpack_photon_url($sub_field_1['url'], $args);

                        $return .= '<div class="' . $sub_field_3 . '">';
                        if ($sub_field_2) {
                            $return .= '<a href="' . $sub_field_2 . '" target="_blank">';
                        }
                        $return .= '<img src="' . $photon . '" alt="Maker Faire sponsor logo" class="img-responsive" />';
                        if ($sub_field_2) {
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
        if (!empty($sponsor_panel_field_3)) {
            $return .= '<a href="' . $sponsor_panel_field_3 . '">' . __('Become a Sponsor', 'MiniMakerFaire') . '</a><span>&bull;</span>';
        }
        $return .= '
              <a href="/sponsors">' . __('All Sponsors', 'MiniMakerFaire') . '</a>
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

/* * *************************************************** */
/* Function to return Social Media Panel              */
/* * *************************************************** */

function getSocialPanel() {
    $return = '';
    GLOBAL $acf_blocks;
    $panel_title = ($acf_blocks ? get_field('panel_title') : get_sub_field('panel_title'));    
    
    if (have_rows('active_feeds')) {
        $return .= '
    <section class="social-feeds-panel">
      <div class="container">';
        if ($panel_title != '') {
            $return .= '
          <div class="row">
            <div class="col-xs-12 text-center">
              <div class="title-w-border-r">
                <h2>' . $panel_title . '</h2>
              </div>
            </div>
          </div>';
        }
        $return .= '
        <div class="social-row">';
        while (have_rows('active_feeds')) {
            the_row();

            if (get_row_layout() == 'facebook') {
                $facebook_title = get_sub_field('fb_title');
                $facebook_url = get_sub_field('facebook_url');
                $facebook_url_2 = rawurlencode($facebook_url);
                $return .= '
              <div class="social-panel-fb social-panel-feed">
                <h5>' . $facebook_title . '</h5>
                <iframe src="https://www.facebook.com/plugins/page.php?href=' . $facebook_url_2 . '&tabs=timeline&height=468&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
              </div>';
            } elseif (get_row_layout() == 'twitter') {
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
            } elseif (get_row_layout() == 'instagram') {
                $instagram_title = get_sub_field('ig_title');
                $instagram_iframe = get_sub_field('instagram_iframe');
                $return .= '
              <div class="social-panel-ig social-panel-feed">
                <h5>' . $instagram_title . '</h5>
                ' . $instagram_iframe . '
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

/* * *************************************************** */
/* Function to get Faire backlink                       */
/* * *************************************************** */

function get_faire_backlink() {
    $back_link = get_field('back_link');
    $back_link_url = $back_link['back_link_url'];
    $back_link_text = $back_link['back_link_text'];
    $back_link_html = '';
    if ($back_link_url != '' && $back_link_text != '') {
        $back_link_html = '<div class="faire-backlink">
         <i class="far fa-chevron-left"></i>
         <a href="' . $back_link_url . '">' . $back_link_text . '</a>
      </div>';
    }
    return $back_link_html;
}

/* Pulling logic from home page and pasting it into a function so it can be used in multiple places if desired */

function home_page_image_carousel() {
    $return = 'home page image carousel';

    $return = '
        <section class="slideshow-panel">
            <div class="header-logo-div text-center" itemprop="event" itemscope itemtype="http://schema.org/Event">';

    $faire_location = get_field('faire_location');
    $faire_location_url = get_field('faire_location_url');
	 $ffont_size = get_field('faire_info_font_size') ? get_field('faire_info_font_size') : '16px';
    $open_faire_location = get_field('open_faire_location');
    if ($faire_location_url) {
        $return .= '<a class="event-location-url" href="' . $faire_location_url . '"' . ($open_faire_location ? ' target="_blank"' : '') . '>';
    }
    if ($faire_location) {
        $return .= '<h2 class="event-location" itemprop="location" style="font-size:'.$ffont_size.';"><i class="fa fa-map-marker" aria-hidden="true"></i>' . $faire_location . '</h2>';
    }
    if ($faire_location_url) {
        $return .= '</a>';
    }

    $faire_date = get_field('faire_date');
    if ($faire_date) {
        $return .= '<h2 class="event-date" itemprop="startDate" style="font-size:'.$ffont_size.';"><i class="fa fa-calendar-o" aria-hidden="true"></i>' . $faire_date . '</h2>';
    }

    $header_logo = get_theme_mod('header_logo');
    $return .= '<div class="header-logo-cont">
                    <img class="img-responsive header-logo" src="' . legacy_get_fit_remote_image_url($header_logo, 750, 750) . '" alt="' . get_bloginfo('name') . ' logo" />
                </div>';
    $call_to_action_text = get_field('call_to_action_text');
    $call_to_action_text_url = get_field('call_to_action_text_url');
    if ($call_to_action_text) {
        if ($call_to_action_text_url) {
            $return .= '<a href="' . $call_to_action_text_url . '">';
        }
        $return .= '<h1 class="call_to_action_text">' . $call_to_action_text . '</h1>';
        if ($call_to_action_text_url) {
            $return .= '</a>';
        }
    }
    $return .= '</div>'; // end header-logo-div

    $images = get_field('image_carousel');
    if ($images) {

        $return .= '<div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">';

        $i = 0;
        foreach ($images as $image) {
            $args = array(
                'resize' => '1200,450',
                'quality' => '70',
                'strip' => 'all',
            );
            $url = $image['url'];
            $photon = jetpack_photon_url($url, $args);
            if ($i == 0) {
                $return .= '<div class="item active">
                <img src="' . $photon . '" alt="' . ($image['alt'] != '' ? $image['alt'] : 'Maker Faire featured image') . '" />';
                $return .= '</div>';
            } else {
                $return .= '<div class="item">';
                $return .= '  <img src="' . $photon . '" alt="' . ($image['alt'] != '' ? $image['alt'] : 'Maker Faire featured image') . '" />';
                $return .= '</div>';
            }
            $i++;
        }
        $return .= '</div>'; // close carousel-inner

        if ($i > 1) {
            $return .= '<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">';
            $return .= '  <img class="glyphicon-chevron-right" src="' . get_bloginfo('template_directory') . '/img/arrow_left.png" alt="Image Carousel button left" />';
            $return .= '  <span class="sr-only">Previous</span>';
            $return .= '</a>';
            $return .= '<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">';
            $return .= '  <img class="glyphicon-chevron-right" src="' . get_bloginfo('template_directory') . '/img/arrow_right.png" alt="Image Carousel button right" />';
            $return .= '  <span class="sr-only">Next</span>';
            $return .= '</a>';
        }
        $return .= '</div><!-- /.carousel #myCarousel-->';
    }

    $return .= '</section>';
    echo $return;
}

/* * *************************************************** */
/*   Function to return 2_column_video panel             */
/* * *************************************************** */

function getVideoPanel() {
    //get data submitted on admin page
    GLOBAL $acf_blocks;

    $return = '';
    $return .= '<section class="video-panel container-fluid">';    // create content-panel section
    //get requested data for each column    
    $video_rows = ($acf_blocks ? get_field('video_row') : get_sub_field('video_row'));

    $videoRowNum = 0;
    foreach ($video_rows as $video) {
        $videoRowNum += 1;
        if ($videoRowNum % 2 != 0) {
            $return .= '<div class="row">';
            $return .= '  <div class="col-sm-4 col-xs-12">
			                <h4>' . $video['video_title'] . '</h4>
								 <p>' . $video['video_text'] . '</p>';
            if ($video['video_button_link']) {
                $return .= '  <a href="' . $video['video_button_link'] . '">' . $video['video_button_text'] . '</a>';
            }
            $return .= '  </div>';
            $return .= '  <div class="col-sm-8 col-xs-12">
			                 <div class="embed-youtube">
									 <iframe class="lazyload" src="https://www.youtube.com/embed/' . $video['video_code'] . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
								  </div>
			              </div>';
            $return .= '</div>';
        } else {
            $return .= '<div class="row">';
            $return .= '  <div class="col-sm-8 col-xs-12">
								  <div class="embed-youtube">
									 <iframe class="lazyload" src="https://www.youtube.com/embed/' . $video['video_code'] . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
								  </div>
							  </div>';
            $return .= '  <div class="col-sm-4 col-xs-12">
								 <h4>' . $video['video_title'] . '</h4>
								 <p>' . $video['video_text'] . '</p>';
            if ($video['video_button_link']) {
                $return .= '  <a href="' . $video['video_button_link'] . '">' . $video['video_button_text'] . '</a>';
            }
            $return .= '  </div>';
            $return .= '</div>';
        }
    }
    $return .= '</section>'; // end section/container
    return $return;
}

/* * *************************************************** */
/*   Function to return 2_column_image panel            */
/* * *************************************************** */

function getImagePanel() {
    //get data submitted on admin page
    GLOBAL $acf_blocks;
    $return = '';
    $return .= '<section class="image-panel container-fluid">';    // create content-panel section
    //get requested data for each column    
    $image_rows = ($acf_blocks ? get_field('image_row') : get_sub_field('image_row'));
    $imageRowNum = 0;
    foreach ($image_rows as $image) {
        $imageRowNum += 1;
        $imageObj = $image['image'];

        if ($imageRowNum % 2 != 0) {
            $return .= '<div class="row ' . $image['background_color'] . '">';
            $return .= '  <div class="col-sm-4 col-xs-12">
								 <h4>' . $image['image_title'] . '</h4>
								 <p>' . $image['image_text'] . '</p>';
            if ($image['image_links']) {
                foreach ($image['image_links'] as $image_link) {
                    $return .= '  	    <a href="' . $image_link['image_link_url'] . '">' . $image_link['image_link_text'] . '</a>';
                }
            }
            $return .= '  </div>';
            $return .= '  <div class="col-sm-8 col-xs-12">
			                 <div class="image-display">';
            if (isset($image['image_overlay']['image_overlay_link'])) {
                $return .= ' 		  <a href="' . $image['image_overlay']['image_overlay_link'] . '">';
            }
            $return .= '			 <img class="img-responsive lazyload" src="' . $imageObj['url'] . '" alt="' . $imageObj['alt'] . '" />';
            if (isset($image['image_overlay']['image_overlay_text'])) {
                $return .= '  <div class="image-overlay-text">' . $image['image_overlay']['image_overlay_text'] . '</div>';
                ;
            }
            if (isset($image['image_overlay']['image_overlay_link'])) {
                $return .= '        </a>';
            }
            $return .= '		</div>
			              </div>';
            $return .= '</div>';
        } else {
            $return .= '<div class="row ' . $image['background_color'] . '">';
            $return .= '  <div class="col-sm-8 col-xs-12">
			                 <div class="image-display">';
            if ($image['image_overlay']['image_overlay_link']) {
                $return .= ' 		  <a href="' . $image['image_overlay']['image_overlay_link'] . '">';
            }
            $return .= '			 <img class="img-responsive lazyload" src="' . $imageObj['url'] . '" alt="' . $imageObj['alt'] . '" />';
            if ($image['image_overlay']['image_overlay_text']) {
                $return .= '  <div class="image-overlay-text">' . $image['image_overlay']['image_overlay_text'] . '</div>';
                ;
            }
            if ($image['image_overlay']['image_overlay_link']) {
                $return .= '        </a>';
            }
            $return .= '  </div>';
            $return .= '</div>';
            $return .= '  <div class="col-sm-4 col-xs-12">
								 <h4>' . $image['image_title'] . '</h4>
								 <p>' . $image['image_text'] . '</p>';
            if ($image['image_links']) {
                foreach ($image['image_links'] as $image_link) {
                    $return .= '  	    <a href="' . $image_link['image_link_url'] . '">' . $image_link['image_link_text'] . '</a>';
                }
            }
            $return .= '  </div>';
            $return .= '</div>';
        }
    }
    $return .= '</section>'; // end section/container
    return $return;
}
