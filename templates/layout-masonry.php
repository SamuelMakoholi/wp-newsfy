<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if ($query->have_posts()) {
    echo '<div class="newsify-masonry-container">'; // Main masonry container
    while ($query->have_posts()) {
        $query->the_post();
        
        // Get post category and determine a class for color variation
        $categories = get_the_category();
        $category_class = !empty($categories) ? 'category-' . $categories[0]->term_id % 5 : 'category-0';
        
        // Determine a random height class for visual variety
        $height_classes = ['standard', 'tall', 'short'];
        $height_class = $height_classes[array_rand($height_classes)];
?>
        <div class="newsify-masonry-item <?php echo $height_class; ?> <?php echo $category_class; ?>">
            <article class="newsify-masonry-card">
                <a href="<?php the_permalink(); ?>" class="newsify-masonry-image-link">
                    <div class="newsify-masonry-image-container">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('medium_large');
                        } else {
                            // Use the default image from the plugin directory
                            echo '<img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/default-post.png" alt="Post News Image">';
                        }
                        ?>
                        <div class="newsify-masonry-image-overlay"></div>
                    </div>
                    
                    <div class="newsify-masonry-meta">
                        <span class="newsify-masonry-category"><?php echo get_the_category_list(', '); ?></span>
                        <span class="newsify-masonry-date"><?php echo get_the_date('F j, Y'); ?></span>
                    </div>
                    
                    <h3 class="newsify-masonry-title"><?php the_title(); ?></h3>
                    
                    <div class="newsify-masonry-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </div>
                    
                    <span class="newsify-masonry-read-more">
                        Read More<span class="newsify-masonry-arrow">→</span>
                    </span>
                </a>
            </article>
        </div>
<?php
    }
    echo '</div>';
    wp_reset_postdata();
} else {
    echo '<p>No news available.</p>';
}
?>
