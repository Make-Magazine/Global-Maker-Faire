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
      $data = getMTMentries($formIDs);
      break;
    case 'categories':
      $data = getCategories($formIDs);
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
  $search_criteria['field_filters'][] = array( 'key' => '304', 'value' => 'Featured Maker');
  $search_criteria['field_filters'][] = array( 'key' => '303', 'value' => 'Accepted');

  $entries = GFAPI::get_entries($formIDarr, $search_criteria, null, array('offset' => 0, 'page_size' => 999));

  //randomly order entries
  shuffle ($entries);
  foreach($entries as $entry){
    $leadCategory = array();
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
    }

    //find out if there is an override image for this page
    $overrideImg = findOverride($entry['id'],'mtm');
    $projPhoto = ($overrideImg==''?$entry['22']:$overrideImg);
    $data['entity'][] = array(
        'id'                => $entry['id'],
        'name'              => $entry['151'],
        'large_img_url'     => legacy_get_resized_remote_image_url($projPhoto,230,181),
        'category_id_refs'  => $leadCategory,
        'description'       => $entry['16']
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