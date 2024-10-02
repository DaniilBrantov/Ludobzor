<div class="hh3 notitle">
    <h2>
        <?php echo esc_html($args_data['cat_title']); ?>
    </h2>
    <i></i>
    <span></span>
    <a href="<?php echo esc_attr($args_data['cat_link']); ?>">
        <span>
            Все <?php echo esc_html($args_data['link_title']); ?>
        </span>
    </a>
</div>
<div class="two_blocks_small_info_casinoss">
    <?php 
    // Установка параметров запроса в зависимости от наличия 'top'
    $args = array(
        'post_type' => esc_attr($args_data['post_type']), // Тип записи
        'posts_per_page' => intval($args_data['posts_per_page']), // Количество записей
    );

    // Если 'top' не указан или пустой, устанавливаем рандомный порядок вывода постов
    if (empty($args_data['top'])) {
        $args['orderby'] = 'rand'; // Сортировка в случайном порядке
    }

    // Если 'top' указан, добавляем условие для мета-запроса
    if (!empty($args_data['top'])) {
        $args['meta_query'] = array(
            array(
                'key' => esc_attr($args_data['top']),
                'value' => '1', // Значение, указывающее на отображение на главной
                'compare' => 'LIKE'
            )
        );
    }

    $slots_query = new WP_Query($args);

    if ($slots_query->have_posts()) :
        while ($slots_query->have_posts()) : $slots_query->the_post();
            // Получаем данные поста
            $post_id = get_the_ID();
            $post_title = get_the_title();
            $post_link = get_permalink();
            $post_image = get_field(esc_attr($args_data['post_image'])); // Поле с изображением через ACF
            $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";

            // Проверка на вывод поста на главной странице (если указано в $args_data)
            $post_top = true;
            if (!empty($args_data['top']) && $args_data['top']) {
                $post_top = get_field(esc_attr($args_data['top'])); // Получаем значение поля ACF 'на_главную'
            }

            if ($post_top) :
    ?>
    <a class="angled-img" id="bx_<?php echo esc_attr($post_id); ?>" href="<?php echo esc_url($post_link); ?>">
        <div class="img img-offset">
            <?php if (!empty($post_image)) : ?>
            <img src="<?php echo esc_url($post_image); ?>" alt="<?php echo esc_attr($post_title); ?>">
            <?php else : ?>
            <img src="<?php echo $default_image; ?>" alt="<?php echo esc_attr($post_title); ?>">
            <!-- Резервное изображение -->
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
        wp_reset_postdata(); // Сбрасываем данные после завершения WP_Query
    else :
        // Если записи не найдены
        echo '<p>Нет доступных записей.</p>';
    endif;
    ?>
</div>
