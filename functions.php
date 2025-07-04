<?php

function my_theme_enqueue_scripts() {
  wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/css/main.css');
  
  wp_enqueue_script('main-scripts', get_template_directory_uri() . '/dist/js/main.js', [], false, true);
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