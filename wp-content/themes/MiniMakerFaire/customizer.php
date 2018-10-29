<?php
// ADD IMAGE, TEXT, and URL (Heading, Subtext, Link) TO FIRST IMAGE IN SEQUENCE
function mmf_customizer_settings( $wp_customize ) {
    $wp_customize->remove_section( 'colors' );
    $wp_customize->remove_control( 'header_image' );
    $wp_customize->remove_section( 'static_front_page' );
    $wp_customize->remove_panel( 'widgets' );


////////////////////////////////////////////////////////////////////
// Header Logo and CTA
////////////////////////////////////////////////////////////////////
    $wp_customize->add_section( 'header_controls', array(
        'title' => 'Logo and CTA Button',
        'priority' => 20,
    ));
    // LOGO
    $wp_customize->add_setting( 'header_logo' );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 'header_logo', array(
            'label'       => __( 'Faire Logo' ),
            'section'     => 'header_controls',
            'settings'    => 'header_logo',
            'description' => 'Use your rectangular Faire logo here.'
        )
    ));

    // BUTTON RADIO
    $wp_customize->add_setting('header_cta_radio', array(
        'default'        => 'value2',
    ));

    $wp_customize->add_control('header_cta_radio', array(
        'label'      => 'Call to Action Button',
        'section'    => 'header_controls',
        'description'   => 'Adds a button in the header to the right of the navigation.<br /><img src="../wp-content/themes/MiniMakerFaire/img/header-with-cta-admin-example.png" class="wp-admin-photo" />',
        'type'       => 'radio',
        'choices'    => array(
            'value1' => 'Show',
            'value2' => 'Hide',
        ),
    ));
    // BUTTON TEXT
    $wp_customize->add_setting( 'header_cta_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_header_cta_text'
    ));
    function sanitize_header_cta_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
    $wp_customize->add_control( 'header_cta_text', array(
        'label'         => __( 'Button text' ),
        'section'       => 'header_controls',
        'settings'      => 'header_cta_text',
        'type'          => 'text'
    ));
    // BUTTON LINK
    $wp_customize->add_setting( 'header_cta_link', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_header_cta_link',
    ));
    function sanitize_header_cta_link( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
    $wp_customize->add_control( 'header_cta_link', array(
        'label'    => __( 'Button URL' ),
        'section'  => 'header_controls',
        'settings' => 'header_cta_link',
        'type'     => 'text',
    ));


////////////////////////////////////////////////////////////////////
// Footer Social Media Links
////////////////////////////////////////////////////////////////////
    $wp_customize->add_section( 'footer_social_media', array(
        'title' => 'Footer Social Media Links',
        'description'   => 'Enter your social media URL\'s to show the icons in the footer. Leave blank to not show the icons.',
        'priority' => 200,
    ));
    // FACEBOOK LINK
    $wp_customize->add_setting( 'facebook_link', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_facebook_link',
    ));
    function sanitize_facebook_link( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
    $wp_customize->add_control( 'facebook_link', array(
        'label'    => __( 'Facebook URL' ),
        'section'  => 'footer_social_media',
        'settings' => 'facebook_link',
        'type'     => 'url',
    ));
    // TWITTER LINK
    $wp_customize->add_setting( 'twitter_link', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_twitter_link',
    ));
    function sanitize_twitter_link( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
    $wp_customize->add_control( 'twitter_link', array(
        'label'    => __( 'Twitter URL' ),
        'section'  => 'footer_social_media',
        'settings' => 'twitter_link',
        'type'     => 'url',
    ));
    // INSTAGRAM LINK
    $wp_customize->add_setting( 'instagram_link', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_instagram_link',
    ));
    function sanitize_instagram_link( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
    $wp_customize->add_control( 'instagram_link', array(
        'label'    => __( 'Instagram URL' ),
        'section'  => 'footer_social_media',
        'settings' => 'instagram_link',
        'type'     => 'url',
    ));
    // PINTREST LINK
    $wp_customize->add_setting( 'pintrest_link', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_pintrest_link',
    ));
    function sanitize_pintrest_link( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
    $wp_customize->add_control( 'pintrest_link', array(
        'label'    => __( 'Pinterest URL' ),
        'section'  => 'footer_social_media',
        'settings' => 'pintrest_link',
        'type'     => 'url',
    ));

////////////////////////////////////////////////////////////////////
// Additional Scripts
////////////////////////////////////////////////////////////////////
    $wp_customize->add_section( 'additional_scripts', array(
        'title' => 'Additional Scripts',
        'description'   => 'If you have 3rd party scripts, like Google Analytics, that require you to paste them into the header or footer, you can do that here. Be careful to copy and paste them correctly otherwise it could have negative affects on other parts of the site.',
        'priority' => 300,
    ));
    // HEADER SCRIPTS
    $wp_customize->add_setting( 'header_scripts', array(
        'default'           => ''
    ));
    $wp_customize->add_control( 'header_scripts', array(
        'label'         => __( 'Enter any scripts that need to be placed in the header here.' ),
        'section'       => 'additional_scripts',
        'settings'      => 'header_scripts',
        'type'          => 'textarea'
    ));
    // FOOTER SCRIPTS
    $wp_customize->add_setting( 'footer_scripts', array(
        'default'           => ''
    ));
    $wp_customize->add_control( 'footer_scripts', array(
        'label'         => __( 'Enter any scripts that need to be placed in the footer here.' ),
        'section'       => 'additional_scripts',
        'settings'      => 'footer_scripts',
        'type'          => 'textarea'
    ));
}
add_action( 'customize_register', 'mmf_customizer_settings' );
?>
