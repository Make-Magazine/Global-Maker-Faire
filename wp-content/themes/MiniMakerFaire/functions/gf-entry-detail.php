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

/*
 * This action is fired before the detail is displayed on the entry detail page
 */

add_action("gform_entry_detail_content_before", "mf_entry_detail_head", 10, 2);

/*
 *  Funtion to modify the header on the entry detail page
 */
function mf_entry_detail_head($form, $lead) {
  $query_string = get_return_entry_list_url($form);
	$outputURL    = admin_url( 'admin.php?' . $query_string );
  $outputURL = '<a href="'. $outputURL .'">Return to entries list</a>';
  ?>
  <script>
    //add in Return to Entries List link
    jQuery('h2.gf_admin_page_title div.gf_entry_detail_pagination').append('<?php echo $outputURL;?>');
  </script>
  <?php
}

function get_return_entry_list_url($form) {
		$form_id = $form['id'] ;

		$search = stripslashes( rgget( 's' ) );

		$search_field_id = rgget( 'field_id' );
		$search_operator = rgget( 'operator' );

		$order   = rgget( 'order' );
		$orderby = rgget( 'orderby' );

		$search_qs  = empty( $search ) ? '' : '&s=' . esc_attr( urlencode( $search ) );
		$orderby_qs = empty( $orderby ) ? '' : '&orderby=' . esc_attr( $orderby );
		$order_qs   = empty( $order ) ? '' : '&order=' . esc_attr( $order );
		$filter_qs  = '&filter=' . rgget( 'filter' );


		$page_num   = rgget( 'paged' );
		$position   = rgget( 'pos' );

		$edit_url = 'page=gf_entries&id=' . absint( $form_id ) . $search_qs . $orderby_qs . $order_qs . $filter_qs .
            '&paged=' . $page_num .'&pos=' . $position .'&field_id=' . esc_attr( $search_field_id ) .
            '&operator=' .  esc_attr( $search_operator );
		return $edit_url;
	}