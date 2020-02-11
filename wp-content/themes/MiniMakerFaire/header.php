<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <?php wp_head(); ?>

  <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  
  <link rel='shortlink' href='<?php echo get_site_url(); ?>' />
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/manifest.json">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="theme-color" content="#ffffff">
	
  <script type='text/javascript'>
	  // can this be removed now that the google ads are gone from the homepage?
    var googletag = googletag || {};
    googletag.cmd = googletag.cmd || [];
    (function() {
      var gads = document.createElement('script');
      gads.async = true;
      gads.type = 'text/javascript';
      var useSSL = 'https:' == document.location.protocol;
      gads.src = (useSSL ? 'https:' : 'http:') +
        '//www.googletagservices.com/tag/js/gpt.js';
      var node = document.getElementsByTagName('script')[0];
      node.parentNode.insertBefore(gads, node);
    })();
  </script>


  <?php $header_scripts = get_theme_mod( 'header_scripts' );
  if( $header_scripts != '' ) {
    echo '<!-- Begin GMF custom scripts -->';
    echo $header_scripts;
    echo '<!-- End GMF custom scripts -->';
  } ?>
</head>
<body <?php body_class(); ?>>
	
  <?php 
  if(!isset($_COOKIE['cookielawinfo-checkbox-non-necessary']) || $_COOKIE['cookielawinfo-checkbox-non-necessary']== "yes" ) {
  ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-51157-33', 'auto');
    ga('send', 'pageview');
  </script>
  <?php 
  }
  ?>

  <div class="flag-banner header-flag"></div>
 
  <nav class="navbar navbar-default <?php if(!is_page_template( 'page-home.php' )) : ?>nav-not-home<?php endif; ?>" role="navigation" id="slide-nav">
    <div class="container text-center nav-flex">
      <div class="navbar-header">
        <a class="navbar-toggle"> 
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <?php $header_logo = get_theme_mod( 'header_logo' ); ?>
		  <a href="/">
        		<img class="header-logo" src="<?php echo legacy_get_fit_remote_image_url( $header_logo, 360, 360); ?>" alt="<?php bloginfo( 'name' ); ?> logo" />
		  </a>
      </div>

      <div id="nav-not-home-logo">
        <a href="/">
          <img src="<?php echo legacy_get_fit_remote_image_url( $header_logo, 384, 384); ?>" alt="<?php bloginfo( 'name' ); ?> logo" />
        </a>
      </div>

      <?php
		$header_cta = "";
		$header_cta_radio = get_theme_mod( 'header_cta_radio' );
      $header_cta_text = get_theme_mod( 'header_cta_text' );
      $header_cta_link = esc_url( get_theme_mod( 'header_cta_link' ) );
      if( $header_cta_radio != '' ) {
        switch ( $header_cta_radio ) {
          case 'value1':
              $header_cta = '<div id="header-cta-button"><a class="btn btn-primary" href="'.$header_cta_link.'">'.$header_cta_text.'</a></div>';
              break;
          case 'value2':
              break;
        }
      }
      wp_nav_menu( array(
        'theme_location'    => 'main_menu',
        'depth'             => 2,
        'container'         => 'div',
        'container_id'      => 'slidemenu',
        'container_class'   => '',
        'menu_class'        => 'nav navbar-nav',
        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		  'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s'.$header_cta.'</ul>',
        'walker'            => new wp_bootstrap_navwalker())
      );

      ?>

    </div>
  </nav>

  <div id="page-content">
