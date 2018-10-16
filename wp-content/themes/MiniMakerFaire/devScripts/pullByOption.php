<?php
include 'db_connect.php';
global $wpdb;

// form submitted to update optoin?
$parmValue = '';
if ((isset($_GET['optionValue']) && trim($_GET['optionValue']) != '')) {
   $parmValue = trim($_GET['optionValue']);
   // echo 'Parameter Value = ' . $parmValue . '<br>';
}

$blogSql = "select blog_id, domain from wp_blogs  ORDER BY `wp_blogs`.`blog_id` ASC";
$results = $wpdb->get_results($blogSql, ARRAY_A);
$option = (isset($_GET['option']) ? $_GET['option'] : '');
$blogArray = array();
if ($option != '') {
   // loop thru blogs
   foreach ($results as $blogrow) {
      $blogID = $blogrow['blog_id'];
      $table = 'wp_' . $blogID . '_options';
      $sql = "select option_value from " . $table . " where option_name = '" . $option . "'";
      if ((isset($parmValue) && $parmValue != '')) {
         $sql .= " and option_value = '" . $parmValue . "'";
      }
      //echo $sql. "<br>";
      $optionValue = $wpdb->get_var($sql);
      if (($optionValue != '' && strcmp($parmValue, $optionValue) == 0) || $parmValue == '' )  {
         $blogArray[] = array(
            'blog_id' => $blogID,
            'blog_name' => $blogrow['domain'],
            'optionValue' => $optionValue
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
   // echo 'updating ' . $updateName . ' to ' . $updateValue . '<br/>';
   if ($option == '') {
      echo 'Please supply the option name that you want to pull data from using the parameter option.';
   } else {
      ?>
      <div style="float: left; width: 100%">
        Returning results for Option - <?php echo $option; if ($parmValue != '') { 
         echo " Option Value - $parmValue";  }?>
      </div>
		<div style="clear: both">
			<table width="100%">
				<tr>
					<td>Blog ID</td>
					<td>Name</td>
					<td>Option Value</td>
				</tr>
        <?php
      
      foreach ($blogArray as $blogData) {
         // if (strcmp($parmValue, $blogData['optionValue']) ) {
         echo '<tr>';
         echo '<td>' . $blogData['blog_id'] . '</td>';
         echo '<td>' . $blogData['blog_name'] . '</td>';
         echo '<td>' . $blogData['optionValue'] . '</td>';
         echo '</tr>';
         // }
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
