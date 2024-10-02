<div class="index__left">


    <?php 
                // Актуальные новости
                $args_data = [
                    'cat_title' => 'Актуальные новости',
                    'link_title' => 'новости',
                    'cat_link' => '/news/',
                    'post_type' => 'news',
                    'posts_per_page' => 3,
                    'post_image' => 'фото',
                    'top' => 'топ'
                ];
                require( get_theme_file_path('/parts/left-cat/left-cat-img-title.php') ); 

                // Обзор слотов
                $args_data = [
                    'cat_title' => 'Обзор слотов',
                    'link_title' => 'слоты',
                    'cat_link' => '/obzory/obzor-slotov/',
                    'post_type' => 'slots',
                    'posts_per_page' => 6,
                    'post_image' => 'фото',
                    'top' => false
                ];
                require( get_theme_file_path('/parts/left-cat/left-cat-img.php') ); 

                // Лучшие наземные казино
                $args_data = [
                    'cat_title' => 'Лучшие наземные казино',
                    'link_title' => 'казино',
                    'cat_link' => '/nazemnye-kazino/',
                    'post_type' => 'nazemnye_kazino',
                    'posts_per_page' => 6,
                    'post_image' => 'фото_для_главной',
                    'top' => 'топ'
                ];
                require( get_theme_file_path('/parts/left-cat/left-cat-img.php') ); 

                // Полезные статьи
                $args_data = [
                    'cat_title' => 'Полезные статьи',
                    'link_title' => 'статьи',
                    'cat_link' => '/f-a-q/',
                    'post_type' => 'faq_articles',
                    'posts_per_page' => 3,
                    'post_image' => 'фото_для_главной',
                    'top' => 'топ'
                ];
                require( get_theme_file_path('/parts/left-cat/left-cat-img-title.php') ); 


                // Обзоры стримеров
                $args_data = [
                    'cat_title' => 'Обзоры стримеров',
                    'link_title' => 'стримеры',
                    'cat_link' => '/obzor-strimerov/',
                    'post_type' => 'obzor_strimerov',
                    'posts_per_page' => 6,
                    'post_image' => 'фото',
                    'top' => 'топ'
                ];
                require( get_theme_file_path('/parts/left-cat/left-cat-img.php') ); 


                ?>

</div>


<div class="modal fade" tabindex="-1" id="promobook_1068">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"><button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
            <div class="modal-body">
                <div class="container">
                    <div class="row modal_card" promocode="LUDOBZOR">
                        <div class="col-md-6">
                            <div class="promo__image promo__image__popupp"
                                data-i="/upload/cssinliner_webp/iblock/14f/2zyvtljghpvall79m7eqdzu7hx2b32i5.webp">
                                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                    alt="" class="promo__image">
                            </div>
                        </div>
                    </div>
                </div><i class="iu1"></i><i class="iu2"></i>
            </div>
        </div>
    </div>
</div>