<?php
// Проверяем, установлен ли $post_id, если нет - используем текущий ID поста
$post_id = isset($post_id) ? $post_id : get_the_ID();

// Получаем ID родительского поста (если есть) для данного $post_id
$parent_id = wp_get_post_parent_id($post_id); // Получаем ID родительской страницы
$current_content = get_post_field('post_content', $post_id); // Контент текущей страницы
$parent_content = $parent_id ? get_post_field('post_content', $parent_id) : ''; // Контент родительской страницы

// Если контент текущей страницы пуст, берем контент родителя
$content_to_display = !empty($current_content) ? $current_content : $parent_content;

// Проверяем версию текста и выводим контент
if (empty($cat_text['text_version']) || $cat_text['text_version'] == 1) {
?>
    <div class="container allText">
        <div style="display: none;" class="row fullTextt">
            <div class="col-md-12">
                <div class="">
                    <?php echo apply_filters('the_content', $content_to_display); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="moremore" data-r="Развернуть">Развернуть</a>
            </div>
        </div>
    </div>
<?php
} elseif ($cat_text['text_version'] == 2) {
?>
    <div class="fullText">
        <?php echo apply_filters('the_content', $content_to_display); ?>
    </div>
<?php
}
?>
