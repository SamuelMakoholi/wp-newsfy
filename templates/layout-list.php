<?php if ($query->have_posts()) : ?>
    <div class="newsify-list">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="newsify-post">
                <!-- Post Thumbnail -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="newsify-post-thumbnail">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                <?php endif; ?>

                <!-- Post Title -->
                <h3 class="newsify-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>

                <!-- Post Excerpt -->
                <div class="newsify-post-excerpt">
                    <?php the_excerpt(); ?>
                </div>

                <!-- Read More Link -->
                <a class="newsify-read-more" href="<?php the_permalink(); ?>">Read More</a>
            </div>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <p>No news posts found.</p>
<?php endif; ?>