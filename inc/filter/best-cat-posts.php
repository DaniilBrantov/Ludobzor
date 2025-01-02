

<div class="index__right 11">
    <?php if (count($args_data['post_type']) > 1):
         ?>
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
            <?php foreach ($args_data['post_type'] as $key => $label): ?>
                <a href="javascript:void(0);" class="tab-link" data-type="<?php echo esc_attr($label); ?>"><?php echo esc_html($label); ?></a>
            <?php endforeach; ?>
        </div>
    <?php endif; 
    $index = 0;
        foreach ($args_data['post_type'] as $key_post_type => $post_type): 
            
            
            
            if (count($args_data['post_type']) > 1){
                $post_type_name = $key_post_type;
            }else{
                $post_type_name = $post_type;
            };

            if($index === 1){
                $display_style = 'style="display: none;"';
            }else{
                $display_style = '';
            }
            $index++;
        ?>
        <div <?php echo $display_style; ?> class="sidebar-casino-all-info flex tab-content tab-content-<?php echo esc_attr($post_type_name); ?>">
            <?php
            if (!post_type_exists($post_type_name)) {
                echo '<p>Некорректный тип поста: ' . esc_html($post_type_name) . '.</p>';
                continue;
            }

            $meta_query = [];
            if (!empty($args_data['top'])) {
                $meta_query[] = [
                    'key' => esc_attr($args_data['top']),
                    'value' => 1,
                    'compare' => '='
                ];
            }

            $args = [
                'post_type' => $post_type_name,
                'posts_per_page' => intval($args_data['posts_per_page']),
                'orderby' => !empty($args_data['top']) ? 'meta_value' : 'rand',
                'meta_query' => $meta_query
            ];

            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post();
                    $post_id = get_the_ID();
                    $post_title = get_the_title();
                    $post_link = get_permalink();
                    $post_image = get_field($args_data['post_image']) ?: get_template_directory_uri() . "/assets/images/default-post-img.png";
                    $promo_code = get_field($args_data['promo']);
                    $promo_description = get_field($args_data['promo_desc']);

                    display_post($post_id, $post_link, $post_title, $post_image, $promo_code, $promo_description, $args_data);
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Нет доступных промокодов для ' . esc_html($post_type_name) . '.</p>';
            endif;
            
            ?>
        </div>
    <?php endforeach; ?>
</div>
</div>



