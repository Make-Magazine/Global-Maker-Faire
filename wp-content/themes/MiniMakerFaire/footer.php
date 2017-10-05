  <footer class="gmf-footer">
    <div class="container">
      <div class="row padbottom">
        <div class="col-sm-6 footer-right-border">
          <div class="footer-logo-div">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <?php $header_logo = get_theme_mod( 'header_logo' ); ?>
              <img class="img-responsive footer-logos footer-local-logo" src="<?php echo legacy_get_fit_remote_image_url( $header_logo, 620, 620); ?>" alt="<?php bloginfo( 'name' ); ?> logo" />
            </a>
          </div>
          <?php
          if ( has_nav_menu( 'footer_menu' ) ) :
            wp_nav_menu( array(
              'theme_location'    => 'footer_menu',
              'depth'             => 2,
              'container'         => 'ul',
              'container_class'   => 'list-unstyled',
              'menu_class'        => 'list-unstyled',
              'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
              'walker'            => new wp_bootstrap_navwalker())
            );
          endif; ?>

          <div class="social-network-container">
            <ul class="social-network social-circle">

              <?php $facebook_link = esc_url( get_theme_mod( 'facebook_link' ) );
              if( $facebook_link != '' ) {
                echo '<li>
                        <a href="' . $facebook_link . '" class="icoFacebook" title="Facebook" target="_blank">
                          <i class="fa fa-facebook"></i>
                        </a>
                      </li>';
              }

              $twitter_link = esc_url( get_theme_mod( 'twitter_link' ) );
              if( $twitter_link != '' ) {
                echo '<li>
                        <a href="' . $twitter_link . '" class="icoTwitter" title="Twitter" target="_blank">
                          <i class="fa fa-twitter"></i>
                        </a>
                      </li>';
              }

              $instagram_link = esc_url( get_theme_mod( 'instagram_link' ) );
              if( $instagram_link != '' ) {
                echo '<li>
                        <a href="' . $instagram_link . '" class="icoInstagram" title="Instagram" target="_blank">
                          <i class="fa fa-instagram"></i>
                        </a>
                      </li>';
              }

              $pintrest_link = esc_url( get_theme_mod( 'pintrest_link' ) );
              if( $pintrest_link != '' ) {
                echo '<li>
                        <a href="' . $pintrest_link . '" class="icoPinterest" title="Pinterest" target="_blank">
                          <i class="fa fa-pinterest-p"></i>
                        </a>
                      </li>';
              }

              $google_plus_link = esc_url( get_theme_mod( 'google_plus_link' ) );
              if( $google_plus_link != '' ) {
                echo '<li>
                        <a href="' . $google_plus_link . '" class="icoGoogle-plus" title="Google+" target="_blank">
                          <i class="fa fa-google-plus"></i>
                        </a>
                      </li>';
              } ?>
            </ul>
          </div>
        </div>

        <div class="col-sm-6 footer-right hidden-xs">
          <?php echo stripslashes(get_site_option( 'footer-text' ));?>
        </div>
      </div>
      <div class="row padtop">
        <div class="col-xs-12">
          <p class="copyright-footer text-center"><?php bloginfo( 'name' ); ?> is independently organized and operated under license from Maker Media, Inc.</p>
        </div>
      </div>
    </div>
  </footer>
</div>
<!-- end main container -->

<?php wp_footer(); ?>

<?php $footer_scripts = get_theme_mod( 'footer_scripts' );
if( $footer_scripts != '' ) {
  echo '<!-- Begin GMF custom scripts -->';
  echo $footer_scripts;
  echo '<!-- End GMF custom scripts -->';
} ?>
</body>
</html>