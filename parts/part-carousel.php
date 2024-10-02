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
                    require( get_theme_file_path('/parts/part-filter-menu.php') );
                };
            ?>
            <div class="container list__freegames list__freegames__40">
                <div class="youplay-carousel-four-freegames owl-carousel owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
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
                            <div class="owl-item" style="width: 208.333px; margin-right: 10px;">
                                <div class="angled-img" id="bx_<?php echo esc_attr($post_id); ?>">
                                    <a href="<?php echo esc_url($post_link); ?>" class="img img-offset">
                                        <picture>
                                            <?php if ($post_image_for_home) : ?>
                                            <img src="<?php echo esc_url($post_image_for_home); ?>"
                                                alt="<?php echo esc_attr($post_title); ?>" />
                                            <?php else : ?>
                                            <img src="<?php echo esc_url($default_image); ?>"
                                                alt="<?php echo esc_attr($post_title); ?>" />
                                            <!-- Резервное изображение -->
                                            <?php endif; ?>
                                        </picture>
                                        <div class="badge bg-default"></div>
                                    </a>
                                    <div class="buttons">
                                        <a href="<?php echo esc_url($post_link); ?>"
                                            class="button"><span>Обзор</span></a>
                                        <a class="button copy_promocode_link" href="#" data-r="LUDOBZOR"
                                            data-bs-toggle="modal"
                                            data-bs-target="#promocas_<?php echo esc_attr($post_id); ?>"><span>Промокод</span></a>
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
                    <div class="owl-nav">
                        <div class="owl-prev"></div>
                        <div class="owl-next"></div>
                    </div>
                    <div class="owl-dots disabled"></div>
                </div>
            </div>
            <?php if(!empty($button)){ ?>

            <div class="podrobneeBlock">
                <a href="<?php echo $button['link']; ?>" class="button_i">
                    <span><?php echo $button['title']; ?></span>
                </a>
            </div>
            <?php 
                };
            ?>
        </div>
    </div>
</div>