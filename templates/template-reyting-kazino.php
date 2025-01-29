<?php

$args_data = [
    'cat_title' => 'Рейтинг казино',
    'post_type' => 'online_casino',
    'posts_per_page' => 12,
    'post_image' => 'logo',
    'providers' => 'providers',
    'payment_systems' => 'платежные_системы',
    'rating' => 'oczenka_portala',
    'game_types' => 'виды_игр',
    'positive_rating_text' => 'текст_в_рейтинге_пункты_положительные',
];

$params = false;
?>

<main>
    <?php require_once get_theme_file_path('parts/part-main-casino.php'); ?>

    <div class="container list__payment">
        <div class="row reverse">
            <div class="content col-lg-8 raitingCasino">

                <?php 
                    require_once( get_theme_file_path('/parts/card/card-cat.php') );
                    require(get_theme_file_path('/parts/part-page-switch.php'));

                ?>
            </div>
            <?php

                require( get_theme_file_path('/inc/filter/cat-right-filter.php') );

                require( get_theme_file_path('/parts/cat-content/cat-disclamer.php') ); 

                require( get_theme_file_path('/parts/cat-content/cat-text.php') ); 
        ?>
        </div>
    </div>
</main>