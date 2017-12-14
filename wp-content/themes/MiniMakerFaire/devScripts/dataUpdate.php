<?php
include '../../../../wp-load.php';
echo 'Begin Data update<br/>';
/*
 * update various forms and fields for data integrity
 */
$gfLockedFields = str_replace(' ', '', get_site_option( 'gf-locked-fields' )); //remove extra spaces
$lockedFields = explode(',',$gfLockedFields);
$blogFormArr = array(
    array('blogID' => 58, 'formID' => 7),
    array('blogID' => 111, 'formID' => 13),
    array('blogID' => 233, 'formID' => 13),
array('blogID' => 233, 'formID' => 14),
array('blogID' => 233, 'formID' => 15),
array('blogID' => 233, 'formID' => 16),
array('blogID' => 233, 'formID' => 17),
array('blogID' => 233, 'formID' => 18),
);
/*
  $blogFormArr = array(
  array('blogID' => 224, 'formID' => 5),
  array('blogID' => 224, 'formID' => 6),
  array('blogID' => 46, 'formID' => 5),
  array('blogID' => 77, 'formID' => 9),
  array('blogID' => 94, 'formID' => 7),
  array('blogID' => 113, 'formID' => 4),
  array('blogID' => 227, 'formID' => 4)
);
*/

$lockOptVal = array(303, 304);
$lockOptAll = array(105, 310, 311, 312, 313, 314, 315, 316);

//pull in the master CFM form - master.makerfaire.com (blog id = 6) form 1
$sql          = 'select display_meta from wp_6_rg_form_meta  where form_id=1';
$masterJSON   = $wpdb->get_var($sql);
$masterForm   = json_decode($masterJSON);
$masterFields = (array) $masterForm->fields;

$mastFldArr   = array();
//build master field array
foreach($masterFields as $field){
  if(in_array($field->id, $lockedFields)){
    $mastFldArr[$field->id] = $field;
  }
}

//var_dump($mastFldArr);
//pull form for each blog in the $blogFormArr array
foreach($blogFormArr as $data){
  $blogID = $data['blogID'];
  $formID = $data['formID'];

  $Blogsql  = 'select display_meta from wp_'.$blogID.'_rg_form_meta  where form_id='.$formID;

  $compJSON   = $wpdb->get_var($Blogsql);
  $compForm   = json_decode($compJSON);
  $compFields = (array) $compForm->fields;

  $compFldArr = array();
  $updateForm = false;
  //loop thru the fields in the compare form
  foreach($compFields as $compKey => $compField) {
    $lockID = $compField->id;
    //if the field is in the locked fields list, then we need to validate the data
    if(in_array($compField->id, $lockedFields)){
      $compFldArr[] = (string) $compField->id;
      $mastField = $mastFldArr[$compField->id]; //set the master field for comparison
      /*
       * if the field type does not match, there is a huge error.
       * Stop processing
       */
      if($mastField->type != $compField->type && $compField->type!='hidden'){
        echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
        echo 'Field - '.$compField->id.'. Error - Field Type different. '.
             'Master - ' . $mastField->type.'. '.
             'Compare - '. $compField->type.'<br/>';
      }else{

      // validate required field checkbox
      if($mastField->isRequired != $compField->isRequired){
        echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
        echo 'Field - '.$compField->id.'. Error - Check Required different. '.
                'Master - ' . ($mastField->isRequired===TRUE?'True':'False').'. '.
                'Compare - '. ($compField->isRequired===TRUE?'True':'False').'<br/>';
        //update required checkbox of field to master value
        $compFields[$compKey]->isRequired = $mastField->isRequired;
        $updateForm = true;
      }
      // validate field visibility
      if($mastField->visibility != $compField->visibility){
        echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
        echo 'Field - '.$compField->id.'. Error -  Visibility different. Master - '.$mastField->visibility.'. Compare - '. $compField->visibility.'<br/>';
        //update visibility of field to master value
        $compFields[$compKey]->visibility = $mastField->visibility;
        $updateForm = true;
      }

      /*  Field Options */

      //lock all options - no translate or additions allowed
      if(in_array($lockID, $lockOptAll)){
        if($mastField->choices != $compField->choices){
          echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
          echo 'Field - '.$compField->id.'. Error - update field choices<br/>';
          $compFields[$compKey]->choices = $mastField->choices;
          $updateForm = true;
        }
        if($mastField->inputs != $compField->inputs){
          echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
          echo 'Field - '.$compField->id.'. Error - update field inputs<br/>';
          $compFields[$compKey]->inputs = $mastField->inputs;
          $updateForm = true;
        }
      }

      //lock values only on first options
      if(in_array($lockID, $lockOptVal)){
        //choices??
        if($mastField->choices != $compField->choices){
          foreach($mastField->choices as $choiceKey=>$choice){
            if($choice->value != $compField->choices[$choiceKey]->value) {
              echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
              echo 'Field - '.$compField->id.'. Error - Choice Value different. Master - '.$choice->value.'. Compare - '.$compField->choices[$choiceKey]->value.'<br/>';
              //update compField
              $compFields[$compKey]->choices[$choiceKey]->value = $choice->value;
              $updateForm = true;
            }
          }
        }

        //inputs??
        if($mastField->inputs != $compField->inputs){
          foreach($mastField->inputs as $inputKey=>$input){
            if($input->label != $compField->inputs[$inputKey]->label) {
              echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
              echo 'Field - '.$compField->id.'. Error - Input Value different. Master - '. $input->label.'. Compare - '. $compField->inputs[$inputKey]->label.'<br/>';
              //update compField
              $compFields[$compKey]->inputs[$inputKey]->label = $input->label;
              $updateForm = true;
            }
          }
        }
      }
      } //end check field type
    }
  }

  //compare the list of field id's updated to the list of locked fields
  // if one is missing we need to add it to the fields in $compForm
  $missingFields=array_diff($lockedFields,$compFldArr);

  foreach($missingFields as $missingField){
    $mastField = $mastFldArr[$missingField];
    echo '$blogID - '.$blogID.'. $formID - '.$formID.'. ';
    echo 'Field - '.$missingField.'. Error - missing<br/>';
    $compFields[] = $mastField;
    $updateForm = true;
  }

  if($updateForm){
    echo 'updating $blogID - '.$blogID.'. $formID - '.$formID.'.<br/>';
    //var_dump($compFields);
    //die();
    //json encode
    $compForm->fields = $compFields;
    $updForm = json_encode($compForm);

    //run sql to update form
    $meta_table_name = 'wp_'.$blogID.'_rg_form_meta';
    $meta_name = 'display_meta';
    $result = $wpdb->query( $wpdb->prepare( "UPDATE $meta_table_name SET $meta_name=%s WHERE form_id=%d", $updForm, $formID ) );

  }
}
echo 'End Data update';