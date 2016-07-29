<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// ../  /wp-content
// ../  /themes
// ../  /miniMakerFaire
 include '../../../wp-load.php';
//retrieve GET variables
$type    = (isset($_GET['type'])     ? sanitize_text_field($_GET['type'])    : '');
$formIDs = (isset($_GET['formIDs'])  ? sanitize_text_field($_GET['formIDs']) : '');

if($type != '' && $formIDs != '') {
  $data = array();
  switch ($type) {
    case 'mtm':
      $entity   = getMTMentries($formIDs);
      $category = getCategories($formIDs);
      $data     = array_merge($entity, $category);
      break;
    case 'categories':
      $data = getCategories($formIDs);
      break;
    case 'schedule':
      $schedule = getSchedule($formIDs);
      $category = getCategories($formIDs);
      $data     = array_merge($schedule, $category);
      break;
  }

} else {
  $data['error'] = 'Error: Type or Form IDs not submitted';
}

echo json_encode($data);
exit;

function getMTMentries($formIDs) {
  $data = array();
  $formIDarr = explode(",", $formIDs);

  $search_criteria['status'] = 'active';
  $search_criteria['field_filters'][] = array( 'key' => '303', 'value' => 'Accepted');

  $entries = GFAPI::get_entries($formIDarr, $search_criteria, null, array('offset' => 0, 'page_size' => 999));

  //randomly order entries
  shuffle ($entries);
  foreach($entries as $entry){
    $leadCategory = array();
    $flag = '';
    //build category array
    foreach($entry as $leadKey=>$leadValue){
      $pos = strpos($leadKey, '321'); //4 additional categories
      if ($pos !== false) {
        $leadCategory[]=$leadValue;
      }

      //main catgory
      $pos = strpos($leadKey, '320');
      if ($pos !== false) {
        $leadCategory[]=$leadValue;
      }

      //flags
      $pos = strpos($leadKey, '304'); // flags
      if ($pos !== false) {
        //echo $leadValue.'   ';
        $pos2 = strpos($leadValue, 'Featured');
        if ($pos2 !== false) {
          //echo 'featured maker ';
          $flag = $leadValue;
        }
      }
    }



    //find out if there is an override image for this page
    $overrideImg = findOverride($entry['id'],'mtm');

    $projPhoto = ($overrideImg=='' ? $entry['22']:$overrideImg);
    $fitPhoto  = legacy_get_fit_remote_image_url($projPhoto,230,181);
    if($fitPhoto==NULL) $fitPhoto = ($overrideImg=='' ? $entry['22']:$overrideImg);
    $data['entity'][] = array(
        'id'                => $entry['id'],
        'name'              => $entry['151'],
        'large_img_url'     => $fitPhoto,
        'category_id_refs'  => array_unique($leadCategory),
        'description'       => $entry['16'],
        'flag'              => $flag //only set if flag is set to 'Featured Maker'
        );
    }
    return $data;
  }

  function getCategories($formIDs) {
    $data = array();
    $formIDarr = explode(",", $formIDs);
    foreach($formIDarr as $form_id){
      $form = GFAPI::get_form( $form_id );
      if(is_array($form['fields'])) {
        foreach($form['fields'] as $field) {
          if($field->id==320){
            foreach($field->choices as $choice) {
              if($choice['value']!='') {
                $data['category'][] = array('id'=>absint( $choice['value'] ),'name'=>html_entity_decode( esc_js( $choice['text'] ) ));
              }
            }
          }
          if($field->id==321){
           // var_dump($field);
          }
        }
      }
    }
    return $data;
  }

  function getSchedule($formIDs) {
    $data = array(); global $wpdb;
    $query = "SELECT schedule.entry_id, schedule.start_dt as time_start, schedule.end_dt as time_end, schedule.type,
              lead_detail.value as entry_status, DAYOFWEEK(schedule.start_dt) as day,location.location,
              (select value from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND field_number like '22')  as photo,
              (select value from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND field_number like '151') as name,
              (select value from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND field_number like '16')  as short_desc,
              (select group_concat( value separator ', ') as cat   from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND (field_number like '%320%' OR field_number like '%321%')) as category,
              (select group_concat( value separator ' ') as Maker1 from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND (field_number like '160.3' OR field_number like '160.6')) as maker1,
              (select group_concat( value separator ' ') as Maker2 from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND (field_number like '158.3' OR field_number like '158.6')) as maker2,
              (select group_concat( value separator ' ') as Maker3 from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND (field_number like '155.3' OR field_number like '155.6')) as maker3,
              (select group_concat( value separator ' ') as Maker4 from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND (field_number like '156.3' OR field_number like '156.6')) as maker4,
              (select group_concat( value separator ' ') as Maker5 from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND (field_number like '157.3' OR field_number like '157.6')) as maker5,
              (select group_concat( value separator ' ') as Maker6 from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND (field_number like '159.3' OR field_number like '159.6')) as maker6,
              (select group_concat( value separator ' ') as Maker7 from {$wpdb->prefix}rg_lead_detail where lead_id = schedule.entry_id AND (field_number like '154.3' OR field_number like '154.6')) as maker7
               FROM {$wpdb->prefix}mf_schedule as schedule
               left outer join {$wpdb->prefix}mf_location as location on location_id = location.id
               left outer join {$wpdb->prefix}rg_lead as lead on schedule.entry_id = lead.id
               left outer join {$wpdb->prefix}rg_lead_detail as lead_detail on
                   schedule.entry_id = lead_detail.lead_id and field_number = 303
               where lead.status = 'active' and lead_detail.value='Accepted'";

    //retrieve project name, img (22), maker list, topics

    foreach($wpdb->get_results($query) as $row){
      $makerArr = array();
      if($row->maker1 != NULL)  $makerArr[] = $row->maker1;
      if($row->maker2 != NULL)  $makerArr[] = $row->maker2;
      if($row->maker3 != NULL)  $makerArr[] = $row->maker3;
      if($row->maker4 != NULL)  $makerArr[] = $row->maker4;
      if($row->maker5 != NULL)  $makerArr[] = $row->maker5;
      if($row->maker6 != NULL)  $makerArr[] = $row->maker6;
      if($row->maker7 != NULL)  $makerArr[] = $row->maker7;
      $makerList = implode(",", $makerArr);

      //remove duplicates
      $catArr = explode(", ", $row->category);
      $catArr = array_unique($catArr);
      $catList = implode(", ",$catArr);
      //find out if there is an override image for this page
      //$overrideImg = findOverride($entry['id'],'mtm');
      //$projPhoto = ($row->photo=='' ? $entry['22']: $overrideImg);
      $projPhoto = $row->photo;
      $fitPhoto  = legacy_get_fit_remote_image_url($projPhoto,230,181);
      if($fitPhoto==NULL) $fitPhoto = $row->photo;

      //format start and end date
      $startDate = date_create($row->time_start);
      $startDate = date_format($startDate,'Y-m-d').'T'.date_format($startDate,'G:i:s');

      $endDate = date_create($row->time_end);
      $endDate = date_format($endDate,'Y-m-d').'T'.date_format($endDate,'G:i:s');
      //"2016-05-21T11:55:00-07:00"
      $data['schedule'][] = array(
            'id'            => $row->entry_id,
            'time_start'    => $startDate,
            'time_end'      => $endDate,
            'name'          => $row->name,
            'thumb_img_url' => $fitPhoto,
            'maker_list'    => $makerList,
            'nicename'      => $row->location,
            'category'      => $catList,
            'day'           => (int) $row->day,
            'desc'          => $row->short_desc,
            'type'          => ucwords($row->type)
      );

    }

    return $data;
  }