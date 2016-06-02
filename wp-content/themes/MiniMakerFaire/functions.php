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

////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////

  function devdmbootstrap3_theme_stylesheets() {
    wp_enqueue_style( 'bootstrap-css', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css', array(), null, 'all' );
    wp_enqueue_style( 'theme-css', get_stylesheet_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'font-awesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css', array(), null, 'all' );
    wp_enqueue_style( 'google-font-body', 'https://fonts.googleapis.com/css?family=Roboto:400,300,700,500', array(), null, 'all' );
    wp_enqueue_style( 'google-font-heading', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700', array(), null, 'all' );
    wp_enqueue_style( 'fancybox-css', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css', array(), null, 'all' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), null, 'all' );
  }
  add_action('wp_enqueue_scripts', 'devdmbootstrap3_theme_stylesheets');


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
// Enqueue the AngularJS
////////////////////////////////////////////////////////////////////
  function angular_scripts() {
    if (is_page('meet-the-makers') || is_page('schedule')) {
      wp_enqueue_script(
        'angularjs',
        get_stylesheet_directory_uri() . '/bower_components/angular/angular.min.js'
      );

      wp_enqueue_script(
        'dirPagination',
        get_stylesheet_directory_uri() . '/bower_components/angular/dirPagination.js',
        array( 'angularjs')
      );
      wp_enqueue_script(
        'carousel',
        get_stylesheet_directory_uri().'/js/owl.carousel.min.js'
      );
      if (is_page('meet-the-makers')) {
          wp_enqueue_script(
          'angular-mtm',
          get_stylesheet_directory_uri() . '/js/angular/controller.js',
          array( 'angularjs', 'dirPagination' )
        );
      }

      if (is_page('schedule')) {
        wp_enqueue_script(
          'angular-schedule',
          get_stylesheet_directory_uri() . '/js/angular/schedule_cont.js',
          array( 'angularjs', 'dirPagination' )
        );
      }
    }
  }
  add_action( 'wp_enqueue_scripts', 'angular_scripts' );


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
// Remove unwanted dashboard widgets for relevant users
////////////////////////////////////////////////////////////////////
  
  function remove_dashboard_widgets() {
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
  }
  add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );


////////////////////////////////////////////////////////////////////
// Add new dashboard widget
////////////////////////////////////////////////////////////////////

  function add_dashboard_widgets() {
    add_meta_box( 'dashboard_welcome', 'Welcome! Let’s get started:', 'add_welcome_widget', 'dashboard', 'side', 'high' );
  }
  function add_welcome_widget(){ ?>
   
    The left navigation bar is your control center for your site.

  <ol>
    <li>General Site Setup</li>
  </ol>
  <p>Go to Appearance &gt; Customize</p>
  <ol>
    <li>Add / Update your logo</li>
    <li>Update your Main Menu / Header</li>
    <li>Add CTA (Call to Action) button to the right of the Main Menu</li>
    <li>Update your Footer</li>
    <li>...and more - look around!</li>
  </ol>
  <p></p>
  <ol>
    <li>Specific Page Setup</li>
  </ol>
  <p>Go to Pages &gt; All Pages</p>
  <ol>
    <li>Add, remove, or update pages</li>
    <li>The Homepage it built with panels. Click on Pages &gt; Home to view, edit add or remove panels. You can also drag and drop what order they appear in. </li>
  </ol>
  <p></p>
  <p>TIP: Explore panels and see how they work. You can use them throughout most your site. They are easy to use and will make your site look great!</p>
  <p></p>
  <ol>
    <li>Some pages have pre-loaded templates (Contact, News, Meet the Makers, Schedule, etc). Each one is a little different. You can&rsquo;t add panels to these pages because they are pre-designed to look good.</li>
    <li>The remainder of the pages are blank. You can choose to add panels or whatever text or image you would like. There are simple visual editors or HTML editing. These pages are wide open for you to use as needed. You can add more, by going to Pages &gt; Add New.</li>
  </ol>
  <p></p>
  <ol>
    <li>Header and Footer, including site navigation (aka: menus)</li>
  </ol>
  <ol>
    <li>Menus can be edited in two places: </li>
  </ol>
  <ol>
    <li>Appearance &gt; Customize</li>
  </ol>
  <p>or</p>
  <ol>
    <li>Appearance &gt; Menu </li>
  </ol>
  <ol>
    <li>There are 2 Menus</li>
  </ol>
  <ol>
    <li>Main Menu (at the top in the Header)</li>
  </ol>
  <ol>
    <li>Add up to 6 main menu items</li>
    <li>Create as many submenu items as you choose</li>
  </ol>
  <ol>
    <li>Footer Menu (at the bottom, on the left side of the footer.)</li>
  </ol>
  <ol>
    <li>Add up to 4 footer menu items</li>
    <li>Social icons are updated in Appearance &gt; Customize &gt; Footer Social Media Links</li>
  </ol>
  <p></p>
  <ol>
    <li>Media Library (Images and Files)</li>
  </ol>
  <ol>
    <li>Optional: If you have a previous WordPress site, you can export your Media Library and Import into this site. Instructions here.</li>
    <li>If you don&rsquo;t have images from previous faires to use on your site, you can use any image in this dropbox:<sup>[b]</sup>&nbsp;</li>
  </ol>
  <p></p>
  <ol>
    <li>News (aka: Posts or Blog)</li>
  </ol>
  <ol>
    <li>To create news, go to Posts &gt; All Posts. </li>
  </ol>
  <ol>
    <li>We have one sample post in there: Hello world! </li>
    <li>To see how posts will look, check out the test site at <a href="http://global.makerfaire.com/">http://global.makerfaire.com/</a>. Click on News in the Header.</li>
  </ol>
  <ol>
    <li>Optional: If you have a previous WordPress site, you can export your Posts and Import them into this site. Instructions here.</li>
    <li>Once you start creating blog posts, add the &ldquo;News&rdquo; Panel to your Homepage (Pages &gt; Home &gt; Post Feed) and a dynamic panel will start populating your News onto your Homepage. You can also see a sample of this here: <a href="http://global.makerfaire.com/">http://global.makerfaire.com/</a>.</li>
  </ol>
  <p></p>
  <ol>
    <li>Call for Makers Form</li>
  </ol>
  <ol>
    <li>Your site comes with a Form creator and editor to create your Call for Makers Form. Go to Forms &gt; Forms</li>
    <li>We&rsquo;ve provided a Sample Call for Makers Form you can copy and edit. </li>
    <li>There are handful of fields we&rsquo;ve locked, because there&rsquo;s logic used in the site to display those fields dynamically on pages.</li>
    <li>All of the other fields you can edit.</li>
    <li>Feel free to add questions that are specific to your event or remove questions that are not relevant. </li>
    <li>Many of the fields (questions) are conditional and appear only when the maker selects specific answers to questions in the form. To adjust conditional settings, in your form click on a question and go to the &ldquo;Advanced&rdquo; tab.</li>
    <li>You can hide fields from the public (but still use them in the admin view) by marking them &ldquo;Admin Only&rdquo;. Click on a question and go to the &ldquo;Advanced&rdquo; tab.</li>
  </ol>
  <p></p>
  <p>TIP 1: To view the live version of your form go to Pages &gt; Call for Makers Form &gt; View Page. (You can keep the page Private until your form is ready.)</p>
  <p></p>
  <p>TIP 2: Dive in. There&rsquo;s SO much you can do with Gravity Forms. The best way to learn is to start.</p>
  <p></p>
  <ol>
    <li>Reviewing Entries / Entry UI </li>
  </ol>
  <ol>
    <li>Go to Forms &gt; Forms &gt; Entries</li>
    <li>The first view that appears is your Entry List.</li>
  </ol>
  <p></p>
  <p>TIP: Modify the columns that appear in your List View by clicking the gear icon at the top right of the list. We recommend these columns: Project Name or Title, Project Photo, Entry ID, Status, Type of Proposal, Maker 1 First Name, Maker 1 Last Name, Group Name, Entry Date</p>
  <p></p>
  <ol>
    <li>Click on the Project Name or Title to view the specific entry details.</li>
  </ol>
  <p></p>
  <p>Important:&nbsp;Additional Entry UI features are coming within the next two weeks! Status updates, Rating entries, Comments, and more&hellip;. Stay tuned</p>
  <p></p>
  <ol>
    <li>Exporting Entries / Reports</li>
  </ol>
  <ol>
    <li>To Export Entries, go to Forms &gt; Import / Export</li>
    <li>This feature will download a complete report of all entry fields.</li>
  </ol>
  <p></p>
  <p>Look around and start clicking.<br />
  There&rsquo;s a lot you can do to customize your site. <br />
  Get started!</p>
  <img style="width:100%;height:auto;" src="/wp-content/themes/MiniMakerFaire/img/makey_panel-br.png" /> 

  <?php }
  add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );


////////////////////////////////////////////////////////////////////
// Sponsor slider panel from sponsors set in sponsors page
////////////////////////////////////////////////////////////////////

  function sponsors_slider() {
    if( have_rows('sponsors') ): ?>
      <div class="sponsor-slide">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h3 class="sponsor-slide-title">2016 Maker Faire Sponsors: <span class="sponsor-slide-cat"></span></h4>
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