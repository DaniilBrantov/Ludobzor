class FilterManager {
    constructor() {
        this.filters = [];
    }

    updateFilter(fieldName, labelText) {
        const existingFilterIndex = this.filters.findIndex(filter => filter.field_name === fieldName);
        if (existingFilterIndex !== -1) {
            this.filters[existingFilterIndex].label_text = labelText;
        } else {
            this.filters.push({ field_name: fieldName, label_text: labelText });
        }
    }

    getFilters() {
        return this.filters;
    }
}

class PostRenderer {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
        if (!this.container) {
            console.error(`Контейнер с id '${containerId}' не найден.`);
        }
    }

    updateCasinoBlocks(posts) {
        if (!Array.isArray(posts) || posts.length === 0) {
            this.container.innerHTML = ""; 
            this.toggleDisplay(['.ttt', '.wer'], false);
            return;
        }
        console.log(posts);
        this.toggleDisplay(['.ttt', '.wer'], true); 

        const existingItems = Array.from(this.container.children);
        const newPostIds = new Set(posts.map(post => post.id));

        existingItems.forEach(item => {
            if (!newPostIds.has(item.getAttribute('data-cid'))) {
                this.container.removeChild(item);
            }
        });

        const fragment = document.createDocumentFragment();
        posts.forEach(post => {
            if (!post.id || !post.title || !post.permalink) {
                console.warn("Некорректные данные для поста:", post);
                return;
            }

            if (!document.getElementById(`casino-${post.id}`)) {
                const ratingItem = this.createPostElement(post);
                fragment.appendChild(ratingItem);
            }
        });

        this.container.appendChild(fragment);
    }


    createPostElement(post) {
        const ratingItem = document.createElement('div');
        ratingItem.className = 'oc__header rating-item';
        ratingItem.id = `casino-${post.id}`;
        ratingItem.setAttribute('data-cid', post.id);
        ratingItem.setAttribute('data-position', '1');
        ratingItem.setAttribute('data-rotation', 'false');
        ratingItem.innerHTML = `
                <div class="oc__header--left"></div>
                <div class="oc__left__column">
                    <a class="oc__logo" href="${post.permalink}">
                        <img src="${post.image}" alt="${post.title}" />
                    </a>
                    <div class="oc__grade">
                        <div class="item">
                            Оценка портала <span class="value green"><i class="green">${post.rating}</i> / 5</span>
                        </div>
                    </div>
                </div>
                <div class="oc__right__column col">
                    <a class="short__brand--link" href="${post.permalink}">${post.clean_title} онлайн-казино</a>
                    <div class="list-game">${post.game_types}</div>
                    <ul class="list__characteristics row"></ul>
                    <div class="row">
                        ${post.providers && post.providers.length > 0 ? `
                            <div class="providers col-sm-6">
                                <span class="label">Провайдеры (${post.providers.length})</span>
                                <div class="scroll">
                                    ${post.providers.map(provider => `
                                        <img class="brand__logo lazy pointer" onclick="location.href='/provider/providers/${provider.name.toLowerCase()}'" src="${provider.image}" title="${provider.name}" alt="${provider.name}" width="28" height="28">
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}
                        ${post.payment_systems && post.payment_systems.length > 0 ? `
                            <div class="pay col-sm-6">
                                <span class="label">Платежные системы (${post.payment_systems.length})</span>
                                <div class="scroll">
                                    ${post.payment_systems.map(payment_item => `
                                        <img class="brand__logo pay__logo lazy" onclick="location.href='/provider/providers/${payment_item.name.toLowerCase()}'" src="${payment_item.image}" title="${payment_item.name}" alt="${payment_item.name}" width="28" height="28">
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}
                    </div>
                </div>
                <div class="col-12 oc__bottom__column">
                    <div class="casino__bonus js__false_promo row">
                        <span class="col-sm">${post.promo_desc}</span>
                        <a id="get_promo" class="copy-codee col-sm-auto btn_promo-purple copy_promocode_link"
                            data-image-src="${post.promo_photo}"
                            data-promo-code="${post.promo}">
                            <span>Промокод</span>
                        </a>
                    </div>


                </div>
                <div class="oc__header--right"></div>
        `;

        return ratingItem;
    }


    toggleDisplay(selectors, shouldShow) {
        selectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(element => {
                element.style.display = shouldShow ? '' : 'none';
            });
        });
    }
}

class PostFetcher {
    constructor(url) {
        this.url = url;
    }


    fetchPosts(filters, callback) {

        if (!Array.isArray(filters)) {
            filters = [filters];
        }
        // console.log(filters);
    
        const params = new URLSearchParams();
        filters.forEach((filter, index) => {
            Object.keys(filter).forEach(key => {
                params.append(`filters[${index}][${key}]`, filter[key]);
            });
        });
    
        fetch(this.url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: params.toString(),
        })
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            if (data.success) {
                callback(data.data.posts);
            } else {
                console.warn('Ошибка сервера:', data.data.message);
                callback([]);
            }
        })
        .catch(error => {
            console.error('Ошибка запроса:', error);
        });
    }
}

class CasinoApp {
    constructor() {
        this.filterManager = new FilterManager();
        this.postFetcher = new PostFetcher('http://185.4.64.41/check-rating-filter/');
        this.postRenderer = new PostRenderer('rating-container');
        this.init();
    }

    init() {
        // Обработчик для всех input, кроме полей поиска стран
        document.querySelectorAll('.casino-all-info-inner input').forEach(input => {
            input.addEventListener('click', (event) => {
                // Игнорируем поля поиска стран
                if (event.target.closest('.rating-filter-search')) {
                    return;
                }

                const labelText = event.target.nextElementSibling ? event.target.nextElementSibling.textContent.trim() : event.target.dataset.label;
                let fieldName = event.target.name;
                if (!fieldName) {
                    const parentElement = event.target.closest('.casino-all-info-inner'); // Находим родительский элемент
                    const hiddenInput = parentElement ? parentElement.querySelector('input[type="hidden"]') : null;
    
                    if (hiddenInput) {
                        fieldName = hiddenInput.name; 
                    }
                }
                this.filterManager.updateFilter(fieldName, labelText); 
                this.fetchAndRenderPosts();
            });
        });
    }

    fetchAndRenderPosts() {
        const filters = this.filterManager.getFilters();
        this.postFetcher.fetchPosts(filters, (posts) => {
            this.postRenderer.updateCasinoBlocks(posts);
        });
    }
}


document.addEventListener('DOMContentLoaded', function() {
    new CasinoApp();
});


document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('#search_license').forEach(function(input) {
        input.addEventListener("input", function() {
            let filter = this.value.toLowerCase().normalize(); 
            let items = this.closest('.popup').querySelectorAll('.filter-search-item');
            items.forEach(function(item) {
                console.log(this.parentElement);

                let text = item.getAttribute('data-label').toLowerCase().normalize(); 
                item.style.display = text.includes(filter) ? "block" : "none"; 
            });
        });
    });
});


const filterButtons = document.querySelectorAll('.sidebar-casino-info-right span');
filterButtons.forEach(button => {
  button.addEventListener('click', function () {
    const submenu = this.closest('div').parentElement.parentElement.querySelector('.sidebar-casino-all-info .popup');
    if (submenu) {
      if (submenu.style.display === 'none' || submenu.style.display === '') {
        submenu.style.display = 'block';
        this.style.transform = 'rotate(225deg)';
      } else {
        submenu.style.display = 'none';
        this.style.transform = 'rotate(45deg)'; 
      }
    }
  });
});
