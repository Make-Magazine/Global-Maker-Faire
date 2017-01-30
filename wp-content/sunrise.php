<?php
if ( !defined( 'SUNRISE_LOADED' ) )
	define( 'SUNRISE_LOADED', 1 );

if ( defined( 'COOKIE_DOMAIN' ) ) {
	die( 'The constant "COOKIE_DOMAIN" is defined (probably in wp-config.php). Please remove or comment out that define() line.' );
}

$wpdb->dmtable = $wpdb->base_prefix . 'domain_mapping';
$dm_domain = $_SERVER[ 'HTTP_HOST' ];

if( ( $nowww = preg_replace( '|^www\.|', '', $dm_domain ) ) != $dm_domain )
	$where = $wpdb->prepare( 'domain IN (%s,%s)', $dm_domain, $nowww );
else
	$where = $wpdb->prepare( 'domain = %s', $dm_domain );

$wpdb->suppress_errors();
$domain_mapping_id = $wpdb->get_var( "SELECT blog_id FROM {$wpdb->dmtable} WHERE {$where} ORDER BY CHAR_LENGTH(domain) DESC LIMIT 1" );
$wpdb->suppress_errors( false );
if( $domain_mapping_id ) {
	$current_blog = $wpdb->get_row("SELECT * FROM {$wpdb->blogs} WHERE blog_id = '$domain_mapping_id' LIMIT 1");
	$current_blog->domain = $dm_domain;
	$current_blog->path = '/';
	$blog_id = $domain_mapping_id;
	$site_id = $current_blog->site_id;

	define( 'COOKIE_DOMAIN', $dm_domain );

	$current_site = $wpdb->get_row( "SELECT * from {$wpdb->site} WHERE id = '{$current_blog->site_id}' LIMIT 0,1" );
	$current_site->blog_id = $wpdb->get_var( "SELECT blog_id FROM {$wpdb->blogs} WHERE domain='{$current_site->domain}' AND path='{$current_site->path}'" );
	if ( function_exists( 'get_site_option' ) )
		$current_site->site_name = get_site_option( 'site_name' );
	elseif ( function_exists( 'get_current_site_name' ) )
		$current_site = get_current_site_name( $current_site );

	define( 'DOMAIN_MAPPING', 1 );
}

// WPML Sunrise Script - START
// Version 1.0beta
// Place this script in the wp-content folder and add "define('SUNRISE', 'on');" in wp-config.php n order to enable using different domains for different languages in multisite mode
//
// Experimental feature
define('WPML_SUNRISE_MULTISITE_DOMAINS', true);
add_filter('query', 'sunrise_wpml_filter_queries');
function sunrise_wpml_filter_queries($q){
	global $wpdb, $table_prefix, $current_blog;

	static $no_recursion;

	if(empty($current_blog) && empty($no_recursion)){

		$no_recursion = true;

		$domain_found = preg_match("#SELECT \\* FROM {$wpdb->blogs} WHERE domain = '(.*)'#", $q, $matches) || preg_match("#SELECT  blog_id FROM {$wpdb->blogs}  WHERE domain IN \\( '(\S*)' \\)#", $q, $matches);

		if( $domain_found ){

			if(!$wpdb->get_row($q)){

				$icl_blogs = $wpdb->get_col("SELECT blog_id FROM {$wpdb->blogs}");
				foreach($icl_blogs as $blog_id){
					$prefix = $blog_id > 1 ? $table_prefix . $blog_id . '_' : $table_prefix;
					$icl_settings = $wpdb->get_var("SELECT option_value FROM {$prefix}options WHERE option_name='icl_sitepress_settings'");
					if($icl_settings){
						$icl_settings = unserialize($icl_settings);
						if($icl_settings && $icl_settings['language_negotiation_type'] == 2){
							if( in_array( 'http://' . $matches[1], $icl_settings['language_domains'] ) ) {
								$found_blog_id = $blog_id;
								break;
							}
							if( in_array( $matches[1], $icl_settings['language_domains'] ) ) {
								$found_blog_id = $blog_id;
								break;
							}
						}
					}
				}

				if ( isset( $found_blog_id ) && $found_blog_id ) {
					$q = $wpdb->prepare("SELECT * FROM {$wpdb->blogs} WHERE blog_id = %d ", $found_blog_id );
				}
			}

		}

		$no_recursion = false;

	}


	return $q;
}
// WPML Sunrise Script - END
