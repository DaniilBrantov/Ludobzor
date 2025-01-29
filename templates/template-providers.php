<?php
require_once get_theme_file_path('parts/part-main-casino.php');

$args_data = [
    'cat_title' => 'Провайдеры',
    'post_type' => 'providers',
    'posts_per_page' => 12,
    'post_image' => 'logo',
    'cat_template' => 'more-data'
];

$params = false;


require( get_theme_file_path('/parts/part-display-promo-cat.php') ); 

require( get_theme_file_path('/parts/part-page-switch.php') ); 

require( get_theme_file_path('/parts/cat-content/cat-disclamer.php') ); 

require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 

?>