<?php
include 'db_connect.php';
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

td, th {
	padding: 5px !important;
	border: thin solid lightgrey;
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
<?php
// Connect to the database
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
   // If you cannot connect to the database let the user know and exit
   echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
   exit();
}

$mysqli->select_db($database);
$mysqli->query("SET NAMES 'utf8'");

// Select Statement to pull out the list of tables needed to run global locally
$tableSQL = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES
              WHERE (table_name REGEXP 'wp_[a-z].' or table_name like 'wp_9_%')
                AND table_schema = '" . $database . "'
              ORDER BY table_name";
$seperator = "-- --------------------------------------------------------\n";
$target_tables = array();

// Create a file to download
$filename = "global_db.sql";
$now = new \DateTime('now', new \DateTimeZone('PST'));
$nowF = $now->format('m/d/Y H:i:s');
//echo "Now = $nowF <br>";

// Open the file
$file = fopen($filename, "w") or die("Unable to open file!");

// Write the SQL Header to the file
fwrite($file, $seperator);
fwrite($file, "-- Global tables needed to run locally\n");
fwrite($file, "-- Generated on $nowF \n");
fwrite($file, $seperator."\n");
fwrite($file, "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n");
fwrite($file, "SET AUTOCOMMIT = 0;\n");
fwrite($file, "START TRANSACTION;\n");
fwrite($file, "SET time_zone = \"+00:00\";\n\n");
fwrite($file, $seperator);
fwrite($file, "-- Database: `$database`\n");
fwrite($file, $seperator."\n");

// Open the html table

$tableDetails .= '<table>';
$tableDetails .= '<tr><th>Table Name</th></tr>';
$tableCount = 0;

// Run the query to get the tables
$queryTables = $mysqli->query($tableSQL);
while ($row = $queryTables->fetch_row()) {
   $target_tables[] = $row[0];
   $tableDetails .= '<tr>' . "<td>$row[0]</td>" . '</tr>';
}

// Loop through the list of tables
foreach ($target_tables as $table) {   
   $result = $mysqli->query('SELECT * FROM ' . $table);
   $fields_amount = $result->field_count;
   $rows_num = $mysqli->affected_rows;
   $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
   $TableMLine = $res->fetch_row();
   // Write the Table Structure with Comments for the file
   //$content = (! isset($content) ? '' : $content) . "$seperator-- Table structure for table $table\n$seperator" . $TableMLine[1] . ";\n";
   $content = "$seperator-- Table structure for table $table\n$seperator" . $TableMLine[1] . ";\n";
   
   for ($i = 0, $st_counter = 0; $i < $fields_amount; $i ++, $st_counter = 0) {
      // Write the data to the file
      while ($row = $result->fetch_row()) { // when started (and every after 100 command cycle):
         if ($st_counter % 100 == 0 || $st_counter == 0) {
            // Write the Insert with Comments for the the file
            $content .= "\n$seperator-- Dumping data for table `wp_100_commentmeta`\n$seperator";
            $content .= "INSERT INTO " . $table . " VALUES";
         }
         $content .= "\n(";
         for ($j = 0; $j < $fields_amount; $j ++) {
            $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
            if (isset($row[$j])) {
               $content .= '"' . $row[$j] . '"';
            } else {
               $content .= '""';
            }
            if ($j < ($fields_amount - 1)) {
               $content .= ',';
            }
         }
         $content .= ")";
         // every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
         if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
            $content .= ";";
         } else {
            $content .= ",";
         }
         $st_counter = $st_counter + 1;
      }
   }
   $content .= "\n\n";
   fwrite($file, $content);
}
$tableDetails .= '</table>';
ob_flush();
flush();
// Close the file
fclose($file);
// ensure the permissions are correct after closing the file
chmod($filename, 0644);
//header("Content-type: application/sql");
//header("Content-disposition: attachment;filename=$filename");
//header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
//header('Pragma: no-cache');
//header('Expires: 0');
//readfile($filename);
?>
<a href="global_db.sql" download>Click to Download the Script</a><br>
<?php  echo $tableDetails; ?>
</body>
</html>