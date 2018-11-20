<?php
/*
 * Template name: DataRights
 */
get_header();
?>
<?php

$admin_form_email_address = get_field("admin_form_email_address");
if (trim($admin_form_email_address) === '') {
   // Use my email for testing
   $admin_form_email_address = get_option('admin_email');
}

if ($admin_form_email_address) {
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
   
   // response messages
   $missing_content = __("Please supply all information.", 'MiniMakerFaire');
   $email_invalid = __("Email Address Invalid.", 'MiniMakerFaire');
   $message_unsent = __("Message was not sent. Try Again.", 'MiniMakerFaire');
   $message_sent = __("Thanks! Your message has been sent.", 'MiniMakerFaire');
   
   // user posted variables
   $email = (isset($_POST['message_email']) ? $_POST['message_email'] : '');
   $request = (isset($_POST['message_request']) ? $_POST['message_request'] : '');
   $submitted = (isset($_POST['submitted']) ? $_POST['submitted'] : '');
   
   // php mailer variables
   $subject = __("Someone requested GDPR data from ", 'MiniMakerFaire') . get_bloginfo('name');
   $headers = __("From: ", 'MiniMakerFaire') . $email . "\r\n" . __('Reply-To: ', 'MiniMakerFaire') . $email . "\r\n";
   
   if ($request === 'export')
      $message = "The user with an email of $email has requested an export of their personal saved data in our database.";
   else
      $message = "The user with an email of $email has requested that their personal data be removed from our database.";
   
   if ($submitted == 1) {
      // validate email
      if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
         my_contact_form_generate_response("error", $email_invalid);
      } else { // email is valid
         // validate presence of name and message
         if (empty($request) || empty($email)) {
            page_datarights_form_generate_response("error", $missing_content);
         } else { // ready to go!
            // Send the email using the user emails.  If the email is not recieved, the users email is probably not a real email.
            $sent = wp_mail($admin_form_email_address, $subject, strip_tags($message), $headers);
            if ($sent) {
               page_datarights_form_generate_response("success", $message_sent); // message sent!
               $display_form = 0;
            } else {
               page_datarights_form_generate_response("error", $message_unsent); // message wasn't sent
            }
         }
      }
   }
   
?>
	<div class="row">
		<div class="col-sm-12">
			<p><?php echo the_content();?></p>
			<p>If you have an account on this site, or submitted an entry to our Call for Makers form, you can request to receive an exported file of the personal data we hold about you, including any data you have provide to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>
			<h3 class="pdr-header">Personal Data Request:</h3>
			<?php 
			   echo $response;
			   // Only display the form if it has not been successfully sent
			   if ($display_form) {
			?>
			<p>Please use this form to request Personal Data export/erasure.</p>
			<h4>
				Select Your Request<span>*</span>
			</h4>
			<div id="respond">
				<form action="<?php the_permalink(); ?>" method="post">
					<!--  <form action="data_rights" method="post">-->
					<div class="radio">
						<label> <input type="radio" name="message_request" value="export"
							checked> Export Personal Data
						</label>
					</div>
					<div class="radio">
						<label> <input type="radio" name="message_request" value="remove">
							Remove Personal Data
						</label>
					</div>
					<div class="form-group">
						<h4>
							Email Address<span>*</span>
						</h4>
						<label class="sr-only sr-only-focusable" for="message_email">Email
							Address</label> <input type="email"
							class="form-control email-input" name="message_email">
					</div>
					<input type="hidden" name="submitted" value="1">
					<div class="form-group">
						<input class="btn btn-primary btn-submit" type="submit"
							value="Submit Request">
					</div>
				</form>
			</div>	
			<?php }  // End Display Form ?>
		</div>
	</div>
</div>
<?php
} else { echo "No Admin email was found.  This should never happen on an active site. <br>"; } ?>
<?php  get_footer(); ?>