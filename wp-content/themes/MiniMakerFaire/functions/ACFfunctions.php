<?php
/* This code hides the ACF menu from everyone but super admins. */
add_filter('acf/settings/show_admin', 'my_acf_show_admin');

function my_acf_show_admin($show) {
   if (is_super_admin()) {
      return true;
   } else {
      return false;
   }
   
}

/*
 * Please paste PHP code below this that is generated using Custom Fields-> Tools -> Export Field Groups
 * Toggle all field groups and click 'Generate Export Code'
 */
if (function_exists('acf_add_local_field_group')) {
   
   acf_add_local_field_group(array(
      'key' => 'group_571002e8e1ecf',
      'title' => '"Become a Sponsor" Button',
      'fields' => array(
         array(
            'default_value' => '',
            'placeholder' => '',
            'key' => 'field_5710032012da2',
            'label' => 'URL',
            'name' => 'become_sponsor_url',
            'type' => 'url',
            'instructions' => 'If you enter a URL here, the "Become a Sponsor" button will show on the Sponsors page and in the Sponsors Slider. Or leave field empty to not show button.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => ''
            )
         )
      ),
      'location' => array(
         array(
            array(
               'param' => 'page_template',
               'operator' => '==',
               'value' => 'page-sponsors.php'
            )
         )
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => array(
         0 => 'the_content',
         1 => 'excerpt',
         2 => 'custom_fields',
         3 => 'discussion',
         4 => 'comments',
         5 => 'slug',
         6 => 'categories',
         7 => 'tags',
         8 => 'send-trackbacks'
      ),
      'active' => 1,
      'description' => '',
      'local' => 'json',
      'modified' => 1469037348
   ));
   
   acf_add_local_field_group(
      // Contact Page
      array(
         'key' => 'group_5748da1c25e54',
         'title' => 'Contact Page',
         'fields' => array(
            array(
               'placement' => 'top',
               'endpoint' => 0,
               'key' => 'field_5748dc2d20a4b',
               'label' => 'Page Title and Description',
               'name' => '',
               'type' => 'tab',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'default_value' => '',
               'maxlength' => '',
               'placeholder' => '',
               'prepend' => '',
               'append' => '',
               'key' => 'field_5748da8ee8f57',
               'label' => 'Page Title',
               'name' => 'page_title',
               'type' => 'text',
               'instructions' => 'This is the title shown at the top of the page.',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               ),
               'readonly' => 0,
               'disabled' => 0
            ),
            array(
               'tabs' => 'all',
               'toolbar' => 'full',
               'media_upload' => 1,
               'default_value' => '',
               'delay' => 0,
               'key' => 'field_5748db3ce8f58',
               'label' => 'Content/decription',
               'name' => 'contentdecription',
               'type' => 'wysiwyg',
               'instructions' => 'Paragraph text or other content can go here.',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'placement' => 'top',
               'endpoint' => 1,
               'key' => 'field_5748dcb820a4d',
               'label' => 'Contact Info',
               'name' => '',
               'type' => 'tab',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'default_value' => '',
               'new_lines' => 'wpautop',
               'maxlength' => '',
               'placeholder' => '',
               'rows' => 5,
               'key' => 'field_5748dd451aa78',
               'label' => 'Address',
               'name' => 'contact_address',
               'type' => 'textarea',
               'instructions' => 'Add the contact address for the faire or an individual here.
<br />i.e.	"Carl Schurz High School<br />
3601 Milwaukee Ave<br />
Chicago, IL 60641"',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               ),
               'readonly' => 0,
               'disabled' => 0
            ),
            array(
               'default_value' => '',
               'new_lines' => 'wpautop',
               'maxlength' => '',
               'placeholder' => '',
               'rows' => 4,
               'key' => 'field_5748debc1aa79',
               'label' => 'Phone',
               'name' => 'phone',
               'type' => 'textarea',
               'instructions' => 'Add 1 or more phone numbers on separate lines here.
<br />i.e. "415 432 6789<br />
510 456 9045"',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               ),
               'readonly' => 0,
               'disabled' => 0
            ),
            array(
               'default_value' => '',
               'new_lines' => 'wpautop',
               'maxlength' => '',
               'placeholder' => '',
               'rows' => 4,
               'key' => 'field_5748df271aa7a',
               'label' => 'Email',
               'name' => 'email',
               'type' => 'textarea',
               'instructions' => 'Add 1 or more email addresses on separate lines here.
<br/>i.e. "maker@makermedia.com<br />
contact@makermedia.com"',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               ),
               'readonly' => 0,
               'disabled' => 0
            ),
            array(
               'placement' => 'top',
               'endpoint' => 0,
               'key' => 'field_5748e0b3a79e8',
               'label' => 'Social Media Icons',
               'name' => '',
               'type' => 'tab',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'message' => '',
               'esc_html' => 0,
               'new_lines' => 'wpautop',
               'key' => 'field_5748e0c9a79e9',
               'label' => 'Paste in the URL\'s for each social media icon you would like to show on this contact page. Adding a URL will show the icon, leave blank to hide.',
               'name' => '',
               'type' => 'message',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'default_value' => '',
               'placeholder' => '',
               'key' => 'field_5748e12ba79ea',
               'label' => 'Facebook',
               'name' => 'facebook',
               'type' => 'url',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'default_value' => '',
               'placeholder' => '',
               'key' => 'field_5748e13ba79eb',
               'label' => 'Twitter',
               'name' => 'twitter',
               'type' => 'url',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'default_value' => '',
               'placeholder' => '',
               'key' => 'field_5748e145a79ec',
               'label' => 'Instagram',
               'name' => 'instagram',
               'type' => 'url',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'default_value' => '',
               'placeholder' => '',
               'key' => 'field_5748e14fa79ed',
               'label' => 'Pinterest',
               'name' => 'pinterest',
               'type' => 'url',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'placement' => 'top',
               'endpoint' => 0,
               'key' => 'field_5748f0bddfd11',
               'label' => 'Contact Form',
               'name' => '',
               'type' => 'tab',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'default_value' => '',
               'placeholder' => '',
               'prepend' => '',
               'append' => '',
               'key' => 'field_5748f056ddc77',
               'label' => 'Contact Form Email Address',
               'name' => 'contact_form_email_address',
               'type' => 'email',
               'instructions' => 'Enter an email address here that the contact form will send to. Leave blank to hide the contact form.',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'placement' => 'top',
               'endpoint' => 1,
               'key' => 'field_5748f107a6d2d',
               'label' => 'Team Members',
               'name' => '',
               'type' => 'tab',
               'instructions' => '',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            ),
            array(
               'default_value' => '',
               'maxlength' => '',
               'placeholder' => '',
               'prepend' => '',
               'append' => '',
               'key' => 'field_574b86119abe2',
               'label' => 'Title Above Team Members',
               'name' => 'title_above_team_members',
               'type' => 'text',
               'instructions' => 'i.e. "Here is our team" or "Team Members"',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               ),
               'readonly' => 0,
               'disabled' => 0
            ),
            array(
               'sub_fields' => array(
                  array(
                     'return_format' => 'array',
                     'preview_size' => 'thumbnail',
                     'library' => 'all',
                     'min_width' => '',
                     'min_height' => '',
                     'min_size' => '',
                     'max_width' => '',
                     'max_height' => '',
                     'max_size' => '',
                     'mime_types' => '',
                     'key' => 'field_5748f247a6d2f',
                     'label' => 'Photo',
                     'name' => 'photo',
                     'type' => 'image',
                     'instructions' => '',
                     'required' => 1,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     )
                  ),
                  array(
                     'default_value' => '',
                     'maxlength' => 20,
                     'placeholder' => '',
                     'prepend' => '',
                     'append' => '',
                     'key' => 'field_5748f282a6d30',
                     'label' => 'Name',
                     'name' => 'name',
                     'type' => 'text',
                     'instructions' => '20 character limit',
                     'required' => 1,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     ),
                     'readonly' => 0,
                     'disabled' => 0
                  ),
                  array(
                     'default_value' => '',
                     'new_lines' => '',
                     'maxlength' => 80,
                     'placeholder' => '',
                     'rows' => 2,
                     'key' => 'field_5748f2e8a6d31',
                     'label' => 'Short Description',
                     'name' => 'short_description',
                     'type' => 'textarea',
                     'instructions' => 'Job title, phone number, and/or description goes here. 80 character limit.',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     ),
                     'readonly' => 0,
                     'disabled' => 0
                  ),
                  array(
                     'message' => 'Paste social media URL\'s or email address here to show the icons.',
                     'esc_html' => 0,
                     'new_lines' => 'wpautop',
                     'key' => 'field_5748f3a6a6d32',
                     'label' => 'Social Media and Email Icons',
                     'name' => '',
                     'type' => 'message',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     )
                  ),
                  array(
                     'default_value' => '',
                     'placeholder' => '',
                     'key' => 'field_5748f499a6d33',
                     'label' => 'Facebook',
                     'name' => 'facebook',
                     'type' => 'url',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     )
                  ),
                  array(
                     'default_value' => '',
                     'placeholder' => '',
                     'key' => 'field_5748f4a9a6d34',
                     'label' => 'Twitter',
                     'name' => 'twitter',
                     'type' => 'url',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     )
                  ),
                  array(
                     'default_value' => '',
                     'placeholder' => '',
                     'key' => 'field_5748f4b2a6d35',
                     'label' => 'Instagram',
                     'name' => 'instagram',
                     'type' => 'url',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     )
                  ),
                  array(
                     'default_value' => '',
                     'placeholder' => '',
                     'key' => 'field_5748f4e9a6d36',
                     'label' => 'Pinterest',
                     'name' => 'pinterest',
                     'type' => 'url',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     )
                  ),
                  array(
                     'default_value' => '',
                     'placeholder' => '',
                     'key' => 'field_5748f4f3a6d39',
                     'label' => 'LinkedIn',
                     'name' => 'linkedin',
                     'type' => 'url',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     )
                  ),
                  array(
                     'default_value' => '',
                     'placeholder' => '',
                     'prepend' => '',
                     'append' => '',
                     'key' => 'field_5748f50fa6d38',
                     'label' => 'Email Address',
                     'name' => 'email_address',
                     'type' => 'email',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     )
                  ),
                  array(
                     'default_value' => '',
                     'placeholder' => '',
                     'key' => 'field_574e12deeb59f',
                     'label' => 'Website',
                     'name' => 'website',
                     'type' => 'url',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => ''
                     )
                  )
               ),
               'min' => 0,
               'max' => 0,
               'layout' => 'table',
               'button_label' => 'Add New Team Member',
               'collapsed' => '',
               'key' => 'field_5748f125a6d2e',
               'label' => 'Add each team member with photo/description/contact/social media',
               'name' => 'list_of_team_members',
               'type' => 'repeater',
               'instructions' => 'Click the "Add New Team Member" button for each new entry.',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            )
         ),
         'location' => array(
            array(
               array(
                  'param' => 'page_template',
                  'operator' => '==',
                  'value' => 'page-contact.php'
               )
            )
         ),
         'menu_order' => 0,
         'position' => 'acf_after_title',
         'style' => 'default',
         'label_placement' => 'top',
         'instruction_placement' => 'label',
         'hide_on_screen' => array(
            0 => 'the_content'
         ),
         'active' => 1,
         'description' => '',
         'local' => 'php'
      ));
   
   acf_add_local_field_group(array(
      'key' => 'group_5717cb72bbe00',
      'title' => 'Home page Image Carousel',
      'fields' => array(
         array(
            'default_value' => '',
            'maxlength' => 40,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'key' => 'field_5717cbc5ab83c',
            'label' => 'Faire Location Text',
            'name' => 'faire_location',
            'type' => 'text',
            'instructions' => 'Enter the faire location here in this format: "Schurz High School, Chicago, IL". 40 character limit.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => 40,
               'class' => '',
               'id' => ''
            ),
            'readonly' => 0,
            'disabled' => 0
         ),
         array(
            'default_value' => '',
            'maxlength' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'key' => 'field_59e4ad89ad717',
            'label' => 'Faire Location URL',
            'name' => 'faire_location_url',
            'type' => 'url',
            'instructions' => 'Optional - Turn the faire location text into a link by adding a url for google maps or another location url for the event.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => 40,
               'class' => '',
               'id' => ''
            ),
            'readonly' => 0,
            'disabled' => 0
         ),
         array(
            'default_value' => 0,
            'placeholder' => '',
            'key' => 'field_59f07df43e1a3',
            'label' => 'Open Faire Location URL In New Tab?',
            'name' => 'open_faire_location',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => 20,
               'class' => '',
               'id' => ''
            )
         ),
         array(
            'default_value' => '',
            'maxlength' => 30,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'key' => 'field_5717d315ab83d',
            'label' => 'Faire Date',
            'name' => 'faire_date',
            'type' => 'text',
            'instructions' => 'Enter the faire date here in this format: "Saturday, May 7, 2016" or "Sat - Sun, May 7 & 8, 2016". 30 character limit.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => ''
            ),
            'readonly' => 0,
            'disabled' => 0
         ),
         array(
            'message' => 'To update logo go to Appearance > Customize > Logo & CTA Button',
            'esc_html' => 0,
            'new_lines' => 'wpautop',
            'key' => 'field_577461b6d0275',
            'label' => 'Logo',
            'name' => '',
            'type' => 'message',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => ''
            )
         ),
         array(
            'default_value' => '',
            'maxlength' => 30,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'key' => 'field_5717d3a5ab83e',
            'label' => 'Call to Action Text',
            'name' => 'call_to_action_text',
            'type' => 'text',
            'instructions' => 'Optional call to action title that will show below the logo. i.e. "Call for Makers is Open!" or "Tickets are on Sale Now!". 30 character limit.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => 50,
               'class' => '',
               'id' => ''
            ),
            'readonly' => 0,
            'disabled' => 0
         ),
         array(
            'default_value' => '',
            'placeholder' => '',
            'key' => 'field_5727a1fa9442b',
            'label' => 'Call to Action Text URL',
            'name' => 'call_to_action_text_url',
            'type' => 'url',
            'instructions' => 'Optional - Add a URL here that will link the call to action text field to a URL.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => 50,
               'class' => '',
               'id' => ''
            )
         ),
         array(
            'library' => 'all',
            'min' => 1,
            'max' => 3,
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
            'insert' => 'append',
            'key' => 'field_5717d4a1aa89a',
            'label' => 'Image Carousel',
            'name' => 'image_carousel',
            'type' => 'gallery',
            'instructions' => 'Up to 3 images can be added. Carousel images will be centered and sized at 850px wide by 318px hieght.',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => 'home-image-carousel-admin',
               'id' => ''
            ),
            'preview_size' => 'thumbnail'
         )
      ),
      'location' => array(
         array(
            array(
               'param' => 'page_template',
               'operator' => '==',
               'value' => 'page-home.php'
            )
         )
      ),
      'menu_order' => 0,
      'position' => 'acf_after_title',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => array(
         0 => 'permalink',
         1 => 'the_content',
         2 => 'excerpt',
         3 => 'custom_fields',
         4 => 'discussion',
         5 => 'comments',
         6 => 'slug',
         7 => 'format',
         8 => 'categories',
         9 => 'tags',
         10 => 'send-trackbacks'
      ),
      'active' => 1,
      'description' => '',
      'modified' => 1467245199,
      'local' => 'json'
   ));
   
   acf_add_local_field_group(array(
      'key' => 'group_5722946eeee09',
      'title' => 'Meet the Makers',
      'fields' => array(
         array(
            'key' => 'field_57a126f5e7350',
            'label' => 'Display data from these forms:',
            'name' => 'form_id',
            'type' => 'text',
            'instructions' => 'Enter one or more Form IDs here. If you add more than one id, separate each with a comma, ie: 1,3
<br>
You can find the Form IDs in Forms > Forms > ID column.',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => ''
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => ''
         ),
         array(
            'key' => 'field_59b1a8e73002c',
            'label' => 'No Makers Found text',
            'name' => 'no_makers_found_text',
            'type' => 'text',
            'instructions' => 'Text displayed when no makers are set. Defaults to \'No Makers Found\'',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => ''
            ),
            'default_value' => 'No Makers Found',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => ''
         )
      ),
      'location' => array(
         array(
            array(
               'param' => 'page_template',
               'operator' => '==',
               'value' => 'page-meet-the-makers.php'
            )
         )
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => array(
         0 => 'permalink',
         1 => 'the_content',
         2 => 'excerpt',
         3 => 'custom_fields',
         4 => 'discussion',
         5 => 'comments',
         6 => 'slug',
         7 => 'format',
         8 => 'categories',
         9 => 'tags',
         10 => 'send-trackbacks'
      ),
      'active' => 1,
      'description' => ''
   ));
   
   acf_add_local_field_group(
      array(
         'key' => 'group_573b526e78706',
         'title' => 'Panels: Use these instead of entering text into the window above for increased functionality and flexibility.',
         'fields' => array(
            array(
               'layouts' => array(
                  // Panels for Posts
                  array(
                     'key' => '57196b4f7c508',
                     'name' => 'what_is_maker_faire',
                     'label' => 'What is Maker Faire',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'show',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_57196b4f7c509',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'This adds an uneditable text panel with information about Maker Faires.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => 1
                  ),
                  // Newsletter Sign Up
                  array(
                     'key' => '572d8358fe8e1',
                     'name' => 'newsletter_panel',
                     'label' => 'Newsletter Sign Up',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'show',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_572d8358fe8e2',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'This adds an email sign up form for newsletter subscriptions.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Makers (Square images)
                  array(
                     'key' => '56fc6f9fdc4a2',
                     'name' => 'featured_makers_panel',
                     'label' => 'Featured Makers (Square images)',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727a9191b209',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 28,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_56fcb5958152f',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 28 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5719832407ae9',
                           'label' => 'Amount of Makers to show',
                           'name' => 'makers_to_show',
                           'type' => 'radio',
                           'instructions' => 'Show 4 Makers or 8 makers',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_56fc70e8dc4a4',
                                 'label' => 'Maker Image',
                                 'name' => 'maker_image',
                                 'type' => 'image',
                                 'instructions' => 'Featured Maker Images are best when square sizes around 500px by 500px.',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 19,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_56fc7172dc4a5',
                                 'label' => 'Maker Name',
                                 'name' => 'maker_name',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 24 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 100,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_56fc71a0dc4a6',
                                 'label' => 'Maker Short Description',
                                 'name' => 'maker_short_description',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 100 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              )
                           ),
                           'min' => 0,
                           'max' => 8,
                           'layout' => 'table',
                           'button_label' => 'Add New Maker',
                           'collapsed' => '',
                           'key' => 'field_56fc6fc3dc4a3',
                           'label' => 'Featured Makers',
                           'name' => 'featured_makers',
                           'type' => 'repeater',
                           'instructions' => 'Adds a panel for 1 row of 4 makers or 2 rows of 4 makers. Each maker features an image, name, and short description. Start by clicking the "Add New Maker" button for each featured maker to show in this panel.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_571ab19c2e7ed',
                           'label' => '"More Makers" button',
                           'name' => 'more_makers_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more makers. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Blue' => 'Blue',
                              'Red' => 'Red'
                           ),
                           'default_value' => 'Blue',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727eedc044ee',
                           'label' => 'Background Color',
                           'name' => 'background_color',
                           'type' => 'radio',
                           'instructions' => 'Background color of this panel. Choose blue or red.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Makers (Square images) ===== DYNAMIC PANEL
                  array(
                     'key' => '579924c93c2c0',
                     'name' => 'featured_makers_panel_dynamic',
                     'label' => 'Featured Makers (Square images) ===== DYNAMIC PANEL',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93c2cb',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 28,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579924c93c2cc',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 28 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'min' => '',
                           'max' => '',
                           'step' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579925463c2e0',
                           'label' => 'Enter formid here',
                           'name' => 'enter_formid_here',
                           'type' => 'number',
                           'instructions' => 'Enter the form to pull featured individuals from. They must have the \'Featured Maker\' flag set to be pulled in.',
                           'required' => 1,
                           'conditional_logic' => '',
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'On' => 'On',
                              'Off' => 'Off'
                           ),
                           'default_value' => 'On',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93c2ce',
                           'label' => 'Randomly pull Accepted',
                           'name' => 'pull_accepted',
                           'type' => 'radio',
                           'instructions' => 'Pull Project images randomly from Accepted entries if no Featured Maker flags are set?',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93c2cd',
                           'label' => 'Amount of Makers to show',
                           'name' => 'makers_to_show',
                           'type' => 'radio',
                           'instructions' => 'Show 4 Makers or 8 makers',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_579924c93c2d3',
                           'label' => '"More Makers" button',
                           'name' => 'more_makers_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more makers. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Blue' => 'Blue',
                              'Red' => 'Red'
                           ),
                           'default_value' => 'Blue',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93c2d4',
                           'label' => 'Background Color',
                           'name' => 'background_color',
                           'type' => 'radio',
                           'instructions' => 'Background color of this panel. Choose blue or red.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Makers (Circle images)
                  array(
                     'key' => '573e3efd8e814',
                     'name' => 'featured_makers_panel_circle',
                     'label' => 'Featured Makers (Circle images)',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573e3efd8e815',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 28,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_573e3efd8e816',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 28 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573e3efd8e817',
                           'label' => 'Amount of Makers to show',
                           'name' => 'makers_to_show',
                           'type' => 'radio',
                           'instructions' => 'Show 4 Makers or 8 makers',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_573e3efd8e819',
                                 'label' => 'Maker Image',
                                 'name' => 'maker_image',
                                 'type' => 'image',
                                 'instructions' => 'Featured Maker Images are best when square sizes around 500px by 500px.',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 19,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e3efd8e81a',
                                 'label' => 'Maker Name',
                                 'name' => 'maker_name',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 24 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 100,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e3efd8e81b',
                                 'label' => 'Maker Short Description',
                                 'name' => 'maker_short_description',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 100 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              )
                           ),
                           'min' => 0,
                           'max' => 8,
                           'layout' => 'table',
                           'button_label' => 'Add New Maker',
                           'collapsed' => '',
                           'key' => 'field_573e3efd8e818',
                           'label' => 'Featured Makers',
                           'name' => 'featured_makers',
                           'type' => 'repeater',
                           'instructions' => 'Adds a panel for 1 row of 4 makers or 2 rows of 4 makers. Each maker features an image, name, and short description. Start by clicking the "Add New Maker" button for each featured maker to show in this panel.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_573e3efd8e81c',
                           'label' => '"More Makers" button',
                           'name' => 'more_makers_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more makers. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Makers (Circle images) ===== DYNAMIC PANEL
                  array(
                     'key' => '579925053c2d5',
                     'name' => 'featured_makers_panel_circle_dynamic',
                     'label' => 'Featured Makers (Circle images) ===== DYNAMIC PANEL',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579925053c2d6',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 28,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579925053c2d7',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 28 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'min' => '',
                           'max' => '',
                           'step' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579926253c2eb',
                           'label' => 'Enter formid here',
                           'name' => 'enter_formid_here',
                           'type' => 'number',
                           'instructions' => 'Enter the form to pull featured individuals from. They must have the \'Featured Maker\' flag set to be pulled in.',
                           'required' => 1,
                           'conditional_logic' => '',
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'On' => 'On',
                              'Off' => 'Off'
                           ),
                           'default_value' => 'On',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93c2cf',
                           'label' => 'Randomly pull Accepted',
                           'name' => 'pull_accepted',
                           'type' => 'radio',
                           'instructions' => 'Pull Project images randomly from Accepted entries if no Featured Maker flags are set?',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579925053c2d8',
                           'label' => 'Amount of Makers to show',
                           'name' => 'makers_to_show',
                           'type' => 'radio',
                           'instructions' => 'Show 4 Makers or 8 makers',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_579925053c2de',
                           'label' => '"More Makers" button',
                           'name' => 'more_makers_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more makers. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Events
                  array(
                     'key' => '573e4bc7b6659',
                     'name' => 'featured_events',
                     'label' => 'Featured Events',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573e4bc7b665a',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 40,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_573e4bc7b665b',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 40 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_573e4bc7b665e',
                                 'label' => 'Event Image',
                                 'name' => 'event_image',
                                 'type' => 'image',
                                 'instructions' => 'Featured Event Images are best when square sizes around 500px by 500px.',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 28,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e55385fe8f',
                                 'label' => 'Day of the Week',
                                 'name' => 'day',
                                 'type' => 'text',
                                 'instructions' => 'Indicate day or days of the week. i.e. "Saturday" or "Saturday & Sunday"',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 19,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e4bc7b665f',
                                 'label' => 'Event Name',
                                 'name' => 'event_name',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 24 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 100,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e4bc7b6660',
                                 'label' => 'Event Short Description',
                                 'name' => 'event_short_description',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 100 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 51,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e4d30b6662',
                                 'label' => 'Time',
                                 'name' => 'time',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 30 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 30,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e4d59b6663',
                                 'label' => 'Location/Stage',
                                 'name' => 'location',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 30 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              )
                           ),
                           'min' => 0,
                           'max' => 4,
                           'layout' => 'table',
                           'button_label' => 'Add New Event',
                           'collapsed' => '',
                           'key' => 'field_573e4bc7b665d',
                           'label' => 'Featured Events',
                           'name' => 'featured_events',
                           'type' => 'repeater',
                           'instructions' => 'Adds a panel for 4 featured events/exhibits. Each event has an image, name, short description, time, and location/stage. Start by clicking the "Add New Event" button for each featured event in this panel.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_573e4bc7b6661',
                           'label' => '"All Events" button',
                           'name' => 'all_events_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more events. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  array(
                     'key' => '579925163c2df',
                     'name' => 'featured_events_dynamic',
                     'label' => 'Featured Events ===== DYNAMIC PANEL',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579925163c2dg',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 40,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579925163c2e1',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 40 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'min' => '',
                           'max' => '',
                           'step' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579926323c2ec',
                           'label' => 'Enter formid here',
                           'name' => 'enter_formid_here',
                           'type' => 'number',
                           'instructions' => 'Enter the form to pull featured events from.',
                           'required' => 1,
                           'conditional_logic' => '',
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_579925163c2e9',
                           'label' => '"All Events" button',
                           'name' => 'all_events_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more events. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // News Feeds 
                  array(
                     'key' => '56fc7521f1668',
                     'name' => 'post_feed',
                     'label' => 'News / Post Feed',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727a9551b20a',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 20,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_57070199eed66',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Latest News" or "News Feed". 20 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_56fc7540f1669',
                           'label' => 'Post quantity',
                           'name' => 'post_quantity',
                           'type' => 'radio',
                           'instructions' => 'Shows the latest 4 posts or latest 8 posts.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'message' => '',
                           'esc_html' => 0,
                           'new_lines' => 'wpautop',
                           'key' => 'field_5774661792hjk',
                           'label' => 'Items shown in this panel are automatically displayed from "Posts". You can add or update posts by going to "Posts" in the left navigation.',
                           'name' => '',
                           'type' => 'message',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End News Feed
                  // Sponsors Panel
                  array(
                     'key' => '571518b722ba0',
                     'name' => 'sponsors_panel',
                     'label' => 'Sponsors',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727a9d21b20b',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 30,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_571518e122ba1',
                           'label' => 'Title',
                           'name' => 'title_sponsor_panel',
                           'type' => 'text',
                           'instructions' => '30 Character limit',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_57151a3022ba3',
                           'label' => '"Become a Sponsor" button',
                           'name' => 'become_a_sponsor_button',
                           'type' => 'url',
                           'instructions' => 'Add a URL here to show the "Become a Sponsor" button underneath this sponsor panel.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End Sponsor Panel
                  // Call To Action
                  array(
                     'key' => '571e869b082c2',
                     'name' => 'call_to_action_panel',
                     'label' => 'Call to Action',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727aa011b20c',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 50,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_571e86b7082c3',
                           'label' => 'Text',
                           'name' => 'text',
                           'type' => 'text',
                           'instructions' => 'Type the CTA message here. 50 character limit.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_571e86fa082c4',
                           'label' => 'URL',
                           'name' => 'url',
                           'type' => 'url',
                           'instructions' => '',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Blue' => 'Blue',
                              'Red' => 'Red'
                           ),
                           'default_value' => 'Blue',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5775a4459a43g',
                           'label' => 'Background Color',
                           'name' => 'background_color',
                           'type' => 'radio',
                           'instructions' => 'Background color of this panel. Choose blue or red.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End to Call to Action
                  // Image Carousel (Rectangle)
                  array(
                     'key' => '572d9f7f52da4',
                     'name' => 'static_or_carousel',
                     'label' => 'Image Carousel (Rectangle)',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_572daf4770904',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              'Content Width' => 'Content Width',
                              'Browser Width' => 'Browser Width'
                           ),
                           'default_value' => 'Content Width',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573d09f7c7a5a',
                           'label' => 'Width',
                           'name' => 'width',
                           'type' => 'radio',
                           'instructions' => 'Content width or browser width.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_572da05c52da6',
                                 'label' => 'Image',
                                 'name' => 'image',
                                 'type' => 'image',
                                 'instructions' => '',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 40,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_572da08d52da7',
                                 'label' => 'Text',
                                 'name' => 'text',
                                 'type' => 'text',
                                 'instructions' => '40 Character Limit',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'placeholder' => '',
                                 'key' => 'field_573b9ce46699c',
                                 'label' => 'URL',
                                 'name' => 'url',
                                 'type' => 'url',
                                 'instructions' => 'Add a URL here if you want the image to link to another page.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              )
                           ),
                           'min' => 1,
                           'max' => 10,
                           'layout' => 'table',
                           'button_label' => 'Add More Image',
                           'collapsed' => '',
                           'key' => 'field_572d9faa52da5',
                           'label' => 'Images',
                           'name' => 'images',
                           'type' => 'repeater',
                           'instructions' => 'Minimum of 1 image. Max 10 images.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // Image Carousel (Rectangle)
                  // Image Carousel (Square)
                  array(
                     'key' => '573d16220b295',
                     'name' => 'square_image_carousel',
                     'label' => 'Image Carousel (Square)',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573d16220b296',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Content Width' => 'Content Width',
                              'Browser Width' => 'Browser Width'
                           ),
                           'default_value' => 'Content Width',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573d16220b297',
                           'label' => 'Width',
                           'name' => 'width',
                           'type' => 'radio',
                           'instructions' => 'Content width or browser width.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_573d16220b299',
                                 'label' => 'Image',
                                 'name' => 'image',
                                 'type' => 'image',
                                 'instructions' => '',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 40,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573d16220b29a',
                                 'label' => 'Text',
                                 'name' => 'text',
                                 'type' => 'text',
                                 'instructions' => '40 Character Limit',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'placeholder' => '',
                                 'key' => 'field_573d16220b29b',
                                 'label' => 'URL',
                                 'name' => 'url',
                                 'type' => 'url',
                                 'instructions' => 'Add a URL here if you want the image to link to another page.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              )
                           ),
                           'min' => 3,
                           'max' => 10,
                           'layout' => 'table',
                           'button_label' => 'Add More Image',
                           'collapsed' => '',
                           'key' => 'field_573d16220b298',
                           'label' => 'Images',
                           'name' => 'images',
                           'type' => 'repeater',
                           'instructions' => 'Minimum of 3 images. Max 10 images.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => 1
                  ), // End Image Carousel (Square)
                  // 1 Column
                  array(
                     'key' => '572bad2b2d757',
                     'name' => '1_column',
                     'label' => '1 Column',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_572bad2b2d758',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_572bad2b2d759',
                           'label' => 'Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'tabs' => 'all',
                           'toolbar' => 'full',
                           'media_upload' => 1,
                           'default_value' => '',
                           'delay' => 0,
                           'key' => 'field_572bad2b2d75a',
                           'label' => 'Column 1',
                           'name' => 'column_1',
                           'type' => 'wysiwyg',
                           'instructions' => 'Use the editor to style this content block however you like.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 100,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_572bad2b2d75c',
                           'label' => 'CTA Button Text',
                           'name' => 'cta_button',
                           'type' => 'text',
                           'instructions' => 'Optional Call To Action button to add underneath the 2 column content. i.e. "Learn More" or "Buy Now". Centered under both columns. Leave blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_572bad2b2d75d',
                           'label' => 'CTA Button URL',
                           'name' => 'cta_button_url',
                           'type' => 'url',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End 1 Column
                  // 2 Column
                  array(
                     'key' => '56fc69d21b9e7',
                     'name' => '2_column_photo_and_text_panel',
                     'label' => '2 Columns',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727a8251b207',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_5707044778278',
                           'label' => 'Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'tabs' => 'all',
                           'toolbar' => 'full',
                           'media_upload' => 1,
                           'default_value' => '',
                           'delay' => 0,
                           'key' => 'field_56fc6a5b7d756',
                           'label' => 'Column 1',
                           'name' => 'column_1',
                           'type' => 'wysiwyg',
                           'instructions' => 'Use the editor to style this content block however you like.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'tabs' => 'all',
                           'toolbar' => 'full',
                           'media_upload' => 1,
                           'default_value' => '',
                           'delay' => 0,
                           'key' => 'field_56fc6dfc7d757',
                           'label' => 'Column 2',
                           'name' => 'column_2',
                           'type' => 'wysiwyg',
                           'instructions' => 'Use the editor to style this content block however you like.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_571e908c47dbe',
                           'label' => 'CTA Button Text',
                           'name' => 'cta_button',
                           'type' => 'text',
                           'instructions' => 'Optional Call To Action button to add underneath the 2 column content. i.e. "Learn More" or "Buy Now". Centered under both columns. Leave blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_571e915447dbf',
                           'label' => 'CTA Button URL',
                           'name' => 'cta_button_url',
                           'type' => 'url',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End 2 Column
                  // Panel: 3 column - photo and text
                  array(
                     'key' => '5b4e51639ab7e',
                     'name' => '3_column',
                     'label' => '3 column',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'key' => 'field_5b4e70db5d7d7',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive',
                           ),
                           'allow_null' => 0,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'default_value' => 'active',
                           'layout' => 'horizontal',
                           'return_format' => 'value',
                        ),
                        array(
                           'key' => 'field_5b4e70905d7d6',
                           'label' => 'Panel Title',
                           'name' => 'panel_title',
                           'type' => 'text',
                           'instructions' => 'Optional: 50 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'default_value' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'maxlength' => 50,
                        ),
                        array(
                           'key' => 'field_5b4e5bec567f5',
                           'label' => 'Columns',
                           'name' => 'column',
                           'type' => 'repeater',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'collapsed' => '',
                           'min' => 3,
                           'max' => 3,
                           'layout' => 'table',
                           'button_label' => '',
                           'sub_fields' => array(
                              array(
                                 'key' => 'field_5b4e5177fec84',
                                 'label' => 'Type',
                                 'name' => 'column_type',
                                 'type' => 'radio',
                                 'instructions' => '',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '30',
                                    'class' => '',
                                    'id' => '',
                                 ),
                                 'choices' => array(
                                    'image' => 'Image with optional link',
                                    'paragraph' => 'Paragraph text',
                                    'list' => 'List of items with optional links',
                                 ),
                                 'allow_null' => 0,
                                 'other_choice' => 0,
                                 'save_other_choice' => 0,
                                 'default_value' => 'image',
                                 'layout' => 'vertical',
                                 'return_format' => 'value',
                              ),
                              array(
                                 'key' => 'field_5b4e645f30c5e',
                                 'label' => 'Data',
                                 'name' => 'data',
                                 'type' => 'group',
                                 'instructions' => '',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                 ),
                                 'layout' => 'block',
                                 'sub_fields' => array(
                                    array(
                                       'key' => 'field_5b4e54c9fec85',
                                       'label' => 'Image',
                                       'name' => 'column_image_field',
                                       'type' => 'image',
                                       'instructions' => 'Upload an image',
                                       'required' => 1,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'return_format' => 'url',
                                       'preview_size' => 'thumbnail',
                                       'library' => 'all',
                                       'min_width' => '',
                                       'min_height' => '',
                                       'min_size' => '',
                                       'max_width' => '',
                                       'max_height' => '',
                                       'max_size' => '',
                                       'mime_types' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e6672c7f98',
                                       'label' => 'Image Link',
                                       'name' => 'image_cta',
                                       'type' => 'url',
                                       'instructions' => 'Optional - If supplied, this will make the image a clickable link.',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e66a4c7f99',
                                       'label' => 'Link Text',
                                       'name' => 'image_cta_text',
                                       'type' => 'text',
                                       'instructions' => 'Optional - If supplied, an additional link is displayed below the image using this text.',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => '',
                                       'prepend' => '',
                                       'append' => '',
                                       'maxlength' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e66a4c7f90',
                                       'label' => 'Alignment',
                                       'name' => 'column_list_alignment',
                                       'type' => 'radio',
                                       'instructions' => '',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '100',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'choices' => array(
                                          'left' => 'Left',
                                          'center' => 'Center',
                                          'right' => 'Right',
                                       ),
                                       'allow_null' => 0,
                                       'other_choice' => 0,
                                       'save_other_choice' => 0,
                                       'default_value' => 'left',
                                       'layout' => 'vertical',
                                       'return_format' => 'value',
                                    ),
                                    array(
                                       'key' => 'field_5b4e54fdfec86',
                                       'label' => 'Paragraph',
                                       'name' => 'column_paragraph',
                                       'type' => 'textarea',
                                       'instructions' => 'Character limit is 350',
                                       'required' => 1,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'paragraph',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => '',
                                       'maxlength' => 350,
                                       'rows' => '',
                                       'new_lines' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e61ffa92ef',
                                       'label' => 'List Title',
                                       'name' => 'list_title',
                                       'type' => 'text',
                                       'instructions' => '',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'list',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '105',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => 'ie: Helpful Links',
                                       'prepend' => '',
                                       'append' => '',
                                       'maxlength' => 30,
                                    ),
                                    array(
                                       'key' => 'field_5b4e55f4fec87',
                                       'label' => 'List fields',
                                       'name' => 'column_list_fields',
                                       'type' => 'repeater',
                                       'instructions' => 'Enter in your list items and (if appropriate) their urls (maximum of 5)',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'list',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '100',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'collapsed' => 'field_5b4e561bfec88',
                                       'min' => 1,
                                       'max' => 5,
                                       'layout' => 'table',
                                       'button_label' => '',
                                       'sub_fields' => array(
                                          array(
                                             'key' => 'field_5b4e561bfec88',
                                             'label' => 'Label',
                                             'name' => 'list_text',
                                             'type' => 'text',
                                             'instructions' => '',
                                             'required' => 1,
                                             'conditional_logic' => 0,
                                             'wrapper' => array(
                                                'width' => '',
                                                'class' => '',
                                                'id' => '',
                                             ),
                                             'default_value' => '',
                                             'placeholder' => '',
                                             'prepend' => '',
                                             'append' => '',
                                             'maxlength' => '',
                                          ),
                                          array(
                                             'key' => 'field_5b4e562bfec89',
                                             'label' => 'Link',
                                             'name' => 'list_link',
                                             'type' => 'url',
                                             'instructions' => '',
                                             'required' => 0,
                                             'conditional_logic' => 0,
                                             'wrapper' => array(
                                                'width' => '',
                                                'class' => '',
                                                'id' => '',
                                             ),
                                             'default_value' => '',
                                             'placeholder' => '',
                                          ),
                                       ),
                                    ),
                                 ),
                              ),
                           ),
                        ),
                     ),
                     'min' => '',
                     'max' => '',
                  ), //End of 3 Column
                  // Panel: Buy Tickets floating banner
                  array(
                     'key' => '57196b4abc501',
                     'name' => 'buy_tickets_float',
                     'label' => 'Get Tickets Floating Banner',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive',
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_57196b4abc502',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'This adds a floating banner to buy tickets.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => '',
                           ),
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_57196b4abc503',
                           'label' => 'Buy Ticket URL',
                           'name' => 'buy_ticket_url',
                           'type' => 'url',
                           'instructions' => 'Required. Enter the URL to the ticket purchasing page for this faire.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 20,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_57196b4abc504',
                           'label' => 'Buy Ticket Text',
                           'name' => 'buy_ticket_text',
                           'type' => 'text',
                           'instructions' => 'Please enter the text displayed in the \'Buy Ticket\' Flag.<br/>20 character limit.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'readonly' => 0,
                           'disabled' => 0,
                        ),
                     ),
                     'min' => '',
                     'max' => 1,
                  ), // End of Buy Tickets
               ),
               'min' => '',
               'max' => '',
               'button_label' => 'Add New Panel',
               'key' => 'field_573b53999849d',
               'label' => 'Content Panels',
               'name' => 'content_panels',
               'type' => 'flexible_content',
               'instructions' => 'Add panels here by clicking the "Add New Panel" button at the bottom right side. Panel order can be changed by dragging each up or down.',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            )
         ),
         // 
         'location' => array(
            array(
               array(
                  'param' => 'post_type',
                  'operator' => '==',
                  'value' => 'post'
               )
            ),
            array(
               array(
                  'param' => 'post_type',
                  'operator' => '==',
                  'value' => 'page'
               ),
               array(
                  'param' => 'page_template',
                  'operator' => '==',
                  'value' => 'page-home.php'
               ),
               array(
                  'param' => 'page_template',
                  'operator' => '!=',
                  'value' => 'page-meet-the-makers.php'
               ),
               array(
                  'param' => 'page_template',
                  'operator' => '!=',
                  'value' => 'page-sponsors.php'
               ),
               array(
                  'param' => 'page_template',
                  'operator' => '!=',
                  'value' => 'page-schedule.php'
               ),
               array(
                  'param' => 'page_template',
                  'operator' => '!=',
                  'value' => 'page-contact.php'
               ),
               array(
                  'param' => 'page_template',
                  'operator' => '!=',
                  'value' => 'blog.php'
               )
            )
         ),
         'menu_order' => 0,
         'position' => 'normal',
         'style' => 'default',
         'label_placement' => 'top',
         'instruction_placement' => 'label',
         'hide_on_screen' => '',
         'active' => 1,
         'description' => '',
         'modified' => 1463506572,
         'local' => 'php'
      ));
   
   acf_add_local_field_group(array(
      'key' => 'group_574f74e25444e',
      'title' => 'Post Feed Page',
      'fields' => array(
         array(
            'message' => '',
            'esc_html' => 0,
            'new_lines' => 'wpautop',
            'key' => 'field_574f74ff3d999',
            'label' => 'You cannot edit this post feed page. It automatically displays a feed of all your posts.',
            'name' => '',
            'type' => 'message',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => ''
            )
         )
      ),
      'location' => array(
         array(
            array(
               'param' => 'page_template',
               'operator' => '==',
               'value' => 'blog.php'
            )
         )
      ),
      'menu_order' => 0,
      'position' => 'acf_after_title',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => array(
         0 => 'the_content',
         1 => 'excerpt',
         2 => 'custom_fields',
         3 => 'discussion',
         4 => 'comments',
         5 => 'revisions',
         6 => 'slug',
         7 => 'author',
         8 => 'format',
         9 => 'page_attributes',
         10 => 'featured_image',
         11 => 'categories',
         12 => 'tags',
         13 => 'send-trackbacks'
      ),
      'active' => 1,
      'description' => '',
      'local' => 'php'
   ));
   
   acf_add_local_field_group(array(
      'key' => 'group_5750d13a38bc2',
      'title' => 'Schedule Page',
      'fields' => array(
         array(
            'key' => 'field_5750d1756eeb0',
            'label' => 'Display data from these forms:',
            'name' => 'schedule_ids',
            'type' => 'text',
            'instructions' => 'Enter one or more Form IDs here. If you add more than one id, separate each with a comma, ie: 1,3
<br>
You can find the Form IDs in Forms > Forms > ID column."',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => ''
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => ''
         ),
         array(
            'key' => 'field_59b1aac2197c5',
            'label' => 'No Makers Found text',
            'name' => 'no_makers_found_text',
            'type' => 'text',
            'instructions' => 'Text displayed when no makers are set. Defaults to \'No Makers Found\'',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => ''
            ),
            'default_value' => 'No Makers Found',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => ''
         )
      ),
      'location' => array(
         array(
            array(
               'param' => 'page_template',
               'operator' => '==',
               'value' => 'page-schedule.php'
            )
         )
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => array(
         0 => 'the_content',
         1 => 'excerpt',
         2 => 'custom_fields',
         3 => 'discussion',
         4 => 'comments',
         5 => 'slug',
         6 => 'author',
         7 => 'format',
         8 => 'page_attributes',
         9 => 'categories',
         10 => 'tags',
         11 => 'send-trackbacks'
      ),
      'active' => 1,
      'description' => ''
   ));
   
   acf_add_local_field_group(array(
      'key' => 'group_570ef4c0b8f60',
      'title' => 'Sponsors Page',
      'fields' => array(
         array(
            'layouts' => array(
               array(
                  'key' => '570f0304d2329',
                  'name' => 'sponsors_with_image',
                  'label' => 'Sponsors with Image',
                  'display' => 'block',
                  'sub_fields' => array(
                     array(
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'key' => 'field_570f03ffd8840',
                        'label' => 'Sponsor Group Title',
                        'name' => 'sponsor_group_title',
                        'type' => 'text',
                        'instructions' => 'i.e. "Presenting Sponsors" or "Goldsmith Sponsors"',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                           'width' => '',
                           'class' => '',
                           'id' => ''
                        ),
                        'readonly' => 0,
                        'disabled' => 0
                     ),
                     array(
                        'multiple' => 0,
                        'allow_null' => 0,
                        'choices' => array(
                           'sponsors-box-md' => 'Small',
                           'sponsors-box-lg' => 'Medium',
                           'sponsors-box-xl' => 'Large'
                        ),
                        'default_value' => array(
                           0 => 'sponsors-box-md'
                        ),
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                        'return_format' => 'value',
                        'key' => 'field_57101bb219307',
                        'label' => 'Sponsors Image Size',
                        'name' => 'sponsors_image_size',
                        'type' => 'select',
                        'instructions' => 'Displays the sponsor images at small, medium, or large sizes. Sizes can be used as a way to show importance.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                           'width' => '',
                           'class' => '',
                           'id' => ''
                        ),
                        'disabled' => 0,
                        'readonly' => 0
                     ),
                     array(
                        'sub_fields' => array(
                           array(
                              'return_format' => 'array',
                              'preview_size' => 'thumbnail',
                              'library' => 'all',
                              'min_width' => '',
                              'min_height' => '',
                              'min_size' => '',
                              'max_width' => '',
                              'max_height' => '',
                              'max_size' => '',
                              'mime_types' => '',
                              'key' => 'field_570f039bd883e',
                              'label' => 'Image',
                              'name' => 'image',
                              'type' => 'image',
                              'instructions' => '',
                              'required' => 1,
                              'conditional_logic' => 0,
                              'wrapper' => array(
                                 'width' => '',
                                 'class' => '',
                                 'id' => ''
                              )
                           ),
                           array(
                              'default_value' => '',
                              'placeholder' => '',
                              'key' => 'field_570f03c6d883f',
                              'label' => 'URL',
                              'name' => 'url',
                              'type' => 'url',
                              'instructions' => '',
                              'required' => 0,
                              'conditional_logic' => 0,
                              'wrapper' => array(
                                 'width' => '',
                                 'class' => '',
                                 'id' => ''
                              )
                           )
                        ),
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'table',
                        'button_label' => 'Add Row',
                        'collapsed' => '',
                        'key' => 'field_570f0337d883d',
                        'label' => 'Sponsors',
                        'name' => 'sponsors_with_image',
                        'type' => 'repeater',
                        'instructions' => 'Add each individual sponsor as a new row.',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                           'width' => '',
                           'class' => '',
                           'id' => ''
                        )
                     )
                  ),
                  'min' => '',
                  'max' => ''
               ),
               array(
                  'key' => '570f05c2c655b',
                  'name' => 'sponsors_with_text',
                  'label' => 'Sponsors with Text',
                  'display' => 'block',
                  'sub_fields' => array(
                     array(
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'key' => 'field_570f05c2c655c',
                        'label' => 'Sponsor Group Title',
                        'name' => 'sponsor_group_title',
                        'type' => 'text',
                        'instructions' => 'i.e. "Presenting Sponsors" or "Goldsmith Sponsors"',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                           'width' => '',
                           'class' => '',
                           'id' => ''
                        ),
                        'readonly' => 0,
                        'disabled' => 0
                     ),
                     array(
                        'sub_fields' => array(
                           array(
                              'default_value' => '',
                              'maxlength' => '',
                              'placeholder' => '',
                              'prepend' => '',
                              'append' => '',
                              'key' => 'field_570f05c2c655e',
                              'label' => 'Sponsor Name',
                              'name' => 'sponsor_name',
                              'type' => 'text',
                              'instructions' => '',
                              'required' => 1,
                              'conditional_logic' => 0,
                              'wrapper' => array(
                                 'width' => '',
                                 'class' => '',
                                 'id' => ''
                              ),
                              'readonly' => 0,
                              'disabled' => 0
                           ),
                           array(
                              'default_value' => '',
                              'placeholder' => '',
                              'key' => 'field_570f05c2c655f',
                              'label' => 'URL',
                              'name' => 'url',
                              'type' => 'url',
                              'instructions' => '',
                              'required' => 0,
                              'conditional_logic' => 0,
                              'wrapper' => array(
                                 'width' => '',
                                 'class' => '',
                                 'id' => ''
                              )
                           )
                        ),
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'block',
                        'button_label' => 'Add Row',
                        'collapsed' => '',
                        'key' => 'field_570f05c2c655d',
                        'label' => 'Sponsors',
                        'name' => 'sponsors_with_text',
                        'type' => 'repeater',
                        'instructions' => 'Add each individual sponsor as a new row.',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                           'width' => '',
                           'class' => '',
                           'id' => ''
                        )
                     )
                  ),
                  'min' => '',
                  'max' => ''
               )
            ),
            'min' => '',
            'max' => '',
            'button_label' => 'Add Row',
            'key' => 'field_570f02e7d883c',
            'label' => 'Sponsors',
            'name' => 'sponsors',
            'type' => 'flexible_content',
            'instructions' => 'Start by clicking "Add Row" to add a new sponsor group.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => 'sponsors-admin',
               'id' => ''
            )
         )
      ),
      'location' => array(
         array(
            array(
               'param' => 'page_template',
               'operator' => '==',
               'value' => 'page-sponsors.php'
            )
         )
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => array(
         0 => 'the_content',
         1 => 'custom_fields',
         2 => 'discussion',
         3 => 'comments',
         4 => 'categories',
         5 => 'tags'
      ),
      'active' => 1,
      'description' => '',
      'local' => 'json',
      'modified' => 1469037352
   ));
   
   acf_add_local_field_group(
      array(
         'key' => 'group_56f96fbd65226',
         'title' => 'Home Page Panels',
         'fields' => array(
            array(
               'layouts' => array(
                  // Page Panels 
                  array(
                     'key' => '57196b4f7c508',
                     'name' => 'what_is_maker_faire',
                     'label' => 'What is Maker Faire',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'show',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_57196b4f7c509',
                           'label' => 'Active/Inactive',
                           'name' => 'show_what_is_maker_faire',
                           'type' => 'radio',
                           'instructions' => 'This adds an uneditable text panel with information about Maker Faires.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => 1
                  ),
                  // Newsletter Sign Up
                  array(
                     'key' => '572d8358fe8e1',
                     'name' => 'newsletter_panel',
                     'label' => 'Newsletter Sign Up',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'show',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_572d8358fe8e2',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'This adds an email sign up form for newsletter subscriptions.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Makers (Square images)
                  array(
                     'key' => '56fc6f9fdc4a2',
                     'name' => 'featured_makers_panel',
                     'label' => 'Featured Makers (Square images)',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727a9191b209',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 28,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_56fcb5958152f',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 28 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5719832407ae9',
                           'label' => 'Amount of Makers to show',
                           'name' => 'makers_to_show',
                           'type' => 'radio',
                           'instructions' => 'Show 4 Makers or 8 makers',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_56fc70e8dc4a4',
                                 'label' => 'Maker Image',
                                 'name' => 'maker_image',
                                 'type' => 'image',
                                 'instructions' => 'Featured Maker Images are best when square sizes around 500px by 500px.',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 19,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_56fc7172dc4a5',
                                 'label' => 'Maker Name',
                                 'name' => 'maker_name',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 24 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 100,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_56fc71a0dc4a6',
                                 'label' => 'Maker Short Description',
                                 'name' => 'maker_short_description',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 100 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'placeholder' => '',
                                 'key' => 'field_5759d0681060d',
                                 'label' => 'Maker URL',
                                 'name' => 'maker_url',
                                 'type' => 'url',
                                 'instructions' => '',
                                 'required' => '',
                                 'conditional_logic' => '',
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              )
                           ),
                           'min' => 0,
                           'max' => 8,
                           'layout' => 'table',
                           'button_label' => 'Add New Maker',
                           'collapsed' => '',
                           'key' => 'field_56fc6fc3dc4a3',
                           'label' => 'Featured Makers',
                           'name' => 'featured_makers',
                           'type' => 'repeater',
                           'instructions' => 'Adds a panel for 1 row of 4 makers or 2 rows of 4 makers. Each maker features an image, name, and short description. Start by clicking the "Add New Maker" button for each featured maker to show in this panel.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_571ab19c2e7ed',
                           'label' => '"More Makers" button',
                           'name' => 'more_makers_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more makers. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Blue' => 'Blue',
                              'Red' => 'Red'
                           ),
                           'default_value' => 'Blue',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727eedc044ee',
                           'label' => 'Background Color',
                           'name' => 'background_color',
                           'type' => 'radio',
                           'instructions' => 'Background color of this panel. Choose blue or red.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Makers (Square images) ===== DYNAMIC PANEL
                  array(
                     'key' => '579924c93b1b9',
                     'name' => 'featured_makers_panel_dynamic',
                     'label' => 'Featured Makers (Square images) ===== DYNAMIC PANEL',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93b1ba',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 28,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579924c93b1bb',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 28 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'min' => '',
                           'max' => '',
                           'step' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579925463b1d9',
                           'label' => 'Enter formid here',
                           'name' => 'enter_formid_here',
                           'type' => 'number',
                           'instructions' => 'Enter the form to pull featured individuals from. They must have the \'Featured Maker\' flag set to be pulled in.',
                           'required' => 1,
                           'conditional_logic' => '',
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'On' => 'On',
                              'Off' => 'Off'
                           ),
                           'default_value' => 'On',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93c2cg',
                           'label' => 'Randomly pull Accepted',
                           'name' => 'pull_accepted',
                           'type' => 'radio',
                           'instructions' => 'Pull Project images randomly from Accepted entries if no Featured Maker flags are set?',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93b1bc',
                           'label' => 'Amount of Makers to show',
                           'name' => 'makers_to_show',
                           'type' => 'radio',
                           'instructions' => 'Show 4 Makers or 8 makers',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_579924c93b1c2',
                           'label' => '"More Makers" button',
                           'name' => 'more_makers_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more makers. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Blue' => 'Blue',
                              'Red' => 'Red'
                           ),
                           'default_value' => 'Blue',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93b1c3',
                           'label' => 'Background Color',
                           'name' => 'background_color',
                           'type' => 'radio',
                           'instructions' => 'Background color of this panel. Choose blue or red.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Makers (Circle images)
                  array(
                     'key' => '573e3efd8e814',
                     'name' => 'featured_makers_panel_circle',
                     'label' => 'Featured Makers (Circle images)',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573e3efd8e815',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 28,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_573e3efd8e816',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 28 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573e3efd8e817',
                           'label' => 'Amount of Makers to show',
                           'name' => 'makers_to_show',
                           'type' => 'radio',
                           'instructions' => 'Show 4 Makers or 8 makers',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_573e3efd8e819',
                                 'label' => 'Maker Image',
                                 'name' => 'maker_image',
                                 'type' => 'image',
                                 'instructions' => 'Featured Maker Images are best when square sizes around 500px by 500px.',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 19,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e3efd8e81a',
                                 'label' => 'Maker Name',
                                 'name' => 'maker_name',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 24 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 100,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e3efd8e81b',
                                 'label' => 'Maker Short Description',
                                 'name' => 'maker_short_description',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 100 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'placeholder' => '',
                                 'key' => 'field_5759d07f1060e',
                                 'label' => 'Maker URL',
                                 'name' => 'maker_url',
                                 'type' => 'url',
                                 'instructions' => '',
                                 'required' => '',
                                 'conditional_logic' => '',
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              )
                           ),
                           'min' => 0,
                           'max' => 8,
                           'layout' => 'table',
                           'button_label' => 'Add New Maker',
                           'collapsed' => '',
                           'key' => 'field_573e3efd8e818',
                           'label' => 'Featured Makers',
                           'name' => 'featured_makers',
                           'type' => 'repeater',
                           'instructions' => 'Adds a panel for 1 row of 4 makers or 2 rows of 4 makers. Each maker features an image, name, and short description. Start by clicking the "Add New Maker" button for each featured maker to show in this panel.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_573e3efd8e81c',
                           'label' => '"More Makers" button',
                           'name' => 'more_makers_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more makers. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Makers (Circle images) ===== DYNAMIC PANEL
                  array(
                     'key' => '579925053b1c4',
                     'name' => 'featured_makers_panel_circle_dynamic',
                     'label' => 'Featured Makers (Circle images) ===== DYNAMIC PANEL',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579925053b1c5',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 28,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579925053b1c6',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 28 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'min' => '',
                           'max' => '',
                           'step' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579926253b1da',
                           'label' => 'Enter formid here',
                           'name' => 'enter_formid_here',
                           'type' => 'number',
                           'instructions' => 'Enter the form to pull featured individuals from. They must have the \'Featured Maker\' flag set to be pulled in.',
                           'required' => 1,
                           'conditional_logic' => '',
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'On' => 'On',
                              'Off' => 'Off'
                           ),
                           'default_value' => 'On',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579924c93c2ch',
                           'label' => 'Randomly pull Accepted',
                           'name' => 'pull_accepted',
                           'type' => 'radio',
                           'instructions' => 'Pull Project images randomly from Accepted entries if no Featured Maker flags are set?',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579925053b1c7',
                           'label' => 'Amount of Makers to show',
                           'name' => 'makers_to_show',
                           'type' => 'radio',
                           'instructions' => 'Show 4 Makers or 8 makers',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_579925053b1cd',
                           'label' => '"More Makers" button',
                           'name' => 'more_makers_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more makers. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Events
                  array(
                     'key' => '573e4bc7b6659',
                     'name' => 'featured_events',
                     'label' => 'Featured Events',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573e4bc7b665a',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 40,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_573e4bc7b665b',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 40 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_573e4bc7b665e',
                                 'label' => 'Event Image',
                                 'name' => 'event_image',
                                 'type' => 'image',
                                 'instructions' => 'Featured Event Images are best when square sizes around 500px by 500px.',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 28,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e55385fe8f',
                                 'label' => 'Day of the Week',
                                 'name' => 'day',
                                 'type' => 'text',
                                 'instructions' => 'Indicate day or days of the week. i.e. "Saturday" or "Saturday & Sunday"',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 19,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e4bc7b665f',
                                 'label' => 'Event Name',
                                 'name' => 'event_name',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 24 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 100,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e4bc7b6660',
                                 'label' => 'Event Short Description',
                                 'name' => 'event_short_description',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 100 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 51,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e4d30b6662',
                                 'label' => 'Time',
                                 'name' => 'time',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 30 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 30,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573e4d59b6663',
                                 'label' => 'Location/Stage',
                                 'name' => 'location',
                                 'type' => 'text',
                                 'instructions' => 'Optional field. 30 character limit.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              )
                           ),
                           'min' => 0,
                           'max' => 4,
                           'layout' => 'table',
                           'button_label' => 'Add New Event',
                           'collapsed' => '',
                           'key' => 'field_573e4bc7b665d',
                           'label' => 'Featured Events',
                           'name' => 'featured_events',
                           'type' => 'repeater',
                           'instructions' => 'Adds a panel for 4 featured events/exhibits. Each event has an image, name, short description, time, and location/stage. Start by clicking the "Add New Event" button for each featured event in this panel.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_573e4bc7b6661',
                           'label' => '"All Events" button',
                           'name' => 'all_events_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more events. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  // Featured Events ===== DYNAMIC PANEL
                  array(
                     'key' => '579925163b1ce',
                     'name' => 'featured_events_dynamic',
                     'label' => 'Featured Events ===== DYNAMIC PANEL',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_579925163b1cf',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 40,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579925163b1d0',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Featured Makers". 40 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'min' => '',
                           'max' => '',
                           'step' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_579926323b1db',
                           'label' => 'Enter formid here',
                           'name' => 'enter_formid_here',
                           'type' => 'number',
                           'instructions' => 'Enter the form to pull featured individuals from. They must have the \'Featured Maker\' flag set to be pulled in.',
                           'required' => 1,
                           'conditional_logic' => '',
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_579925163b1d8',
                           'label' => '"All Events" button',
                           'name' => 'all_events_button',
                           'type' => 'url',
                           'instructions' => 'Optional button to link to a page with more events. Leave URL field blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End Featured Events ===== DYNAMIC PANEL
                  // News Feeds Good 
                  array(
                     'key' => '56fc7521f1668',
                     'name' => 'post_feed',
                     'label' => 'News / Post Feed',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727a9551b20a',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 20,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_57070199eed66',
                           'label' => 'Panel Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => 'i.e. "Latest News" or "News Feed". 20 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              4 => 4,
                              8 => 8
                           ),
                           'default_value' => 4,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_56fc7540f1669',
                           'label' => 'Post quantity',
                           'name' => 'post_quantity',
                           'type' => 'radio',
                           'instructions' => 'Shows the latest 4 posts or latest 8 posts.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'message' => '',
                           'esc_html' => 0,
                           'new_lines' => 'wpautop',
                           'key' => 'field_5774661792dfc',
                           'label' => 'Items shown in this panel are automatically displayed from "Posts". You can add or update posts by going to "Posts" in the left navigation.',
                           'name' => '',
                           'type' => 'message',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End News Feeds 
                  // Sponsor Panel 
                  array(
                     'key' => '571518b722ba0',
                     'name' => 'sponsors_panel',
                     'label' => 'Sponsors',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727a9d21b20b',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 30,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_571518e122ba1',
                           'label' => 'Title',
                           'name' => 'title_sponsor_panel',
                           'type' => 'text',
                           'instructions' => '30 Character limit',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_57151a3022ba3',
                           'label' => '"Become a Sponsor" button',
                           'name' => 'become_a_sponsor_button',
                           'type' => 'url',
                           'instructions' => 'Add a URL here to show the "Become a Sponsor" button underneath this sponsor panel.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => 1,
                     'max' => ''
                  ), // End Sponsor
                  // Call to Action
                  array(
                     'key' => '571e869b082c2',
                     'name' => 'call_to_action_panel',
                     'label' => 'Call to Action',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727aa011b20c',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 50,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_571e86b7082c3',
                           'label' => 'Text',
                           'name' => 'text',
                           'type' => 'text',
                           'instructions' => 'Type the CTA message here. 50 character limit.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_571e86fa082c4',
                           'label' => 'URL',
                           'name' => 'url',
                           'type' => 'url',
                           'instructions' => '',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Blue' => 'Blue',
                              'Red' => 'Red'
                           ),
                           'default_value' => 'Blue',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5775a4459a43f',
                           'label' => 'Background Color',
                           'name' => 'background_color',
                           'type' => 'radio',
                           'instructions' => 'Background color of this panel. Choose blue or red.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End Call to Action
                  // 1 Column
                  array(
                     'key' => '572bad2b2d757',
                     'name' => '1_column',
                     'label' => '1 Column',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_572bad2b2d758',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_572bad2b2d759',
                           'label' => 'Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'tabs' => 'all',
                           'toolbar' => 'full',
                           'media_upload' => 1,
                           'default_value' => '',
                           'delay' => 0,
                           'key' => 'field_572bad2b2d75a',
                           'label' => 'Column 1',
                           'name' => 'column_1',
                           'type' => 'wysiwyg',
                           'instructions' => 'Use the editor to style this content block however you like.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 100,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_572bad2b2d75c',
                           'label' => 'CTA Button Text',
                           'name' => 'cta_button',
                           'type' => 'text',
                           'instructions' => 'Optional Call To Action button to add underneath the 2 column content. i.e. "Learn More" or "Buy Now". Centered under both columns. Leave blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_572bad2b2d75d',
                           'label' => 'CTA Button URL',
                           'name' => 'cta_button_url',
                           'type' => 'url',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End 1 Column
                  // 2 Column
                  array(
                     'key' => '56fc69d21b9e7',
                     'name' => '2_column_photo_and_text_panel',
                     'label' => '2 Columns',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_5727a8251b207',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_5707044778278',
                           'label' => 'Title',
                           'name' => 'title',
                           'type' => 'text',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'tabs' => 'all',
                           'toolbar' => 'full',
                           'media_upload' => 1,
                           'default_value' => '',
                           'delay' => 0,
                           'key' => 'field_56fc6a5b7d756',
                           'label' => 'Column 1',
                           'name' => 'column_1',
                           'type' => 'wysiwyg',
                           'instructions' => 'Use the editor to style this content block however you like.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'tabs' => 'all',
                           'toolbar' => 'full',
                           'media_upload' => 1,
                           'default_value' => '',
                           'delay' => 0,
                           'key' => 'field_56fc6dfc7d757',
                           'label' => 'Column 2',
                           'name' => 'column_2',
                           'type' => 'wysiwyg',
                           'instructions' => 'Use the editor to style this content block however you like.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_571e908c47dbe',
                           'label' => 'CTA Button Text',
                           'name' => 'cta_button',
                           'type' => 'text',
                           'instructions' => 'Optional Call To Action button to add underneath the 2 column content. i.e. "Learn More" or "Buy Now". Centered under both columns. Leave blank to hide.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_571e915447dbf',
                           'label' => 'CTA Button URL',
                           'name' => 'cta_button_url',
                           'type' => 'url',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End 2 Column
                  // Panel: 3 column - photo and text
                  array(
                     'key' => '5b4e51639ab7e',
                     'name' => '3_column',
                     'label' => '3 column',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'key' => 'field_5b4e70db5d7d7',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive',
                           ),
                           'allow_null' => 0,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'default_value' => 'active',
                           'layout' => 'horizontal',
                           'return_format' => 'value',
                        ),
                        array(
                           'key' => 'field_5b4e70905d7d6',
                           'label' => 'Panel Title',
                           'name' => 'panel_title',
                           'type' => 'text',
                           'instructions' => 'Optional: 50 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'default_value' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'maxlength' => 50,
                        ),
                        array(
                           'key' => 'field_5b4e5bec567f5',
                           'label' => 'Columns',
                           'name' => 'column',
                           'type' => 'repeater',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'collapsed' => '',
                           'min' => 3,
                           'max' => 3,
                           'layout' => 'table',
                           'button_label' => '',
                           'sub_fields' => array(
                              array(
                                 'key' => 'field_5b4e5177fec84',
                                 'label' => 'Type',
                                 'name' => 'column_type',
                                 'type' => 'radio',
                                 'instructions' => '',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '30',
                                    'class' => '',
                                    'id' => '',
                                 ),
                                 'choices' => array(
                                    'image' => 'Image with optional link',
                                    'paragraph' => 'Paragraph text',
                                    'list' => 'List of items with optional links',
                                 ),
                                 'allow_null' => 0,
                                 'other_choice' => 0,
                                 'save_other_choice' => 0,
                                 'default_value' => 'image',
                                 'layout' => 'vertical',
                                 'return_format' => 'value',
                              ),
                              array(
                                 'key' => 'field_5b4e645f30c5e',
                                 'label' => 'Data',
                                 'name' => 'data',
                                 'type' => 'group',
                                 'instructions' => '',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                 ),
                                 'layout' => 'block',
                                 'sub_fields' => array(
                                    array(
                                       'key' => 'field_5b4e54c9fec85',
                                       'label' => 'Image',
                                       'name' => 'column_image_field',
                                       'type' => 'image',
                                       'instructions' => 'Upload an image',
                                       'required' => 1,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'return_format' => 'url',
                                       'preview_size' => 'thumbnail',
                                       'library' => 'all',
                                       'min_width' => '',
                                       'min_height' => '',
                                       'min_size' => '',
                                       'max_width' => '',
                                       'max_height' => '',
                                       'max_size' => '',
                                       'mime_types' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e6672c7f98',
                                       'label' => 'Image Link',
                                       'name' => 'image_cta',
                                       'type' => 'url',
                                       'instructions' => 'Optional - If supplied, this will make the image a clickable link.',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e66a4c7f99',
                                       'label' => 'Link Text',
                                       'name' => 'image_cta_text',
                                       'type' => 'text',
                                       'instructions' => 'Optional - If supplied, an additional link is displayed below the image using this text.',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => '',
                                       'prepend' => '',
                                       'append' => '',
                                       'maxlength' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e66a4c7f90',
                                       'label' => 'Alignment',
                                       'name' => 'column_list_alignment',
                                       'type' => 'radio',
                                       'instructions' => '',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '100',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'choices' => array(
                                          'left' => 'Left',
                                          'center' => 'Center',
                                          'right' => 'Right',
                                       ),
                                       'allow_null' => 0,
                                       'other_choice' => 0,
                                       'save_other_choice' => 0,
                                       'default_value' => 'left',
                                       'layout' => 'vertical',
                                       'return_format' => 'value',
                                    ),
                                    array(
                                       'key' => 'field_5b4e54fdfec86',
                                       'label' => 'Paragraph',
                                       'name' => 'column_paragraph',
                                       'type' => 'textarea',
                                       'instructions' => 'Character limit is 350',
                                       'required' => 1,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'paragraph',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => '',
                                       'maxlength' => 350,
                                       'rows' => '',
                                       'new_lines' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e61ffa92ef',
                                       'label' => 'List Title',
                                       'name' => 'list_title',
                                       'type' => 'text',
                                       'instructions' => '',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'list',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '105',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => 'ie: Helpful Links',
                                       'prepend' => '',
                                       'append' => '',
                                       'maxlength' => 30,
                                    ),
                                    array(
                                       'key' => 'field_5b4e55f4fec87',
                                       'label' => 'List fields',
                                       'name' => 'column_list_fields',
                                       'type' => 'repeater',
                                       'instructions' => 'Enter in your list items and (if appropriate) their urls (maximum of 5)',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'list',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '100',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'collapsed' => 'field_5b4e561bfec88',
                                       'min' => 1,
                                       'max' => 5,
                                       'layout' => 'table',
                                       'button_label' => '',
                                       'sub_fields' => array(
                                          array(
                                             'key' => 'field_5b4e561bfec88',
                                             'label' => 'Label',
                                             'name' => 'list_text',
                                             'type' => 'text',
                                             'instructions' => '',
                                             'required' => 1,
                                             'conditional_logic' => 0,
                                             'wrapper' => array(
                                                'width' => '',
                                                'class' => '',
                                                'id' => '',
                                             ),
                                             'default_value' => '',
                                             'placeholder' => '',
                                             'prepend' => '',
                                             'append' => '',
                                             'maxlength' => '',
                                          ),
                                          array(
                                             'key' => 'field_5b4e562bfec89',
                                             'label' => 'Link',
                                             'name' => 'list_link',
                                             'type' => 'url',
                                             'instructions' => '',
                                             'required' => 0,
                                             'conditional_logic' => 0,
                                             'wrapper' => array(
                                                'width' => '',
                                                'class' => '',
                                                'id' => '',
                                             ),
                                             'default_value' => '',
                                             'placeholder' => '',
                                          ),
                                       ),
                                    ),
                                 ),
                              ),
                           ),
                        ),
                     ),
                     'min' => '',
                     'max' => '',
                  ), //End of 3 Column
                  // Panel: Buy Tickets floating banner
                  array(
                     'key' => '57196b4abc501',
                     'name' => 'buy_tickets_float',
                     'label' => 'Get Tickets Floating Banner',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive',
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_57196b4abc502',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'This adds a floating banner to buy tickets.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => '',
                           ),
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_57196b4abc503',
                           'label' => 'Buy Ticket URL',
                           'name' => 'buy_ticket_url',
                           'type' => 'url',
                           'instructions' => 'Required. Enter the URL to the ticket purchasing page for this faire.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 20,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_57196b4abc504',
                           'label' => 'Buy Ticket Text',
                           'name' => 'buy_ticket_text',
                           'type' => 'text',
                           'instructions' => 'Please enter the text displayed in the \'Buy Ticket\' Flag.<br/>20 character limit.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'readonly' => 0,
                           'disabled' => 0,
                        ),
                     ),
                     'min' => '',
                     'max' => 1,
                  ), // End of Buy Tickets
                  // Image Carousel (Rectangle)
                  array(
                     'key' => '572d9f7f52da4',
                     'name' => 'static_or_carousel',
                     'label' => 'Image Carousel (Rectangle)',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_572daf4770904',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              'Content Width' => 'Content Width',
                              'Browser Width' => 'Browser Width'
                           ),
                           'default_value' => 'Content Width',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573d09f7c7a5a',
                           'label' => 'Width',
                           'name' => 'width',
                           'type' => 'radio',
                           'instructions' => 'Content width or browser width.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_572da05c52da6',
                                 'label' => 'Image',
                                 'name' => 'image',
                                 'type' => 'image',
                                 'instructions' => '',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 40,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_572da08d52da7',
                                 'label' => 'Text',
                                 'name' => 'text',
                                 'type' => 'text',
                                 'instructions' => '40 Character Limit',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'placeholder' => '',
                                 'key' => 'field_573b9ce46699c',
                                 'label' => 'URL',
                                 'name' => 'url',
                                 'type' => 'url',
                                 'instructions' => 'Add a URL here if you want the image to link to another page.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              )
                           ),
                           'min' => 1,
                           'max' => 10,
                           'layout' => 'table',
                           'button_label' => 'Add More Image',
                           'collapsed' => '',
                           'key' => 'field_572d9faa52da5',
                           'label' => 'Images',
                           'name' => 'images',
                           'type' => 'repeater',
                           'instructions' => 'Minimum of 1 image. Max 10 images.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ),
                  array(
                     'key' => '573d16220b295',
                     'name' => 'square_image_carousel',
                     'label' => 'Image Carousel (Square)',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573d16220b296',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => 'activeinactive',
                              'id' => ''
                           )
                        ),
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Content Width' => 'Content Width',
                              'Browser Width' => 'Browser Width'
                           ),
                           'default_value' => 'Content Width',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_573d16220b297',
                           'label' => 'Width',
                           'name' => 'width',
                           'type' => 'radio',
                           'instructions' => 'Content width or browser width.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => 50,
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'sub_fields' => array(
                              array(
                                 'return_format' => 'array',
                                 'preview_size' => 'thumbnail',
                                 'library' => 'all',
                                 'min_width' => '',
                                 'min_height' => '',
                                 'min_size' => '',
                                 'max_width' => '',
                                 'max_height' => '',
                                 'max_size' => '',
                                 'mime_types' => '',
                                 'key' => 'field_573d16220b299',
                                 'label' => 'Image',
                                 'name' => 'image',
                                 'type' => 'image',
                                 'instructions' => '',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              ),
                              array(
                                 'default_value' => '',
                                 'maxlength' => 40,
                                 'placeholder' => '',
                                 'prepend' => '',
                                 'append' => '',
                                 'key' => 'field_573d16220b29a',
                                 'label' => 'Text',
                                 'name' => 'text',
                                 'type' => 'text',
                                 'instructions' => '40 Character Limit',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 ),
                                 'readonly' => 0,
                                 'disabled' => 0
                              ),
                              array(
                                 'default_value' => '',
                                 'placeholder' => '',
                                 'key' => 'field_573d16220b29b',
                                 'label' => 'URL',
                                 'name' => 'url',
                                 'type' => 'url',
                                 'instructions' => 'Add a URL here if you want the image to link to another page.',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => ''
                                 )
                              )
                           ),
                           'min' => 3,
                           'max' => 10,
                           'layout' => 'table',
                           'button_label' => 'Add More Image',
                           'collapsed' => '',
                           'key' => 'field_573d16220b298',
                           'label' => 'Images',
                           'name' => 'images',
                           'type' => 'repeater',
                           'instructions' => 'Minimum of 3 images. Max 10 images.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => 1
                  ),
                  array(
                     'key' => '57b20ae569288',
                     'name' => 'social_media',
                     'label' => 'Social Media',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'layout' => 'vertical',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive'
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_57b215b4644e8',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'Activate or Inactivate this panel',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_57b22cbb9598e',
                           'label' => 'Title',
                           'name' => 'panel_title',
                           'type' => 'text',
                           'instructions' => 'Optional: Add a title to this panel. e.g. "Follow us on Social Media"',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           ),
                           'readonly' => 0,
                           'disabled' => 0
                        ),
                        array(
                           'layouts' => array(
                              array(
                                 'key' => '57b20b62ee5c3',
                                 'name' => 'facebook',
                                 'label' => 'Facebook',
                                 'display' => 'block',
                                 'sub_fields' => array(
                                    array(
                                       'default_value' => '',
                                       'maxlength' => '',
                                       'placeholder' => '',
                                       'prepend' => '',
                                       'append' => '',
                                       'key' => 'field_57b37bd956349',
                                       'label' => 'Text above Facebook feed',
                                       'name' => 'fb_title',
                                       'type' => 'text',
                                       'instructions' => '',
                                       'required' => 0,
                                       'conditional_logic' => 0,
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => ''
                                       )
                                    ),
                                    array(
                                       'default_value' => '',
                                       'placeholder' => '',
                                       'key' => 'field_57b20c5f6928a',
                                       'label' => 'Facebook URL',
                                       'name' => 'facebook_url',
                                       'type' => 'url',
                                       'instructions' => 'Enter a Facebook page URL to generate the feed. e.g. "https://www.facebook.com/makerfaire/"',
                                       'required' => 1,
                                       'conditional_logic' => 0,
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => ''
                                       )
                                    )
                                 ),
                                 'min' => '',
                                 'max' => ''
                              ),
                              array(
                                 'key' => '57b218d7b1f40',
                                 'name' => 'twitter',
                                 'label' => 'Twitter',
                                 'display' => 'block',
                                 'sub_fields' => array(
                                    array(
                                       'default_value' => '',
                                       'maxlength' => '',
                                       'placeholder' => '',
                                       'prepend' => '',
                                       'append' => '',
                                       'key' => 'field_57b37bf35634b',
                                       'label' => 'Text above Twitter feed',
                                       'name' => 'tw_title',
                                       'type' => 'text',
                                       'instructions' => '',
                                       'required' => 0,
                                       'conditional_logic' => 0,
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => ''
                                       )
                                    ),
                                    array(
                                       'default_value' => '',
                                       'maxlength' => '',
                                       'placeholder' => '',
                                       'prepend' => '',
                                       'append' => '',
                                       'key' => 'field_57b218e0b1f41',
                                       'label' => 'Twitter Handle',
                                       'name' => 'twitter_id',
                                       'type' => 'text',
                                       'instructions' => 'Enter Twitter name(handle). e.g. "makerfaire" or "MakerCamp"',
                                       'required' => 1,
                                       'conditional_logic' => 0,
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => ''
                                       ),
                                       'readonly' => 0,
                                       'disabled' => 0
                                    )
                                 ),
                                 'min' => '',
                                 'max' => ''
                              ),
                              array(
                                 'key' => '57b26f1be766d',
                                 'name' => 'instagram',
                                 'label' => 'Instagram',
                                 'display' => 'block',
                                 'sub_fields' => array(
                                    array(
                                       'default_value' => '',
                                       'maxlength' => '',
                                       'placeholder' => '',
                                       'prepend' => '',
                                       'append' => '',
                                       'key' => 'field_57b37c0b5634c',
                                       'label' => 'Text above Instagram feed',
                                       'name' => 'ig_title',
                                       'type' => 'text',
                                       'instructions' => '',
                                       'required' => 0,
                                       'conditional_logic' => 0,
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => ''
                                       )
                                    ),
                                    array(
                                       'default_value' => '',
                                       'new_lines' => '',
                                       'maxlength' => '',
                                       'placeholder' => '',
                                       'rows' => '',
                                       'key' => 'field_57b26f23e766e',
                                       'label' => 'Paste code here',
                                       'name' => 'instagram_iframe',
                                       'type' => 'textarea',
                                       'instructions' => 'Go to this URL to get the iframe code to paste here. https://snapwidget.com/widgets/create?plan=free&service=instagram&type=grid
<br/><br/>
Snapwidget will have you login to Instagram to generate the code. Default settings will work fine, and then click the "Get Widget" button.',
                                       'required' => 1,
                                       'conditional_logic' => 0,
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => ''
                                       ),
                                       'readonly' => 0,
                                       'disabled' => 0
                                    )
                                 ),
                                 'min' => '',
                                 'max' => ''
                              )
                           ),
                           'min' => '',
                           'max' => 3,
                           'button_label' => 'Add Social Feed',
                           'key' => 'field_57b20b0b69289',
                           'label' => 'Active Feeds',
                           'name' => 'active_feeds',
                           'type' => 'flexible_content',
                           'instructions' => 'Click the "Add Social Feed" button for each Social media feeds. Up to 3 feeds can be added.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => ''
                           )
                        )
                     ),
                     'min' => '',
                     'max' => ''
                  ), // End of Social Array
                  // Panel: 3 column - photo and text
                  array(
                     'key' => '5b4e51639ab7e',
                     'name' => '3_column',
                     'label' => '3 column',
                     'display' => 'block',
                     'sub_fields' => array(
                        array(
                           'key' => 'field_5b4e70db5d7d7',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive',
                           ),
                           'allow_null' => 0,
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'default_value' => 'active',
                           'layout' => 'horizontal',
                           'return_format' => 'value',
                        ),
                        array(
                           'key' => 'field_5b4e70905d7d6',
                           'label' => 'Panel Title',
                           'name' => 'panel_title',
                           'type' => 'text',
                           'instructions' => 'Optional: 50 character limit.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'default_value' => '',
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'maxlength' => 50,
                        ),
                        array(
                           'key' => 'field_5b4e5bec567f5',
                           'label' => 'Columns',
                           'name' => 'column',
                           'type' => 'repeater',
                           'instructions' => '',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'collapsed' => '',
                           'min' => 3,
                           'max' => 3,
                           'layout' => 'table',
                           'button_label' => '',
                           'sub_fields' => array(
                              array(
                                 'key' => 'field_5b4e5177fec84',
                                 'label' => 'Type',
                                 'name' => 'column_type',
                                 'type' => 'radio',
                                 'instructions' => '',
                                 'required' => 1,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '30',
                                    'class' => '',
                                    'id' => '',
                                 ),
                                 'choices' => array(
                                    'image' => 'Image with optional link',
                                    'paragraph' => 'Paragraph text',
                                    'list' => 'List of items with optional links',
                                 ),
                                 'allow_null' => 0,
                                 'other_choice' => 0,
                                 'save_other_choice' => 0,
                                 'default_value' => 'image',
                                 'layout' => 'vertical',
                                 'return_format' => 'value',
                              ),
                              array(
                                 'key' => 'field_5b4e645f30c5e',
                                 'label' => 'Data',
                                 'name' => 'data',
                                 'type' => 'group',
                                 'instructions' => '',
                                 'required' => 0,
                                 'conditional_logic' => 0,
                                 'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                 ),
                                 'layout' => 'block',
                                 'sub_fields' => array(
                                    array(
                                       'key' => 'field_5b4e54c9fec85',
                                       'label' => 'Image',
                                       'name' => 'column_image_field',
                                       'type' => 'image',
                                       'instructions' => 'Upload an image',
                                       'required' => 1,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'return_format' => 'url',
                                       'preview_size' => 'thumbnail',
                                       'library' => 'all',
                                       'min_width' => '',
                                       'min_height' => '',
                                       'min_size' => '',
                                       'max_width' => '',
                                       'max_height' => '',
                                       'max_size' => '',
                                       'mime_types' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e6672c7f98',
                                       'label' => 'Image Link',
                                       'name' => 'image_cta',
                                       'type' => 'url',
                                       'instructions' => 'Optional - If supplied, this will make the image a clickable link.',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e66a4c7f99',
                                       'label' => 'Link Text',
                                       'name' => 'image_cta_text',
                                       'type' => 'text',
                                       'instructions' => 'Optional - If supplied, an additional link is displayed below the image using this text.',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => '',
                                       'prepend' => '',
                                       'append' => '',
                                       'maxlength' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e66a4c7f90',
                                       'label' => 'Alignment',
                                       'name' => 'column_list_alignment',
                                       'type' => 'radio',
                                       'instructions' => '',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'image',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '100',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'choices' => array(
                                          'left' => 'Left',
                                          'center' => 'Center',
                                          'right' => 'Right',
                                       ),
                                       'allow_null' => 0,
                                       'other_choice' => 0,
                                       'save_other_choice' => 0,
                                       'default_value' => 'left',
                                       'layout' => 'vertical',
                                       'return_format' => 'value',
                                    ),
                                    array(
                                       'key' => 'field_5b4e54fdfec86',
                                       'label' => 'Paragraph',
                                       'name' => 'column_paragraph',
                                       'type' => 'textarea',
                                       'instructions' => 'Character limit is 350',
                                       'required' => 1,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'paragraph',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => '',
                                       'maxlength' => 350,
                                       'rows' => '',
                                       'new_lines' => '',
                                    ),
                                    array(
                                       'key' => 'field_5b4e61ffa92ef',
                                       'label' => 'List Title',
                                       'name' => 'list_title',
                                       'type' => 'text',
                                       'instructions' => '',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'list',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '105',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'default_value' => '',
                                       'placeholder' => 'ie: Helpful Links',
                                       'prepend' => '',
                                       'append' => '',
                                       'maxlength' => 30,
                                    ),
                                    array(
                                       'key' => 'field_5b4e55f4fec87',
                                       'label' => 'List fields',
                                       'name' => 'column_list_fields',
                                       'type' => 'repeater',
                                       'instructions' => 'Enter in your list items and (if appropriate) their urls (maximum of 5)',
                                       'required' => 0,
                                       'conditional_logic' => array(
                                          array(
                                             array(
                                                'field' => 'field_5b4e5177fec84',
                                                'operator' => '==',
                                                'value' => 'list',
                                             ),
                                          ),
                                       ),
                                       'wrapper' => array(
                                          'width' => '100',
                                          'class' => '',
                                          'id' => '',
                                       ),
                                       'collapsed' => 'field_5b4e561bfec88',
                                       'min' => 1,
                                       'max' => 5,
                                       'layout' => 'table',
                                       'button_label' => '',
                                       'sub_fields' => array(
                                          array(
                                             'key' => 'field_5b4e561bfec88',
                                             'label' => 'Label',
                                             'name' => 'list_text',
                                             'type' => 'text',
                                             'instructions' => '',
                                             'required' => 1,
                                             'conditional_logic' => 0,
                                             'wrapper' => array(
                                                'width' => '',
                                                'class' => '',
                                                'id' => '',
                                             ),
                                             'default_value' => '',
                                             'placeholder' => '',
                                             'prepend' => '',
                                             'append' => '',
                                             'maxlength' => '',
                                          ),
                                          array(
                                             'key' => 'field_5b4e562bfec89',
                                             'label' => 'Link',
                                             'name' => 'list_link',
                                             'type' => 'url',
                                             'instructions' => '',
                                             'required' => 0,
                                             'conditional_logic' => 0,
                                             'wrapper' => array(
                                                'width' => '',
                                                'class' => '',
                                                'id' => '',
                                             ),
                                             'default_value' => '',
                                             'placeholder' => '',
                                          ),
                                       ),
                                    ),
                                 ),
                              ),
                           ),
                        ),
                     ),
                     'min' => '',
                     'max' => '',
                  ), //End of 3 Column 
                  // Panel: Buy Tickets floating banner
                  array(
                     'key' => '57196b4abc501',
                     'name' => 'buy_tickets_float',
                     'label' => 'Get Tickets Floating Banner',
                     'display' => 'row',
                     'sub_fields' => array(
                        array(
                           'layout' => 'horizontal',
                           'choices' => array(
                              'Active' => 'Active',
                              'Inactive' => 'Inactive',
                           ),
                           'default_value' => 'Active',
                           'other_choice' => 0,
                           'save_other_choice' => 0,
                           'allow_null' => 0,
                           'return_format' => 'value',
                           'key' => 'field_57196b4abc502',
                           'label' => 'Active/Inactive',
                           'name' => 'activeinactive',
                           'type' => 'radio',
                           'instructions' => 'This adds a floating banner to buy tickets.',
                           'required' => 0,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => 'activeinactive',
                              'id' => '',
                           ),
                        ),
                        array(
                           'default_value' => '',
                           'placeholder' => '',
                           'key' => 'field_57196b4abc503',
                           'label' => 'Buy Ticket URL',
                           'name' => 'buy_ticket_url',
                           'type' => 'url',
                           'instructions' => 'Required. Enter the URL to the ticket purchasing page for this faire.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                        ),
                        array(
                           'default_value' => '',
                           'maxlength' => 20,
                           'placeholder' => '',
                           'prepend' => '',
                           'append' => '',
                           'key' => 'field_57196b4abc504',
                           'label' => 'Buy Ticket Text',
                           'name' => 'buy_ticket_text',
                           'type' => 'text',
                           'instructions' => 'Please enter the text displayed in the \'Buy Ticket\' Flag.<br/>20 character limit.',
                           'required' => 1,
                           'conditional_logic' => 0,
                           'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                           ),
                           'readonly' => 0,
                           'disabled' => 0,
                        ),
                     ),
                     'min' => '',
                     'max' => 1,
                  )// End of Buy Tickets
               ),
               'min' => '',
               'max' => '',
               'button_label' => 'Add New Panel',
               'key' => 'field_56fc693c7d755',
               'label' => 'Home Page Panels',
               'name' => 'home_page_panels',
               'type' => 'flexible_content',
               'instructions' => 'Add panels here by clicking the "Add New Panel" button at the bottom right side. Panel order can be changed by dragging each up or down.',
               'required' => 0,
               'conditional_logic' => 0,
               'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => ''
               )
            )
         ),
         'location' => array(
            array(
               array(
                  'param' => 'page_template',
                  'operator' => '==',
                  'value' => 'page-home.php'
               )
            )
         ),
         'menu_order' => 1,
         'position' => 'acf_after_title',
         'style' => 'seamless',
         'label_placement' => 'top',
         'instruction_placement' => 'label',
         'hide_on_screen' => array(
            0 => 'permalink',
            1 => 'the_content',
            2 => 'excerpt',
            3 => 'custom_fields',
            4 => 'discussion',
            5 => 'comments',
            6 => 'slug',
            7 => 'format',
            8 => 'page_attributes',
            9 => 'categories',
            10 => 'tags',
            11 => 'send-trackbacks'
         ),
         'active' => 1,
         'description' => ''
      ));
   
   acf_add_local_field_group(array(
      'key' => 'group_5759b470408b6',
      'title' => 'Featured Image Placement',
      'fields' => array(
         array(
            'layout' => 'vertical',
            'choices' => array(
               'Top' => 'Top',
               'Center' => 'Center',
               'Bottom' => 'Bottom',
               'Contain' => 'Contain(shrink to show full image)'
            ),
            'default_value' => 'Center',
            'other_choice' => 0,
            'save_other_choice' => 0,
            'allow_null' => 0,
            'return_format' => 'value',
            'key' => 'field_5759b4901b937',
            'label' => 'Choose the vertical alignment of the featured image on the post page.',
            'name' => 'post_featured_image_placement',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => ''
            )
         )
      ),
      'location' => array(
         array(
            array(
               'param' => 'post_type',
               'operator' => '==',
               'value' => 'post'
            )
         )
      ),
      'menu_order' => 3,
      'position' => 'side',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => 1,
      'description' => '',
      'local' => 'php'
   ));
}