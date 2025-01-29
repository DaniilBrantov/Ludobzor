<?php
if(!empty($review_post)){
$post_type = $review_post->post_type;
$post_id = $review_post->ID;
}else{
    $post_type = get_post_type();
    $post_id = get_the_ID();

}

if($post_type == 'online_casino' || $post_type == 'news' || $post_type == 'faq_articles'){
    $content_sections = [
        'logo_url' => 'logo',
        'bonus' => 'banner',
        'promo_photo' => 'promo_photo',
        'rates' => [
            'based_on' => 'Основано',

            'license' => 'Лицензия',
            'min_deposit' => 'Мин. депозит',
            'withdraw_limits' => 'Мин. вывод',
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
            'data' => 'providers', 
            'post_type' => 'providers'
        ],
        'langs' => [
            'label' => 'Языки интерфейса', 
            'data' => 'язык_сокращенный'
        ],
        'payment_list' => [
            'label' => 'Платежи', 
            'data' => 'payment_way', 
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
        'logo_url' => 'logo',
        'bonus' => 'banner',
        'rates' => [
            'based_on' => 'Основано',

            // 'лицензия' => 'Лицензия',
            // 'min_deposit' => 'Мин. депозит',
            // 'withdraw_limits' => 'Мин. вывод',
            // 'скорость_выплат' => 'Вывод средств',
            // 'поддержка' => 'Поддержка',

            'разработано_игр' => 'Разработано игр',
            'owner' => 'Владелец',
            'штаб-квартира' => 'Штаб-квартира',

            // 'минимальная_ставка' => 'Мин. ставка',
            // 'максимальная_ставка' => 'Макс. ставка',
            // 'максимальная_выплата' => 'Макс. выплата',
            // 'rtp' => 'RTP (%)',
            
        ],
        // 'providers_list' => [
        //     'label' => 'Провайдеры', 
        //     'data' => 'providers', 
        //     'post_type' => 'providers'
        // ],
        // 'langs' => [
        //     'label' => 'Языки интерфейса', 
        //     'data' => 'язык_сокращенный'
        // ],
        // 'payment_list' => [
        //     'label' => 'Платежи', 
        //     'data' => 'payment_way', 
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
                'title' => 'Рейтинг Казино',
                'link' => '/reyting-kazino'
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
        'logo_url' => 'logo',
        'bonus' => 'баннер_для_пк',
        'rates' => [
            // 'основано' => 'Основано',

            // 'лицензия' => 'Лицензия',
            // 'min_deposit' => 'Мин. депозит',
            // 'withdraw_limits' => 'Мин. вывод',
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
            'data' => 'providers', 
            'post_type' => 'providers'
        ],
        // 'langs' => [
        //     'label' => 'Языки интерфейса', 
        //     'data' => 'язык_сокращенный'
        // ],
        // 'payment_list' => [
        //     'label' => 'Платежи', 
        //     'data' => 'payment_way', 
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
        'logo_url' => 'logo',
        'bonus' => 'баннер_для_пк',
        'rates' => [
            'based_on' => 'Основано',

            // 'лицензия' => 'Лицензия',
            // 'min_deposit' => 'Мин. депозит',
            // 'withdraw_limits' => 'Мин. вывод',
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
        //     'data' => 'providers', 
        //     'post_type' => 'providers'
        // ],
        // 'langs' => [
        //     'label' => 'Языки интерфейса', 
        //     'data' => 'язык_сокращенный'
        // ],
        // 'payment_list' => [
        //     'label' => 'Платежи', 
        //     'data' => 'payment_way', 
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
//     'providers_list' => ['label' => 'Провайдеры', 'data' => 'providers', 'post_type' => 'providers'],
//     'langs' => ['label' => 'Языки интерфейса', 'data' => 'язык_сокращенный'],
//     'payment_list' => ['label' => 'Платежи', 'data' => 'payment_way', 'post_type' => 'platezhnie_sistemi'],
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
//     'logo_url' => 'logo',
//     'bonus' => 'banner',
// ];

// Получаем значения для каждого из разделов контента
// Проверка существования ключа 'payment_list' и обработка данных
if (isset($content_sections['payment_list'])) {
    $payment_data = get_field($content_sections['payment_list']['data'], $post_id);
    // Если данные присутствуют, формируем список постов
    $payment_list = $payment_data ? array_map(fn($item) => $item->post_title, $payment_data) : [];
} else {
    // Если ключа нет, присваиваем пустой массив
    $payment_list = [];
}

// Получаем другие поля
$providers_list = isset($content_sections['providers_list']['data'], $post_id) && is_array($providers = get_field($content_sections['providers_list']['data'], $post_id)) 
            ? array_map(fn($provider) => $provider->post_title, $providers)
            : [];
$logo_url = get_field($content_sections['logo_url'] ?? '', $post_id) ?: ''; // Логотип
$bonus = get_field($content_sections['bonus'] ?? '', $post_id) ?: ''; // Бонус
$promo_code = get_field('promo', $post_id) ?: 'LUDOBZOR'; // Промокод
$promo_photo_key = $content_sections['promo_photo'] ?? null; // Ключ promo_photo
$promo_photo = $promo_photo_key ? get_field($promo_photo_key, $post_id) : ''; // Фото
$rates = $content_sections['rates'] ?? []; // rates, если есть
$buttons = $content_sections['buttons'] ?? []; // buttons, если есть
$langs = isset($content_sections['langs']) ? get_field($content_sections['langs']['data'], $post_id) : [];
$langs = $langs ? implode(', ', array_map(fn($term) => $term->name, $langs)) : '';

//$langs = implode(', ', array_map(fn($item) => $item->post_title, get_field($content_sections['langs']['data'])));

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
            <div class="oc__bonus copy_promocode_link" id="get_promo"
                data-image-src="<?php echo esc_url($promo_photo); ?>"
                data-promo-code="<?php echo esc_html($promo_code ?: 'LUDOBZOR'); ?>"
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
                            if (is_array($field_value)) {

                                $term_names = array_map(function($term) {
                                    return $term->name;
                                }, $field_value);
                                
                                $field_value = implode(', ', $term_names);

                            }elseif (is_object($field_value)) {
                                $field_value = $field_value->name;
                            }
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
                                    $logo_url = get_field('logo');
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
                        echo $langs;
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