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

<?php } ?>


  <div class="row">

    <div class="col-xs-12 col-sm-6 col-md-4">

      <h3>Contact Info</h3>



    </div>

    <div class="col-xs-12 col-sm-6 col-md-8">

    </div>

  </div>

  <?php // check if the nested repeater field has rows of data
  if( have_rows('list_of_team_members') ): ?>

    <div class="row">

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
          $email_address = get_sub_field('email_address');

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
                        if( $email_address ):
                          echo '<li>
                                  <a href="mailto:' . $email_address . '" target="_top" class="icoEmail" title="Email" target="_blank">
                                    <i class="fa fa-envelope"></i>
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