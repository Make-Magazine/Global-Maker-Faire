<?php
include '../../../../wp-load.php';
/*
 * This script is used to mass update a field across all Mini Makerfaire sites
 */
$findme='makermedia';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        /* update notifications - replace 'Disable Autoresponder' with 'Disable Notification' */
        global $wpdb;
        $blogSql = "select blog_id, domain from wp_blogs  ORDER BY `wp_blogs`.`blog_id` ASC";
        $results = $wpdb->get_results($blogSql, ARRAY_A);
        foreach ($results as $blogrow) { 
            $blogID = $blogrow['blog_id'];
            if($blogID==1){
              $table  =  'wp_gf_form_meta';
            }else{
              $table  =  'wp_'.$blogID.'_gf_form_meta';
            }

            $formResults = $wpdb->get_results('select display_meta, form_id from '.$table,ARRAY_A);            
            $updArray = array();
            foreach($formResults as $formrow){
                $form_id = $formrow['form_id'];
                $fieldData='';
                $output=true;
                $json = json_decode($formrow['display_meta']);
                $form_type = (isset($json->form_type)?$json->form_type:'');
                if($form_type=='cfm'){                    
                    $updForm = false;
                    foreach($json->fields as &$field){
                        //if($field->id=='513'){                                                 
                            //update label                            
                            
                            $labelpos = strpos((isset($field->label)?$field->label:''), 'Please know that Make:, Maker Faire, and Make: respect ');                            
                            if($labelpos !== false){
                                $field->label = str_replace("Please know that Make:, Maker Faire, and Make: respect ","Please know that Make:, Maker Faire, and Make Community ",$field->label);
                                $updForm = true;
                            }
                            
                            //update description
                            $descpos  = strpos((isset($field->description)?$field->description:''), 'http://makermedia.com/privacy/');     
                            if ($descpos !== false) {
                                $field->description = str_replace('http://makermedia.com/privacy/','https://make.co/terms-and-privacy-policy/#privacy-policy',$field->description);
                                $updForm = true;
                                break;
                            }                                                        
                        //}
                    }
                    //check if we need to update form
                    if ($updForm) {  
                        $updateMeta = json_encode($json);
                        $updArray[] = array('form_id'=> $form_id, 'display_meta'=>$updateMeta);                                                        
                    }                    
                }
            } //end loop thru forms
            if(!empty($updArray)){
                foreach($updArray as $update){
                    echo 'Updating Blog '.$blogID.' form ID = '.$update['form_id'].'<br/>';
                    $wpdb->update( $table, array('display_meta'=>$update['display_meta']), array('form_id' => $update['form_id']));                 
                }
            }
        }
        ?>
    </body>
</html>