<?php
add_filter( 'gform_pre_render', 'populate_checkbox' );
add_filter( 'gform_pre_validation', 'populate_checkbox' );
add_filter( 'gform_pre_submission_filter', 'populate_checkbox' );
add_filter( 'gform_admin_pre_render', 'populate_checkbox' );

function populate_checkbox( $form) {
  if(isset($form['form_type']) && $form['form_type']=='cfm'){
    //Always require field 376 to be checked prior to displaying the submit button.
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

    //lock values on field 376 and 304.  These cannot be changed by producers
    $lockedValues = array("Disable Notification", "Make: Magazine Review", "Featured Maker","Disable Autoresponder");
    foreach ( $form['fields'] as &$field ) {
      //Producers are not allowed to change the text of field 376
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
      }
      //these field choices should always be the first 3 for flags
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
  }
  return $form;
}