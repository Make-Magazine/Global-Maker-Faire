<?php
// Create new categories for our blocks

function make_panels( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'make-panels',
				'title' => __( 'Make Panels', 'make-panels' ),
			),
		)
	);
}
add_filter( 'block_categories', 'make_panels', 10, 2);

add_action('acf/init', 'make_add_acf_blocks');

function make_add_acf_blocks() {

    // check function exists
    if (function_exists('acf_register_block')) {

        acf_register_block(array(
            'name' => 'buy_tickets_float',
            'title' => __('Get Tickets Floating Banner'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('buy', 'tickets', 'panel'),
        ));

        acf_register_block(array(
            'name' => 'featured_makers_panel',
            'title' => __('Featured Makers (Square images)'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('featured', 'makers', 'square', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'featured_makers_panel_dynamic',
            'title' => __('Featured Makers (Square images) - Dynamic panel'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('featured', 'makers', 'square', 'dynamic', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'featured_makers_panel_circle',
            'title' => __('Featured Makers (Circle images)'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('featured', 'makers', 'circle', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'featured_makers_panel_circle_dynamic',
            'title' => __('Featured Makers (Circle images) - Dynamic Panel'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('featured', 'makers', 'circle', 'dynamic', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'featured_events',
            'title' => __('Featured Events'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('featured', 'events', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'featured_events_dynamic',
            'title' => __('Featured Events - Dynamic Panel'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('featured', 'events', 'dynamic', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'post_feed',
            'title' => __('News / Post Feed'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('featured', 'events', 'dynamic', 'panel'),
        ));
        /*
          acf_register_block(array(
          'name'				=> '1_column',
          'title'				=> __('1 Column'),
          'render_callback'                => 'call_ACF_block_panels',
          'category'			=> 'formatting',
          'icon'				=> 'admin-comments',
          'keywords'			=> array( '1', 'column', 'panel'),
          ));
          acf_register_block(array(
          'name'				=> '3_column',
          'title'				=> __('3 Columns'),
          'render_callback'                => 'call_ACF_block_panels',
          'category'			=> 'formatting',
          'icon'				=> 'admin-comments',
          'keywords'			=> array( '3', 'column', 'panel'),
          ));
          acf_register_block(array(
          'name'				=> '2_column_photo_and_text_panel',
          'title'				=> __('2 Columns - Photo and Text'),
          'render_callback'                => 'call_ACF_block_panels',
          'category'			=> 'formatting',
          'icon'				=> 'admin-comments',
          'keywords'			=> array( '2', 'column','photo','text', 'panel'),
          )); */
        acf_register_block(array(
            'name' => 'what_is_maker_faire',
            'title' => __('What is Maker Faire'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('maker', 'faire', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'call_to_action_panel',
            'title' => __('Call to Action'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('call', 'action', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'call_to_action',
            'title' => __('Call to Action Text'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('call', 'action', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'static_or_carousel',
            'title' => __('Image Carousel (Rectangle)'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('image', 'carousel', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'square_image_carousel',
            'title' => __('Image Carousel (Square)'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('image', 'carousel', 'panel', 'square'),
        ));
        acf_register_block(array(
            'name' => 'newsletter_panel',
            'title' => __('Newsletter Sign Up'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('newsletter', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'sponsors_panel',
            'title' => __('Sponsors'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('sponsors', 'panel'),
        ));
        acf_register_block(array(
            'name' => 'social_media',
            'title' => __('Social Media'),
            'render_callback' => 'call_ACF_block_panels',
            'category' => 'make-panels',
            'icon' => 'admin-comments',
            'mode' => 'auto',
            'keywords' => array('social', 'media', 'panel'),
        ));
    }
}

function call_ACF_block_panels($block) {
    GLOBAL $acf_blocks;
    $acf_blocks = TRUE;
    $name =  str_replace("acf/","",$block['name']);
    $name =  str_replace("-","_",$name);
    echo ($name !=''?dispLayout($name):'');
} 
