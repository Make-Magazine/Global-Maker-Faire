<?php
//adding custom meta fields
add_filter('gform_entry_meta', 'custom_entry_meta', 10, 2);

function custom_entry_meta($entry_meta, $form_id) {
  //data will be stored with the meta key named score
  //  label - entry list will use Score as the column header
  //  is_numeric - used when sorting the entry list, indicates whether the data should be treated as numeric when sorting
  //  is_default_column - when set to true automatically adds the column to the entry list, without having to edit and add the column for display
  //  update_entry_meta_callback - indicates what function to call to update the entry meta upon form submission or editing an entry
  //entry rating
  $entry_meta['entryRating'] = array(
      'label' => 'Rating',
      'is_numeric' => true,
      'update_entry_meta_callback' => 'def_entry_rating',
      'is_default_column' => true,
      'filter' => array(
          'operators' => array('is', 'isnot', '<', '>'),
          'choices' => array(
              array('value' => '0', 'text' => 'Unrated'),
              array('value' => '1', 'text' => '1 Stars'),
              array('value' => '2', 'text' => '2 Stars'),
              array('value' => '3', 'text' => '3 Stars'),
              array('value' => '4', 'text' => '4 Stars'),
              array('value' => '5', 'text' => '5 Stars'),
          )
      )
  );
  return $entry_meta;
}

//set the default value for entry rating
function def_entry_rating($key, $lead, $form) {
  //default rating
  $value = '0';
  return $value;
}

//formats the ratings field that are displayed in the entries list
add_filter( 'gform_entries_field_value', 'format_ratings', 10, 4 );
function format_ratings( $value, $form_id, $field_id, $entry ) {
  if($field_id=='entryRating'){
    if($value==0){
        return 'No Rating';
    }else{
        return $value .' stars';
    }
  }else{
    //check if this field is a custom meta field
    $meta_key = $field_id;
    //check if meta field - return display value
    $meta = GFFormsModel::get_entry_meta(array( $form_id));
    if(isset($meta[$meta_key])){
      $metaField = $meta[$meta_key];
      if(is_array($metaField['filter']['choices'])){
        foreach($metaField['filter']['choices'] as $choice){
          if($choice['value']==$value)
            $value = $choice['text'];
        }
      }
    }
  }
  return $value;
}

