document.addEventListener('DOMContentLoaded', function () {
  // Для кнопки "Развернуть / Свернуть"
  const moremoreButton = document.querySelector('.moremore');
  const fullText = document.querySelector('.fullTextt');

  if (moremoreButton) {
    moremoreButton.addEventListener('click', function () {
      // Проверяем, если fullText скрыт, то показываем, иначе скрываем
      if (fullText.style.display === 'none' || fullText.style.display === '') {
        fullText.style.display = 'block';  // Показываем
        moremoreButton.textContent = 'Свернуть';
      } else {
        fullText.style.display = 'none';  // Скрываем
        moremoreButton.textContent = 'Развернуть';
      }
    });
  }

  // Для переключателя в подменю
  const perecluchatelButtons = document.querySelectorAll('.perecluchatel');
  perecluchatelButtons.forEach(button => {
    button.addEventListener('click', function () {
      const submenu = this.closest('li').querySelector('.footer__submenu');
      if (submenu) {
        // Если подменю скрыто, показываем, иначе скрываем
        if (submenu.style.display === 'none' || submenu.style.display === '') {
          submenu.style.display = 'block';  // Показываем
          this.textContent = '-';
        } else {
          submenu.style.display = 'none';  // Скрываем
          this.textContent = '+';
        }
      }
    });
  });





if (window.innerWidth < 1200) {
  const selectedButtons = document.querySelectorAll('.selectedd');
  selectedButtons.forEach(button => {
    button.addEventListener('click', function () {
      const submenu = this.closest('li').querySelector('.dropdown');
      if (submenu) {
        if (submenu.style.display === 'none' || submenu.style.display === '') {
          submenu.style.display = 'block';  // Показываем
          const arrow = this.querySelector('a');
          arrow.classList.add('rotated');  // Поворот стрелки
        } else {
          submenu.style.display = 'none';  // Скрываем
          const arrow = this.querySelector('a');
          arrow.classList.remove('rotated');  // Убираем поворот стрелки
        }
      }
    });
  });

  const gamburger = document.querySelector('.gamburger');
  const nav = document.querySelector('nav');
  const closeMenu = document.querySelector('.closeMenu');

  gamburger.addEventListener('click', function() {
    nav.classList.toggle('active-menu');
  });

  document.addEventListener('click', function(event) {
    if (
      !event.target.closest('.nav, .gamburger') || 
      event.target === closeMenu
    ) {
      nav.classList.remove('active-menu');
    }
  });
}








  // Обработка для списка
  const list = document.querySelector(".nav-filter");
  if (list) {  // Проверка на существование элемента
      const listItems = Array.from(list.querySelectorAll("li"));
  
      // Массив с различными значениями maxVisibleItems для разных screenWidthLimit
      const screenLimits = [
        { width: 500, maxVisibleItems: 2 },
        { width: 900, maxVisibleItems: 3 },
        { width: 1100, maxVisibleItems: 5 },
      ];
  
      // Находим текущий screenWidthLimit
      let currentLimit = screenLimits.find(limit => limit.width > window.innerWidth);
      const maxVisibleItems = currentLimit ? currentLimit.maxVisibleItems : null;
  
      // Если maxVisibleItems не задан, показываем все элементы
      if (maxVisibleItems === null || listItems.length <= maxVisibleItems) {
          listItems.forEach(item => {
              item.style.display = "block"; // Показываем все элементы
          });
          const moreItem = list.querySelector('.more');
          if (moreItem) {
              moreItem.style.display = "none"; // Прячем кнопку "Ещё"
          }
      } else {
          // Если maxVisibleItems задан и элементов больше, чем maxVisibleItems
          listItems.forEach((item, index) => {
              if (index >= maxVisibleItems) {
                  item.style.display = "none";
                  item.classList.add("hidden-item");
                  item.classList.add("nav-item-more");
              } else {
                  item.style.display = "block"; // Показываем видимые элементы
              }
          });
  
          // Создаем элемент "Ещё"
          const moreItem = document.createElement("li");
          moreItem.classList.add("more");
          moreItem.innerHTML = `
              <a href="javascript:;">Ещё</a>
              <ul class="hidden-list" style="display: none;"></ul>  <!-- Скрыт по умолчанию -->
          `;
  
          // Переносим скрытые элементы в вложенный список
          const hiddenList = moreItem.querySelector(".hidden-list");
          listItems.slice(maxVisibleItems).forEach(item => {
              const clone = item.cloneNode(true);
              clone.style.display = "block";
              hiddenList.appendChild(clone);
          });
  
          // Добавляем "Ещё" в список
          list.appendChild(moreItem);
  
          // Обработчики событий для показа/скрытия вложенного списка
          moreItem.addEventListener("mouseenter", function () {
              hiddenList.style.display = "block";
          });
  
          moreItem.addEventListener("mouseleave", function () {
              hiddenList.style.display = "none";
          });
  
          moreItem.addEventListener("click", function () {
              hiddenList.style.display =
                  hiddenList.style.display === "block" ? "none" : "block";
          });
      }
  }
  
  


document.querySelectorAll('.mobb i').forEach(function(item) {
  item.addEventListener('click', function() {
      // Получаем все элементы с классом .casino-all-info-inner-right
      var targetElements = document.querySelectorAll('.sidebar-info-raiting .casino-all-info-inner-right');

      // Проходим по каждому элементу и переключаем его видимость
      targetElements.forEach(function(targetElement) {
          if (targetElement.style.display === 'block') {
              targetElement.style.display = 'none'; // Если элемент видим, скрываем его
          } else {
              targetElement.style.display = 'block'; // Если элемент скрыт, показываем его
          }
      });
  });
});


  const page = window.location.pathname;
  const parentContainer = document.querySelector(".reverse");

  if (parentContainer && window.innerWidth < 1000) { // Проверяем ширину экрана
      const colLg4 = parentContainer.querySelector(".col-lg-4");
      const contentBlock = parentContainer.querySelector(".content.col-lg-8.raitingCasino");
      const disclamerBlock = parentContainer.querySelector(".container.disclamer.disclamer12");
      const allTextBlock = parentContainer.querySelector(".container.allText");

      if (colLg4 && contentBlock && disclamerBlock && allTextBlock) {
          parentContainer.innerHTML = "";

          if (/bonusy/.test(page)) {
              parentContainer.appendChild(contentBlock);
              parentContainer.appendChild(colLg4);
              parentContainer.appendChild(disclamerBlock);
              parentContainer.appendChild(allTextBlock);
          } else {
              parentContainer.appendChild(colLg4);
              parentContainer.appendChild(contentBlock);
              parentContainer.appendChild(disclamerBlock);
              parentContainer.appendChild(allTextBlock);
          }
      }
  }


});
