<div class="container disclamer disclamer12">
    <div class="row">
        <div class="col-md-12">
            <div class="bottTextIntro">
                <h2><?php the_title(); ?></h2>
                <?php
                    // Получаем описание из произвольного поля
                    $description = get_post_meta(get_the_ID(), 'opisanie', true);

                    // Если описание не пустое, выводим его
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