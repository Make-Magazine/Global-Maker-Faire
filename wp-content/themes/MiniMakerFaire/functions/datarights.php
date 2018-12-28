<?php

/**
 * Returns the display response based on the type and the message.
 *
 * @param string $type
 *           if the response was successful or not
 * @param string $message
 *           the message to display
 */
function page_datarights_form_generate_response($type, $message) {
   global $response;

   if ($type == "success") {
      $response = "<div class='success'><div class='icon-block'><i class='fa fa-check-circle'></i> Got it!</div>{$message}</div>";
   } else {
      $response = "<div class='error'><div class='icon-block'><i class='fa fa-exclamation-circle'></i> {$message}</div></div>";
   }
}

/**
 * Outputs localized string if polylang exists or  output's not translated one as a fallback
 *
 * @param $string
 *
 * @return  void
 */
function pl_e($string = '') {
   if (function_exists('pll_e')) {
      pll_e($string);
   } else {
      echo $string;
   }
}

/**
 * Returns translated string if polylang exists or  output's not translated one as a fallback
 *
 * @param $string
 *
 * @return string
 */
function pl__($string = '') {
   if (function_exists('pll__')) {
      return pll__($string);
   }

   return $string;
}

/*
 * Add string translations to polylang
 */

function data_rights_after_setup_theme() {
   // register our translatable strings - again first check if function exists.
   if (function_exists('pll_register_string')) {
      pll_register_string('datarights', 'Please supply all information.', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Sorry, this email address is invalid.', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Sorry, your message could not be sent. Please try again in a few minutes.', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Thanks for contacting us! We have received your request and will get in touch with you shortly.', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Someone requested GDPR data from ', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'The user with an email of ', 'MiniMakerFaire', false);
      pll_register_string('datarights', " has requested an export of their personal saved data in our database.", 'MiniMakerFaire', false);
      pll_register_string('datarights', " has requested that their personal data be removed from our database.", 'MiniMakerFaire', false);
      pll_register_string('datarights', 'If you have an account on this site, or submitted an entry to our Call for Makers form, you can request to receive an exported file of the personal data we hold about you, including any data you have provide to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.', 'MiniMakerFaire', true);
      pll_register_string('datarights', 'Personal Data Request', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Please use this form to request Personal Data export/erasure.', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Select Your Request', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Export Personal Data', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Remove Personal Data', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Email Address', 'MiniMakerFaire', false);
      pll_register_string('datarights', 'Submit Request', 'MiniMakerFaire', false);
   }
}

add_action('after_setup_theme', 'data_rights_after_setup_theme');
?>