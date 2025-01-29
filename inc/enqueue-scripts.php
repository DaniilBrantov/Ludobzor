<?php
function mytheme_enqueue_assets() {

    // Подключение общих стилей
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('header-style', get_template_directory_uri() . '/assets/css/header.css', array('main-style'));
    wp_enqueue_style('new-style', get_template_directory_uri() . '/assets/css/new.css', array('main-style')); // Заменил зависимость на 'main-style'


    // Подключение плагинов и скриптов для страниц слайдеров
    if (is_front_page()) {
        wp_enqueue_style('owl-carousel-style', get_template_directory_uri() . '/node_modules/owl.carousel/dist/assets/owl.carousel.min.css');
        wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/node_modules/owl.carousel/dist/owl.carousel.min.js', array('jquery'), null, true);
        wp_enqueue_script('carousel', get_template_directory_uri() . '/assets/js/carousel.js', array('owl-carousel'), null, true);
        wp_enqueue_script('filter-menu', get_template_directory_uri() . '/assets/js/filter-menu.js', array('jquery'), null, true);
    
    }

    // Подключение плагинов и скриптов для страниц с фильтрами и слайдерами
    if (is_page_template('reyting-kazino.php')) {
        wp_enqueue_script('slider', get_template_directory_uri() . '/assets/js/slider.js', array('jquery'), null, true);
        wp_enqueue_script('rating-filter', get_template_directory_uri() . '/assets/js/rating-filter.js', array('jquery'), null, true);
    }

    if (is_page_template('freegames.php')) {
        wp_enqueue_script('filter-menu', get_template_directory_uri() . '/assets/js/filter-menu.js', array('jquery'), null, true);
    }


        // Подключение общих скриптов
        wp_enqueue_script('search-container', get_template_directory_uri() . '/assets/js/search-container.js', array('jquery'), null, true);
        wp_enqueue_script('switch-best-posts', get_template_directory_uri() . '/assets/js/switch-best-posts.js', array('jquery'), null, true);
        wp_enqueue_script('expand-collapse', get_template_directory_uri() . '/assets/js/expand-collapse.js', array('jquery'), null, true);
        wp_enqueue_script('show-promo', get_template_directory_uri() . '/assets/js/show-promo.js', array('jquery'), null, true);
    
    
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');

function add_google_site_verification() {
    echo '<meta name="google-site-verification" content="S9t431NqmS3LJiE010RDy9WLbpkm6XJNe338iCi2kjk" />';
}
add_action('wp_head', 'add_google_site_verification');
?>
