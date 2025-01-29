<main class="content col-lg-8">
    <text class="innerH1pp">


        <h1 class="inner-title innerH1pp page__casino-block_text">
            <?php echo $review_post->post_title . ' - ' . get_the_title($post->ID); ?>
        </h1>
        <?php
    require_once get_theme_file_path('parts/forms/review-form.php');
    ?>
    </text>
</main>