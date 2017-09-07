<?php
include 'db_connect.php';
global $wpdb;

$blogSql = "select blog_id, domain from wp_blogs  ORDER BY `wp_blogs`.`blog_id` ASC";
$results = $wpdb->get_results($blogSql,ARRAY_A);

$blogArray = array();
//loop thru blogs
foreach($results as $blogrow){
  $blogID = $blogrow['blog_id'];
  $table  =  'wp_'.$blogID.'_rg_form';

  $formResults = $wpdb->get_results("select * from ".$table,ARRAY_A);
  $form = GFAPI::get_form($formrow['id']);
  $formArray = array();
  foreach($formResults as $formrow){
    $formArray[] = array(
        'form_id'       => $formrow['id'],
        'form_type'     => (isset($form['form_type'])?$form['form_type']:''),
        'form_name'     => $formrow['title'],
        'date_created'  => $formrow['date_created'],
        'is_active'     => $formrow['is_active'],
        'is_trash'      => $formrow['is_trash']
    );
  }
  $blogArray[] = array(
    'blog_id'       => $blogID,
    'blog_name'     => $blogrow['domain'],
    'forms'         => $formArray
  );
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
    table {font-size: 14px;}
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
  <link rel='stylesheet' id='make-bootstrap-css'  href='http://makerfaire.com/wp-content/themes/makerfaire/css/bootstrap.min.css' type='text/css' media='all' />
  <link rel='stylesheet' id='font-awesome-css'  href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css?ver=2.819999999999997' type='text/css' media='all' />
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container" style="width:100%; line-height: 1.3em">
    <?php
    foreach($blogArray as $blogData){
      echo '<b>'.$blogData['blog_id'].' - ' .$blogData['blog_name'].'</b>';
      ?>

      <div style="clear:both">
        <table width="100%">
          <tr>
            <td width="5%">Blog ID</td>
            <td width="5%">Form ID</td>
            <td width="5%">Form Type</td>
            <td width="60%">Name</td>
            <td width="15%">Date Created</td>
            <td width="5%">Active?</td>
            <td width="5%">Deleted?</td>
          </tr>
        <?php
        foreach($blogData['forms'] as $formData){
          echo '<tr>';
          echo '<td>'.$blogData['blog_id'].'</td>';
          echo '<td>'.$formData['form_id'].'</td>';
          echo '<td>'.$formData['form_type'].'</td>';
          echo '<td>'.$formData['form_name'].'</td>';
          echo '<td>'.$formData['date_created'].'</td>';
          echo '<td>'.($formData['is_active']==0?'No':'').'</td>';
          echo '<td>'.($formData['is_trash']==1?'Yes':'').'</td>';

          echo '</tr>';
        }
        ?>
        </table>
        <br/>
      </div>
      <?php } ?>
    </div>
</body>
</html>