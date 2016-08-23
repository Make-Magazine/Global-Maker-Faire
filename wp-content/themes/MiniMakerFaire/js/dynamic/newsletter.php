<?php
header('Content-type: text/javascript');


$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
$webapioptions = get_site_option('gravityformsaddon_gravityformswebapi_settings', array() );
echo '<!-- '.print_r($webapioptions,true).' -->';
// Setup the API variables required for posting emails
//set API keys
$api_key = rgar( $webapioptions, 'public_key' );
$private_key = rgar( $webapioptions, 'private_key' );
$form_id = RGFormsModel::get_form_id('Email List: Newsletter Subscribers');

function calculate_signature($string, $private_key) {
  $hash = hash_hmac('sha1', $string, $private_key, true);
  $sig = rawurlencode(base64_encode($hash));
  return $sig;
}

//set route
$route = 'entries';

//creating request URL
$expires = strtotime('+60 mins');
$string_to_sign = sprintf('%s:%s:%s:%s', $api_key, 'POST', $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);
$gf_api_url = '/gravityformsapi/' . $route . '?api_key=' . $api_key . '&signature=' . $sig . '&expires=' . $expires;
?>

function globalNewsletterSignup(email) {
var inputValues = {
  form_id: <?= $form_id ?>,
  date_created: '<?= date('Y-m-d H:i:s'); ?>',
  is_starred: 0,
  is_read: 1,
  ip: '::1',
  source_url: '<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>',
  currency: 'USD',
  created_by: 1,
  user_agent: 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0',
  status: 'active',
  1: email
};

var data = {inputValues};
console.log(JSON.stringify(data));
jQuery.ajax({
    url: '<?= $gf_api_url ?>',
    type: 'POST',
    data: JSON.stringify(data)
  })
  .done(function( data ) {
    if ( console && console.log ) {
      console.log( "Sample of data:", data );
      console.log( "Input Values:", inputValues );
    }
  });
}