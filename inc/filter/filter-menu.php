<?php

// Проверка и создание запроса для типов постов
$post_types_query = [];
if (isset($params['post_type_args']) && is_array($params['post_type_args'])) {
    foreach ($params['post_type_args'] as $post_type) {
        $post_types_query[$post_type['data-r']] = new WP_Query([
            'post_type'      => $post_type['post_type'],
            'posts_per_page' => $post_type['posts_per_page'],
        ]);
    }
}

// Проверка и получение терминов для таксономий
$terms_data = [];
if (isset($params['taxonomies']) && is_array($params['taxonomies'])) {
    foreach ($params['taxonomies'] as $taxonomy) {
        $terms_data[$taxonomy['id']] = get_terms([
            'taxonomy'   => $taxonomy['taxonomy'],
            'hide_empty' => $taxonomy['hide_empty'],
        ]);
    }
}

// Проверка и получение элементов меню
$menu_items = [];
if (!empty($params['filter_menu'])) {
    $menu_name = $params['filter_menu'];
    $menu_items = wp_get_nav_menu_items($menu_name);
}

/**
 * Функция для отображения меню.
 */
function display_filter_menu($params, $menu_items, $post_types_query) {
    // Начало HTML блока
    echo '<div class="hh2"><div><ul class="freegamesindex more-navvv' . 
    (isset($params['filter_menu']) && $params['filter_menu'] == 'casino-filter-menu' ? ' nav-filter' : '') . '">';


    // Вывод стандартных пунктов меню из $menu_items
    if (!empty($menu_items)) :
        foreach ($menu_items as $index => $menu_item) :
            if (isset($params['page_args'][$index])) :
                echo '<li><a href="' . esc_url($menu_item->url) . '" class="provider-slidetoggle-listt">'
                    . esc_html($params['page_args'][$index]['menu_title']) . '</a></li>';
            endif;
        endforeach;
    else :
        // Если $menu_items пусто, выводим пункты меню из $params['page_args']
        if (isset($params['page_args'])) :
            foreach ($params['page_args'] as $page) :
                echo '<li><a href="' . esc_url(sendToPage($page['link'])) . '" class="provider-slidetoggle-listt">'
                    . esc_html($page['menu_title']) . '</a></li>';
            endforeach;
        endif;
    endif;

    // Вывод постов из $post_types_query
    if (isset($params['post_type_args']) && is_array($params['post_type_args'])) :
        foreach ($post_types_query as $post_type_key => $post_type_query) :
            if ($post_type_query->have_posts()) :
                echo '<li><a data-r="' . esc_attr($post_type_key) . '" class="' . esc_attr($params['post_type_args'][0]['class']) . '">'
                    . esc_html($params['post_type_args'][0]['title']) . '</a></li>';
            endif;
        endforeach;
    endif;

    // Вывод таксономий из $params['taxonomies']
    if (isset($params['taxonomies']) && is_array($params['taxonomies'])) :
        foreach ($params['taxonomies'] as $taxonomy) :
            echo '<li><a data-r="' . esc_attr($taxonomy['id']) . '" class="provider-slidetoggle-listt">'
                . esc_html($taxonomy['menu_title']) . '</a></li>';
        endforeach;
    endif;

    // Закрытие списка и контейнера
    echo '</ul></div></div>';
}

?>
<?php display_filter_menu($params, $menu_items, $post_types_query); ?>


<div class="freegamesindexblock">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($post_types_query as $post_type_key => $post_type_query) : ?>
                    <?php if ($post_type_query->have_posts()) : ?>
                    <div class="provider-slidetoggle-target" id="lud_<?php echo esc_attr($post_type_key); ?>">
                        <ul class="menu__smallimage">
                            <?php while ($post_type_query->have_posts()) : $post_type_query->the_post(); ?>
                                <li class="menu-item small-image">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="has-image has-image-provider-img" data-i="<?php echo esc_url(get_field('logo')); ?>">
                                        <img src="<?php echo esc_url(get_field('logo')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php foreach ($terms_data as $section_id => $terms) : ?>
                <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                <div class="provider-slidetoggle-target" id="lud_<?php echo esc_attr($section_id); ?>">
                    <ul class="menu__default">
                        <?php foreach ($terms as $term) : ?>
                        <li><a href="<?php echo ('/freegames-'. $term->taxonomy . '-' . $term->slug); ?>">#<?php echo esc_html($term->name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

