<?php
/**
* Plugin Name: GP Limit Checkboxes
* Description: Limit how many checkboxes can be checked.
* Plugin URI: http://gravitywiz.com/
* Version: 1.2.3
* Author: David Smith
* Author URI: http://gravitywiz.com/
* License: GPL2
* Perk: True
* Text Domain: gp-limit-checkboxes
* Domain Path: /languages
*/

define( 'GP_LIMIT_CHECKBOXES_VERSION', '1.2.3' );

require 'includes/class-gp-bootstrap.php';

$gp_limit_checkboxes_bootstrap = new GP_Bootstrap( 'class-gp-limit-checkboxes.php', __FILE__ );