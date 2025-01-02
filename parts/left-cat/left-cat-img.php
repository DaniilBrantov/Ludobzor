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
    $args = array(
        'post_type' => esc_attr($args_data['post_type']), 
        'posts_per_page' => intval($args_data['posts_per_page']),
    );

    if (empty($args_data['top'])) {
        $args['orderby'] = 'rand';
    }

    if (!empty($args_data['top'])) {
        $args['meta_query'] = array(
            array(
                'key' => esc_attr($args_data['top']),
                'value' => '1',
                'compare' => 'LIKE'
            )
        );
    }

    $slots_query = new WP_Query($args);

    if ($slots_query->have_posts()) :
        while ($slots_query->have_posts()) : $slots_query->the_post();
            $post_id = get_the_ID();
            $post_title = get_the_title();
            $post_link = get_permalink();
            $post_image = get_field(esc_attr($args_data['post_image']));
            $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";

            $post_top = true;
            if (!empty($args_data['top']) && $args_data['top']) {
                $post_top = get_field(esc_attr($args_data['top']));
            }

            if ($post_top) :
    ?>
    <a class="angled-img" id="bx_<?php echo esc_attr($post_id); ?>" href="<?php echo esc_url($post_link); ?>">
        <div class="img img-offset">
            <?php if (!empty($post_image)) : ?>
            <img src="<?php echo esc_url($post_image); ?>" alt="<?php echo esc_attr($post_title); ?>">
            <?php else : ?>
            <img src="<?php echo $default_image; ?>" alt="<?php echo esc_attr($post_title); ?>">
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
        wp_reset_postdata(); 
    else :
        echo '<p>Нет доступных записей.</p>';
    endif;
    ?>
</div>
