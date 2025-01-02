<?php
$page_data = get_page_meta_query($params);

$paged = isset($_GET['PAGE']) ? (int)$_GET['PAGE'] : 1; // Если не указан параметр page, то по умолчанию 1

if(empty($args)){
    $args = array(
        'post_type'      => esc_attr($args_data['post_type']),
        'posts_per_page' => intval($args_data['posts_per_page']),
        'offset' => $args_data['posts_per_page'] * ($paged-1),
    );
}


if (!empty($page_data['meta_query'])) {
    $args['meta_query'] = $page_data['meta_query'];
}elseif(!empty($args_data['meta_query'])) {
    $args['meta_query'] = $args_data['meta_query'];
}

$query = new WP_Query($args);

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                if (!empty($page_data['page_title']) && !empty($page_data['page_link'])) : 
                ?>
            <a href="<?php echo esc_url($page_data['page_link']); ?>">
                <div class="hh1 full">
                    <h1><?php echo esc_html($page_data['page_title']); ?> в казино</h1>
                </div>
            </a>
            <?php else : 
                if(!empty($args_data['cat_title'])){
                    ?>
            <div class="hh1 full">
                <?php 
                        if($args_data['post_type'] == 'faq_articles'){ ?>
                <h1 class="nnew200"><?php echo esc_html($args_data['cat_title']); ?></h1>
                <?php }else{ ?>
                <h1>
                    <?php 
                        echo esc_html($args_data['cat_title']);
                    ?>
                </h1>
                <?php }; 
                    ?>
            </div>
            <?php 
                };
                endif; 
            ?>

            <?php
                if (!empty($params)) {
                    require(get_theme_file_path('/inc/filter/filter-menu.php'));
                }
            ?>

            <?php
                if ($args_data['cat_template'] == 'promo-more') : ?>
            <div class="row rowwww">
                <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); 
                
                ?>
                <div class="col-md-3 onlinecasino_item" id="bx_<?php echo get_the_ID(); ?>">
                    <div class="row vertical-gutter">
                        <div class="col-md-12">
                            <div class="casino__label__n promocode_click_popup" data-r="Да" data-bs-toggle="modal"
                                data-bs-target="#promo<?php echo get_the_ID(); ?>" title="Скопировать промокод">
                                <span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                    </svg> Промокод
                                    <?php the_field('promo'); ?>
                                </span>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="angled-img">
                                <div class="img">
                                    <?php
                                                    $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                                                    $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                                                    $post_image = $post_image_for_home ? esc_url($post_image_for_home) : esc_url($default_image);
                                                    ?>
                                    <img src="<?php echo $post_image; ?>"
                                        alt="<?php echo esc_attr(get_the_title()); ?>" />
                                </div>
                                <?php 

                                    if($args_data['post_type'] == 'nazemnye_kazino'){ ?>
                                <div class="title">
                                    <div><span>основано</span><span><?php the_field('основано'); ?></span></div>
                                    <div><span>игорная зона</span><span><?php the_field('игорная_зона'); ?></span></div>
                                    <div><span>город</span><span><?php the_field('ближайший_город'); ?></span></div>
                                </div>
                                <?php }else{?>
                                <div class="title">
                                    <div><span>основано</span><span><?php the_field('основано'); ?></span></div>
                                    <div><span>лицензия</span><span><?php 
                                    $license_data = get_field('лицензия');

                                    if (is_array($license_data)) {

                                        $term_names = array_map(function($term) {
                                            return $term->name;
                                        }, $license_data);
                                        
                                        $license_data = implode(', ', $term_names);
                                    };
                                    echo $license_data;
                                    ?></span></div>
                                    <div>
                                        <span>мин. сумма депозита</span>
                                        <span>
                                            <?php the_field('минимальная_сумма_депозита'); ?>
                                            <?php the_field('валюта_минимального_депозита'); ?>
                                        </span>
                                    </div>
                                </div>
                                <?php }; ?>
                            </a>
                        </div>

                        <div class="col-md-12 buttons-2-outer">
                            <div class="buttons-2">
                                <a href="<?php the_permalink(); ?>" class="button-2">
                                    <span>Обзор</span>
                                </a>
                                
                                <a class="button-2" id="get_promo" 
                                                data-image-src="<?php echo esc_url(get_field('promo_photo', $post_id)); ?>"
                                                data-promo-code="<?php echo esc_html($promocode); ?>">
                                                    <span>Промокод</span>
                                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <?php else : ?>
                <p>Запись не найдена.</p>
                <?php endif; ?>
            </div>



            <?php elseif ($args_data['cat_template'] == 'more'): ?>
            <div class="onlinecasino_item onlineslot_item" data-k="8" data-i="2012" id="bx_<?php echo get_the_ID(); ?>">
                <div class="row vertical-gutter">
                    <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-12">
                        <a href="<?php the_permalink(); ?>" class="angled-img">
                            <div class="img">
                                <?php
                                        $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                                        $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                                        $post_image = $post_image_for_home ? esc_url($post_image_for_home) : esc_url($default_image);
                                    ?>
                                <img src="<?php echo $post_image; ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12"><a href="<?php the_permalink(); ?>" class="" data-er="">Подробнее</a></div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                    <p>Запись не найдена.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php elseif ($args_data['cat_template'] == 'more-data'): ?>
            <div class="onlinecasino_item onlineslot_item" data-k="8" data-i="2012" id="bx_<?php echo get_the_ID(); ?>">
                <div class="row vertical-gutter">
                    <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-12">
                        <?php
                            if ($args_data['meta_query'][0]['key'] == 'черный_список') { ?>

                        <div class="casino__label__n casino__label__n__black" title="Черный список"><span></span></div>

                        <?php }; ?>
                        <a href="<?php the_permalink(); ?>" class="angled-img">
                            <div class="img">
                                <?php
                                        $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                                        $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                                        $post_image = $post_image_for_home ? esc_url($post_image_for_home) : esc_url($default_image);
                                    ?>
                                <img src="<?php echo $post_image; ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            </div>
                            <?php if($args_data['post_type'] == 'providers'){ ?>
                            <div class="title">
                                <div><span>основано</span><span><?php the_field('основано'); ?></span></div>
                                <div><span>количество игр</span><span><?php the_field('разработано_игр'); ?></span>
                                </div>
                                <div><span>штаб-квартира</span><span><?php the_field('штаб-квартира'); ?></span></div>
                            </div>
                            <?php }else{?>
                            <div class="title">
                                <div><span>основано</span><span><?php the_field('основано'); ?></span></div>
                                <div><span>лицензия</span><span><?php 
                                $license_data = get_field('лицензия');
                                if (is_array($license_data)) {
                                    $term_names = array_map(function($term) {
                                        return $term->name;
                                    }, $license_data);
                                    
                                    $license_data = implode(', ', $term_names);
                                }
                                echo $license_data;  
                                ?></span></div>
                                <div>
                                    <span>мин. сумма депозита</span>
                                    <span>
                                        <?php the_field('минимальная_сумма_депозита'); ?>
                                        <?php the_field('валюта_минимального_депозита'); ?>
                                    </span>
                                </div>
                            </div>
                            <?php }; ?>
                        </a>
                    </div>
                    <div class="col-md-12"><a href="<?php the_permalink(); ?>" class="" data-er="">Подробнее</a></div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                    <p>Запись не найдена.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php elseif ($args_data['cat_template'] == 'free_games'): ?>
    <div class="onlinecasino_item onlineslot_item" data-k="8" data-i="2012" id="bx_<?php echo get_the_ID(); ?>">
        <div class="row vertical-gutter">
            <?php 
            $free_games_query = new WP_Query(array(
                'post_type' => 'free_games',
                'posts_per_page' => 3,
            ));

            if ($free_games_query->have_posts()) : ?>
                <?php while ($free_games_query->have_posts()) : $free_games_query->the_post(); 
                    $game_title = get_the_title(); // Название игры
                    $game_image = get_field('photo'); // Картинка игры
                    $casino_name = get_field('казино');
                    $casino_query = new WP_Query(array(
                        'post_type' => 'online_casino',
                        'meta_query' => array(
                            array(
                                'key' => 'чистое_название', 
                                'value' => $casino_name,
                                'compare' => '='
                            )
                        ),
                        'posts_per_page' => 1, 
                    ));

                    if ($casino_query->have_posts()) : 
                        $casino_query->the_post(); // Получаем данные казино
                        $casino_title = get_the_title(); // Название казино
                        $casino_description = get_field('описание'); // Описание казино
                        $promo_description = get_field('описание_промокода');
                        $promocode = get_field('promo');
                    ?>
                    
                    <div class="col-md-12">
                        <a class="img" href="<?php the_permalink(); ?>">
                            <div class="img">
                                <?php
                                $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                                $game_image_url = $game_image ? esc_url($game_image) : esc_url($default_image);
                                ?>
                                <img src="<?php echo $game_image_url; ?>" alt="<?php echo esc_attr($game_title); ?>" />
                            </div>
                        </a>

                        <div class="same__title">
                            <a href="<?php the_permalink(); ?>"><?php echo esc_html($game_title); ?></a>
                        </div>

                        <div class="same__text">
                            <span><?php echo esc_html($promo_description); ?> от 
                                <a href="<?php the_permalink(); ?>" target="_blank" class="casino_sm"><?php echo esc_html($casino_title); ?></a>
                            </span>
                            <span>
                            <p>по промокоду:</p>
                            <a class="button copy_promocode_link" id="get_promo" href="" 
                                                data-image-src="<?php echo esc_url(get_field('promo_photo', $post_id)); ?>"
                                                data-promo-code="<?php echo esc_html($promocode); ?>">
                                                    <span>Промокод</span>
                                                </a>
                        </span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <a class="gamefree" href="<?php the_permalink(); ?>">Играть бесплатно</a>
                    </div>

                    <?php wp_reset_postdata();
                 endif; ?>
                    
                <?php endwhile; ?>
                <?php wp_reset_postdata(); // Сбрасываем данные для $free_games_query ?>
            <?php else : ?>
                <p>Запись не найдена</p>
            <?php endif; ?>
        </div>
    </div>





            <?php elseif ($args_data['cat_template'] == 'similar-posts'): ?>
            <div class="onlinecasino_item onlineslot_item" style="width: 186px;" data-k="8" data-i="2012" id="bx_<?php echo get_the_ID(); ?>">

                <div class="row vertical-gutter">
                    <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-12">
                        <a href="<?php the_permalink(); ?>" class="angled-img">
                            <div class="img" style="align-items: center;height: 100%;padding: 30px 0;">
                                <?php
                                        $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                                        $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                                        $post_image = $post_image_for_home ? esc_url($post_image_for_home) : esc_url($default_image);
                                    ?>
                                <img style="width: 186px;" src="<?php echo $post_image; ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            </div>
                            <div class="over-info bottom h4"></div>
                        </a>
                    </div>
                    <div class="col-md-12 down-part">
                        <div class="clearfix">
                            <h3 class="h2 pull-left m-0">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo get_field('описание_промокода'); ?>
                                </a>
                            </h3>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                    <p>Запись не найдена.</p>
                    <?php endif; ?>
                </div>

            </div>
            <?php elseif ($args_data['cat_template'] == 'title'): ?>
            <div class="news-one col-md-3">
                <div class="row vertical-gutter">
                    <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-12">
                        <a href="<?php the_permalink(); ?>" class="angled-img">
                            <div class="img">
                                <?php
                                        $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                                        $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                                        $post_image = $post_image_for_home ? esc_url($post_image_for_home) : esc_url($default_image);
                                    ?>
                                <img src="<?php echo $post_image; ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            </div>
                            <div class="over-info bottom h4"></div>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="clearfix">
                            <h3 class="h2 pull-left m-0"><a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                    <p>Запись не найдена.</p>
                    <?php endif; ?>
                </div>
            </div>

            <?php elseif ($args_data['cat_template'] == 'title-janr'): ?>
            <div class="news-one col-md-3">
                <div class="row vertical-gutter">
                    <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-12">
                        <a href="<?php the_permalink(); ?>" class="angled-img">
                            <div class="img">
                                <?php
                                        $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                                        $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                                        $post_image = $post_image_for_home ? esc_url($post_image_for_home) : esc_url($default_image);
                                    ?>
                                <img src="<?php echo $post_image; ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            </div>
                            <div class="over-info bottom h4"></div>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="clearfix">
                            <h3 class="h2 pull-left m-0">
                                <a href="<?php the_permalink(); ?>">
                                    Играть бесплатно <br>
                                    в <?php the_title(); ?>
                                    <div class="">
                                        <span>
                                            <?php $field = get_field('жанр');
                                                $field_names = [];

                                                foreach ($field as $field_val) {
                                                    $field_names[] = $field_val->name; // Собираем все значения в массив
                                                }

                                                $value = implode(', ', $field_names);
                                                echo $value;
                                            ?>
                                        </span>
                                    </div>
                                </a>
                            </h3>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                    <p>Запись не найдена.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>