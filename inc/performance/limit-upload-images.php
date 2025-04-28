<?php
function jdd_limit_image_size($file) {
    // Determine whether to use the message in Italian or English
    $is_italian = get_option('jdd_language_italian', false);
    
    // File size limit in bytes (900 KB = 900 * 1024 bytes)
    $size_limit = 500 * 1024;
    
    // Check if it is an image
    $file_type = wp_check_filetype($file['name']);
    $image_types = array('jpg', 'jpeg', 'png', 'gif', 'webp');
    
    if (in_array(strtolower($file_type['ext']), $image_types)) {
        // Check the file size
        if ($file['size'] > $size_limit) {
            // Error message based on the selected language
            $error_message = $is_italian 
                ? 'L\'immagine è troppo grande. Il limite massimo è di 500 KB.'
                : 'The image is too large. The maximum limit is 500 KB.';
                
            $file['error'] = $error_message;
        }
    }
    
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'jdd_limit_image_size');