<?php

$data = [
    'promocode' => [
        'modal_target' => '#promo3611',
        'title' => get_the_title(),
        'logo' => [
            'src' => get_field($args_data['post_image']),
            'alt' => get_the_title(),
            'title' => get_the_title(),
        ],
        'bonus' => get_field($args_data['bonus']),
        'promo' => get_field($args_data['promo']),
    ],
];
$providers_list = array_filter(explode(',', get_field($args_data['providers']) ?? ''));

$bonus = get_field($content_sections['bonus'], $post_id) ?: '';
$promo_code = get_field('promo', $post_id) ?: 'LUDOBZOR';
$promo_photo = get_field($content_sections['promo_photo'], $post_id) ?: '';
?>

<div class="wrapper__container container">
    <div class="oc__header">
        <div class="oc__header--left"></div>
        <div class="oc__left__column">
            <div class="oc__logo">
                <div class="copy_promocode_link" data-r="<?= $data['promocode']['promo'] ?>" 
                     data-bs-toggle="modal" data-bs-target="<?= $data['promocode']['modal_target'] ?>">
                    <img src="<?= esc_url($data['promocode']['logo']['src']) ?>"
                         alt="<?= esc_attr($data['promocode']['logo']['alt']) ?>"
                         title="<?= esc_attr($data['promocode']['logo']['title']) ?>" width="285" height="70">
                </div>
            </div>
            <div class="oc__bonus copy_promocode_link" id="get_promo"
                data-image-src="<?php echo esc_url($promo_photo); ?>"
                data-promo-code="<?php echo esc_html($promo_code); ?>"
                style="background: url(<?php echo esc_url($data['promocode']['bonus']); ?>) 50% 50% no-repeat; background-size: cover;">
            </div>
            <div class="oc__bonus__timer" id="oc__bonus__timer">
                <button 
                        style="background: url(<?php echo esc_url(imgName('bonus.svg')); ?>) 50% 50% no-repeat; background-size: cover;"
                        class="oc__bonus__promocode icon__finger--before copy_promocode_link hhh9i" id="get_promo" 
                        data-promo-code="<?php echo ($promo_code); ?>"
                        data-image-src="<?php echo esc_url($promo_photo); ?>"
                        >
                    <span class="oc__bonus__promocode-inner icon__copy__dark--after"> Промокод </span>
                </button>
            </div>
        </div>
        <div class="oc__right__column col">
            <div class="oc-grid-list">
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>2023</div> Год основания
                    </div>
                </div>
                <div class="oc-grid-col">
                <div class="oc-grid-item"><span></span>
    <div>
        <?php 
        if (!empty($providers_list)) : // Проверяем, есть ли провайдеры в списке
            foreach ($providers_list as $provider_name) {
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
                                src="<?php echo esc_url($logo_url); ?>" 
                                title="<?php echo esc_attr($clean_name); ?>"
                                alt="<?php echo esc_attr($clean_name); ?>" 
                                width="28" height="28">
                        <?php 
                        endif;
                    endwhile;
                    wp_reset_postdata();
                endif;
            }
        endif;
        ?>
    </div>
    Провайдеры
</div>

                </div>
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>Классические слоты</div> Игровой зал
                    </div>
                </div>
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>Мобильная версия сайта</div> Игра с телефона
                    </div>
                </div>
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>Русский</div> Поддерживаемые языки
                    </div>
                </div>
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>Telegram</div> Служба поддержки
                    </div>
                </div>
            </div>
        </div>
        <div class="oc__bottom">
            <div class="oc__right__column no-border">
                <nav class="oc__subpages"></nav>
            </div>
        </div>
        <div class="oc__header--right"></div>
    </div>
</div>
