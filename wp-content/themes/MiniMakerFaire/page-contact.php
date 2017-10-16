<?php
/*
* Template name: Contact
*/
get_header(); ?>

<div class="container contact-page">

<?php
$page_title = get_field( "page_title" );
$contentdecription = get_field( "contentdecription" );

if( $page_title || $contentdecription ) { ?>

  <div class="row">

    <div class="col-xs-12 col-lg-10 col-lg-offset-1 text-center contact-desc">

      <?php if( $page_title ) {
        echo '<h1>' . $page_title . '</h1>';
      }

      if( $contentdecription ) {
        echo $contentdecription;
      } ?>

    </div>

  </div>

<?php }

$contact_address = get_field( "contact_address" );
$phone = get_field( "phone" );
$email = get_field( "email" );

$contact_form_email_address = get_field( "contact_form_email_address" );
if(trim($contact_form_email_address)===''){
  $contact_form_email_address = get_option('admin_email');
}

if( $contact_address || $phone || $email || $contact_form_email_address ) { ?>

  <div class="row contact-info">

    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-lg-offset-1">

      <h3><?php _e('Contact Info','MiniMakerFaire');?></h3>

      <?php if( $contact_address ) {
        echo '<h4>'.__('Address','MiniMakerFaire').':</h4>';
        echo '<div class="contact-info-p">' . $contact_address . '</div>';
      }

      if( $phone ) {
        echo '<h4>'.__('Phone','MiniMakerFaire').':</h4>';
        echo '<div class="contact-info-p">' . $phone . '</div>';
      }

      if( $email ) {
        echo '<h4>'.__('Email','MiniMakerFaire').':</h4>';
        echo '<div class="contact-info-p">' . $email . '</div>';
      }

      $facebook = get_field('facebook');
      $twitter = get_field('twitter');
      $instagram = get_field('instagram');
      $pinterest = get_field('pinterest');
      $googleplus = get_field('googleplus');
      $linked = get_field('linked');


      echo '<div class="social-network-container">
              <ul class="social-network social-circle pull-left">';

                if( $facebook ):
                  echo '<li>
                          <a href="' . $facebook . '" class="icoFacebook" title="Facebook" target="_blank">
                            <i class="fa fa-facebook"></i>
                          </a>
                        </li>';
                endif;
                if( $twitter ):
                  echo '<li>
                          <a href="' . $twitter . '" class="icoTwitter" title="Twitter" target="_blank">
                            <i class="fa fa-twitter"></i>
                          </a>
                        </li>';
                endif;
                if( $pinterest ):
                  echo '<li>
                          <a href="' . $pinterest . '" class="icoPinterest" title="Pinterest" target="_blank">
                            <i class="fa fa-pinterest-p"></i>
                          </a>
                        </li>';
                endif;
                if( $googleplus ):
                  echo '<li>
                          <a href="' . $googleplus . '" class="icoGoogle-plus" title="Google+" target="_blank">
                            <i class="fa fa-google-plus"></i>
                          </a>
                        </li>';
                endif;
                if( $instagram ):
                  echo '<li>
                          <a href="' . $instagram . '" class="icoInstagram" title="Instagram" target="_blank">
                            <i class="fa fa-instagram"></i>
                          </a>
                        </li>';
                endif;
      echo    '</ul>
            </div>'; ?>

    </div>

    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-6">

      <?php

      if( $contact_form_email_address ) { ?>

        <h3><?php _e('Contact Us','MiniMakerFaire')?></h3>

        <div class="contact-page-form">

        <?php

          //response generation function
          $response = "";

          //function to generate response
          function my_contact_form_generate_response($type, $message){

            global $response;

            if($type == "success") $response = "<div class='success'>{$message}</div>";
            else $response = "<div class='error'>{$message}</div>";

          }

          //response messages
          $not_human       = __("Human verification incorrect.",'MiniMakerFaire');
          $missing_content = __("Please supply all information.",'MiniMakerFaire');
          $email_invalid   = __("Email Address Invalid.",'MiniMakerFaire');
          $message_unsent  = __("Message was not sent. Try Again.",'MiniMakerFaire');
          $message_sent    = __("Thanks! Your message has been sent.",'MiniMakerFaire');

          //user posted variables
          $name = $_POST['message_name'];
          $email = $_POST['message_email'];
          $message = $_POST['message_text'];
          $human = $_POST['message_human'];

          //php mailer variables
          //$to = $contact_form_email_address;
          $subject = __("Someone sent a message from ",'MiniMakerFaire').get_bloginfo('name');
          $headers = __("From: ",'MiniMakerFaire'). $email . "\r\n" .
            __('Reply-To: ','MiniMakerFaire') . $email . "\r\n";

          if(!$human == 0){
            if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
            else {

              //validate email
              if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                my_contact_form_generate_response("error", $email_invalid);
              else //email is valid
              {
                //validate presence of name and message
                if(empty($name) || empty($message)){
                  my_contact_form_generate_response("error", $missing_content);
                }
                else //ready to go!
                {
                  $sent = wp_mail($contact_form_email_address, $subject, strip_tags($message), $headers);
                  if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
                  else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
                }
              }
            }
          }
          else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content); ?>

          <div id="respond">
            <?php echo $response; ?>
            <form action="<?php the_permalink(); ?>" method="post">
              <div class="form-group">
                <label for="name"><?php _e("Name",'MiniMakerFaire')?> <span>*</span></label>
                <input type="text" class="form-control" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>">
              </div>
              <div class="form-group">
                <label for="message_email"><?php _e("Email",'MiniMakerFaire')?> <span>*</span></label>
                <input type="text" class="form-control" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>">
              </div>
              <div class="form-group">
                <label for="message_text"><?php _e("Message",'MiniMakerFaire')?> <span>*</span></label>
                <textarea type="text" class="form-control" rows="3" name="message_text"><?php echo esc_textarea($_POST['message_text']); ?></textarea>
              </div>
              <div class="form-group">
                <label for="message_human"><?php _e("Human Verification",'MiniMakerFaire')?> <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label>
              </div>
              <input type="hidden" name="submitted" value="1">
              <p><input class="btn btn-primary" type="submit"></p>
            </form>
          </div>

        </div>

      </div>

    <?php } ?>

  </div>

<?php }

  // check if the nested repeater field has rows of data
  if( have_rows('list_of_team_members') ): ?>

    <div class="row contact-team">

      <div class="col-xs-12">

        <?php
        echo '<section class="featured-maker-panel-circle">';

        if(get_field('title_above_team_members')){
          echo '<div class="row padtop text-center">
                  <div class="title-w-border-r">
                    <h2>' . get_field('title_above_team_members') . '</h2>
                  </div>
                </div>';
        }

        echo '<div class="row padbottom">';

        // loop through the rows of data
        while ( have_rows('list_of_team_members') ) : the_row();

          $photo = get_sub_field('photo');
          $name = get_sub_field('name');
          $decription = get_sub_field('short_description');
          $facebook = get_sub_field('facebook');
          $twitter = get_sub_field('twitter');
          $instagram = get_sub_field('instagram');
          $pinterest = get_sub_field('pinterest');
          $googleplus = get_sub_field('googleplus');
          $linkedin = get_sub_field('linkedin');
          $email_address = get_sub_field('email_address');
          $website = get_sub_field('website');

          echo '<div class="featured-maker col-xs-6 col-sm-3">
                  <div class="maker-img" style="background-image: url(' . $photo["url"] . ');">
                  </div>
                  <div class="maker-panel-text">
                    <h4>' . $name . '</h4>
                    <p class="hidden-xs">' . $decription . '</p>
                    <div class="social-network-container">
                      <ul class="social-network social-circle">';

                        if( $facebook ):
                          echo '<li>
                                  <a href="' . $facebook . '" class="icoFacebook" title="Facebook" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                  </a>
                                </li>';
                        endif;
                        if( $twitter ):
                          echo '<li>
                                  <a href="' . $twitter . '" class="icoTwitter" title="Twitter" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                  </a>
                                </li>';
                        endif;
                        if( $pinterest ):
                          echo '<li>
                                  <a href="' . $pinterest . '" class="icoPinterest" title="Pinterest" target="_blank">
                                    <i class="fa fa-pinterest-p"></i>
                                  </a>
                                </li>';
                        endif;
                        if( $googleplus ):
                          echo '<li>
                                  <a href="' . $googleplus . '" class="icoGoogle-plus" title="Google+" target="_blank">
                                    <i class="fa fa-google-plus"></i>
                                  </a>
                                </li>';
                        endif;
                        if( $instagram ):
                          echo '<li>
                                  <a href="' . $instagram . '" class="icoInstagram" title="Instagram" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                  </a>
                                </li>';
                        endif;
                        if( $linkedin ):
                          echo '<li>
                                  <a href="' . $linkedin . '" class="icoLinkedin" title="Linkedin" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                  </a>
                                </li>';
                        endif;
                        if( $email_address ):
                          echo '<li>
                                  <a href="mailto:' . $email_address . '" target="_top" class="icoEmail" title="Email" target="_blank">
                                    <i class="fa fa-envelope"></i>
                                  </a>
                                </li>';
                        endif;
                        if( $website ):
                          echo '<li>
                                  <a href="' . $website . '" target="_top" class="icoEmail" title="Website" target="_blank">
                                    <i class="fa fa-globe"></i>
                                  </a>
                                </li>';
                        endif;

          echo        '</ul>
                    </div>
                  </div>
                </div>';

        endwhile;

        echo '</div>';

        echo '</section>'; ?>

      </div>

    </div>

  <?php endif; ?>

</div>

<?php get_footer(); ?>