<?php
// Нужен поиск/фильтр в странах
// рейтинг казино на чекбоксы
// добавить информацию по типам бонусов
// Добавить информацию по клиенту(Android,Ios...)

function get_taxonomy_terms($taxonomy) {
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
    ]);

    $options = [];
    if (is_array($terms) && !empty($terms)) {
        foreach ($terms as $term) {
            if (is_object($term)) {
                $options[$term->term_id] = $term->name;
            }
        }
    }

    return $options;
}

function get_post_titles($post_type) {
    $posts = get_posts([
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ]);

    $titles = [];
    foreach ($posts as $post) {
        $titles[$post->ID] = $post->post_title;
    }

    return $titles;
}

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

function render_country_filter($name, $label, $options) { ?>
<div class="casino-all-info-inner casino-all-info-inner-right">
    <div class="sidebar-casino-all-info flex clickkk" data-k="<?php echo esc_attr($name); ?>">
        <div class="sidebar-casino-info-left"><?php echo esc_html($label); ?></div>
        <div class="sidebar-casino-info-right">
            <span class="strr">
            </span>
        </div>
    </div>
    <div style='display:block;' class="popup">
        <input type="text" id="search_<?php echo esc_attr($name); ?>" class="rating-filter-search"
            placeholder="Поиск страны...">
        <div class="sidebar-casino-all-info flex properties">
            <?php foreach ($options as $value => $option_label) { ?>
            <div class="sidebar-casino-info-left filter-search-item"
                data-label="<?php echo esc_attr(strtolower($option_label)); ?>">
                <input type="radio" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>"
                    id="<?php echo esc_attr($name . $value); ?>">
                <label for="<?php echo esc_attr($name . $value); ?>">
                    <svg class="icon-plus" viewBox="0 0 14 12">
                        <path
                            d="M11.5539 0.00854492L4.62158 7.06454L2.31079 4.71254L0 7.06454L4.62158 11.7685L13.8647 2.36054L11.5539 0.00854492Z">
                        </path>
                    </svg>
                    <?php echo esc_html($option_label); ?>
                </label>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php }

// Собираем данные фильтров
$filter_data = [
    'license' => [
        'label' => 'Лицензия',
        'options' => get_taxonomy_terms('license'),
        'search' => true,
    ],
    'based_on' => [
        'label' => 'Год основания',
        'options' => get_taxonomy_terms('based_on'),
    ],
    'permitted_countries' => [
        'label' => 'Разрешенные страны',
        'options' => get_taxonomy_terms('prohibited_countries'),
        'search' => true,
    ],
    'game_types' => [
        'label' => 'Виды игр',
        'options' => get_taxonomy_terms('game_types'),
        'search' => true,
    ],
    'live_chat_podderzhka' => [
        'label' => 'Live-дилер',
        'options' => [
           'Live-дилер',
        ],
    ],
    'owner' => [
        'label' => 'Владелец',
        'options' => get_taxonomy_terms('owner'),
        'search' => true,
    ],
    'payment_way' => [
        'label' => 'Пополнение и вывод',
        'options' => get_post_titles('platezhnie_sistemi'),
        'search' => true,
    ],
    'currency' => [
        'label' => 'Валюта счета ',
        'options' => get_taxonomy_terms('currency'),
        'search' => true,
    ],
    'game_count' => [
        'label' => 'Количество игр',
        'slider' => [
            'max' => 1500,
        ],
    ],
    'min_deposit' => [
        'label' => 'Минимальный депозит',
        'slider' => [
            'max' => 5000,
        ],
    ],
    'providers' => [
        'label' => 'Провайдеры',
        'options' => get_post_titles('providers'),
        'search' => true,
    ],
    'platform' => [
        'label' => 'Платформа',
        'options' => get_taxonomy_terms('platform-for-casino'),
    ],
    'interface_lang' => [
        'label' => 'Язык интерфейса',
        'options' => get_taxonomy_terms('lang'),
        'search' => true,
    ],
    'support_lang' => [
        'label' => 'Язык службы поддержки',
        'options' => get_taxonomy_terms('lang'),
        'search' => true,
    ],
    'tip_bonusa' => [
        'label' => 'Типы бонусов',
        'options' => get_taxonomy_terms('type_bonus'),
    ],
    'oczenka_portala' => [
        'label' => 'Рейтинг казино',
        'options' => range(1, 5),
    ],
];

?>

<div class="col-lg-4">
    <div class="sidebar-info sidebar-info-raiting">
        <div class="sidebar-info--wrapper">
            <div class="widget-title">
                <span class="nomobb">
                    Фильтр
                    <i>
                    </i>
                </span>
                <span class="mobb">
                    Фильтр
                    <i></i>
                </span>
            </div>
            <div class="">


                <?php foreach ($filter_data as $filter_key => $filter) : ?>
                <!-- Проверяем, если есть опции для поиска -->
                <?php if (isset($filter['search'])) : ?>
                <?php render_country_filter($filter_key, $filter['label'], $filter['options']); ?>
                <?php endif; ?>

                <!-- Проверяем, если есть слайдер -->
                <?php if (isset($filter['slider'])) : ?>
                <?php render_slider($filter_key, $filter['label'], $filter['slider']['max']); ?>
                <?php endif; ?>

                <!-- Если фильтр с фиксированными опциями, то отображаем их -->
                <?php if (isset($filter['options']) && !isset($filter['search']) && !isset($filter['slider'])) : ?>
                <div class="casino-all-info-inner casino-all-info-inner-right">
                    <div class="sidebar-casino-all-info flex clickkk" data-k="<?php echo esc_attr($filter_key); ?>">
                        <div class="sidebar-casino-info-left"><?php echo esc_html($filter['label']); ?></div>
                        <div class="sidebar-casino-info-right">
                            <span class="strr"></span>
                        </div>
                    </div>
                    <div style='display:block;' class="popup">
                        <div class="sidebar-casino-all-info flex properties">
                            <?php foreach ($filter['options'] as $value => $option_label) : ?>
                            <div class="sidebar-casino-info-left">
                                <input type="radio" name="<?php echo esc_attr($filter_key); ?>"
                                    value="<?php echo esc_attr($value); ?>"
                                    id="<?php echo esc_attr($filter_key . $value); ?>">
                                <label for="<?php echo esc_attr($filter_key . $value); ?>">
                                    <svg class="icon-plus" viewBox="0 0 14 12">
                                        <path
                                            d="M11.5539 0.00854492L4.62158 7.06454L2.31079 4.71254L0 7.06454L4.62158 11.7685L13.8647 2.36054L11.5539 0.00854492Z">
                                        </path>
                                    </svg>
                                    <?php echo esc_html($option_label); ?>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>