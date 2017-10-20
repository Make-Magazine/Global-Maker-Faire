<?php
/*
 * add accepted makers to a whatCounts database
 */

function updateWC($entry, $form){
  //Is this a CFM form?
  if(isset($form['form_type']) && $form['form_type']=='cfm'){
    /*    faire_info - WhatCounts table  */
    $blogID = get_current_blog_id();
    $formID = $entry['form_id'];

    //faire_id       combination blog id and form id
    $faire_id  =  (int) sprintf("%04d", $blogID). sprintf("%04d", $formID);

    // Check if this faire is already in the faire_info table
    $url       = "https://api.whatcounts.net/rest/relationalTables/faire_info/rows/".$faire_id;
    $data      = array();
    $result    = call_whatCounts($data, $url, 'GET');

    //record not found? add it
    if(isset($result['statusCode']) && $result['statusCode']==404){
      //echo 'Adding faire ' .$faire_id.'<br/>';
      $formCreationDate = $form['date_created'];
      $url       = "https://api.whatcounts.net/rest/relationalTables/faire_info/";
      $data      = array(
          'faire_id'            => $faire_id,
          "faire_name"          => get_bloginfo('name'),
          "faire_year"          => '',
          'form_creation_date'  => $formCreationDate);
      $result    = call_whatCounts($data, $url, 'POST');

      //errror?
      if(isset($result['statusCode'])){
        //write to error log
        error_log('WhatCounts API: error with adding to faire_info table');
        error_log( print_r( $result, true ) );
      }
    }


    /*
     * find all first name, last name, email address - contact, maker 1-7
     */
     $typeArr = array(
        array('type' =>  'Contact',  'emailField' => '98',  'nameField' => '96'),
        array('type' =>  'Maker 1',  'emailField' => '161', 'nameField' => '160'),
        array('type' =>  'Maker 2',  'emailField' => '162', 'nameField' => '158'),
        array('type' =>  'Maker 3',  'emailField' => '167', 'nameField' => '155'),
        array('type' =>  'Maker 4',  'emailField' => '166', 'nameField' => '156'),
        array('type' =>  'Maker 5',  'emailField' => '165', 'nameField' => '157'),
        array('type' =>  'Maker 6',  'emailField' => '164', 'nameField' => '159'),
        array('type' =>  'Maker 7',  'emailField' => '163', 'nameField' => '154')
     );
    foreach($typeArr as $data){
      $email      = (isset($entry[$data['emailField']]) ? $entry[$data['emailField']]  : '');
      $firstName  = (isset($entry[$data['nameField'].'.3']) ? $entry[$data['nameField'].'.3']  : '');
      $lastName   = (isset($entry[$data['nameField'].'.6']) ? $entry[$data['nameField'].'.6']  : '');

      /*    Retrieve  subscriber ID from whatCounts   */
      //First check if this email is already a subscriber in whatcounts
      $url = 'https://api.whatcounts.net/rest/subscribers?email='.$email;
      $data   = array();
      $result = call_whatCounts($data,$url, 'GET');
      if(!empty($result)){ //already a subscriber?
        if(isset($result[0]['subscriberId'])){
          $subscriberID = $result[0]['subscriberId'];
        }
      }else{ //no? add them
        //If subscriber not found, add it
        $url = "https://api.whatcounts.net/rest/subscribers";
        $data = array('email' => $email, "firstName" => $firstName, "lastName"  => $lastName);
        $result = call_whatCounts($data, $url);
        $subscriberID = $result['subscriberId'];
      }

      //  WhatCounts - faire to subscriber table
       //build faire_to_subscriber key
      $subscriber_type = '2'; // (maker)
      $entry_id = $entry['id'];
      $ftos = (int) $entry_id;
      // Check if this subscriber is already linked to this faire
      $url       = "https://api.whatcounts.net/rest/relationalTables/faire_to_subscriber/rows/".$ftos;
      $data      = array();
      $result    = call_whatCounts($data, $url, 'GET');

      //record not found? add it
      if(isset($result['statusCode']) && $result['statusCode']==404){
        //echo 'Adding faire to subscriber link ' .$ftos.'<br/>';
        $url       = "https://api.whatcounts.net/rest/relationalTables/faire_to_subscriber/";
        $data      = array( "ftos_id"   => (int) $ftos,
                            "faire_id"  => (int) $faire_id,
                            "subscriber_id"  => (int) $subscriberID,
                            "subscriber_type" => (int) $subscriber_type);
        $result    = call_whatCounts($data, $url, 'POST');

        //errror?
        if(isset($result['statusCode'])){
          //write to error log
          error_log('WhatCounts API: error with adding to faire_to_Subscriber table');
          error_log( print_r( $result, true ) );
        }
      }
    }
  }
}

function call_whatCounts($data,$url,$curlType='POST'){
  //echo 'Rest call to '.$url.'<Br/>';
  $realm = 'makermedia';
  $pwd   = 'liableab3675';

  $headers = array(
      "accept: application/vnd.whatcounts-v1+json",
      "authorization: Basic bWFrZXJtZWRpYTpsaWFibGVhYjM2NzU=",
      "cache-Control: no-cache",
      "content-type: application/json"
  );
  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_SSLVERSION, 6); //tls v1.2
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  if($curlType=='POST'){
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_POST, 1);
  }

  $result = curl_exec($ch);

  // Check for errors and display the error message
  if(curl_errno($ch)){
    echo 'Curl error: ' . curl_error($ch);
  }else{
    $returnedData = json_decode($result, true);

  }
  curl_close($ch);

  //error occured?
  if(isset($returnedData->statusCode)){
    echo 'There was an error in the call to '.$url.'<br/><br/>';
    echo 'Status Code: '. $returnedData->statusCode.'<br/>';
    echo 'Status: '.      $returnedData->status.'<br/>';
    echo 'Error: '.       $returnedData->error.'<br/>';
  }
  return $returnedData;
}

add_action( 'sidebar_entry_update', 'updateWC', 10, 1 );