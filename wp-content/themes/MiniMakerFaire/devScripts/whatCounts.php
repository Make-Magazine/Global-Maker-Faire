<?php
/*
 * devScript to test what counts api calls
 */
//include '../../../../wp-load.php';

error_reporting(E_ALL); ini_set('display_errors', 1);
//Test check if email is in list 81
$email = 'jennyravens1@yahoo.com';
$url = "http://api.whatcounts.com/rest/lists/81/subscribers?email=".$email;
$data      = array();
$result    = call_whatCounts($data, $url, 'GET');
var_dump( $result);
if(empty($result)){
  echo $email.'not in list 81';
}else{
  echo $email.' already in list';
}


//Test adding subscriber to whatcounts
/*
$subArray = array(379816,1278237,298161,1278101,685248,1278145,1278138,1278239,1278114,947734,1200634,150109,1278146,1278127,1278238,131178,1278099,372966,372968,1278098,1278102,132149,1278139,1055795,1278242,411420,1278240,562807,1278124,1278126,1278100,373211,1278096,66648);
  $url = "http://api.whatcounts.com/rest/subscriptions";
  foreach($subArray as $subscriberId){
    $data = array(
        'subscriberId'  => (int) $subscriberId,
        "listId"        => 81,
        "formatId"      => 0  //[0,1,99], where 0=plain text, 1=html, and 99=MIME
    );
    //var_dump(json_encode($data));
    $result = call_whatCounts($data,$url, 'POST');

    //errror?
    if(isset($result['statusCode'])){
      //write to error log
      echo 'WhatCounts API: error with adding to faire_to_Subscriber table';
      var_dump( $result);
    }
  }*/

  function call_whatCounts($data,$url,$curlType='POST'){
  echo 'Rest call to '.$url.'<Br/>';
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
  if(isset($returnedData['statusCode'])){
    var_dump($returnedData);
    echo 'There was an error in the call to '.$url.'<br/>';
    echo 'Status Code: '. $returnedData['statusCode'].'<br/>';
    echo 'Status: '.      $returnedData['status'].'<br/>';
    echo 'Error: '.       $returnedData['error'].'<br/>';
  }
  return $returnedData;
}
