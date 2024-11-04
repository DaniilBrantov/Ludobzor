<?php

// Общие данные для категорий
$args_data = [
    'cat_title' => 'Лучшие бонусы от онлайн-казино',
    'post_type' => 'online_casino',
    'posts_per_page' => 12,
    'post_image' => 'логотип_без_фона',
    'top_filter' => true,
];



// Общие фильтры для всех запросов
$common_filters = [
    'welcome' => [
        'key'     => 'tip_bonusa',
        'value'   => 'Приветственный бонус',
        'compare' => '==',
    ],
    'free-spins' => [
        'key'     => 'tip_bonusa',
        'value'   => 'Фриспины',
        'compare' => '==',
    ],
    'cashback' => [
        'key'     => 'tip_bonusa',
        'value'   => 'Кэшбэк',
        'compare' => '==',
    ],
    'bookmakers-bonuses' => [
        'key'     => 'tip_bonusa',
        'value'   => 'Бонусы от букмекеров',
        'compare' => '==',
    ],
];

// Параметры сортировки для всех категорий
$common_orderby = [
    'orderby' => 'meta_value_num',
    'order'   => 'DESC',
];

$params = [
    'filter_menu' => 'bonusy-filter-menu',
    'page_args' => [
        [
            'menu_title' => 'Приветственный бонус',
            'link'       => 'welcome',
            'meta_query' => [
                $common_filters['welcome']
            ],
        ],
        [
            'menu_title' => 'Фриспины',
            'link'       => 'free-spins',
            'meta_query' => [
                $common_filters['free-spins']
            ],
        ],
        [
            'menu_title' => 'Кэшбэк',
            'link'       => 'cashback',
            'meta_query' => [
                $common_filters['cashback']
            ],
        ],
        [
            'menu_title' => 'Бонусы от букмекеров',
            'link'       => 'bookmakers-bonuses',
            'meta_query' => [
                $common_filters['bookmakers-bonuses']
            ],
        ],
        
    ],
];
?>

<main>
    <?php require_once get_theme_file_path('parts/part-main-casino.php'); ?>

    <div class="container list__payment">
        <div class="row reverse">

            <div class="content col-lg-8 raitingCasino">
            <?php
                require_once( get_theme_file_path('/parts/card/card-cat.php') );
                require(get_theme_file_path('/parts/part-page-switch.php'));
                
            ?>
            </div>
            <?php

                // Лучшие промокоды
                $args_data = [
                    'cat_title' => 'ТОП обзоры',
                    'post_type' => [
                        'online_casino' => 'Казино',
                        'bookmakers' => 'Букмекеры',
                    ],
                    'posts_per_page' => 20,
                    'post_image' => 'фото_для_главной',
                    'promo' => 'промокод',
                    'promo_desc' => 'описание_промокода',
                ];
                require( get_theme_file_path('/parts/filter/best-cat-posts.php') ); 

                require( get_theme_file_path('/parts/cat-content/cat-disclamer.php') ); 
                

                require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 
        ?>
        </div>
    </div>
</main>