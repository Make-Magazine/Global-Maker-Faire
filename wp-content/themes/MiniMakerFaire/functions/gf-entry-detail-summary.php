<?php
////////////////////////////////////////////////////////////////////
// Entry Detail - Summary Section
////////////////////////////////////////////////////////////////////

//used to add summary section
add_action( 'gform_entry_detail_content_before', 'add_main_text_before', 10, 2 );
function add_main_text_before( $form, $lead ) {
  echo get_summary_side($form, $lead);
  echo get_summary_note_section($form, $lead);
  echo '<br/>';
}
function get_summary_side($form, $lead) {
  $size_request             = (isset($lead['60'])?$lead['60']:'');
  $size_request_heightwidth = ((isset($lead['344']) && strlen($lead['344']) > 0 ) ? $lead['344'].' X ':'').(isset($lead['345'])?$lead['345']:'');
  $size_request_other       = (isset($lead['61'])?$lead['61']:'');
  $project_name = (isset($lead['151'])?$lead['151']:'');
  $photo        = (isset($lead['22'])?$lead['22']:'');
  $short_description        = (isset($lead['16'])?$lead['16']:'');
  $long_description         = (isset($lead['21'])?$lead['21']:'');
  $entry_form_name          = $form['title'];
  $entry_form_status        = (isset($lead['303'])?$lead['303']:'');
  $wkey                     = (isset($lead['27'])?$lead['27']:'');
  $vkey                     = (isset($lead['32'])?$lead['32']:'');

  $makerfirstname1          = (isset($lead['160.3'])?$lead['160.3']:'');
  $makerlastname1           = (isset($lead['160.6'])?$lead['160.6']:'');
  $makerPhoto1              = (isset($lead['217'])?$lead['217']:'');
  $makerfirstname2          = (isset($lead['158.3'])?$lead['158.3']:'');
  $makerlastname2           = (isset($lead['158.6'])?$lead['158.6']:'');
  $makerPhoto2              = (isset($lead['224'])?$lead['224']:'');
  $makerfirstname3          = (isset($lead['155.3'])?$lead['155.3']:'');
  $makerlastname3           = (isset($lead['155.6'])?$lead['155.6']:'');
  $makerPhoto3              = (isset($lead['223'])?$lead['223']:'');
  $makerfirstname4          = (isset($lead['156.3'])?$lead['156.3']:'');
  $makerlastname4           = (isset($lead['156.6'])?$lead['156.6']:'');
  $makerPhoto4              = (isset($lead['222'])?$lead['222']:'');
  $makerfirstname5          = (isset($lead['157.3'])?$lead['157.3']:'');
  $makerlastname5           = (isset($lead['157.6'])?$lead['157.6']:'');
  $makerPhoto5              = (isset($lead['220'])?$lead['220']:'');
  $makerfirstname6          = (isset($lead['159.3'])?$lead['159.3']:'');
  $makerlastname6           = (isset($lead['159.6'])?$lead['159.6']:'');
  $makerPhoto6              = (isset($lead['221'])?$lead['221']:'');
  $makerfirstname7          = (isset($lead['154.3'])?$lead['154.3']:'');
  $makerlastname7           = (isset($lead['154.6'])?$lead['154.6']:'');
  $makerPhoto7              = (isset($lead['219'])?$lead['219']:'');
  $makergroupname           = (isset($lead['109'])?$lead['109']:'');
  $makerGroupPhoto          = (isset($lead['111'])?$lead['111']:'');

  $main_description = '';
  // Check if we are loading the public description or a short description
  if ( isset( $long_description ) && $long_description!='') {
    $main_description = $long_description;
  } else if ( isset($short_description ) ) {
    $main_description = $short_description;
  }
  ?>
  <table id="entry-summary" class="fixed entry-detail-view">
    <thead>
      <th colspan="2" style="text-align: left" id="header">
        <h1>
          <?php echo esc_html($project_name); ?>
        </h1>
      </th>
    </thead>
    <tbody>
      <tr>
        <td style="width:440px; padding:5px;" valign="top">
          <a href="<?php echo $photo;?>" class='thickbox'>
          <img width="400px" src="<?php echo $photo;?>" alt="" /></a>
        </td>
        <td valign="top">
          <table>
            <thead>
            <tr>
              <td colspan="2">
                <p>
                  <?php echo stripslashes( nl2br( $main_description, "\n" )  ); ?>
                </p>
              </td>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td valign="top"><strong>Form:</strong></td>
              <td valign="top"><?php echo esc_attr( ucfirst( $entry_form_name ) ); ?></td>
            </tr>
            <tr>
              <td valign="top"><strong>Status:</strong></td>
              <td valign="top"><?php echo esc_attr( $entry_form_status ); ?></td>
            </tr>
            <tr>
              <td valign="top"><strong>Website:</strong></td>
              <td valign="top"><ahref="<?php echo esc_url(  $wkey ); ?>" target="_blank"><?php echo esc_url( $wkey ); ?></a></td>
            </tr>
            <tr>
              <td valign="top"><strong>Video:</strong></td>
              <td><?php
                echo ( isset( $vkey ) ) ? '<a href="' . esc_url( $vkey ) . '" target="_blank">' . esc_url( $vkey ) . '</a><br/>' : '' ;
                  ?>
              </td>
            </tr>
            <tr>
              <td valign="top"><strong>Maker Names:</strong></td>
              <td valign="top"><?php echo !empty($makergroupname) ? $makergroupname.'(Group)</br>' : ''; ?>
                <?php
                if(!empty($makerPhoto1)){?>
                  <a href="<?php echo $makerPhoto1;?>" class='thickbox'>
                    <img width="30px" src="<?php echo $makerPhoto1;?>" alt="" />
                  </a>
                <?php  }?>
                <?php echo !empty($makerfirstname1) ?  $makerfirstname1.' '.$makerlastname1.'</br>' : '' ;
                if(!empty($makerPhoto2)){?>
                  <a href="<?php echo $makerPhoto2;?>" class='thickbox'>
                    <img width="30px" src="<?php echo $makerPhoto2;?>" alt="" />
                  </a>
                <?php  }
                echo !empty($makerfirstname2) ?  $makerfirstname2.' '.$makerlastname2.'</br>' : '' ;
                if(!empty($makerPhoto3)){?>
                  <a href="<?php echo $makerPhoto3;?>" class='thickbox'>
                    <img width="30px" src="<?php echo $makerPhoto3;?>" alt="" />
                  </a>
                <?php  }
                echo !empty($makerfirstname3) ?  $makerfirstname3.' '.$makerlastname3.'</br>' : '' ; ?>
                <?php if(!empty($makerPhoto4)){?>
                    <a href="<?php echo $makerPhoto4;?>" class='thickbox'>
                    <img width="30px" src="<?php echo $makerPhoto4;?>" alt="" />
                    </a>
                <?php  }?>
                <?php echo !empty($makerfirstname4) ?  $makerfirstname4.' '.$makerlastname4.'</br>' : '' ; ?>
                <?php if(!empty($makerPhoto5)){?>
                    <a href="<?php echo $makerPhoto5;?>" class='thickbox'>
                    <img width="30px" src="<?php echo $makerPhoto5;?>" alt="" />
                    </a>
                <?php  }?>
                <?php echo !empty($makerfirstname5) ?  $makerfirstname5.' '.$makerlastname5.'</br>' : '' ; ?>
                <?php if(!empty($makerPhoto6)){?>
                    <a href="<?php echo $makerPhoto6;?>" class='thickbox'>
                    <img width="30px" src="<?php echo $makerPhoto6;?>" alt="" />
                    </a>
                <?php  }?>
                <?php echo !empty($makerfirstname6) ?  $makerfirstname6.' '.$makerlastname6.'</br>' : '' ; ?>
                <?php if(!empty($makerPhoto7)){?>
                    <a href="<?php echo $makerPhoto7;?>" class='thickbox'>
                    <img width="30px" src="<?php echo $makerPhoto7;?>" alt="" />
                    </a>
                <?php  }?>
                <?php if(!empty($makerGroupPhoto)){?>
                    Group Photo<br/>
                    <a href="<?php echo $makerGroupPhoto;?>" class='thickbox'>
                    <img width="30px" src="<?php echo $makerGroupPhoto;?>" alt="" />
                    </a>
                <?php  }?>

                <?php echo !empty($makerfirstname7) ?  $makerfirstname7.' '.$makerlastname7.'</br>' : '' ; ?>
              </td>
            </tr>
            <tr>
              <td valign="top"><strong>Size Request:</strong></td>
              <td>
                <?php echo ( isset( $size_request ) ) ? $size_request : 'Not Filled out' ; ?>
                <?php echo ( isset( $size_request_heightwidth ) ) ? $size_request_heightwidth : '' ; ?>
                <?php echo ( strlen( $size_request_other ) > 0 ) ? ' <br />Comment: '.$size_request_other : '' ; ?>
              </td>
            </tr>
            <tr>
              <td valign="top"><strong>Schedule / Location:</strong></td>
              <td>
                <?php echo display_schedule($form['id'],$lead,'summary');?>
              </td>
            </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  <?php
}

//get summary notes section
function get_summary_note_section($form, $lead) {
  if (current_user_can( 'mf_can_send_entry_notes') ) {
    //get list of valid wp user emails
    $args = array(
      'blog_id'      => $GLOBALS['blog_id'],
      'role'         => 'administrator',
      'orderby'      => 'email',
      'order'        => 'ASC'
     );
    $faireUsers = get_users( $args );
    ?>
    <table width="100%" class="entry-notes">
      <tr>
        <td>
          <label >Email Note To:</label><br />
          <div style="float:left">
            <?php
            foreach ( $faireUsers as $faireUser) {
              //should be able to use user_can function, but it is always returning false
              //if(!user_can( $faireUser->ID, 'mf_can_receive_entry_notes' )){
              if(isset($faireUser->allcaps['mf_can_receive_entry_notes']) && $faireUser->allcaps['mf_can_receive_entry_notes']) {
                echo('<input type="checkbox"  name="email_notes_to" style="margin: 3px;" value="'.$faireUser->user_email.'" /><strong>'.$faireUser->user_nicename.'</strong> <br />');
              }
            } ?>
          </div>
        </td>

        <td style="vertical-align: top; padding: 10px;">
          <textarea id="new_note" style="width: 90%; height: 140px;" cols="" rows=""></textarea>
          <input type="submit" id="add_entry_note" value="Add Note" class="button"/>

          <span style="padding-left:10px" id="addNoteResp"></span>
        </td>
      </tr>
    </table>
    <?php
  }
}


/* End section to customize the admin entry display view */
