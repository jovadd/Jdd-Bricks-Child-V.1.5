<?php 
// Disable Gutenberg for all post types
add_filter('use_block_editor_for_post', '__return_false', 10);

// Completely disable Gutenberg CSS
add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('wp-block-library'); // Frontend
    wp_dequeue_style('wp-block-library-theme'); // Theme
    wp_dequeue_style('wc-block-style'); // WooCommerce
}, 100);

// Hide the "Add Block" icon in the editor
add_action('admin_enqueue_scripts', function() {
    wp_dequeue_script('wp-block-editor');
});

// Remove the inline "Classic Theme Styles"
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'classic-theme-styles' );
    wp_deregister_style( 'classic-theme-styles' );
}, 20 );