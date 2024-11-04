<?php

// Получаем данные для текущей страницы
$page_data = get_page_meta_query($params);

// Подготовка аргументов для WP_Query
$args = array(
    'post_type'      => esc_attr($args_data['post_type']),
    'posts_per_page' => intval($args_data['posts_per_page']),
);

// Добавляем meta_query, если он не пустой
if (!empty($page_data['meta_query'])) {
    $args['meta_query'] = $page_data['meta_query'];
}elseif(!empty($args_data['meta_query'])) {
    $args['meta_query'] = $args_data['meta_query'];
}
// Выполняем запрос WP_Query
$query = new WP_Query($args);


?>


<h1 class="inner-title innerH1pp">
    <?php echo esc_html($args_data['cat_title']); ?>
</h1>

<?php 
        if (!empty($args_data['top_filter'])) {
            require( get_theme_file_path('/parts/filter/cat-card-filter.php') );
        }

        if ($query->have_posts()) : 
    ?>

<div class="row rowwww">
    <?php while ($query->have_posts()) : $query->the_post(); ?>
    <?php 
                // Dynamic variables for each item
                $title = get_the_title();
                $link = get_permalink();
                $image_url = get_field(esc_attr($args_data['post_image']));
                $alt_text = esc_attr($title); 
            ?>
    <div class="col-md-4 onlinecasino_item" id="casino_item_<?php the_ID(); ?>">
        <div class="row vertical-gutter">
            <div class="col-md-12">
                <a href="<?php echo esc_url($link); ?>" class="angled-img">
                    <div class="img">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo $alt_text; ?>" />
                    </div>
                </a>
            </div>
            <div class="col-md-12">
                <a href="<?php echo esc_url($link); ?>" class="" data-er="">
                    Подробнее
                </a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php 
        wp_reset_postdata(); 
        else : 
    ?>
<p>Запись не найдена.</p>
<?php endif; ?>

<?php require(get_theme_file_path('/parts/part-page-switch.php')); ?>