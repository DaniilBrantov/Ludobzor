<div class="row application">
    <div class="col col-md-6">
        <span><?php echo $content['text']; ?></span>
        <div>
            <?php foreach ($content['links'] as $link): ?>
                <a href="javascript:;" class="<?php echo $link['class']; ?> lazy_bi" 
                   style="background-image: url('<?php echo $link['bg_image']; ?>')" 
                   data-bi="<?php echo $link['bg_image']; ?>"></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col col-md-6">
        <i class="i" data-i="<?php echo $content['images']['phone_image']; ?>" 
           style="background-image: url('<?php echo $content['images']['phone_image']; ?>');"></i>
        <i class="ii" data-i="<?php echo $content['images']['phone_image']; ?>" 
           style="background-image: url('<?php echo $content['images']['phone_image']; ?>');"></i>
    </div>
</div>
