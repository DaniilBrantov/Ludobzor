<?php
// Check if 'post_type_args' exists and is an array
if (isset($params['post_type_args']) && is_array($params['post_type_args'])) {
    $post_types_query = [];
    foreach ($params['post_type_args'] as $post_type) {
        $post_types_query[$post_type['data-r']] = new WP_Query([
            'post_type'      => $post_type['post_type'],
            'posts_per_page' => $post_type['posts_per_page'],
        ]);
    }
} else {
    $post_types_query = [];
}

// Check if 'taxonomies' exists and is an array
if (isset($params['taxonomies']) && is_array($params['taxonomies'])) {
    $terms_data = [];
    foreach ($params['taxonomies'] as $taxonomy) {
        $terms_data[$taxonomy['id']] = get_terms([
            'taxonomy'   => $taxonomy['taxonomy'],
            'hide_empty' => $taxonomy['hide_empty'],
        ]);
    }
} else {
    $terms_data = [];
}

$menu_items = [];
if (!empty($params['filter_menu'])) {
    $menu_name = $params['filter_menu'];
    $menu_items = wp_get_nav_menu_items($menu_name);
}
?>

<div class="container filterOnlineCasinoss">
    <div class="row">
        <div class="col-md-12">
            <form method="get" action="" id="filtr_obzoriCasino">
                <ul id="more-navvv">
                <?php
                $ancestors = get_post_ancestors(get_the_ID());
                
                if (!empty($ancestors)) {
                    $parent_id = end($ancestors);
                    $parent_link = get_permalink($parent_id);
                    $parent_title = 'Все';
                    ?>
                    <li>
                        <a href="<?php echo esc_url($parent_link); ?>" class="provider-slidetoggle-listt">
                            <?php echo esc_html($parent_title); ?>
                        </a>
                    </li>
                <?php } 
                
                ?>
                    <?php if (!empty($menu_items)) : 
                        ?>
                    <?php foreach ($menu_items as $index => $menu_item) : ?>
                        <?php //if (isset($params['page_args'][$index])) : 
                            ?>
                            <li><a href="<?php echo esc_url($menu_item->url); ?>" class="provider-slidetoggle-listt">
                                <?php 
                                $title = !empty($menu_item->post_title) ? esc_html($menu_item->post_title) : esc_html($menu_item->post_excerpt);
                                echo $title; 
                                ?>
                            </a></li>
                        <?php //endif; ?>
                    <?php endforeach; ?>
                    <?php else : 
                        ?>
                        <?php foreach ($params['page_args'] as $page) : 
                            ?>
                            <li><a href="<?php echo ($page['link']); ?>" class="provider-slidetoggle-listt"><?php echo esc_html($page['menu_title']); ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php foreach ($post_types_query as $post_type_key => $post_type_query) : ?>
                        <?php if ($post_type_query->have_posts()) : ?>
                            <li><a data-r="<?php echo esc_attr($post_type_key); ?>" class="<?php echo esc_attr($params['post_type_args'][0]['class']); ?>"><?php echo esc_html($params['post_type_args'][0]['title']); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php foreach ($terms_data as $taxonomy) : ?>
                        <li><a data-r="<?php echo esc_attr($taxonomy['id']); ?>" class="provider-slidetoggle-listt"><?php echo esc_html($taxonomy['menu_title']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </form>
        </div>
    </div>
</div>
