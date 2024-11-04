<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="hh1">
                <h2>
                    <a href="<?php echo esc_attr($args_data['cat_link']); ?>">
                        <?php echo esc_html($args_data['cat_title']); ?>
                    </a>
                </h2>
            </div>
            <?php
                if(!empty($params)){
                    require( get_theme_file_path('/parts/filter/filter-menu.php') );
                };
            ?>

            <div class="row rowwww">
                <?php
                // Формирование параметров WP Query в зависимости от наличия top
                $args = array(
                    'post_type' => esc_attr($args_data['post_type']), // Тип записи
                    'posts_per_page' => intval($args_data['posts_per_page']), // Количество записей
                );

                // Если параметр 'top' не указан или пуст, сортируем случайным образом
                if (empty($args_data['top'])) {
                    $args['orderby'] = 'rand'; // Случайный порядок вывода
                } else {
                    // Если 'top' указан, добавляем условие мета-запроса для фильтрации
                    $args['meta_query'] = array(
                        array(
                            'key' => esc_attr($args_data['top']),
                            'value' => '1', // Значение, указывающее на наличие в топ-20
                            'compare' => 'LIKE'
                        )
                    );
                }

                $news_query = new WP_Query($args);

                if ($news_query->have_posts()) :
                    while ($news_query->have_posts()) : $news_query->the_post();
                        // Получаем данные поста
                        $post_id = get_the_ID();
                        $post_title = get_the_title();
                        $post_link = get_permalink();
                        $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                        $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";

                        // Условие для вывода поста (если параметр top пуст или пост входит в топ-20)
                        if (empty($args_data['top']) || get_field($args_data['top'])) {
                ?>
                <div class="col-md-6 col-lg-4 freegames-full_wrapper col-xl-12 ItemGG0" data-k="0" data-i="2629"
                    id="bx_1373509569_2629">
                    <div class="freegames-full">
                        <div class="row vertical-gutter">
                            <div class="col-xl">
                                <a href="<?php echo esc_url($post_link); ?>" class="angled-img">
                                    <div class="img">
                                        <img src="<?php echo esc_url($post_image_for_home ? $post_image_for_home : $default_image); ?>"
                                            alt="<?php echo esc_attr($post_title); ?>">
                                    </div>
                                    <div class="over-info bottom h4"></div>
                                </a>
                            </div>
                            <div class="col-xl-4">
                                <div class="wi50">
                                    <span class="name"><?php echo esc_html($post_title); ?></span>
                                </div>
                                <div class="wi50">
                                    <span class="col">Провайдер</span>
                                    <span class="col">
                                        <?php
                                            $providers = get_field('провайдер');
                                            echo esc_html(get_field('провайдер'));
                                            
                                        ?>

                                    </span>
                                </div>
                                <div class="wi50">
                                    <span class="col">RTP</span>
                                    <span class="col"><?php echo esc_html(get_field('rtp')); ?>%</span>
                                </div>
                                <div class="wi50">
                                    <span class="col">Волатильность
                                    </span>
                                    <span class="col">
                                        <?php
                                            $volatility = get_field('волатильность');
                                            $i = 0;
                                            if ($volatility === 'Низкая') {
                                                $i = 1;
                                            } elseif ($volatility === 'Средняя') {
                                                $i = 3;
                                            } elseif ($volatility === 'Высокая') {
                                                $i = 5;
                                            }
                                            $img_url = imgName('star.png');
                                            for ($j = 0; $j < $i; $j++) {
                                                echo '<i style="background: url(\'' . $img_url . '\') no-repeat;"></i>';
                                            }
                                        ?>
                                    </span>
                                </div>
                                <div class="wi50">
                                    <span class="col">Дата Выхода</span>
                                    <span class="col"><?php echo esc_html(get_field('дата_выхода')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-auto">
                                <div class="divider">
                                    <span data-r="LUDOBZOR" class="copy_promocode_link" data-bs-toggle="modal"
                                        data-bs-target="#promo2629">
                                        <img src="<?php echo esc_html(get_field('баннер_для_пк')); ?>"
                                            class="nomobile" alt="">
                                    </span>
                                    <span data-r="LUDOBZOR" class="copy_promocode_link" data-bs-toggle="modal"
                                        data-bs-target="#promo2629">
                                        <img src="<?php echo esc_html(get_field('баннер_для_моб_устройств')); ?>"
                                            class="mobileOnlyy-1200" alt="">
                                    </span>
                                </div>
                            </div>
                            <div class="col-xl centerable">
                                <a href="https://ludobzor.com/freegames/starda-queen/" target="_blank"
                                    class="freegames-full__hr freegames-full__btn">
                                    <span class="btn_flare"><i></i></span><span>Играть</span>
                                </a>
                                <a href="starda-queen/" class="freegames-full__hr freegames-full__link" data-er="">
                                    <span>Читать обзор</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" tabindex="-1" id="promo2629">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content"><button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true">×</span></button>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Промокод <span>LUDOBZOR</span> для получения бонуса за регистрацию
                                                скопирован</h3>
                                            <p>Для активации бонуса необходимо ввести промокод в специальное поле на
                                                официальном сайте казино</p><a href="javascript:;"
                                                class="force-close"><span>Понятно</span></a>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="promo__image promo__image__popupp"
                                                data-i="/upload/cssinliner_webp/iblock/80d/80d3d61a95e0676a8f228bb0fd3b2a05.webp">
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
                <?php
                        } // Конец условия для вывода постов
                    endwhile;
                    wp_reset_postdata(); // Сброс данных после завершения цикла WP_Query
                else :
                ?>
                <p>Нет записей казино в топ-20.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>