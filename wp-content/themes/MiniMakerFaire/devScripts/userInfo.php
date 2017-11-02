<?php
include 'db_connect.php';
global $wpdb;


  $users = $wpdb->get_results("SELECT wp_usermeta.*, wp_users.id, wp_users.user_login, wp_users.user_email,
                              (select meta_value from wp_usermeta where meta_key = 'primary_blog' and user_id = wp_users.id) as primary_blog
                              FROM `wp_users`
                              left outer join wp_usermeta on user_id = wp_users.id and meta_key like '%capabilities%'
                              ORDER BY meta_key ASC",ARRAY_A);

  $formArray = array();

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
  <?php
  $userID = '';
  echo '<table>';
  echo '<tr><th>User ID</th><th>User Login</th><th>User Email</th><th>Primary Blog</th><th>Blog ID</th><th>Roles</th></tr>';
  foreach($users as $user){
    $userID   =  $user['id'];
    $user_login =   $user['user_login'];
    $user_email =   $user['user_email'];
    $primary_blog =   $user['primary_blog'];
    $blogID =   str_replace('_capabilities', '', str_replace('wp_', '', $user['meta_key']));
    if($blogID=='capabilities') $blogID = 'network admin';
    $roles =   unserialize($user['meta_value']);
    $role  = (is_array($roles)? key($roles):'');
    echo  '<tr>'
        .   "<td>$userID</td>"
        .   "<td>$user_login</td>"
        .   "<td>$user_email</td>"
        .   "<td>$primary_blog</td>"
        .   "<td>$blogID</td>"
        .   "<td>$role</td>"
        . '</tr>';
  }
  echo '</table>';
  ?>
</body>
</html>