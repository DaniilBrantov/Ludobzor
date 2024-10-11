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

// Проверяем, что страница найдена и есть данные для отображения

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Ссылка и заголовок, если есть -->
            <?php
                if (!empty($page_data['page_title']) && !empty($page_data['page_link'])) : ?>
                <a href="<?php echo esc_url($page_data['page_link']); ?>">
                    <div class="hh1 full">
                        <h1><?php echo esc_html($page_data['page_title']); ?> в казино</h1>
                    </div>
                </a>
                <?php else : ?>
                <div class="hh1 full">
                    <?php 
                        if($args_data['post_type'] == 'faq_articles'){ ?>
                            <h1 class="nnew200"><?php echo esc_html($args_data['cat_title']); ?></h1>
                        <?php }else{ ?>
                            <h1><?php echo esc_html($args_data['cat_title']); ?></h1>
                        <?php }; 
                    ?>
                </div>
            <?php endif; ?>

            <!-- Подключение фильтра, если есть параметры -->
            <?php
                // Проверка на наличие параметров фильтра
                if (!empty($params)) {
                    require(get_theme_file_path('/parts/filter/filter-menu.php'));
                }
            ?>

            <!-- Вывод постов в зависимости от шаблона -->
            <?php
                if ($args_data['cat_template'] == 'promo-more') : ?>
                <div class="row rowwww">
                    <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-3 onlinecasino_item" id="bx_<?php echo get_the_ID(); ?>">
                        <div class="row vertical-gutter">
                            <div class="col-md-12">
                                <!-- Промокод -->
                                <div class="casino__label__n promocode_click_popup" data-r="Да" data-bs-toggle="modal"
                                    data-bs-target="#promo<?php echo get_the_ID(); ?>" title="Скопировать промокод">
                                    <span>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <!-- Вставьте сюда код SVG -->
                                        </svg> Промокод
                                        <?php the_field('promocode'); ?>
                                    </span>
                                </div>

                                <!-- Ссылка на пост -->
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
                                    <!-- Заголовок и данные -->
                                    <div class="title">
                                        <div><span>основано</span><span><?php the_field('основано'); ?></span></div>
                                        <div><span>игорная зона</span><span><?php the_field('игорная_зона'); ?></span></div>
                                        <div><span>город</span><span><?php the_field('ближайший_город'); ?></span></div>
                                    </div>
                                    <?php }else{?>
                                    <!-- Заголовок и данные -->
                                    <div class="title">
                                        <div><span>основано</span><span><?php the_field('основано'); ?></span></div>
                                        <div><span>лицензия</span><span><?php the_field('лицензия'); ?></span></div>
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

                            <!-- Кнопки -->
                            <div class="col-md-12 buttons-2-outer">
                                <div class="buttons-2">
                                    <a href="<?php the_permalink(); ?>" class="button-2"><span>Обзор</span></a>
                                    <a class="button-2 copy_promocode_link" href="#"
                                        data-r="<?php the_field('promocode'); ?>" data-bs-toggle="modal"
                                        data-bs-target="#promolist_<?php echo get_the_ID(); ?>"><span>Промокод</span></a>
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
                                <!-- Заголовок и данные -->
                                <?php if($args_data['post_type'] == 'providers'){ ?>
                                <div class="title">
                                    <div><span>основано</span><span><?php the_field('основано'); ?></span></div>
                                    <div><span>количество игр</span><span><?php the_field('разработано_игр'); ?></span>
                                    </div>
                                    <div><span>штаб-квартира</span><span><?php the_field('штаб-квартира'); ?></span></div>
                                </div>
                                <?php }else{?>
                                <!-- Заголовок и данные -->
                                <div class="title">
                                    <div><span>основано</span><span><?php the_field('основано'); ?></span></div>
                                    <div><span>лицензия</span><span><?php the_field('лицензия'); ?></span></div>
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
            <?php endif; ?>

        </div>
    </div>
</div>