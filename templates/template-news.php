<?php
require_once get_theme_file_path('parts/part-main-casino.php');

$args_data = [
    'cat_title' => 'Новости мира казино',
    'post_type' => 'news',
    'posts_per_page' => 20,
    'post_image' => 'photo',
    'cat_template' => 'title',
];

$params = false;


require( get_theme_file_path('/parts/part-display-promo-cat.php') ); 

require( get_theme_file_path('/parts/part-page-switch.php') ); 


?>