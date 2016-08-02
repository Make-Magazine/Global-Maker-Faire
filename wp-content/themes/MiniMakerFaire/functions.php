<?php
////////////////////////////////////////////////////////////////////
// Theme Information
////////////////////////////////////////////////////////////////////

  $themename = "MakerFaire";
  $developer_uri = "http://makermedia.com";
  $shortname = "mf";
  $version = '1.0';

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


////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////

  function devdmbootstrap3_theme_stylesheets() {
    wp_enqueue_style('bootstrap-css',get_stylesheet_directory_uri() . '/css/bootstrap.min.css');

    //wp_enqueue_style( 'bootstrap-css', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css', array(), null, 'all' );
    //???????
    //wp_enqueue_style( 'make-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'theme-css', get_stylesheet_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'font-awesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css', array(), null, 'all' );
    wp_enqueue_style( 'google-font-body', 'https://fonts.googleapis.com/css?family=Roboto:400,300,700,500', array(), null, 'all' );
    wp_enqueue_style( 'google-font-heading', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700', array(), null, 'all' );
    wp_enqueue_style( 'fancybox-css', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css', array(), null, 'all' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), null, 'all' );
  }
  add_action('wp_enqueue_scripts', 'devdmbootstrap3_theme_stylesheets');


////////////////////////////////////////////////////////////////////
// Include all function files in the /functions directory:
////////////////////////////////////////////////////////////////////

  foreach ( glob(TEMPLATEPATH . '/functions/*.php' ) as $file) {
    include_once $file;
  }


////////////////////////////////////////////////////////////////////
// Register Bootstrap JS with jquery
////////////////////////////////////////////////////////////////////

  function devdmbootstrap3_theme_js() {
    wp_enqueue_script('theme-js', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js', array( 'jquery' ),false,true );
    wp_enqueue_script('misc-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ),false,true );
    wp_enqueue_script('fancybox-js', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js', array( 'jquery' ),false,true );
    wp_enqueue_script('owl-carousel', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ),false,true );
  }
  add_action('wp_enqueue_scripts', 'devdmbootstrap3_theme_js');


////////////////////////////////////////////////////////////////////
// Register custom scripts
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
      wp_enqueue_script('angularjs',get_stylesheet_directory_uri() . '/node_modules/angular/angular.min.js');
      wp_enqueue_script('dirPagination',get_stylesheet_directory_uri() . '/node_modules/angular-utils-pagination/dirPagination.js',array( 'angularjs'));
      wp_enqueue_script('carousel',get_stylesheet_directory_uri().'/js/owl.carousel.min.js');
      if (is_page_template('page-meet-the-makers.php')) {
        wp_enqueue_script('angular-mtm',get_stylesheet_directory_uri() . '/js/angular/controller.js', array( 'angularjs', 'dirPagination' ));
      }

      if (is_page_template('page-schedule.php')) {
        wp_enqueue_script('angular-schedule',get_stylesheet_directory_uri() . '/js/angular/schedule_cont.js',array( 'angularjs', 'dirPagination' ));
      }
      // jquery from Wordpress core (with no-conflict mode flag enabled):
      wp_enqueue_script('jquery');
      $my_theme = wp_get_theme();
      $my_version = $my_theme->get('Version');
      // Libraries concatenated by the grunt concat task (in Gruntfile.js):
      wp_enqueue_script('built-libs', get_stylesheet_directory_uri() . '/js/built-libs.js', array('angularjs','jquery'),$my_version);
    }
  }
  add_action( 'wp_enqueue_scripts', 'angular_scripts' );

////////////////////////////////////////////////////////////////////
// Load Admin scripts
////////////////////////////////////////////////////////////////////

  function load_admin_scripts() {
    wp_enqueue_style( 'admin-btstrp', get_stylesheet_directory_uri() . '/css/admin-bootstrap.css' );
    // jquery from Wordpress core (with no-conflict mode flag enabled):
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'datetimepicker', get_stylesheet_directory_uri() . '/js/admin/jquery.datetimepicker.js', array( 'jquery' ) );
    wp_enqueue_script( 'GF-entry-detail', get_stylesheet_directory_uri() . '/js/admin/GF-entry-detail.js', array( 'jquery' ) );
    wp_enqueue_script('bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js', array( 'jquery' ),false,true );
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
// Sponsor slider panel from sponsors set in sponsors page
////////////////////////////////////////////////////////////////////

  function sponsors_slider() {
    if( have_rows('sponsors') ): ?>
      <div class="sponsor-slide">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h3 class="sponsor-slide-title">2016 Maker Faire Sponsors: <span class="sponsor-slide-cat"></span></h3>
              <hr />
              <h5></h5>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">

              <div id="carousel-sponsors-slider" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <!-- IMAGE SPONSORS -->
                  <?php if( have_rows('goldsmith_sponsors', $id) ): ?>
                  <div class="item">
                    <div class="row spnosors-row">
                      <div class="col-xs-12">
                        <h3 class="sponsors-type text-center">GOLDSMITH</h3>
                          <div class="sponsors-box">
                          <?php
                            while( have_rows('goldsmith_sponsors', $id) ): the_row();
                              $sub_field_1 = get_sub_field('image'); //Photo
                              $sub_field_2 = get_sub_field('url'); //URL

                              echo '<div class="sponsors-box-md">';
                              if( get_sub_field('url') ):
                                echo '<a href="' . $sub_field_2 . '" target="_blank">';
                              endif;
                              echo '<img src="' . $sub_field_1 . '" alt="Maker Faire sponsor logo" class="img-responsive" />';
                              if( get_sub_field('url') ):
                                echo '</a>';
                              endif;
                              echo '</div>';
                            endwhile; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
          <div class="row sponsor_panel_bottom">
            <div class="col-xs-12 text-center">
              <p><a href=""></a> <span>&middot;</span> <a href=""></a></p>
            </div>
          </div>

        </div>
      </div>
    <?php endif;

    }
    add_action('sponsors_slider_function', 'sponsors_slider');

?>