<?php
//action to modify field 320 to display the text instead of the taxonomy code
add_filter("gform_entry_field_value", "setTaxName", 10, 4);
function setTaxName($value, $field, $lead, $form){
  $field_type = RGFormsModel::get_input_type($field);

	if( in_array( $field_type, array('checkbox', 'select', 'radio') ) ){
		$value = RGFormsModel::get_lead_field_value( $lead, $field );
		return GFCommon::get_lead_field_display( $field, $value, $lead["currency"], true );
	}

	return $value;
}

add_filter( 'gform_export_field_value', 'set_export_values', 10, 4 );
function set_export_values( $value, $form_id, $field_id, $lead ) {
  if($field_id=='320'|| strpos($field_id, '321.')!== false){
    $form = GFAPI::get_form( $form_id );

    foreach( $form['fields'] as $field ) {
      if ( $field->id == $field_id) {
        if( in_array( $field->type, array('checkbox', 'select', 'radio') ) ){
          $value = RGFormsModel::get_lead_field_value( $lead, $field );
          return GFCommon::get_lead_field_display( $field, $value, $lead["currency"], true );
        }else{
          return $value;
        }
      }
    }
  }
  return $value;
}