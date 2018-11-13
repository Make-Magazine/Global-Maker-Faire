<?php
include 'db_connect.php';
global $wpdb;

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
$tableSQL = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES
              WHERE (table_name REGEXP 'wp_[a-z].' or table_name like 'wp_9_%')
                AND table_schema = '" . $database . "'
              ORDER BY table_name";

$tables = $wpdb->get_results($tableSQL, ARRAY_A);

// Create a file to download
$nowUtc = new \DateTime('now', new \DateTimeZone('PST'));
$nowUtcF = $nowUtc->format('YmdHis');
// $filename = "global_db_" . $nowUtcF . ".sql";
$filename = "global_db" . ".sql";
echo "File = $filename<br>";
$now = new \DateTime('now', new \DateTimeZone('PST'));
$nowF = $now->format('m/d/Y H:i:s');
echo "Now = $nowF <br>";

// Open the file
$file = fopen($filename, "w") or die("Unable to open file!");

// Write the SQL Header to the file
fwrite($file, "-- Global tables needed to run locally\n");
fwrite($file, "-- Generated on $nowF \n\n");
fwrite($file, "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n");
fwrite($file, "SET AUTOCOMMIT = 0;\n");
fwrite($file, "START TRANSACTION;\n");
fwrite($file, "SET time_zone = \"+00:00\";\n\n");
fwrite($file, "\n-- --------------------------------------------------------\n");
fwrite($file, "--\n");
fwrite($file, "-- Database: `$database`\n");

// Open the html table
echo '<table>';
echo '<tr><th>Table Name</th><th>Column Name</th><th>Data Type</th><th>Is Nullable</th><th>Default</th></tr>';
$tableCount = 0;
foreach ($tables as $table) {
   $table_name = $table['table_name'];
   write_table($table_name, $file, $tableCount ++);
   $columnSql = "SELECT table_name, column_name, column_default, is_nullable,
                        data_type, column_type, column_comment
                   FROM INFORMATION_SCHEMA.COLUMNS
                   WHERE table_name = '" . $table_name . "'
                     AND table_schema = '" . $database . "'
                   ORDER BY ordinal_position, column_name";
   $columns = $wpdb->get_results($columnSql, ARRAY_A);
   $columnCount = 0;
   $buildSelect = "SELECT ";
   $insertStmt = "\nINSERT INTO `$table_name` (";
   foreach ($columns as $column) {
      add_column($table_name, $column, $file, $columnCount ++, $buildSelect, $insertStmt);
   }
   // $buildSelect
   $insertStmt = rtrim($insertStmt, ',') . ') VALUES ';
   $buildSelect = rtrim($buildSelect, ',') . '';
   $buildSelect .= " FROM $table_name";
   $data = $wpdb->get_results($buildSelect, ARRAY_A);
   fwrite($file, "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;\n");
   fwrite($file, "$insertStmt\n");
   $row_data = "";
   $dataCount = 0;
   foreach ($data as $row) {
      if ($dataCount ++ > 0) {
         $row_data .= "\n";
      }
      $row_data .= cache_data($row, $file, $insertStmt);
   }
   $row_data = rtrim($row_data, ',') . '';
   fwrite($file, $row_data . ";\n");
   
   // Add the Index information
   write_index($table_name, $wpdb, $database, $file);
   
   // Add the Auto Increment Information
   $autoSql = "SELECT t.table_name, `AUTO_INCREMENT`, column_name
                 FROM information_schema.tables t
                      inner join information_schema.COLUMNS c on c.table_name = t.table_name   
                WHERE t.TABLE_SCHEMA = '" . $table_name . "'
                  AND c.table_name = '" . $database . "'
                  AND extra =  'auto_increment'";
   //$results = $wpdb->get_results($autoSql, ARRAY_A);
   fwrite($file, "\n--\n");
   fwrite($file, "-- AUTO_INCREMENT for table $table_name\n");
   fwrite($file, "--\n\n");
   fwrite($file, "ALTER TABLE `$table_name`\n");
   $index_line = "";
   $indexCount = 0;
   //foreach ($results as $row) {
      if ($indexCount ++ > 0) {
         $index_line .= "\n";
      }
      //$index_line .= add_index($index, $file);
   //}

}
echo '</table>';
ob_flush();
flush();
// Close the file
fclose($file);

function write_index($table_name, $wpdb, $database, $file) {
   $hasIndexSql = "SELECT count(*)
                     FROM INFORMATION_SCHEMA.STATISTICS
                    WHERE table_name = '" . $table_name . "' 
                      AND table_schema = '" . $database . "'";
   $indexCount = $wpdb->get_var($hasIndexSql);
   //echo "Number of Indexes found [$indexCount]<br>";
   if ($indexCount > 0) {
      // Add the Index information
      $indexSql = "SELECT index_name, column_name
                  FROM INFORMATION_SCHEMA.STATISTICS
                 WHERE table_name = '" . $table_name . "'
                   AND table_schema = '" . $database . "'
                 ORDER BY seq_in_index";
      $indexes = $wpdb->get_results($indexSql, ARRAY_A);
      fwrite($file, "\n--\n");
      fwrite($file, "-- Indexes dumped $table_name\n");
      fwrite($file, "--\n\n");
      fwrite($file, "ALTER TABLE `$table_name`\n");
      $index_line = "";
      $indexCount = 0;
      foreach ($indexes as $index) {
         if ($indexCount ++ > 0) {
            $index_line .= "\n";
         }
         $index_line .= add_index($index, $file);
      }
      $index_line = rtrim($index_line, ',') . '';
      fwrite($file, $index_line);
   }
}

function add_index($row, $file) {
   $index_name = $row['index_name'];
   $column_name = $row['column_name'];
   if ($index_name == 'PRIMARY') {
      return '  ADD PRIMARY KEY (`' . $column_name . '`),';
   } else {
      return '  ADD KEY (`' . $column_name . '`),';
   }
}

/**
 * Writes a row of data to the file
 *
 * @param array $row
 *           a row of data returned from the database
 * @param object $file
 *           file pointer to write the output to
 */
function cache_data($row, $file) {
   $line = "(";
   foreach ($row as $key => $value) {
      if (is_numeric($value)) {
         $line .= $value . ",";
      } else {
         $line .= addslashes($value) . ",";
      }
   }
   $line = rtrim($line, ',') . '' . "),";
   return $line;
   
}

/**
 * Writes the table information to the file
 *
 * @param string $table_name
 * @param object $file
 *           file pointer to write the output to
 */
function write_table($table_name, $file) {
   fwrite($file, "\n-- --------------------------------------------------------\n");
   fwrite($file, "--\n");
   fwrite($file, "-- Table structure for table `$table_name`\n");
   fwrite($file, "--\n\n");
   fwrite($file, "DROP TABLE IF EXISTS `$table_name`;\n");
   fwrite($file, "CREATE TABLE `$table_name` (\n");
   
}

/**
 * Adds the column information
 *
 * @param string $table_name
 * @param object $row
 * @param object $file
 * @param int $columnCount
 * @param string $buildSelect
 * @param string $insertStmt
 */
function add_column($table_name, $row, $file, $columnCount, &$buildSelect, &$insertStmt) {
   // Print column detail to screen
   $column_name = $row['column_name'];
   $data_type = $row['data_type'];
   $nullable = $row['is_nullable'];
   $default = $row['column_default'];
   echo '<tr>' . "<td>$table_name</td>" . "<td>$column_name</td>" . "<td>$data_type</td>" . "<td>$nullable</td>" . "<td>$default</td>" . "" . '</tr>';
   $buildSelect .= " `" . $column_name . "`,";
   $insertStmt .= " `" . $column_name . "`,";
   
   $append = "";
   if ($columnCount > 0) {
      $append .= ",\n";
   }
   $append .= "`$column_name` ";
   
   $type = $row['column_type'];
   $append .= $type;
   $append .= ($nullable == "NO") ? " NOT NULL" : "";
   if (! empty($default)) {
      $append .= " DEFAULT ";
      if ($default == "NULL") {
         $append .= $default;
      } else {
         $append .= '\'' . $default . '\'';
      }
   }
   
   fwrite($file, $append);
   
}
?>
</body>
</html>