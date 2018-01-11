<?php
add_filter( 'gform_field_validation', 'custom_validation', 10, 4 );
function custom_validation( $result, $value, $form, $field ) {
  $form_type = (isset($form['form_type'])?$form['form_type']:'');
  if(isset($form_type) && $form_type==='cfm'){
    //Validate that 550 - TOS is checked
    $field_id = $field->id;

    if($field_id==550){
      if($value['550.1'] === '' ) {
        $result['is_valid'] = false;
        $result['message']  = 'You must agree to the Make: Terms of Service and Privacy Policy. ';
      }
    }
  }
  
  return $result;
}

