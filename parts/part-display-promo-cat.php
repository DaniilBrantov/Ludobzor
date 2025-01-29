<?php
$page_data = get_page_meta_query($params);


$current_page = isset($_GET['PAGE']) ? absint($_GET['PAGE']) : 1;  // По умолчанию 1-я страница
$posts_per_page = intval($args_data['posts_per_page']);  // Количество постов на странице
$offset = ($current_page - 1) * $posts_per_page;



if(empty($args)){
    $args = [
        'post_type'      => esc_attr($args_data['post_type']),
        'posts_per_page' => $posts_per_page,
        'offset'         => $offset,
    ];
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
            <a href="/<?php echo ($page_data['page_link']); ?>">
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
                                    $license_data = get_field('license');

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
                                            <?php the_field('min_deposit'); ?>
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

                                <a class="button-2" id="get_promo" pos='<?php echo get_the_ID();?> '
                                    data-image-src="<?php echo esc_url(get_field('promo_photo', get_the_ID())); ?>"
                                    data-promo-code="<?php echo esc_html($promocode ?: 'LUDOBZOR'); ?>">
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

            <div class="orow rowwww contentBlockInnCasino ImgUgol1 ">

                <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="col-md-3 onlinecasino_item">
                    <div class="row vertical-gutter">
                        <div class="col-md-12">
                            <?php
                        // Check if meta_query exists and is not empty
                        if (isset($args_data['meta_query']) && !empty($args_data['meta_query']) && $args_data['meta_query'][0]['key'] == 'черный_список') { ?>
                            <div class="casino__label__n casino__label__n__black" title="Черный список"><span></span>
                            </div>
                            <?php }; ?>
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
                                <?php if($args_data['post_type'] == 'providers'){ ?>
                                <div class="title">
                                    <div><span>основано</span><span><?php echo get_field('based_on')->name; ?></span>
                                    </div>
                                    <div><span>количество игр</span><span><?php the_field('разработано_игр'); ?></span>
                                    </div>
                                    <div><span>штаб-квартира</span><span><?php the_field('штаб-квартира'); ?></span>
                                    </div>
                                </div>
                                <?php }else{?>
                                <div class="title">
                                    <div><span>основано</span><span><?php get_field('based_on'); ?></span></div>
                                    <div><span>лицензия</span><span><?php 
                                $license_data = get_field('license');
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
                                            <?php the_field('min_deposit'); ?>
                                            <?php the_field('валюта_минимального_депозита'); ?>
                                        </span>
                                    </div>
                                </div>
                                <?php }; ?>
                            </a>
                        </div>
                        <div class="col-md-12"><a href="<?php the_permalink(); ?>" class="" data-er="">Подробнее</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <?php else : ?>
                <p>Запись не найдена.</p>
                <?php endif; ?>
            </div>

        </div>
        <?php elseif ($args_data['cat_template'] == 'free_games'): ?>

        <div class="onlinecasino_item onlineslot_item" id="bx_<?php echo get_the_ID(); ?>">
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
                            <a href="<?php the_permalink(); ?>" target="_blank"
                                class="casino_sm"><?php echo esc_html($casino_title); ?></a>
                        </span>
                        <span>
                            <p>по промокоду:</p>
                            <a class=" copy_promocode_link" id="get_promo" href=""
                                data-image-src="<?php echo esc_url(get_field('promo_photo', $post_id)); ?>"
                                data-promo-code="<?php echo esc_html($promocode ?: 'LUDOBZOR'); ?>">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2.67378 0.0308101C2.22549 0.151974 1.85045 0.536034 1.74546 0.98145C1.67319 1.28814 1.7188 1.49861 1.88504 1.62541C2.04738 1.74927 2.32832 1.72382 2.4648 1.57289C2.52298 1.50853 2.57701 1.36772 2.57759 1.27882C2.57837 1.16322 2.65491 1.01705 2.75443 0.941133L2.8431 0.873491L6.80801 0.866596C9.53116 0.861835 10.7997 0.867417 10.8583 0.88435C10.9646 0.915052 11.1056 1.06713 11.1242 1.17112C11.1318 1.21383 11.1351 3.02798 11.1314 5.2026L11.1247 9.15644L11.057 9.24512C10.9811 9.34465 10.835 9.42121 10.7194 9.42198C10.4639 9.42369 10.2779 9.63122 10.2969 9.89331C10.3264 10.3012 10.7987 10.4123 11.3257 10.1353C11.6355 9.9725 11.9096 9.61241 11.9791 9.27694C11.9973 9.18897 12.003 7.96328 11.9986 5.07177L11.9923 0.990762L11.9272 0.826208C11.7949 0.492292 11.5058 0.203151 11.1719 0.0708697L11.0074 0.0056908L6.90364 0.00121108C3.37832 -0.00263539 2.78208 0.00151598 2.67378 0.0308101ZM1.00591 2.16494C0.922079 2.18305 0.784895 2.23235 0.701061 2.27447C0.506799 2.37214 0.244368 2.62976 0.145151 2.82018C-0.0130678 3.12393 -0.00378157 2.84239 0.00306589 7.12869L0.00928019 11.0056L0.0744483 11.1702C0.206707 11.5041 0.495801 11.7933 0.829662 11.9255L0.994188 11.9907L4.87051 11.9969C9.1561 12.0038 8.8746 12.0131 9.17831 11.8548C9.36891 11.7555 9.62635 11.4931 9.72376 11.2988C9.87623 10.9948 9.86924 11.1971 9.86969 7.07554C9.86995 4.52057 9.86214 3.28891 9.84502 3.1939C9.80407 2.96656 9.65477 2.68604 9.4836 2.51483C9.31242 2.34364 9.03195 2.19431 8.80465 2.15336C8.70942 2.13619 7.48093 2.12887 4.91192 2.13014C1.78301 2.13171 1.13297 2.1375 1.00591 2.16494ZM8.68531 3.02224C8.8073 3.0561 8.94397 3.19436 8.97708 3.31738C8.99579 3.38692 9.0014 4.46049 8.99692 7.12953L8.9907 10.8449L8.92467 10.9447C8.88312 11.0075 8.82224 11.061 8.76052 11.0891C8.66547 11.1322 8.54592 11.1336 4.92948 11.1341C2.34783 11.1345 1.17621 11.127 1.13055 11.1097C1.04071 11.0758 0.936548 10.9745 0.897503 10.8833C0.870535 10.8202 0.865306 10.1928 0.865728 7.07198C0.866221 3.47947 0.867909 3.33249 0.909885 3.24003C0.958028 3.13399 1.06545 3.04543 1.17862 3.01844C1.30329 2.98867 8.57777 2.99238 8.68531 3.02224Z"
                                        fill="white"></path>
                                </svg>
                                LUDOBZOR
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
            <div class="row">
            <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); 
                        $post_image_for_home = get_field(esc_attr($args_data['post_image']));
                        $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                        $post_image = $post_image_for_home ? esc_url($post_image_for_home) : esc_url($default_image);
                    ?>
            <div class="col-lg-2 col-md-3 col-6">

                <a class="list_of6" href="<?php the_permalink(); ?>">
                    <div class="img">
                        <img style="width: 186px;" src="<?php echo $post_image; ?>"
                            alt="<?php echo esc_attr(get_the_title()); ?>" />
                    </div>
                    <div class="bottom-info">
                        <text>
                            <?php echo get_field('описание_промокода'); ?>
                        </text>
                    </div>
                </a>
            </div>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php else : ?>
            <p>Запись не найдена.</p>
            <?php endif; ?>
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
                                        <?php $field = get_field('janr');
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