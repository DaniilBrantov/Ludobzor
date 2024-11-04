<?php
// Получаем виды игр и провайдеров
$game_types = get_field('виды_игр');
$game_type_names = !empty($game_types) ? implode(', ', array_column($game_types, 'name')) : '';

// Список провайдеров
$provajdery_list = array_filter(array_map('trim', explode(',', get_field('provajdery') ?? '')));

// Кэширование провайдеров для избежания повторных запросов
$provajdery_links = [];
if (!empty($provajdery_list)) {
    $query = new WP_Query([
        'post_type' => 'providers',
        'posts_per_page' => -1,
        'title__in' => $provajdery_list,
    ]);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $provajdery_links[] = '<a href="' . esc_url(get_permalink()) . '" target="_blank">' . esc_html(get_the_title()) . '</a>';
        }
        wp_reset_postdata();
    }
}

// Универсальная функция для проверки поля
function checkField($field) {
    return get_field($field) ? 'Да' : 'Нет';
}

// Функция для генерации SVG иконки
function getSvg() {
    return '
    <svg width="30" height="50" viewBox="0 0 30 50" fill="none" xmlns="http://www.w3.org/2000/svg">
        <mask id="path-1-inside-1_269_337" fill="white">
            <path d="M0 0H30V50H0V0Z"></path>
        </mask>
        <path d="M0 0H30V50H0V0Z" fill="url(#paint0_linear_269_337)"></path>
        <path d="M0 1H30V-1H0V1Z" fill="#3CC041" mask="url(#path-1-inside-1_269_337)"></path>
        <path d="M8 23.5L13.5 29L21.5 21" stroke="white" stroke-width="2" stroke-linecap="round"></path>
        <defs>
            <linearGradient id="paint0_linear_269_337" x1="15" y1="0" x2="15" y2="50" gradientUnits="userSpaceOnUse">
                <stop stop-color="#3CC041" stop-opacity="0.6"></stop>
                <stop offset="1" stop-color="#3CC041" stop-opacity="0.07"></stop>
            </linearGradient>
        </defs>
    </svg>';
}

// Собираем данные для отображения


foreach ($sidebars as $sidebar) {
    $casinoInfo = [];
    foreach ($sidebar['args'] as $key => $label) {
        $value = '';
        switch ($key) {
            case 'виды_игр':
                $value = $game_type_names;
                break;
            case 'provajdery':
                $value = implode(', ', $provajdery_links);
                break;
            case 'мобильная_версия':
            case 'live_chat_podderzhka':
            case 'e-mail_podderzhka':
                $value = checkField($key);
                break;
            case 'запрещенные_страны':
                $value = !empty(get_field($key))
                    ? implode(', ', array_column(get_field($key), 'name'))
                    : 'Нет ограничений';
                break;
            case 'жанр':
                $field = get_field($key);
                $field_names = [];

                foreach ($field as $field_val) {
                    $field_names[] = $field_val->name; // Собираем все значения в массив
                }

                $value = implode(', ', $field_names); // Выводим значения через запятую

                break;
            case 'платформы':
                $field = get_field($key);
                $field_names = [];
                foreach ($field as $field_val) {
                    $field_names[] = $field_val->name; // Собираем все значения в массив
                }

                $value = implode(', ', $field_names); // Выводим значения через запятую

                break;
            default:
                $value = get_field($key);
        }
        
        if (!empty($value)) {
            $casinoInfo[] = [
                'label' => $label,
                'value' => $value,
                'svg'   => in_array($key, ['лицензия', 'номер_лицензии']),
            ];
        }

    }
?>

<div class="casino-all-info">
    <div class="widget-title"><span><?php echo esc_html($sidebar['title']); ?></span></div>
    <div class="casino-all-info-inner">
        <?php foreach ($casinoInfo as $info): ?>
        <div class="sidebar-casino-all-info flex">
            <?php if ($info['label'] == 'Запрещенные страны'): ?>
            <div class="sidebar-casino-info full">
                <?php echo wp_kses_post($info['value']); ?>
                <?php if (!empty($info['svg'])): ?>
                <?= getSvg(); ?>
                <?php endif; ?>
            </div>
            <?php else: ?>
            <div class="sidebar-casino-info-left"><?php echo esc_html($info['label']); ?></div>
            <div class="sidebar-casino-info-right">
                <?= wp_kses_post($info['value']); ?>
                <?php if (!empty($info['svg'])): ?>
                <?= getSvg(); ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php }; ?>