<?php
add_action( 'after_setup_theme', 'mf_theme_setup' );
function mf_theme_setup(){
    load_theme_textdomain( 'MiniMakerFaire', get_template_directory() . '/languages' );
}

