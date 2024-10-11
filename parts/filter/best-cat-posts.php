<div class="index__right 11">
    <?php if (count($args_data['post_type']) > 1): ?>
        <div class="widget-title">
            <span><?php echo esc_html($args_data['cat_title']); ?></span>
        </div>
    <?php else: ?>
        <div class="hh3">
            <h2>
                <a href="<?php echo esc_url($args_data['cat_link']); ?>">
                    <?php echo esc_html($args_data['cat_title']); ?>
                </a>
            </h2>
            <i></i>
            <span></span>
        </div>
    <?php endif; ?>

    <div class="casino-all-info-inner casino-all-info-inner-right casino-all-info">
        <?php if (count($args_data['post_type']) > 1): ?>
            <div class="tab-nav">
                <!-- Вкладки для переключения постов -->
                <a href="javascript:void(0);" class="tab-link is-active" data-type="online_casino">Казино</a>
                <a href="javascript:void(0);" class="tab-link" data-type="bookmakers">Букмекеры</a>
            </div>
        <?php endif; ?>

        <div class="sidebar-casino-all-info flex tab-content tab-content0 tab-content-active">
            <?php
            // Формирование мета-запроса
            $meta_query = [];
            if (!empty($args_data['top'])) {
                $meta_query[] = [
                    'key' => esc_attr($args_data['top']),
                    'value' => 1,
                    'compare' => 'LIKE'
                ];
            }

            // Аргументы для WP Query
            $args = [
                'post_type' => esc_attr($args_data['post_type'][0]),
                'posts_per_page' => intval($args_data['posts_per_page']),
                'orderby' => !empty($args_data['top']) ? 'meta_value' : 'rand',
                'meta_query' => $meta_query
            ];

            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post();

                    // Получение данных поста
                    $post_id = get_the_ID();
                    $post_title = get_the_title();
                    $post_link = get_permalink();
                    $post_image = get_field(esc_attr($args_data['post_image'])) ?: get_template_directory_uri() . "/assets/images/default-post-img.png";
                    $promo_code = get_field(esc_attr($args_data['promo']));
                    $promo_description = get_field(esc_attr($args_data['promo_desc']));

                    // Вывод HTML
                    display_post($post_id, $post_link, $post_title, $post_image, $promo_code, $promo_description, $args_data);
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Нет доступных промокодов.</p>';
            endif;

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
                                        <a href="/vodka-casino/">
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
            ?>
        </div>
    </div>
</div>
