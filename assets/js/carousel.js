jQuery(document).ready(function($){
    $('.owl-carousel').owlCarousel({
        items: 6, // Количество элементов, показываемых на экране
        loop: true, // Зацикливание карусели
        margin: 10, // Отступ между элементами
        nav: true, // Отображение кнопок "вперед" и "назад"
        dots: false, // Отключение точек навигации
        autoplay: true, // Автоматическая прокрутка
        autoplayTimeout: 3000, // Задержка перед автоматической прокруткой
        responsive: { // Адаптивные настройки
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 6
            }
        }
    });
});
