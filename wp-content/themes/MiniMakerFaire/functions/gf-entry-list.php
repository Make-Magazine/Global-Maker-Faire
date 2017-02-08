<?php
//function to correctly display thumbnails in entry list
  function mf_entry_thumbnail($value, $form_id, $field_id, $lead ) {
    //TBD make this work for all fileupload type that are images??
    //main project photo
    if($field_id==22){
      $file_path = $lead[$field_id];
      //custom MF code
      //$file_path = legacy_get_resized_remote_image_url($file_path, 125, 125);
      $value     = "<a  href='$file_path' target='_blank' title='" . __( 'Click to view', 'gravityforms' ) . "'><img style='width: 125px;' src='$file_path'/></a>";
      return $value;
    }
    return $value;
  }
  add_action( 'gform_entries_field_value', 'mf_entry_thumbnail', 10, 4 );

