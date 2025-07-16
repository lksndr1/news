<?php

function my_theme_enqueue_scripts() {
  wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/css/main.css');
  
  wp_enqueue_script('main-scripts', get_template_directory_uri() . '/dist/js/main.js', array('jquery'), false, true);

  wp_localize_script('main-scripts', 'ajaxurl', admin_url('admin-ajax.php'));
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Header Settings',
        'menu_title' => 'Header',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Footer Settings',
        'menu_title' => 'Footer',
        'parent_slug' => 'theme-general-settings',
    ));
}

function wp_epc_menus()
{
    $locations = array(
        'header' => __('Header Menu', 'wp_epc'),
        'footer' => __('Footer Menu', 'wp_epc'),
    );

    register_nav_menus($locations);
}

add_action('init', 'wp_epc_menus');

add_theme_support('post-thumbnails');

function get_first_image_from_content() {
    global $post;
    $content = $post->post_content;

    if ( preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches) ) {
        return $matches[1];
    }

    return false;
}

function custom_posts_per_page($query) {
    if ($query->is_main_query() && !is_admin()) {
        $query->set('posts_per_page', -1);
    }
}
add_action('pre_get_posts', 'custom_posts_per_page');


// posts-preview
add_action('wp_ajax_get_category_posts', 'get_category_posts');
add_action('wp_ajax_nopriv_get_category_posts', 'get_category_posts');

function get_category_posts() {
    $category_id = intval($_POST['category_id']);

    $args = array(
        'cat' => $category_id,
        'posts_per_page' => 5,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="header__category-post">
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

                    <?php the_title(); ?>
                </a>
            </div>
        <?php endwhile;
    else :
        echo '<p>No posts in this category.</p>';
    endif;

    wp_reset_postdata();
    wp_die();
}