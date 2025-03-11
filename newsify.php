<?php
/*
Plugin Name: Newsify
Description: A plugin to fetch and display news posts with different layouts.
Version: 1.0
Author: Samuel Makoholi
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue frontend styles and scripts
function newsify_enqueue_assets() {
    // Enqueue CSS
    $css_file = plugin_dir_path(__FILE__) . 'assets/css/style.css';
    if (file_exists($css_file)) {
        wp_enqueue_style(
            'newsify-styles', // Handle
            plugin_dir_url(__FILE__) . 'assets/css/style.css',
            [], // Dependencies
            filemtime($css_file)
        );
    }

    // Enqueue JavaScript
    $js_file = plugin_dir_path(__FILE__) . 'assets/js/scripts.js';
    if (file_exists($js_file)) {
        wp_enqueue_script(
            'newsify-scripts', // Handle
            plugin_dir_url(__FILE__) . 'assets/js/scripts.js', // JS file URL
            ['jquery'], // Dependencies (e.g., jQuery)
            filemtime($js_file), 
            true // Load in footer
        );
    } 
}
add_action('wp_enqueue_scripts', 'newsify_enqueue_assets');



// Load necessary files
require_once plugin_dir_path(__FILE__) . 'includes/class-newsify-fetcher.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-newsify-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-newsify-layouts.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-newsify-admin.php';

// Initialize the plugin
function newsify_initialize_plugin() {
    $fetcher = new Newsify_Fetcher();
    $shortcode = new Newsify_Shortcode($fetcher);
    $layouts = new Newsify_Layouts();
    $admin = new Newsify_Admin();
}
add_action('plugins_loaded', 'newsify_initialize_plugin');