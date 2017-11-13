<?php

/*
 * add resources.makerfaire.com to site list for all users
 */

add_action( 'admin_bar_menu', 'wp_admin_bar_add_resources_site', 500 );
function wp_admin_bar_add_resources_site($wp_admin_bar){
  //check if user already has admin access to the resources site.
  $key = array_search(211, array_column($wp_admin_bar->user->blogs, 'userblog_id'));
  if(!is_numeric($key) && !is_super_admin()){
    //if no, add a read only access
    switch_to_blog( 211 );

    $blavatar = '<div class="blavatar"></div>';
    $blogname = get_bloginfo( 'name' );

    if ( ! $blogname ) {
      $blogname = preg_replace( '#^(https?://)?(www.)?#', '', get_home_url() );
    }
    $menu_id  = 'blog-211';
    $wp_admin_bar->add_menu( array(
      'parent'    => 'my-sites-list',
      'id'        => $menu_id,
      'title'     => $blavatar . $blogname,
      'href'      => home_url( '/' ),
    ) );
    restore_current_blog();
  }
}
