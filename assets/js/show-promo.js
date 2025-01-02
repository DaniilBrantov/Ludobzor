jQuery(document).ready(function ($) {
    // Делегирование события для всех элементов с id #get_promo
    $(document).on('click', '#get_promo', function() {
        // Получаем данные из атрибутов data-image-src и data-promo-code
        var imageSrc = $(this).data('image-src');
        var promoCode = $(this).data('promo-code');
        
        // Генерация HTML для модального окна с динамическими данными
        var modalHTML = `
            <div class="modal" style="display: block;" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row modal_card" promocode="${promoCode}">
                                    <div class="col-md-6 modal_card_content">
                                        <text>Промокод <span>${promoCode}</span> для получения бонуса за регистрацию скопирован</text>
                                        <p>Для активации бонуса необходимо ввести промокод в специальное поле на официальном сайте казино</p>
                                        <button class="force-close"><span>Понятно</span></button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="promo__image promo__image__popupp" data-i="${imageSrc}">
                                            <img src="${imageSrc}" alt="" class="promo__image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <i class="iu1"></i>
                            <i class="iu2"></i>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Вставка модального окна в body
        $('body').append(modalHTML);
        
        // Показываем модальное окно (CSS уже изменяет display: block)
        $('.modal').show();
        
        // Копируем промокод в буфер обмена
        var textarea = document.createElement('textarea');
        document.body.appendChild(textarea);
        textarea.value = promoCode;
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
    });

    // Закрытие модального окна при клике на кнопку "Понятно"
    $(document).on('click', '.force-close', function() {
        $('.modal').hide();  // Скрываем модальное окно
        $('.modal').remove();  // Удаляем модальное окно из DOM после закрытия
    });

    // Закрытие модального окна при клике на кнопку "×"
    $(document).on('click', '.close', function() {
        $('.modal').hide();  // Скрываем модальное окно
        $('.modal').remove();  // Удаляем модальное окно из DOM после закрытия
    });
});
