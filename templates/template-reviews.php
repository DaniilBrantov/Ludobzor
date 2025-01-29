<?php

// Подключение основных частей
require_once get_theme_file_path('parts/part-main-casino.php');

if (preg_match('~otzyvy-([^/]+)/?~', home_url(add_query_arg([], $wp->request)), $matches)) {
    $post_slug = $matches[1];
}

$review_post = null;

if ($post_slug) {
    $review_post = get_posts([
        'name'        => $post_slug,
        'post_type'   => 'any',             
        'post_status' => 'publish',        
        'numberposts' => 1                
    ]);

    if ($review_post) {
        $review_post = $review_post[0];
        setup_postdata($review_post);
    } else {
        wp_redirect(home_url());
        exit;
    }
} else {
    wp_redirect(home_url());
    exit;
}

// Проверяем, если переменная $review_post пуста, перенаправляем на главную
if (!$review_post) {
    wp_redirect(home_url());
    exit;
}

function render_sidebar_info($post_type, $all_sidebars)
{
    $sidebars = $all_sidebars[$post_type] ?? $all_sidebars['default'];
    require get_theme_file_path('parts/post/right-sidebar.php');
}

?>
<div class="page__casino container">
    <div class="row">
        <?php
        // Проверяем тип поста, прежде чем выводить информацию
        if ($review_post->post_type == 'online_casino') {
            require get_theme_file_path('parts/card/post-card.php');
            require_once get_theme_file_path('parts/post/casino-nav.php');
            require_once get_theme_file_path('parts/post/post-reviews.php');
        }
        ?>

        <div class="sidebar-info col-lg-4">
            <div class="sidebar-info--wrapper">
                <?php
                // Лучшие промокоды
                $args_data = [
                    'cat_title' => 'ТОП обзоры',
                    'post_type' => [
                        'online_casino' => 'Казино',
                        'bookmakers' => 'Букмекеры',
                    ],
                    'posts_per_page' => 20,
                    'post_image' => 'photo',
                    'promo' => 'promo',
                    'promo_desc' => 'описание_промокода',
                ];
                require get_theme_file_path('/inc/filter/best-cat-posts.php');
                ?>
            </div>
        </div>

        <?php
        // Вывод хлебных крошек
        if (in_array($review_post->post_type, ['online_casino', 'bookmakers', 'obzor_strimerov', 'free_games', 'news', 'faq_articles'])) {
            if (function_exists('custom_breadcrumbs_schema')) {
                custom_breadcrumbs_schema();
            }
        }
        ?>
    </div>
</div>
