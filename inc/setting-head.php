<?php

function clean_wp_head() {
    // Удаляем ссылки на RSS-фиды
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);

    // Удаляем RSD-ссылку (для удаленного публикации через XML-RPC)
    remove_action('wp_head', 'rsd_link');

    // Удаляем WLW-ссылку (используется Windows Live Writer)
    remove_action('wp_head', 'wlwmanifest_link');

    // Удаляем короткие ссылки на текущую страницу
    remove_action('wp_head', 'wp_shortlink_wp_head');

    // Удаляем генератор версии WordPress
    remove_action('wp_head', 'wp_generator');

    // Удаляем link rel="canonical", если он генерируется плагином Yoast
    remove_action('wp_head', 'rel_canonical');

    // Удаляем эмодзи-скрипты и стили
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // Удаляем мета-теги REST API
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

    // Удаляем стили и скрипты для редактора блоков
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // Для WooCommerce

    // Удаляем meta rel=next/prev
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
}
add_action('init', 'clean_wp_head');

// Удаляем админ-бар CSS в публичной части сайта
add_action('wp_enqueue_scripts', function () {
    if (!is_admin()) {
        wp_dequeue_style('admin-bar');
    }
}, 99);

add_filter('show_admin_bar', '__return_false');




add_action('wp_head', 'add_custom_meta_tags');
function add_custom_meta_tags() {
    if (is_front_page()) {
        echo '<meta name="description" content="Обзор лучших лицензионных онлайн казино на реальные деньги, которые платят выигрыши без задержек и комиссий. ✔️ В базе уже более 400 наименований и она наполняться новыми данными.">';
        echo '<meta name="keywords" content="Обзор онлайн казино">';
    } elseif (is_single()) {
        echo '<meta name="description" content="' . esc_attr(get_the_excerpt()) . '">';
        echo '<meta name="keywords" content="' . esc_attr(get_the_title()) . '">';
    }
}

function remove_unused_wp_styles_and_scripts() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'remove_unused_wp_styles_and_scripts');


function add_async_defer_attributes($tag, $handle) {
    // Применяем только к конкретным скриптам
    $scripts_to_async = array('subscribe-js', 'yandex-metrika');

    if (in_array($handle, $scripts_to_async)) {
        return str_replace(' src', ' async="async" src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_async_defer_attributes', 10, 2);

