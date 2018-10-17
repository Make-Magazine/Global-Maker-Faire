<?php
include '../../../../wp-load.php';
// include 'db_connect.php';
global $wpdb;

$tableName = '';
$newTableName = '';
$debug = 0;
if ((isset($_GET['debug']) && trim($_GET['debug']) != '')) {
   $debug = 1;
   echo 'Turning on DEBUG mode <br>';
}
if ((isset($_GET['tableName']) && trim($_GET['tableName']) != '')) {
   $tableName = trim($_GET['tableName']);
   if ($debug) {
      echo 'Table Name = ' . $tableName . '<br>';
   }
}
if ((isset($_GET['newTableName']) && trim($_GET['newTableName']) != '')) {
   $newTableName = trim($_GET['newTableName']);
   if ($debug) {
      echo 'newTableName = ' . $newTableName . '<br>';
   }
}

$blogSql = "select blog_id, domain from wp_blogs where blog_id != 1 ORDER BY `wp_blogs`.`blog_id` ASC";
$results = $wpdb->get_results($blogSql, ARRAY_A);
$blogArray = array();
if ($tableName != '') {
   // loop thru blogs
   $counter = 0;
   $stripName = str_replace("wp_", "", $tableName);
   $stripNewName = str_replace("wp_", "", $newTableName);
   foreach ($results as $blogrow) {
      $counter ++;
      $blogID = $blogrow['blog_id'];
      
      $table = 'wp_' . $blogID . "_" . $stripName;
      $newRetable = 'wp_' . $blogID . "_" . $stripNewName;
      
      // display_meta, confirmations and notifications
      $hasWhere = 0;
      $sql = "rename table " . $table . " to " . $newRetable;
      //echo "SQL -> $sql<br>";
      $wpdb->query($sql);
      $blogArray[] = array(
         'blog_id' => $blogID,
         'blog_name' => $blogrow['domain'],
         'Table' => $sql //"Update $table to $newRetable"
      );
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
   if ($tableName == '') {
      echo 'Please supply one or more of the following: displayMeta, entryGridMeta, confirmations, notifications that you want to pull data from using the form meta.';
   } else {
      ?>
      <div style="float: left; width: 100%">
        Renaming Table <?php echo "$tableName to $newTableName"; ?>
     </div>
		<div style="clear: both">
			<table width="100%">
				<tr>
					<td>Blog ID</td>
					<td>Name</td>
					<td>Status</td>
				</tr>
        <?php
      
      foreach ($blogArray as $blogData) {
         echo '<tr>';
         echo '<td>' . $blogData['blog_id'] . '</td>';
         echo '<td>' . $blogData['blog_name'] . '</td>';
         echo '<td>' . $blogData['Table'] . '</td>';
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

