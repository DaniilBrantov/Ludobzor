<?php

$data = [
    'promocode' => [
        'modal_target' => '#promo3611',
        'title' => get_the_title(),
        'logo' => [
            'src' => get_field($args_data['post_image']),
            'alt' => get_the_title(),
            'title' => get_the_title(),
        ],
        'bonus' => get_field($args_data['bonus']),
        'promo' => get_field($args_data['promo']),
    ],
];
?>

<div class="wrapper__container container">
    <div class="oc__header">
        <div class="oc__header--left"></div>
        <div class="oc__left__column">
            <div class="oc__logo">
                <div class="copy_promocode_link" data-r="<?= $data['promocode']['promo'] ?>" 
                     data-bs-toggle="modal" data-bs-target="<?= $data['promocode']['modal_target'] ?>">
                    <img src="<?= esc_url($data['promocode']['logo']['src']) ?>"
                         alt="<?= esc_attr($data['promocode']['logo']['alt']) ?>"
                         title="<?= esc_attr($data['promocode']['logo']['title']) ?>" width="285" height="70">
                </div>
            </div>
            <div class="oc__bonus copy_promocode_link" data-r="<?= $data['promocode']['promo'] ?>" 
                 data-bs-toggle="modal" data-bs-target="<?= $data['promocode']['modal_target'] ?>"
                 style="background: url('<?= esc_url($data['promocode']['bonus']) ?>') 
                 50% 50% no-repeat; background-size: cover;">
            </div>
            <div class="oc__bonus__timer" id="oc__bonus__timer">
                <button 
                        style="background: url(<?php echo esc_url(imgName('bonus.svg')); ?>) 50% 50% no-repeat; background-size: cover;"
                        class="oc__bonus__promocode icon__finger--before copy_promocode_link hhh9i" 
                        data-r="<?= $data['promocode']['promo'] ?>" 
                        data-bs-toggle="modal" data-bs-target="<?= $data['promocode']['modal_target'] ?>">
                    <span class="oc__bonus__promocode-inner icon__copy__dark--after"> Промокод </span>
                </button>
            </div>
        </div>
        <div class="oc__right__column col">
            <div class="oc-grid-list">
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>2023</div> Год основания
                    </div>
                </div>
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div><img class="brand__logo lazy pointer" onclick="window.open('/providers/pragmatic-play/');"
                                src="/upload/cssinliner_webp/iblock/0a1/0a12a0c6d1c51fbe3974df78aacd868e.webp"
                                title="Pragmatic Play" alt="Pragmatic Play" width="28" height="28"><img
                                class="brand__logo lazy pointer" onclick="window.open('/providers/endorphina/');"
                                src="/upload/cssinliner_webp/iblock/9e5/9e5017302992385390cecad6481a1e1c.webp"
                                title="Endorphina" alt="Endorphina" width="28" height="28"><img
                                class="brand__logo lazy pointer" onclick="window.open('/providers/fugaso/');"
                                src="/upload/cssinliner_webp/iblock/a61/a616539316bc67e8769de89d11f8a642.webp"
                                title="Fugaso" alt="Fugaso" width="28" height="28">
                            <div class="tooltip__btn">+1 <div class="tooltip__container"><img
                                        class="brand__logo lazy pointer" onclick="window.open('/providers/1win/');"
                                        src="/upload/cssinliner_webp/iblock/7da/oen9y7ssshiqgwbjt06x5n73d6hltj2j.webp"
                                        title="1WIN" alt="1WIN" width="28" height="28"></div>
                            </div>
                        </div> Провайдеры
                    </div>
                </div>
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>Классические слоты</div> Игровой зал
                    </div>
                </div>
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>Мобильная версия сайта</div> Игра с телефона
                    </div>
                </div>
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>Русский</div> Поддерживаемые языки
                    </div>
                </div>
                <div class="oc-grid-col">
                    <div class="oc-grid-item"><span></span>
                        <div>Telegram</div> Служба поддержки
                    </div>
                </div>
            </div>
        </div>
        <div class="oc__bottom">
            <div class="oc__right__column no-border">
                <nav class="oc__subpages"></nav>
            </div>
        </div>
        <div class="oc__header--right"></div>
    </div>
</div>
