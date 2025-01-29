<?php
// $_POST['filters'] = [
//     [
//         'field_name' => 'oczenka_portala',
//         'label_text' => '4'
//     ],
//     [
//         'field_name' => 'providers',
//         'label_text' => 'Microgaming'
//     ],
// ];



class FilteredPostsHandler
{
    /**
     * Инициализация обработки запроса.
     */
    public static function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            self::sendErrorResponse('Недопустимый метод запроса.', 405);
            return;
        }
    
        if (empty($_POST['filters']) || !is_array($_POST['filters'])) {
            self::sendErrorResponse('Фильтры не переданы или имеют некорректный формат.');
            return;
        }
    
        $filters = $_POST['filters'];
    
        $validatedFilters = [];
        foreach ($filters as $filter) {
            if (isset($filter['field_name'], $filter['label_text'])) {
                $validatedFilters[] = [
                    'field_name' => sanitize_text_field($filter['field_name']),
                    'label_text' => sanitize_text_field($filter['label_text']),
                ];
            } else {
                self::sendErrorResponse('Некорректный формат фильтров. Требуются "field_name" и "label_text".');
                return;
            }
        }
    
        if (empty($validatedFilters)) {
            self::sendErrorResponse('Нет валидных фильтров.');
            return;
        }
    
        $posts = self::getFilteredPosts($validatedFilters);
    
        if (!empty($posts)) {
            self::sendSuccessResponse('Посты найдены.', $posts);
        } else {
            self::sendErrorResponse('Нет постов, соответствующих фильтрам.');
        }

    }  

    /**
     * Отправка успешного ответа.
     */
    private static function sendSuccessResponse($message, $posts)
    {
        wp_send_json_success([
            'message' => $message,
            'posts' => $posts,
        ]);
    }

    /**
     * Отправка ошибки в ответ.
     */
    private static function sendErrorResponse($message, $statusCode = 400, $errorCode = null)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');

        $response = [
            'success' => false,
            'data' => [
                'message' => $message,
            ],
        ];

        if ($errorCode !== null) {
            $response['data']['error_code'] = $errorCode;
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }


    private static function getPaymentSystemsData($items)
    {
        $itemsData = [];

        if (!$items || !is_array($items)) {
            error_log("Поле пустое или не является массивом.");
            return $itemsData;
        }

        foreach ($items as $index => $item) {
            error_log("Обработка элемента #{$index}: " . print_r($item, true));

            if (!is_object($item) || !isset($item->ID)) {
                error_log("Элемент #{$index} не является объектом или отсутствует ID.");
                continue;
            }

            $args = [
                'post_type' => 'platezhnie_sistemi',  // Тип поста для платежных систем
                'posts_per_page' => 1,
                'p' => $item->ID,
            ];

            $items_query = new WP_Query($args);

            if ($items_query->have_posts()) {
                $items_query->the_post();
                $itemsData[] = [
                    'name' => get_the_title(),
                    'image' => get_field('иконка') ?: get_template_directory_uri() . "/assets/images/default-provider-img.png",
                    'url' => get_permalink(),
                ];
            } else {
                error_log("Запись для ID {$item->ID} не найдена.");
            }

            wp_reset_postdata();
        }
        return $itemsData;
    }

    private static function getProvidersData($items)
    {
        $itemsData = [];
        if (!$items || !is_array($items)) {
            error_log("Поле пустое или не является массивом.");
            return $itemsData;
        }
        foreach ($items as $index => $item) {
            error_log("Обработка элемента #{$index}: " . print_r($item, true));
            if (!is_object($item) || !isset($item->ID)) {
                error_log("Элемент #{$index} не является объектом или отсутствует ID.");
                continue;
            }
            $args = [
                'post_type' => 'providers',  // Тип поста для провайдеров
                'posts_per_page' => 1,
                'p' => $item->ID,
            ];
            $items_query = new WP_Query($args);

            if ($items_query->have_posts()) {
                $items_query->the_post();
                $itemsData[] = [
                    'name' => get_the_title(),
                    'image' => get_field('logo') ?: get_template_directory_uri() . "/assets/images/default-provider-img.png",
                    'url' => get_permalink(),
                ];
            } else {
                error_log("Запись для ID {$item->ID} не найдена.");
            }

            wp_reset_postdata();
        }

        return $itemsData;
    }
    private static function getFilteredPosts(array $filters)
    {
        $args = [
            'post_type' => 'online_casino',
            'posts_per_page' => -1,
        ];
        $query = new WP_Query($args);
    
        if (!$query->have_posts()) {
            return [];
        }
    
        $args_data = [
            'post_image' => 'logo',
            'providers' => 'providers',
            'payment_systems' => 'payment_way',
            'rating' => 'oczenka_portala',
            'game_types' => 'game_types',
            'positive_rating_text' => 'текст_в_рейтинге_пункты_положительные',
            'promo' => 'promo',
            'promo_photo' => 'promo_photo',
        ];
    
        $filteredPosts = [];
    
        while ($query->have_posts()) {
            $query->the_post();
            $postId = get_the_ID();
            $postData = self::getPostData($args_data, $postId);
    
            $match = true;
            foreach ($filters as $filter) {
                $fieldName = sanitize_text_field($filter['field_name']);
                $labelText = sanitize_text_field($filter['label_text']);
    
                if (!self::checkFilterMatch($fieldName, $labelText, $postData)) {
                    $match = false;
                    break;
                }
            }
    
            if ($match) {
                $filteredPosts[] = $postData;
            }
        }
    
        wp_reset_postdata();
        return $filteredPosts;
    }
    
    private static function getPostData($args_data, $postId)
    {
        $postData = [
            'id' => $postId,
            'title' => get_the_title($postId) ?: 'Без названия',
            'clean_title' => get_field('чистое_название', $postId) ?: null,
            'permalink' => get_permalink($postId) ?: '#',
            'image' => get_field($args_data['post_image'], $postId) ?: get_template_directory_uri() . "/assets/images/default-post-img.png",
            'rating' => get_field($args_data['rating'], $postId) ?: 0,
            'game_types' => '',
            'promo_desc' => get_field('описание_промокода', $postId) ?: null,
            'positive_rating_text' => array_filter(
                explode(',', get_field($args_data['positive_rating_text'], $postId) ?: '')
            ),
            'promo' => get_field($args_data['promo'], $postId) ?: null,
            'promo_photo' => get_field($args_data['promo_photo'], $postId) ?: null,
        ];
        
        // **Обработка game_types (если это Relationship или Term поле)**
        $gameTypes = get_field($args_data['game_types'], $postId);
        if (is_array($gameTypes)) {
            $postData['game_types'] = implode(', ', array_map(function ($item) {
                return is_object($item) && isset($item->name) ? $item->name : '';
            }, $gameTypes));
        }
        
        // **Обработка payment_systems (если Relationship-поле)**
        $postData['payment_systems'] = [];
        $paymentSystems = get_field($args_data['payment_systems'], $postId);
        if (is_array($paymentSystems)) {
            $postData['payment_systems'] = self::getPaymentSystemsData($paymentSystems);
        }
        
        $postData['providers'] = [];
        $providers = get_field($args_data['providers'], $postId);
        if (is_array($providers)) {
            $postData['providers'] = self::getProvidersData($providers);
        }
    
        return $postData;
    }
    
    private static function checkFilterMatch($fieldName, $labelText, $postData)
    {
        switch ($fieldName) {
            case 'permitted_countries':
                return self::checkPermittedCountries($labelText, $postData['id']);
            case 'live_chat_podderzhka':
                return get_field($fieldName, $postData['id']);
            case 'game_count':
                return (int) get_field($fieldName, $postData['id']) >= (int) $labelText;
            case 'min_deposit':
            case 'oczenka_portala':
                return (float) get_field($fieldName, $postData['id']) >= (float) $labelText;
            default:
                return self::checkGenericMatch($fieldName, $labelText, $postData);
        }
    }
    
    private static function checkPermittedCountries($labelText, $postId)
    {
        $restrictedCountries = get_field('запрещенные_страны', $postId);
        if ($restrictedCountries) {
            foreach ($restrictedCountries as $item) {
                if ($item->name === $labelText) {
                    return false;
                }
            }
        }
        return true;
    }
    
    private static function checkGenericMatch($fieldName, $labelText, $postData)
    {
        $fieldValue = get_field($fieldName, $postData['id']);
        if (is_array($fieldValue)) {
            foreach ($fieldValue as $item) {
                if (self::matchesLabel($item, $labelText)) {
                    return true;
                }
            }
        } elseif ($fieldValue instanceof WP_Term) {
            return self::matchesLabel($fieldValue, $labelText);
        }
        return false;
    }
    
    private static function matchesLabel($item, $labelText)
    {
        return (is_object($item) && property_exists($item, 'name') && stripos((string) $item->name, $labelText) !== false) ||
               (is_object($item) && property_exists($item, 'post_title') && stripos((string) $item->post_title, $labelText) !== false);
    }
    
    
}
FilteredPostsHandler::handleRequest();