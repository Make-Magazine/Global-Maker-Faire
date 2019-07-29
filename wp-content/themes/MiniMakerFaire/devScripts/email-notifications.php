<?php
include 'db_connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$blogSql = "select blog_id, domain from wp_blogs  ORDER BY `wp_blogs`.`blog_id` ASC";

$results = $wpdb->get_results($blogSql, ARRAY_A);
$showOnly = (isset($_GET['show']) ? $_GET['show'] : '');

$blogArray = array();
//loop thru blogs
foreach ($results as $blogrow) {
    $blogID = $blogrow['blog_id'];
    if ($blogID == 1) {
        $table = 'wp_gf_form_meta';
    } else {
        $table = 'wp_' . $blogID . '_gf_form_meta';
    }

    $formResults = $wpdb->get_results('select display_meta, notifications, form_id from ' . $table, ARRAY_A);

    $formArray = array();
    foreach ($formResults as $formrow) {
        $form_id = $formrow['form_id'];
        $json = json_decode($formrow['display_meta']);

        $formArray[] = array(
            'form_id' => $form_id,
            'form_type' => (isset($json->form_type) ? $json->form_type : ''),
            'form_name' => $json->title,
            'is_active' => (isset($json->is_active) ? $json->is_active : 2),
            'notifications' => $formrow['notifications']
        );
    }
    $blogArray[] = array(
        'blog_id' => $blogID,
        'blog_name' => $blogrow['domain'],
        'forms' => $formArray
    );
}
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
            <h2> Gravity Form - Form Notifications </h2>                   
        </div>
        <div class="clear"></div>
        <div class="container" style="width:95%">
            <?php
            //loop thru blogs
            foreach ($blogArray as $blog) {
                $admin_email = get_blog_option($blog['blog_id'], 'admin_email');
                if ($showOnly != '') {
                    //exclude sites who's admin email does not contain the show only variable
                    $pos1 = stripos($admin_email, $showOnly);

                    // Is string found in the admin email?
                    if ($pos1 === false) {
                        continue; //no, skip to next record
                    }
                }
                echo '<h2>' . $blog['blog_name'] . '(' . $blog['blog_id'] . ')' . '</h2>';
                echo '<h3>Site Admin Email - ' . $admin_email . '</h3>';
                echo
                '<table  border="1" width="100%">
                    <tr>
                        <td colspan="4">Form information</td>
                        <td colspan="8">Notification information</td>
                    </tr>
                    <tr><td>ID</td>
                        <td>Name</td>
                        <td>Type</td>
                        <td>Active/Inactive</td>
                        <td>Notification Name</td>
                        <td>Active</td>
                        <td>To</td>
                        <td>BCC</td>
                        <td>Subject</td>
                        <td>From</td>
                        <td>From Name</td>
                        <td>Reply to</td>
                    </tr>';

                $forms = $blog['forms'];

                foreach ($forms as $formData) {
                    $notifications = json_decode($formData['notifications']);

                    foreach ($notifications as $notification) {

                        if ($showOnly != '') {
                            //exclude sites who's to, bcc, or from email email does not contain the show only variable
                            $to_email = (isset($notification->to) ? $notification->to : '');
                            $bcc = (isset($notification->bcc) ? $notification->bcc : '');
                            $from_email = (isset($notification->from) ? $notification->from : '');
                            $pos1 = stripos($to_email, $showOnly);
                            $pos2 = stripos($bcc, $showOnly);
                            $pos3 = stripos($from_email, $showOnly);

                            // Is string found in the admin email?
                            if ($pos1 === false && $pos2 === false && $pos3 === false) {
                                continue; //no, skip to next record
                            }
                        }
                        echo '
                            <tr>
                                <td>' . $formData['form_id'] . '</td>
                                <td>' . $formData['form_name'] . '</td>
                                <td>' . $formData['form_type'] . '</td>
                                <td>' . ($formData['is_active'] ? 'Active' : 'Not-Active') . '</td>
                                <td>' . $notification->name . '</td>
                                <td>' . (isset($notification->isActive) ? ($notification->isActive ? 'Active' : 'Not-Active') : '') . '</td>
                                <td>' . (isset($notification->to) ? $notification->to : '') . '</td>
                                <td>' . (isset($notification->bcc) ? $notification->bcc : '') . '</td>
                                <td>' . (isset($notification->subject) ? $notification->subject : '') . '</td>
                                <td>' . (isset($notification->from) ? $notification->from : '') . '</td>
                                <td>' . (isset($notification->fromName) ? $notification->fromName : '') . '</td>
                                <td>' . (isset($notification->replyTo) ? $notification->replyTo : '') . '</td>
                            </tr>';
                    } //end foreach notification
                }
                echo '</table>';
            } //end foreach blog
            ?>            
        </div>
    </body>
</html>
<?php

function cmp($a, $b) {
    return $a["id"] - $b["id"];
}
