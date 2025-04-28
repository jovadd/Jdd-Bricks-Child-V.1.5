<?php
// =========================================
// Include Core Functionalities
// =========================================
require_once get_stylesheet_directory() . '/inc/setup/theme-style.php';               // Include Theme Style
require_once get_stylesheet_directory() . '/inc/setup/theme-options-page.php';        // Include Theme Options Page

// =========================================
// Conditional Functionalities
// =========================================

// Animations and Scripts
if ( get_option( 'jdd_enable_gsap' ) ) {
    require_once get_stylesheet_directory() . '/inc/animations/gsap-include.php';         // Include GSAP and Scripts file
}
if ( get_option( 'jdd_enable_lenis' ) ) {
    require_once get_stylesheet_directory() . '/inc/animations/lenis-include.php';        // Include Lenis for smooth scrolling
}
if ( get_option( 'jdd_enable_fitty' ) ) {
    require_once get_stylesheet_directory() . '/inc/animations/fitty-include.php';        // Include Fitty
}

// Custom Styles and Scripts
if ( get_option( 'jdd_enable_custom_style' ) ) {
    require_once get_stylesheet_directory() . '/inc/dev-features/active-style.php';         // Include Custom Style
}
if ( get_option( 'jdd_enable_custom_scripts' ) ) {
    require_once get_stylesheet_directory() . '/inc/dev-features/active-scripts.php';       // Include Custom Scripts
}

// WordPress Core Modifications - Performance
if ( get_option( 'jdd_disable_gutenberg' ) ) {
    require_once get_stylesheet_directory() . '/inc/performance/gutenberg-disable.php';    // Disable Gutenberg and its styles
}
if ( get_option( 'jdd_disable_comments' ) ) {
    require_once get_stylesheet_directory() . '/inc/performance/disable-comments.php';     // Disable Comments and remove from Dashboard
}
if ( get_option( 'jdd_enable_image_size_limit' ) ) {
    require_once get_stylesheet_directory() . '/inc/performance/limit-upload-images.php';   // Limit Upload Imnages to a maximum size
}

// Backend Enhancements
if ( get_option( 'jdd_enable_admin_style_acpt' ) ) {
    require_once get_stylesheet_directory() . '/inc/thirdy-party/admin-style-acpt.php';      // Enable Custom Styles for ACPT | Backend only and only if installed
}