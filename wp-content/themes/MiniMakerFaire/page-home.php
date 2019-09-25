<?php
/*
* Template name: Home Page
*/

get_header();

  // Get the home template page ID
  $home_pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-home.php'
  ));
  foreach($home_pages as $home_page){
    $home_ID = $home_page->ID;
  }

  // Slideshow panel here
  home_page_image_carousel();
  
  // check if the flexible content field has rows of data
  if( have_rows('home_page_panels', $home_ID)) {
    // loop through the rows of data
    while ( have_rows('home_page_panels', $home_ID) ) {
      the_row();
      $row_layout = get_row_layout();
      echo dispLayout($row_layout);
    }
  }
  ?>

  <?php // FIND OUT MORE PANEL
  $url1 = str_replace( "SITE_URL", esc_url( network_home_url() ), get_site_option( 'find-out-more-url1' ) );
  $url2 = str_replace( "SITE_URL", esc_url( network_home_url() ), get_site_option( 'find-out-more-url2' ) );
  ?>
  <aside class="fom-panel">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 text-center dyn-google-ad">
          <div id='div-gpt-ad-1464723042021-0'>
            <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1464723042021-0'); });
            </script>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 text-center dyn-google-ad">
          <div id='div-gpt-ad-1464723042021-1'>
            <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1464723042021-1'); });
            </script>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 text-center dyn-google-ad">
          <div id='div-gpt-ad-1464723042021-2'>
            <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1464723042021-2'); });
            </script>
          </div>
        </div>
      </div>
    </div>
  </aside>

<?php get_footer(); ?>
