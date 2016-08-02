<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function on_activate( $network_wide ) {
    global $wpdb;
    if ( is_multisite() && $network_wide ) {
        // Get all blogs in the network and activate plugin on each one
        $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
        foreach ( $blog_ids as $blog_id ) {
            switch_to_blog( $blog_id );
            create_table();
            restore_current_blog();
        }
    } else {
        create_table();
    }
}
register_activation_hook( __FILE__, 'on_activate' );

// Creating table whenever a new blog is created
function on_create_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
    if ( is_plugin_active_for_network( 'plugin-name/plugin-name.php' ) ) {
        switch_to_blog( $blog_id );
        create_table();
        restore_current_blog();
    }
}
add_action( 'wpmu_new_blog', 'on_create_blog', 10, 6 );