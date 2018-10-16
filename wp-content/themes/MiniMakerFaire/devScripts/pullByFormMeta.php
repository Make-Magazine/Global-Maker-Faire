<?php
include 'db_connect.php';
global $wpdb;

// form submitted to update optoin?
$displayMeta = '';
$entryGridMeta = '';
$confimations = '';
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
if ((isset($_GET['confimations']) && trim($_GET['confimations']) != '')) {
   $confimations = trim($_GET['confimations']);
   if ($debug) {
      echo 'Confirmations = ' . $confimations . '<br>';
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

$blogSql = "select blog_id, domain from wp_blogs  ORDER BY `wp_blogs`.`blog_id` ASC";
$results = $wpdb->get_results($blogSql, ARRAY_A);
$blogArray = array();
if ($displayMeta != '' || $entryGridMeta != '' || $confimations != '' || $notifications != '') {
   // loop thru blogs
   foreach ($results as $blogrow) {
      $blogID = $blogrow['blog_id'];
      $table = 'wp_' . $blogID . '_rg_form_meta';
      // display_meta, confirmations and notifications
      $hasWhere = 0;
      $sql = "select distinct 1 from " . $table;
      
      if ($displayMeta != '') {
         $sql .= " where display_meta like '%" . $displayMeta . "%'";
         $hasWhere = 1;
      }
      if ($entryGridMeta != '') {
         if (! $hasWhere) {
            $sql .= ' where ';
            $hasWhere = 1;
         } else {
            $sql .= ' or ';
         }
         $sql .= "entries_grid_meta like '%" . $entryGridMeta . "%'";
      }
      if ($confimations != '') {
         if (! $hasWhere) {
            $sql .= ' where ';
            $hasWhere = 1;
         } else {
            $sql .= ' or ';
         }
         $sql .= "confirmations like '%" . $confimations . "%'";
      }
      if ($notifications != '') {
         if (! $hasWhere) {
            $sql .= ' where ';
            $hasWhere = 1;
         } else {
            $sql .= ' or ';
         }
         $sql .= "notifications like '%" . $notifications . "%'";
      }
      
      $queryResults = $wpdb->get_var($sql);
      if ($debug) {
         echo "SQL -> $sql -> $blogID -> Query Results = $queryResults<br>";
      }
      if ($queryResults != '' && strcmp("1", $queryResults) == 0) {        
         $blogArray[] = array(
            'blog_id' => $blogID,
            'blog_name' => $blogrow['domain'],
            'queryResults' => $queryResults
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
<link rel='stylesheet' id='make-bootstrap-css'
	href='http://makerfaire.com/wp-content/themes/makerfaire/css/bootstrap.min.css'
	type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css'
	href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css?ver=2.819999999999997'
	type='text/css' media='all' />
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
	integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
	crossorigin="anonymous"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
</head>

<body>
	<div class="container" style="width: 100%; line-height: 1.3em">
    <?php
   if ($displayMeta == '' && $entryGridMeta == '' && $confimations == '' && $notifications == '') {
      echo 'Please supply one or more of the following: displayMeta, entryGridMeta, confirmations, notifications that you want to pull data from using the form meta.';
   } else {
      ?>
      <div style="float: left; width: 100%">
        Returning results for
        <?php  if ($displayMeta != '') { echo "Display Meta - $displayMeta<br> or" ; }?>
        <?php  if ($entryGridMeta != '') { echo "Entry Grid Meta - $entryGridMeta<br> or" ; }?>
        <?php  if ($confimations != '') { echo "Confirmations - $confimations<br> or" ; }?>
        <?php  if ($notifications != '') { echo "Notifications - $notifications<br> " ; }?>
      </div>
		<div style="clear: both">
			<table width="100%">
				<tr>
					<td>Blog ID</td>
					<td>Name</td>
				</tr>
        <?php
      
      foreach ($blogArray as $blogData) {
         echo '<tr>';
         echo '<td>' . $blogData['blog_id'] . '</td>';
         echo '<td>' . $blogData['blog_name'] . '</td>';
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

function cmp($a, $b) {
   return $a["id"] - $b["id"];
   
}
