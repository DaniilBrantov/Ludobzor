<?php

// Check if $args_data is set, if not, define it with default values
if (!isset($args_data)) {
    $args_data = [
        'post_type' => 'post', // Default post type
        'posts_per_page' => 10, // Default number of posts per page
    ];
}

$paged = isset($_GET['PAGE']) ? (int)$_GET['PAGE'] : 1; // если не указан параметр page, то по умолчанию 1

$args = [
    'post_type' => $args_data['post_type'],
    'posts_per_page' => $args_data['posts_per_page'],
    'paged' => $paged,
];

$query = new WP_Query($args);

$total_posts = $query->found_posts;
$start = max(1,$args_data['posts_per_page'] * ($paged-1));
$end = min($paged * $args_data['posts_per_page'], $total_posts);
$total_pages = ceil($total_posts / $args_data['posts_per_page']);

$slug = 'https://' . $_SERVER['HTTP_HOST'] . strtok($current_url, '?');


?>

<font class="text ttt">
    <a href="<?php echo $slug; ?>?PAGE=1" class="<?php echo ($paged == 1) ? 'disabled' : ''; ?>">
        <span class="q3">
            Начало
        </span>
    </a>

    <a href="<?php echo $slug; ?>?PAGE=<?php echo ($paged > 1) ? $paged - 1 : 1; ?>"
        class="<?php echo ($paged == 1) ? 'disabled' : ''; ?>">
        <span class="q4">
            ←
        </span>
    </a>

    <?php 
    $start_page = max(1, $paged - 2);
    $end_page = min($total_pages, $paged + 2);

    for ($i = $start_page; $i <= $end_page; $i++) :
        ?>
    <a href="<?php echo $slug; ?>?PAGE=<?php echo $i; ?>" class="q33 <?php echo ($i == $paged) ? 'active' : ''; ?>">
        <?php echo ($i == $paged) ? "<b>{$i}</b>" : $i; ?>
    </a>
    <?php
    endfor;
    ?>

    <a href="<?php echo $slug; ?>?PAGE=<?php echo ($paged < $total_pages) ? $paged + 1 : $total_pages; ?>"
        class="<?php echo ($paged == $total_pages) ? 'disabled' : ''; ?>">
        <span class="q8">
            →
        </span>
    </a>

    <a href="<?php echo $slug; ?>?PAGE=<?php echo $total_pages; ?>"
        class="q9 <?php echo ($paged == $total_pages) ? 'disabled' : ''; ?>">Конец</a>
</font>

<font class="text wer">
    <?php 
    echo "{$start} - {$end} из {$total_posts}";
    ?>
</font>

<?php wp_reset_postdata(); ?>
