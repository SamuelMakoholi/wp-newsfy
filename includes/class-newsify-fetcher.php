<?php
/**
 * Newsify Post Fetcher Class
 *
 * @package Newsify
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

class Newsify_Fetcher {
    /**
     * Get posts based on provided arguments
     *
     * @param array $args Arguments for post retrieval.
     * @return WP_Query Query object with posts.
     */
    public function get_posts($args = []) {
        // Default arguments
        $defaults = [
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'paged'          => get_query_var('paged', 1),
            'post_status'    => 'publish',
            'order'          => 'DESC',
            'orderby'        => 'date',
            'ignore_sticky_posts' => 1, // Ignore sticky posts by default
        ];
        
        // Merge user args with defaults
        $query_args = wp_parse_args($args, $defaults);
        
        // Apply filters to allow other plugins to modify the query
        $query_args = apply_filters('newsify_query_args', $query_args);
        
        // Create and execute the query
        return new WP_Query($query_args);
    }
    
    /**
     * Get all categories for use in admin dropdowns
     *
     * @return array Array of category objects
     */
    public function get_categories() {
        return get_categories([
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC',
        ]);
    }
}