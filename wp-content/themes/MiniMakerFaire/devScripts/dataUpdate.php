<?php
include '../../../../wp-load.php';
echo 'Begin Data update<br/>';
/*
 * update various forms and fields for data integrity
 */

$lockedFields = array('16', '22', '27', '32', '96', '98', '101', '105', '109', '110', '111', '151', '154', '155', '156', '157', '158', '159', '160', '161', '162', '163', '164', '165', '166', '167', '201', '203', '204', '205', '206', '207', '208', '209', '211', '212', '213', '214', '215', '216', '217', '219', '220', '221', '222', '223', '224', '234', '258', '259', '260', '261', '262', '263', '303', '304', '310', '311', '312', '313', '314', '315', '316', '320', '321', '325', '326');
$blogFormArr = array(
  array('blogID' => 4, 'formID' => 3),  array('blogID' => 4, 'formID' => 10), array('blogID' => 4, 'formID' => 11),
  array('blogID' => 4, 'formID' => 13), array('blogID' => 4, 'formID' => 15), array('blogID' => 4, 'formID' => 16),
  array('blogID' => 6, 'formID' => 1),  array('blogID' => 7, 'formID' => 3),  array('blogID' => 7, 'formID' => 4),
  array('blogID' => 7, 'formID' => 18), array('blogID' => 9, 'formID' => 4),  array('blogID' => 9, 'formID' => 12),
  array('blogID' => 11, 'formID' => 6), array('blogID' => 11, 'formID' => 8), array('blogID' => 12, 'formID' => 3),
  array('blogID' => 12, 'formID' => 4), array('blogID' => 12, 'formID' => 6), array('blogID' => 12, 'formID' => 8),
  array('blogID' => 13, 'formID' => 3), array('blogID' => 26, 'formID' => 5), array('blogID' => 28, 'formID' => 7),
  array('blogID' => 39, 'formID' => 1), array('blogID' => 39, 'formID' => 6), array('blogID' => 44, 'formID' => 3),
  array('blogID' => 46, 'formID' => 4), array('blogID' => 47, 'formID' => 3), array('blogID' => 52, 'formID' => 7),
  array('blogID' => 54, 'formID' => 3), array('blogID' => 54, 'formID' => 5), array('blogID' => 55, 'formID' => 3),
  array('blogID' => 60, 'formID' => 3), array('blogID' => 73, 'formID' => 4), array('blogID' => 77, 'formID' => 1),
  array('blogID' => 81, 'formID' => 1), array('blogID' => 85, 'formID' => 4), array('blogID' => 90, 'formID' => 1),
  array('blogID' => 90, 'formID' => 5), array('blogID' => 92, 'formID' => 4), array('blogID' => 92, 'formID' => 9),
  array('blogID' => 95, 'formID' => 4), array('blogID' => 95, 'formID' => 7), array('blogID' => 95, 'formID' => 8),
  array('blogID' => 98, 'formID' => 4),
  array('blogID' => 100, 'formID' => 4),  array('blogID' => 102, 'formID' => 4),  array('blogID' => 102, 'formID' => 5),
  array('blogID' => 109, 'formID' => 5),  array('blogID' => 109, 'formID' => 8),  array('blogID' => 109, 'formID' => 10),
  array('blogID' => 110, 'formID' => 3),  array('blogID' => 111, 'formID' => 7),  array('blogID' => 111, 'formID' => 12),
  array('blogID' => 114, 'formID' => 5),  array('blogID' => 116, 'formID' => 5),  array('blogID' => 116, 'formID' => 9),
  array('blogID' => 118, 'formID' => 5),  array('blogID' => 120, 'formID' => 7),  array('blogID' => 122, 'formID' => 5),
  array('blogID' => 122, 'formID' => 6),  array('blogID' => 125, 'formID' => 4),  array('blogID' => 127, 'formID' => 1),
  array('blogID' => 129, 'formID' => 1),  array('blogID' => 129, 'formID' => 6),  array('blogID' => 129, 'formID' => 7),
  array('blogID' => 129, 'formID' => 8),  array('blogID' => 134, 'formID' => 6),  array('blogID' => 135, 'formID' => 1),
  array('blogID' => 135, 'formID' => 8),  array('blogID' => 135, 'formID' => 10), array('blogID' => 135, 'formID' => 11),
  array('blogID' => 140, 'formID' => 3),  array('blogID' => 141, 'formID' => 5),  array('blogID' => 145, 'formID' => 4),
  array('blogID' => 146, 'formID' => 1),  array('blogID' => 149, 'formID' => 6),  array('blogID' => 151, 'formID' => 6),
  array('blogID' => 151, 'formID' => 17), array('blogID' => 153, 'formID' => 5),  array('blogID' => 156, 'formID' => 7),
  array('blogID' => 161, 'formID' => 4),  array('blogID' => 162, 'formID' => 1),  array('blogID' => 162, 'formID' => 4),
  array('blogID' => 164, 'formID' => 6),  array('blogID' => 165, 'formID' => 1),  array('blogID' => 165, 'formID' => 6),
  array('blogID' => 169, 'formID' => 3),  array('blogID' => 177, 'formID' => 6),  array('blogID' => 184, 'formID' => 4),
  array('blogID' => 189, 'formID' => 4),  array('blogID' => 193, 'formID' => 5),  array('blogID' => 199, 'formID' => 5),
  array('blogID' => 204, 'formID' => 1),  array('blogID' => 204, 'formID' => 6),  array('blogID' => 206, 'formID' => 6),
  array('blogID' => 221, 'formID' => 4),  array('blogID' => 233, 'formID' => 7),  array('blogID' => 233, 'formID' => 12),
  array('blogID' => 4, 'formID' => 1),array('blogID' => 4, 'formID' => 4),array('blogID' => 5, 'formID' => 1),array('blogID' => 5, 'formID' => 3),array('blogID' => 5, 'formID' => 7),array('blogID' => 5, 'formID' => 8),array('blogID' => 5, 'formID' => 9),array('blogID' => 5, 'formID' => 11),array('blogID' => 6, 'formID' => 1),array('blogID' => 7, 'formID' => 1),array('blogID' => 8, 'formID' => 1),array('blogID' => 9, 'formID' => 1),array('blogID' => 11, 'formID' => 1),array('blogID' => 11, 'formID' => 3),array('blogID' => 11, 'formID' => 7),array('blogID' => 12, 'formID' => 1),array('blogID' => 13, 'formID' => 1),array('blogID' => 14, 'formID' => 1),array('blogID' => 15, 'formID' => 1),array('blogID' => 16, 'formID' => 1),array('blogID' => 16, 'formID' => 3),array('blogID' => 16, 'formID' => 4),array('blogID' => 16, 'formID' => 6),array('blogID' => 20, 'formID' => 1),array('blogID' => 21, 'formID' => 1),array('blogID' => 22, 'formID' => 1),array('blogID' => 23, 'formID' => 1),array('blogID' => 23, 'formID' => 8),array('blogID' => 24, 'formID' => 1),array('blogID' => 24, 'formID' => 3),array('blogID' => 25, 'formID' => 1),array('blogID' => 25, 'formID' => 3),array('blogID' => 25, 'formID' => 4),array('blogID' => 26, 'formID' => 1),array('blogID' => 26, 'formID' => 3),array('blogID' => 27, 'formID' => 1),array('blogID' => 27, 'formID' => 3),array('blogID' => 28, 'formID' => 1),array('blogID' => 28, 'formID' => 3),array('blogID' => 28, 'formID' => 5),array('blogID' => 28, 'formID' => 6),array('blogID' => 29, 'formID' => 1),array('blogID' => 29, 'formID' => 3),array('blogID' => 30, 'formID' => 1),array('blogID' => 30, 'formID' => 3),array('blogID' => 31, 'formID' => 1),array('blogID' => 31, 'formID' => 3),array('blogID' => 32, 'formID' => 1),array('blogID' => 33, 'formID' => 1),array('blogID' => 33, 'formID' => 4),array('blogID' => 34, 'formID' => 1),array('blogID' => 34, 'formID' => 3),array('blogID' => 34, 'formID' => 7),array('blogID' => 36, 'formID' => 1),array('blogID' => 37, 'formID' => 1),array('blogID' => 38, 'formID' => 1),array('blogID' => 40, 'formID' => 1),array('blogID' => 40, 'formID' => 3),array('blogID' => 40, 'formID' => 5),array('blogID' => 41, 'formID' => 1),array('blogID' => 42, 'formID' => 1),array('blogID' => 42, 'formID' => 4),array('blogID' => 43, 'formID' => 1),array('blogID' => 43, 'formID' => 3),array('blogID' => 44, 'formID' => 1),array('blogID' => 45, 'formID' => 1),array('blogID' => 45, 'formID' => 3),array('blogID' => 46, 'formID' => 1),array('blogID' => 47, 'formID' => 1),array('blogID' => 48, 'formID' => 1),array('blogID' => 48, 'formID' => 3),array('blogID' => 48, 'formID' => 7),array('blogID' => 49, 'formID' => 1),array('blogID' => 52, 'formID' => 1),array('blogID' => 53, 'formID' => 1),array('blogID' => 54, 'formID' => 1),array('blogID' => 55, 'formID' => 1),array('blogID' => 56, 'formID' => 1),array('blogID' => 57, 'formID' => 1),array('blogID' => 58, 'formID' => 1),array('blogID' => 58, 'formID' => 5),array('blogID' => 59, 'formID' => 1),array('blogID' => 60, 'formID' => 1),array('blogID' => 61, 'formID' => 1),array('blogID' => 62, 'formID' => 1),array('blogID' => 63, 'formID' => 1),array('blogID' => 64, 'formID' => 1),array('blogID' => 64, 'formID' => 6),array('blogID' => 65, 'formID' => 1),array('blogID' => 65, 'formID' => 4),array('blogID' => 66, 'formID' => 1),array('blogID' => 66, 'formID' => 4),array('blogID' => 67, 'formID' => 1),array('blogID' => 67, 'formID' => 4),array('blogID' => 68, 'formID' => 1),array('blogID' => 68, 'formID' => 4),array('blogID' => 69, 'formID' => 1),array('blogID' => 69, 'formID' => 5),array('blogID' => 70, 'formID' => 1),array('blogID' => 71, 'formID' => 1),array('blogID' => 71, 'formID' => 4),array('blogID' => 72, 'formID' => 1),array('blogID' => 73, 'formID' => 1),array('blogID' => 74, 'formID' => 1),array('blogID' => 75, 'formID' => 1),array('blogID' => 75, 'formID' => 4),array('blogID' => 76, 'formID' => 1),array('blogID' => 78, 'formID' => 1),array('blogID' => 78, 'formID' => 4),array('blogID' => 79, 'formID' => 1),array('blogID' => 79, 'formID' => 4),array('blogID' => 80, 'formID' => 1),array('blogID' => 80, 'formID' => 4),array('blogID' => 82, 'formID' => 1),array('blogID' => 82, 'formID' => 4),array('blogID' => 83, 'formID' => 1),array('blogID' => 83, 'formID' => 6),array('blogID' => 84, 'formID' => 1),array('blogID' => 84, 'formID' => 4),array('blogID' => 84, 'formID' => 5),array('blogID' => 84, 'formID' => 7),array('blogID' => 85, 'formID' => 1),array('blogID' => 86, 'formID' => 1),array('blogID' => 86, 'formID' => 5),array('blogID' => 87, 'formID' => 1),array('blogID' => 88, 'formID' => 1),array('blogID' => 89, 'formID' => 1),array('blogID' => 89, 'formID' => 4),array('blogID' => 90, 'formID' => 4),array('blogID' => 91, 'formID' => 1),array('blogID' => 91, 'formID' => 4),array('blogID' => 91, 'formID' => 6),array('blogID' => 92, 'formID' => 1),array('blogID' => 93, 'formID' => 1),array('blogID' => 94, 'formID' => 1),array('blogID' => 94, 'formID' => 4),array('blogID' => 95, 'formID' => 1),array('blogID' => 96, 'formID' => 1),array('blogID' => 97, 'formID' => 1),array('blogID' => 98, 'formID' => 1),array('blogID' => 98, 'formID' => 3),array('blogID' => 99, 'formID' => 1),array('blogID' => 99, 'formID' => 6),array('blogID' => 100, 'formID' => 1),array('blogID' => 101, 'formID' => 4),array('blogID' => 102, 'formID' => 1),array('blogID' => 104, 'formID' => 1),array('blogID' => 105, 'formID' => 1),array('blogID' => 109, 'formID' => 1),array('blogID' => 110, 'formID' => 1),array('blogID' => 110, 'formID' => 4),array('blogID' => 111, 'formID' => 1),array('blogID' => 112, 'formID' => 1),array('blogID' => 112, 'formID' => 4),array('blogID' => 113, 'formID' => 1),array('blogID' => 114, 'formID' => 1),array('blogID' => 115, 'formID' => 1),array('blogID' => 116, 'formID' => 1),array('blogID' => 117, 'formID' => 1),array('blogID' => 118, 'formID' => 1),array('blogID' => 118, 'formID' => 4),array('blogID' => 119, 'formID' => 1),array('blogID' => 120, 'formID' => 1),array('blogID' => 120, 'formID' => 6),array('blogID' => 121, 'formID' => 1),array('blogID' => 121, 'formID' => 3),array('blogID' => 122, 'formID' => 1),array('blogID' => 122, 'formID' => 7),array('blogID' => 123, 'formID' => 1),array('blogID' => 124, 'formID' => 1),array('blogID' => 124, 'formID' => 4),array('blogID' => 124, 'formID' => 9),array('blogID' => 125, 'formID' => 1),array('blogID' => 126, 'formID' => 1),array('blogID' => 128, 'formID' => 1),array('blogID' => 130, 'formID' => 1),array('blogID' => 131, 'formID' => 1),array('blogID' => 131, 'formID' => 4),array('blogID' => 132, 'formID' => 1),array('blogID' => 132, 'formID' => 4),array('blogID' => 132, 'formID' => 5),array('blogID' => 132, 'formID' => 7),array('blogID' => 133, 'formID' => 4),array('blogID' => 134, 'formID' => 1),array('blogID' => 134, 'formID' => 5),array('blogID' => 135, 'formID' => 5),array('blogID' => 135, 'formID' => 9),array('blogID' => 136, 'formID' => 1),array('blogID' => 137, 'formID' => 1),array('blogID' => 138, 'formID' => 1),array('blogID' => 139, 'formID' => 1),array('blogID' => 139, 'formID' => 4),array('blogID' => 140, 'formID' => 1),array('blogID' => 142, 'formID' => 1),array('blogID' => 142, 'formID' => 4),array('blogID' => 142, 'formID' => 7),array('blogID' => 143, 'formID' => 1),array('blogID' => 143, 'formID' => 4),array('blogID' => 144, 'formID' => 1),array('blogID' => 145, 'formID' => 1),array('blogID' => 147, 'formID' => 1),array('blogID' => 147, 'formID' => 4),array('blogID' => 147, 'formID' => 6),array('blogID' => 149, 'formID' => 1),array('blogID' => 149, 'formID' => 3),array('blogID' => 150, 'formID' => 1),array('blogID' => 150, 'formID' => 4),array('blogID' => 151, 'formID' => 1),array('blogID' => 152, 'formID' => 1),array('blogID' => 152, 'formID' => 4),array('blogID' => 153, 'formID' => 1),array('blogID' => 153, 'formID' => 6),array('blogID' => 154, 'formID' => 1),array('blogID' => 155, 'formID' => 1),array('blogID' => 156, 'formID' => 1),array('blogID' => 157, 'formID' => 1),array('blogID' => 157, 'formID' => 4),array('blogID' => 158, 'formID' => 1),array('blogID' => 160, 'formID' => 1),array('blogID' => 161, 'formID' => 1),array('blogID' => 164, 'formID' => 1),array('blogID' => 165, 'formID' => 8),array('blogID' => 166, 'formID' => 1),array('blogID' => 167, 'formID' => 1),array('blogID' => 168, 'formID' => 1),array('blogID' => 168, 'formID' => 7),array('blogID' => 169, 'formID' => 1),array('blogID' => 170, 'formID' => 1),array('blogID' => 170, 'formID' => 4),array('blogID' => 171, 'formID' => 1),array('blogID' => 171, 'formID' => 4),array('blogID' => 172, 'formID' => 1),array('blogID' => 172, 'formID' => 4),array('blogID' => 173, 'formID' => 1),array('blogID' => 173, 'formID' => 4),array('blogID' => 174, 'formID' => 1),array('blogID' => 175, 'formID' => 1),array('blogID' => 175, 'formID' => 4),array('blogID' => 175, 'formID' => 5),array('blogID' => 175, 'formID' => 6),array('blogID' => 177, 'formID' => 1),array('blogID' => 177, 'formID' => 5),array('blogID' => 178, 'formID' => 1),array('blogID' => 178, 'formID' => 4),array('blogID' => 179, 'formID' => 1),array('blogID' => 180, 'formID' => 1),array('blogID' => 180, 'formID' => 4),array('blogID' => 181, 'formID' => 1),array('blogID' => 181, 'formID' => 7),array('blogID' => 182, 'formID' => 1),array('blogID' => 183, 'formID' => 1),array('blogID' => 184, 'formID' => 1),array('blogID' => 185, 'formID' => 1),array('blogID' => 185, 'formID' => 4),array('blogID' => 187, 'formID' => 1),array('blogID' => 188, 'formID' => 1),array('blogID' => 189, 'formID' => 1),array('blogID' => 190, 'formID' => 1),array('blogID' => 191, 'formID' => 1),array('blogID' => 191, 'formID' => 4),array('blogID' => 191, 'formID' => 5),array('blogID' => 192, 'formID' => 1),array('blogID' => 192, 'formID' => 7),array('blogID' => 193, 'formID' => 1),array('blogID' => 194, 'formID' => 1),array('blogID' => 195, 'formID' => 1),array('blogID' => 195, 'formID' => 4),array('blogID' => 196, 'formID' => 1),array('blogID' => 196, 'formID' => 4),array('blogID' => 197, 'formID' => 1),array('blogID' => 199, 'formID' => 1),array('blogID' => 199, 'formID' => 4),array('blogID' => 200, 'formID' => 1),array('blogID' => 200, 'formID' => 4),array('blogID' => 201, 'formID' => 1),array('blogID' => 201, 'formID' => 4),array('blogID' => 202, 'formID' => 1),array('blogID' => 203, 'formID' => 1),array('blogID' => 204, 'formID' => 8),array('blogID' => 204, 'formID' => 9),array('blogID' => 204, 'formID' => 10),array('blogID' => 205, 'formID' => 1),array('blogID' => 206, 'formID' => 1),array('blogID' => 207, 'formID' => 1),array('blogID' => 208, 'formID' => 1),array('blogID' => 209, 'formID' => 1),array('blogID' => 210, 'formID' => 1),array('blogID' => 211, 'formID' => 1),array('blogID' => 212, 'formID' => 1),array('blogID' => 212, 'formID' => 5),array('blogID' => 212, 'formID' => 6),array('blogID' => 212, 'formID' => 9),array('blogID' => 213, 'formID' => 1),array('blogID' => 214, 'formID' => 1),array('blogID' => 216, 'formID' => 1),array('blogID' => 216, 'formID' => 4),array('blogID' => 216, 'formID' => 6),array('blogID' => 217, 'formID' => 1),array('blogID' => 217, 'formID' => 4),array('blogID' => 218, 'formID' => 1),array('blogID' => 219, 'formID' => 1),array('blogID' => 219, 'formID' => 3),array('blogID' => 219, 'formID' => 4),array('blogID' => 220, 'formID' => 4),array('blogID' => 221, 'formID' => 1),array('blogID' => 221, 'formID' => 4),array('blogID' => 222, 'formID' => 1),array('blogID' => 222, 'formID' => 4),array('blogID' => 223, 'formID' => 1),array('blogID' => 224, 'formID' => 1),array('blogID' => 225, 'formID' => 1),array('blogID' => 226, 'formID' => 1),array('blogID' => 227, 'formID' => 1),array('blogID' => 229, 'formID' => 1),array('blogID' => 230, 'formID' => 1),array('blogID' => 231, 'formID' => 1),array('blogID' => 231, 'formID' => 4),array('blogID' => 232, 'formID' => 1),array('blogID' => 233, 'formID' => 1)
);

$lockOptVal = array(303, 304);
$lockOptAll = array(105, 310, 311, 312, 313, 314, 315, 316);

//pull in the master CFM form - master.makerfaire.com (blog id = 6) form 1
$sql          = 'select display_meta from wp_6_rg_form_meta  where form_id=1';
$masterJSON   = $wpdb->get_var($sql);
$masterForm   = json_decode($masterJSON);
$masterFields = (array) $masterForm->fields;

$mastFldArr   = array();
//build master field array
foreach($masterFields as $field){
  if(in_array($field->id, $lockedFields)){
    $mastFldArr[$field->id] = $field;
  }
}

//var_dump($mastFldArr);
//pull form for each blog in the $blogFormArr array
foreach($blogFormArr as $data){
  $blogID = $data['blogID'];
  $formID = $data['formID'];

  $Blogsql  = 'select display_meta from wp_'.$blogID.'_rg_form_meta  where form_id='.$formID;

  $compJSON   = $wpdb->get_var($Blogsql);
  $compForm   = json_decode($compJSON);
  $compFields = (array) $compForm->fields;

  $compFldArr = array();
  $updateForm = false;
  //loop thru the fields in the compare form
  foreach($compFields as $compKey => $compField) {
    $lockID = $compField->id;
    //if the field is in the locked fields list, then we need to validate the data
    if(in_array($compField->id, $lockedFields)){
      $compFldArr[] = (string) $compField->id;
      $mastField = $mastFldArr[$compField->id]; //set the master field for comparison
      /*
       * if the field type does not match, there is a huge error.
       * Stop processing
       */
      if($mastField->type != $compField->type){
        die('ERROR!!! Field '.$compField->id.' error - Field Type different '.$mastField->type.' - '. $compField->type);
      }

      // validate required field checkbox
      if($mastField->isRequired != $compField->isRequired){
        echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
        echo 'Field - '.$compField->id.'. Error - Check Required different. '.
                'Master - ' . ($mastField->isRequired===TRUE?'True':'False').'. '.
                'Compare - '. ($compField->isRequired===TRUE?'True':'False').'<br/>';
        //update required checkbox of field to master value
        $compFields[$compKey]->isRequired = $mastField->isRequired;
        $updateForm = true;
      }
      // validate field visibility
      if($mastField->visibility != $compField->visibility){
        echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
        echo 'Field - '.$compField->id.'. Error -  Visibility different. Master - '.$mastField->visibility.'. Compare - '. $compField->visibility.'<br/>';
        //update visibility of field to master value
        $compFields[$compKey]->visibility = $mastField->visibility;
        $updateForm = true;
      }

      /*  Field Options */

      //lock all options - no translate or additions allowed
      if(in_array($lockID, $lockOptAll)){
        if($mastField->choices != $compField->choices){
          echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
          echo 'Field - '.$compField->id.'. Error - update field choices<br/>';
          $compFields[$compKey]->choices = $mastField->choices;
          $updateForm = true;
        }
        if($mastField->inputs != $compField->inputs){
          echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
          echo 'Field - '.$compField->id.'. Error - update field inputs<br/>';
          $compFields[$compKey]->inputs = $mastField->inputs;
          $updateForm = true;
        }
      }

      //lock values only on first options
      if(in_array($lockID, $lockOptVal)){
        //choices??
        if($mastField->choices != $compField->choices){
          foreach($mastField->choices as $choiceKey=>$choice){
            if($choice->value != $compField->choices[$choiceKey]->value) {
              echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
              echo 'Field - '.$compField->id.'. Error - Choice Value different. Master - '.$choice->value.'. Compare - '.$compField->choices[$choiceKey]->value.'<br/>';
              //update compField
              $compFields[$compKey]->choices[$choiceKey]->value = $choice->value;
              $updateForm = true;
            }
          }
        }

        //inputs??
        if($mastField->inputs != $compField->inputs){
          foreach($mastField->inputs as $inputKey=>$input){
            if($input->label != $compField->inputs[$inputKey]->label) {
              echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
              echo 'Field - '.$compField->id.'. Error - Input Value different. Master - '. $input->label.'. Compare - '. $compField->inputs[$inputKey]->label.'<br/>';
              //update compField
              $compFields[$compKey]->inputs[$inputKey]->label = $input->label;
              $updateForm = true;
            }
          }
        }
      }
    }
  }

  //compare the list of field id's updated to the list of locked fields
  // if one is missing we need to add it to the fields in $compForm
  $missingFields=array_diff($lockedFields,$compFldArr);

  foreach($missingFields as $missingField){
    $mastField = $mastFldArr[$missingField];
    echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
    echo 'Field - '.$missingField.'. Error - missing<br/>';
    $compFields[] = $mastField;
    $updateForm = true;
  }

  if($updateForm){
    echo 'updating $blogID - '.$blogID.'. $formID - '.$formID.'.<br/>';
    //var_dump($compFields);
    //die();
    //json encode
    $compForm->fields = $compFields;
    $updForm = json_encode($compForm);

    //run sql to update form
    $meta_table_name = 'wp_'.$blogID.'_rg_form_meta';
    $meta_name = 'display_meta';
    $result = $wpdb->query( $wpdb->prepare( "UPDATE $meta_table_name SET $meta_name=%s WHERE form_id=%d", $updForm, $formID ) );

  }
}
echo 'End Data update';