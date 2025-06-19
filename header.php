<!DOCTYPE html>
<html>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <title>epc</title>
</head>
<body>
    <header class="header">
        <p>logo</p>
        <div class="header__categories">
            <nav class="category-nav">
                <ul class="category-list">
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
    </header>