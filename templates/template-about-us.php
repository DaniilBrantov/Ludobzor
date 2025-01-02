<main>
    <?php require_once get_theme_file_path('parts/part-main-casino.php'); ?>

    <div class="container list__payment">
        <div class="row reverse">
            <div class="content col-lg-8 partners__inner">
                <h1 class="innerH1pp"><?php the_title(); ?></h1>
                <?php
                    the_content();
                ?>
            </div>

            <?php
                
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
                require( get_theme_file_path('/inc/filter/best-cat-posts.php') ); 
        ?>
        </div>
    </div>
</main>