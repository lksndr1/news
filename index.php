<?php get_header(); ?> 
    <main>

    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
            <?php else :
                $first_img = get_first_image_from_content();
                if ( $first_img ) : ?>
                    <div class="post-thumbnail">
                        <img src="<?php echo esc_url($first_img); ?>" alt="<?php the_title_attribute(); ?>">
                    </div>
                <?php endif;
            endif; ?>

            <h2><?php the_title(); ?></h2>
            <div class="post-meta">
                <small><?php the_date(); ?></small> |
                <span><?php the_category(', '); ?></span>
            </div>
        </a>

        <?php endwhile; ?>
    <?php else : ?>
        <p>No news to display.</p>
    <?php endif; ?>

        <?php echo do_shortcode('[fluentform id="2"]'); ?>

    </main>
<?php get_footer(); ?>