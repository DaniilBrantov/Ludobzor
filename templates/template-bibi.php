<?php

require_once get_theme_file_path('parts/part-main-casino.php');

$args_data = [
    'promo' => 'promo',
    'bonus' => 'bonus',
    'post_image' => 'logo',
    'providers' => 'provajders'
];
require get_theme_file_path('parts/card/post-card-bibi.php');
?>




<div class="page__casino container">
    <div class="row">
        <main class="content col-lg-8 online-casino active_tab" id="obzor">
            <?php
                    $cat_text = ['text_version' => 2];
                    require get_theme_file_path('/parts/cat-content/cat-text.php');
                
                $args_data = [
                    'cat_title' => 'Лучшие бонусы',
                    'post_type' => 'online_casino',
                    'posts_per_page' => 12,
                    'post_image' => 'logo',
                ];
                $params = false;
            ?>
            <div class="content col-lg-8 raitingCasino">
                <?php
                    require_once get_theme_file_path('parts/card/card-cat.php');
                ?>
            </div>
            <?php
                require_once get_theme_file_path('parts/post/last-reviews.php');
            ?>
        </main>
        <?php
            $args_data = [
                'post_image' => 'logo',
                'bonus' => 'bonus',
                'promo' => 'promo',
                'post_type' => 'tournaments-bibi'
            ];

            require get_theme_file_path('/parts/post/right-sidebar-bibi.php');
        ?>
    </div>
    <?php
        $cat_posts = [
            ['Популярные игры', 'free_games', 4, 'photo', 'free_games'],
            ['Похожие казино', 'online_casino', 6, 'logo', 'similar-posts']
        ];

        foreach ($cat_posts as $cat_post) {
            render_category_posts([
                'cat_title' => $cat_post[0],
                'post_type' => $cat_post[1],
                'posts_per_page' => $cat_post[2],
                'post_image' => $cat_post[3],
                'cat_template' => $cat_post[4],
            ]);
        }
    ?>

</div>