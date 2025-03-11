<?php
class Newsify_Shortcode {
    private $fetcher;

    public function __construct($fetcher) {
        $this->fetcher = $fetcher;
        add_shortcode('newsify', [$this, 'render_shortcode']);
        //put some comments
        
    }

    public function render_shortcode($atts) {
        $atts = shortcode_atts([
            'layout' => 'grid',
            'posts_per_page' => 5,
        ], $atts);

        $query = $this->fetcher->get_posts([
            'posts_per_page' => $atts['posts_per_page'],
        ]);

        ob_start();
        include plugin_dir_path(__FILE__) . '../templates/layout-' . $atts['layout'] . '.php';

        // Add pagination
        echo $this->render_pagination($query);

        return ob_get_clean();
    }

    private function render_pagination($query) {
        $big = 999999999; // Need an unlikely integer
        $pagination = paginate_links([
            'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'  => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total'   => $query->max_num_pages,
        ]);

        return '<div class="newsify-pagination">' . $pagination . '</div>';
    }
}
