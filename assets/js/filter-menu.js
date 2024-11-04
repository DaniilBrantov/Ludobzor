document.addEventListener("DOMContentLoaded", () => {
    const closeAllElements = () => {
        document.querySelectorAll('.provider-slidetoggle-target').forEach(target => {
            target.style.transition = 'max-height 0.3s ease, opacity 0.3s ease';
            target.style.opacity = '0';
            target.style.maxHeight = '0';
            target.style.display = 'none';
        });
    };

    document.querySelectorAll('.provider-slidetoggle-listt').forEach(item => {
        item.addEventListener('click', (event) => {
            event.preventDefault();

            // Получаем значение атрибута data-r и находим соответствующий блок
            const targetId = 'lud_' + item.getAttribute('data-r');
            const targetElement = document.getElementById(targetId);

            // Проверяем, открыт ли блок
            const isOpen = targetElement && targetElement.style.maxHeight && targetElement.style.maxHeight !== '0px';

            // Закрываем все элементы
            closeAllElements();

            // Если блок был закрыт, то открываем его
            if (targetElement && !isOpen) {
                targetElement.style.display = 'block';
                targetElement.style.opacity = '0';
                targetElement.style.maxHeight = '0'; // Устанавливаем начальное значение для анимации
                setTimeout(() => {
                    targetElement.style.transition = 'max-height 0.3s ease, opacity 0.3s ease';
                    targetElement.style.opacity = '1';
                    targetElement.style.maxHeight = targetElement.scrollHeight + 'px'; // Устанавливаем полную высоту
                }, 10);
            }
        });
    });
});
