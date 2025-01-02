<?php


function sendToPage($link){
    return esc_attr($link);
}

// Путь к изображениям
function imgName($img_name) {
    $img_url = "/wp-content/themes/ludobzor/assets/images/" . $img_name;
    return $img_url;
}

?>