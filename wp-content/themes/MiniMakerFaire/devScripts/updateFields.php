<?php
include '../../../../wp-load.php';
/*
 * This script is used to mass update a field across all Mini Makerfaire sites
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        $lockedValues = array("Disable Notification", "Make: Magazine Review", "Featured Maker", "Disable Autoresponder", "Reprint Sign");

        /* update field 376 in CFM forms
         * replace 'Makermedia' with Make: Community'
         * 
         * notifications - replace 'Disable Autoresponder' with 'Disable Notification' */
        global $wpdb;
        $blogSql = 'SELECT blog_id,domain FROM `wp_blogs`';
        $results = $wpdb->get_results($blogSql, ARRAY_A);
        foreach ($results as $blogrow) {
            echo $blogrow['blog_id'] . ' - ' . $blogrow['domain'] . '<br/>';

            $blogID = $blogrow['blog_id'];
            $wpdb->blogid = $blogID;
            $wpdb->set_prefix($wpdb->base_prefix);

            $forms = GFAPI::get_forms();
            foreach ($forms as $form) {
                echo 'Form =' . $form['title'] . '<br/>';
                $updForm = false;
                foreach ($form['fields'] as &$field) {
                    if ($field["id"] == 376) {
                        //set field inputs
                        $lockedInputs = array(
                            array("label" => "Disable Notification", "id" => "304.1"),
                            array("label" => "Make: Magazine Review", "id" => "304.2"),
                            array("label" => "Featured Maker", "id" => "304.3"),
                        );
                        //set field choices
                        $lockedChoices = array(
                            array("text" => "Disable Notification", "value" => "Disable Notification"),
                            array("text" => "Make: Magazine Review", "value" => "Make: Magazine Review"),
                            array("text" => "Featured Maker", "value" => "Featured Maker")
                        );
                        $input_id = 304.4;
                        //now let's loop thru the inputs and add to the bottom if they aren't already one of the locked fields
                        foreach ($field['inputs'] as $input) {
                            //do not add back in the locked values if they are already there
                            if (!in_array($input['label'], $lockedValues)) {
                                echo 'adding ' . $input['label'] . '<br/>';
                                $lockedInputs[] = array('label' => $input['label'], 'id' => "{$field_id}.$input_id");
                                $input_id++;
                            }
                        }
                        $field['inputs'] = $lockedInputs;
                        $updForm = true;

                        foreach ($field['choices'] as $choice) {
                            if (!in_array($choice['text'], $lockedValues)) {
                                $lockedChoices[] = $choice;
                            }
                        }
                        $field['choices'] = $lockedChoices;
                        $updForm = true;
                    } //end 376 field check
                } //end form field loop
                $updForm = false;
                //check if we need to update form
                if ($updForm) {
                    echo 'begin update<br/>';
                    //update notification
                    $updresult = GFAPI::update_form($form);
                    if (!$updresult) {
                        echo 'error updating Form - ' . $copyForm . '<br/>';
                        var_dump($updresult);
                    } else {
                        echo 'Form - ' . $copyForm . ' Updated<br/>';
                    }
                } else {
                    echo 'no update<br/>';
                }
                echo '<br/><br/>';
            } //end loop thru forms
        }
        ?>
    </body>
</html>