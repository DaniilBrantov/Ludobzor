<?php
$free_games_query = new WP_Query(array(
    'post_type' => 'online_casino', 
    'posts_per_page' => 5, 
));

if ($free_games_query->have_posts()) :
    echo '<div class="container block4"><div class="row">';

    while ($free_games_query->have_posts()) : $free_games_query->the_post();
        $src = get_field('logo');
        $modal_id = get_field('modal_id');
        $promocode = get_field('promo');
        $modal_image = get_field('logo');
        $title = get_field('плашка_промо');
        $href = get_permalink();
        $alt = 'Скопировать промокод ' . $title; 
        $promo_photo = get_field('promo_photo', $post->ID);
        ?>
        <div class="col angled-img2">
            <div>
                <a href="<?= esc_url($href); ?>">
                    <img src="<?= esc_url($src); ?>" alt="<?= esc_attr($alt); ?>">
                </a>
                <div>
                    <div><?= esc_html($title); ?></div>
                        <div class="copy_promocode_link" id="get_promo" data-bs-toggle="modal"
                                    data-image-src="<?php echo ($promo_photo); ?>"
                                    data-promo-code="<?php echo esc_html($promocode ?: 'LUDOBZOR'); ?>">
                                    <span> Промокод </span>
                                </div>
                        
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="<?= esc_attr($modal_id); ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row modal_card" promocode="<?= esc_attr($promocode); ?>">
                                <div class="col-md-6">
                                    <div class="promo__image promo__image__popupp" data-i="<?= esc_attr($modal_image); ?>">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="" class="promo__image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <i class="iu1"></i><i class="iu2"></i>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endwhile;

    echo '</div></div>';
else :
    echo '<p>Записей не найдено</p>';
endif;

wp_reset_postdata();
?>
