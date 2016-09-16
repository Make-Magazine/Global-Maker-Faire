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
  $wpdb->set_prefix('wp_'.$blogrow['blog_id'].'_');
  $forms = GFAPI::get_forms();
  foreach($forms as $form){
    $updForm = false;
    if(is_array($form['notifications'])){
      foreach($form['notifications'] as $notifKey=> $notification){
        //var_dump($notification);
        if(is_array($notification['conditionalLogic'])){
          if(isset($notification['conditionalLogic']['rules'])){
            foreach($notification['conditionalLogic']['rules'] as $ruleKey=>$rule){
              if($rule['value']=='Disable Autoresponder') {
                echo 'updating '.$notification['name'].'<br/>';
                $form['notifications'][$notifKey]['conditionalLogic']['rules'][$ruleKey]['value'] = 'Disable Notification';
                $updForm=true;

              }
            }
          }
        }
      }
    }
    if($updForm){
      //var_dump($form);
      //echo '<br/><br/>';
      //update notification

      $updresult = GFAPI::update_form( $form );
      if(!$updresult){
        var_dump($updresult);
      }else{
        echo 'Form - '.$copyForm.' Updated<br/>';
      }
    }
  }
}
?>
  </body>
</html>