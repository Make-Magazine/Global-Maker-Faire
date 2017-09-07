<?php
/* This adds new form types for the users to select when creating new gravity forms */
add_filter( 'gform_form_settings', 'my_custom_form_setting', 10, 2 );
function my_custom_form_setting( $settings, $form ) {
  global $wpdb;

  $form_type = rgar($form, 'form_type');
  if($form_type=='') $form_type='Other'; //default

  //build select with all form type options
  $select = '<select name="form_type">'
          . ' <option '.($form_type=='other' ?'selected':'').' value="other">Other</option>'
          . ' <option '.($form_type=='cfm' ?'selected':'').'  value="cfm">Call For Makers</option>'
          . '</select>';

  $settings['Form Basics']['form_type'] = '
    <tr>
      <th>Form Type</th>
      <td>'.$select .'</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><b>Note: The form Type must be set to "Call for Makers" for the Meet the Makers page, individual maker pages, and schedule page to work properly.</b></td>
    </tr>';

  return $settings;
}

/* This will save the form type selected by admin users */
add_filter( 'gform_pre_form_settings_save', 'save_form_type_form_setting' );
function save_form_type_form_setting($form) {
  $form['form_type']  = rgpost('form_type');
  return $form;
}

