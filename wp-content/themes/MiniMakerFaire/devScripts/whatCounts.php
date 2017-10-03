<?php
/*
 * devScript to add Faire makers to a whatCounts list
 * first name, last name, email address, Faire of participation, year of participation
 * List ID:                 81
 * First Name:              firstName
 * Last Name:               lastName
 * email address:           email
 *
 * Custom Data:
 * Type:                    faire_type
 *          ??????? 1 = US 2= International (Based on Timezone??)
 * Faire of participation:  host?? domain name sandiego.makerfaire.com
 * year of participation:   faire_year
 * Attendee or Maker:       mf_role(number??)
 *
 * URIs for the REST API have the following basic structure:
 *      http://[siteURL]/rest/[resourceName]
 *      Where [siteURL] is the domain of your email platform, and [resourceName] is the name of the feature to use.
 *      URI example -
 *
 * Create Subscription:
 *  POST
 *  URL = http://api.whatcounts.com/rest/subscribers

 * --url 'https://mail.mydomain.com/rest/subscribers' \
    --header 'authorization: Basic bWFrZXJtZWRpYTpsaWFibGVhYjM2NzU=' \
 * makermedia:liableab3675 base64 encoded to -> bWFrZXJtZWRpYTpsaWFibGVhYjM2NzU=
    --header 'content-type: application/json' \
    --header 'accept: application/vnd.whatcounts-v1+json' \
 * subscribe parameters:
 *
 * r=myrealm&p=mypass&c=sub&list_id=5&format=1&data=email,first^jane@domain.com,Jane
 * http://api.whatcounts.com/bin/api_web?cmd=show_lists&r=makermedia&p=liableab3675
 */

error_reporting(E_ALL); ini_set('display_errors', 1);

$email      = 'alicia123@makermedia.com';
$firstName  = "Alicia";
$lastName   = "Williams";
$listID     = 81;
$data       = array();

//First check if this email is already a subscriber in whatcounts
$url = 'https://api.whatcounts.net/rest/subscribers?email='.$email;
//$url = 'https://api.whatcounts.net/rest/lists';
$result = call_whatCounts($data,$url, 'GET');
if(!empty($result)){
if(isset($result[0]['subscriberId'])){
  $subscriberID = $result[0]['subscriberId'];
}
}else{
  echo 'no user found';
  //If subscriber not found, add it
  $url = "https://api.whatcounts.net/rest/subscribers";
  $data = array(
      'email'     => 'alicia123@makemedia.com',
      "firstName" => "Alicia",
      "lastName"  => "Williams",
  );
  $result = call_whatCounts($data,$url);
var_dump($result);
  //add subscriber to email list
  $subscriberID = $result['subscriberId'];
}


//create subscription to list
$url = "http://api.whatcounts.com/rest/subscriptions";
$data = array(
    'subscriberId'     => $subscriberID,
    "listId" => 81,
    "formatId"  => 1  //[0,1,99], where 0=plain text, 1=html, and 99=MIME
);
$result = call_whatCounts($data,$url);


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
    /*
    $info = curl_getinfo($ch);

    if ($result === false || $info['http_code'] != 200) {
      $output = "No cURL data returned for $url [". $info['http_code']. "]";
      if (curl_error($ch))
        $output .= "\n". curl_error($ch);
      echo $output;
    } else {*/
      if(isset($returnedData->statusCode)){
        //error occured
        echo 'There was an error in the call to '.$url.'<br/><br/>';
        echo 'Status Code: '. $returnedData->statusCode.'<br/>';
        echo 'Status: '.      $returnedData->status.'<br/>';
        echo 'Error: '.       $returnedData->error.'<br/>';
      }
      return $returnedData;
    //}
}