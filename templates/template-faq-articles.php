<?php
require_once get_theme_file_path('parts/part-main-casino.php');

// Общие данные для категорий
$args_data = [
    'cat_title' => 'F.A.Q. - Самые популярные вопросы об online casino ',
    'post_type' => 'faq_articles',
    'posts_per_page' => 20,
    'post_image' => 'фото_для_главной',
    'cat_template' => 'title',
];

// Массив параметров страниц с фильтрацией и сортировкой
$params = false;


require( get_theme_file_path('/parts/part-display-promo-cat.php') ); 

require( get_theme_file_path('/parts/part-page-switch.php') ); 

// require( get_theme_file_path('/parts/cat-content/cat-disclamer.php') ); 

// require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 

?>