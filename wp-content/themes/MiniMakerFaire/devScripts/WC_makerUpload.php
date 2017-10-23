<?php
include '../../../../wp-load.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL); ini_set('display_errors', 1);
$form_id = (isset($_GET['form_id'])?$_GET['form_id']:0);
if($form_id==0){
  echo 'Please use the form_id variable.';
  die();
}
$page  = (isset($_GET['page'])?$_GET['page']:1);
$limit = (isset($_GET['limit'])?$_GET['limit']:20);
$offset = ($page!=1 ? (($page-1) * $limit) : 0);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
<?php

global $wpdb;
$blogID =  get_current_blog_id();

$formArray = array();
$count = 0;
$timer = 1;

    $form  = GFAPI::get_form($form_id);
    //$json = json_decode($formrow['display_meta']);
    echo 'Form: '.$form_id.' ('.$form['title'].')<br/>';

    $form_type = (isset($form['form_type'])?$form['form_type']:'');
    if(isset($form_type) && $form_type==='cfm'){
      //display number of accepted records
      $sql = "SELECT wp_".$blogID."_rg_lead_detail.lead_id,wp_".$blogID."_rg_lead_detail.form_id "
              . " FROM `wp_".$blogID."_rg_lead_detail`"
              . " left outer join wp_".$blogID."_rg_lead on wp_".$blogID."_rg_lead.id = wp_".$blogID."_rg_lead_detail.lead_id"
              . " where wp_".$blogID."_rg_lead_detail.field_number = 303"
              . "   and wp_".$blogID."_rg_lead_detail.value = 'Accepted'"
              . "   and status = 'active'"
              . "   and wp_".$blogID."_rg_lead_detail.form_id = ".$form_id
              . " LIMIT ".$offset.", ".$limit;
      //echo $sql;
      $entries = $wpdb->get_results($sql);
      //display number of makers
      foreach($entries as $entry){
        //echo 'i am here';
        $entry_id = $entry->lead_id;
        echo 'Adding '.$entry_id. ' from form '.$form_id.' to WhatCounts<br/>';
        $lead = GFAPI::get_entry($entry_id);
        wp_schedule_single_event(time() + $timer,'sidebar_entry_update', array($lead, $form));
        //testupdateWC($lead, $form);
        $timer++;
      }
    }

echo 'Timer = '.$timer;
?>
  </body>
</html>

<?php
function testupdateWC($entry, $form){
   /*
     * find all first name, last name, email address - contact, maker 1-7
     */
     $typeArr = array(
        array('type' =>  'Contact',  'emailField' => '98',  'nameField' => '96'),
        array('type' =>  'Maker 1',  'emailField' => '161', 'nameField' => '160'),
        array('type' =>  'Maker 2',  'emailField' => '162', 'nameField' => '158'),
        array('type' =>  'Maker 3',  'emailField' => '167', 'nameField' => '155'),
        array('type' =>  'Maker 4',  'emailField' => '166', 'nameField' => '156'),
        array('type' =>  'Maker 5',  'emailField' => '165', 'nameField' => '157'),
        array('type' =>  'Maker 6',  'emailField' => '164', 'nameField' => '159'),
        array('type' =>  'Maker 7',  'emailField' => '163', 'nameField' => '154')
     );
    $emailArr = array();
    foreach($typeArr as $key=>$typeData){
      $email      = (isset($entry[$typeData['emailField']]) ? $entry[$typeData['emailField']]  : '');
      $firstName  = (isset($entry[$typeData['nameField'].'.3']) ? $entry[$typeData['nameField'].'.3']  : '');
      $lastName   = (isset($entry[$typeData['nameField'].'.6']) ? $entry[$typeData['nameField'].'.6']  : '');

      if($email != '' && $firstName != ''){
        //build unique email list
        if(!(isset($emailArr[$email]))){
          $emailArr[$email] = array('email'=>$email,'firstName'=>$firstName, 'lastName'=>$lastName);
        }
      }
    }

    $ftosID = 0;
    //send unique emails to whatCounts
    foreach($emailArr as $uniqueEmail){
      $email      = $uniqueEmail['email'];
      $firstName  = $uniqueEmail['firstName'];
      $lastName   = $uniqueEmail['lastName'];

      $entry_id = $entry['id'].$ftosID;
      $ftos = (int) $entry_id;
      echo 'For '.$entry['id'].' email is '. $email.' name is ' .$firstName.' '.$lastName.' $ftos='.$ftos.'<br/>';

      $ftosID++;
    } //end foreach email array
}