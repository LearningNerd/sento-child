<?php
// Enqueue child theme
function sento_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'sento_child_enqueue_styles' );

// Enqueue Google fonts
function sento_child_add_google_fonts() {

wp_enqueue_style( 'sento_child-fonts', 'https://fonts.googleapis.com/css?family=Fira+Sans|Ubuntu', false ); 
}
add_action( 'wp_enqueue_scripts', 'sento_child_add_google_fonts' );

