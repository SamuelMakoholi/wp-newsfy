<?php
class Newsify_Fetcher {
    public function get_posts($args = []) {
        $defaults = [
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'category_name'  => 'news',
            'paged'         => get_query_var('paged', 1), // Add pagination support
        ];
        $query_args = wp_parse_args($args, $defaults);
        return new WP_Query($query_args);
    }
}