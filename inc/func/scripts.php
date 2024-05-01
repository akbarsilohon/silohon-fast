<?php
/**
 * Function script handler Silohon Fast Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_action( 'wp_enqueue_scripts', 'fast_wp_enqueue_scripts' );
function fast_wp_enqueue_scripts(){
    wp_enqueue_style( 'fast-style', get_stylesheet_uri(), array(), fileatime( FAST_DIR . '/style.css'), 'all' );
    wp_enqueue_script( 'fast-script', FAST_URI . '/asset/js/main.js', [], fileatime( FAST_DIR . '/asset/js/main.js' ), true );
}