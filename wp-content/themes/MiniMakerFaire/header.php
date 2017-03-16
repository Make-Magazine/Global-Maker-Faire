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

  <script type='text/javascript'>
    googletag.cmd.push(function() {
      googletag.defineSlot('/11548178/GlobalMakerFaire', [300, 250], 'div-gpt-ad-1464723042021-0').setTargeting('adPos', ['left']).addService(googletag.pubads());
      googletag.defineSlot('/11548178/GlobalMakerFaire', [300, 250], 'div-gpt-ad-1464723042021-1').setTargeting('adPos', ['center']).addService(googletag.pubads());
      googletag.defineSlot('/11548178/GlobalMakerFaire', [300, 250], 'div-gpt-ad-1464723042021-2').setTargeting('adPos', ['right']).addService(googletag.pubads());
      googletag.pubads().setTargeting('Location', []);
      googletag.enableServices();
    });
  </script>

  <?php $header_scripts = get_theme_mod( 'header_scripts' );
  if( $header_scripts != '' ) {
    echo '<!-- Begin GMF custom scripts -->';
    echo $header_scripts;
    echo '<!-- End GMF custom scripts -->';
  } ?>
</head>
<body <?php body_class(); ?>>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-51157-33', 'auto');
    ga('send', 'pageview');
  </script>

  <div class="flag-banner header-flag"></div>
  <div class="alert alert-danger text-center" role="alert">
Site Maintenance: Thurs 3/16, 9PM PDT to 2AM PDT. Any changes or applications submitted during this timeframe will not be saved.</div>
      
  <nav class="navbar navbar-default <?php if(!is_page_template( 'page-home.php' )) : ?>nav-not-home<?php endif; ?>" role="navigation" id="slide-nav">
    <div class="container text-center nav-flex">
      <div class="navbar-header">
        <a class="navbar-toggle"> 
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <img class="header-logo" src="<?php echo get_theme_mod( 'header_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?> logo" />
      </div>

      <div id="nav-not-home-logo">
        <a href="/">
          <img src="<?php echo get_theme_mod( 'header_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?> logo" />
        </a>
      </div>

      <?php
      wp_nav_menu( array(
        'theme_location'    => 'main_menu',
        'depth'             => 2,
        'container'         => 'div',
        'container_id'      => 'slidemenu',
        'container_class'   => '',
        'menu_class'        => 'nav navbar-nav',
        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
        'walker'            => new wp_bootstrap_navwalker())
      );

      $header_cta_radio = get_theme_mod( 'header_cta_radio' );
      $header_cta_text = get_theme_mod( 'header_cta_text' );
      $header_cta_link = esc_url( get_theme_mod( 'header_cta_link' ) );
      if( $header_cta_radio != '' ) {
        switch ( $header_cta_radio ) {
          case 'value1':
              echo '<div id="header-cta-button"><a class="btn btn-primary" href="';
              echo $header_cta_link;
              echo '">';
              echo $header_cta_text;
              echo '</a></div>';
              break;
          case 'value2':
              break;
        }
      } ?>

    </div>
  </nav>

  <div id="page-content">
