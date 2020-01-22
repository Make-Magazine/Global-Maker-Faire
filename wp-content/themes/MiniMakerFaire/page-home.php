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
  
   <?php // We pull from the site options Ad List fields set in global.makerfaire.com
	switch_to_blog(1); 
	if( have_rows('ad_list', 'option')) {
		$return = '<aside class="fom-panel">
						 <div class="container">
							<div class="row">';
					while ( have_rows('ad_list', 'option') ) {
						the_row();
						$image = get_sub_field('ad_image');
						$return .= '<div class="col-xs-12 col-sm-6 col-md-4 text-center house-add">
											<a href="'.get_sub_field('ad_url').'" target="_blank">
												<img src="'.$image['url'].'" />
											</a>
									  </div>';
					}
		$return .= '</div>
    				</div>
  				</aside>';
		echo($return);
	}
	restore_current_blog();
   ?>

<?php get_footer(); ?>