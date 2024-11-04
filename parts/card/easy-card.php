<?php

$img = get_field($easy_card_args['img']);
$title = get_the_title();
$link = get_field($easy_card_args['link']);

?>
<div class="row align-items-center">
    <div class="col-auto">
        <img src="<?php echo $img; ?>" alt="<?php echo $title; ?>" class="imgNewsNew">
    </div>
    <div class="col">
        <h1 class="innerH1pp">
            <?php echo $title; ?>
        </h1>
        <?php if(!empty($link)){ ?>
        <p class="registrationLink">
            <a class="" rel="nofollow noreferrer noopener" href="<?php echo $link; ?>"
                target="_blank"><span>Зарегистрироваться</span></a>
        </p>
        <?php }; ?>
    </div>
</div>