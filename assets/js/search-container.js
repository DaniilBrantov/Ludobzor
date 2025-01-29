document.addEventListener('DOMContentLoaded', () => {


  // if (typeof SearchModule === 'undefined') {
    class SearchModule {
      constructor() {
        this.searchContainer = document.getElementById('sb-search') || null;
        this.searchTrigger = document.getElementById('open-search') || null;
        this.searchInput = document.getElementById('search') || null;
        this.searchResultContainer = document.querySelector('.sb-search-result') || null;

        this.categories = {
          'online_casino': 'Онлайн казино',
          'news': 'Новости',
          'providers': 'Провайдеры',
          'free_games': 'Игры',
        };

        this.init();
      }

      init() {
        if (!this.searchContainer || !this.searchTrigger || !this.searchInput || !this.searchResultContainer) {
          console.error('Не удалось инициализировать модуль поиска: отсутствуют элементы.');
          return;
        }

        this.bindEvents();
      }

      bindEvents() {
        document.addEventListener('click', (event) => this.handleDocumentClick(event));
        this.searchInput.addEventListener('input', () => this.handleInput());
      }

      handleDocumentClick(event) {
        const isSearchClicked = this.searchTrigger.contains(event.target);
        const isInsideSearchContainer = this.searchContainer.contains(event.target);

        if (isSearchClicked) {
          this.toggleSearch(true);
        } else if (!isInsideSearchContainer) {
          this.toggleSearch(false);
          this.clearSearchResults();
        }
      }

      toggleSearch(open) {
        this.searchContainer.style.width = open ? '1118px' : '0px';
        this.searchContainer.classList.toggle('sb-search-open', open);
      }

      handleInput() {
        const query = this.searchInput.value.trim();

        if (query.length > 2) {
          this.performSearch(query);
        } else {
          this.clearSearchResults();
        }
      }

      performSearch(query) {
        fetch(ajax_search_params.ajax_url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            action: 'ajax_search',
            security: ajax_search_params.nonce,
            query: query,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              this.renderSearchResults(data.data);
            } else {
              this.renderSearchError(data.data.message || 'Произошла ошибка.');
            }
          })
          .catch((error) => {
            console.error('Ошибка при выполнении поиска:', error);
            this.renderSearchError('Ошибка сети.');
          });
      }

      renderSearchResults(results) {
        // Очистим старые результаты
        this.clearSearchResults();

        const mlivesResults = document.createElement('div');
        mlivesResults.className = 'mlives-results';
        this.searchResultContainer.appendChild(mlivesResults);

        const buttonsContainer = document.createElement('div');
        buttonsContainer.className = 'mlives-buttons';
        mlivesResults.appendChild(buttonsContainer);

        Object.keys(this.categories).forEach((key, index) => {
          const isCategoryAvailable = results.results.some(item => item.type === key);

          if (isCategoryAvailable) {
            const button = document.createElement('div');
            button.className = `mlives-results__button ${index === 0 ? 'active' : ''}`;
            button.setAttribute('data-type', `cat-casino-${key}`);
            button.innerHTML = `<span>${this.categories[key]}</span>`;
            button.addEventListener('click', () => this.toggleBlock(key, results));
            buttonsContainer.appendChild(button);
          }
        });

        const blocksContainer = document.createElement('div');
        blocksContainer.className = 'mlives-results__blocks';
        mlivesResults.appendChild(blocksContainer);

        this.displayResults(results.results, blocksContainer);
      }

      displayResults(results, container) {
        container.innerHTML = '';  // Очистим контейнер перед рендерингом новых результатов

        results.forEach((item) => {
          const block = document.createElement('div');
          block.className = 'mlives-results__block';

          const link = document.createElement('a');
          link.className = 'mlives-results__item';
          link.href = item.link;

          link.innerHTML = `
            <img class="mlives-results__image" src="${item.image}" alt="${item.title}">
            <span class="mlives-results__title">${item.title}</span>
            <span class="mlives-results__excerpt">${item.excerpt}</span>
          `;

          if (item.min_deposit != null && item.min_deposit !== '') {
            const deposit = document.createElement('span');
            deposit.className = 'mlives-results__prop mlives-results__prop--first';
            deposit.innerHTML = `<svg width="30" height="50" viewBox="0 0 30 50" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                            </svg><i>Мин. депозит<br>${item.min_deposit} RUB</i>`;
            link.appendChild(deposit);
          }

          if (item.withdraw_limits != null && item.withdraw_limits !== '') {
            const withdrawal = document.createElement('span');
            withdrawal.className = 'mlives-results__prop mlives-results__prop--last';
            withdrawal.innerHTML = `<svg width="30" height="50" viewBox="0 0 30 50" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                              </svg><i>Вывод до<br>${item.withdraw_limits} USD в день</i>`;
            link.appendChild(withdrawal);
          }

          const moreInfo = document.createElement('span');
          moreInfo.className = 'mlives-results__more';
          moreInfo.innerText = 'Подробнее';

          link.appendChild(moreInfo);
          block.appendChild(link);
          container.appendChild(block);
        });

        const showAllLink = document.createElement('a');
        showAllLink.className = 'mlives-results__show-all';

        const searchQuery = this.searchInput.value;
        showAllLink.href = `/?s=${encodeURIComponent(searchQuery)}`;

        showAllLink.textContent = 'Показать все результаты';
        container.appendChild(showAllLink);
      }

      toggleBlock(selectedCategory, results) {
        const filteredResults = results.results.filter(item => item.type === selectedCategory);
        this.displayResults(filteredResults, document.querySelector('.mlives-results__blocks'));
      }

      renderSearchError(message) {
        this.clearSearchResults();
        this.searchResultContainer.innerHTML = `<p class="error-message">${message}</p>`;
      }

      clearSearchResults() {
        this.searchResultContainer.innerHTML = '';
      }
    }
  // }


  new SearchModule();

  const input = document.querySelector('.sb-search-input');
  const button = document.querySelector('.sb-icon-search-button');
  const iconSearch = document.querySelector('.sb-icon-search');
  const searchMob = document.getElementById('search-mob');

  searchMob.addEventListener('click', () => {
    iconSearch.querySelector('svg').style.display = 'none';
  });
});
