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

$blogArray = array();
//loop thru blogs
foreach($results as $blogrow){
  $blogID = $blogrow['blog_id'];

  if($blogID==1){
    $table  =  'wp_gf_form_meta';
  }else{
    $table  =  'wp_'.$blogID.'_gf_form_meta';
  }

  $formResults = $wpdb->get_results('select display_meta, form_id from '.$table,ARRAY_A);

  $formArray = array();
  $count = 0;
  foreach($formResults as $formrow){
    $statusArray = array(
          'Proposed'  => 0,
          'Accepted'  => 0,
          'Cancelled' => 0,
          'Rejected'  => 0,
          'Wait List' => 0
      );
    $form_id = $formrow['form_id'];

    $json = json_decode($formrow['display_meta']);
    $form_type = (isset($json->form_type)?$json->form_type:'');
    if(isset($form_type) && $form_type==='cfm'){
      //display number of accepted records
      $sql = "SELECT lead.id,
                (select leadDetail.meta_value from wp_".$blogID."_gf_entry_meta leadDetail where
                leadDetail.entry_id = lead.id and leadDetail.meta_key = 303
                )as entryStatus,
                (select leadDetail.meta_value from wp_".$blogID."_gf_entry_meta leadDetail where
                leadDetail.entry_id = lead.id and leadDetail.meta_key = 98
                )as contactEmail,
                (select leadDetail.meta_value from wp_".$blogID."_gf_entry_meta leadDetail where
                leadDetail.entry_id = lead.id and leadDetail.meta_key = 161
                )as maker1Email,
                (select leadDetail.meta_value from wp_".$blogID."_gf_entry_meta leadDetail where
                leadDetail.entry_id = lead.id and leadDetail.meta_key = 162
                )as maker2Email,
                (select leadDetail.meta_value from wp_".$blogID."_gf_entry_meta leadDetail where
                leadDetail.entry_id = lead.id and leadDetail.meta_key = 167
                )as maker3Email,
                (select leadDetail.meta_value from wp_".$blogID."_gf_entry_meta leadDetail where
                leadDetail.entry_id = lead.id and leadDetail.meta_key = 166
                )as maker4Email,
                (select leadDetail.meta_value from wp_".$blogID."_gf_entry_meta leadDetail where
                leadDetail.entry_id = lead.id and leadDetail.meta_key = 165
                )as maker5Email,
                (select leadDetail.meta_value from wp_".$blogID."_gf_entry_meta leadDetail where
                leadDetail.entry_id = lead.id and leadDetail.meta_key = 164
                )as maker6Email,
                (select leadDetail.meta_value from wp_".$blogID."_gf_entry_meta leadDetail where
                leadDetail.entry_id = lead.id and leadDetail.meta_key = 163
                )as maker7Email
                from wp_".$blogID."_gf_entry lead

                where status = 'active' and lead.form_id = ".$form_id;
      //echo $sql;

      $entries = $wpdb->get_results($sql);
      $dataArray = array();

      $emailArray = array();
      //display number of makers
      foreach($entries as $entry){
        if(!is_null($entry->entryStatus)){
          $status = $entry->entryStatus;
          if(isset($statusArray[$status])){
            $statusArray[$status]++;
          }else{
            'Added new status!!'.$status.'<br/>';
            $statusArray[$status] = 1;
          }

          if(!in_array($entry->contactEmail,$emailArray)){
            $emailArray[] = $entry->contactEmail;
          }
          if(!in_array($entry->maker1Email,$emailArray)){
            $emailArray[] = $entry->maker1Email;
          }
          if(!in_array($entry->maker2Email,$emailArray)){
            $emailArray[] = $entry->maker2Email;
          }
          if(!in_array($entry->maker3Email,$emailArray)){
            $emailArray[] = $entry->maker3Email;
          }
          if(!in_array($entry->maker4Email,$emailArray)){
            $emailArray[] = $entry->maker4Email;
          }
          if(!in_array($entry->maker5Email,$emailArray)){
            $emailArray[] = $entry->maker5Email;
          }
          if(!in_array($entry->maker6Email,$emailArray)){
            $emailArray[] = $entry->maker6Email;
          }
          if(!in_array($entry->maker7Email,$emailArray)){
            $emailArray[] = $entry->maker7Email;
          }
          $dataArray[$entry->id] = $entry;
        }
      }
      if(count($emailArray)>=10){
        $formArray[] = array(
          'form_id'       => $form_id,
          'form_name'     => $json->title,
          'emailArray'    => $emailArray,
          'statusArray'   => $statusArray,
          'uniqueEmail'   => count($emailArray)
        );
      }
    }
  }
  $blogArray[] = array(
    'blog_id'       => $blogID,
    'blog_name'     => $blogrow['domain'],
    'forms'         => $formArray
  );
}
$finalCount = $totalForms = $totalBlogs = 0;
echo '<table width="100%">';
echo  '<tr style="text-align:left">'
        . '<th>Blog ID</th>'
        . '<th>Blog Name</th>'
        . '<th>Form ID</th>'
        . '<th>Form Name</th>'
        . '<th>Accepted</th>'
        . '<th>Cancelled</th>'
        . '<th>Proposed</th>'
        . '<th>Rejected</th>'
        . '<th>Wait List</th>'
        . '<th>Unique eMail count</th>'
   . '</tr>';
foreach($blogArray as $blog){
  $totalBlogs ++;
  foreach ($blog['forms'] as $form){
    $totalForms ++;
    $finalCount +=$form['uniqueEmail'];
    echo '<tr>';
    echo '<td>'.$blog['blog_id'].'</td><td>'.$blog['blog_name'].'</td>';
    echo '<td>'.$form['form_id'].'</td><td>'.$form['form_name'].'</td>';
    echo '<td>'.$form['statusArray']['Accepted'].'</td>'
       . '<td>'.$form['statusArray']['Cancelled'].'</td>'
       . '<td>'.$form['statusArray']['Proposed'].'</td>'
       . '<td>'.$form['statusArray']['Rejected'].'</td>'
       . '<td>'.$form['statusArray']['Wait List'].'</td>'
       . '<td>'.$form['uniqueEmail'].'</td>';
    echo '</tr>';
  }

}

echo '</table>';

echo 'Total Blogs '.$totalBlogs.'<br/>';
echo 'Total Forms '.$totalForms.'<br/>';
echo 'Total Unique emails '.$finalCount.'<br/>';
?>
  </body>
</html>