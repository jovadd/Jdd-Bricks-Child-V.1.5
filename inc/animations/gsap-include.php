<?php  
// Register Custom JS and GSAP for the site.
if ( ! function_exists( 'jdd_gsap_script' ) ) {    
    function jdd_gsap_script() { 
        // Run the code only on the frontend and on the canvas, not in the builder panel
        if ( ! bricks_is_builder_main() ) { 
            // GSAP Animations CSS
            wp_enqueue_style( 'jdd-gsap-animations', get_stylesheet_directory_uri() . '/public/css/gsap-animations.css', array(), '1.0' ); 
            
            // Import the main GSAP library
            wp_enqueue_script( 'jdd_gsap-js', 'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js', array(), false, true ); 
            
            // ScrollTrigger with gsap.js as a dependency
            wp_enqueue_script( 'jdd_gsap-st', 'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js', array( 'jdd_gsap-js' ), false, true ); 
            
            // Import the custom script
            wp_enqueue_script( 'jdd_custom-script-gsap', get_stylesheet_directory_uri() . '/public/js/gsap-scripts.js', array( 'jdd_gsap-js', 'jdd_gsap-st' ), filemtime( get_stylesheet_directory() . '/public/js/gsap-scripts.js' ), true ); 
        } 
    } 
}

add_action( 'wp_enqueue_scripts', 'jdd_gsap_script' );