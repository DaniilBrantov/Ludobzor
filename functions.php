<?php
// Подключение файла с подключениями стилей и скриптов
require_once get_template_directory() . '/inc/enqueue-scripts.php';

//Подключение файла с функциями настройки темы
require_once get_template_directory() . '/inc/theme-setup.php';

//Подключение файла с endpoint для обработки AJAX-запросов
require_once get_template_directory() . '/inc/ajax-search-handler.php';

// Удаляет стандартные мета-теги и стили, которые WordPress добавляет автоматически
// + Добавление заголовков с фильтрами
require_once get_template_directory() . '/inc/setting-head.php';

// Функция для поиска нужного параметра в массиве $param
function get_page_meta_query($params) {
    // Получаем текущий slug страницы
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
    // Возвращаем пустой массив если не найдено
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

/**
 * Функция для вывода данных поста.
 */
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

// Функция для получения массива названий терминов таксономии
function get_taxonomy_terms($taxonomy) {
    return array_map(function($term) {
        return $term->name;
    }, get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false]));
}



// Функции для обратной связи


// Обработчик AJAX
function handle_feedback_form() {
    // Проверяем nonce для безопасности
    check_ajax_referer('feedback_form_nonce', 'nonce');

    // Получаем данные формы
    $fio = sanitize_text_field($_POST['fio']);
    $email = sanitize_email($_POST['email']);
    $comment = sanitize_textarea_field($_POST['comment']);

    // Проверка обязательных полей
    if (empty($fio) || empty($email) || empty($comment)) {
        wp_send_json_error(['message' => 'Все поля обязательны для заполнения.']);
    }

    // Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        wp_send_json_error(['message' => 'Введите корректный email.']);
    }

    // Проверка длины комментария
    if (strlen($comment) > 200) {
        wp_send_json_error(['message' => 'Комментарий не может содержать более 200 символов.']);
    }

    // Получаем текущую дату
    $current_date = date('Y-m-d');

    // Проверяем, был ли уже отправлен такой же комментарий с тем же email за сегодня
    global $wpdb;
    $table_name = $wpdb->prefix . 'posts';

    $duplicate_check = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE post_type = 'feedback' AND post_status = 'publish' AND meta_key = 'email' AND meta_value = %s AND post_content = %s AND DATE(post_date) = %s",
        $email, $comment, $current_date
    ));

    if ($duplicate_check > 0) {
        wp_send_json_error(['message' => 'Вы уже отправляли этот комментарий сегодня.']);
    }

    // Создаем запись в кастомном типе записей (например, "Сообщения")
    $post_id = wp_insert_post([
        'post_title'   => $fio,
        'post_content' => $comment,
        'post_type'    => 'feedback',
        'post_status'  => 'publish',
        'meta_input'   => [
            'email' => $email, // Сохраняем email как метаполе
        ]
    ]);

    if ($post_id) {
        wp_send_json_success(['message' => 'Ваше сообщение успешно отправлено.']);
    } else {
        wp_send_json_error(['message' => 'Произошла ошибка. Попробуйте позже.']);
    }
}

add_action('wp_ajax_handle_feedback_form', 'handle_feedback_form');
add_action('wp_ajax_nopriv_handle_feedback_form', 'handle_feedback_form');

// Кастомный тип записей для хранения сообщений
function register_feedback_post_type() {
    register_post_type('feedback', [
        'labels' => [
            'name'          => 'Обратная связь',
            'singular_name' => 'Обратная связь',
        ],
        'public'        => false,
        'has_archive'   => false,
        'show_ui'       => true, // Отображение в админке
        'supports'      => ['title', 'editor'],
    ]);
}
add_action('init', 'register_feedback_post_type');

// Добавляем колонку для отображения email в таблице записей
function add_feedback_columns($columns) {
    $columns['email'] = 'Email отправителя';
    return $columns;
}
add_filter('manage_feedback_posts_columns', 'add_feedback_columns');

// Заполняем колонку email данными
function fill_feedback_columns($column, $post_id) {
    if ($column === 'email') {
        $email = get_post_meta($post_id, 'email', true); // Получаем значение метаполя
        echo esc_html($email);
    }
}
add_action('manage_feedback_posts_custom_column', 'fill_feedback_columns', 10, 2);

// JavaScript для отправки формы без перезагрузки
function enqueue_feedback_form_scripts() {
    wp_enqueue_script(
        'feedback-form-script',
        get_template_directory_uri() . '/assets/js/feedback-form.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('feedback-form-script', 'feedbackForm', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('feedback_form_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_feedback_form_scripts');



// Ограничить доступ к контенту для неавторизованных пользователей. 
function restrict_site_to_logged_in_users() {
    if (!is_user_logged_in() && !is_admin() && !defined('DOING_AJAX')) {
        wp_redirect(wp_login_url());
        exit;
    }
}
add_action('template_redirect', 'restrict_site_to_logged_in_users');

