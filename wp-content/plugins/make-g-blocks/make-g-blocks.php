<?php
/**
 * Plugin Name: Make G Blocks
 * Description: This plugin uses the LazyBlocks Plugin to create the Make: panels used across various Make: websites and allow their use as Gutenberg blocks. The <a href="https://wordpress.org/plugins/lazy-blocks/">LazyBlocks</a> plugin is required for this to work!
 * Version: 1.0
 * Author: Make: Community engineering
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

//Turn On Gutenburg - disabled in the Make: themes
// only for posts of type page

global $pagenow;
if($_GET['post_type'] === 'page' || $_GET['post_type'] === 'lazyblocks' || get_post_type($_GET['post']) === 'lazyblocks' || 'post.php' === $pagenow && isset($_GET['post']) && 'page' === get_post_type( $_GET['post'] )){
	  add_filter('use_block_editor_for_post', '__return_true', 999);
}
// disable for post types
add_filter('use_block_editor_for_post_type', '__return_true', 999);

// Plugin styles, add bootstrap and panels.less for easy previewing
function wpdocs_enqueue_custom_admin_styles() {
	wp_enqueue_style( 'bootstrap-css', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css', array(), null, 'all' );
	// in the package json, we've compiled the css necessary for the panels/blocks here
	wp_enqueue_style( 'admin-style-css', get_stylesheet_directory_uri() . '/css/admin-style.min.css', array(), null, 'all' );
	wp_enqueue_style( 'admin-preview-css', plugins_url('css/admin-preview.css', __FILE__ ), array(), null, 'all' );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_styles' );