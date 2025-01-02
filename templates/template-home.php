<main>
    <?php
        require_once get_theme_file_path('templates/home/part-banner.php');
        require_once get_theme_file_path('parts/part-main-casino.php');

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
            'cat_title' => 'Бесплатные игровые автоматы',
            'cat_link' => '/freegames/',
            'post_type' => 'free_games',
            'posts_per_page' => 12,
            'post_image' => 'photo',
        ];

        $button = [
            'title' => 'Все игры',
            'link' => '/freegames/',
        ];

        require( get_theme_file_path('/parts/part-carousel.php') ); 


        $params = false;

        $args_data = [
            'cat_title' => 'Лучшие онлайн-казино',
            'cat_link' => '/obzory/reviews/',
            'post_type' => 'online_casino',
            'posts_per_page' => 20,
            'post_image' => 'photo',
        ];

        $button = [
            'title' => 'Все казино',
            'link' => '/obzory/reviews/',
        ];

        require( get_theme_file_path('/parts/part-carousel.php') ); 


        $params = false;

        $args_data = [
            'cat_title' => 'Лучшие букмекеры',
            'cat_link' => '/bookmakers/',
            'post_type' => 'bookmakers',
            'posts_per_page' => 20,
            'post_image' => 'photo',
        ];

        $button = [
            'title' => 'Все букмекеры',
            'link' => '/bookmakers/',
        ];

        require( get_theme_file_path('/parts/part-carousel.php') ); 

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 index_bott">
                <?php
                    require_once get_theme_file_path('templates/home/left-cat.php');

                    $args_data = [
                        'cat_title' => 'Лучшие промокоды',
                        'cat_link' => '/bonusy/',
                        'post_type' => ['online_casino'],
                        'posts_per_page' => 20,
                        'post_image' => 'photo',
                        'promo' => 'promo',
                        'promo_desc' => 'описание_промокода',
                        'top' => 'топ'
                    ];

                    require( get_theme_file_path('/inc/filter/best-cat-posts.php') ); 
                ?>
            </div>
        </div>
    </div>
    <?php
        require_once get_theme_file_path('templates/home/what-who.php');
        require_once get_theme_file_path('templates/home/disclamer.php');
    // require_once 'templates/home/template-home.php';
    ?>
</main>