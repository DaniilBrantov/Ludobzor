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
                'live_chat_podderzhка' => 'Live Chat',
                'e-mail_podderzhка' => 'E-mail',
            ],
        ],
    ],
    'free_games' => [
        [
            'title' => 'Общая информация',
            'args' => [
                'жанр' => 'Жанр',
                'количество_барабанов' => 'Количество барабанов',
                'количество_рядов' => 'Количество рядов',
                'количество_линий' => 'Количество линий',
                'платформы' => 'Платформы',
            ],
        ],
    ],
    'default' => [
        [
            'title' => 'Общая информация',
            'args' => [
                'платформа' => 'Платформа',
                'лицензия' => 'Лицензии',
                'номер_лицензии' => 'Номер лицензии',
                'основано' => 'Год основания',
                'виды_игр' => 'Виды игр',
                'provajderы' => 'Провайдеры',
                'мобильная_версия' => 'Мобильная версия',
                'владелец' => 'Владелец',
                'количество_игр' => 'Количество игр',
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
                'языки_службы_поддержки_поддержка' => 'Языки службы поддержки',
            ],
        ],
        [
            'title' => 'Финансовая информация',
            'args' => [
                'минимальная_сумма_депозита' => 'Мин. депозит',
                'лимиты_на_вывод' => 'Мин. сумма вывода',
                'валюта_счета' => 'Валюта счета',
                'ограничение_за_транзакцию' => 'Ограничение за транзакцию',
                'платежные_системы' => 'Способы пополнения',
                'способы_вывода' => 'Способы вывода',
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
if (in_array($post->post_type, ['free_games', 'providers', 'partnyorki', 'news', 'faq_articles'])) {
    $post_title = trim(get_field('казино'));
    $post_info = get_page_by_title($post_title, OBJECT, 'online_casino');
    $post_id = $post_info->ID;
    require get_theme_file_path('parts/card/post-card.php');
}
?>
<div class="page__casino container">
    <div class="row">
        <?php
            if ($post->post_type == 'platezhnie_sistemi') {
                $easy_card_args = [
                    'img' => 'логотип_без_фона',
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
                        'post_image' => 'фото_для_главной',
                        'promo' => 'промокод',
                        'promo_desc' => 'описание_промокода',
                    ];
                    require get_theme_file_path('/parts/filter/best-cat-posts.php');
                ?>
            </div>
        </div>

        <?php 
            // Определение параметров для категории на основе типа поста
            $category_posts = [
                'online_casino' => [
                    ['Популярные игры', 'free_games', 4, 'фото_для_главной_webp', 'free_games'],
                    ['Похожие казино', 'online_casino', 4, 'логотип_без_фона', 'similar-posts']
                ],
                'platezhnie_sistemi' => [
                    ['Интересные новости', 'news', 3, 'фото', 'title'],
                    ['Интересные статьи', 'faq_articles', 3, 'фото_для_главной', 'title'],
                    ['Популярные игры', 'free_games', 3, 'фото_для_главной_webp', 'free_games']
                ],
                'free_games' => [
                    ['Другие демо игры провайдера ' . explode(', ', get_field('провайдер'))[0], 'free_games', 35, 'фото_для_главной_webp', 'title-janr']
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
