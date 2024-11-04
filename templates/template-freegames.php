<?php
require_once get_theme_file_path('parts/part-main-casino.php');

        // Бесплатные игровые автоматы

        // Массив параметров
        $params = [
            'taxonomies' => [
                [
                    'taxonomy' => 'view-of-game',
                    'hide_empty' => false,
                    'id' => 'vgames',
                    'menu_title' => 'Виды игр',
                ],
                [
                    'taxonomy' => 'janr',
                    'hide_empty' => false,
                    'id' => 'janr',
                    'menu_title' => 'Жанры',
                ],
                [
                    'taxonomy' => 'platforms',
                    'hide_empty' => false,
                    'id' => 'platform',
                    'menu_title' => 'Платформа',
                ]
            ],
            'page_args' => [
                [
                    'menu_title' => 'Все',
                    'link' => '/freegames/',
                ]
            ],
            'post_type_args' => [
                [
                    'title' => 'Провайдеры',
                    'post_type' => 'providers',
                    'posts_per_page' => -1,
                    'class' => 'provider-slidetoggle-listt',
                    'data-r' => 'providers',
                    
                ]
            ]
        ];

        $args_data = [
            'cat_title' => 'Играть бесплатно',
            'cat_link' => '/freegames/',
            'post_type' => 'free_games',
            'posts_per_page' => 12,
            'post_image' => 'фото_для_главной_webp',
        ];

        $button = [
            'title' => 'Все игры',
            'link' => '/freegames/',
        ];

    require( get_theme_file_path('/parts/card/card-cat-bonus.php') ); 


    require( get_theme_file_path('/parts/part-page-switch.php') ); 

    require( get_theme_file_path('/parts/cat-content/cat-disclamer.php') ); 

    require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 

?>