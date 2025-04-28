<?php 
function jdd_enqueue_admin_assets() {
    // Enqueue the CSS file for the backend from the child theme
    wp_enqueue_style(
        'jdd-admin-styles', // Unique style handle
        get_stylesheet_directory_uri() . '/admin/css/jdd-admin-style.css', // Path to the CSS file in the child theme
        [],
        filemtime( get_stylesheet_directory() . '/admin/css/jdd-admin-style.css' ) // Version based on the last modification
    );

    // Enqueue the JavaScript file for the backend from the child theme
    wp_enqueue_script(
        'jdd-admin-scripts', // Unique script handle
        get_stylesheet_directory_uri() . '/admin/js/jdd-admin-script.js', // Path to the JavaScript file in the child theme
        ['jquery'], // Dependencies, if necessary
        filemtime( get_stylesheet_directory() . '/admin/js/jdd-admin-script.js' ), // Version based on the last modification
        true // Load in the footer
    );
}
add_action( 'admin_enqueue_scripts', 'jdd_enqueue_admin_assets' );

// Change the WordPress Login Logo
function jdd_custom_login_logo() {
    echo '<style type="text/css">
        #login h1 a {
            background-image: url(' . get_stylesheet_directory_uri() . '/assets/img/LogoWPAccess.png) !important;
            background-size: contain !important;
            width: 100% !important;
            height: 80px !important;
        }
    </style>';
}
add_action('login_head', 'jdd_custom_login_logo');