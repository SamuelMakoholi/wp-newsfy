<?php
if ($query->have_posts()) {
    echo '<div class="newsify-widget">';
    while ($query->have_posts()) {
        $query->the_post();
?>
        <div class="newsify-card">
            <a href="<?php the_permalink(); ?>" class="newsify-image">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('medium');
                } else {
                    echo '<img src="http://localhost/research-and-innovation/wp-content/uploads/2025/03/default-post.png" alt="Default News Image">';
                }
                ?>
            </a>
            <div class="newsify-content">
                <div class="newsify-meta"> 
                    <span class="newsify-date"><?php echo get_the_date('F j, Y'); ?></span> 
                    <span class="newsify-separator"> / </span> 
                    <span class="newsify-category"><?php echo get_the_category_list(', '); ?></span> 
                </div>
                <h4 class="newsify-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4> 
                <a href="<?php the_permalink(); ?>" class="newsify-read-more">Read More</a> 
            </div>
        </div>
<?php
    }
    echo '</div>';
    wp_reset_postdata();
} else {
    echo '<p>No news available.</p>';
}
