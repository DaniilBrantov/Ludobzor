<?php

class Review_Handler {

    public function __construct() {
        // Регистрируем хук для обработки AJAX запроса
        add_action('wp_ajax_handle_review_form', [$this, 'handle_review_form']);
        add_action('wp_ajax_nopriv_handle_review_form', [$this, 'handle_review_form']);

        // Регистрируем кастомный тип записи
        add_action('init', [$this, 'register_review_post_type']);

        // Добавляем колонки для отображения email и рейтинга
        add_filter('manage_review_posts_columns', [$this, 'add_review_columns']);

        // Заполняем колонки для отображения данных
        add_action('manage_review_posts_custom_column', [$this, 'fill_review_columns'], 10, 2);

        // Регистрируем скрипт для отправки формы
        add_action('wp_enqueue_scripts', [$this, 'enqueue_review_form_scripts']);
    }

    public function handle_review_form() {
        // Проверка nonce
        if (!check_ajax_referer('review_form_nonce', 'nonce')) {
            wp_send_json_error(['message' => 'Неверный nonce.']);
        }

        // Получаем и фильтруем данные формы
        $fio = sanitize_text_field($_POST['fio']);
        $rating = sanitize_text_field($_POST['rating']);
        $post_id = intval($_POST['post_id']); // ID поста
        $review = sanitize_textarea_field($_POST['review']);

        // Проверка обязательных полей
        if (empty($fio) || empty($rating) || empty($post_id) || empty($review)) {
            wp_send_json_error(['message' => 'Все поля обязательны для заполнения.']);
        }

        // Проверка рейтинга
        if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
            wp_send_json_error(['message' => 'Рейтинг должен быть числом от 1 до 5.']);
        }

        // Получаем текущего пользователя
        $current_user = wp_get_current_user();
        $email = $current_user->user_email;

        // Проверка на дублирование отзыва
        global $wpdb;
        $current_date = date('Y-m-d');
        $duplicate_check = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) 
             FROM $wpdb->posts p
             INNER JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
             WHERE p.post_type = 'review' 
             AND pm.meta_key = 'email' 
             AND pm.meta_value = %s 
             AND p.post_content = %s 
             AND DATE(p.post_date) = %s",
            $email, $review, $current_date
        ));

        if ($duplicate_check > 0) {
            wp_send_json_error(['message' => 'Вы уже отправляли этот комментарий сегодня.']);
        }

        // Создаем запись отзыва
        $review_post_id = wp_insert_post([
            'post_title'   => $fio,
            'post_content' => $review,
            'post_type'    => 'review',
            'post_status'  => 'draft',
            'meta_input'   => [
                'email'   => $email,
                'rating'  => $rating,
                'post_id' => $post_id, // Сохраняем связанный ID поста
            ]
        ]);

        if ($review_post_id) {
            wp_send_json_success(['message' => 'Ваше сообщение успешно отправлено.', 'data' => [
                'fio'    => $fio,
                'rating' => $rating,
                'review' => $review,
            ]]);
        } else {
            wp_send_json_error(['message' => 'Произошла ошибка. Попробуйте позже.']);
        }
    }

    // Регистрация кастомного типа записей
    public function register_review_post_type() {
        register_post_type('review', [
            'labels' => [
                'name'          => 'Отзывы',
                'singular_name' => 'Отзыв',
            ],
            'public'        => false,
            'has_archive'   => false,
            'show_ui'       => true,
            'supports'      => ['title', 'editor'],
        ]);
    }

    // Добавляем колонку для ID поста
    public function add_review_columns($columns) {
        $columns['email'] = 'Email';
        $columns['review'] = 'Отзыв';
        $columns['rating'] = 'Рейтинг';
        $columns['post_id'] = 'ID Поста'; // Новая колонка
        return $columns;
    }

// Заполняем колонку для ID поста
public function fill_review_columns($column, $post_id) {
    if ($column === 'email') {
        $email = get_post_meta($post_id, 'email', true);
        echo esc_html($email);
    }

    if ($column === 'rating') {
        $rating = get_post_meta($post_id, 'rating', true);
        echo esc_html($rating);
    }

    if ($column === 'review') {
        $review = get_post_meta($post_id, 'review', true);
        echo esc_html(mb_substr($review, 0, 50));
    }

    if ($column === 'post_id') {
        $related_post_id = get_post_meta($post_id, 'post_id', true);
        if ($related_post_id) {
            // Генерируем ссылку на пост
            $post_url = get_permalink($related_post_id);
            echo '<a href="' . esc_url($post_url) . '" target="_blank">' . esc_html($related_post_id) . '</a>';
        } else {
            echo '—';
        }
    }
}

    // Регистрируем и локализуем скрипт
    public function enqueue_review_form_scripts() {
        wp_enqueue_script(
            'review-form-script',
            get_template_directory_uri() . '/assets/js/review-form.js',
            ['jquery'],
            null,
            true
        );

        wp_localize_script('review-form-script', 'reviewForm', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('review_form_nonce'),
        ]);
    }
}

// Создаем экземпляр класса
$review_handler = new Review_Handler();



















