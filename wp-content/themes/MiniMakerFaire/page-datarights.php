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
	<h1 class="page-title"><?php echo get_the_title(); ?></h1>
<?php
   // response generation function
   $response = "";
   $display_form = 1;
   
   // response messages
   $not_human = __("Human verification incorrect.", 'MiniMakerFaire');
   $missing_content = __("Please supply all information.", 'MiniMakerFaire');
   $email_invalid = __("Email Address Invalid.", 'MiniMakerFaire');
   $message_unsent = __("Message was not sent. Try Again.", 'MiniMakerFaire');
   $message_sent = __("Thanks! Your message has been sent.", 'MiniMakerFaire');
   
   // user posted variables
   $email = (isset($_POST['message_email']) ? $_POST['message_email'] : '');
   $request = (isset($_POST['message_request']) ? $_POST['message_request'] : '');
   
   // php mailer variables
   $subject = __("Someone requested GDPR data from ", 'MiniMakerFaire') . get_bloginfo('name');
   $headers = __("From: ", 'MiniMakerFaire') . $email . "\r\n" . __('Reply-To: ', 'MiniMakerFaire') . $email . "\r\n";
   
   if ($request === 'export') {
      $message = "The user with an email of $email has requested an export of their personal saved data in our database.";
   } else {
      $message = "The user with an email of $email has requested that their personal data be removed from our database.";
   }
   
   if (isset($_POST['submitted']) && $_POST['submitted']) {
      // validate email
      if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
         my_contact_form_generate_response("error", $email_invalid);
      } else { // email is valid
         // validate presence of name and message
         if (empty($request) || empty($email)) {
            my_contact_form_generate_response("error", $missing_content);
         } else { // ready to go!
            $sent = wp_mail($contact_form_email_address, $subject, strip_tags($message), $headers);
            if ($sent) {
               my_contact_form_generate_response("success", $message_sent); // message sent!
               $display_form = 0;
            } else {
               page_datarights_form_generate_response("error", $message_unsent); // message wasn't sent
            }
         }
      }
   }
   echo $response;
   if ($display_form) {
      ?>
	<div class="row">
		<p><?php echo the_content();?></p>
		<h3>Your Data Rights</h3>
		<p>If you have an account on this site, or submitted an entry to our Call for Makers form, you can request to receive an exported file of the personal data we hold about you, including any data you have provide to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>
		<h3>Personal Data Request:</h3>
		<div>Please use this form to request Personal Data export/erasure.</div>
		<h4>
			Select Your Request<span>*</span>
		</h4>
		<div id="respond">
			<form action="<?php the_permalink(); ?>" method="post">
				<!--  <form action="data_rights" method="post">-->
				<div class="form-group">
					<input type="radio" name="message_request" value="export" checked>Export
					Personal Data 
					<input type="radio" name="message_request"
						value="remove">Remove Personal Data
				</div>
				<div class="form-group">
					<h4>
						Email Address<span>*</span>
					</h4>
					<input type="text" class="form-control" name="message_email">
				</div>
				<input type="hidden" name="submitted" value="1">
				<p>
					<input class="btn btn-primary" type="submit" value="Submit Request">
				</p>
			</form>
		</div>		
		<?php } // End Display Form ?>
	</div>

</div>

<?php } else { echo "No Admin email was found.  This should never happen on an active site. <br>"; } ?>
<?php  get_footer(); ?>