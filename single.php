<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
    
    <main class="single-post container">
        <article>
            <h1><?php the_title(); ?></h1>
            <p class="post-meta">
                <?php echo get_the_date(); ?> |
                <?php the_category(', '); ?>
            </p>
            
            <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail('large');
            } ?>

            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
    </main>

    <?php endwhile;
endif;

get_footer();
?>