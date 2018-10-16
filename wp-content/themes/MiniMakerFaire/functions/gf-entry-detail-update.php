<?php
// Update the entry rating
function MF_update_entry_rating() {
  global $wpdb;
  $entry_id = $_POST['rating_entry_id'];
  $rating   = $_POST['rating'];
  $user     = $_POST['rating_user'];

  //update user rating

  //if there is already a record for this user, update it.
  //else add it.
  $sql = "Insert into {$wpdb->prefix}gf_entry_rating (entry_id, user_id, rating) "
       . " values (".$entry_id.','.$user.','.$rating.")"
       . " on duplicate key update rating=".$rating.", ratingDate=now()";

  $wpdb->get_results($sql);

  //update the meta with the average rating
  $sql = "SELECT avg(rating) as rating 
            FROM `{$wpdb->prefix}gf_entry_rating` where entry_id = ".$entry_id;
  $results = $wpdb->get_results($sql);
  $rating = round($results[0]->rating);

  gform_update_meta( $entry_id, 'entryRating', $rating );
  $return = 'Your Rating Has Been Saved';
  wp_send_json(array('msg'=>$return));
  // IMPORTANT: don't forget to "exit"
  exit;
}
add_action( 'wp_ajax_update-entry-rating', 'MF_update_entry_rating' );

/* Update Entry Status */
function MF_set_entry_status(){
  global $wpdb;
  $entry_id       = $_POST['entry_id'];
  $update_status  = $_POST['status'];
  $userID         = $_POST['user'];
  $entry          = GFAPI::get_entry( $entry_id );
  $form           = GFAPI::get_form( $entry['form_id']);

  $input_id       = '303';
	$current_status = $entry['303'];
	$is_acceptance_status_changed = (strcmp($current_status, $update_status) != 0);

	if (!empty($entry_id)){
		if (!empty($update_status)){
			//Handle acceptance status changes
			if ($is_acceptance_status_changed ){
        if($update_status === 'Accepted'){
          /*
           * If the status is accepted, trigger a cron job to update whatcounts
           * The cron job will trigger action sidebar_entry_update
           */
          wp_schedule_single_event(time() + 1,'sidebar_entry_update', array($entry, $form));

        }

        //Update Field for Acceptance Status
        $result = GFAPI::update_entry_field( $entry_id, $input_id, $update_status );

        //Reload entry to get any changes in status
        $entry['303'] = $update_status;

				//Create a note of the status change.
				$results = mf_add_note( $entry_id, 'EntryID:'.$entry_id.' status changed to '.$update_status, $userID);

				//Handle notifications for acceptance
				$notifications_to_send = GFCommon::get_notifications_to_send( 'mf_acceptance_status_changed', $form, $entry );
        foreach ( $notifications_to_send as $notification ) {
          if($notification['isActive']){
            GFCommon::send_notification( $notification, $form, $entry );
          }
				}
        $return = 'Status Updated';
			}else{
        $return = 'Status Not Changed';
      }

		}else{
      $return =  'Error with Status Update';
    }
	}else{
    $return =  'Error with Status Update';
  }
  wp_send_json(array('msg'=>$return));
}
add_action( 'wp_ajax_set_entry_status', 'MF_set_entry_status' );

/*
 * Add a single note
 */
function mf_add_note($entry_id,$text,$userID=''){
  if($userID==''){
    global $current_user;
    $userID = $current_user->ID;
  }
  $user_data = get_userdata( $userID );
	RGFormsModel::add_note( $entry_id, $userID, $user_data->display_name, $text );
}

//delete notes
function delete_note_sidebar(){
  $notes = (isset($_POST['note'])?$_POST['note']:array());
  if(!empty($notes)){
    RGFormsModel::delete_notes( $notes);
    $msg = 'Selected Notes Deleted';
  }else{
    $msg = 'No notes Selected';
  }
  wp_send_json(array('msg'=>$msg));
}
add_action( 'wp_ajax_delete_note_sidebar', 'delete_note_sidebar' );

//update entry flags
function update_flags(){
  $flags      = (isset($_POST['flag'])?$_POST['flag']:array());
  $entry_id   = $_POST['entry_id'];
  if (!empty($flags)){
    foreach($flags as $flags_entry){
      $exploded_flags_entry =  explode("_",$flags_entry);
      if($exploded_flags_entry[2]=='false')   $exploded_flags_entry[1] = '';
      $result = GFAPI::update_entry_field( $entry_id, $exploded_flags_entry[0], $exploded_flags_entry[1] );
    }
	}
  $msg = 'Flags Updated';
  wp_send_json(array('msg'=>$msg));
}
add_action( 'wp_ajax_update_flags', 'update_flags' );

//update entry schedule
function update_entry_schedule(){
  $entry_id   = $_POST['entry_id'];
  $location   = $_POST['location'];
  $type       = $_POST['type'];
  $entry_schedule_start  = $_POST['dateStart'];
  $entry_schedule_end    = $_POST['dateEnd'];
  if (!empty($location)){
    global $wpdb;
    $insert_query = "INSERT INTO `{$wpdb->prefix}mf_location`(`entry_id`, `location`, `location_element_id`) "
                   . " VALUES ($entry_id,'$location',3)";
    $wpdb->get_results($insert_query);
    $location_id = $wpdb->insert_id;
    if($entry_schedule_start!='' && $entry_schedule_end!=''){
      $insert_query = "INSERT INTO `{$wpdb->prefix}mf_schedule` (`entry_id`, location_id, `start_dt`, `end_dt`, type) "
              . " VALUES ($entry_id,$location_id,'$entry_schedule_start','$entry_schedule_end','$type')";
      $wpdb->get_results($insert_query);
      $schedule_id = $wpdb->insert_id;
    }
    $msg = 'Schedule/Location Added';
  }else{
    $msg = 'Location Empty';
  }

  wp_send_json(array('msg'=>$msg,'locID'=>$location_id,'sched_id'=>$schedule_id));
}
add_action( 'wp_ajax_update_entry_schedule', 'update_entry_schedule' );

/* Modify Set Entry Status */
function delete_entry_location(){
  global $wpdb;
	$locationDel      = (isset($_POST['location'])?$_POST['location']:array());
  $scheduleDel      = (isset($_POST['schedule'])?$_POST['schedule']:array());
	$delete_location  = implode(',',($locationDel));
  $delete_schedule  = implode(',',($scheduleDel));

  //delete schedule and location
	if ($delete_schedule != ''){
    //delete from schedule and location table
    $delete_query =  "DELETE `{$wpdb->prefix}mf_schedule`, `{$wpdb->prefix}mf_location`
                      from `{$wpdb->prefix}mf_schedule`, `{$wpdb->prefix}mf_location`
                      WHERE {$wpdb->prefix}mf_schedule.ID IN "
                       . "($delete_schedule) and location_id={$wpdb->prefix}mf_location.id";
    $wpdb->get_results($delete_query);
  }

  //delete location only
	if ($delete_location != ''){
    //delete from schedule and location table
    $delete_query =  "DELETE FROM `{$wpdb->prefix}mf_location` WHERE {$wpdb->prefix}mf_location.ID IN ($delete_location)";
    $wpdb->get_results($delete_query);
  }
}
add_action('wp_ajax_delete_entry_schedule','delete_entry_location');

//add a note and email
function add_entry_note(){
	global $wpdb;
  $notetext       = $_POST['note'];
  $currUserID     = $_POST['user'] ;
	$user_data      = get_userdata( $currUserID );

	$email_to       = $_POST['emailTo'];
  $entry_id       = $_POST['entry_id'];
  $entry          = GFAPI::get_entry( $entry_id );
  $project_name   = $entry['151'];
  $form_id        = $entry['form_id'];

	//emailing notes if configured
	if ( !empty($email_to) ) {
		GFCommon::log_debug( 'GFEntryDetail::lead_detail_page(): Preparing to email entry notes.' );
		$email_from    = $user_data->user_email;
		$email_subject = stripslashes( 'Response Required Maker Application: '.$entry_id.' '.$project_name);
		$entry_url = get_bloginfo( 'wpurl' ) . '/wp-admin/admin.php?page=mf_entries&view=mfentry&id=' . $form_id . '&lid=' . $entry_id;
		$body = stripslashes( $notetext). '<br /><br />Please reply in entry:<a href="'.$entry_url.'">'.$entry_url.'</a>';
		$headers = "From: \"$email_from\" <$email_from> \r\n";
		//Enable HTML Email Formatting in the body
		add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
		$result  = wp_mail( $email_to, $email_subject, $body, $headers );
		//Remove HTML Email Formatting
		remove_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
		$email_note_info = '<br /><br />:SENT TO:['.implode(",", $email_to).']';
	}

	RGFormsModel::add_note( $entry_id, $currUserID, $user_data->display_name, nl2br(stripslashes($notetext.$email_note_info)) );
  $msg = 'Note Added';
  wp_send_json(array('msg'=>$msg));
}

add_action('wp_ajax_add_entry_note','add_entry_note');

add_filter( 'gform_notification_events', 'mf_custom_notification_event' );
function mf_custom_notification_event( $events ) {
  $events['mf_acceptance_status_changed'] = __( 'Acceptance Status Changed' );
  return $events;
}