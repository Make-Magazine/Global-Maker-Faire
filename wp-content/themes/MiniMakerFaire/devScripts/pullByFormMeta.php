<?php
include '../../../../wp-load.php';
// include 'db_connect.php';
global $wpdb;

$displayMeta = '';
$entryGridMeta = '';
$confirmations = '';
$notifications = '';
$debug = 0;
if ((isset($_GET['debug']) && trim($_GET['debug']) != '')) {
   $debug = 1;
   echo 'Turning on DEBUG mode <br>';
}
if ((isset($_GET['displayMeta']) && trim($_GET['displayMeta']) != '')) {
   $displayMeta = trim($_GET['displayMeta']);
   if ($debug) {
      echo 'Display Meta = ' . $displayMeta . '<br>';
   }
}
if ((isset($_GET['confirmations']) && trim($_GET['confirmations']) != '')) {
   $confirmations = trim($_GET['confirmations']);
   if ($debug) {
      echo 'Confirmations = ' . $confirmations . '<br>';
   }
}
if ((isset($_GET['entryGridMeta']) && trim($_GET['entryGridMeta']) != '')) {
   $entryGridMeta = trim($_GET['entryGridMeta']);
   if ($debug) {
      echo 'Entry Grid Meta = ' . $entryGridMeta . '<br>';
   }
}
if ((isset($_GET['notifications']) && trim($_GET['notifications']) != '')) {
   $notifications = trim($_GET['notifications']);
   if ($debug) {
      echo 'Notifications = ' . $notifications . '<br>';
   }
}

$blogSql = "select blog_id, domain from wp_blogs where blog_id != 1 ORDER BY `wp_blogs`.`blog_id` ASC";
$results = $wpdb->get_results($blogSql, ARRAY_A);
$blogArray = array();
if ($displayMeta != '' || $entryGridMeta != '' || $confirmations != '' || $notifications != '') {
   // loop thru blogs
   $counter = 0;
   foreach ($results as $blogrow) {
      $counter ++;
      $blogID = $blogrow['blog_id'];
      $table = 'wp_' . $blogID . '_rg_form_meta';
      // display_meta, confirmations and notifications
      $hasWhere = 0;
      $sql = "select form_id from " . $table;
      
      if ($displayMeta != '') {
         $sql .= " where display_meta like '%" . $displayMeta . "%'";
         $hasWhere = 1;
      }
      if ($entryGridMeta != '') {
         $sql .= (! $hasWhere) ? ' where ' : ' or ';
         $sql .= "entries_grid_meta like '%" . $entryGridMeta . "%'";
      }
      if ($confirmations != '') {
         $sql .= (! $hasWhere) ? ' where ' : ' or ';
         $sql .= "confirmations like '%" . $confirmations . "%'";
      }
      if ($notifications != '') {
         $sql .= (! $hasWhere) ? ' where ' : ' or ';
         $sql .= "notifications like '%" . $notifications . "%'";
      }
      $sql .= " order by form_id";
      
      // $queryResults = $wpdb->get_var($sql);
      $queryResults = $wpdb->get_results($sql, ARRAY_A);
      if ($debug) {
         echo "SQL -> $sql -> $blogID -> Query Results = " . var_dump($queryResults) . "<br>";
      }
      foreach ($queryResults as $formRow) {
         $blogArray[] = array(
            'blog_id' => $blogID,
            'blog_name' => $blogrow['domain'],
            'formId' => $formRow['form_id']
            // formId -> which field it was found in
         );
      }
   }
}

?>
<!doctype html>

<html lang="en">
<head>

<style>
h1, .h1, h2, .h2, h3, .h3 {
	margin-top: 10px !important;
	margin-bottom: 10px !important;
}

ul, ol {
	margin-top: 0 !important;
	margin-bottom: 0px !important;
	padding-top: 0px !important;
	padding-bottom: 0px !important;
}

table {
	font-size: 14px;
}

#headerRow {
	font-size: 1.2em;
	border: 1px solid #98bf21;
	padding: 5px;
	background-color: #A7C942;
	color: #fff;
	text-align: center;
}

.detailRow {
	font-size: 1.2em;
	border: 1px solid #98bf21;
}

#headerRow td, .detailRow td {
	border-right: 1px solid #98bf21;
	padding: 3px 7px;
	vertical-align: baseline;
}

.detailRow td:last-child {
	border-right: none;
}

.row-eq-height {
	display: -webkit-box;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
}

.tcenter {
	text-align: center;
}
</style>
</head>

<body>
	<div class="container" style="width: 100%; line-height: 1.3em">
    <?php
   if ($displayMeta == '' && $entryGridMeta == '' && $confirmations == '' && $notifications == '') {
      echo 'Please supply one or more of the following: displayMeta, entryGridMeta, confirmations, notifications that you want to pull data from using the form meta.';
   } else {
      ?>
      <div style="float: left; width: 100%">
        Returning results for
        <?php  if ($displayMeta != '') { echo "Display Meta - $displayMeta<br>" ; }?>
        <?php  if ($entryGridMeta != '') { echo "Entry Grid Meta - $entryGridMeta<br>" ; }?>
        <?php  if ($confirmations != '') { echo "Confirmations - $confirmations<br>" ; }?>
        <?php  if ($notifications != '') { echo "Notifications - $notifications<br>" ; }?>
      </div>
		<div style="clear: both">
			<table width="100%">
				<tr>
					<td>Blog ID</td>
					<td>Name</td>
					<td>FormId</td>
				</tr>
        <?php
      
      foreach ($blogArray as $blogData) {
         echo '<tr>';
         echo '<td>' . $blogData['blog_id'] . '</td>';
         echo '<td>' . $blogData['blog_name'] . '</td>';
         echo '<td>' . $blogData['formId'] . '</td>';
         echo '</tr>';
      }
      ?>
        </table>
		</div>
      <?php
   }
   
   ?>
    </div>
</body>
</html>
<?php

