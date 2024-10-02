<?php

// Получение провайдеров
$post_types_query = [];
foreach ($params['post_type_args'] as $post_type) {
    $post_types_query[$post_type['data-r']] = new WP_Query([
        'post_type'      => $post_type['post_type'],
        'posts_per_page' => $post_type['posts_per_page'],
    ]);
}

// Перебор массива и получение термов для каждой таксономии
$terms_data = [];
foreach ($params['taxonomies'] as $taxonomy) {
    $terms_data[$taxonomy['id']] = get_terms([
        'taxonomy'   => $taxonomy['taxonomy'],
        'hide_empty' => $taxonomy['hide_empty'],
    ]);
}


// Проверка на наличие 'filter_menu' и получение меню WordPress
$menu_items = [];
if (!empty($params['filter_menu'])) {
    $menu_name = $params['filter_menu'];
    $menu_items = wp_get_nav_menu_items($menu_name);
}

?>

<!-- Разметка HTML с использованием переменных -->

<div class="hh2">
    <div>
        <ul class="freegamesindex">
            <?php if (!empty($menu_items)) : ?>
                <!-- Если указано меню, выводим элементы меню из WordPress с названиями из page_args -->
                <?php foreach ($menu_items as $index => $menu_item) : ?>
                    <?php if (isset($params['page_args'][$index])) : ?>
                        <li><a href="<?php echo esc_url($menu_item->url); ?>" class="provider-slidetoggle-listt">
                            <?php echo esc_html($params['page_args'][$index]['menu_title']); ?>
                        </a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Если нет указанного меню, выводим стандартные страницы -->
                <?php foreach ($params['page_args'] as $page) : ?>
                    <li><a href="<?php echo sendToPage($page['link']); ?>" class="provider-slidetoggle-listt"><?php echo esc_html($page['menu_title']); ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Перебор типов постов -->
            <?php foreach ($post_types_query as $post_type_key => $post_type_query) : ?>
                <?php if ($post_type_query->have_posts()) : ?>
                    <li><a data-r="<?php echo esc_attr($post_type_key); ?>" class="<?php echo esc_attr($params['post_type_args'][0]['class']); ?>"><?php echo esc_html($params['post_type_args'][0]['title']); ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>

            <!-- Перебор таксономий -->
            <?php foreach ($params['taxonomies'] as $taxonomy) : ?>
                <li><a data-r="<?php echo esc_attr($taxonomy['id']); ?>" class="provider-slidetoggle-listt"><?php echo esc_html($taxonomy['menu_title']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="freegamesindexblock">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Проверка наличия провайдеров перед выводом блока -->
                <?php foreach ($post_types_query as $post_type_key => $post_type_query) : ?>
                    <?php if ($post_type_query->have_posts()) : ?>
                    <div id="lud_<?php echo esc_attr($post_type_key); ?>">
                        <ul class="menu__smallimage">
                            <?php while ($post_type_query->have_posts()) : $post_type_query->the_post(); ?>
                                <li class="menu-item small-image">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="has-image has-image-provider-img" data-i="<?php echo esc_url(get_field('логотип')); ?>">
                                        <img src="<?php echo esc_url(get_field('логотип')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <!-- Цикл вывода таксономий -->
                <?php foreach ($terms_data as $section_id => $terms) : ?>
                <?php if (!empty($terms) && !is_wp_error($terms)) : // Проверка наличия термов ?>
                <div id="lud_<?php echo esc_attr($section_id); ?>">
                    <ul class="menu__default">
                        <?php foreach ($terms as $term) : ?>
                        <li><a href="<?php echo esc_url(get_term_link($term)); ?>">#<?php echo esc_html($term->name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
