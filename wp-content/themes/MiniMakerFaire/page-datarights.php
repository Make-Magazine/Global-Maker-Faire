<?php
/*
 * Template name: DataRights
 */
get_header();
?>
<?php

$contact_form_email_address = get_field("contact_form_email_address");
if (trim($contact_form_email_address) === '') {
   // Use my email for testing
   $contact_form_email_address = get_option('admin_email');
}

if ($contact_form_email_address) {
   ?>
<div class="container">
<div class="row">
   <div class="col-sm-12">
      <h1 class="page-title"><?php echo get_the_title(); ?></h1>
   </div>
</div>
<?php
   // response generation function
   $response = "";
   $display_form = 1;

   // function to generate response
   function my_contact_form_generate_response($type, $message) {
      global $response;
      
      if ($type == "success") {
         $response = "<div class='success'>{$message}</div>";
      } else {
         $response = "<div class='error'>{$message}</div>";
      }
      unset($_POST['submitted']);
      
   }
   
   // response messages
   $not_human = __("Human verification incorrect.", 'MiniMakerFaire');
   $missing_content = __("Please supply all information.", 'MiniMakerFaire');
   $email_invalid = __("Email Address Invalid.", 'MiniMakerFaire');
   $message_unsent = __("Message was not sent. Try Again.", 'MiniMakerFaire');
   $message_sent = __("Thanks! Your message has been sent.", 'MiniMakerFaire');
   
   // user posted variables
   $email = (isset($_POST['message_email']) ? $_POST['message_email'] : '');
   $request = (isset($_POST['message_request']) ? $_POST['message_request'] : '');
   // Cast to int to ensure the compare works!
   $human = (int) (isset($_POST['message_human']) ? $_POST['message_human'] : '');

   // php mailer variables
   $subject = __("Someone requested GDPR data from ", 'MiniMakerFaire') . get_bloginfo('name');
   $headers = __("From: ", 'MiniMakerFaire') . $email . "\r\n" . __('Reply-To: ', 'MiniMakerFaire') . $email . "\r\n";
   
   if ($request === 'export') {
      $message = "The user with an email of $email has requested an export of their personal saved data in our database.";
   } else {
      $message = "The user with an email of $email has requested that their personal data be removed from our database.";
   }
   
   if (! $human == 0) {
      if ($human !== 2) {
         my_contact_form_generate_response("error", $not_human); // not human!
      } else {
         // validate email
         if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            my_contact_form_generate_response("error", $email_invalid);
         } else { // email is valid
            // validate presence of name and message
            if (empty($request) || empty($message)) {
               $missing_content = $missing_content . (empty($message) ? "Missing Message" : "Missing Request");
               my_contact_form_generate_response("error", $missing_content);
            } else { // ready to go!
               $sent = wp_mail($contact_form_email_address, $subject, strip_tags($message), $headers);
               if ($sent) {
               // echo "Successfully sent email to $contact_form_email_address<br>";
                  my_contact_form_generate_response("success", $message_sent); // message sent!
                  $display_form = 0;
               } else {
                  my_contact_form_generate_response("error", $message_unsent); // message wasn't sent
               }
            }
         }
      }
   } else if (isset($_POST['submitted']) && $_POST['submitted']) {
      my_contact_form_generate_response("error", $missing_content);
   } 
   echo $response;
   if ($display_form) { ?>
	<div class="row">
      <div class="col-sm-12">
         <p><?php echo the_content();?></p>
         <!-- <h3>Admin Email: <?php  echo $contact_form_email_address;?></h3> -->
         <!-- <h3>Your Data Rights</h3> -->
         <p>If you have an account on this site, or submitted entry to our Call
            for Makers form, you can request to receive an exported file of the
            personal data we hold about you, including any data you have provide
            to us. You can also request that we erase any personal data we hold
            about you. This does not include any data we are obliged to keep for
            administrative, legal, or security purposes.</p>
         <h3 class="pdr-header">Personal Data Request:</h3>
         <p>Please use this form to request Personal Data export/erasure.</p>
         <h4>Select Your Request<span>*</span></h4>
         <div id="respond">
            <form action="<?php the_permalink(); ?>" method="post">
               <!--  <form action="data_rights" method="post">-->
               <div class="radio">
                  <label>
                     <input type="radio" name="message_request" value="export" checked>
                     Export Personal Data
                  </label>
               </div>
               <div class="radio">
                  <label>
                     <input type="radio" name="message_request" value="remove">
                     Remove Personal Data
                  </label>
               </div>
               <div class="form-group">
                  <h4>Email Address<span>*</span></h4>
                  <label class="sr-only sr-only-focusable" for="message_email">Email Address</label>
                  <input type="email" class="form-control email-input" name="message_email">
               </div>
               <div class="form-group">
                  <label for="message_human" class="message-human"><?php _e("Human Verification",'MiniMakerFaire')?> <span>*</span>
                     <div><input type="number" class="form-control" name="message_human"> + 4 = 6</div>
                  </label>
               </div>
               <input type="hidden" name="submitted" value="1">
               <div class="form-group">
                  <input class="btn btn-primary btn-submit" type="submit" value="Submit Request">
               </div>
            </form>
         </div>
      </div>
		
		<?php } // End Display Form ?>
	</div>

</div>

<?php } else { echo "No Contact Admin email was found.  This should never happen on an active site. <br>"; } ?>
<?php  get_footer(); ?>