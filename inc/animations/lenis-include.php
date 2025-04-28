<?php
// Include Lenis and initialization
add_action( 'wp_enqueue_scripts', function() {
    // Lenis Initialization CSS
    wp_enqueue_style( 'jdd-lenis-styles', get_stylesheet_directory_uri() . '/public/css/lenis-init.css', array(), '1.0' );

    // Load Lenis from CDN
    wp_enqueue_script( 'lenis', 'https://unpkg.com/lenis@1.3.1/dist/lenis.min.js', array(), null, true );

    // Load your Lenis initialization file
    wp_enqueue_script( 'lenis-init', get_stylesheet_directory_uri() . '/public/js/lenis-init.js', array('lenis'), null, true );
}, 20);