<!DOCTYPE html>
<html>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Titillium+Web&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
    <title>epc</title>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="overlay" id="menu-overlay"></div>
            <div class="container">

                <?php
                $logo = get_field('site_logo', 'option');

                if ($logo):
                    echo '<a href="' . esc_url(home_url('/')) . '">';
                    echo '<img class="header__logo" src="' . esc_url($logo['url']) . '" alt="' . esc_attr($logo['alt']) . '">';
                    echo '</a>';
                endif;
                ?>

                <div class="header__categories" id='main-menu'>
                    <nav class="header__category-nav">
                        <ul class="header__category-list">
                            <?php
                            wp_list_categories([
                                'title_li' => '',
                                'show_option_none' => '',
                                'hide_empty' => false,
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'exclude' => get_cat_ID('Uncategorized'),
                            ]);
                            ?>
                        </ul>
                    </nav>
                </div>

                <div class="header__categories-preview"></div>

                <button id="open-mobile-menu" class="burger-btn" aria-label="Open menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="mobile-wrapper">
                    <div class="close-button-wrapper">
                        <button id="close-mobile-menu" class="close-btn" aria-label="Close menu">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                    <div class="header__mobile-categories" id='mobile-menu'>
                        <nav class="category-mobile-nav">
                            <ul class="category-mobile-list">
                                <?php
                                wp_list_categories([
                                    'title_li' => '',
                                    'show_option_none' => '',
                                    'hide_empty' => false,
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                    'exclude' => get_cat_ID('Uncategorized'),
                                ]);
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </header>