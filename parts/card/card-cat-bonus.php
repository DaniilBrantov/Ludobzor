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
                    require( get_theme_file_path('/inc/filter/filter-menu.php') );
                };
            ?>

            <div class="row rowwww">
                <?php
                    $args = array(
                        'post_type' => esc_attr($args_data['post_type']), 
                        'posts_per_page' => intval($args_data['posts_per_page']),
                    );
                    


                    $current_page = isset($_GET['PAGE']) ? absint($_GET['PAGE']) : 1;
                    $posts_per_page = !empty($args_data['posts_per_page']) ? intval($args_data['posts_per_page']) : 10;
                    $offset = ($current_page - 1) * $posts_per_page;
                    $args = [
                        'posts_per_page' => $posts_per_page,
                        'offset'         => $offset,
                    ];
                    if (empty($args_data['top'])) {
                        $args['orderby'] = 'rand';
                    } else {
                        $args['meta_query'] = [
                            [
                                'key'     => esc_attr($args_data['top']),
                                'value'   => '1',
                                'compare' => 'LIKE',
                            ]
                        ];
                    }
                    
                    // Выполняем запрос
                    $query = new WP_Query($args);
                    
                    // Проверяем, есть ли посты
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            // Логика для отображения постов
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Сообщение, если нет постов
                        echo '<p>Нет постов для отображения.</p>';
                    endif;
                    
                    // Пагинация
                    $pagination = paginate_links([
                        'total'   => $query->max_num_pages,
                        'current' => $current_page,
                        'format'  => '?PAGE=%#%',
                        'prev_text' => '«',
                        'next_text' => '»',
                    ]);
                    
                    if ($pagination) :
                        echo '<div class="pagination">' . $pagination . '</div>';
                    endif;
                    
                    

                    $news_query = new WP_Query($args);

                    if ($news_query->have_posts()) :
                        while ($news_query->have_posts()) : $news_query->the_post();
                            $post_id = get_the_ID();
                            $post_title = get_the_title();
                            $post_link = get_permalink();
                            $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                            $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                            $providers = get_field('providers');

                            $current_url = $_SERVER['REQUEST_URI'];
                            $url_parts = explode('-', $current_url);
                            if (count($url_parts) > 2) {
                                $url_segment = isset($url_parts[1]) ? $url_parts[1] : ''; 
                                $url_value = isset($url_parts[2]) ? trim($url_parts[2], '/') : ''; 
                            } else {                                             ?>
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
                                                            if (is_array($providers)) {
                                                                $provider_titles = array_map(function($provider) {
                                                                    return is_object($provider) && isset($provider->post_title) ? $provider->post_title : $provider;
                                                                }, $providers);
                                                            
                                                                echo esc_html(implode(', ', $provider_titles));
                                                            } else {
                                                                echo esc_html($providers);
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                                <div class="wi50">
                                                    <span class="col">RTP</span>
                                                    <span class="col"><?php echo esc_html(get_field('rtp')); ?>%</span>
                                                </div>
                                                <div class="wi50">
                                                    <span class="col">Волатильность</span>
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
                                                        <img src="<?php echo esc_html(get_field('баннер_для_моб_устройств')); ?>"
                                                            class="mobileOnlyy-1200" alt="">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-xl centerable">
                                                <a href="<?php the_permalink(); ?>" target="_blank"
                                                    class="freegames-full__hr freegames-full__btn">
                                                    <span class="btn_flare"><i></i></span><span>Играть</span>
                                                </a>
                                                <a href="<?php the_permalink(); ?>" class="freegames-full__hr freegames-full__link" data-er="">
                                                    <span>Читать обзор</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        
                        

                            $type_fields = get_field($url_segment, $post_id);

                            if ($type_fields) {
                                if (is_array($type_fields) || is_object($type_fields)) {
                                    foreach ($type_fields as $type_field) {
                                        if ($type_field && strpos($type_field->slug, $url_value) !== false) {
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
                                                                            $providers = get_field('providers');
                                                                            if (is_array($providers)) {
                                                                                $provider_titles = array_map(function($provider) {
                                                                                    return is_object($provider) && isset($provider->post_title) ? $provider->post_title : $provider;
                                                                                }, $providers);
                                                                            
                                                                                echo esc_html(implode(', ', $provider_titles));
                                                                            } else {
                                                                                echo esc_html($providers);
                                                                            }
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                                <div class="wi50">
                                                                    <span class="col">RTP</span>
                                                                    <span class="col"><?php echo esc_html(get_field('rtp')); ?>%</span>
                                                                </div>
                                                                <div class="wi50">
                                                                    <span class="col">Волатильность</span>
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
                                                                        <img src="<?php echo esc_html(get_field('баннер_для_моб_устройств')); ?>"
                                                                            class="mobileOnlyy-1200" alt="">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl centerable">
                                                                <a href="<?php the_permalink(); ?>" target="_blank"
                                                                    class="freegames-full__hr freegames-full__btn">
                                                                    <span class="btn_flare"><i></i></span><span>Играть</span>
                                                                </a>
                                                                <a href="<?php the_permalink(); ?>" class="freegames-full__hr freegames-full__link" data-er="">
                                                                    <span>Читать обзор</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }
                                }
                            }
                            
                        endwhile;
                        wp_reset_postdata();
                    else :
                ?>
                <p>Нет записей казино в топ-20.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>