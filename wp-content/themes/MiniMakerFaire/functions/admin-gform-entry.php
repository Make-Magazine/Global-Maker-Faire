<?php
add_action( 'gform_delete_field_link', 'mf_delete_field_link', 10, 1 );
function mf_delete_field_link( $delete_field_link ) {
  //TBD - Put list of locked fields in DB
  $lockedFields = array('151','16', '22', '27', '96', '98', '101',
  '105', '160', '161', '217', '234', '158','162', '224',
  '258', '155', '167', '223', '259', '156', '166', '222', '260', '157',
  '165', '220', '261', '159', '164', '221', '262', '154', '163', '219',
  '263', '109', '111', '110', '320', '321', '303','304', '376',
  '310', '311', '312', '313', '314', '315', '316');

  //find beginning of field id (gfield_delete_{$this->id}')
  $fieldID = 0;
  $fieldIDstart = strpos($delete_field_link, 'gfield_delete_');
  if($fieldIDstart !== false )
    $fieldIDend   = strpos($delete_field_link, "'",$fieldIDstart);
  if($fieldIDend !== false && $fieldIDstart !== false)
    $fieldID = substr($delete_field_link, $fieldIDstart+14, $fieldIDend-$fieldIDstart-14);
  if(in_array($fieldID,$lockedFields,true)){
    return '';
  }else{
    return $delete_field_link;
  }
}

//used to add a class when the field matches specific id's
function mf_field_css_class($css_class,$field,$form){
  //TBD - Put list of locked fields in DB
  $lockedFields = array('151','16', '22', '27', '96', '98', '101',
  '105', '160', '161', '217', '234', '158','162', '224',
  '258', '155', '167', '223', '259', '156', '166', '222', '260', '157',
  '165', '220', '261', '159', '164', '221', '262', '154', '163', '219',
  '263', '109', '111', '110', '320', '321', '303','304', '376',
  '310', '311', '312', '313', '314', '315', '316');

  $fieldID = (string) $field->id; //typecast to string for in_array check
  if(in_array($fieldID,$lockedFields,true)){
    $css_class .=' lockedField';
  }
  return $css_class;
}
add_action('gform_field_css_class','mf_field_css_class',10,4);

function mf_add_msg($form) {
  //var_dump($form);
  return $form;
}
add_action('gform_admin_pre_render','mf_add_msg',10,1);
