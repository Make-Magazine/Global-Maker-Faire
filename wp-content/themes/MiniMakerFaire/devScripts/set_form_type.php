<?php
include 'db_connect.php';
global $wpdb;
//Blog ID, 	Form ID
$formArray =
array(
   array(4,1),array(4,3),array(4,4),array(4,9),array(4,10),array(4,11),array(4,12),array(4,13),array(5,1),array(5,3),array(5,4),array(5,5),array(5,6),array(5,7),array(5,8),array(5,9),array(6,1),array(6,3),array(7,1),array(7,3),array(7,4),array(7,18),array(8,1),array(9,1),array(9,3),array(9,4),array(9,10),array(9,11),array(9,12),array(9,13),array(9,14),array(11,1),array(11,3),array(11,5),array(11,6),array(11,7),array(12,1),array(12,3),array(12,4),array(12,5),array(12,6),array(12,7),array(12,8),array(13,1),array(13,3),array(14,1),array(15,1),array(16,1),array(16,3),array(16,4),array(20,1),array(21,1),array(21,8),array(22,1),array(23,1),array(23,3),array(23,4),array(23,7),array(24,1),array(24,3),array(25,1),array(25,3),array(25,4),array(26,1),array(26,3),array(26,4),array(27,1),array(27,3),array(27,4),array(27,5),array(28,1),array(28,3),array(28,4),array(29,1),array(29,3),array(30,1),array(30,3),array(30,7),array(31,1),array(31,3),array(32,1),array(33,1),array(33,3),array(33,4),array(34,1),array(34,3),array(34,4),array(34,5),array(36,1),array(36,3),array(37,1),array(38,1),array(39,1),array(39,5),array(39,6),array(39,7),array(39,8),array(40,1),array(40,3),array(40,5),array(41,1),array(42,1),array(42,3),array(42,4),array(43,1),array(43,3),array(44,1),array(44,3),array(44,4),array(44,5),array(45,1),array(45,3),array(46,1),array(46,3),array(46,4),array(47,1),array(47,3),array(48,1),array(48,3),array(48,7),array(48,10),array(48,11),array(49,1),array(52,1),array(52,3),array(52,4),array(52,5),array(52,6),array(52,7),array(53,1),array(54,1),array(54,3),array(54,5),array(55,1),array(55,3),array(56,1),array(57,1),array(58,1),array(58,3),array(58,4),array(58,5),array(58,7),array(59,1),array(60,1),array(60,3),array(61,1),array(62,1),array(63,1),array(64,1),array(64,3),array(64,6),array(65,1),array(65,3),array(65,4),array(66,1),array(66,3),array(66,4),array(67,1),array(67,3),array(67,4),array(68,1),array(68,3),array(68,4),array(69,1),array(69,3),array(69,5),array(70,1),array(70,3),array(70,4),array(70,5),array(71,1),array(71,3),array(71,4),array(71,5),array(71,6),array(72,1),array(72,3),array(73,1),array(73,3),array(73,4),array(74,1),array(74,3),array(75,1),array(75,3),array(75,4),array(76,1),array(76,3),array(77,1),array(77,3),array(78,1),array(78,3),array(78,4),array(78,8),array(79,1),array(79,3),array(79,4),array(80,1),array(80,3),array(80,4),array(81,1),array(81,3),array(81,4),array(81,7),array(82,1),array(82,3),array(82,4),array(83,1),array(83,3),array(83,6),array(84,1),array(84,3),array(84,4),array(84,5),array(84,6),array(85,1),array(85,3),array(85,4),array(86,1),array(86,3),array(86,4),array(86,5),array(87,1),array(87,3),array(88,1),array(88,3),array(89,1),array(89,3),array(89,4),array(89,12),array(90,1),array(90,3),array(90,4),array(90,5),array(90,6),array(91,1),array(91,3),array(91,4),array(91,6),array(92,1),array(92,3),array(92,4),array(92,9),array(93,1),array(93,3),array(94,1),array(94,3),array(94,4),array(95,1),array(95,3),array(95,4),array(95,7),array(95,8),array(96,1),array(96,3),array(97,1),array(97,3),array(98,1),array(98,3),array(98,4),array(99,1),array(99,3),array(99,4),array(99,6),array(99,9),array(100,1),array(100,3),array(100,4),array(100,5),array(100,7),array(100,8),array(100,9),array(100,10),array(100,12),array(100,13),array(101,1),array(101,3),array(101,4),array(101,8),array(102,1),array(102,3),array(102,4),array(102,5),array(103,1),array(103,3),array(104,1),array(104,3),array(105,1),array(105,3),array(109,1),array(109,3),array(109,4),array(109,5),array(109,7),array(109,8),array(110,1),array(110,3),array(110,4),array(110,5),array(110,6),array(111,1),array(111,3),array(111,4),array(111,5),array(111,6),array(111,7),array(111,8),array(111,9),array(111,11),array(111,12),array(111,13),array(112,1),array(112,3),array(112,4),array(112,5),array(112,6),array(113,1),array(113,3),array(114,1),array(114,3),array(114,4),array(114,5),array(115,1),array(115,3),array(116,1),array(116,5),array(116,9),array(117,1),array(117,3),array(118,1),array(118,3),array(118,4),array(118,5),array(119,1),array(119,5),array(120,1),array(120,3),array(120,4),array(120,5),array(120,6),array(120,7),array(121,1),array(121,3),array(122,1),array(122,3),array(122,5),array(122,6),array(122,7),array(123,1),array(123,3),array(124,1),array(124,3),array(124,4),array(124,5),array(124,6),array(125,1),array(125,3),array(125,4),array(125,5),array(126,1),array(126,3),array(127,1),array(128,1),array(128,3),array(129,1),array(129,3),array(129,4),array(129,6),array(129,7),array(130,1),array(130,3),array(131,1),array(131,3),array(131,4),array(132,1),array(132,3),array(132,4),array(132,5),array(132,7),array(132,10),array(132,11),array(132,12),array(133,1),array(133,3),array(133,4),array(134,1),array(134,3),array(134,4),array(134,5),array(134,6),array(135,1),array(135,3),array(135,4),array(135,5),array(135,6),array(135,7),array(135,8),array(135,9),array(135,10),array(135,11),array(136,1),array(136,3),array(137,1),array(137,3),array(138,1),array(138,3),array(138,4),array(138,5),array(139,1),array(139,3),array(139,4),array(140,1),array(140,3),array(141,1),array(141,3),array(141,5),array(141,6),array(141,8),array(141,10),array(142,1),array(142,3),array(142,4),array(142,7),array(143,1),array(143,3),array(143,4),array(144,1),array(144,3),array(145,1),array(145,3),array(145,4),array(146,1),array(146,3),array(147,1),array(147,3),array(147,4),array(147,6),array(149,1),array(149,3),array(149,4),array(149,5),array(149,6),array(150,1),array(150,3),array(150,4),array(151,1),array(151,3),array(151,4),array(151,6),array(151,11),array(151,14),array(151,17),array(152,1),array(152,3),array(152,4),array(153,1),array(153,3),array(153,4),array(153,5),array(153,6),array(154,1),array(154,3),array(155,1),array(155,3),array(156,1),array(156,3),array(156,4),array(156,5),array(156,6),array(156,7),array(157,1),array(157,3),array(157,4),array(158,1),array(158,3),array(160,1),array(160,3),array(161,1),array(161,3),array(161,4),array(162,1),array(162,3),array(162,4),array(164,1),array(164,3),array(164,4),array(164,6),array(165,1),array(165,3),array(165,4),array(165,5),array(165,6),array(165,8),array(166,1),array(166,3),array(167,1),array(167,3),array(168,1),array(168,3),array(168,7),array(169,1),array(169,3),array(170,1),array(170,3),array(170,4),array(171,1),array(171,3),array(171,4),array(172,1),array(172,3),array(172,4),array(172,5),array(173,1),array(173,3),array(173,4),array(174,1),array(174,3),array(175,1),array(175,3),array(175,4),array(175,5),array(175,6),array(177,1),array(177,3),array(177,4),array(177,5),array(177,6),array(178,1),array(178,3),array(178,4),array(178,5),array(178,7),array(179,1),array(179,3),array(180,1),array(180,3),array(180,4),array(181,1),array(181,3),array(181,5),array(181,6),array(181,7),array(182,1),array(182,3),array(182,4),array(183,1),array(183,3),array(184,1),array(184,3),array(184,4),array(185,1),array(185,3),array(185,4),array(185,5),array(187,1),array(187,3),array(188,1),array(188,3),array(188,4),array(188,5),array(189,1),array(189,3),array(189,4),array(190,1),array(190,3),array(191,1),array(191,3),array(191,4),array(191,5),array(192,1),array(192,3),array(193,1),array(193,3),array(193,4),array(193,5),array(193,6),array(194,1),array(194,3),array(195,1),array(195,3),array(195,4),array(195,5),array(196,1),array(196,3),array(196,4),array(197,1),array(197,3),array(198,1),array(198,3),array(199,1),array(199,3),array(199,4),array(199,5),array(200,1),array(200,3),array(200,4),array(200,5),array(201,1),array(201,3),array(201,4),array(201,6),array(202,1),array(203,1),array(204,1),array(204,3),array(204,4),array(204,5),array(204,6),array(204,8),array(204,9),array(204,10),array(205,1),array(205,3),array(206,1),array(206,6),array(207,1),array(207,3),array(208,1),array(208,3),array(209,1),array(209,3),array(210,1),array(210,3),array(211,1),array(211,3),array(212,1),array(212,5),array(212,6),array(213,1),array(214,1),array(214,3),array(215,1),array(215,3),array(216,1),array(216,3),array(216,4),array(216,5),array(216,6),array(217,1),array(217,3),array(217,4),array(218,1),array(218,3),array(219,1),array(219,3),array(219,4),array(220,1),array(220,3),array(220,4),array(221,1),array(221,3),array(222,1),array(222,3),array(222,4),array(223,1),array(223,3),array(224,1),array(224,3),array(225,1),array(225,3),array(226,1),array(226,3),array(227,1),array(227,3)
);
$form_type = 'cfm';
foreach($formArray as $formInfo){
  $blogID   = $formInfo[0];
  $form_id  = $formInfo[0];
  $table  =  'wp_'.$blogID.'_rg_form_meta';
  $sql = "SELECT display_meta FROM ".$table." where form_id=".$form_id;
  $json = json_decode($row['display_meta']);
  $json->form_type = $form_type;
  $updData = json_encode($json);
  $sql = "update ".$table." set display_meta = '".$updData."' where form_id=".$form_id;
}

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