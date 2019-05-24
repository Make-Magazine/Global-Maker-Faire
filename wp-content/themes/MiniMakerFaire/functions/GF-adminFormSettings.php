<?php
/* This adds new form types for the users to select when creating new gravity forms */
add_filter( 'gform_form_settings', 'my_custom_form_setting', 10, 2 );
function my_custom_form_setting( $settings, $form ) {
  global $wpdb;

  $form_type = rgar($form, 'form_type');
  if($form_type=='') $form_type='Other'; //default

  //build select with all form type options
  $select = '<select name="form_type">'
          . ' <option '.($form_type=='other' || $form_type=='' ?'selected':'').' value="other">Other</option>'
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
  $settings['Form Basics']['form_urls'] = '
    <tr>
      <th>Meet Makers URL</th>
      <td><input type="text" id="form_mtm_url" name="form_mtm_url" value="' . rgar($form, 'form_mtm_url') . '" /></td>
    </tr>
	 <tr>
      <th>Schedule Page URL</th>
      <td><input type="text" id="form_schedule_url" name="form_schedule_url" value="' . rgar($form, 'form_schedule_url') . '" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><b>Note: You must set the url specific for the meet the makers and schedule page associated with this form for category tags to function correctly.</b></td>
    </tr>';

  $start_hour_dd         = '';
  $start_minute_dd       = '';
  $start_am_selected     = '';
  $start_pm_selected     = '';

  // Create start hour dd options.
  for ( $i = 1; $i <= 12; $i ++ ) {
    $selected = rgar( $form, 'mf_faire_start_hour' ) == $i ? 'selected="selected"' : '';
    $start_hour_dd .= '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
  }
  // Create start minute dd options.
  foreach ( array( '00', '15', '30', '45' ) as $value ) {
    $selected = rgar( $form, 'mf_faire_start_min' ) == $value ? 'selected="selected"' : '';
    $start_minute_dd .= '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
  }
  // Set start am/pm.
  if ( rgar( $form, 'mfFaireStartAmpm' ) == 'am' ) {
    $start_am_selected = 'selected="selected"';
  } elseif ( rgar( $form, 'scheduleStartAmpm' ) == 'pm' ) {
    $start_pm_selected = 'selected="selected"';
  }

  //set faire close time options
  $close_hour_dd           = '';
  $close_minute_dd         = '';
  $close_am_selected       = '';
  $close_pm_selected       = '';
  for ( $i = 1; $i <= 12; $i ++ ) {
    $selected = rgar( $form, 'mf_faire_close_hour' ) == $i ? 'selected="selected"' : '';
    $close_hour_dd .= '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
  }
  // Create close minute dd options.
  foreach ( array( '00', '15', '30', '45' ) as $value ) {
    $selected = rgar( $form, 'mf_faire_close_min' ) == $value ? 'selected="selected"' : '';
    $close_minute_dd .= '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
  }
  // Set start am/pm.
  if ( rgar( $form, 'mfFaireCloseAmpm' ) == 'am' ) {
    $close_am_selected = 'selected="selected"';
  } elseif ( rgar( $form, 'scheduleCloseAmpm' ) == 'pm' ) {
    $close_pm_selected = 'selected="selected"';
  }

  $settings['Form Basics']['mf_faire_open'] = '
    <tr>
      <th>Faire Open Date and Time</th>
      <td>
        <input type="text" id="mf_faire_open" name="mf_faire_open" class="datepicker" value="' . esc_attr( rgar( $form, 'mf_faire_open' ) ) . '" />
        &nbsp;&nbsp;
        <select id="mf_faire_start_hour" name="mf_faire_start_hour">' .
          $start_hour_dd .
        '</select>
        :
        <select id="mf_faire_start_min" name="mf_faire_start_min">' .
        $start_minute_dd .
        '</select>
        <select id="mfFaireStartAmpm" name="mfFaireStartAmpm">
          <option value="am" ' . $start_am_selected . '>AM</option>
          <option value="pm" ' . $start_pm_selected . '>PM</option>
        </select>
      </td>
    </tr>';

    $settings['Form Basics']['mf_faire_close'] = '
    <tr>
      <th>Faire Close Date and Time</th>
      <td>
        <input type="text" id="mf_faire_close" name="mf_faire_close" class="datepicker" value="' . esc_attr( rgar( $form, 'mf_faire_close' ) ) . '" />
        &nbsp;&nbsp;
        <select id="mf_faire_close_hour" name="mf_faire_close_hour">' .
          $close_hour_dd .
        '</select>
        :
        <select id="mf_faire_close_min" name="mf_faire_close_min">' .
        $close_minute_dd .
        '</select>
        <select id="mfFaireCloseAmpm" name="mfFaireCloseAmpm">
          <option value="am" ' . $close_am_selected . '>AM</option>
          <option value="pm" ' . $close_pm_selected . '>PM</option>
        </select>
      </td>
    </tr>';
  return $settings;
}

/* This will save the form type selected by admin users */
add_filter( 'gform_pre_form_settings_save', 'save_form_type_form_setting' );
function save_form_type_form_setting($form) {
  $form['form_type']            = rgpost('form_type');
  $form['form_mtm_url']         = rgpost('form_mtm_url');
  $form['form_schedule_url']    = rgpost('form_schedule_url');

  //faire open date/time
  $form['mf_faire_open']        = rgpost('mf_faire_open');
  $form['mf_faire_start_hour']  = rgpost('mf_faire_start_hour');
  $form['mf_faire_start_min']   = rgpost('mf_faire_start_min');
  $form['mfFaireStartAmpm']     = rgpost('mfFaireStartAmpm');

  //faire close date/time
  $form['mf_faire_close']       = rgpost('mf_faire_close');
  $form['mf_faire_close_hour']  = rgpost('mf_faire_close_hour');
  $form['mf_faire_close_min']   = rgpost('mf_faire_close_min');
  $form['mfFaireCloseAmpm']     = rgpost('mfFaireCloseAmpm');
  error_log($form);
  return $form;
}

