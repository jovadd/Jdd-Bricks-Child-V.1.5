<?php 
/**
 * Register CSS file
 */
add_action( 'wp_enqueue_scripts', function() {
	if ( ! bricks_is_builder_main() ) {
		wp_enqueue_style( 'jdd_custom_style', get_stylesheet_directory_uri() . '/public/css/jdd_style.css' , filemtime( get_stylesheet_directory() . '/public/css/jdd_style.css' ) );
	}
} );
