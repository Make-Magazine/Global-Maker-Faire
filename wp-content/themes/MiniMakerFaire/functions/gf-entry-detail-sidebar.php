<?php
////////////////////////////////////////////////////////////////////
// Entry Detail - Sidebar
///////////////////////////////////////////////////////////////////

//function to add entry status update section
add_action( 'gform_entry_detail_sidebar_before', 'mf_entry_info', 10, 2 );
function mf_entry_info( $form_id, $entry){
  ?>
  <div class="meta-box-sortables">
    <div id="entryStatus" class="postbox">
      <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Entry Status</span><span class="toggle-indicator" aria-hidden="true"></span></button>
      <h2 class="hndle ui-sortable-handle"><span>Entry Status</span></h2>
      <div class="inside">
        <?php echo mf_sidebar_entry_status( $form_id, $entry ); ?>
      </div>
    </div>
  </div>
  <?php
}

//function to add additional sidebars for entry rating, notes, flags, schedule/location, print button
add_action( 'gform_entry_detail_sidebar_middle', 'add_sidebar_text_middle', 10, 2 );
function add_sidebar_text_middle( $form, $entry ) {
  ?>
  <!-- Ratings SideBar-->
  <div class="meta-box-sortables">
    <div id="entryRating" class="postbox">
      <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Entry Rating</span><span class="toggle-indicator" aria-hidden="true"></span></button>
      <h2 class="hndle ui-sortable-handle"><span>Entry Rating</span></h2>
      <div class="inside">
        <?php echo disp_ratings($form,$entry);?>
      </div>
    </div>
  </div>

  <!-- Notes SideBar-->
  <div class="meta-box-sortables">
    <div id="entryNotes" class="postbox">
      <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Notes</span><span class="toggle-indicator" aria-hidden="true"></span></button>
      <h2 class="hndle ui-sortable-handle"><span>Notes</span></h2>
      <div class="inside">
        <?php echo disp_notes( $form, $entry);?>
      </div>
    </div>
  </div>

  <!-- Flags SideBar-->
  <div class="meta-box-sortables">
    <div id="entryFlags" class="postbox">
      <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Flags</span><span class="toggle-indicator" aria-hidden="true"></span></button>
      <h2 class="hndle ui-sortable-handle"><span>Flags</span></h2>
      <div class="inside">
        <?php echo disp_flags( $form, $entry);?>
      </div>
    </div>
  </div>

  <!-- Schedule/Location SideBar-->
  <div class="meta-box-sortables">
    <div id="entrySched" class="postbox">
      <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Location & Schedule</span><span class="toggle-indicator" aria-hidden="true"></span></button>
      <h2 class="hndle ui-sortable-handle"><span>Location & Schedule</span></h2>
      <div class="inside">
        <?php echo disp_sched( $form, $entry);?>
      </div>
    </div>
  </div>
  <?php
}

//display status update/view section
function mf_sidebar_entry_status($form_id, $lead) {
  echo ('<input type="hidden" name="entry_info_entry_id" value="'.$lead['id'].'">');
  if ( current_user_can( 'update_entry_status') ) {
    // Load Fields to show on entry info
    $form = GFAPI::get_form($form_id);
    $field303=RGFormsModel::get_field($form,'303');

    ?>
    <label class="detail-label" for="entry_info_status_change">Status: </label>
    <select id="entry_info_status_change">
    <?php
    foreach( $field303['choices'] as $choice ){
      $selected = '';
      if ($lead[$field303['id']] == $choice['text']) $selected=' selected ';
      echo('<option '.$selected.' value="'.$choice['text'].'">'.$choice['text'].'</option>');
    }
    ?>
    </select>
    <br/><br />
    <input type="submit" id="update_status" value="Save Status" class="update-status btn btn-danger" />
    <span id="statusResp"></span>
    <br/><br/>
    <i>A notification will be sent when Status is changed. Notifications can be managed at Forms > Settings</i>
    <?php
  }else{
    echo ('<label class="detail-label" for="entry_info_status_change">Status: </label>');
    echo '&nbsp;&nbsp; '.$lead[303].'<br/>';
  }
}

//display ratings sidebar - admin entry display
function disp_ratings($form, $lead){
  /* Ratings Sidebar Area */
  global $wpdb;
  // Retrieve any ratings
  $entry_id=$lead['id'];
  $sql = "SELECT user_id, rating, ratingDate FROM `{$wpdb->prefix}rg_lead_rating` where entry_id = ".$entry_id;
  $ratingTotal = 0;
  $ratingNum   = 0;
  $ratingResults = '';
  $user_ID = get_current_user_id();
  $currRating = '';
  foreach($wpdb->get_results($sql) as $row){
      $user = get_userdata( $row->user_id );

      //don't display current user in the list of rankings
      if($user_ID!=$row->user_id){
        $ratingResults .= '<tr><td style="text-align: center;">'.$row->rating.'</td><td>'.$user->display_name.'</td><td class="alignright">'.date("m-d-Y", strtotime($row->ratingDate)).'</td></tr>';
      }else{
        $currRating = $row->rating;
      }
      $ratingTotal += $row->rating;
      $ratingNum++;
  }

  $ratingAvg = ($ratingNum!=0?round($ratingTotal/$ratingNum):0);
  ?>
  <span class="sidebar-title">Entry Rating:
    <a href="#" onclick="return false;"
      data-toggle="popover" data-trigger="hover"
      data-placement="top" data-html="true"
      data-content="1 = No way<br/>2 = Low priority<br/>3 = Yes, If there’s room<br/>4 = Yes definitely<br/>5 = Hell yes">
      (?)</a> &nbsp;
    <?php echo $ratingAvg ?> stars
  </span>

  <div class="entryRating inside">
    <span class="star-rating">
      <input type="radio" name="rating" value="1" <?php echo ($currRating==1?'checked':'');?>><i></i>
      <input type="radio" name="rating" value="2" <?php echo ($currRating==2?'checked':'');?>><i></i>
      <input type="radio" name="rating" value="3" <?php echo ($currRating==3?'checked':'');?>><i></i>
      <input type="radio" name="rating" value="4" <?php echo ($currRating==4?'checked':'');?>><i></i>
      <input type="radio" name="rating" value="5" <?php echo ($currRating==5?'checked':'');?>><i></i>
    </span>
    (Your Rating)<br/>
    <span id="updateMSG" style="font-size:smaller">Average Rating: <?php echo $ratingAvg; ?> Stars from <?php echo $ratingNum;?> users.</span>
    <?php
    if($ratingResults!=''){
      echo '<table cellspacing="0" style="padding:10px 0">'
      . '       <tr>'
              . '   <td class="entry-view-field-name">Rating</td>'
              . '   <td class="entry-view-field-name">User</td>'
              . '   <td class="entry-view-field-name">Date Rated</td>'
              . '</tr>'.$ratingResults.'</table>';
    }
    ?>
  </div>
  <br/>
  <span id="ratingMSG"></span>
  <?php
}

/* Display Notes sidebar - Entry Detail */
function disp_notes($form, $lead) {
  wp_nonce_field( 'gforms_update_note', 'gforms_update_note' ) ?>
  <div class="inside">
    <?php
      $notes = RGFormsModel::get_lead_notes( $lead['id'] );

      //getting email values
      $email_fields = GFCommon::get_email_fields( $form );
      $emails = array();

      foreach ( $email_fields as $email_field ) {
        if ( ! empty( $lead[ $email_field->id ] ) ) {
          $emails[] = $lead[ $email_field->id ];
        }
      }
      //displaying notes grid
      $subject = '';
      notes_sidebar_grid( $notes, true, $emails, $subject );
      ?>
  </div>
  <br/>
  <span id="noteResp"></span>

  <?php
}

/* Notes Sidebar Grid Function */
function notes_sidebar_grid( $notes, $is_editable, $emails = null, $subject = '' ) {
    ?>
  <table class="fixed entry-detail-notes" id="entry-sidebar-notes">
    <tbody id="the-comment-list" class="list:comment">
      <?php
			$count = 0;
			$notes_count = sizeof( $notes );
			foreach ( $notes as $note ) {
				$count ++;
				$is_last = $count >= $notes_count ? true : false;
				?>
        <tr valign="top" id="note<?php echo $note->id ?>">
          <?php
          if ( $is_editable && GFCommon::current_user_can_any( 'gravityforms_edit_entry_notes' ) ) {
          ?>
          <td class="check-column" scope="row" style="padding:9px 3px 0 0">
            <input type="checkbox" value="<?php echo $note->id ?>" name="note" />
          </td>
          <?php } ?>
          <td class="entry-detail-note<?php echo $is_last ? ' lastrow' : '' ?>">
            <?php
            $class = $note->note_type ? " gforms_note_{$note->note_type}" : '';
            ?>
            <div style="margin-top: 4px;">
              <div class="note-avatar">
                <?php echo apply_filters( 'gform_notes_avatar', get_avatar( $note->user_id, 48 ), $note ); ?>
              </div>
              <h6 class="note-author">
                <?php echo esc_html( $note->user_name ) ?>
              </h6>
              <p class="note-email">
                <a href="mailto:<?php echo esc_attr( $note->user_email ) ?>"><?php echo esc_html( $note->user_email ) ?></a><br />
                <?php _e( 'added on', 'gravityforms' ); ?>
                <?php echo esc_html( GFCommon::format_date( $note->date_created, false ) ) ?>
              </p>
            </div>
            <div class="detail-note-content<?php echo $class ?>">
              <?php echo html_entity_decode( $note->value ) ?>
            </div>
          </td>
        </tr>
      <?php }?>
    </tbody>
  </table>
  <?php
  if ( sizeof( $notes ) > 0 && $is_editable && GFCommon::current_user_can_any( 'gravityforms_edit_entry_notes' ) ) {
    ?>
    <input type="submit" id="delete_note_sidebar" value="Delete Selected Note(s)" class="button" />
    <?php
  }
}

//used to display form and entry flags
function disp_flags($form, $lead) {
  $field304=RGFormsModel::get_field($form,'304');

  if(is_array($field304['inputs'])){
    foreach($field304['inputs'] as $choice){
      $selected = '';
      if (stripslashes($lead[$choice['id']]) == stripslashes($choice['label'])) $selected=' checked ';
      echo('<input type="checkbox" '.$selected.' name="entry_info_flags" style="margin: 3px;" value="'.$choice['id'].'_'.$choice['label'].'" />'.$choice['label'].' <br />');
    }
  }
  echo '<br/>';
  $entry_sidebar_button = '<input type="submit" id="update_flags" value="Update Flags" class="button">';
	echo $entry_sidebar_button;
  echo '<br/>';
  echo '<span id="flagResp"></span>';
}

//used to display schedule and location information
function disp_sched( $form, $lead) {
  global $wpdb;
  $form_id = $form['id'];
  ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/jquery.datetimepicker.css"/>
  <div id="scheduledItems"><?php echo display_schedule($form_id,$lead);?></div>
  <?php
  // Set up the Add to Schedule Section
  $sql = "select distinct(location) as location from {$wpdb->prefix}mf_location";

  $locArr = array();
  $options = '';
  foreach($wpdb->get_results($sql,ARRAY_A) as $row){
    $options .= '<option value="'.$row['location'].'">'.$row['location'].'</option>';
  }
  ?>
  <!-- Scheduling section -->
  <label for="locationSel">Select Location:</label>
  <select id="locationSel">
    <?php echo $options;?>
    <option value="new">Add new</option>
  </select>
  <input type="text" name="update_entry_location_code" <?php echo (empty($options)?"":'style="display:none"');?> id="update_entry_location_code" />
  <div class="clear"></div>

  <input type="checkbox" id="dispSchedSect" value="yes" />  Add Date & Time
  <!-- Only show when #dispSchedSect is selected-->
  <div id="schedSect" style="display:none">
    <label for="schedAdd">Start/End:</label>
    <div id="schedAdd">
      <div style="padding:10px 0;width:40px;float:left">Start: </div>
      <div style="float:left">
        <input type="text" value="" name="datetimepickerstart" id="datetimepickerstart">
      </div>
      <div class="clear" style="padding:10px 0;width:40px;float:left">End:</div>
      <div style="float:left">
        <input type="text" value="" name="datetimepickerend" id="datetimepickerend">
      </div>
    </div>
    <div class="clear"></div>
    <label for="typeSel">Type: </label>
    <select id="typeSel">
      <option value="">Please Select</option>
      <option value="workshop">Workshop</option>
      <option value="talk">Talk</option>
      <option value="performance">Performance</option>
      <option value="demo">Demo</option>
    </select>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
  <input type="submit" id="update_entry_schedule" value="Add" class="button" /><br />

  <br/>
  <span id="schedResp"></span>
  <?php
}

function display_schedule($form_id,$lead,$section='sidebar'){
  global $wpdb;
  //first, let's display any schedules already entered for this entry
  $entry_id=$lead['id'];
  $sql = "select `{$wpdb->prefix}mf_schedule`.`ID` as schedule_id, `{$wpdb->prefix}mf_schedule`.`entry_id`,
                 `{$wpdb->prefix}mf_schedule`.`type`,
                  location.ID as location_id, location.location,
                 `{$wpdb->prefix}mf_schedule`.`start_dt`, `{$wpdb->prefix}mf_schedule`.`end_dt`,
                 `{$wpdb->prefix}mf_schedule`.`day`

          from {$wpdb->prefix}mf_location location
          left outer join {$wpdb->prefix}mf_schedule on `{$wpdb->prefix}mf_schedule`.`entry_id` = ".$entry_id."
            and {$wpdb->prefix}mf_schedule.location_id = location.ID

          where location.entry_id=".$entry_id."
          order by location ASC, start_dt ASC";

  $scheduleArr = array();
  foreach($wpdb->get_results($sql,ARRAY_A) as $row){
    //order entries by location, then date
    $location    = $row['location'];
    $type        = $row['type'];
    $start_dt    = ($row['start_dt'] != NULL ? strtotime($row['start_dt'])  : '');
    $end_dt      = ($row['end_dt']   != NULL ? strtotime($row['end_dt'])    : '');
    $schedule_id = ($row['schedule_id'] != NULL ? (int) $row['schedule_id'] : '');
    $date        = ($start_dt != '' ? date("n/j/y",$start_dt) : '');
    $timeZone    = '';

    //build array
    $schedules[$row['location_id']]['location'] = $location;

    if($date!=''){
      $schedules[$row['location_id']]['schedule'][$date][$schedule_id] = array('start_dt' => $start_dt, 'end_dt' => $end_dt, 'timeZone'=>$timeZone, 'type'=>$type);
    }
  }

  //make sure there is data to display
  if($wpdb->num_rows !=0){
    echo '<div id="locationList">';
    //let's loop thru the schedule array now
    foreach($schedules as $location_id=>$data){
      $stage       = $data['location'];
      $scheduleArr = (isset($data['schedule'])?$data['schedule']:'');
      if(is_array($scheduleArr)){
        foreach($scheduleArr as $date=>$schedule){
          if($date!=''){

            foreach($schedule as $schedule_id=>$schedData){
              $start_dt   = $schedData['start_dt'];
              $end_dt     = $schedData['end_dt'];
              $db_tz      = $schedData['timeZone'];
              $type       = $schedData['type'];

              //set time zone for faire
              /*
              $dateTime = new DateTime();
              $dateTime->setTimeZone(new DateTimeZone($db_tz));
              $timeZone = $dateTime->format('T');*/
              if($section!='summary'){
                ?>
                <div id="schedule<?php echo $schedule_id; ?>" class="schedBox">
                  <input type="checkbox" value="<?php echo $schedule_id; ?>" name="delete_schedule" />
                  <span class="schedInfo">
                    <span><?php echo $stage;?></span>
                    <div class="clear"></div>
                    <div class="startDt"><?php echo date('l n/j/y',strtotime($date));?></div>
                    <span class="time"><?php echo date("g:i A",$start_dt).' - ' .date("g:i A",$end_dt);?></span>
                    <div class="clear"></div>
                    <?php echo ($type!=''? '<div class="innerInfo">Type: '.ucwords($type).'</div>':'');?>
                  </span>
                  <div class="clear"></div>
                </div>
                <?php
              }else{
                //display the schedule only
                ?>
                <div class="schedBox">
                  <span class="schedInfo">
                    <span><?php echo $stage;?></span>
                    <div class="clear"></div>
                    <div class="startDt"><?php echo date('l n/j/y',strtotime($date));?></div>
                    <span class="time"><?php echo date("g:i A",$start_dt).' - ' .date("g:i A",$end_dt);?></span>
                    <div class="clear"></div>
                    <?php echo ($type!=''? '<div class="innerInfo">Type: '.ucwords($type).'</div>':'');?>
                  </span>
                  <div class="clear"></div>
                </div>
                <?php
              }

            }

          }
        }
      }else{ //if there is no schedule data
        //location only display checkbox to delete
        if($section!='summary'){
          echo ('<div id="location'.$location_id.'" class="locBox">'
                  . '<input type="checkbox" value="'.$location_id.'" name="delete_location_id" /> '
                  . '<span class="stageName">'.$stage.'</span>'
              . '</div>');
        }
      }
    }
    echo '</div>';// close #locationList
    if($section!='summary'){
      $entry_delete_button = '<input type="submit" id="delete_entry_schedule" value="Delete Selected" class="button");"/><br />';
      echo $entry_delete_button;
    }
  }
}

