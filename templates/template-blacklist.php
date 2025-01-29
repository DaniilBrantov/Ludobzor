<?php
require_once get_theme_file_path('parts/part-main-casino.php');

$args_data = [
    'cat_title' => 'Чёрный список казино',
    'post_type' => 'online_casino',
    'posts_per_page' => 12,
    'post_image' => 'logo',
    'cat_template' => 'more-data',
    'meta_query' => [
        [
            'key'     => 'черный_список',
            'value'   => true,
            'compare' => '=',
        ],
    ]
];

$params = false;


require( get_theme_file_path('/parts/part-display-promo-cat.php') ); 

require( get_theme_file_path('/parts/part-page-switch.php') ); 

require( get_theme_file_path('/parts/cat-content/cat-disclamer.php') ); 

require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 

?>