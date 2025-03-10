<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Newsify_Admin {
    public function __construct() {
        // Add admin menu
        add_action('admin_menu', [$this, 'add_admin_menu']);

        // Add "Settings" link to the plugin action links
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), [$this, 'add_plugin_action_links']);

        // Add dashboard widget (optional)
        add_action('wp_dashboard_setup', [$this, 'add_dashboard_widget']);

        // Enqueue admin styles (optional)
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
    }

    // Add admin menu
    public function add_admin_menu() {
        add_menu_page(
            'Newsify Settings',          // Page title
            'Newsify',                   // Menu title
            'manage_options',            // Capability required to access
            'newsify-settings',          // Menu slug
            [$this, 'render_settings_page'], // Callback function to render the page
            'dashicons-admin-post',      // Icon (optional)
            6                           // Position in the menu (optional)
        );
    }

    // Render the settings page
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Newsify Settings</h1>
            <p>Welcome to the Newsify plugin settings page. Here are the available shortcodes:</p>

            <h2>Shortcodes</h2>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Shortcode</th>
                        <th>Description</th>
                        <th>Example</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>[newsify]</code></td>
                        <td>Displays news posts in a grid layout.</td>
                        <td><code>[newsify layout="grid" posts_per_page="5"]</code></td>
                    </tr>
                    <tr>
                        <td><code>[newsify]</code></td>
                        <td>Displays news posts in a list layout.</td>
                        <td><code>[newsify layout="list" posts_per_page="3"]</code></td>
                    </tr>
                    <tr>
                        <td><code>[newsify]</code></td>
                        <td>Displays news posts in a carousel layout.</td>
                        <td><code>[newsify layout="carousel" posts_per_page="4"]</code></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
    }

    // Add "Settings" link to the plugin action links
    public function add_plugin_action_links($links) {
        $settings_link = '<a href="' . admin_url('admin.php?page=newsify-settings') . '">Settings</a>';
        array_unshift($links, $settings_link);
        return $links;
    }

    // Add a dashboard widget (optional)
    public function add_dashboard_widget() {
        wp_add_dashboard_widget(
            'newsify_dashboard_widget',  // Widget ID
            'Newsify Shortcodes',        // Widget title
            [$this, 'render_dashboard_widget_content'] // Callback function to render the widget content
        );
    }

    // Render the dashboard widget content
    public function render_dashboard_widget_content() {
        ?>
        <p>Here are the available shortcodes for the Newsify plugin:</p>
        <ul>
            <li><code>[newsify layout="grid" posts_per_page="5"]</code> - Displays posts in a grid layout.</li>
            <li><code>[newsify layout="list" posts_per_page="3"]</code> - Displays posts in a list layout.</li>
            <li><code>[newsify layout="carousel" posts_per_page="4"]</code> - Displays posts in a carousel layout.</li>
        </ul>
        <p>For more details, visit the <a href="<?php echo admin_url('admin.php?page=newsify-settings'); ?>">Newsify Settings</a> page.</p>
        <?php
    }

    // Enqueue admin styles (optional)
    public function enqueue_admin_styles() {
        wp_enqueue_style('newsify-admin-styles', plugin_dir_url(__FILE__) . '../assets/css/admin-styles.css');
    }
}