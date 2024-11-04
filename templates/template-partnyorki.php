<?php
require_once get_theme_file_path('parts/part-main-casino.php');

// Общие данные для категорий
$args_data = [
    'cat_title' => 'Партнерские программы онлайн казино',
    'post_type' => 'partnyorki',
    'posts_per_page' => 12,
    'post_image' => 'логотип_без_фона',
    'cat_template' => 'more'
];

// Массив параметров страниц с фильтрацией и сортировкой
$params = false;


require( get_theme_file_path('/parts/part-display-promo-cat.php') ); 

require( get_theme_file_path('/parts/part-page-switch.php') ); 

// require( get_theme_file_path('/parts/cat-content/cat-disclamer.php') ); 

// require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 

?>