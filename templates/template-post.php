<?php

// Подключение основных частей
require_once get_theme_file_path('parts/part-main-casino.php');
// Общий массив sidebars для всех типов постов
$all_sidebars = [
    'platezhnie_sistemi' => [
        [
            'title' => 'Общая информация',
            'args' => [
                'год_основания' => 'Год основания',
                'скачиваемый_клиент' => 'Скачиваемый клиент',
                'доступные_валюты' => 'Доступные валюты',
            ],
        ],
        [
            'title' => 'Служба поддержки',
            'args' => [
                'live_chat_podderzhka' => 'Live Chat',
                'e-mail_podderzhka' => 'E-mail',
            ],
        ],
    ],
    'free_games' => [
        [
            'title' => 'Общая информация',
            'args' => [
                'janr' => 'Жанр',
                'количество_барабанов' => 'Количество барабанов',
                'количество_рядов' => 'Количество рядов',
                'количество_линий' => 'Количество линий',
                'platforms' => 'Платформы',
            ],
        ],
    ],
    'default' => [
        [
            'title' => 'Общая информация',
            'args' => [
                'platform' => 'Платформа',
                'license' => 'Лицензии',
                'номер_лицензии' => 'Номер лицензии',
                'based_on' => 'Год основания',
                'game_types' => 'Виды игр',
                'provajders' => 'Провайдеры',
                'мобильная_версия' => 'Мобильная версия',
                'owner' => 'Владелец',
                'game_count' => 'Количество игр',
                'языки' => 'Языки',
            ],
        ],
        [
            'title' => 'Запрещенные страны',
            'args' => [
                'запрещенные_страны' => 'Запрещенные страны',
            ],
        ],
        [
            'title' => 'Служба поддержки',
            'args' => [
                'live_chat_поддержка' => 'Live Chat',
                'e-mail_поддержка' => 'E-mail',
                'support_lang' => 'Языки службы поддержки',
            ],
        ],
        [
            'title' => 'Финансовая информация',
            'args' => [
                'min_deposit' => 'Мин. депозит',
                'withdraw_limits' => 'Мин. сумма вывода',
                'currency' => 'Валюта счета',
                'ограничение_за_транзакцию' => 'Ограничение за транзакцию',
                'платежные_системы' => 'Способы пополнения',
                'payment_way' => 'Способы вывода',
                'скорость_выплат' => 'Скорость выплат',
            ],
        ],
    ],
];

function render_sidebar_info($post_type, $all_sidebars) {

    $sidebars = $all_sidebars[$post_type] ?? $all_sidebars['default'];
    require get_theme_file_path('parts/post/right-sidebar.php');
}

// Проверка типа поста и подключение соответствующих файлов
if ($post->post_type == 'online_casino') {
    require get_theme_file_path('parts/card/post-card.php');
    require_once get_theme_file_path('parts/post/casino-nav.php');
}
if (in_array($post->post_type, ['free_games', 'providers', 'partnyorki', 'faq_articles'])) {
    $post_title = trim(get_field('казино'));
    $args = array(
        'post_type' => 'online_casino', 
        'posts_per_page' => 1,           
        'title' => $post_title,          
        'fields' => 'all',         
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        $post_info = $query->posts[0];
        $post_id = $post_info->ID;
    } else {
        $post_info = null; 
        $post_id = null; 
    }
    
    wp_reset_postdata();
    
    require get_theme_file_path('parts/card/post-card.php');
}


?>

<div class="page__casino container">
    <div class="row">
        <?php
            if ($post->post_type == 'platezhnie_sistemi') {
                $easy_card_args = [
                    'img' => 'logo',
                    'link' => 'ссылка'
                ];
                require get_theme_file_path('parts/card/easy-card.php');
            }


            require_once get_theme_file_path('parts/post/post-content.php');
        ?>
        
        <div class="sidebar-info col-lg-4">
            <div class="sidebar-info--wrapper">
                <?php
                    // Подключение sidebar на основе типа поста
                    if (in_array($post->post_type, ['online_casino', 'bookmakers', 'platezhnie_sistemi', 'free_games'])) {
                        render_sidebar_info($post->post_type, $all_sidebars);
                    }

                    // Лучшие промокоды
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
                    require get_theme_file_path('/inc/filter/best-cat-posts.php');
                    
                ?>

            </div>
        </div>

        <?php 
            // Определение параметров для категории на основе типа поста
            $providers = get_field('providers');
            if (is_array($providers)) {
                // Преобразуем массив объектов WP_Post в массив строк с названиями
                $providers_string = implode(', ', array_map(function($provider) {
                    return is_object($provider) && isset($provider->post_title) ? $provider->post_title : ''; // Получаем название поста
                }, $providers));
            } else {
                // Если это не массив, предполагаем, что это один объект WP_Post
                $providers_string = is_object($providers) && isset($providers->post_title) ? $providers->post_title : $providers;
            }
            
            $category_posts = [
                'online_casino' => [
                    ['Популярные игры', 'free_games', 4, 'photo', 'free_games'],
                    ['Похожие казино', 'online_casino', 4, 'logo', 'similar-posts']
                ],
                'platezhnie_sistemi' => [
                    ['Интересные новости', 'news', 3, 'photo', 'title'],
                    ['Интересные статьи', 'faq_articles', 3, 'photo', 'title'],
                    ['Популярные игры', 'free_games', 3, 'photo', 'free_games']
                ],
                'free_games' => [
                    ['Другие демо игры провайдера ' . explode(', ', $providers_string)[0], 'free_games', 35, 'photo', 'title-janr']
                ],
                'bookmakers' => [
                    ['post_id' => 462]
                ],
                'providers' => [
                    ['post_id' => 468]
                ]
            ];
            

            // Рендер категорийных карточек
            if (isset($category_posts[$post->post_type])) {
                foreach ($category_posts[$post->post_type] as $params) {
                    if (isset($params['post_id'])) {
                        $post_id = $params['post_id'];
                        require get_theme_file_path('/parts/cat-content/cat-disclamer.php');
                        require get_theme_file_path('/parts/cat-content/cat-text.php');
                    } else {
                        render_category_posts([
                            'cat_title' => $params[0],
                            'post_type' => $params[1],
                            'posts_per_page' => $params[2],
                            'post_image' => $params[3],
                            'cat_template' => $params[4],
                        ]);
                    }
                }
            }

            // Вывод хлебных крошек
            if (in_array($post->post_type, ['online_casino', 'bookmakers', 'obzor_strimerov', 'free_games', 'news', 'faq_articles'])) {
                if (function_exists('custom_breadcrumbs_schema')) {
                    custom_breadcrumbs_schema();
                }
            }
            
        ?>
    </div>
</div>
