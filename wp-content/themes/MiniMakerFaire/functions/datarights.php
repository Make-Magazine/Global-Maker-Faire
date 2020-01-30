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
?>