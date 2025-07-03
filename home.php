<?php
/* Template Name: Home */
get_header();
?>

<main>
    <div class="container">

        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $post_query = new WP_Query( $args );
        ?>

        <?php if ( $post_query->have_posts() ) : ?>

            <div class="posts-grid">
                <?php $post_count = 0; ?>
                
                <?php while ( $post_query->have_posts() ) : $post_query->the_post(); $post_count++; ?>
                    <?php if ( $post_count <= 4 ) : ?>
                        <div class="post-item-horizontal">
                            <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-item-horizontal__thumbnail">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php else :
                                    $first_img = get_first_image_from_content();
                                    if ( $first_img ) : ?>
                                        <div class="post-item-horizontal__thumbnail">
                                            <img src="<?php echo esc_url($first_img); ?>" alt="<?php the_title_attribute(); ?>">
                                        </div>
                                    <?php endif;
                                endif; ?>

                                <div class="post-item-horizontal__text">
                                    <h2 class="post-item-horizontal__title"><?php the_title(); ?></h2>
                                    <div class="post-item-horizontal__meta">
                                        <small><?php the_date(); ?></small>
                                        <span><?php the_category(', '); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <div class="vertical-and-form">
                <div class="vertical-posts">
                    <?php
                    $args['offset'] = 4;
                    $args['posts_per_page'] = 6;
                    $post_query = new WP_Query( $args );
                    if ( $post_query->have_posts() ) :
                        while ( $post_query->have_posts() ) : $post_query->the_post();
                    ?>
                        <div class="post-item-vertical">
                            <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-item-vertical__thumbnail">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php else :
                                    $first_img = get_first_image_from_content();
                                    if ( $first_img ) : ?>
                                        <div class="post-item-vertical__thumbnail">
                                            <img src="<?php echo esc_url($first_img); ?>" alt="<?php the_title_attribute(); ?>">
                                        </div>
                                    <?php endif;
                                endif; ?>

                                <div class="post-item-vertical__text">
                                    <h2 class="post-item-vertical__title"><?php the_title(); ?></h2>
                                    <div class="post-item-vertical__meta">
                                        <small><?php the_date(); ?></small>
                                        <span><?php the_category(', '); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </div>

                <div class="form-block">
                    <?php echo do_shortcode('[fluentform id="2"]'); ?>
                </div>
            </div>
            
        <?php else : ?>
            <p>No news to display.</p>
        <?php endif; ?>

    </div>       
</main>

<?php
get_footer(); ?>