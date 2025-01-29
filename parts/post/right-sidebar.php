<?php
$game_type_names = implode(', ', array_column(get_field('game_types') ?: [], 'name'));

$providers_value = get_field('providers');
$providers_list = is_string($providers_value) ? array_filter(array_map('trim', explode(',', $providers_value))) : [];
$providers_links = [];

if ($providers_list) {
    $query = new WP_Query([
        'post_type' => 'providers',
        'posts_per_page' => -1,
        'title__in' => $providers_list,
    ]);
    while ($query->have_posts()) {
        $query->the_post();
        $providers_links[] = '<a href="' . esc_url(get_permalink()) . '" target="_blank">' . esc_html(get_the_title()) . '</a>';
    }
    wp_reset_postdata();
}
function checkField($field) {
    if(!empty(get_field($field))){
        $answer = 'Да';
    }else{
        $answer = 'Нет';
    }
    return $answer;
}

function getSvg() {
    return '
    <svg width="30" height="50" viewBox="0 0 30 50" fill="none" xmlns="http://www.w3.org/2000/svg">
        <mask id="path-1-inside-1_269_337" fill="white">
            <path d="M0 0H30V50H0V0Z"></path>
        </mask>
        <path d="M0 0H30V50H0V0Z" fill="url(#paint0_linear_269_337)"></path>
        <path d="M8 23.5L13.5 29L21.5 21" stroke="white" stroke-width="2" stroke-linecap="round"></path>
        <defs>
            <linearGradient id="paint0_linear_269_337" x1="15" y1="0" x2="15" y2="50" gradientUnits="userSpaceOnUse">
                <stop stop-color="#3CC041" stop-opacity="0.6"></stop>
                <stop offset="1" stop-color="#3CC041" stop-opacity="0.07"></stop>
            </linearGradient>
        </defs>
    </svg>';
}

function getTermNames($terms, $property = 'name') {
    if (!is_array($terms)) {
        return ''; // Возвращаем пустую строку или обработайте ошибку как нужно
    }
    
    return implode(', ', array_map(fn($term) => $term->$property ?? '', $terms));
}

foreach ($sidebars as $sidebar) {
    $casinoInfo = [];
    foreach ($sidebar['args'] as $key => $label) {
        $value = '';
        switch ($key) {
            case 'game_types':
                $value = $game_type_names;
                break;
            case 'providers':
                $value = implode(', ', $providers_links);
                break;
            case 'мобильная_версия':
            case 'live_chat_podderzhka':
            case 'e-mail_podderzhka':
                $value = checkField($key);
                break;
            case 'запрещенные_страны':
                $value = getTermNames(get_field($key) ?: []) ?: 'Нет ограничений';
                break;
            case 'janr':
            case 'platforms':
                $value = getTermNames(get_field($key) ?: []);
                break;
            default:
                $value = get_field($key);
        }

        if ($value) {
            $casinoInfo[] = [
                'label' => $label,
                'value' => $value,
                'svg'   => in_array($key, ['license', 'номер_лицензии']),
            ];
        }
    }

?>

<div class="casino-all-info">
    <div class="widget-title"><span><?php echo esc_html($sidebar['title']); ?></span></div>
    <div class="casino-all-info-inner">
        <?php foreach ($casinoInfo as $info): 
            
            ?>
            <div class="sidebar-casino-all-info flex">
                <?php if ($info['label'] == 'Запрещенные страны'): ?>
                    <div class="sidebar-casino-info full">
                        <?php echo wp_kses_post($info['value']); ?>
                        <?php if ($info['svg']): echo getSvg(); endif; ?>
                    </div>
                <?php else: ?>
                    <div class="sidebar-casino-info-left"><?php echo esc_html($info['label']); ?></div>
                    <div class="sidebar-casino-info-right">
                        <?php

                        if (is_array($info['value'])) {
                            if(!empty(getTermNames($info['value']))){
                                $info['value'] = getTermNames($info['value']);
                            }else {
                            $info['value'] = getTermNames($info['value'], 'post_title'); 
                            }
                        } elseif (is_object($info['value'])) {
                            $info['value'] = $info['value']->name ?? $info['value']->post_title;
                        } elseif (in_array($info['value'], [1, 0])) {
                            $info['value'] = $info['value'] ? 'Да' : 'Нет';
                        }

                        echo esc_html($info['value']);
                        if ($info['svg']): echo getSvg(); endif;
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php } ?>
