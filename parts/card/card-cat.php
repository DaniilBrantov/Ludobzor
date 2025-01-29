<?php
// Helper function to get a field or return a default value
function get_field_value($field_name, $default = null) {
    $value = get_field($field_name);
    return $value ?: $default;
}

// Helper function to fetch and display logos for providers or payment systems
function display_logos($type, $list) {
    if (!empty($list)) :
        echo '<span class="label">' . esc_html($type) . ' (' . count($list) . ')</span>';
        echo '<div class="scroll">';
        foreach ($list as $item) {
            $item = trim($item);
            $query = new WP_Query([
                'post_type' => $type,
                'title' => sanitize_text_field($item),
                'posts_per_page' => 1
            ]);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $logo_url = get_field('logo');
                    $clean_name = get_field('чистое_название');
                    if (!empty($clean_name) && !empty($logo_url)) :
                        echo '<img class="brand__logo lazy pointer" onclick="location.href=\'' . get_permalink() . '\'" src="' . esc_url($logo_url) . '" title="' . esc_attr($clean_name) . '" alt="' . esc_attr($clean_name) . '" width="28" height="28">';
                    endif;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        echo '</div>';
    endif;
}

$page_data = get_page_meta_query($params);

$current_page = isset($_GET['PAGE']) ? absint($_GET['PAGE']) : 1;  // По умолчанию 1-я страница
$posts_per_page = intval($args_data['posts_per_page']);  // Количество постов на странице
$offset = ($current_page - 1) * $posts_per_page;


$args = [
    'post_type'      => esc_attr($args_data['post_type']),
    'posts_per_page' => $posts_per_page,
    'offset'         => $offset,
];

if (!empty($page_data['meta_query'])) {
    $args['meta_query'] = $page_data['meta_query'];
} elseif (!empty($args_data['meta_query'])) {
    $args['meta_query'] = $args_data['meta_query'];
}

$query = new WP_Query($args);

$type_bonus = get_field_value('type_bonus');
$page_bonus_id = $type_bonus && isset($type_bonus->term_id) ? $type_bonus->term_id : null;

if ($args_data['cat_title'] == 'Лучшие бонусы') :
?>
<div class="hh1"><text style="text-transform: none;"><?php echo esc_html($args_data['cat_title']); ?></text></div>
<?php
else :
?>
<h1 class="innerH1pp"><?php echo esc_html($args_data['cat_title']); ?></h1>
<?php
endif;

if (isset($args_data['top_filter']) && $args_data['top_filter']) {
    require(get_theme_file_path('/inc/filter/cat-card-filter.php'));
}

if ($query->have_posts()) :
?>
<div id="rating-container">
<?php
    while ($query->have_posts()) : $query->the_post();
        $post_id = get_the_ID();
        $url = $_SERVER['REQUEST_URI']; // Current URL path
        $bonus_type = str_replace('/bonusy-', '', trim(parse_url($url, PHP_URL_PATH), '/'));

        $tip_bonusa = get_field('tip_bonusa', $post_id);
        $show_cnt = ($page_bonus_id && $tip_bonusa && is_object($tip_bonusa) && isset($tip_bonusa->term_id) && $tip_bonusa->term_id == $page_bonus_id) || !$page_bonus_id;

        if ($show_cnt) :
?>
        <div class="oc__header rating-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" id="casino-<?php echo get_the_ID(); ?>" data-cid="<?php echo get_the_ID(); ?>" data-position="1" data-rotation="false">
            <div class="oc__header--left"></div>
            <div class="oc__left__column">
                <a class="oc__logo" href="<?php the_permalink(); ?>">
                    <?php
                    // Handle default and post image
                    $post_image_for_home = get_field_value($args_data['post_image']);
                    $default_image = get_template_directory_uri() . "/assets/images/default-post-img.png";
                    $post_image = $post_image_for_home ? esc_url($post_image_for_home) : esc_url($default_image);
                    ?>
                    <img src="<?php echo $post_image; ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                </a>

                <?php 
                $rating = isset($args_data['rating']) ? get_field($args_data['rating']) : null;

                if ($rating) : ?>
                <div class="oc__grade">
                    <div class="item">
                        Оценка портала <span class="value green"><i class="green"><?php echo esc_html($rating); ?></i> / 5</span>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="oc__right__column col">
                <a class="short__brand--link" href="<?php the_permalink(); ?>"><?php echo esc_html(get_field('чистое_название')); ?> онлайн-казино</a>
                <?php
                    $game_types = isset($args_data['game_types']) ? get_field($args_data['game_types']) : null;

                    if ($game_types) :
                ?>
                <div class="list-game">
                    <?php
                    $game_types_names = array_map(function($game_type) {
                        return is_a($game_type, 'WP_Term') ? $game_type->name : '';
                    }, $game_types);
                    echo implode(', ', array_filter($game_types_names));
                    ?>
                </div>
                <?php endif; ?>

                <ul class="list__characteristics row">
                    <?php 
                    $positive_rating_text = isset($args_data['positive_rating_text']) ? array_filter(explode(',', get_field($args_data['positive_rating_text']) ?? '')) : [];

                    foreach ($positive_rating_text as $positive_rating_item) : ?>
                    <li class="list__characteristics--item col-md-6">
                        <svg class="col-auto" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="path-1-inside-1_486_3705" fill="white">
                                <path d="M0 0H30V30H0V0Z"></path>
                            </mask>
                            <path d="M0 0H30V30H0V0Z" fill="url(#paint0_linear_486_3705)"></path>
                            <path d="M0 1H30V-1H0V1Z" fill="#3CC041" mask="url(#path-1-inside-1_486_3705)"></path>
                            <path d="M10 13.875L14.0741 18L20 12" stroke="white" stroke-linecap="round"></path>
                            <defs>
                                <linearGradient id="paint0_linear_486_3705" x1="15" y1="0" x2="15" y2="30" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#3CC041" stop-opacity="0.6"></stop>
                                    <stop offset="1" stop-color="#3CC041" stop-opacity="0.07"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                        <?php echo $positive_rating_item; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
<?php
$providers_list = isset($args_data['providers']) && is_array($providers = get_field($args_data['providers'])) ? array_map(fn($provider) => $provider->post_title, $providers) : [];
$payment_systems_list = isset($args_data['payment_systems']) ? array_filter(explode(',', get_field($args_data['payment_systems']) ?? '')) : [];

?>
                <div class="row">
                    <div class="providers col-sm-6">
                        <?php display_logos('providers', $providers_list); ?>
                    </div>

                    <div class="pay col-sm-6">
                        <?php display_logos('platezhnie_sistemi', $payment_systems_list); ?>
                    </div>
                </div>
            </div>
            <?php $post_id = isset($post_id) ? $post_id : get_the_ID(); 
            
            $promo_desc = get_field('описание_промокода') ?? null;
            ?>

            <div class="col-12 oc__bottom__column">
                <div class="casino__bonus js__false_promo row">
                    <span class="col-sm"><?php echo $promo_desc; ?></span>
                    <?php
                        $bonus = get_field('banner', $post_id) ?? '';
                        $promo_photo = get_field('promo_photo', $post_id) ?? '';
                    ?>
                    <a id="get_promo" class="copy-codee col-sm-auto btn_promo-purple copy_promocode_link" data-image-src="<?php echo esc_url($promo_photo); ?>" data-promo-code="<?php echo esc_html(empty($promo_code) ? 'LUDOBZOR' : $promo_code); ?>">
                        <span>Промокод</span>
                    </a>
                </div>
            </div>

            <div class="oc__header--right"></div>
        </div>
    <?php endif; endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>
<?php else : ?>
<p>Запись не найдена.</p>
<?php endif; ?>
