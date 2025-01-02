<?php
// Нужен поиск/фильтр в странах
// рейтинг казино на чекбоксы
// добавить информацию по типам бонусов
// Добавить информацию по клиенту(Android,Ios...)
// Добавить информацию по платформе???




// Собираем данные фильтров
$filter_data = [
    'license' => [
        'label' => 'Лицензия',
        'options' => get_taxonomy_terms('license'),
    ],
    'based_on' => [
        'label' => 'Год основания',
        'options' => get_taxonomy_terms('based_on'),
    ],
    'permitted_countries' => [
        'label' => 'Разрешенные страны',
        'options' => get_taxonomy_terms('prohibited_countries'),
    ],
    'game_types' => [
        'label' => 'Виды игр',
        'options' => get_taxonomy_terms('view-of-game'),
    ],
    'liver_diler' => [
        'label' => 'Live-дилер',
        'options' => [
            0 => 'Live-дилер',
        ],
    ],
    'owner' => [
        'label' => 'Владелец',
        'options' => get_taxonomy_terms('owner'),
    ],
    'payment_titles' => [
        'label' => 'Пополнение и вывод',
        'options' => get_post_titles('platezhnie_sistemi'),
    ],
    'currency' => [
        'label' => 'Валюта счета ',
        'options' => get_taxonomy_terms('currency'),
    ],
    'game_count' => [
        'label' => 'Количество игр',
        'slider' => [
            'max' => 1500,
        ],
    ],
    'deposit_min' => [
        'label' => 'Минимальный депозит',
        'slider' => [
            'max' => 5000,
        ],
    ],
    'providers' => [
        'label' => 'Провайдеры',
        'options' => get_post_titles('providers'),
    ],
    'platform' => [
        'label' => 'Платформа',
        'options' => get_post_titles('providers'),
    ],
    'interface_lang' => [
        'label' => 'Язык интерфейса',
        'options' => get_taxonomy_terms('lang'),
    ],
    'support_lang' => [
        'label' => 'Язык службы поддержки',
        'options' => get_taxonomy_terms('lang'),
    ],

];

function get_post_titles($post_type) {
    $posts = get_posts([
        'post_type'      => $post_type,
        'posts_per_page' => -1, // чтобы получить все записи
        'orderby'        => 'title',
        'order'          => 'ASC',
    ]);

    // Получаем только названия записей
    $titles = [];
    foreach ($posts as $post) {
        $titles[] = $post->post_title;
    }

    return $titles;
}


// Функция для рендеринга слайдера
function render_slider($name, $label, $max_value) { ?>
    <div class="casino-all-info-inner casino-all-info-inner-right" id="slider_<?php echo esc_attr($name); ?>">
        <div class="sidebar-casino-all-info flex clickkk" data-k="<?php echo esc_attr($name); ?>">
            <div class="sidebar-casino-info-left">
                <?php echo esc_html($label); ?> - от <b id="slider_value_<?php echo esc_attr($name); ?>">0</b>
            </div>
            <div class="sidebar-casino-info-right">
                <span class="strr"></span>
            </div>
        </div>
        <div style='display:block;' class="popup">
            <div class="sidebar-casino-all-info flex properties" style="padding: 10px 20px 15px; min-height: auto;">
                <div id="polzunok_<?php echo esc_attr($name); ?>" data-max="<?php echo esc_attr($max_value); ?>"></div>
                <input type="hidden" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" value="">
            </div>
        </div>
    </div>
<?php }

// Функция для рендеринга фильтра
function render_filter($name, $label, $options) { ?>
    <div class="casino-all-info-inner casino-all-info-inner-right">
        <div class="sidebar-casino-all-info flex clickkk" data-k="<?php echo esc_attr($name); ?>">
            <div class="sidebar-casino-info-left"><?php echo esc_html($label); ?></div>
            <div class="sidebar-casino-info-right"><span class="strr"></span></div>
        </div>
        <div style='display:block;' class="popup">
            <div class="sidebar-casino-all-info flex properties">
                <?php foreach ($options as $value => $option_label) { ?>
                    <div class="sidebar-casino-info-left">
                        <input type="radio" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>"
                               id="<?php echo esc_attr($name . $value); ?>">
                        <label for="<?php echo esc_attr($name . $value); ?>">
                            <svg class="icon-plus" viewBox="0 0 14 12">
                                <path d="M11.5539 0.00854492L4.62158 7.06454L2.31079 4.71254L0 7.06454L4.62158 11.7685L13.8647 2.36054L11.5539 0.00854492Z"></path>
                            </svg>
                            <?php echo esc_html($option_label); ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php }

?>


<div class="col-lg-4">
    <div class="sidebar-info sidebar-info-raiting">

        <div class="sidebar-info--wrapper">

            <div class="casino-all-info">

                <form id="filter" method="get">

                <div class="widget-title"><span class="nomobb">Фильтр<i></i></span><span class="mobb">Фильтр<i></i></span></div>

                <?php
                    // Проход по каждому фильтру в массиве
                    foreach ($filter_data as $filter_name => $filter) {
                        if (isset($filter['options'])) {
                            render_filter($filter_name, $filter['label'], $filter['options']);
                        } elseif (isset($filter['slider'])) {
                            // Если фильтр содержит слайдер, рендерим его
                            render_slider($filter_name, $filter['label'], $filter['slider']['max']);
                        }
                    }
                    ?>


                    <div class="casino-all-info-inner casino-all-info-inner-right" id="type_10">

                        <div class="sidebar-casino-all-info flex clickkk" data-k="10">
                            <div class="sidebar-casino-info-left">
                                Рейтинг казино<b id="raitt"></b>
                            </div>
                            <div class="sidebar-casino-info-right">
                                <span class="strr"></span>
                            </div>
                        </div>
                        <div class="popup">
                            <div class="sidebar-casino-all-info flex properties"
                                style="padding: 10px 20px 15px;min-height: auto;">
                                <div id="polzunok3"></div>
                                <input type="hidden" name="raitingg" id="raitingg">
                            </div>
                        </div>

                    </div>

                    <div class="casino-all-info-inner casino-all-info-inner-right last resetFilter">
                        <a href="/reyting-kazino/" class="sidebar-casino-all-info flex slbCenter">
                            Сбросить фильтр
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>


</div>