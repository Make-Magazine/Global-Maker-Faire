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
      $response = "<div class='success'>{$message}</div>";
   } else {
      $response = "<div class='error'><b>{$message}</b></div>";
   }
   
}
?>