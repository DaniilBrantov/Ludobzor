// Проверяем существование переменных перед их объявлением
if (typeof searchContainer === 'undefined') {
  var searchContainer = document.getElementById('sb-search');
}
if (typeof searchTrigger === 'undefined') {
  var searchTrigger = document.getElementById('open-search');
}
if (typeof searchInput === 'undefined') {
  var searchInput = document.getElementById('search');
}
if (typeof searchResultContainer === 'undefined') {
  var searchResultContainer = document.querySelector('.sb-search-result');
}

function toggleSearch(open) {
  searchContainer.style.width = open ? '1118px' : '0px';
  searchContainer.classList.toggle('sb-search-open', open);



}

document.addEventListener('click', function (event) {
  const isSearchClicked = searchTrigger.contains(event.target);
  const isInsideSearchContainer = searchContainer.contains(event.target);
  if (isSearchClicked) {
    toggleSearch(true);
  } else if (!isInsideSearchContainer) {
    toggleSearch(false);
    document.querySelector('.sb-search-result').style.display = 'none';

  }
});

searchInput.addEventListener('input', function () {
  const query = searchInput.value.trim();

  if (query.length > 2) {
    performSearch(query);
  } else {
    clearSearchResults();
  }
});

function performSearch(query) {
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
        renderSearchResults(data.data);
      } else {
        renderSearchError(data.data.message || 'Произошла ошибка.');
      }
    })
    .catch((error) => {
      console.error('Ошибка при выполнении поиска:', error);
      renderSearchError('Ошибка сети.');
    });
}

function renderSearchResults(results) {
  clearSearchResults();

  const buttonsContainer = document.createElement('div');
  buttonsContainer.className = 'mlives-buttons';

  const categories = ['Онлайн казино', 'Новости', 'Провайдеры', 'Игры'];

  categories.forEach((category, index) => {
    const button = document.createElement('div');
    button.className = `mlives-results__button ${index === 0 ? 'active' : ''}`;
    button.setAttribute('data-type', `cat-casino-${category.toLowerCase()}`);
    button.innerHTML = `<span>${category}</span>`;
    button.addEventListener('click', () =>
      toggleBlock(`cat-casino-${category.toLowerCase()}`)
    );
    buttonsContainer.appendChild(button);
  });

  const blocksContainer = document.createElement('div');
  blocksContainer.className = 'mlives-results';

  results.results.forEach((item) => {
    const block = document.createElement('div');
    block.className = 'mlives-results__block';
    block.setAttribute('data-type', 'cat-casino');

    const link = document.createElement('a');
    link.className = 'mlives-results__item';
    link.href = item.link;

    const image = document.createElement('img');
    image.className = 'mlives-results__image';
    image.src = item.image;
    image.alt = item.title;

    const title = document.createElement('span');
    title.className = 'mlives-results__title';
    title.textContent = item.title;

    const excerpt = document.createElement('span');
    excerpt.className = 'mlives-results__excerpt';
    excerpt.textContent = item.excerpt;

    const more = document.createElement('span');
    more.className = 'mlives-results__more';
    more.textContent = 'Подробнее';

    link.appendChild(image);
    link.appendChild(title);
    link.appendChild(excerpt);
    link.appendChild(more);
    block.appendChild(link);
    blocksContainer.appendChild(block);
  });

  const showAllLink = document.createElement('a');
  showAllLink.className = 'mlives-results__show-all';
  showAllLink.href = results.showAllLink;
  showAllLink.textContent = 'Показать все результаты';

  blocksContainer.appendChild(showAllLink);

  searchResultContainer.appendChild(buttonsContainer);
  searchResultContainer.appendChild(blocksContainer);
}

function toggleBlock(type) {
  const buttons = document.querySelectorAll('.mlives-results__button');
  const blocks = document.querySelectorAll('.mlives-results__block');

  buttons.forEach((button) =>
    button.classList.toggle('active', button.dataset.type === type)
  );
  blocks.forEach((block) =>
    block.classList.toggle('active', block.dataset.type === type)
  );
}

function renderSearchError(message) {
  clearSearchResults();
  searchResultContainer.innerHTML = `<p class="error-message">${message}</p>`;
}

function clearSearchResults() {
  searchResultContainer.innerHTML = '';
}
