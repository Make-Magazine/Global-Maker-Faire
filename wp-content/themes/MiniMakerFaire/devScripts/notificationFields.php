<?php
include 'db_connect.php';

$table = (isset($_GET['blog_id'])?'wp_'.$_GET['blog_id'].'_gf_form_meta':'wp_gf_form_meta');
$sql = 'select display_meta, notifications from '.$table;
if(isset($_GET['formID'])) $sql.= ' and form_id='.$_GET['formID'];

$mysqli->query("SET NAMES 'utf8'");
$result = $mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
?>
<!doctype html>

<html lang="en">
<head>

<style>

  .detailRow {
    font-size: 1.2em;
    border: 1px solid #98bf21;
  }
  .detailRow div {
    border-right: 1px solid #98bf21;
    padding: 3px 7px;
    background-color: cornsilk;
  }
  .detailRow div:last-child {
    border-right: none;
  }
  .row-eq-height {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
  }
  .header {
    font-weight: bold;
  }
</style>
<link rel='stylesheet' id='make-bootstrap-css'  href='http://makerfaire.com/wp-content/themes/makerfaire/css/bootstrap.min.css' type='text/css' media='all' />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<body>
  <div style="text-align: center">
    <h2> MakerFaire Form Notifications </h2>
    <small>
      To display forms for a certain Mini Makerfaire: add ?blog_id=<i>id#</i> to the end of the url<br/>
      ie: global.makerfaire.com/wp-content/themes/MiniMakerFaire/devScripts/formFields.php?blog_id=4<br/>
      <?php
      $blogSql = 'SELECT blog_id,domain FROM `wp_blogs`';
      $blogresult = $mysqli->query($blogSql) or trigger_error($mysqli->error."[$sql]");
      while ( $blogrow = $blogresult->fetch_array(MYSQLI_ASSOC) ) {
        echo $blogrow['blog_id'].' - '.$blogrow['domain'].', ';
      }?>
   </small>
  </div>
  <div class="clear"></div>
  <div class="container" style="width:95%">
    <?php
    // Loop through the posts
    while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
      $json = json_decode($row['display_meta']);
      echo '<h2>Form '.$json->id.' - '.$json->title.'</h2>';
      ?>

      <?php
      $notifications = json_decode($row['notifications']);

      foreach($notifications as $notification){
          ?>
          <div class="row detailRow row-eq-height">
            <div class="col-sm-4 header">Notification Name:</div>
            <div class="col-sm-8">
              <?php echo $notification->name;?>
            </div>
          </div>
          <div class="row detailRow row-eq-height">
            <div class="col-sm-4 header">Active:</div>
            <div class="col-sm-8">
              <?php echo ($notification->isActive?'Active':'Not-Active');?>
            </div>
          </div>
          <div class="row detailRow row-eq-height">
            <div class="col-sm-4 header">Event</div>
            <div class="col-sm-8">
              <?php echo $notification->event; ?>
            </div>
          </div>
          <div class="row detailRow row-eq-height">
            <div class="col-sm-4 header">To/To Type/BCC</div>
            <div class="col-sm-8">
              <?php echo $notification->to.'<br/>'.$notification->toType.'<br/>'.$notification->bcc;?>
            </div>
          </div>
          <div class="row detailRow row-eq-height">
            <div class="col-sm-4 header">From Email/From Name</div>
            <div class="col-sm-8">
              <?php echo $notification->from.'<br/>'.$notification->fromName;?>
            </div>
          </div>
          <div class="row detailRow row-eq-height">
            <div class="col-sm-4 header">Subject</div>
            <div class="col-sm-8">
              <?php echo $notification->subject; ?>
            </div>
          </div>
          <div class="row detailRow row-eq-height">
            <div class="col-sm-4 header">Message</div>
            <div class="col-sm-8">
              <?php echo $notification->message; ?>
            </div>
          </div>
          <div class="row detailRow row-eq-height">
            <div class="col-sm-4 header">Conditional Logic</div>
            <div class="col-sm-8">
              <?php
              if($notification->conditionalLogic!=''){
                if(is_array($notification->conditionalLogic->rules)){
                  foreach($notification->conditionalLogic->rules as $rule){

                    echo $rule->fieldId.' ';
                    echo $rule->operator.' ';
                    echo $rule->value.'<br/>';
                  }
                }
              }?>
            </div>
            <!--
            <div class="col-sm-3">
              <?php/*
              if($field['type']=='checkbox'||$field['type']=='radio'||$field['type']=='select' ||$field['type']=='address'){
                echo '<ul>';
                if(isset($field['inputs']) && !empty($field['inputs'])){
                  foreach($field['inputs'] as $choice){
                    echo '<li>'.$choice->id.' : '.$choice->label.'</li>';
                  }
                }else{
                  foreach($field['choices'] as $choice){
                    echo '<li>'.($choice->value!=$choice->text?$choice->value.'-'.$choice->text:$choice->text).'</li>';
                  }
                }
                echo '</ul>';
              }*/
              ?>
            </div>-->
          </div><br/><br/>
          <?php
      }
    }
    ?>
  </div>
</body>
</html>
<?php
function cmp($a, $b) {
    return $a["id"] - $b["id"];
}

