<?php
class Newsify_Shortcode
{
    private $fetcher;

    public function __construct($fetcher)
    {
        $this->fetcher = $fetcher;
        add_shortcode('newsify', [$this, 'render_shortcode']);
    }

    public function render_shortcode($atts)
    {
        // Parse shortcode attributes
        $atts = shortcode_atts([
            'layout' => 'grid', // Default layout
            'posts_per_page' => 3, // Default number of posts per page
            'category' => '', // Default category (empty)
        ], $atts);

        // Fetch posts based on the provided attributes
        $query = $this->fetcher->get_posts([
            'posts_per_page' => $atts['posts_per_page'], // Pass the number of posts per page
            'category_name'  => $atts['category'], // Pass the category to the fetcher
        ]);

        // Render the template
        ob_start();
        include plugin_dir_path(__FILE__) . '../templates/layout-' . $atts['layout'] . '.php';
        echo $this->render_pagination($query); // Add pagination
        return ob_get_clean();
    }

    private function render_pagination($query)
    {
        $big = 999999999; // Need an unlikely integer
        $pagination = paginate_links([
            'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'  => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total'   => $query->max_num_pages,
        ]);

        // Only return the pagination div if we have pagination links
        if ($pagination) {
            return '<div class="newsify-pagination">' . $pagination . '</div>';
        }
        return '';
    }
}
