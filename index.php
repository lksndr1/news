<?php get_header(); ?> 
    <main>
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                
                <div class="post-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-item__thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php else :
                            $first_img = get_first_image_from_content();
                            if ( $first_img ) : ?>
                                <div class="post-item__thumbnail">
                                    <img src="<?php echo esc_url($first_img); ?>" alt="<?php the_title_attribute(); ?>">
                                </div>
                            <?php endif;
                        endif; ?>

                        <div class="post-item__text">
                            <h2 class="post-item__title"><?php the_title(); ?></h2>
                            <div class="post-item__meta">
                                <small><?php the_date(); ?></small>
                                <span><?php the_category(', '); ?></span>
                            </div>
                        </div>
                    </a>
                </div>

                <?php endwhile; ?>
            <?php else : ?>
                <p>No news to display.</p>
            <?php endif; ?>

            <?php echo do_shortcode('[fluentform id="2"]'); ?>
        </div>       
    </main>
<?php get_footer(); ?>