<?php
// If uninstall is not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options
delete_option('newsify_settings');
delete_option('newsify_db_version');


// Delete transients that might have been set
delete_transient('newsify_cached_posts');


// For site options in multisite
delete_site_option('newsify_settings');
delete_site_option('newsify_db_version');


// For any custom tables created by the plugin (if any in future versions)
// global $wpdb;
// $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}newsify_custom_table");


// For custom post types, uncomment to delete all posts (not relevant for current version)
// $posts = get_posts(array('post_type' => 'custom_post_type', 'numberposts' => -1));
// foreach ($posts as $post) {
//     wp_delete_post($post->ID, true);
// }

// For user metadata cleanup (if needed in future versions)
// global $wpdb;
// $wpdb->query( "DELETE FROM $wpdb->usermeta WHERE meta_key LIKE 'newsify_%'" );

// Clear any scheduled cron events
wp_clear_scheduled_hook('newsify_daily_cleanup');