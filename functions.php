<?php
require_once get_template_directory() . '/inc/enqueue-scripts.php';
require_once get_template_directory() . '/inc/theme-setup.php';
require_once get_template_directory() . '/inc/handlers/ajax-search-handler.php';
require_once get_template_directory() . '/inc/handlers/review-handler.php';
require_once get_template_directory() . '/inc/handlers/feedback-handler.php';
require_once get_template_directory() . '/inc/setting-head.php';
require_once get_template_directory() . '/inc/routing.php';





// Функция для поиска нужного параметра в массиве $param
function get_page_meta_query($params) {
    if (empty($params['page_args']) || !is_array($params['page_args'])) {
        return [
            'meta_query' => [],
            'page_title' => '',
            'page_link'  => ''
        ];
    }

    $page_slug = get_page_uri();
    foreach ($params['page_args'] as $page_param) {
        if (strpos($page_slug, $page_param['link']) !== false) {
            return [
                'meta_query' => isset($page_param['meta_query']) ? $page_param['meta_query'] : [],
                'page_title' => isset($page_param['menu_title']) ? $page_param['menu_title'] : '',
                'page_link'  => isset($page_param['link']) ? $page_param['link'] : ''
            ];
        }
    }

    return [
        'meta_query' => [],
        'page_title' => '',
        'page_link'  => ''
    ];
}


// Функция для ограничения длины заголовка
function get_trimmed_title($title, $max_length = 20) {
    return mb_strlen($title) > $max_length ? mb_substr($title, 0, $max_length) . '...' : $title;
}

// Функция для хлебных крошек
function custom_breadcrumbs_schema() {

    // Настройки
    $separator = '→'; // Разделитель
    $home_title = 'Главная'; // Название главной страницы
    $schema_breadcrumb = 'http://schema.org/BreadcrumbList'; // Schema URL
    $schema_listItem = 'http://schema.org/ListItem'; // Schema ListItem

    // Начало HTML с микроразметкой
    echo '<div class="bread-crumbs"><ul class="bread-crumbs container" itemscope itemtype="' . $schema_breadcrumb . '">';

    // Ссылка на главную
    echo '<li itemprop="itemListElement" itemscope itemtype="' . $schema_listItem . '">';
    echo '<a itemprop="item" href="' . get_home_url() . '" title="' . $home_title . '"><span itemprop="name">' . $home_title . '</span></a>';
    echo '<meta itemprop="position" content="1" /></li>';
    echo '<li><span>' . $separator . '</span></li>';

    // Для категорий и постов
    if ( is_single() ) {

        // Получаем категории поста
        $categories = get_the_category();
        if ( !empty( $categories ) ) {
            $last_category = end( $categories );
            $category_link = get_category_link( $last_category->term_id );
            echo '<li itemprop="itemListElement" itemscope itemtype="' . $schema_listItem . '">';
            echo '<a itemprop="item" href="' . $category_link . '" title="' . $last_category->name . '"><span itemprop="name">' . $last_category->name . '</span></a>';
            echo '<meta itemprop="position" content="2" /></li>';
            echo '<li><span>' . $separator . '</span></li>';
        }

        // Название поста
        echo '<li itemprop="itemListElement" itemscope itemtype="' . $schema_listItem . '">';
        echo '<span itemprop="item"><span itemprop="name">' . get_the_title() . '</span></span>';
        echo '<meta itemprop="position" content="3" /></li>';

    } elseif ( is_page() ) {

        // Для страниц
        echo '<li itemprop="itemListElement" itemscope itemtype="' . $schema_listItem . '">';
        echo '<span itemprop="item"><span itemprop="name">' . get_the_title() . '</span></span>';
        echo '<meta itemprop="position" content="2" /></li>';

    }

    // Закрываем HTML
    echo '</ul></div>';
}


function render_category_posts($args_data, $args=false) {
    $params = false;
    require get_theme_file_path('/parts/part-display-promo-cat.php');
}


function display_post($post_id, $post_link, $post_title, $post_image, $promo_code, $promo_description, $args_data) {
    ?>
    <div class="angled-img angled-img-promocode-tbi" id="bx_<?php echo esc_attr($post_id); ?>">
        <div class="img img-offset">
            <a href="<?php echo esc_url($post_link); ?>">
                <img src="<?php echo esc_url($post_image); ?>" alt="<?php echo esc_attr($post_title); ?>">
            </a>
        </div>
        <div class="bottom-info bottom-info-promocode">
            <h4>
                <span>
                    <?php if (count($args_data['post_type']) > 1): ?>
                        <text style="font-size: 16px; font-weight: 400;">
                            <a href="<?php echo esc_url($post_link); ?>">
                                <?php echo esc_html($post_title); ?>
                            </a>
                        </text>
                    <?php else: ?>
                        <i><?php echo esc_html($promo_description); ?></i>
                    <?php endif; 

                    $bonus = get_field('banner', $post_id) ?: '';
                    $promo_photo = get_field('promo_photo', $post_id) ?: '';
                    $promo_code = get_field('promo', $post_id) ?: 'LUDOBZOR';
                    ?>
                    
                    <div class="oc__bonus__timer" id="oc__bonus__timer">
                        <a id="get_promo" class="btn_promo-green copy_promocode_link" 
                        data-image-src="<?php echo esc_url($promo_photo); ?>"
                        data-promo-code="<?php echo esc_html($promo_code); ?>">
                            Промокод
                        </a>
                    </div>
                </span>
            </h4>
        </div>
    </div>
    <?php
}
































function update_acf_fields_for_iblock_code($iblock, $code, $slug, $type, $post_type) {
    global $wpdb;

    $data = [];

    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT e.NAME as post_name, p.VALUE as post_value
            FROM b_iblock_element_property AS p
            INNER JOIN b_iblock_element AS e ON p.IBLOCK_ELEMENT_ID = e.ID
            INNER JOIN b_iblock_property AS ip ON p.IBLOCK_PROPERTY_ID = ip.ID
            WHERE e.IBLOCK_ID = %d AND ip.CODE = %s", 
            $iblock, $code
        )
    );

    foreach ($results as $row) {

        $value = $row->post_value;

        if ($type === 'int') {
            $value = preg_replace('/\D/', '', $value); // Оставляем только цифры
        }

        if ($type === 'text') {
            $value = $value;
        }

        // Логика для типа bool
        if ($type === 'bool') {
            $enum_value = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT VALUE FROM b_iblock_property_enum WHERE ID = %d", 
                    $value
                )
            );
            $value = ($enum_value === 'Да') ? true : false;
        }

        // Логика для типа array

        if ($type === 'tax_array') {
            $values = array_map('trim', explode(',', $value)); // Разбиваем строку в массив
            $tax_ids = [];

            foreach ($values as $term_name) {
                // Проверяем, есть ли термин в базе
                $term_id = $wpdb->get_var($wpdb->prepare(
                    "SELECT t.term_id 
                    FROM {$wpdb->terms} t
                    INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id
                    WHERE t.name = %s AND tt.taxonomy = %s",
                    $term_name, $slug
                ));

                // Если термина нет, добавляем его
                if (!$term_id) {
                    $wpdb->insert("{$wpdb->terms}", ['name' => $term_name, 'slug' => sanitize_title($term_name)]);
                    $term_id = $wpdb->insert_id;

                    $wpdb->insert("{$wpdb->term_taxonomy}", ['term_id' => $term_id, 'taxonomy' => $slug]);
                }

                $tax_ids[] = $term_id; // Добавляем term_id в массив
            }

            $value = $tax_ids; // Выходное значение - массив term_id
        }


        if ($type === 'tax_str') {
            // Попытка найти термин в базе данных
            $term_id = $wpdb->get_var($wpdb->prepare(
                "SELECT t.term_id 
                FROM {$wpdb->terms} t
                INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id
                WHERE t.name = %s AND tt.taxonomy = %s",
                $value, $slug
            ));
            
            if (!$term_id) {
                $wpdb->insert("{$wpdb->terms}", [
                    'name' => $value, 
                    'slug' => sanitize_title($value)
                ]);

                $term_id = $wpdb->insert_id;

                $wpdb->insert("{$wpdb->term_taxonomy}", [
                    'term_id' => $term_id, 
                    'taxonomy' => $slug, 
                    'description' => '', // или любое значение по умолчанию
                    'parent' => 0, // если термин не имеет родителя
                    'count' => 0 // или любое значение по умолчанию
                ]);
            }

            $value = [$term_id];
        }

        

        $data[] = [
            'post_name' => $row->post_name,
            'value' => $value
        ];

        $post_title = $row->post_name;
        $args = array(
            'post_type'      => $post_type,
            'post_title'     => $post_title,
            'posts_per_page' => -1,
            'fields'         => 'ids'
        );
        
        $query = new WP_Query($args);
        
        if ($query->have_posts()) {
            $post_id = $query->posts[0];
        } else {
            echo 'Пост не найден';
            continue;
        }
        
        wp_reset_postdata();

            if (!empty($slug)) {
                $updated = update_field($slug, $value, $post_id);
                var_dump($updated);


                if (!$updated) {
                    $data['message'] = "Ошибка обновления ACF: post_id={$post_id}, field={$slug}, value=" . print_r($value, true);
                } else {
                    $data['message'] = "ACF обновлено: post_id={$post_id}, field={$slug}, value=" . print_r($value, true);
                }
            }
            delete_transient("acf_field_{$post_id}_{$slug}");
        

        

    }

    return $data;
}

$iblock = 27;
$code = 'LINKIFRAME';
$slug = 'demo-game'; 
$type = 'text'; 
$post_type = 'free_games';

// var_dump(update_acf_fields_for_iblock_code($iblock, $code, $slug, $type, $post_type ));

// 1) сделать поля owner








function get_iblock_fields($iblock_id) {
    global $wpdb;

    // Запрашиваем поля для указанного iblock
    $fields = $wpdb->get_results( $wpdb->prepare(
        "SELECT * FROM b_iblock_property WHERE IBLOCK_ID = %d",
        $iblock_id
    ) );

    $fields_array = array();

    // Формируем массив с названиями полей и их кодами
    if ( $fields ) {
        foreach ( $fields as $field ) {
            $fields_array[] = array(
                // 'id' => $field->ID,
                // 'name' => $field->NAME,
                'code' => $field->CODE
            );
    var_dump($field->CODE);

        }
    }
    return $fields_array;
}
// get_iblock_fields(27);






// function get_post_type_fields_from_db($iblock, $post_type) {
//     $fields_array = array();

//     // Получаем все посты данного типа
//     $posts = get_posts(array(
//         'post_type' => $post_type,
//         'posts_per_page' => -1, // Получаем все посты
//         'fields' => 'ids'
//     ));

//     if (empty($posts)) {
//         error_log("Нет данных для постов с post_type: $post_type");
//         return $fields_array; // Возвращаем пустой массив
//     }

//     $unique_fields = []; // Массив для хранения уникальных комбинаций

//     foreach ($posts as $post_id) {
//         // Получаем все мета-ключи для поста
//         $meta_keys = get_post_meta($post_id);
//         foreach ($meta_keys as $meta_key => $meta_value) {
//             var_dump($meta_keys);

//             $iblock_fields = get_iblock_fields($iblock);
//             foreach ($iblock_fields as $iblock_field) {
                
//                 if($iblock_field['id'] == 118){
//                     // var_dump($iblock_field['id']);
//                     // var_dump($iblock_field['name']);

//                     if ($meta_value[0] == $iblock_field['name']) {

//                         $unique_key = $post_id . '-' . $meta_key;
//                         if (!in_array($unique_key, $unique_fields)) {
//                             // Если не добавлялся, добавляем в массив
//                             $fields_array[] = array(
//                                 'b_key' => $iblock_field['code'],
//                                 'slug'  => $meta_key,
//                                 'label' => ltrim($meta_key, '_'),
//                             );

//                             // Добавляем уникальный ключ в массив
//                             $unique_fields[] = $unique_key;
            

//                         }
//                     }
//                 }
//             }
//         }
//     }


//     return $fields_array;
// }

// function get_posts_by_iblock_and_code($iblock, $code) {
//     global $wpdb;

//     // Запрос к базе данных для поиска постов с нужным iblock и мета-данными по коду
//     $query = "
//     SELECT e.ID as element_id, e.NAME as element_name, ep.VALUE as property_value
//     FROM b_iblock_element e
//     LEFT JOIN b_iblock_element_property ep ON e.ID = ep.IBLOCK_ELEMENT_ID
//     LEFT JOIN b_iblock_property p ON ep.IBLOCK_PROPERTY_ID = p.ID
//     WHERE e.IBLOCK_ID = %d AND p.CODE = %s
//     ";

//     // Подготовка запроса с параметрами
//     $results = $wpdb->get_results($wpdb->prepare($query, $iblock, $code));

//     if (!$results) {
//         error_log("Нет данных для iblock: $iblock и code: $code");
//         return [];
//     }

//     // Массив для хранения найденных данных
//     $fields_array = array();

//     // Перебираем все результаты и извлекаем необходимые данные
//     foreach ($results as $row) {
//         // Добавляем данные в массив
//         $fields_array[] = array(
//             'element_name' => $row->element_name,
//             'property_value' => $row->property_value,
//         );
//     }

//     return $fields_array;
// }

// function update_property_field($field_key, $new_value, $current_value, $el_name, $post_id) {
//     // Обновляем поле
//     $updated = update_field($field_key, $new_value, $post_id);

//     if ($updated) {
//         echo "Поле '$field_key' успешно обновлено для '{$el_name}'. Новое значение: $new_value\n";
//     } else {
//         echo "Ошибка обновления поля '$field_key' для '{$el_name}'.\n \n Новое значение: $new_value\n";
//     }

//     // Выводим массив обновленных данных
//     $update_array = [
//         'element_name'   => $el_name,
//         'label'          => $field_key,
//         'old_value'      => $current_value,
//         'new_value'      => $new_value
//     ];
// }

// function update_acf_fields_for_bookmakers($iblock_id, $code, $edit_field, $field_type) {
//     $get_fields = get_post_type_fields_from_db($iblock_id, $code);

//     foreach ($get_fields as $get_field) {
//         $field_key = $get_field["label"];
//     var_dump($field_key);
//     var_dump($edit_field);
//         if ($field_key !== $edit_field) {
//             continue;
//         }

//         $posts = get_posts_by_iblock_and_code($iblock_id, $get_field["b_key"]);
//         echo "Обновление поля: '$field_key'\n";

//         echo "-------------\n";

//         foreach ($posts as $post) {
//             // Выполняем запрос для поиска поста по названию
//             $query = new WP_Query([
//                 'post_type'      => 'bookmakers',
//                 'title'          => $post["element_name"],
//                 'posts_per_page' => 1
//             ]);
        
//             if ($query->have_posts()) {
//                 $query->the_post();
//                 $post_id = get_the_ID();
//                 $el_name = $post["element_name"];
//                 $property_value = $post["property_value"];
        
//                 $current_value = get_field($field_key, $post_id);

//                 if ($field_type == 'int') {
//                     // Преобразуем значение в число, удалив все нечисловые символы
//                     $new_value = (int) preg_replace('/\D/', '', $property_value);

//                     if ($current_value !== $new_value) {
//                         update_property_field($field_key, $new_value, $current_value, $el_name, $post_id);
//                     } else {
//                         echo "Поле '$field_key' для '{$el_name}' уже актуально, обновление не требуется. Значение '{$property_value}' = '{$current_value}'\n";
//                     }
//                 }
//                 if ($field_type == 'text') {
//                     $new_value = $property_value;

//                     if ($current_value !== $new_value) {
//                         update_property_field($field_key, $new_value, $current_value, $el_name, $post_id);
//                     } else {
//                         echo "Поле '$field_key' для '{$el_name}' уже актуально, обновление не требуется. Значение '{$property_value}' = '{$current_value}'\n";
//                     }
//                 }
//                 if ($field_type == 'arr') {
//                     if ($current_value !== $property_value) {
//                         $property_items = explode(',', $property_value);
//                         foreach ($property_items as $property_item) {
//                             $property_item = trim($property_item);
                            
//                             $taxonomy_exists = taxonomy_exists($property_item, $field_key);
                        
//                             if (!$taxonomy_exists) {
//                                 wp_insert_term($property_item, $field_key);
//                             }
                        
//                             $term = get_term_by('name', $property_item, $field_key);
//                             if ($term) {
//                                 $taxonomy_id = $term->term_id;
                        
//                                 if ($current_value !== $property_item) {
//                                     update_property_field($field_key, $taxonomy_id, $current_value, $el_name, $post_id);
//                                 }
//                             }
//                         }
                        
//                     } else {
//                         echo "Поле '$field_key' для '{$el_name}' уже актуально, обновление не требуется. Значение '{$property_value}' = '{$current_value}'\n";
//                     }
//                 }

//                 wp_reset_postdata();  // Сброс данных поста
//             } else {
//                 error_log("Пост с названием '{$post['element_name']}' не найден.");
//             }
//         }
//     }
// }

// update_acf_fields_for_bookmakers(22, 'bookmakers', 'min_stavka', 'int');






// var_dump(get_post_type_fields_from_db(22, 'bookmakers')) ;












