<?php

$args_data = [
    'cat_title' => 'Лучшие бонусы от онлайн-казино',
    'post_type' => 'online_casino',
    'posts_per_page' => 12,
    'post_image' => 'logo',
    'top_filter' => true,
];


$params = [
    'filter_menu' => 'bonusy-filter-menu',
    'page_args'   => [],
];

$pages = get_posts([
    'post_type'   => 'page',
    'post_status' => 'publish',
    'numberposts' => -1, // Все страницы
]);

foreach ($pages as $page) {
    // Получаем значение поля type_bonus
    $type_bonus = get_field('type_bonus', $page->ID);
    
    if (!empty($type_bonus)) {
        $params['page_args'][] = [
            'menu_title' => $page->post_title,
            'link'       => get_permalink($page),
            'meta_query' => [
                [
                    'key'     => 'tip_bonusa',
                    'value'   => $type_bonus,
                    'compare' => '==',
                ],
            ],
        ];
    }
}


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
                ?>
                <div class="col-lg-4">
                    <div class="sidebar-info">
                        <div class="sidebar-info--wrapper">
                            <div class="sidebar-info">
                                <div class="sidebar-info--wrapper">
                                    <div class="casino-all-info">
                                          <?php
                                            require( get_theme_file_path('/inc/filter/best-cat-posts.php') ); 
                                          
                                          ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php


                require( get_theme_file_path('/parts/cat-content/cat-disclamer.php') ); 
                
                require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 
        ?>
        </div>
    </div>
</main>