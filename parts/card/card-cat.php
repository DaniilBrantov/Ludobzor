<?php

$page_data = get_page_meta_query($params);

$args = array(
    'post_type'      => esc_attr($args_data['post_type']),
    'posts_per_page' => intval($args_data['posts_per_page']),
);

if (!empty($page_data['meta_query'])) {
    $args['meta_query'] = $page_data['meta_query'];
}elseif(!empty($args_data['meta_query'])) {
    $args['meta_query'] = $args_data['meta_query'];
}
$query = new WP_Query($args);


?>

<?php
    if($args_data['cat_title'] == 'Лучшие бонусы'){
        ?>
<div class="hh1">
    <text style="text-transform: none;">
        <?php echo esc_html($args_data['cat_title']); ?>
    </text>
</div>
<?php
    }else{ ?>
<h1 class="innerH1pp">
    <?php echo esc_html($args_data['cat_title']); ?>
</h1>
<?php }; 
     
        if($args_data['top_filter']){
            require( get_theme_file_path('/inc/filter/cat-card-filter.php') );
        }

        if ($query->have_posts()) : 
        
    ?>
<?php 
        while ($query->have_posts()) : $query->the_post(); 
    ?>
<div class="oc__header" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"
    id="casino-<?php echo get_the_ID(); ?>" data-cid="<?php echo get_the_ID(); ?>" data-position="1"
    data-rotation="false">

    <div class="oc__header--left"></div>
    <div class="oc__left__column">
        <a class="oc__logo" href="<?php the_permalink(); ?>">
            <?php
                            $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                            $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                            $post_image = $post_image_for_home ? esc_url($post_image_for_home) : esc_url($default_image);
                            $providers_list = array_filter(explode(',', get_field($args_data['providers']) ?? ''));
                            $payment_systems_list = array_filter(explode(',', get_field($args_data['payment_systems']) ?? ''));
                            $rating = get_field($args_data['rating']) ?? null; // значение по умолчанию, если поле пустое
                            $game_types = get_field($args_data['game_types']) ?? null; // значение по умолчанию, если поле пустое
                            $promo_desc = get_field('описание_промокода') ?? null;
                            $positive_rating_text = array_filter(explode(',', get_field($args_data['positive_rating_text']) ?? ''));
                        ?>
            <img src="<?php echo $post_image; ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
        </a>
        <?php if ($rating) : ?>
        <div class="oc__grade">
            <div class="item">
                Оценка портала <span class="value green"><i class="green"><?php echo esc_html($rating); ?></i> /
                    5</span>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="oc__right__column col">
        <a class="short__brand--link"
            href="<?php the_permalink(); ?>"><?php echo esc_html(get_field('чистое_название')); ?> онлайн-казино</a>
        <?php if ($game_types) : ?>
        <div class="list-game">


        </div>
        <?php endif; ?>

        <ul class="list__characteristics row">
            <?php
                         foreach ($positive_rating_text as $positive_rating_item) {
                            echo '
                            <li class="list__characteristics--item col-md-6"><svg class="col-auto" width="30" height="30"
                                    viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="path-1-inside-1_486_3705" fill="white">
                                        <path d="M0 0H30V30H0V0Z"></path>
                                    </mask>
                                    <path d="M0 0H30V30H0V0Z" fill="url(#paint0_linear_486_3705)"></path>
                                    <path d="M0 1H30V-1H0V1Z" fill="#3CC041" mask="url(#path-1-inside-1_486_3705)"></path>
                                    <path d="M10 13.875L14.0741 18L20 12" stroke="white" stroke-linecap="round"></path>
                                    <defs>
                                        <linearGradient id="paint0_linear_486_3705" x1="15" y1="0" x2="15" y2="30"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#3CC041" stop-opacity="0.6"></stop>
                                            <stop offset="1" stop-color="#3CC041" stop-opacity="0.07"></stop>
                                        </linearGradient>
                                    </defs>
                                </svg>' .  $positive_rating_item . '
                            </li>';
                         };
                    ?>
        </ul>
        <div class="row">
            <div class="providers col-sm-6">
                <?php
                            if (!empty($providers_list)) : ?>
                <span class="label">Провайдеры (<?php echo count($providers_list); ?>)</span>
                <div class="scroll">
                    <?php foreach ($providers_list as $provider_name) {
                                        $provider_name = trim($provider_name);
                                        $provider_query = new WP_Query([
                                            'post_type' => 'providers',
                                            'title' => sanitize_text_field($provider_name),
                                            'posts_per_page' => 1
                                        ]);
                                        if ($provider_query->have_posts()) :
                                            while ($provider_query->have_posts()) : $provider_query->the_post();
                                                $logo_url = get_field('logo');
                                                $clean_name = get_field('чистое_название');
                                                if (!empty($clean_name) && !empty($logo_url)) : ?>
                    <img class="brand__logo lazy pointer" onclick="location.href='<?php the_permalink(); ?>'"
                        src="<?php echo esc_url($logo_url); ?>" title="<?php echo esc_attr($clean_name); ?>"
                        alt="<?php echo esc_attr($clean_name); ?>" width="28" height="28">
                    <?php endif;
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                    } ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="pay col-sm-6">
                <?php
                            if (!empty($payment_systems_list)) : ?>
                <span class="label">Платежные системы (<?php echo count($payment_systems_list); ?>)</span>
                <div class="scroll">
                    <?php foreach ($payment_systems_list as $payment_system_name) {
                                        $payment_system_name = trim($payment_system_name);
                                        $payment_query = new WP_Query([
                                            'post_type' => 'platezhnie_sistemi',
                                            'title' => sanitize_text_field($payment_system_name),
                                            'posts_per_page' => 1
                                        ]);
                                        if ($payment_query->have_posts()) :
                                            while ($payment_query->have_posts()) : $payment_query->the_post();
                                                $icon_url = get_field('иконка');
                                                $title = get_the_title();
                                                if (!empty($title)) : ?>
                    <img class="brand__logo pay__logo lazy" src="<?php echo esc_url($icon_url); ?>"
                        title="<?php echo esc_attr($title); ?>" alt="<?php echo esc_attr($title); ?>" width="28"
                        height="28">
                    <?php endif;
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                    } ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-12 oc__bottom__column">
        <div class="casino__bonus js__false_promo row">
            <span class="col-sm"><?php echo $promo_desc; ?></span>
            <?php
                $bonus = get_field('banner', $post_id) ?: '';
                $promo_photo = get_field('promo_photo', $post_id) ?: '';
            ?>
            <a id="get_promo" class="copy-codee col-sm-auto btn_promo-purple copy_promocode_link"
                data-image-src="<?php echo esc_url($promo_photo); ?>"
                data-promo-code="<?php echo esc_html($promo_code); ?>">
                <span>Промокод</span>
            </a>
        </div>
    </div>
    <div class="oc__header--right"></div>
</div>

<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else : ?>
<p>Запись не найдена.</p>
<?php endif; ?>