<?php
require_once get_theme_file_path('parts/part-main-casino.php');

$args_data = [
    'cat_title' => 'Платежные системы ',
    'post_type' => 'platezhnie_sistemi',
    'posts_per_page' => 12,
    'post_image' => 'логотип_без_фона',
    'top_filter' => true,
];

$common_filters = [
    'crypta' => [
        'key'     => 'тип',
        'value'   => 'Криптовалюта',
        'compare' => '==',
    ],
    'card' => [
        'key'     => 'тип',
        'value'   => 'Карты',
        'compare' => '==',
    ],
    'wallet' => [
        'key'     => 'тип',
        'value'   => 'Электронные кошельки',
        'compare' => '==',
    ],
    'criptowallet' => [
        'key'     => 'тип',
        'value'   => 'Криптокошельки',
        'compare' => '==',
    ],

];

$common_orderby = [
    'orderby' => 'meta_value_num',
    'order'   => 'DESC',
];

$params = [
    'filter_menu' => 'payment-systems-filter-menu',
    'page_args' => [
        [
            'menu_title' => 'Криптовалюта',
            'link'       => 'crypta',
            'meta_query' => [
                $common_filters['crypta']
            ],
        ],
        [
            'menu_title' => 'Карты',
            'link'       => 'card',
            'meta_query' => [
                $common_filters['card']
            ],
        ],
        [
            'menu_title' => 'Электронные кошельки',
            'link'       => 'wallet',
            'meta_query' => [
                $common_filters['wallet']
            ],
        ],
        [
            'menu_title' => 'Криптокошельки',
            'link'       => 'criptowallet',
            'meta_query' => [
                $common_filters['criptowallet']
            ],
        ],
        
        
    ],
];
?>

<main>
    <?php require_once get_theme_file_path('parts/part-main-casino.php'); ?>

    <div class="container list__payment">
        <div class="row reverse">
            <div class="content col-lg-8 rating-casino">
            
                <?php
                    require_once( get_theme_file_path('/parts/card/card-cat-more.php') );
                    
                    
                    $cat_text = [
                        'text_version' => 2,
                        'text_parent' => true
                    ];
                    require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 
                ?>
            </div>
            <?php
                $args_data = [
                    'cat_title' => 'ТОП обзоры',
                    'post_type' => [
                        'online_casino' => 'Казино',
                        'bookmakers' => 'Букмекеры',                        
                    ],
                    'posts_per_page' => 20,
                    'post_image' => 'photo',
                    'promo' => 'promo',
                    'promo_desc' => 'описание_промокода',
                ];
                require( get_theme_file_path('/inc/filter/best-cat-posts.php') ); 

            ?>
        </div>
    </div>
</main>