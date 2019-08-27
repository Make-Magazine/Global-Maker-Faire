<?php
/**
 * Plugin Name: Make G Blocks
 * @package   Block_Lab
 * @copyright Copyright(c) 2019, Block Lab
 * @license http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 *
 * Plugin Name: Make G Blocks
 * Description: This plugin uses the <a href="https://getblocklab.com">Block_Lab</a> Plugin to create the Make: panels used across various Make: websites and allow their use as Gutenberg blocks. The <a href="https://getblocklab.com">Block_Lab</a> plugin is required for this to work!
 * Version: 1.0
 * Author: Make: Community engineering
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

//Turn On Gutenburg - disabled in the Make: themes
// only for posts of type page
global $pagenow;
if($_GET['post_type'] == 'page' || $_GET['post_type'] == 'lazyblocks' || 'post.php' === $pagenow && isset($_GET['post']) && 'page' === get_post_type( $_GET['post'] )){
	  add_filter('use_block_editor_for_post', '__return_true', 999);
}
// disable for post types
add_filter('use_block_editor_for_post_type', '__return_true', 999);

// this is still necessary for lazyblocks, the part below can be replaced

//set block lab template path
function my_block_lab_template_path() {
	return plugin_dir_path( __FILE__ );
}
add_filter('block_lab_template_path', 'my_block_lab_template_path' );