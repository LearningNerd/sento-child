<?php
// Enqueue child theme
function sento_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}
add_action( 'wp_enqueue_scripts', 'sento_child_enqueue_styles' );

// Enqueue Google fonts
function sento_child_add_google_fonts() {

wp_enqueue_style( 'sento_child-fonts', 'https://fonts.googleapis.com/css?family=Fira+Sans:300,400|Ubuntu:300,400,500', false ); 
}
add_action( 'wp_enqueue_scripts', 'sento_child_add_google_fonts' );

