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
                if (!empty($params)) {
                    require(get_theme_file_path('/inc/filter/filter-menu.php'));
                }
            ?>
            <div class="container list__freegames list__freegames__40">
                <div class="youplay-carousel-four-freegames owl-carousel owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            <?php
                            $args = array(
                                'post_type' => esc_attr($args_data['post_type']),
                                'posts_per_page' => intval($args_data['posts_per_page'])
                            );

                            if (empty($args_data['top'])) {
                                $args['orderby'] = 'rand';
                            } else {
                                $args['meta_query'] = array(
                                    array(
                                        'key' => esc_attr($args_data['top']),
                                        'value' => '1',
                                        'compare' => 'LIKE'
                                    )
                                );
                            }

                            $news_query = new WP_Query($args);
                            $post_count = 0;
                            $max_posts = 20;

                            if ($news_query->have_posts()) {
                                while ($post_count < $max_posts) {
                                    if (!$news_query->have_posts()) {
                                        $news_query->rewind_posts();
                                    }
                                    $news_query->the_post();

                                    $post_id = get_the_ID();
                                    $post_title = get_the_title();
                                    $post_link = get_permalink();
                                    $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                                    $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                            ?>
                                    <div class="owl-item" style="width: 208.333px; margin-right: 10px;">
                                        <div class="angled-img" id="bx_<?php echo esc_attr($post_id); ?>">
                                            <a href="<?php echo esc_url($post_link); ?>" class="img img-offset">
                                                <picture>
                                                    <?php if ($post_image_for_home) : ?>
                                                        <img src="<?php echo esc_url($post_image_for_home); ?>" alt="<?php echo esc_attr($post_title); ?>" />
                                                    <?php else : ?>
                                                        <img src="<?php echo esc_url($default_image); ?>" alt="<?php echo esc_attr($post_title); ?>" />
                                                    <?php endif; ?>
                                                </picture>
                                                <div class="badge bg-default"></div>
                                            </a>
                                            <div class="buttons">
                                                <a href="<?php echo esc_url($post_link); ?>" class="button"><span>Обзор</span></a>
                                                <?php
                                                    $bonus = get_field('banner', $post_id) ?: '';
                                                    $promo_photo = get_field('promo_photo', $post_id) ?: '';
                                                ?>
                                                <a id="get_promo" class="button copy_promocode_link"
                                                    data-image-src="<?php echo esc_url($promo_photo); ?>"
                                                    data-promo-code="<?php echo esc_html($promo_code); ?>">
                                                    <span>Промокод</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $post_count++;
                                }
                                wp_reset_postdata();
                            } else {
                                echo '<p>Нет записей казино в топ-20.</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="owl-nav">
                        <div class="owl-prev"></div>
                        <div class="owl-next"></div>
                    </div>
                    <div class="owl-dots disabled"></div>
                </div>
            </div>
            <?php if (!empty($button)) { ?>
                <div class="podrobneeBlock">
                    <a href="<?php echo $button['link']; ?>" class="button_i">
                        <span><?php echo $button['title']; ?></span>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>