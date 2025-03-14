<?php
if ($query->have_posts()) {
    echo '<div class="newsify-list">'; // List container
    while ($query->have_posts()) {
        $query->the_post();
?>
        <div class="newsify-list-item"> <!-- List item -->
            <a href="<?php the_permalink(); ?>" class="newsify-list-image"> <!-- Image -->
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('medium');
                } else {
                    // Use the default image from the plugin directory
                    echo '<img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/default-post.png" alt="Post News Image">';
                }
                ?>
            </a>
            <div class="newsify-list-content"> <!-- Content -->
                <div class="newsify-list-meta"> <!-- Meta -->
                    <span class="newsify-list-date"><?php echo get_the_date('F j, Y'); ?></span>
                    <span class="newsify-list-separator"> / </span>
                    <span class="newsify-list-category"><?php echo get_the_category_list(', '); ?></span>
                </div>
                <h4 class="newsify-list-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="newsify-list-excerpt"><?php the_excerpt(); ?></div>
                <a href="<?php the_permalink(); ?>" class="newsify-list-read-more">Read More</a>
            </div>
        </div>
<?php
    }
    echo '</div>';
    wp_reset_postdata();
} else {
    echo '<p>No news available.</p>';
}