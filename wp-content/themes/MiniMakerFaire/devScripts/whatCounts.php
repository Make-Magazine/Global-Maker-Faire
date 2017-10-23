<?php
/*
 * devScript to test what counts api calls
 */
//include '../../../../wp-load.php';

error_reporting(E_ALL); ini_set('display_errors', 1);
//Test adding subscriber to whatcounts
  $url = "http://api.whatcounts.com/rest/subscriptions";
  $data = array(
      'subscriberId'  => 6524,
      "listId"        => 81,
      "formatId"      => 1  //[0,1,99], where 0=plain text, 1=html, and 99=MIME
  );
  var_dump(json_encode($data));
  $result = call_whatCounts($data,$url, 'POST');

  //errror?
  if(isset($result['statusCode'])){
    //write to error log
    echo 'WhatCounts API: error with adding to faire_to_Subscriber table';
    var_dump( $result);
  }

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
