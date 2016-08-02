<?php

/* Rewrite Rules */
add_action('init', 'makerfaire_rewrite_rules');
function makerfaire_rewrite_rules() {
    add_rewrite_rule( 'maker/entry/(\d*)/?', 'index.php?makerentry=true&eid=$matches[1]', 'top' );

}

/* Query Vars */
add_filter( 'query_vars', 'makerfaire_register_query_var' );
function makerfaire_register_query_var( $vars ) {
    $vars[] = 'makerentry';
    $vars[] = 'eid';
    return $vars;
}
/* Template Include */
add_filter('template_include', 'makerentry_include', 1, 1);
function makerentry_include($template)
{
    global $wp_query; //Load $wp_query object
    $page_value = (isset($wp_query->query_vars['makerentry'])?$wp_query->query_vars['makerentry']:''); 

    if ($page_value && $page_value == "true") { 
        return $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/MiniMakerFaire/page-entry.php'; //Load your template or file
    }

    return $template; //Load normal template when $page_value != "true" as a fallback
}
