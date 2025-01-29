<?php
$post_id = isset($post_id) ? $post_id : get_the_ID();

?>

<div  class="container disclamer disclamer12">
    <div class="row">
        <div class="col-md-12">
            <div class="bottTextIntro">
                <h2><?php echo esc_html(get_the_title($post_id)); ?></h2> <!-- Получаем заголовок поста по ID и экранируем -->
                <?php
                    $description = get_post_meta($post_id, 'opisanie', true);

                    if (!empty($description)) {
                        echo '<p>' . esc_html($description) . '</p>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"></div>
    </div>
</div>
