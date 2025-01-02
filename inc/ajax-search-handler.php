<?php

add_action('wp_ajax_nopriv_ajax_search', 'ajax_search_handler');
add_action('wp_ajax_ajax_search', 'ajax_search_handler');

function ajax_search_handler() {
    // Проверяем nonce для безопасности
    check_ajax_referer('ajax_search_nonce', 'security');

    // Получаем запрос
    $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

    // Если запрос пустой, возвращаем ошибку
    if (empty($query)) {
        wp_send_json_error(['message' => 'Запрос пуст.']);
    }

    // Массив категорий с дополнительной информацией
    $all_categories = [
        "online_casino" => [
            'title' => "Казино",
            'cat_template' => 'more-data',
            'image' => 'logo',
        ],
        "obzor_strimerov" => [
            'title' => "Стримеры",
            'cat_template' => 'more',
            'image' => 'photo',
        ],
        "news" => [
            'title' => "Новости",
            'cat_template' => 'more',
            'image' => 'photo',
        ],
        "slots" => [
            'title' => "Слоты",
            'cat_template' => 'more',
            'image' => 'photo',
        ],
        "bookmakers" => [
            'title' => "Букмекеры",
            'cat_template' => 'more',
            'image' => 'photo',
        ],
        "providers" => [
            'title' => "Провайдеры",
            'cat_template' => 'more',
            'image' => 'photo',
        ],
        "free_games" => [
            'title' => "Игры",
            'cat_template' => 'more',
            'image' => 'photo',
        ]
    ];

    // Параметры WP_Query
    $args = [
        's' => $query,
        'post_type' => array_keys($all_categories), // Используем ключи категорий как типы постов
        'posts_per_page' => 10,
    ];

    $search_query = new WP_Query($args);
    // Если есть результаты, обрабатываем их
    if ($search_query->have_posts()) {
        $results = [];

        while ($search_query->have_posts()) {
            $search_query->the_post();

            // Получаем тип поста
            $post_type = get_post_type();

            // Получаем данные категории из $all_categories
            $category_data = isset($all_categories[$post_type]) ? $all_categories[$post_type] : null;

            // Получаем изображение через ACF
            $image_field = get_field($category_data['image']); // Используем get_field для получения изображения

            // Сборка данных
            $result = [
                'title' => get_the_title(),
                'link' => get_permalink(),
                'image' => $image_field ? $image_field : get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'), // Если ACF-изображение пусто, используем стандартное изображение
                'type' => $post_type,
                'category' => $category_data, // Добавляем данные категории
            ];

            // Дополнительные данные для типа "online_casino"
            if ($post_type === 'online_casino') {
                $result['min_deposit'] = get_field('min_deposit'); // Получаем минимальную сумму депозита
                $result['withdraw_limits'] = get_field('withdraw_limits'); // Получаем лимиты на вывод
            }

            // Добавляем результат в массив
            $results[] = $result;
        }

        wp_reset_postdata();

        // Ответ с результатами
        wp_send_json_success([
            'results' => $results,
            'showAllLink' => 'search/?q=' . urlencode($query)  // Ссылка для показа всех результатов
        ]);
    } else {
        // Если ничего не найдено, возвращаем ошибку
        wp_send_json_error(['message' => 'Ничего не найдено.']);
    }
}

function enqueue_ajax_search_scripts() {
    wp_enqueue_script('ajax-search', get_template_directory_uri() . '/assets/js/search-container.js', ['jquery'], null, true);
    
    wp_localize_script('ajax-search', 'ajax_search_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax_search_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_search_scripts');

?>
