document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(event) {
        const promoLink = event.target.closest('#get_promo');
        
        if (promoLink) {
            var imageSrc = promoLink.getAttribute('data-image-src');
            var promoCode = promoLink.getAttribute('data-promo-code') || 'LUDOBZOR';
            
            // if (!imageSrc) {
            //     console.error('Изображение не найдено');
            //     return; 
            // }

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
            
            document.body.insertAdjacentHTML('beforeend', modalHTML);
            
            var textarea = document.createElement('textarea');
            document.body.appendChild(textarea);
            textarea.value = promoCode;
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
        }
    });

    document.addEventListener('click', function(event) {
        if (event.target.closest('.force-close') || event.target.closest('.close')) {
            var modal = document.querySelector('.modal');
            modal.style.display = 'none';  
            modal.remove(); 
        }
    });
});

