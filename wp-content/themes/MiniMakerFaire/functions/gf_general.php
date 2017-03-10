<?php
/* This function searches the database to see if any of the image overrides are set in the gravity form
 * If it is, it retrieves the value set for that override
 * Field ID         Description
 * 324              Image Override 1
 * 334              Image Override 1 place
 * 326              Image Override 2
 * 338              Image Override 2 place
 * 333              Image Override 2
 * 337              Image Override 3 place
 * 332              Image Override 4
 * 336              Image Override 4 place
 * 331              Image Override 5
 * 335              Image Override 5 place
 */
function findOverride($entry_id, $type){
    global $wpdb;
    if($entry_id!=''){
        $sql = "select * from {$wpdb->prefix}rg_lead_detail as detail join "
                . "             (SELECT lead_id,field_number FROM `{$wpdb->prefix}rg_lead_detail` "
                . "                 WHERE `lead_id` = $entry_id AND `field_number` BETWEEN 334.0 and 338.9 AND `value` = '$type' "
                . "                 ORDER BY `{$wpdb->prefix}rg_lead_detail`.`field_number` ASC limit 1) "
                . "             as override on detail.lead_id = override.lead_id "
                . "         where   (detail.field_number = 331 and override.field_number between 335.0 and 335.9999) or "
                . "                 (detail.field_number = 332 and override.field_number between 336.0 and 336.9999) or "
                . "                 (detail.field_number = 333 and override.field_number between 337.0 and 337.9999) or "
                . "                 (detail.field_number = 330 and override.field_number between 338.0 and 338.9999) or "
                . "                 (detail.field_number = 329 and override.field_number between 334.0 and 334.9999)";
        $results = $wpdb->get_results($sql);
        if($wpdb->num_rows > 0){
            return $results[0]->value;
        }
    }
    return '';
}

/**
 * Returns the URL to an image resized and cropped to the given dimensions.
 *
 * You can use this image URL directly -- it's cached and such by our servers.
 * Please use this function to generate the URL rather than doing it yourself as
 * this function uses staticize_subdomain() makes it serve off our CDN network.
 *
 * Somewhat contrary to the function's name, it can be used for ANY image URL, hosted by us or not.
 * So even though it says "remote", you can use it for attachments hosted by us, etc.
 *
 * @link http://vip.wordpress.com/documentation/image-resizing-and-cropping/ Image Resizing And Cropping
 * @param string $url The raw URL to the image (URLs that redirect are currently not supported with the exception of http://foobar.wordpress.com/files/ type URLs)
 * @param int $width The desired width of the final image
 * @param int $height The desired height of the final image
 * @param bool $escape Optional. If true (the default), the URL will be run through esc_url(). Set this to false if you need the raw URL.
 * @return string
 */
function legacy_get_resized_remote_image_url( $url, $width, $height, $escape = true ) {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) :
	$width = (int) $width;
	$height = (int) $height;

	// Photon doesn't support redirects, so help it out by doing http://foobar.wordpress.com/files/ to http://foobar.files.wordpress.com/
	if ( function_exists( 'new_file_urls' ) )
		$url = new_file_urls( $url );

    $args = array(
      'resize' => array( $width, $height ),
      'strip' => 'all',
    );
    $thumburl = jetpack_photon_url( $url, $args );

	return ( $escape ) ? esc_url( $thumburl ) : $thumburl;
	else:
  return $url;  
  endif;
}
function legacy_get_fit_remote_image_url( $url, $width, $height, $escape = true ) {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) :
	$width = (int) $width;
	$height = (int) $height;

	// Photon doesn't support redirects, so help it out by doing http://foobar.wordpress.com/files/ to http://foobar.files.wordpress.com/
	if ( function_exists( 'new_file_urls' ) )
		$url = new_file_urls( $url );

    $args = array(
      'fit' => array( $width, $height ),
      'strip' => 'all',
    );
	$thumburl = jetpack_photon_url( $url, $args );

	return ( $escape ) ? esc_url( $thumburl ) : $thumburl;
  else:
  return $url;  
  endif;
}

/**
 *  Check if input string is a valid YouTube URL
 *  and try to extract the YouTube Video ID from it.
 *  @author  Stephan Schmitz <eyecatchup@gmail.com>
 *  @param   $url   string   The string that shall be checked.
 *  @return  mixed           Returns YouTube Video ID, or (boolean) false.
 */
function parse_yturl($url)
{
    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

/**
 * Adding code to change out options on adding a new form to explain issues around adding new forms
 */
add_action( 'gform_new_form_button', 'new_form_button' );
function new_form_button( $button ) {
        return '<div style="margin-top: -35px;margin-bottom: 15px;">Warning: <strong>DO NOT</strong> create a new Call for Makers application using this feature. To create your Call for Makers, duplicate and edit the Sample form we provided, or duplicate one of your previous forms that originated with the Sample form we provided.</div>
</script>
<style> label[for=new_form_description]{ display:none; } #new_form_description { display: none; }</style>
	<input id="save_new_form" type="button" class="button button-large button-primary" value="I Understand, Create Form" onclick="saveNewForm();" tabindex="9002">';
    }
    