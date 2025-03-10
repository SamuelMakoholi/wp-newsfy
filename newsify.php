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