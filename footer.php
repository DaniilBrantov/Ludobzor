<section id="sectionFooter">
    <footer itemscope="" itemtype="http://schema.org/WPFooter" id="footer" class="container footer">

        <?php
            
            $content = [
                'text' => 'Обзоры казино, топовые промокоды и бонусы в вашем телефоне',
                'links' => [
                    [
                        'class' => 'download__gp0',
                        'bg_image' => imgName('Google-Play.webp'),
                    ],
                    [
                        'class' => 'download__gp1',
                        'bg_image' => imgName('App-store.webp'),
                    ],
                ],
                'images' => [
                    'phone_image' => imgName('phone.webp'),
                ],
            ];
            
            require_once 'parts/footer/app.php';

            require_once 'parts/footer/soc-net.php';
            // Массив с заголовками и соответствующими типами постов
            $footer_sections = [
                ['title' => 'Обзоры', 'links' => [
                    ['href' => '/obzory/obzor-casino/', 'label' => 'Обзор Казино'],
                    ['href' => '/obzory/obzor-slotov/', 'label' => 'Обзор Слотов'],
                    ['href' => '/obzory/obzor-strimerov/', 'label' => 'Обзор Стримеров'],
                    ['href' => '/casino/', 'label' => 'Криптовалютные казино'],
                    ['href' => '/obzory/blacklist/', 'label' => 'Черный список казино'],
                ]],
                ['title' => 'Online casino', 'post_type' => 'online_casino'],
                ['title' => 'Букмекеры', 'post_type' => 'bookmakers', 'extra_link' => ['href' => '/bookmakers/', 'label' => 'Все букмекеры']],
                ['title' => 'Наземные казино', 'post_type' => 'nazemnye_kazino'],
                ['title' => 'Обзор Слотов', 'post_type' => 'slots'],
                ['title' => 'Платежные системы', 'post_type' => 'platezhnie_sistemi'],
                ['title' => 'Партнерки', 'post_type' => 'partnyorki'],
                ['title' => 'Популярные статьи', 'post_type' => 'faq_articles'],
                ['title' => 'Партнерам', 'links' => [
                    ['href' => '/partneram/', 'label' => 'Сотрудничество'],
                    ['href' => '/about-us/', 'label' => 'О нас'],
                    ['href' => '/contacts/', 'label' => 'Контакты'],
                ]],
                ['title' => 'Провайдеры', 'post_type' => 'providers'],
            ];

            // Вывод секций с заголовками и контентом
            require_once 'parts/footer/nav.php';

            require_once 'parts/footer/warning.php';
        ?>



    </footer>
    <?php wp_footer(); ?>
</section>