<div class="hh3 articless">
    <h2>
        <?php echo esc_html($args_data['cat_title']); ?>
    </h2>
    <i></i>
    <span></span>
    <a href="<?php echo esc_attr($args_data['cat_link']); ?>">
        <span>Все <?php echo esc_html($args_data['link_title']); ?></span>
    </a>
</div>

<div class="two_blocks_small_info_casinoss">
    <?php
    // Проверяем наличие параметра 'top' и устанавливаем порядок сортировки
    $orderby = !empty($args_data['top']) ? 'meta_value' : 'rand';
    $meta_query = array();

    // Если 'top' указан, добавляем условие для сортировки по мета-полю
    if (!empty($args_data['top'])) {
        $meta_query = array(
            array(
                'key' => esc_attr($args_data['top']),
                'value' => '1', // Значение, указывающее на отображение на главной
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
            $post_image = get_field(esc_attr($args_data['post_image'])); // Получаем изображение через ACF (или другое поле)
            $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
            
            // Проверка на вывод поста на главной странице (если указано в $args_data)
            $post_top = true;
            if (!empty($args_data['top']) && $args_data['top']) {
                $post_top = get_field(esc_attr($args_data['top'])); // Получаем значение поля ACF 'на_главную'
            }

            // Если пост помечен для главной страницы или рандомный вывод (при отсутствии 'top')
            if ($post_top) :
    ?>
    <a class="angled-img" href="<?php echo esc_url($post_link); ?>">
        <div class="img img-offset">
            <?php if (!empty($post_image)): ?>
            <img src="<?php echo esc_url($post_image); ?>" alt="<?php echo esc_attr($post_title); ?>">
            <?php else: ?>
            <img src="<?php echo $default_image; ?>" alt="<?php echo esc_attr($post_title); ?>">
            <!-- Запасное изображение -->
            <?php endif; ?>
            <div class="badge bg-default"></div>
        </div>
        <div class="bottom-info">
            <h4><?php echo esc_html($post_title); ?></h4>
        </div>
    </a>
    <?php
            endif;
        endwhile;

        // Сбрасываем данные после WP_Query
        wp_reset_postdata();
    else :
        // Если записи не найдены
        echo '<p>Нет доступных записей.</p>';
    endif;
    ?>
</div>
