<?php
/**
 * Template Name: Entry
 *
 * @version 2.0
 */
global $wp_query;
$entryId = $wp_query->query_vars['eid'];
$entry = GFAPI::get_entry($entryId);

//entry not found
if (isset($entry->errors)) {
    $entry = array();
    $faire = '';
    $formType = '';
    $form_id = '';
} else {
    //find outwhich faire this entry is for to set the 'look for more makers link'
    $faire = $slug = $faireID = $show_sched = $faire_end = '';
    $form_id = $entry['form_id'];
    $form = GFAPI::get_form($form_id);
    $formType = $form['form_type'];
    // if they don't set the mtm the makers page like we asked, we'll set a default
    $formMtmUrl = getTplPageURL('page-meet-the-makers.php');
    if (!empty($form['form_mtm_url'])) {
        $formMtmUrl = $form['form_mtm_url'];
    }
    $formScheduleUrl = getTplPageURL('page-schedule.php');
    if (!empty($form['form_schedule_url'])) {
        $formScheduleUrl = $form['form_schedule_url'];
    }

    // build an array of the category name/id codes we can use for the tags
    $categoryArray = [];
    if (is_array($form['fields'])) {
        foreach ($form['fields'] as $field) {
            if ($field->id == '320') {
                foreach ($field->choices as $choice) {
                    if ($choice['value'] != '') {
                        $categoryArray[absint($choice['value'])] = html_entity_decode(esc_js($choice['text']));
                    }
                }
            }
        }
    }
}

$makers = array();
if (isset($entry['160.3']))
    $makers[] = array('firstname' => $entry['160.3'], 'lastname' => $entry['160.6'],
        'bio' => (isset($entry['234']) ? $entry['234'] : ''),
        'photo' => (isset($entry['217']) ? $entry['217'] : '')
    );
if (isset($entry['158.3']))
    $makers[] = array('firstname' => $entry['158.3'], 'lastname' => $entry['158.6'],
        'bio' => (isset($entry['258']) ? $entry['258'] : ''),
        'photo' => (isset($entry['224']) ? $entry['224'] : '')
    );
if (isset($entry['155.3']))
    $makers[] = array('firstname' => $entry['155.3'], 'lastname' => $entry['155.6'],
        'bio' => (isset($entry['259']) ? $entry['259'] : ''),
        'photo' => (isset($entry['223']) ? $entry['223'] : '')
    );
if (isset($entry['156.3']))
    $makers[] = array('firstname' => $entry['156.3'], 'lastname' => $entry['156.6'],
        'bio' => (isset($entry['260']) ? $entry['260'] : ''),
        'photo' => (isset($entry['222']) ? $entry['222'] : '')
    );
if (isset($entry['157.3']))
    $makers[] = array('firstname' => $entry['157.3'], 'lastname' => $entry['157.6'],
        'bio' => (isset($entry['261']) ? $entry['261'] : ''),
        'photo' => (isset($entry['220']) ? $entry['220'] : '')
    );
if (isset($entry['159.3']))
    $makers[] = array('firstname' => $entry['159.3'], 'lastname' => $entry['159.6'],
        'bio' => (isset($entry['262']) ? $entry['262'] : ''),
        'photo' => (isset($entry['221']) ? $entry['221'] : '')
    );
if (isset($entry['154.3']))
    $makers[] = array('firstname' => $entry['154.3'], 'lastname' => $entry['154.6'],
        'bio' => (isset($entry['263']) ? $entry['263'] : ''),
        'photo' => (isset($entry['219']) ? $entry['219'] : '')
    );

$groupname = (isset($entry['109']) ? $entry['109'] : '');
$groupphoto = (isset($entry['111']) ? $entry['111'] : '');
$groupbio = (isset($entry['110']) ? $entry['110'] : '');

// One maker
// A list of makers (7 max)
// A group or association
$displayType = (isset($entry['105']) ? $entry['105'] : '');

$isGroup = $isList = $isSingle = false;
$isGroup = (strpos($displayType, 'group') !== false);
$isList = (strpos($displayType, 'list') !== false);
$isSingle = (strpos($displayType, 'One') !== false);
$sharing_cards = new mf_sharing_cards();

//Change Project Name
$project_name = (isset($entry['151']) ? $entry['151'] : '');

// Url
$project_photo = (isset($entry['22']) ? legacy_get_fit_remote_image_url($entry['22'], 750, 500) : '');
$sharing_cards->project_photo = $project_photo;

// Description
$project_short = (isset($entry['16']) ? $entry['16'] : '');
$sharing_cards->project_short = $project_short;

//Website
$project_website = (isset($entry['27']) ? $entry['27'] : '');
// Video
$project_video = (isset($entry['32']) ? $entry['32'] : '');
// Title
$project_title = (isset($entry['151']) ? (string) $entry['151'] : '');
$project_title = preg_replace('/\v+|\\\[rn]/', '<br/>', $project_title);
$sharing_cards->project_title = $project_title;

// Categories
$mainCategory = '';
$categories = array();
if (isset($entry['320'])) {
    $mainCategory = $categoryArray[$entry['320']];
    $categories[] = $mainCategory;
}

foreach ($entry as $key => $value) {
    if (strpos($key, '321.') !== false && $value != null) {
        if (array_key_exists($value, $categoryArray)) {
            if (!in_array($categoryArray[$value], $categories)) {
                $categories[] = $categoryArray[$value];
            }
        } else {
            $categories[] = $value;
        }
    }
}
$categoryDisplay = display_categories($categories, $formMtmUrl);


//Url
global $wp;
$canonical_url = home_url($wp->request) . '/';
$sharing_cards->canonical_url = $canonical_url;

$sharing_cards->set_values();
get_header();
?>

<div class="clear"></div>

<!-- wrapper to keep the different colored background -->
<div class="container-fluid entry-page">
    <div class="row">
        <div class="content col-xs-12">            
            <div class="container entry-page">                
                <div class="row">
                    <?php
                    //if entry is active and accepted display entry information
                    if (is_array($entry) && isset($entry['status']) && $entry['status'] == 'active' && isset($entry[303]) && $entry[303] == 'Accepted') {
                        ?>
                        <div class="col-md-8 col-sm-12 col-xs-12" id="viewEntry">
                            <?php
                            //display schedule/location information if there is any
                            /* if (!empty(display_entry_schedule($entryId))) {
                              display_entry_schedule($entryId);
                              } */
                            ?>
                            <div class="entry-type">
                                <?php
                                if ($displayFormType == true) {
                                    echo $formType;
                                }
                                ?>
                            </div> <!-- / .entry-type -->

                            <div class="entry-header">
                                <h1><?php echo $project_title; ?></h1>
                            </div> <!-- / . entry-header -->

                            <?php
                            /* This is where the social would go
                              $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                              echo do_shortcode('[easy-social-share buttons="facebook,pinterest,reddit,twitter,linkedin,love,more"  morebutton_icon="dots" morebutton="2" counters=1 counter_pos="bottom" total_counter_pos="hidden" style="icon" fullwidth="yes" template="metro-retina" postid="' . $entryId . '" url="' . $url . '" text="' . $project_title . '"]');
                             */
                            ?>
                            <p id="proj_img">
                                <img class="img-responsive dispPhoto lazyload" src="<?php echo $project_photo; ?>" alt="<?php echo $project_title; ?>"/>
                            </p>
                            <p class="lead"><?php echo nl2br(make_clickable($project_short)); ?></p>

                            <!-- Button to trigger video modal / should just show video like makerfaire does -->
                            <?php
                            if (!empty($project_video)) {
                                $project_video = str_replace('http://', 'https://', $project_video);
                                $dispVideo = str_replace('//vimeo.com', '//player.vimeo.com/video', $project_video);
                                //youtube has two type of url formats we need to look for and change
                                $videoID = parse_yturl($dispVideo);
                                if ($videoID != '') {
                                    $dispVideo = 'https://www.youtube.com/embed/' . $videoID;
                                }
                                echo '<div class="entry-video">
                                        <iframe src="' . $dispVideo . '" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                      </div>';
                            }
                            ?>

                            <?php
                            if (!empty($project_website)) {
                                //$project_website = str_replace( 'http://', 'https://', $project_website );
                                echo '<a href="' . $project_website . '" class="btn universal-btn entry-website" target="_blank">' . __('Project Website', 'MiniMakerFaire') . '</a>';
                            }
                            if ($categoryDisplay) {
                                ?>
                                <div class="entry-categories"><?php echo $categoryDisplay; ?></div><?php
                            }
                            ?>
                        </div> <!-- / #viewEntry-->
                        <div class="col-md-4 col-sm-12 col-xs-12" id="entrySidebar">
                            <div class="sidebar-type">
                                <div class="entry-header">
                                    <h2>
                                        <?php
                                        if ($isGroup) {
                                            _e('Group', 'MiniMakerFaire');
                                        } elseif ($isList) {
                                            _e('Makers', 'MiniMakerFaire');
                                        } else {
                                            _e('Maker', 'MiniMakerFaire');
                                        }
                                        ?>
                                    </h2>
                                </div> <!-- close .entry-header -->

                                <?php
                                if ($isGroup) {
                                    echo '<div class="entry-page-maker-info">
                                             <div class="row pad-bottom">
                                                 <div class="col-xs-12">
                                                     <h3>' . $groupname . '</h3>
						</div>
						<div class="col-xs-6">
                                                     <div class="entry-page-maker-img">' .
                                    (!empty($groupphoto) ? '<img class="img-responsive lazyload" src="' . legacy_get_fit_remote_image_url($groupphoto, 200, 250) . '" alt="' . $groupname . '">' : '<img class="img-responsive lazyload" src="' . get_stylesheet_directory_uri() . '/img/maker-placeholder.jpg" alt="Group Image">')
                                    . '  </div>
                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="col-xs-12">
                                                     <p>' . make_clickable($groupbio) . '</p>
                                                 </div>
                                             </div>
                                         </div><!-- /.entry-page-maker-info -->';
                                } else {
                                    foreach ($makers as $maker) {
                                        if ($maker['firstname'] != '' && $maker['lastname'] != '') {
                                            echo '<div class="entry-page-maker-info">
                                                     <div class="row pad-bottom">
							<div class="col-xs-12">
                                                             <h3>' . $maker['firstname'] . ' ' . $maker['lastname'] . '</h3>
							</div>
							<div class="col-xs-6">
                                                             <div class="entry-page-maker-img">' .
                                            (!empty($maker['photo']) ? '<img class="img-responsive lazyload" src="' . legacy_get_fit_remote_image_url($maker['photo'], 200, 250) . '" alt="' . $maker['firstname'] . ' ' . $maker['lastname'] . '">' : '<img class="img-responsive lazyload" src="' . get_stylesheet_directory_uri() . '/img/maker-placeholder.jpg" alt="Maker Image">') .
                                            '</div>
							</div>
                                                     </div>
                                                     <div class="row">
                                                         <div class="col-xs-12">
                                                             <p>' . make_clickable($maker['bio']) . '</p>
							</div>
                                                     </div>
                                                 </div>';
                                        }
                                    } //end foreach makers
                                } //end else $isGroup
                                ?>
                                <br />
                                <?php
                                if (display_groupEntries($entryId)) {
                                    echo display_groupEntries($entryId);
                                }
                                ?>

                            </div><!-- .sidebar-type -->
                        </div><!--#entrySidebar-->
                        <?php
                    } else { //entry is not active
                        echo '<h2>';
                        _e('Invalid entry', 'MiniMakerFaire');
                        echo '</h2>';
                    }
                    ?>
                </div><!--row-->                
            </div><!--entry-page-->
            <div class="entry-footer"><?php echo displayEntryFooter($formMtmUrl, $formScheduleUrl); ?></div>
        </div>
    </div>
</div>


<?php
get_footer();

function display_entry_schedule($entry_id) {
    global $wpdb;
    global $faireID;
    global $faire;
    global $show_sched;
    global $faire_logo;
    if (!$show_sched) {
        return;
    }
    $faire_url = "/$faire";

    $sql = "SELECT location.entry_id, area.area, subarea.subarea, subarea.nicename, location.location, schedule.start_dt, schedule.end_dt
            FROM  {$wpdb->prefix}mf_location location
            join  {$wpdb->prefix}mf_faire_subarea subarea
                  ON  location.subarea_id = subarea.ID
            join  {$wpdb->prefix}mf_faire_area area
                  ON subarea.area_id = area.ID and area.faire_id = $faireID
            left  join {$wpdb->prefix}mf_schedule schedule
                  ON location.ID = schedule.location_id
            WHERE location.entry_id=$entry_id
            GROUP BY area, subarea, location";
    $results = $wpdb->get_results($sql);

    if ($wpdb->num_rows > 0) {
        ?>
        <div id="entry-schedule">
            <span class="faireBadge pull-left">
                <?php
                if ($faire_logo != '') {
                    $faire_logo = legacy_get_fit_remote_image_url($faire_logo, 51, 51);
                    echo '<a href="' . $faire_url . '"><img src="' . $faire_logo . '" alt="' . $faire . ' - badge" /></a>';
                }
                ?>
            </span>
            <span class="faireTitle pull-left">
                <a href="<?= $faire_url ?>">
                    <span class="faireLabel">Live at</span><br/>
                    <div class="faireName"><?php echo ucwords(str_replace('-', ' ', $faire)); ?></div>
                </a>
            </span>
            <?php // TBD - dynamically set these links and images    ?>
            <div class="faireActions">
                <span class="pull-right">
                    <a class="flagship-icon-link" href="/wp-content/uploads/2016/06/NMF-Map_2016__8.5x11_Pg-2.pdf">
                        <img class="actionIcon" src="https://makerfaire.com/wp-content/uploads/2016/01/icon-map.png" alt="Map Icon" width="40px" scale="0">
                        <?php __('Event Map', 'MiniMakerFaire') ?>
                    </a>
                </span>
                <span class="pull-right">
                    <a class="flagship-icon-link" href="http://makerfaire.com/national-2016/schedule/">
                        <img class="actionIcon" src="https://makerfaire.com/wp-content/uploads/2016/01/icon-schedule.png" alt="Schedule Icon" width="40px" scale="0">
                    </a>
                    <span class="pull-right "><a href="http://makerfaire.com/national-2016/schedule/"><?php __('View full schedule', 'MiniMakerFaire') ?></a><br/>
                        <a class="flagship-icon-link" href="/wp-content/uploads/2016/06/NMF-ProgramGuide_2016_v2.pdf"><?php __('Download the program guide', 'MiniMakerFaire') ?></a>
                    </span>
                </span>
            </div>
            <div class="clear"></div>

            <table>
                <?php
                foreach ($results as $row) {
                    echo '<tr>';
                    if (!is_null($row->start_dt)) {
                        $start_dt = strtotime($row->start_dt);
                        $end_dt = strtotime($row->end_dt);
                        echo '<td><b>' . date("l, F j", $start_dt) . '<b></td>'
                        . ' <td>' . date("g:i a", $start_dt) . ' - ' . date("g:i a", $end_dt) . '</td>';
                    } else {
                        global $faire_start;
                        global $faire_end;

                        $faire_start = strtotime($faire_start);
                        $faire_end = strtotime($faire_end);

                        //tbd change this to be dynamically populated
                        echo '<td>' . __('Friday, Saturday and Sunday', 'MiniMakerFaire') . ': ' . date("F j", $faire_start) . '-' . date("j", $faire_end) . '</td>';
                    }
                    echo '<td>' . $row->area . '</td><td>' . ($row->nicename != '' ? $row->nicename : $row->subarea) . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
        <?php
    }
}

/* This function is used to display grouped entries and links */

function display_groupEntries($entryID) {
    global $wpdb;
    global $faireID;
    global $faire;
    $return = '';
    $table_name = $wpdb->prefix . 'gf_entry_rel';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'")) {
        $sql = "SELECT * from {$wpdb->prefix}gf_entry_rel where parentID = " . $entryID . " or childID = " . $entryID;
        $results = $wpdb->get_results($sql);
        if ($wpdb->num_rows > 0) {
            if ($results[0]->parentID == $entryID) {
                $title = __('Exhibits in this group:', 'MiniMakerFaire');
                $type = 'parent';
            } else {
                $title = __('Part of a group:', 'MiniMakerFaire');
                $type = 'child';
            }
            $return .= $title . '<br/>';
            $return .= '<div class="row">';
            foreach ($results as $row) {
                $link_entryID = ($type == 'parent' ? $row->childID : $row->parentID);
                $entry = GFAPI::get_entry($link_entryID);
                //Title
                $project_title = (isset($entry['151']) ? (string) $entry['151'] : '');
                $project_title = preg_replace('/\v+|\\\[rn]/', '<br/>', $project_title);
                $return .= '<div class="col-md-4 col-sm-6">';
                $return .= '<a href="/maker/entry/' . $link_entryID . '">' . $project_title . '</a></div>';
            }
            $return .= '</div>';
        }
    }
    echo $return;
}

// provide a linked list of the categories
function display_categories($catArray, $mtm) {
    if (!empty($catArray[0])) {
        global $url_sub_path;
        $return = '<b>Categories:</b>';
        foreach ($catArray as $value) {
            // currently only would work if there is only the one meet-the-makers page
            $return .= ' <a href="' . $mtm . '?category=' . urlencode($value) . '">' . $value . '</a>,';
        }
        return rtrim($return, ',');
    }
}

function getTplPageURL($TEMPLATE_NAME) {
    $pages = query_posts(array(
        'post_type' => 'page',
        'post_status' => array('publish'),
        'meta_key' => '_wp_page_template',
        'meta_value' => $TEMPLATE_NAME
    ));
    $url = null;
    // url should be the last page of the template found (if a page of that template exists)
    if (!empty($pages)) {
        $url = get_page_link($pages[0]->ID);
    }
    return $url;
}

function displayEntryFooter($mtmLink, $scheduleLink) {
    $return .= '<div class="faireActions container">';
    global $form;
    
    $dispMTMButton   = (isset($form['form_disp_mtm_button'])?$form['form_disp_mtm_button']:'');
    $dispSchedButton = (isset($form['form_disp_schedule_button'])?$form['form_disp_schedule_button']:'');
    
    if (getTplPageURL("page-meet-the-makers.php") && $dispMTMButton!='hide') {
        $return .= '<div class="faireAction-box">
		<a class="btn universal-btn" href="' . $mtmLink . '"><h4>Look for More Makers</h4></a>
	</div>';
    }
    if (getTplPageURL("page-schedule.php") && $dispSchedButton!='hide') {
        $return .= '<div class="faireAction-box">
			              <a class="btn universal-btn" href="' . $scheduleLink . '"><h4>View Full Schedule</h4></a>
		             </div>';
    }
    $return .= '</div>';

    return $return;
}
?>