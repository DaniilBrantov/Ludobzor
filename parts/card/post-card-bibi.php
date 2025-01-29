<?php

$post_id = isset($post_id) ? $post_id : get_the_ID();


$bonus = get_field('bonus', $post_id) ?: '';
$promo_code = get_field('promo', $post_id) ?: 'LUDOBZOR';
$promo_photo = get_field('promo_photo', $post_id) ?: '';
$logo = get_field('logo', $post_id) ?: '';
?>

<div class="wrapper__container container">
    <div class="oc__header">
        <div class="oc__header--left"></div>
        <div class="oc__left__column">
            <div class="oc__logo">
                <div class="copy_promocode_link" 
                     data-bs-toggle="modal">
                    <img src="<?php echo esc_url($logo); ?>"
                        alt="<?php the_title(); ?>"
                        title="<?php the_title(); ?>" width="285" height="70">
                </div>
            </div>
            <div class="oc__bonus copy_promocode_link" id="get_promo"
                data-image-src="<?php echo esc_url($promo_photo); ?>"
                data-promo-code="<?php echo esc_html($promo_code ?: 'LUDOBZOR'); ?>"
                style="background: url(<?php echo esc_url($bonus); ?>) 50% 50% no-repeat; background-size: cover;">
            </div>
            <div class="oc__bonus__timer" id="oc__bonus__timer">
                <button 
                        style="background: url(<?php echo esc_url(imgName('bonus.svg')); ?>) 50% 50% no-repeat; background-size: cover;"
                        class="oc__bonus__promocode icon__finger--before copy_promocode_link hhh9i" id="get_promo" 
                        data-promo-code="<?php echo ($promo_code ?: 'LUDOBZOR'); ?>"
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
                        <div><?php
                        echo get_field('god_osnovaniya', $post_id) ?: '2023';
                        ?></div> Год основания
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
