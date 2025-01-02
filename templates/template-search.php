<?php
require_once get_theme_file_path('parts/part-main-casino.php');

$all_categories = [
    "online_casino" => [
        'title' => "Казино",
        'cat_template' => 'more-data',
        'image' => 'logo'
    ],
    "obzor_strimerov" => [
        'title' => "Стримеры",
        'cat_template' => 'more',
        'image' => 'photo'
    ],
    "news" => [
        'title' => "Новости",
        'cat_template' => 'more',
        'image' => 'photo'
    ],
    "slots" => [
        'title' => "Слоты",
        'cat_template' => 'more',
        'image' => 'photo'
    ],
    "bookmakers" => [
        'title' => "Букмекеры",
        'cat_template' => 'more',
        'image' => 'photo'
    ],
    "providers" => [
        'title' => "Провайдеры",
        'cat_template' => 'more',
        'image' => 'photo'
    ],
    "free_games" => [
        'title' => "Игры",
        'cat_template' => 'more',
        'image' => 'photo'
    ]
];

$selected_category = isset($_GET['cat']) && array_key_exists($_GET['cat'], $all_categories) ? $_GET['cat'] : 'online_casino';

$available_categories = [];
foreach ($all_categories as $cat_id => $cat_data) {
    $query_args = [
        'post_type' => $cat_id,
        's' => get_search_query(),
        'posts_per_page' => 1
    ];
    $cat_query = new WP_Query($query_args);

    if ($cat_query->have_posts()) {
        $available_categories[$cat_id] = $cat_data['title'];
    }

    wp_reset_postdata();
}

$cat_titles = array_map(function($cat_id) use ($all_categories) {
    return $all_categories[$cat_id]['title'];
}, array_keys($available_categories));

$args = [
    'post_type' => $selected_category,
    's' => get_search_query(),
    'posts_per_page' => 10,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
];

$cat_data = $all_categories[$selected_category];
?>

<div class="container">
    <div class="bl_search_title">

        <div class="searchFormPage">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                <input type="hidden" name="tags" value="">
                <input type="hidden" name="how" value="r">
                <div class="formm">
                    <span class="search-query__wrapper col">
                        <input class="search-query" type="text" name="s" value="<?php echo esc_attr(get_search_query()); ?>">
                    </span>
                    <span class="search-button__wrapper">
                        <input class="search-button" type="submit" value="Найти">
                    </span>
                </div>
            </form>
        </div>

        <h2 class="container h1">По запросу "<?php echo esc_html(get_search_query()); ?>" найдено:</h2>
        <ul class="search__tabs">
            <?php
                foreach ($available_categories as $cat_id => $cat_title) {
                    $url = "/search/?q=" . urlencode(get_search_query()) . "&cat=" . $cat_id;
                    $active_class = ($cat_id === $selected_category) ? 'active' : '';
                    echo "<li><a href='$url' class='catcat item $active_class' id='s_$cat_id'>$cat_title</a></li>";
                }
            ?>
        </ul>
    </div>
</div>

<?php
render_category_posts([
    'cat_title' => $cat_data['title'],
    'post_type' => $selected_category,
    'posts_per_page' => 12,
    'post_image' => $cat_data['image'],
    'cat_template' => $cat_data['cat_template'], 
    'all_cat_titles' => $cat_titles 
], $args);

require(get_theme_file_path('/parts/part-page-switch.php')); 
wp_reset_postdata();
?>
