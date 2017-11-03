<?php
/*  Define an array of field ID's to be locked - these are set in network settings */
$gfLockedFields = str_replace(' ', '', get_site_option( 'gf-locked-fields' )); //remove extra spaces
$lockedFields = explode(',',$gfLockedFields);

//locked fields cannot be deleted
add_action( 'gform_delete_field_link', 'mf_delete_field_link', 10, 1 );
function mf_delete_field_link( $delete_field_link ) {
  global $lockedFields;

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

/*
 * If form type is Call for Makers, add a class of locked fields that makes the background of the field red showing it is a locked field
 */
add_action('gform_field_css_class','mf_field_css_class',10,4);
function mf_field_css_class($css_class,$field,$form){
  global $lockedFields;

  //Lock the options value only - producers can still translate
  $lockValOnly  = array('303', '304', '105');

  //Lock the options and text value - producers cannot translate
  $lockValText  = array('310', '311', '312', '313', '314', '315', '316');

  //remove ability to add/delete/reorder options
  $lockNoChg    = array('310', '311', '312', '313', '314', '315', '316', '105');
  if(isset($form['form_type']) && $form['form_type']=='cfm'){
    $fieldID = (string) $field->id; //typecast to string for in_array check
    if(in_array($fieldID,$lockedFields,true)){
      $css_class .=' lockedField';
    }
    if(in_array($fieldID,$lockValOnly,true)){
      $css_class .=' lockValOnly';
    }
    if(in_array($fieldID,$lockValText,true)){
      $css_class .=' lockValText';
    }
    if(in_array($fieldID,$lockNoChg,true)){
      $css_class .=' lockNoChg';
    }
  }
  return $css_class;
}

/*  Adds a message at the top of the form - not currently used */
function mf_add_msg($form) {
  //var_dump($form);
  return $form;
}
add_action('gform_admin_pre_render','mf_add_msg',10,1);

/*
 * If form type is 'Call For Makers'
 *    - Lock field text for field 376
 *    - Require field 376 be checked for submit button to appear
 *    - Lock 3 values on field 304 (flags) and always place them at the top of the list
 *      "Disable Notification", "Make: Magazine Review", "Featured Maker"
 */
//add_filter( 'gform_pre_render', 'populate_checkbox' );
//add_filter( 'gform_pre_validation', 'populate_checkbox' );
//add_filter( 'gform_pre_submission_filter', 'populate_checkbox' );
//add_filter( 'gform_admin_pre_render', 'populate_checkbox' );

function populate_checkbox( $form) {
  if(isset($form['form_type']) && $form['form_type']=='cfm'){
    //Always require field 376 to be checked prior to displaying the submit button.
    /*
    foreach($form['button']['conditionalLogic']['rules'] as $key=>&$rule){
      if($rule['fieldId']==376){
        unset($form['button']['conditionalLogic']['rules'][$key]);
        break;
      }
    }

    $form['button']['conditionalLogic']['rules'][] = array(
            "fieldId"=>"376",
            "operator"=>"is",
            "value" =>
            "I understand that by submitting this application, I consent to sharing my contact and exhibit information with Make: and consent to the Make: Privacy Policy."
          );
    $form['button']['conditionalLogic']['rules'] = array_values($form['button']['conditionalLogic']['rules']);
*/
    //lock values on field 376 and 304.  These cannot be changed by producers
    foreach ( $form['fields'] as &$field ) {
      //Producers are not allowed to change the text of field 376
      /*
      if($field["id"] == 376){
        $field['label'] = "Please know that Make:, Maker Faire, and Maker Media respect your privacy and will not share or sell your information.";
        $field['description'] = 'Complete Make: privacy policy is located at: <a href="http://makermedia.com/privacy/">http://makermedia.com/privacy/</a>';
        $field['choices'] = array(
          array(
          'text'  => 'I understand that by submitting this application, I consent to sharing my contact and exhibit information with Make: and consent to the Make: Privacy Policy.',
          'value' => 'I understand that by submitting this application, I consent to sharing my contact and exhibit information with Make: and consent to the Make: Privacy Policy.',
          'isSelected' => false,
          'price' => ''));
        $field['inputs'] = array(
            array(
                "id" => "376.1",
                "label" => "I understand that by submitting this application, I consent to sharing my contact and exhibit information with Make: and consent to the Make: Privacy Policy.",
                "name"  => ""
            )
        );
      }*/

      //these field choices should always be the first 3 for flags
      $lockedValues = array("Disable Notification", "Make: Magazine Review", "Featured Maker","Disable Autoresponder");
      if($field["id"] == 304){
        //set field inputs
        $lockedInputs = array(
            array("label" => "Disable Notification",  "id" => "304.1"),
            array("label" => "Make: Magazine Review", "id" => "304.2"),
            array("label" => "Featured Maker",        "id" => "304.3"),
        );
        //set field choices
        $lockedChoices = array(
          array("text" => "Disable Notification",  "value" => "Disable Notification"),
          array("text" => "Make: Magazine Review", "value" => "Make: Magazine Review"),
          array("text" => "Featured Maker",        "value" => "Featured Maker")
        );
        $input_id = 304.4;
        //now let's loop thru the inputs and add to the bottom if they aren't already one of the locked fields
        foreach($field['inputs'] as $input){
          //do not add back in the locked values if they are already there
          if(!in_array($input['label'],$lockedValues)){
            $lockedInputs[] = array( 'label' => $input['label'], 'id' => "$input_id" );
            $input_id = $input_id + .1;
          }
        }

        $field['inputs'] = $lockedInputs;


        foreach($field['choices'] as $choice){
          if(!in_array($choice['text'],$lockedValues)){
            $lockedChoices[] = $choice;
          }
        }
        $field['choices'] = $lockedChoices;
      }
    }
  }
  return $form;
}