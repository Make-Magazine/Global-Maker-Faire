jQuery( ".sponsors-admin .acf-field-repeater .acf-button" ).html( "Add New Sponsor" );

//Add inactive class(grey out) to panels that are set to inactive
jQuery('.activeinactive input[value=hide]:checked').closest('.layout').addClass('acfInactive');
jQuery('.activeinactive input[value=Inactive]:checked').closest('.layout').addClass('acfInactive');

//Admin/customizer change site icont text
jQuery(function() {
  jQuery( "#customize-control-site_icon .customize-control-description" ).after( "<span>Please upload your square Google+ logo here.</span>" );
  //Remove Menu section from customizer
  //jQuery( '.control-panel-nav_menus' ).hide();

  // Move the Yoast SEO panel to the last position
  jQuery('#normal-sortables').append(jQuery('#wpseo_meta'));
});