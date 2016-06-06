<?php
add_filter( 'gform_pre_render', 'populate_checkbox' );
add_filter( 'gform_pre_validation', 'populate_checkbox' );
add_filter( 'gform_pre_submission_filter', 'populate_checkbox' );
add_filter( 'gform_admin_pre_render', 'populate_checkbox' );

function populate_checkbox( $form) {


  foreach ( $form['fields'] as &$field ) {
    $field_id = '304';
    if ( $field->id != $field_id ) {
        continue;
    }
    $inputs = array();
    $save_input = $field->inputs;
    
    $input_id = 1;
    $lockedValues = array("Disable Notification",
    "Make: Magazine Review",
    "Featured Maker");
    //Places the locked Flag options at the top to preserve field id
    foreach($lockedValues as $value){
      $inputs[] = array( 'label' => $value, 'id' => "{$field_id}.$input_id" );
      $input_id++;
    }
    //now let's loop thru the saved inputs and add to the bottom
    foreach($save_input as $value){
      $inputs[] = array( 'label' => $value['label'], 'id' => "{$field_id}.$input_id" );
      $input_id++;
    }
    $field->inputs = $inputs;
  }

  return $form;
}