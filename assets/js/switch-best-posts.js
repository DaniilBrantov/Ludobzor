document.addEventListener('DOMContentLoaded', function() {
    // Получаем все вкладки и контент для них
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');

    // Функция для удаления классов is-active и скрытия всех контентов
    function deactivateAll() {
        tabLinks.forEach(link => link.classList.remove('is-active'));
        tabContents.forEach(content => content.style.display = 'none');
    }

    // Активируем первую вкладку и контент по умолчанию
    if (tabLinks.length > 0 && tabContents.length > 0) {
        tabLinks[0].classList.add('is-active');
        tabContents[0].style.display = 'block';
    }

    // Добавляем обработчик события для каждой вкладки
    tabLinks.forEach((link, index) => {
        link.addEventListener('click', function() {
            // Деактивируем все вкладки и скрываем весь контент
            deactivateAll();

            // Активируем текущую вкладку и отображаем соответствующий контент
            link.classList.add('is-active');
            tabContents[index].style.display = 'block';
        });
    });
});