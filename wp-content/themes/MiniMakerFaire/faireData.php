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
      $entity   = FDgetMTMentries($formIDs);
      $category = FDgetCategories($formIDs);
      $data     = array_merge($entity, $category);
      break;
    case 'categories':
      $data = FDgetCategories($formIDs);
      break;
    case 'schedule':
      $schedule = FDgetSchedule($formIDs);
      $category = FDgetCategories($formIDs);
      $data     = array_merge($schedule, $category);
      break;
  }

} else {
  $data['error'] = 'Error: Type or Form IDs not submitted';
}

echo json_encode($data);
exit;

function FDgetMTMentries($formIDs) {
  $data = array();
  $formIDarr = array_map('intval', explode(",", $formIDs));

  $search_criteria['status'] = 'active';
  $search_criteria['field_filters'][] = array( 'key' => '303', 'meta_value' => 'Accepted');

  $entries = GFAPI::get_entries(0, $search_criteria, null, array('offset' => 0, 'page_size' => 999));

  //randomly order entries
  shuffle ($entries);
  foreach($entries as $entry){
    if(in_array($entry['form_id'],$formIDarr)) {
      $leadCategory = array();
      $flag = '';
      //build category array
      foreach($entry as $leadKey=>$leadmeta_value){
        $pos = strpos($leadKey, '321'); //4 additional categories
        if ($pos !== false) {
          $leadCategory[]=$leadmeta_value;
        }

        //main catgory
        $pos = strpos($leadKey, '320');
        if ($pos !== false) {
          $leadCategory[]=$leadmeta_value;
        }

        //flags
        $pos = strpos($leadKey, '304'); // flags
        if ($pos !== false) {
          //echo $leadmeta_value.'   ';
          $pos2 = strpos($leadmeta_value, 'Featured');
          if ($pos2 !== false) {
            //echo 'featured maker ';
            $flag = $leadmeta_value;
          }
        }
      }

      //find out if there is an override image for this page
      $overrideImg = findOverride($entry['id'],'mtm');

      $projPhoto = ($overrideImg=='' ? $entry['22']:$overrideImg);
      $fitPhoto  = legacy_get_fit_remote_image_url($projPhoto,230,181);
      $featImg   = legacy_get_fit_remote_image_url($projPhoto,800,500);
      if($fitPhoto==NULL) $fitPhoto = ($overrideImg=='' ? $entry['22']:$overrideImg);

      //maker list
      $makerList = getMakerList($entry['id']);

      $data['entity'][] = array(
          'id'                => $entry['id'],
          'name'              => $entry['151'],
          'large_img_url'     => $fitPhoto,
          'featured_img'      => $featImg,
          'category_id_refs'  => array_unique($leadCategory),
          'description'       => $entry['16'],
          'flag'              => $flag, //only set if flag is set to 'Featured Maker'
          'makerList'         => $makerList
          );
    }
  } //end foreach $entries
  return $data;
} //end getMTMentries

  function FDgetCategories($formIDs) {
    $data = array();
    $formIDarr = array_map('intval', explode(",", $formIDs));

    foreach($formIDarr as $form_id){
      $form = GFAPI::get_form( $form_id );
      if(is_array($form['fields'])) {
        foreach($form['fields'] as $field) {
          if($field->id=='320'){
            foreach($field->choices as $choice) {
              if($choice['meta_value']!='') {
                $data['category'][] = array('id'=>absint( $choice['meta_value'] ),'name'=>html_entity_decode( esc_js( $choice['text'] ) ));
              }
            }
          }
          if($field->id=='321'){
           // var_dump($field);
          }
        }
      }
    }
    return $data;
  }

  function FDgetSchedule($formIDs) {
    $data = array(); global $wpdb;
    $query = "SELECT schedule.entry_id, schedule.start_dt as time_start, schedule.end_dt as time_end, schedule.type,
                     lead_detail.meta_value as entry_status, DAYOFWEEK(schedule.start_dt) as day,location.location,
                     (SELECT meta_value FROM {$wpdb->prefix}gf_entry_meta WHERE entry_id = schedule.entry_id AND meta_key like '22')  as photo,
                     (SELECT meta_value FROM {$wpdb->prefix}gf_entry_meta WHERE entry_id = schedule.entry_id AND meta_key like '151') as name,
                     (SELECT meta_value FROM {$wpdb->prefix}gf_entry_meta WHERE entry_id = schedule.entry_id AND meta_key like '16')  as short_desc,
                     (SELECT group_concat( meta_value separator ', ') as cat FROM {$wpdb->prefix}gf_entry_meta WHERE entry_id = schedule.entry_id AND (meta_key like '%320%' OR meta_key like '%321%')) as category
                        FROM {$wpdb->prefix}mf_schedule as schedule
                             left outer join {$wpdb->prefix}mf_location as location on location_id = location.id
                             left outer join {$wpdb->prefix}gf_entry as lead on schedule.entry_id = lead.id
                             left outer join {$wpdb->prefix}gf_entry_meta as lead_detail on
                             schedule.entry_id = lead_detail.entry_id AND meta_key = 303
                       WHERE lead.status = 'active' AND lead_detail.meta_value='Accepted'";

    //retrieve project name, img (22), maker list, topics

    foreach($wpdb->get_results($query) as $row){
      $makerList = getMakerList($row->entry_id);
      $makerArr = array();

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
      $startDay   = date_create($row->time_start);
      $startDate  = date_format($startDay,'Y-m-d').'T'.date_format($startDay,'G:i:s');
      $keyDate    = date_format($startDay,'Y-m-d');

      $endDate = date_create($row->time_end);
      $endDate = date_format($endDate,'Y-m-d').'T'.date_format($endDate,'G:i:s');
      //"2016-05-21T11:55:00-07:00"
      $data['schedule'][$keyDate][] = array(
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

  function FDgetMakerList($entryID) {
    $makerList = '';
    $data = array(); global $wpdb;
    $query = "SELECT *
                FROM {$wpdb->prefix}gf_entry_meta as lead_detail
               WHERE lead_detail.entry_id = $entryID 
                 AND cast(meta_key as char) in('160.3', '160.6', '158.3', '158.6', '155.3', '155.6', 
                     '156.3', '156.6', '157.3', '157.6', '159.3', '159.6', '154.3', '154.6', '109', '105')";
    $entryData = $wpdb->get_results($query);
    //field 105 - who would you like listed
    //    one maker, a group or association, a list of makers
    /* Maker Name field #'s -> 1 - 160, 2 - 158, 3 - 155, 4 - 156, 5 - 157, 6 - 159, 7 - 154
     * Group Name - 109
     */

    $fieldData = array();
    foreach($entryData as $field){
      $fieldData[$field->meta_key] = $field->meta_meta_value;
    }

    if(isset($fieldData[105])){
      $whoListed = strtolower($fieldData['105']);
      $isGroup =false;
      $isGroup    = (strpos($whoListed, 'group') !== false);
      $isOneMaker = false;
      $isOneMaker = (strpos($whoListed, 'one') !== false);

      if($isGroup) {
        $makerList = $fieldData[109];
      }elseif($isOneMaker){
        $makerList = $fieldData['160.3']. ' ' .$fieldData['160.6'];
      }else{
        $makerArr = array();
        if(isset($fieldData['160.3']))  $makerArr[] = $fieldData['160.3']. ' ' .$fieldData['160.6'];
        if(isset($fieldData['158.3']))  $makerArr[] = $fieldData['158.3']. ' ' .$fieldData['158.6'];
        if(isset($fieldData['155.3']))  $makerArr[] = $fieldData['155.3']. ' ' .$fieldData['155.6'];
        if(isset($fieldData['156.3']))  $makerArr[] = $fieldData['156.3']. ' ' .$fieldData['166.6'];
        if(isset($fieldData['157.3']))  $makerArr[] = $fieldData['157.3']. ' ' .$fieldData['157.6'];
        if(isset($fieldData['159.3']))  $makerArr[] = $fieldData['159.3']. ' ' .$fieldData['159.6'];
        if(isset($fieldData['154.3']))  $makerArr[] = $fieldData['154.3']. ' ' .$fieldData['154.6'];

        $makerList = implode(", ", $makerArr);
      }
    }

    return $makerList;
  }