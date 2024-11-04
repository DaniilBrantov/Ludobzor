<?php
function mytheme_enqueue_assets() {
    // Подключение стилей
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('header-style', get_template_directory_uri() . '/assets/css/header.css', array('main-style'));
    wp_enqueue_style('new-style', get_template_directory_uri() . '/assets/css/new.css', array('header-style'));
    wp_enqueue_style('owl-carousel-style', get_template_directory_uri() . '/node_modules/owl.carousel/dist/assets/owl.carousel.min.css'); // Стили Owl Carousel

    // Подключение скриптов
    wp_enqueue_script('jquery', get_template_directory_uri() . '/node_modules/jquery/dist/jquery.js', array(), null, true); // Подключение jQuery, если требуется
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/node_modules/owl.carousel/dist/owl.carousel.min.js', array('jquery'), null, true); // Скрипт Owl Carousel
    wp_enqueue_script('switch-best-posts', get_template_directory_uri() . '/assets/js/switch-best-posts.js', array('jquery'), null, true);
    wp_enqueue_script('filter-menu', get_template_directory_uri() . '/assets/js/filter-menu.js', array('jquery'), null, true);
    wp_enqueue_script('carousel', get_template_directory_uri() . '/assets/js/carousel.js', array('jquery'), null, true);
    wp_enqueue_script('expand-collapse', get_template_directory_uri() . '/assets/js/expand-collapse.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');



function sendToPage($link){
    return esc_attr($link);
}

// Путь к изображениям
function imgName($img_name) {
    $img_url = "/ludobzor/wordpress/wp-content/themes/ludobzor/assets/images/" . $img_name;
    return $img_url;
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


function render_category_posts($args_data) {
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
                    <?php endif; ?>
                    
                    <div class="oc__bonus__timer" id="oc__bonus__timer">
                        <a class="btn_promo-green copy_promocode_link" 
                           data-r="<?php echo esc_attr($promo_code); ?>" 
                           data-bs-toggle="modal" 
                           data-bs-target="#promo_<?php echo esc_attr($post_id); ?>">
                            Промокод
                        </a>
                    </div>
                </span>
            </h4>
        </div>
    </div>
    <?php
}
