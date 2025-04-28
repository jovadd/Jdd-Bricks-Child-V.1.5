<?php
// Enqueue style.css only in the backend if ACPT is active
function jdd_enqueue_admin_style_if_acpt_active() {
    // Check if the ACPT plugin is active
    if ( is_plugin_active( 'advanced-custom-post-type/advanced-custom-post-type.php' ) ) { 
        // Enqueue the style.css file only in the backend
        wp_enqueue_style(
            'jdd-admin-style', // Unique handle
            get_stylesheet_directory_uri() . '/admin/css//acpt-admin-custom-style.css', // Path to the CSS file
            array(), // No dependencies
            filemtime( get_stylesheet_directory() . '/admin/css//acpt-admin-custom-style.css' ) // Dynamic version
        );
    }
}
add_action( 'admin_enqueue_scripts', 'jdd_enqueue_admin_style_if_acpt_active' );