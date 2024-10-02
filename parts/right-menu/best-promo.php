<div class="index__right 11">
    <div class="hh3">
        <h2>
            <a href="<?php echo esc_html($args_data['cat_link']); ?>">
                <?php echo esc_html($args_data['cat_title']); ?>
            </a>
        </h2>
        <i></i>
        <span></span>
    </div>

    <div class="promocodes_index_blocks_all">
        <div class="promocodes_index_blocks">
            <?php 
        // Проверяем наличие top в аргументах
        $orderby = !empty($args_data['top']) ? 'meta_value' : 'rand';
        $meta_query = array();

        // Если 'top' указан, добавляем в запрос мета-условие для сортировки
        if (!empty($args_data['top'])) {
            $meta_query = array(
                array(
                    'key' => esc_attr($args_data['top']),
                    'value' => '1', // Значение для вывода на главной
                    'compare' => 'LIKE'
                )
            );
        }

        // WP Query для получения постов с указанным типом и количеством
        $args = array(
            'post_type' => esc_attr($args_data['post_type']), // Тип записи
            'posts_per_page' => intval($args_data['posts_per_page']), // Количество записей
            'orderby' => $orderby, // Порядок сортировки
            'meta_query' => $meta_query // Условие для мета-полей
        );

        $news_query = new WP_Query($args);
        if ($news_query->have_posts()) :
            while ($news_query->have_posts()) : $news_query->the_post();

                // Получаем данные поста
                $post_id = get_the_ID();
                $post_title = get_the_title();
                $post_link = get_permalink();
                $post_image = get_field(esc_attr($args_data['post_image'])); // Поле ACF с изображением
                $promo_code = get_field(esc_attr($args_data['promo'])); // Поле с промокодом
                $promo_description = get_field(esc_attr($args_data['promo_desc'])); // Поле с описанием
                $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";

                ?>
            <div class="angled-img angled-img-promocode-tbi" id="bx_<?php echo esc_attr($post_id); ?>">
                <div class="img img-offset">
                    <a href="<?php echo esc_url($post_link); ?>">
                        <?php if (!empty($post_image)): ?>
                        <img src="<?php echo esc_url($post_image); ?>" alt="<?php echo esc_attr($post_title); ?>">
                        <?php else: ?>
                        <img src="<?php echo $default_image; ?>" alt="<?php echo esc_attr($post_title); ?>">
                        <!-- Запасное изображение -->
                        <?php endif; ?>
                    </a>
                    <div class="badge bg-default"></div>
                </div>
                <div class="bottom-info bottom-info-promocode">
                    <h4>
                        <span>
                            <i><?php echo esc_html($promo_description); ?></i> <!-- Описание промокода -->
                            <span>
                                <a class="copy_promocode_link copy_promocode" href=""
                                    data-r="<?php echo esc_attr($promo_code); ?>" data-bs-toggle="modal"
                                    data-bs-target="#promo_<?php echo esc_attr($post_id); ?>">
                                    Промокод
                                </a>
                            </span>
                        </span>
                    </h4>
                </div>
            </div>
            <?php
            endwhile;
            wp_reset_postdata(); // Сбрасываем данные после WP_Query
        else :
            echo '<p>Нет доступных промокодов.</p>';
        endif;
        ?>
        </div>
    </div>
</div>