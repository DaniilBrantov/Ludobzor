<?php
// Класс для управления формой обратной связи
class FeedbackFormHandler {

    private static $instance = null;

    // Получить экземпляр класса (Singleton)
    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('wp_ajax_handle_feedback_form', [$this, 'handle_feedback_form']);
        add_action('wp_ajax_nopriv_handle_feedback_form', [$this, 'handle_feedback_form']);
        add_action('init', [$this, 'register_feedback_post_type']);
        add_filter('manage_feedback_posts_columns', [$this, 'add_feedback_columns']);
        add_action('manage_feedback_posts_custom_column', [$this, 'fill_feedback_columns'], 10, 2);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_feedback_form_scripts']);
    }

    // Обработчик AJAX
    public function handle_feedback_form() {
        // Проверяем nonce для безопасности
        if (!check_ajax_referer('feedback_form_nonce', 'nonce', false)) {
            wp_send_json_error(['message' => 'Некорректный nonce.']);
        }

        // Получаем и проверяем данные
        $fio = sanitize_text_field($_POST['fio'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        $comment = sanitize_textarea_field($_POST['comment'] ?? '');

        if (!$fio || !$email || !$comment) {
            wp_send_json_error(['message' => 'Все поля обязательны для заполнения.']);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            wp_send_json_error(['message' => 'Введите корректный email.']);
        }

        if (strlen($comment) > 200) {
            wp_send_json_error(['message' => 'Комментарий не может содержать более 200 символов.']);
        }

        $current_date = date('Y-m-d');

        // Проверка на дублирование комментария
        global $wpdb;
        $table_name = $wpdb->prefix . 'posts';
        $duplicate_check = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$table_name} p
             INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
             WHERE p.post_type = 'feedback'
               AND p.post_status = 'publish'
               AND pm.meta_key = 'email'
               AND pm.meta_value = %s
               AND p.post_content = %s
               AND DATE(p.post_date) = %s",
            $email, $comment, $current_date
        ));

        if ($duplicate_check > 0) {
            wp_send_json_error(['message' => 'Вы уже отправляли этот комментарий сегодня.']);
        }

        // Создание записи
        $post_id = wp_insert_post([
            'post_title'   => $fio,
            'post_content' => $comment,
            'post_type'    => 'feedback',
            'post_status'  => 'publish',
            'meta_input'   => ['email' => $email],
        ]);

        if ($post_id) {
            wp_send_json_success(['message' => 'Ваше сообщение успешно отправлено.']);
        } else {
            wp_send_json_error(['message' => 'Произошла ошибка. Попробуйте позже.']);
        }
    }

    // Регистрация кастомного типа записей
    public function register_feedback_post_type() {
        register_post_type('feedback', [
            'labels'      => [
                'name'          => 'Обратная связь',
                'singular_name' => 'Обратная связь',
            ],
            'public'      => false,
            'has_archive' => false,
            'show_ui'     => true,
            'supports'    => ['title', 'editor'],
        ]);
    }

    // Добавление колонки email
    public function add_feedback_columns($columns) {
        $columns['email'] = 'Email отправителя';
        return $columns;
    }

    // Заполнение колонки email
    public function fill_feedback_columns($column, $post_id) {
        if ($column === 'email') {
            echo esc_html(get_post_meta($post_id, 'email', true));
        }
    }

    // Подключение JavaScript
    public function enqueue_feedback_form_scripts() {
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
}

// Инициализация класса
FeedbackFormHandler::get_instance();
?>
