<?php
include '../../../../wp-load.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
<?php

/* update notifications - replace 'Disable Autoresponder' with 'Disable Notification' */
global $wpdb;
$blogSql = 'SELECT blog_id,domain FROM `wp_blogs`';
$results = $wpdb->get_results($blogSql,ARRAY_A);
foreach($results as $blogrow){
  echo $blogrow['blog_id'].' - '.$blogrow['domain'].'<br/>';

  $blogID = $blogrow['blog_id'];
  $wpdb->blogid = $blogID;
	$wpdb->set_prefix( $wpdb->base_prefix );
echo '$wpdb->prefix='.$wpdb->prefix.'<br/>';
  $forms = GFAPI::get_forms(false);
  //var_dump($forms);
  foreach($forms as $form){
    echo 'Form ='.$form['title'].'<br/>';
    $updForm = false;
    if(is_array($form['notifications'])){
      foreach($form['notifications'] as $notifKey=> $notification){
        echo 'Looking at '.$notification['name'].'<br/>';
        //var_dump($notification);
        //echo '<br/>';
        if(is_array($notification['conditionalLogic'])){
          if(isset($notification['conditionalLogic']['rules'])){
            foreach($notification['conditionalLogic']['rules'] as $ruleKey=>$rule){
              if(trim($rule['value'])=='Disable Autoresponder') {
                echo 'updating<br/>';
                $form['notifications'][$notifKey]['conditionalLogic']['rules'][$ruleKey]['value'] = 'Disable Notification';
                $updForm=true;
              }
            }
          }
        }
      }
    }
    if($updForm){
      echo 'begin update<br/>';
      //update notification
      $updresult = GFAPI::update_form( $form );
      if(!$updresult){
        echo 'error updating Form - '.$copyForm.'<br/>';
        var_dump($updresult);
      }else{
        echo 'Form - '.$copyForm.' Updated<br/>';
      }
    }else{
      echo 'no update<br/>';
    }
    echo '<br/><br/>';
  }
}
?>
  </body>
</html>