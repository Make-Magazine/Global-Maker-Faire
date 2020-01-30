<?php
/**
 * Outputs localized string if polylang exists or  output's not translated one as a fallback
 *
 * @param $string
 *
 * @return  void
 */

/*
 * Add string translations to polylang
 */
function polylang_after_setup_theme() {
   // register our translatable strings - again first check if function exists.
   if (function_exists('pll_register_string')) {
      //entry detail
      pll_register_string('EntryDetail', 'Project Website', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'Group', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'Makers', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'Maker', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'LOCATION', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'TIME', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'Categories', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'Exhibits in this group:', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'Part of a group:', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'Look for More Makers', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'View Full Schedule', 'MiniMakerFaire', false);
      pll_register_string('EntryDetail', 'Invalid entry', 'MiniMakerFaire', false);
      
      //data rights
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

add_action('after_setup_theme', 'polylang_after_setup_theme');

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