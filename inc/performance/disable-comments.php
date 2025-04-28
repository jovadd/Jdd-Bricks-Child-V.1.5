<?php 
// Disable comments throughout the site
function jdd_disable_comments_everywhere() {
    // Disable comment support for all post types
    foreach (get_post_types() as $post_type) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
    }
}
add_action('init', 'jdd_disable_comments_everywhere');

// Remove comment-related items from the dashboard
function jdd_remove_comments_from_admin_menu() {
    remove_menu_page('edit-comments.php'); // Removes the "Comments" menu item from the admin menu
}
add_action('admin_menu', 'jdd_remove_comments_from_admin_menu');

// Redirect attempts to access the comments page
function jdd_redirect_comments_page() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'jdd_redirect_comments_page');

// Remove the comments widget from the dashboard
function jdd_remove_comments_dashboard_widget() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'jdd_remove_comments_dashboard_widget');

// Remove comments from the admin bar menu
function jdd_remove_comments_from_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'jdd_remove_comments_from_admin_bar');