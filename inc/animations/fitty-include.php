<?php 
// Register Fitty JS
if ( ! function_exists( 'jdd_fitty' ) ) { 
	
	function jdd_fitty() {
		// Run the code only on the frontend and on the canvas, not in the builder panel
		if ( ! bricks_is_builder_main() ) {
			// Import the main library
			wp_enqueue_script(
				'fitty-js',
				get_stylesheet_directory_uri() . '/vendor/fitty/fitty.min.js',
				array(), // No dependencies
				filemtime( get_stylesheet_directory() . '/vendor/fitty/fitty.min.js' ),
				true // Loaded in the footer
			);

			// Import the custom script
			wp_enqueue_script(
				'jdd_fitty_init',
				get_stylesheet_directory_uri() . '/public/js/fitty-init.js',
				array( 'fitty-js' ), // Depends on fitty-js
				filemtime( get_stylesheet_directory() . '/public/js/fitty-init.js' ),
				true // Loaded in the footer
			);
		}
	}
}

add_action( 'wp_enqueue_scripts', 'jdd_fitty' );