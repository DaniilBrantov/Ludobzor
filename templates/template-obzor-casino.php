<?php
require_once get_theme_file_path('parts/part-main-casino.php');

$args_data = [
    'cat_title' => 'Обзор Казино',
    'post_type' => 'online_casino',
    'posts_per_page' => 12,
    'post_image' => 'логотип_без_фона',
    'cat_template' => 'promo-more'
];

$common_filters = [
    'license_exists' => [
        'key'     => 'лицензия',
        'value'   => '',
        'compare' => '!=',
    ],
    'license_number_exists' => [
        'key'     => 'номер_лицензии',
        'value'   => '',
        'compare' => '!=',
    ],
    'rating_above' => [
        'key'     => 'oczenka_portala',
        'value'   => 4,
        'compare' => '>=',
        'type'    => 'NUMERIC',
    ],
    'rating_filter' => [
        'key'     => 'oczenka_portala',
        'value'   => 0,
        'compare' => '>=',
        'type'    => 'NUMERIC',
    ],
];

$common_orderby = [
    'orderby' => 'meta_value_num',
    'order'   => 'DESC',
];

$params = [
    'filter_menu' => 'casino-filter-menu',
    'page_args' => [
        [
            'menu_title' => 'Лицензионное',
            'link'       => 'licenzionnoe',
            'meta_query' => [
                $common_filters['license_exists'],
                $common_filters['license_number_exists'],
            ],
        ],
        [
            'menu_title' => 'Новинки',
            'link'       => 'newcasic',
            'meta_query' => [
                [
                    'key'     => 'основано',
                    'compare' => 'EXISTS',
                ],
            ],
            'orderby' => $common_orderby['orderby'],
            'order'   => $common_orderby['order'],
        ],
        [
            'menu_title' => 'Криптовалютное',
            'link'       => 'crypta',
            'meta_query' => [
                [
                    'key'     => 'криптовалютное_казино',
                    'value'   => true,
                    'compare' => '=',
                ],
            ],
        ],
        [
            'menu_title' => 'Для хайроллеров',
            'link'       => 'hayroller',
            'meta_query' => [
                $common_filters['rating_above'],
            ],
            'orderby' => $common_orderby['orderby'],
            'order'   => $common_orderby['order'],
        ],
        [
            'menu_title' => 'Моментальный вывод',
            'link'       => 'momentpay',
            'meta_query' => [
                [
                    'key'     => 'скорость_выплат',
                    'value'   => 'моментально',
                    'compare' => '=',
                ],
            ],
        ],
        [
            'menu_title' => 'Надёжные',
            'link'       => 'reliable',
            'meta_query' => [
                $common_filters['license_exists'],
                $common_filters['license_number_exists'],
            ],
            'orderby' => $common_orderby['orderby'],
            'order'   => $common_orderby['order'],
        ],
        [
            'menu_title' => 'Минимальная ставка',
            'link'       => 'minstavka',
            'meta_query' => [
                $common_filters['license_exists'],
                $common_filters['license_number_exists'],
                $common_filters['rating_above'],
                [
                    'key'     => 'минимальная_сумма_депозита',
                    'compare' => 'EXISTS',
                ],
            ],
            'orderby' => $common_orderby['orderby'],
            'order'   => $common_orderby['order'],
        ],
        [
            'menu_title' => 'Чёрный список',
            'link'       => 'blacklist',
            'meta_query' => [
                [
                    'key'     => 'черный_список',
                    'value'   => true,
                    'compare' => '=',
                ],
            ],
        ],
    ],
];


require( get_theme_file_path('/parts/part-display-promo-cat.php') ); 

require( get_theme_file_path('/parts/part-page-switch.php') ); 

require( get_theme_file_path('/parts/cat-content/cat-disclamer.php') ); 

require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 

?>