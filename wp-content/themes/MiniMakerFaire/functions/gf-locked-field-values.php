<?php
add_filter( 'gform_pre_render', 'populate_checkbox' );
add_filter( 'gform_pre_validation', 'populate_checkbox' );
add_filter( 'gform_pre_submission_filter', 'populate_checkbox' );
add_filter( 'gform_admin_pre_render', 'populate_checkbox' );

function populate_checkbox( $form) {
  $lockedValues = array("Disable Notification", "Make: Magazine Review", "Featured Maker","Disable Autoresponder");

  foreach ( $form['fields'] as &$field ) {
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
          $lockedInputs[] = array( 'label' => $input['label'], 'id' => "{$field_id}.$input_id" );
          $input_id++;
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

  return $form;
}