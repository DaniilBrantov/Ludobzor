<?php
require_once get_theme_file_path('parts/part-main-casino.php');



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




?>



<div class="container list__payment">
    <div class="row">
        <div class="content col-lg-8">
            <div class="primary-float">
                <main itemscope="" itemtype="https://schema.org/Organization" class="content">
                    <meta itemprop="name" content="ludobzor - Обзоры/рейтинги казино и слотов">
                    <link itemprop="logo image" href="https://ludobzor.com/images/Logo-ludobzor.webp">
                    <link itemprop="url" href="https://ludobzor.com/contacts/">
                    
                    <?php require_once get_theme_file_path('templates/contacts/contact-info.php'); ?>
                    <?php require_once get_theme_file_path('templates/contacts/feedback.php'); ?>
                    <?php require_once get_theme_file_path('templates/contacts/users-info.php'); ?>
                    
                </main>
            </div>
        </div>
        <?php
require( get_theme_file_path('/inc/filter/best-cat-posts.php') ); 
        ?>
    </div>
</div>