jQuery(document).ready(function($) {
    // Кнопки "Развернуть" и "Свернуть" в тексте
    $('.moremore').on('click', function() {
        const $button = $(this);
        const $fullText = $('.fullTextt');

        $fullText.stop().slideToggle(500, function() {
            $button.text($fullText.is(':visible') ? 'Свернуть' : 'Развернуть');
        });
    });



    // Footer Навигация 
    $('.perecluchatel').on('click', function() {
        const $submenu = $(this).closest('li').find('.footer__submenu');
        $submenu.slideToggle();

        // Меняем знак
        $(this).text($submenu.is(':visible') ? '-' : '+');
    });
});

