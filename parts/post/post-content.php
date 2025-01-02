<main class="content col-lg-8 online-casino active_tab" id="obzor">
    <?php
    function process_heading($content, $item, $is_first) {
        $heading_template = '<h2 class="wp-block-heading" id="%s">%s</h2>';
        
        if (!$is_first) {
            $heading_template = '<a rel="nofollow" class="kc-gotop kc__gotop" href="#toc">к оглавлению ↑</a>' . $heading_template;
        }

        return preg_replace(
            '/<h2 class="wp-block-heading">(\s*' . preg_quote($item['label'], '/') . '\s*)<\/h2>/',
            sprintf($heading_template, esc_attr($item['href']), '$1'),
            $content
        );
    }
    if($post->post_type !== 'platezhnie_sistemi'){
    ?>
    <h1 class="innerH1pp"><?php the_title(); ?></h1>

    <?php }; ?>
    <ul class="contents" id="toc">
        <?php foreach ($menu_items as $item): ?>
        <li class="top"><a rel="nofollow"
                href="#<?php echo esc_attr($item['href']); ?>"><?php echo esc_html($item['label']); ?></a></li>
        <?php endforeach; ?>
    </ul>

    <?php
    $content = apply_filters('the_content', get_the_content());

    foreach ($menu_items as $index => $item) {
        $is_first = ($index === 0);
        $content = process_heading($content, $item, $is_first);
    }

    echo $content;


    if($post->post_type == 'online_casino' || $post->post_type == 'bookmakers'){
        $args_data = [
            'cat_title' => 'Лучшие бонусы',
            'post_type' => 'online_casino',
            'posts_per_page' => 12,
            'post_image' => 'логотип_без_фона',
        ];

        $params = false;
        ?>
    <div class="content col-lg-8 raitingCasino">
        <?php
                require_once get_theme_file_path('parts/card/card-cat.php');
            ?>
    </div>
    <?php
            require_once get_theme_file_path('parts/post/last-reviews.php');
    };
    if($post->post_type == 'slots' || $post->post_type == 'platezhnie_sistemi' || $post->post_type == 'obzor_strimerov' ){
        ?>
        <div class="sociumArticle"><span>Поделиться: </span>
            <div class="ya-share2 ya-share2_inited" data-curtain="" data-size="l"
                data-services="vkontakte,telegram,twitter,whatsapp"
                data-image="https://ludobzor.com//upload/iblock/cab/cabb68ff811d95c3a128392a8fe1b22f.png">
                <div
                    class="ya-share2__container ya-share2__container_size_l ya-share2__container_color-scheme_normal ya-share2__container_shape_normal">
                    <ul class="ya-share2__list ya-share2__list_direction_horizontal">
                        <li class="ya-share2__item ya-share2__item_service_vkontakte"><a class="ya-share2__link"
                                href="https://vk.com/share.php?url=https%3A%2F%2Fludobzor.com%2Fpayment_systems%2Fbinance%2F&amp;title=BINANCE%20%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D0%BE%D0%B2%D0%B0%D0%BB%D1%8E%D1%82%D0%BD%D0%B0%D1%8F%20%D0%B1%D0%B8%D1%80%D0%B6%D0%B0%5B%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%B6%D0%BD%D0%B0%D1%8F%20%D1%81%D0%B8%D1%81%D1%82%D0%B5%D0%BC%D0%B0%5D&amp;image=https%3A%2F%2Fludobzor.com%2F%2Fupload%2Fiblock%2Fcab%2Fcabb68ff811d95c3a128392a8fe1b22f.png&amp;utm_source=share2"
                                rel="nofollow noopener" target="_blank" title="ВКонтакте"><span
                                    class="ya-share2__badge"><span class="ya-share2__icon"></span></span><span
                                    class="ya-share2__title">ВКонтакте</span></a></li>
                        <li class="ya-share2__item ya-share2__item_service_telegram"><a class="ya-share2__link"
                                href="https://t.me/share/url?url=https%3A%2F%2Fludobzor.com%2Fpayment_systems%2Fbinance%2F&amp;text=BINANCE%20%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D0%BE%D0%B2%D0%B0%D0%BB%D1%8E%D1%82%D0%BD%D0%B0%D1%8F%20%D0%B1%D0%B8%D1%80%D0%B6%D0%B0%5B%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%B6%D0%BD%D0%B0%D1%8F%20%D1%81%D0%B8%D1%81%D1%82%D0%B5%D0%BC%D0%B0%5D&amp;utm_source=share2"
                                rel="nofollow noopener" target="_blank" title="Telegram"><span
                                    class="ya-share2__badge"><span class="ya-share2__icon"></span></span><span
                                    class="ya-share2__title">Telegram</span></a></li>
                        <li class="ya-share2__item ya-share2__item_service_twitter"><a class="ya-share2__link"
                                href="https://twitter.com/intent/tweet?text=BINANCE%20%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D0%BE%D0%B2%D0%B0%D0%BB%D1%8E%D1%82%D0%BD%D0%B0%D1%8F%20%D0%B1%D0%B8%D1%80%D0%B6%D0%B0%5B%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%B6%D0%BD%D0%B0%D1%8F%20%D1%81%D0%B8%D1%81%D1%82%D0%B5%D0%BC%D0%B0%5D&amp;url=https%3A%2F%2Fludobzor.com%2Fpayment_systems%2Fbinance%2F&amp;utm_source=share2"
                                rel="nofollow noopener" target="_blank" title="Twitter"><span class="ya-share2__badge"><span
                                        class="ya-share2__icon"></span></span><span
                                    class="ya-share2__title">Twitter</span></a></li>
                        <li class="ya-share2__item ya-share2__item_service_whatsapp"><a class="ya-share2__link"
                                href="https://api.whatsapp.com/send?text=BINANCE%20%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D0%BE%D0%B2%D0%B0%D0%BB%D1%8E%D1%82%D0%BD%D0%B0%D1%8F%20%D0%B1%D0%B8%D1%80%D0%B6%D0%B0%5B%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%B6%D0%BD%D0%B0%D1%8F%20%D1%81%D0%B8%D1%81%D1%82%D0%B5%D0%BC%D0%B0%5D%20https%3A%2F%2Fludobzor.com%2Fpayment_systems%2Fbinance%2F&amp;utm_source=share2"
                                rel="nofollow noopener" target="_blank" title="WhatsApp"><span
                                    class="ya-share2__badge"><span class="ya-share2__icon"></span></span><span
                                    class="ya-share2__title">WhatsApp</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php };
        ?>

</main>