<?php
/*
 *  This devscript creates a CSV of all fields in all forms across all global sites
 */
include 'db_connect.php';
global $wpdb;
error_reporting(E_ALL); ini_set('display_errors', 1);

//build output data
$blogSql = "select blog_id, domain from wp_blogs  ORDER BY `wp_blogs`.`blog_id` ASC";
$results = $wpdb->get_results($blogSql,ARRAY_A);

$type = filter_input(INPUT_GET, 'type');

$fieldHdrs = array();
$fieldHdrs['blog_id']       = 'Blog ID';
$fieldHdrs['blog_name']     = 'Blog Domain';
$fieldHdrs['form_id']       = 'Form ID';
$fieldHdrs['form_type']     = 'Form Type';
$fieldHdrs['form_name']     = 'Form Title';
$fieldHdrs['date_created']  = 'Date Created';
$fieldHdrs['is_active']     = 'Active';
$fieldHdrs['is_trash']      = 'Trash';

$blogArray = array();
//loop thru blogs
foreach($results as $blogrow){
  $blogID = (int) $blogrow['blog_id'];
  if($blogID==1){
    $table  =  'wp_rg_form_meta';
  }else{
    $table  =  'wp_'.$blogID.'_rg_form_meta';
  }

  $formResults = $wpdb->get_results('select display_meta, form_id from '.$table,ARRAY_A);

  $formArray = array();
  foreach($formResults as $formrow){
    $form_id    = $formrow['form_id'];
    $form       = json_decode($formrow['display_meta']);
    $form_type  = (isset($form->form_type)?$form->form_type:'');
    if(isset($form->is_trash) && !$form->is_trash){
    if($form_type=='cfm'){
      //echo 'Form - '.$form_id.' - ' .$form_type.'<br/>';

      $fieldData = array();
      $jsonArray = (array) $form->fields;
      foreach($jsonArray as &$array){
        $array->id = (float) $array->id;
        $array = (array) $array;
      }

      usort($jsonArray, "cmp");

      // buld table of field data
      foreach($jsonArray as $field){
        if($field['type'] != 'html' && $field['type'] != 'page'){
          $label = (isset($field['adminLabel']) && trim($field['adminLabel']) != '' ? $field['adminLabel'] : $field['label']);
          if($label=='' && $field['type']=='checkbox') $label = $field['choices'][0]->text;

          //field options
          $options = '';
          if($field['type']=='product') {
            if(isset($field['choices'])&&is_array($field['choices'])){
              foreach($field['choices'] as $choice){
                $options .= ($choice->value!=$choice->text?$choice->value.'-'.$choice->text:$choice->text).' : '.$choice->price;
                $options .= "\r";
              }
            }
          }elseif($field['type']=='checkbox'||$field['type']=='radio'||$field['type']=='select' ||$field['type']=='address'){
            if(isset($field['inputs']) && !empty($field['inputs'])){
              foreach($field['inputs'] as $choice){
                $options .= $choice->id.' : '.$choice->label;
                $options .= "\r";
              }
            }else{
              foreach($field['choices'] as $choice){
                $options .= ($choice->value!=$choice->text?$choice->value.'-'.$choice->text:$choice->text);
                $options .= "\r";
              }
            }
          }else{
            $options = '';
          }

          //adminOnly
          $visibility  = (isset($field['visibility'])? $field['visibility']:'');
          $isRequired = (isset($field['isRequired']) && $field['isRequired']?'X':'');
          $isLocked   = (in_array($field['id'],$lockedFields)?'X':'');
          $fieldHdrs[$field['id']] = $field['id'].($isLocked? ' (Locked)':'');
          //for each field, add to array
          $fieldData[$field['id']] = array(
            'fieldID'   =>  $field['id'],
            'label'     =>  $label,
            'type'      =>  $field['type'],
            'options'   =>  $options,
            'visibility' =>  $visibility,
            'required'  =>  $isRequired,
            'locked'    =>  $isLocked
          );
        }
      }

      $formArray[] = array(
        'form_id'       => $form_id,
        'form_type'     => $form_type,
        'form_name'     => $form->title,
        'date_created'  => $form->date_created,
        'is_active'     => $form->is_active,
        'is_trash'      => $form->is_trash,
        'fields'        => $fieldData
      );
    }
    }
  }
  $blogArray[] = array(
    'blog_id'       => $blogID,
    'blog_name'     => $blogrow['domain'],
    'forms'         => $formArray
  );
}


// output headers so that the file is downloaded rather than displayed
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="globalFieldList.csv"');

// do not cache the file
header('Pragma: no-cache');
header('Expires: 0');


// create a file pointer connected to the output stream
$file = fopen('php://output', 'w');

// send the column headers
fputcsv($file, $fieldHdrs);

//loop thru blog data, and write output
foreach($blogArray as $blogData){
  foreach($blogData['forms'] as $form){
    $output=array();
    foreach($fieldHdrs as $key=>$fieldData){
      switch ($key) {
        case 'blog_id':
          $output[] = $blogData['blog_id'];
          break;
        case 'blog_name':
          $output[] = $blogData['blog_name'];
          break;
        case 'form_id':
          $output[] = $form['form_id'];
          break;
        case 'form_type':
          $output[] = $form['form_type'];
          break;
        case 'form_name':
          $output[] = $form['form_name'];
          break;
        case 'date_created':
          $output[] = $form['date_created'];
          break;
        case 'is_active':
          $output[] = $form['is_active'];
          break;
        case 'is_trash':
          $output[] = $form['is_trash'];
          break;
        default:
          if(isset($form['fields'][$key])){
            if($type == 'type'){
               $output[] = $form['fields'][$key]['type'].' - '.$form['fields'][$key]['visibility'];
            }else{
              $output[] = $form['fields'][$key]['type']     . "\r" .
                          $form['fields'][$key]['label']    . "\r" .
                          $form['fields'][$key]['options']  . "\r";
            }
          }else{
            $output[] = '';
          }
      }
    }
    /*
    foreach($form['fields'] as $field){
      $output[] = $field['fieldID'];
      $output[] = $field['label'];
      $output[] = $field['type'];
      $output[] = $field['options'];
      $output[] = $field['adminOnly'];
      $output[] = $field['required'];
      $output[] = $field['locked'];
    }
     */
    fputcsv($file, $output);
  }

}

fclose($file);

//exit();
function cmp($a, $b) {
    return $a["id"] - $b["id"];
}
