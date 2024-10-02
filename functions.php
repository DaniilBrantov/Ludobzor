<?php
function mytheme_enqueue_assets() {
    // Подключение стилей
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('header-style', get_template_directory_uri() . '/assets/css/header.css');

    // Подключение скриптов
    // wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);
    // Параметр true указывает на то, что скрипт будет подключен в футере
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');


function sendToPage($link){
    return esc_attr($link);
}

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