<?php
class Newsify_Layouts {
    public function __construct() {
        // You can add hooks or filters here if needed
    }

    public function render_grid_layout($query) {
        include plugin_dir_path(__FILE__) . '../templates/layout-grid.php';
    }

    public function render_list_layout($query) {
        include plugin_dir_path(__FILE__) . '../templates/layout-list.php';
    }

    public function render_carousel_layout($query) {
        include plugin_dir_path(__FILE__) . '../templates/layout-carousel.php';
    }
}