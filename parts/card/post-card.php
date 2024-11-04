<?php

$post_type = get_post_type();
$post_id = isset($post_id) ? $post_id : get_the_ID();


if($post_type == 'online_casino' || $post_type == 'news' || $post_type == 'faq_articles'){
    $content_sections = [
        'logo_url' => 'логотип_без_фона',
        'bonus' => 'banner',
        'rates' => [
            'основано' => 'Основано',

            'лицензия' => 'Лицензия',
            'минимальная_сумма_депозита' => 'Мин. депозит',
            'лимиты_на_вывод' => 'Мин. вывод',
            'скорость_выплат' => 'Вывод средств',
            'поддержка' => 'Поддержка',

            // 'разработано_игр' => 'Разработано игр',
            // 'владелец' => 'Владелец',
            // 'штаб-квартира' => 'Штаб-квартира',

            // 'минимальная_ставка' => 'Мин. ставка',
            // 'максимальная_ставка' => 'Макс. ставка',
            // 'максимальная_выплата' => 'Макс. выплата',
            // 'rtp' => 'RTP (%)',
            
        ],
        'providers_list' => [
            'label' => 'Провайдеры', 
            'data' => 'provajdery', 
            'post_type' => 'providers'
        ],
        'langs' => [
            'label' => 'Языки интерфейса', 
            'data' => 'язык_сокращенный'
        ],
        'payment_list' => [
            'label' => 'Платежи', 
            'data' => 'способы_вывода', 
            'post_type' => 'platezhnie_sistemi'
        ],
        // 'janrs' => ['label' => 'Жанры', 'data' => 'janr'],
        // 'game_types' => ['label' => 'Виды игр', 'data' => 'game_types'],
        // 'exit_date' => ['label' => 'Дата выхода', 'data' => 'дата_выхода'],
        // 'volatility' => ['label' => 'Волатильность', 'data' => 'volatility'],
        'buttons' => [
            'promo' => [
                'img' => imgName('bonus.svg'),
                'title' => 'Промокод'
            ],
            // 'freegames' => [
            //     'img' => imgName('bonus.svg'),
            //     'title' => 'Топ демо-игр',
            //     'link' => '/freegames'
            // ],
        ],

    ];
}elseif($post_type == 'providers'){
    $content_sections = [
        'logo_url' => 'логотип_без_фона',
        'bonus' => 'banner',
        'rates' => [
            'основано' => 'Основано',

            // 'лицензия' => 'Лицензия',
            // 'минимальная_сумма_депозита' => 'Мин. депозит',
            // 'лимиты_на_вывод' => 'Мин. вывод',
            // 'скорость_выплат' => 'Вывод средств',
            // 'поддержка' => 'Поддержка',

            'разработано_игр' => 'Разработано игр',
            'владелец' => 'Владелец',
            'штаб-квартира' => 'Штаб-квартира',

            // 'минимальная_ставка' => 'Мин. ставка',
            // 'максимальная_ставка' => 'Макс. ставка',
            // 'максимальная_выплата' => 'Макс. выплата',
            // 'rtp' => 'RTP (%)',
            
        ],
        // 'providers_list' => [
        //     'label' => 'Провайдеры', 
        //     'data' => 'provajdery', 
        //     'post_type' => 'providers'
        // ],
        // 'langs' => [
        //     'label' => 'Языки интерфейса', 
        //     'data' => 'язык_сокращенный'
        // ],
        // 'payment_list' => [
        //     'label' => 'Платежи', 
        //     'data' => 'способы_вывода', 
        //     'post_type' => 'platezhnie_sistemi'
        // ],
        'janrs' => [
            'label' => 'Жанры', 
            'data' => 'janr'
        ],
        'game_types' => [
            'label' => 'Виды игр', 
            'data' => 'game_types'
        ],
        // 'exit_date' => ['label' => 'Дата выхода', 'data' => 'дата_выхода'],
        // 'volatility' => ['label' => 'Волатильность', 'data' => 'volatility'],
        'buttons' => [
            'promo' => [
                'img' => imgName('bonus.svg'),
                'title' => 'Промокод'
            ],
            'freegames' => [
                'img' => imgName('bonus.svg'),
                'title' => 'Топ демо-игр',
                'link' => '/freegames'
            ],
        ],

    ];
}elseif($post_type == 'free_games'){
    $content_sections = [
        'logo_url' => 'логотип_без_фона',
        'bonus' => 'баннер_для_пк',
        'rates' => [
            // 'основано' => 'Основано',

            // 'лицензия' => 'Лицензия',
            // 'минимальная_сумма_депозита' => 'Мин. депозит',
            // 'лимиты_на_вывод' => 'Мин. вывод',
            // 'скорость_выплат' => 'Вывод средств',
            // 'поддержка' => 'Поддержка',

            // 'разработано_игр' => 'Разработано игр',
            // 'владелец' => 'Владелец',
            // 'штаб-квартира' => 'Штаб-квартира',

            'минимальная_ставка' => 'Мин. ставка',
            'максимальная_ставка' => 'Макс. ставка',
            'максимальная_выплата' => 'Макс. выплата',
            'rtp' => 'RTP (%)',
            
        ],
        'providers_list' => [
            'label' => 'Провайдеры', 
            'data' => 'provajdery', 
            'post_type' => 'providers'
        ],
        // 'langs' => [
        //     'label' => 'Языки интерфейса', 
        //     'data' => 'язык_сокращенный'
        // ],
        // 'payment_list' => [
        //     'label' => 'Платежи', 
        //     'data' => 'способы_вывода', 
        //     'post_type' => 'platezhnie_sistemi'
        // ],
        // 'janrs' => [
        //     'label' => 'Жанры', 
        //     'data' => 'janr'
        // ],
        // 'game_types' => [
        //     'label' => 'Виды игр', 
        //     'data' => 'game_types'
        // ],
        'exit_date' => [
            'label' => 'Дата выхода', 
            'data' => 'дата_выхода',
        ],
        'volatility' => [
            'label' => 'Волатильность', 
            'data' => 'volatility'
        ],

        // 'buttons' => [
        //     'promo' => [
        //         'img' => imgName('bonus.svg'),
        //         'title' => 'Промокод'
        //     ],
        //     'freegames' => [
        //         'img' => imgName('bonus.svg'),
        //         'title' => 'Топ демо-игр',
        //         'link' => '/freegames'
        //     ],
        // ],

    ];
}elseif($post_type == 'partnyorki'){
    $content_sections = [
        'logo_url' => 'логотип_без_фона',
        'bonus' => 'баннер_для_пк',
        'rates' => [
            'основано' => 'Основано',

            // 'лицензия' => 'Лицензия',
            // 'минимальная_сумма_депозита' => 'Мин. депозит',
            // 'лимиты_на_вывод' => 'Мин. вывод',
            // 'скорость_выплат' => 'Вывод средств',
            // 'поддержка' => 'Поддержка',

            // 'разработано_игр' => 'Разработано игр',
            // 'владелец' => 'Владелец',
            // 'штаб-квартира' => 'Штаб-квартира',

            'отчетный_период' => 'Отчетный период',

            // 'минимальная_ставка' => 'Мин. ставка',
            // 'максимальная_ставка' => 'Макс. ставка',
            'минимальная_выплата' => 'Мин. выплата',
            'максимальная_выплата' => 'Макс. выплата',
            // 'rtp' => 'RTP (%)',

        ],
        // 'providers_list' => [
        //     'label' => 'Провайдеры', 
        //     'data' => 'provajdery', 
        //     'post_type' => 'providers'
        // ],
        // 'langs' => [
        //     'label' => 'Языки интерфейса', 
        //     'data' => 'язык_сокращенный'
        // ],
        // 'payment_list' => [
        //     'label' => 'Платежи', 
        //     'data' => 'способы_вывода', 
        //     'post_type' => 'platezhnie_sistemi'
        // ],
        // 'janrs' => [
        //     'label' => 'Жанры', 
        //     'data' => 'janr'
        // ],
        // 'game_types' => [
        //     'label' => 'Виды игр', 
        //     'data' => 'game_types'
        // ],
        // 'exit_date' => [
        //     'label' => 'Дата выхода', 
        //     'data' => 'дата_выхода',
        // ],
        // 'volatility' => [
        //     'label' => 'Волатильность', 
        //     'data' => 'volatility'
        // ],
        'cookie' => [
            'label' => 'Cookie', 
            'data' => 'cookie'
        ],
        'lifetime_cookie' => [
            'label' => 'Lifetime Cookie', 
            'data' => 'lifetime_cookie'
        ],
        'negative_balance' => [
            'label' => 'Негативный баланс', 
            'data' => 'негативный_баланс'
        ],

        // 'buttons' => [
        //     'promo' => [
        //         'img' => imgName('bonus.svg'),
        //         'title' => 'Промокод'
        //     ],
        //     'freegames' => [
        //         'img' => imgName('bonus.svg'),
        //         'title' => 'Топ демо-игр',
        //         'link' => '/freegames'
        //     ],
        // ],

    ];
}

// Динамически добавляем контентные секции
// $content_sections = [
//     'rates' => [
//         'основано' => 'Основано',
//         'разработано_игр' => 'Разработано игр',
//         'владелец' => 'Владелец',
//         'штаб-квартира' => 'Штаб-квартира',
//     ],
//     'providers_list' => ['label' => 'Провайдеры', 'data' => 'provajdery', 'post_type' => 'providers'],
//     'langs' => ['label' => 'Языки интерфейса', 'data' => 'язык_сокращенный'],
//     'payment_list' => ['label' => 'Платежи', 'data' => 'способы_вывода', 'post_type' => 'platezhnie_sistemi'],
//     // 'janrs' => ['label' => 'Жанры', 'data' => 'janr'],
//     // 'game_types' => ['label' => 'Виды игр', 'data' => 'game_types'],
//     // 'exit_date' => ['label' => 'Дата выхода', 'data' => 'дата_выхода'],
//     // 'volatility' => ['label' => 'Волатильность', 'data' => 'volatility'],
//     'buttons' => [
//         'promo' => [
//             'img' => imgName('bonus.svg'),
//             'title' => 'Промокод'
//         ],
//         'freegames' => [
//             'img' => imgName('bonus.svg'),
//             'title' => 'Топ демо-игр',
//             'link' => '/freegames'
//         ],
//     ],
//     'logo_url' => 'логотип_без_фона',
//     'bonus' => 'banner',
// ];

// Получаем значения для каждого из разделов контента
$providers_list = array_filter(explode(',', get_field($content_sections['providers_list']['data'], $post_id) ?? ''));
$payment_list = array_filter(explode(',', get_field($content_sections['payment_list']['data'], $post_id) ?? ''));
$logo_url = get_field($content_sections['logo_url'], $post_id) ?: ''; // Получаем логотип
$bonus = get_field($content_sections['bonus'], $post_id) ?: '';
$rates = $content_sections['rates'] ?? [];
$buttons = $content_sections['buttons'] ?? [];
$langs = get_field($content_sections['langs']['data'], $post_id) ?: '';
?>

<div class="container wrapper__container">
    <div class="oc__header">
        <div class="oc__header--left"></div>

        <div class="oc__left__column">
            <div class="oc__logo">
                <?php if ($logo_url): ?>
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"
                    title="<?php echo esc_attr(get_the_title()); ?>" width="285" height="70">
                <?php endif; ?>
            </div>

            <?php if ($bonus): ?>
            <div class="oc__bonus copy_promocode_link"
                style="background: url(<?php echo esc_url($bonus); ?>) 50% 50% no-repeat; background-size: cover;">
            </div>
            <?php endif; 
            if(get_field('черный_список')){ ?>
            <div class="jolly-roger">
                Казино категорически не рекомендуется для игры
                и находится в черном списке
            </div>
            <?php };
             foreach ($buttons as $button): ?>
            <?php if (!empty($button['link'])): ?>
            <a style="background: url(<?php echo esc_url($button['img']); ?>) 50% 50% no-repeat; background-size: cover;"
                class="oc__bonus__promocode" href="<?php echo esc_url($button['link']); ?>" target="_blank">
                <span><?php echo esc_html($button['title']); ?></span>
            </a>
            <?php else: ?>
            <div class="oc__bonus__timer" id="oc__bonus__timer">
                <button
                    style="background: url(<?php echo esc_url($button['img']); ?>) 50% 50% no-repeat; background-size: cover;"
                    class="oc__bonus__promocode icon__finger--before">
                    <span
                        class="oc__bonus__promocode-inner icon__copy__dark--after"><?php echo esc_html($button['title']); ?></span>
                </button>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="oc__right__column col">
            <div class="oc__rates">
                <?php foreach ($rates as $field => $label): ?>
                <div class="oc__rates--item col-xl">
                    <div class="rate__progress large">
                        <div class="rate__inset"><?php 
                            $field_value = get_field($field, $post_id);

                            if ($field_value) {
                                echo esc_html($field_value);
                            } else {
                                echo 'Нет';
                            }
                            ?></div>
                    </div>
                    <div class="oc__rates--label"><?php echo esc_html($label); ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="oc__last-update">Последнее обновление: <?php echo get_the_modified_date('d.m.Y'); ?></div>

            <div class="oc__characteristics">
                <?php foreach ($content_sections as $key => $section): ?>
                <?php if (!empty($section['data'])): ?>
                <div class="ch__item not-last">
                    <div class="ch__item__label"><?php echo esc_html($section['label']); ?>:</div>
                    <div class="oc__access__country">
                        <?php
                    $data = get_field($section['data'], $post_id) ?: [];
                    
                    // Для 'providers_list' и 'payment_list'
                    if ($key === 'providers_list' && !empty($providers_list)) {
                        echo '<div class="list__inline">';
                        foreach ($providers_list as $provider_name) {
                            $provider_query = new WP_Query([
                                'post_type' => 'providers',
                                'title' => sanitize_text_field($provider_name),
                                'posts_per_page' => -1,
                            ]);
                            if ($provider_query->have_posts()) {
                                while ($provider_query->have_posts()) {
                                    $provider_query->the_post();
                                    $logo_url = get_field('логотип');
                                    $clean_name = get_field('чистое_название');
                                    if ($clean_name && $logo_url) {
                                        echo '<img class="brand__logo lazy pointer" onclick="location.href=\'' . get_permalink() . '\'" src="' . esc_url($logo_url) . '" title="' . esc_attr($clean_name) . '" alt="' . esc_attr($clean_name) . '" width="28" height="28">';
                                    }
                                }
                                wp_reset_postdata();
                            }
                        }
                        echo '</div>';
                    } elseif ($key === 'payment_list' && !empty($payment_list)) {
                        echo '<div class="list__inline">';
                        foreach ($payment_list as $payment_name) {
                            $payment_query = new WP_Query([
                                'post_type' => 'platezhnie_sistemi',
                                'title' => sanitize_text_field($payment_name),
                                'posts_per_page' => -1,
                            ]);
                            if ($payment_query->have_posts()) {
                                while ($payment_query->have_posts()) {
                                    $payment_query->the_post();
                                    $logo_url = get_field('иконка');
                                    $clean_name = get_field('чистое_название');
                                    if ($clean_name && $logo_url) {
                                        echo '<img class="brand__logo lazy pointer" onclick="location.href=\'' . get_permalink() . '\'" src="' . esc_url($logo_url) . '" title="' . esc_attr($clean_name) . '" alt="' . esc_attr($clean_name) . '" width="28" height="28">';
                                    }
                                }
                                wp_reset_postdata();
                            }
                        }
                        echo '</div>';
                    } elseif ($key === 'langs' && !empty($langs)) {
                        echo '<div class="ch__item last-child ch_item_country_n"><div class="oc__access__country" title="Доступно из России">';
                        echo implode(', ', array_map('esc_html', $langs));
                        echo '</div></div>';
                    } else {
                        // Обработка массива данных по умолчанию
                        $names = [];
                        foreach ((array) $data as $item) {
                            $names[] = esc_html(is_object($item) ? $item->name : $item);
                        }
                        echo implode(', ', $names);
                    }
                    ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>