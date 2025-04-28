<?php
// Enqueue the script.js with a check for Bricks
function jdd_enqueue_scripts() {
    // Check that we are not in the main Bricks editor
    if ( ! bricks_is_builder_main() ) {
        // Register and load the script.js file from the child theme directory
        wp_enqueue_script(
            'jdd-custom-script', // Unique handle
            get_stylesheet_directory_uri() . '/public/js/jdd_scripts.js', // Path to the script.js file
            array(), // Dependencies (empty if none)
            filemtime(get_stylesheet_directory() . '/public/js/jdd_scripts.js'), // Version based on the last modification time
            true // Load in the footer
        );
    }
}
add_action('wp_enqueue_scripts', 'jdd_enqueue_scripts');