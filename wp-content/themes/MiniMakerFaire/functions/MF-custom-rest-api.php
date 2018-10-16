<?php
/* adds a custom REST API endpoint of makerfaire */
add_action('rest_api_init', function () {
   
   register_rest_route('makerfaire', '/v2/fairedata/(?P<type>[a-z0-9\-]+)/(?P<formids>[a-z0-9\-]+)', array(
      'methods' => 'GET',
      'callback' => 'mf_fairedata'
   ));
});

// TODO Add some comments
function mf_fairedata(WP_REST_Request $request) {
   $type = $request['type'];
   $formIDs = $request['formids'];
   if ($type != '' && $formIDs != '') {
      $data = array();
      switch ($type) {
         case 'mtm':
            $entity = getMTMentries($formIDs);
            $category = getCategories($formIDs);
            $data = array_merge($entity, $category);
            break;
         case 'categories':
            $data = getCategories($formIDs);
            break;
         case 'schedule':
            $schedule = getSchedule($formIDs);
            $category = getCategories($formIDs);
            $data = array_merge($schedule, $category);
            break;
      }
   } else {
      $data['error'] = 'Error: Type or Form IDs not submitted';
   }
   
   $return = 'your type is ' . $type . ' and your formids are ';
   $formArr = explode("-", $formIDs);
   foreach ($formArr as $formID) {
      $return .= $formID . ' ';
   }
   return $data;
   
}

function getMTMentries($formIDs) {
   $data['entity'] = array();
   $formIDarr = array_map('intval', explode("-", $formIDs));
   
   global $wpdb;
   // find all active entries for selected forms
   $query = "SELECT lead_detail.entry_id, lead_detail.meta_key, lead_detail.meta_value
               FROM {$wpdb->prefix}gf_entry_meta lead_detail
                    left outer join {$wpdb->prefix}gf_entry as lead on lead_detail.entry_id = lead.id
              WHERE lead.status = 'active'
                AND lead.form_id in(" . implode(",", $formIDarr) . ")
                AND (meta_key like '22' OR
                    meta_key like '16' OR
                    meta_key like '151' OR
                    meta_key like '303' OR
                    meta_key like '320' OR
                    meta_key like '321%' OR
                    meta_key like '304.%')
           ORDER BY `lead_detail`.`entry_id`  ASC";
   
   $results = $wpdb->get_results($query);
   
   // build entry array
   $entries = array();
   foreach ($results as $result) {
      $entries[$result->entry_id]['id'] = $result->entry_id;
      $entries[$result->entry_id][$result->meta_key] = $result->meta_value;
   }
   
   shuffle($entries);
   // randomly order entries
   foreach ($entries as $entry) {
      $leadCategory = array();
      $flag = '';
      if (isset($entry['303']) && $entry['303'] == 'Accepted') {
         // build category array
         foreach ($entry as $leadKey => $leadValue) {
            $pos = strpos($leadKey, '321'); // 4 additional categories
            if ($pos !== false) {
               $leadCategory[] = $leadValue;
            }
            
            // main catgory
            $pos = strpos($leadKey, '320');
            if ($pos !== false) {
               $leadCategory[] = $leadValue;
            }
            
            // flags
            $pos = strpos($leadKey, '304'); // flags
            if ($pos !== false) {
               // echo $leadValue.' ';
               $pos2 = strpos($leadValue, 'Featured');
               if ($pos2 !== false) {
                  // echo 'featured maker ';
                  $flag = $leadValue;
               }
            }
         }
         
         $projPhoto = (isset($entry['22']) ? $entry['22'] : '');
         $fitPhoto = legacy_get_resized_remote_image_url($projPhoto, 230, 181);
         $featImg = legacy_get_resized_remote_image_url($projPhoto, 800, 500);
         if ($fitPhoto === NULL || $fitPhoto === '') $fitPhoto = $projPhoto;
         if ($featImg === NULL || $featImg === '') $featImg = $projPhoto;
         
         // maker list
         $makerList = getMakerList($entry['id']);
         
         $data['entity'][] = array(
            'id' => $entry['id'],
            'name' => $entry['151'],
            'large_img_url' => $fitPhoto,
            'featured_img' => $featImg,
            'category_id_refs' => array_unique($leadCategory),
            'description' => $entry['16'],
            'flag' => $flag, // only set if flag is set to 'Featured Maker'
            'makerList' => $makerList
         );
      }
   } // end foreach $entries
   return $data;
   
}

// end getMTMentries
function getCategories($formIDs) {
   $data = array();
   $formIDarr = array_map('intval', explode("-", $formIDs));
   
   foreach ($formIDarr as $form_id) {
      $form = GFAPI::get_form($form_id);
      if (is_array($form['fields'])) {
         foreach ($form['fields'] as $field) {
            if ($field->id == '320') {
               foreach ($field->choices as $choice) {
                  if ($choice['value'] != '') {
                     $data['category'][] = array(
                        'id' => absint($choice['value']),
                        'name' => html_entity_decode(esc_js($choice['text']))
                     );
                  }
               }
            }
            if ($field->id == '321') {
               // var_dump($field);
            }
         }
      }
   }
   return $data;
   
}

function getSchedule($formIDs) {
   $data = array();
   global $wpdb;
   // setlocale(LC_ALL, get_locale());
   
   $wp_locale = get_locale();
   switch_to_locale(get_locale());
   // create type translate array
   $workshop = __('Workshop', 'MiniMakerFaire');
   $talk = __('Talk', 'MiniMakerFaire');
   $performance = __('Performance', 'MiniMakerFaire');
   $demo = __('Demo', 'MiniMakerFaire');
   
   $formIDarr = array_map('intval', explode("-", $formIDs));
   $query = "SELECT schedule.entry_id, schedule.start_dt as time_start, schedule.end_dt as time_end, schedule.type,
                    lead_detail.meta_value as entry_status, DAYOFWEEK(schedule.start_dt) as day,location.location,
                    (SELECT meta_value from {$wpdb->prefix}gf_entry_meta where entry_id = schedule.entry_id AND meta_key like '22')  as photo,
                    (SELECT meta_value from {$wpdb->prefix}gf_entry_meta where entry_id = schedule.entry_id AND meta_key like '151') as name,
                    (SELECT meta_value from {$wpdb->prefix}gf_entry_meta where entry_id = schedule.entry_id AND meta_key like '16')  as short_desc,
                    (SELECT group_concat( meta_value separator ', ') as cat
                       FROM {$wpdb->prefix}gf_entry_meta 
                      WHERE entry_id = schedule.entry_id 
                        AND (meta_key like '%320%' OR meta_key like '%321%')) as category
               FROM {$wpdb->prefix}mf_schedule as schedule       
                    left outer join {$wpdb->prefix}mf_location as location on location_id = location.id
                    left outer join {$wpdb->prefix}gf_entry as lead on schedule.entry_id = lead.id
                    left outer join {$wpdb->prefix}gf_entry_meta as lead_detail on
                    lead.id = lead_detail.entry_id and meta_key = 303
              WHERE lead.status = 'active'
                AND lead_detail.meta_value='Accepted' 
                AND lead.form_id in(" . implode(",", $formIDarr) . ") " . " ORDER BY schedule.start_dt";
   
   // retrieve project name, img (22), maker list, topics
   foreach ($wpdb->get_results($query) as $row) {
      $makerList = getMakerList($row->entry_id);
      $makerArr = array();
      
      // remove duplicates
      $catArr = explode(", ", $row->category);
      $catArr = array_unique($catArr);
      $catList = implode(", ", $catArr);
      // find out if there is an override image for this page
      // $overrideImg = findOverride($entry['id'],'mtm');
      // $projPhoto = ($row->photo=='' ? $entry['22']: $overrideImg);
      $projPhoto = $row->photo;
      $fitPhoto = legacy_get_resized_remote_image_url($projPhoto, 200, 200);
      if ($fitPhoto == NULL) $fitPhoto = $row->photo;
      
      // format start and end date
      $startDay = date_create($row->time_start);
      $startDate = date_format($startDay, 'Y-m-d') . 'T' . date_format($startDay, 'H:i:s');
      $keyDate = date_format($startDay, 'Y-m-d');
      
      $endDate = date_create($row->time_end);
      $endDate = date_format($endDate, 'Y-m-d') . 'T' . date_format($endDate, 'H:i:s');
      
      $startTime = strtotime($row->time_start);
      
      // $dayofWeek = strftime("%A",$startTime);
      $dayofWeek = date_i18n("l", $startTime);
      $type = $row->type;
      $data['schedule'][] = array(
         'id' => $row->entry_id,
         'time_start' => $startDate,
         'time_end' => $endDate,
         'name' => $row->name,
         'thumb_img_url' => $fitPhoto,
         'maker_list' => $makerList,
         'nicename' => $row->location,
         'category' => $catList,
         'dayOfWeek' => ucwords($dayofWeek),
         'desc' => $row->short_desc,
         'transType' => $$type,
         'type' => ucwords($row->type)
      );
   }
   
   return $data;
   
}

function getMakerList($entryID) {
   $makerList = '';
   $data = array();
   global $wpdb;
   $query = "SELECT *
               FROM {$wpdb->prefix}gf_entry_meta as lead_detail
              WHERE lead_detail.entry_id = $entryID 
                AND cast(meta_key as char) in('160.3', '160.6', '158.3', '158.6', '155.3', '155.6', 
                    '156.3', '156.6', '157.3', '157.6', '159.3', '159.6', '154.3', '154.6', '109', '105')";
   $entryData = $wpdb->get_results($query);
   // field 105 - who would you like listed
   // one maker, a group or association, a list of makers
   /*
    * Maker Name field #'s -> 1 - 160, 2 - 158, 3 - 155, 4 - 156, 5 - 157, 6 - 159, 7 - 154
    * Group Name - 109
    */
   $fieldData = array();
   foreach ($entryData as $field) {
      $fieldData[$field->meta_key] = $field->meta_value;
   }
   
   if (isset($fieldData['105'])) {
      $whoListed = strtolower($fieldData['105']);
      $isGroup = false;
      $isGroup = (strpos($whoListed, 'group') !== false);
      $isOneMaker = false;
      $isOneMaker = (strpos($whoListed, 'one') !== false);
      
      if ($isGroup) {
         $makerList = (isset($fieldData['109']) ? $fieldData['109'] : '');
      } elseif ($isOneMaker) {
         $makerList = (isset($fieldData['160.3']) ? $fieldData['160.3'] . ' ' . (isset($fieldData['160.6']) ? $fieldData['160.6'] : '') : '');
      } else {
         $makerArr = array();
         if (isset($fieldData['160.3'])) $makerArr[] = $fieldData['160.3'] . ' ' . $fieldData['160.6'];
         if (isset($fieldData['158.3'])) $makerArr[] = $fieldData['158.3'] . ' ' . $fieldData['158.6'];
         if (isset($fieldData['155.3'])) $makerArr[] = $fieldData['155.3'] . ' ' . $fieldData['155.6'];
         if (isset($fieldData['156.3'])) $makerArr[] = $fieldData['156.3'] . ' ' . $fieldData['156.6'];
         if (isset($fieldData['157.3'])) $makerArr[] = $fieldData['157.3'] . ' ' . $fieldData['157.6'];
         if (isset($fieldData['159.3'])) $makerArr[] = $fieldData['159.3'] . ' ' . $fieldData['159.6'];
         if (isset($fieldData['154.3'])) $makerArr[] = $fieldData['154.3'] . ' ' . $fieldData['154.6'];
         
         $makerList = implode(", ", $makerArr);
      }
   }
   
   return $makerList;
   
}