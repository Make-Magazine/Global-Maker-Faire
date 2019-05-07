<?php
////////////////////////////////////////////////////////////////////
// Theme Information
////////////////////////////////////////////////////////////////////

  $themename = "MakerFaire";
  $developer_uri = "https://makermedia.com";
  $shortname = "mf";
  $version = '1.0';

// FOR NOW, TURN OFF GUTENBURG
// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

////////////////////////////////////////////////////////////////////
// include Theme-options.php for Admin Theme settings
////////////////////////////////////////////////////////////////////

  include 'theme-options.php';

////////////////////////////////////////////////////////////////////
// Include shortcodes.php for Bootstrap Shortcodes
////////////////////////////////////////////////////////////////////

  include 'shortcodes.php';

////////////////////////////////////////////////////////////////////
// Include customizer.php for WP theme custom options
////////////////////////////////////////////////////////////////////

  include 'customizer.php';

  if ( !function_exists('get_editable_roles') ) {
    require_once( ABSPATH . '/wp-admin/includes/user.php' );
  }


////////////////////////////////////////////////////////////////////
// Define our current Version number using the stylesheet version
////////////////////////////////////////////////////////////////////

  function my_wp_default_styles($styles) {
    $my_theme = wp_get_theme();
    $my_version = $my_theme->get('Version');
    $styles->default_version = $my_version;
  }
  add_action("wp_default_styles", "my_wp_default_styles");



  function enqueue_admin() {
  	wp_enqueue_script('wp-admin', get_stylesheet_directory_uri() . '/js/wp-admin.js' );
    wp_enqueue_script('fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js', true);
    wp_enqueue_style('fancybox-style', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css');
  	wp_enqueue_script('media-upload');
  }
  add_action( 'admin_enqueue_scripts', 'enqueue_admin' );


////////////////////////////////////////////////////////////////////
// Enqueue Styles
////////////////////////////////////////////////////////////////////

  function devdmbootstrap3_theme_stylesheets() {
    wp_enqueue_style( 'bootstrap-css', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css', array(), null, 'all' );
    wp_enqueue_style( 'theme-css', get_stylesheet_directory_uri() . '/css/style.min.css' );
    wp_enqueue_style( 'font-awesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css', array(), null, 'all' );
    wp_enqueue_style( 'google-font-body', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Condensed:400', array(), null, 'all' );
    wp_enqueue_style( 'google-font-heading', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700', array(), null, 'all' );
    wp_enqueue_style( 'fancybox-css', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css', array(), null, 'all' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), null, 'all' );
  }
  add_action('wp_enqueue_scripts', 'devdmbootstrap3_theme_stylesheets');

////////////////////////////////////////////////////////////////////
// Include all class files in the /classes directory:
////////////////////////////////////////////////////////////////////

  foreach ( glob(TEMPLATEPATH . '/classes/*.php' ) as $file) {
    include_once $file;
  }

////////////////////////////////////////////////////////////////////
// Include all function files in the /functions directory:
////////////////////////////////////////////////////////////////////

  foreach ( glob(TEMPLATEPATH . '/functions/*.php' ) as $file) {
    include_once $file;
  }

////////////////////////////////////////////////////////////////////
// Register Scripts
////////////////////////////////////////////////////////////////////

  function devdmbootstrap3_theme_js() {
   $my_theme = wp_get_theme();
   $my_version = $my_theme->get('Version');
    wp_enqueue_script('modernizr-js', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), false, false);
    wp_enqueue_script('bootstrap-js', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ),false,true );
    wp_enqueue_script('fancybox-js', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js', array( 'jquery' ),false,true );
    wp_enqueue_script('misc-scripts', get_stylesheet_directory_uri() . '/js/scripts/min/scripts.min.js', array( 'jquery' ),$my_version,true );
  }
  add_action('wp_enqueue_scripts', 'devdmbootstrap3_theme_js');


////////////////////////////////////////////////////////////////////
// Register newsletter script
////////////////////////////////////////////////////////////////////

  function makerfaire_theme_js() {
    wp_enqueue_script('newsletter-js', get_stylesheet_directory_uri() . '/js/dynamic/newsletter.php', array( 'jquery' ),time(),true );
  }
  add_action('wp_enqueue_scripts', 'makerfaire_theme_js');


////////////////////////////////////////////////////////////////////
// Enqueue the AngularJS
////////////////////////////////////////////////////////////////////

  function angular_scripts() {
    if (is_page_template('page-meet-the-makers.php') || is_page_template('page-schedule.php')) {
      wp_enqueue_script('carousel',      get_stylesheet_directory_uri() . '/js/scripts/owl.carousel.min.js', array(),false,true);

      $my_theme = wp_get_theme();
      $my_version = $my_theme->get('Version');

      wp_enqueue_script('angularjs', get_stylesheet_directory_uri() . '/js/built-angular-libs.min.js', array(),$my_version,true);
      if (is_page_template('page-meet-the-makers.php')) {
        wp_enqueue_script('angular-mtm',get_stylesheet_directory_uri() . '/js/angular/controller.js', array( 'angularjs', 'carousel' ),$my_version,true);
      }

      if (is_page_template('page-schedule.php')) {
        wp_enqueue_script('angular-filter','//cdnjs.cloudflare.com/ajax/libs/angular-filter/0.4.7/angular-filter.js',array('angularjs'),$my_version,true);
        wp_enqueue_script('angular-schedule',get_stylesheet_directory_uri() . '/js/angular/schedule_cont.js',array('angularjs','angular-filter'),$my_version,true);
      }
    }
  }
  add_action( 'wp_enqueue_scripts', 'angular_scripts' );

////////////////////////////////////////////////////////////////////
// Load Admin scripts
////////////////////////////////////////////////////////////////////

  function load_admin_scripts() {
    wp_enqueue_style('admin-btstrp', get_stylesheet_directory_uri() . '/css/admin-bootstrap.css' ); // FYI this is not the full bootstrap css file, most BS styles are missing from this *
    // jquery from Wordpress core (with no-conflict mode flag enabled):
    wp_enqueue_script('datetimepicker', get_stylesheet_directory_uri() . '/js/admin/jquery.datetimepicker.js', array( 'jquery' ) );
    wp_enqueue_script('GF-entry-detail', get_stylesheet_directory_uri() . '/js/admin/GF-entry-detail.js', array( 'jquery' ) );
    wp_enqueue_script('bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ),false,true );
  }
  add_action('admin_enqueue_scripts','load_admin_scripts');



////////////////////////////////////////////////////////////////////
// Add Title Tag Support with Regular Title Tag injection Fall back.
////////////////////////////////////////////////////////////////////

  function devdmbootstrap3_title_tag() {
    add_theme_support( 'title-tag' );
  }
  add_action( 'after_setup_theme', 'devdmbootstrap3_title_tag' );

  if(!function_exists( '_wp_render_title_tag')) {

    function devdmbootstrap3_render_title() {
        ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
    }
    add_action( 'wp_head', 'devdmbootstrap3_render_title' );

  }


////////////////////////////////////////////////////////////////////
// Register Custom Navigation Walker
////////////////////////////////////////////////////////////////////

  require_once('lib/wp_bootstrap_navwalker.php');


////////////////////////////////////////////////////////////////////
// Register Menus
////////////////////////////////////////////////////////////////////

  register_nav_menus(
    array(
      'main_menu' => 'Main Menu',
      'footer_menu' => 'Footer Menu'
    )
  );


////////////////////////////////////////////////////////////////////
// Register the Sidebar
////////////////////////////////////////////////////////////////////

  register_sidebar(array(
    'name' => 'Right Sidebar',
    'id' => 'right-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name'=> 'Page Widget Area 1',
    'id' => 'page_widget_area_1',
    'before_widget' => '<div class="container std-panel"><div class="row"><div class="col-xs-12 text-center">',
    'after_widget' => '</div></div></div>
                          <div class="container">
                            <div class="row">
                              <div class="col-sm-10 col-md-8 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
                                <hr class="hr-half" />
                              </div>
                            </div>
                          </div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));


////////////////////////////////////////////////////////////////////
// Add support for a featured image and the size
////////////////////////////////////////////////////////////////////

  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size(300,300, true);


////////////////////////////////////////////////////////////////////
// Adds RSS feed links to for posts and comments.
////////////////////////////////////////////////////////////////////

  add_theme_support( 'automatic-feed-links' );

////////////////////////////////////////////////////////////////////
// Adds SMTP Settings
////////////////////////////////////////////////////////////////////

add_action('phpmailer_init', 'send_smtp_email');

function send_smtp_email($phpmailer) {

  // Define that we are sending with SMTP
  $phpmailer->isSMTP();

  // The hostname of the mail server
  $phpmailer->Host = "smtp.mandrillapp.com";

  // Use SMTP authentication (true|false)
  $phpmailer->SMTPAuth = true;

  // SMTP port number - likely to be 25, 465 or 587
  $phpmailer->Port = "2525";

  // Username to use for SMTP authentication
  $phpmailer->Username = "webmaster@makermedia.com";

  // Password to use for SMTP authentication
  $phpmailer->Password = "NM4IvbgO5LFJeBfRGP_wMg";

  // Encryption system to use - ssl or tls
  $phpmailer->SMTPSecure = "";
}



function my_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {
   
   $newTitle = '';

   if( $activeInactive = get_sub_field('activeinactive') ) {
      $style = ($activeInactive === 'Active') ? 'style="color: green"' : 'style="color: red"';
      $newTitle .= ' <span '. $style .'>(' . $activeInactive . ')</span>';
   } else if ($activeInactive = get_sub_field('show_what_is_maker_faire') ) {
      $style = ($activeInactive === 'show') ? 'style="color: green"' : 'style="color: red"';
      $newTitle .= ' <span '. $style .'>(' . $activeInactive . ')</span>';
   }


   if( $butTixText = get_sub_field('buy_ticket_text') ) {
      $newTitle .= ' ' . $butTixText . ' ';
   }

   // 1-col WYSIWYG
   if( $customTitle = get_sub_field('title') ) {
      $newTitle .= ' ' . $customTitle . ' ';
   }

   // 3-col
   if( $panelTitle = get_sub_field('panel_title') ) {
      $newTitle .= ' ' . $panelTitle . ' ';
   }

   // Star Ribbon
   if( $starRibbonText = get_sub_field('text') ) {
      $newTitle .= ' ' . $starRibbonText . ' ';
   }

   // Hero Title
   if( $columnTitle = get_sub_field('column_title') ) {
      $newTitle .= ' ' . strip_tags( $columnTitle ) . ' ';
   }

   // Become a Sponsor Button
   if( $sponsorsTitle = get_sub_field('title_sponsor_panel') ) {
      $newTitle .= ' Sponsors: ' . $sponsorsTitle . ' ';
   }

   // Sponsor URL 
   if( $sponsorsURL = get_sub_field('sponsors_page_url') ) {
      $newTitle .= ' Sponsors: ' . $sponsorsURL . ' ';
   }

   if( $featureFairesTitle = get_sub_field('featured_faires_title') ) {
      $newTitle .= ' ' . $featureFairesTitle . ' ';
   }

   $newTitle .= '<div style="font-size: 12px; margin-right: 2em;">' . $title . '</div>';

	return $newTitle;
	
}

// name
add_filter('acf/fields/flexible_content/layout_title', 'my_acf_flexible_content_layout_title', 10, 4);


?>