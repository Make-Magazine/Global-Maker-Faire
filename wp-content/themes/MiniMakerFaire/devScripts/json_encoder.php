<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$array = // 2 Columns
                  array(
                     'key' => '76fc69d21b9e7',
                     'name' => '2_column_photo_and_text_panel',
                     'label' => '2 Columns',
                     'display' => 'block',
                     'fields' => array(
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
                           'key' => 'field_7727a8251b207',
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
                           'key' => 'field_7707044778278',
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
                           'key' => 'field_76fc6a5b7d756',
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
                           'key' => 'field_76fc6dfc7d757',
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
                           'key' => 'field_771e908c47dbe',
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
                           'key' => 'field_771e915447dbf',
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
                  ); // End 2 Columns; //End Social Icons
echo json_encode($array);