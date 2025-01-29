
<nav>
    <ul itemscope itemtype="<?= $ulItemtype; ?>" class="nav navbar-nav">
        <li class="mobileOnlyy">
            <a href="<?= $main; ?>" class="logo_ludobzor">
                <img src="<?= $logoMobile; ?>" alt="ludobzor.com">
            </a>
            <a href="javascript:;" class="closeMenu"></a>
        </li>
        <li class="mobileOnlyy">
            <form role="search" method="get" class="search-form" action="">
                <input class="sb-search-input" placeholder="" type="search" id="search-mob" value="" name="s"
                    autocomplete="off">
                <input class="sb-search-submit" type="submit" value="">
                <span class="sb-icon-search sb-icon-search-span">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.37437 0.200593C4.05161 0.550246 3.03764 1.13099 2.0813 2.08682C1.11325 3.05427 0.524137 4.09696 0.169962 5.46984C-0.00735173 6.15699 -0.0192079 6.30552 0.0157565 7.39432C0.0587256 8.72909 0.168225 9.20432 0.677059 10.265C1.59187 12.1717 3.28398 13.5706 5.35715 14.1341C5.90918 14.2841 6.1682 14.3078 7.20732 14.3026C8.65468 14.2956 9.21871 14.1695 10.3849 13.5922C10.8034 13.3851 11.1764 13.2156 11.2136 13.2156C11.251 13.2156 12.1334 14.0646 13.1747 15.1023C15.4958 17.4155 15.3039 17.341 16.3214 16.3241C17.3426 15.3036 17.4158 15.492 15.0988 13.1778C14.0605 12.1407 13.2109 11.2607 13.2109 11.222C13.2109 11.1834 13.3805 10.8096 13.5878 10.3913C14.1728 9.21111 14.2929 8.66554 14.2951 7.17795C14.2973 5.74085 14.182 5.17965 13.6602 4.08911C12.7052 2.09255 11.0054 0.718318 8.79997 0.159613C7.89935 -0.0685329 6.3209 -0.0496654 5.37437 0.200593ZM8.60483 2.87095C9.31787 3.09223 9.99389 3.52324 10.5239 4.09455C12.1674 5.86613 12.1202 8.64698 10.4175 10.3484C8.71282 12.0521 5.89959 12.104 4.16451 10.4638C3.59904 9.92936 3.24177 9.38734 2.95578 8.63015C2.7907 8.19317 2.76276 7.9934 2.7577 7.21569C2.75038 6.09118 2.92006 5.4847 3.4733 4.65808C4.15107 3.64535 5.22069 2.93767 6.39913 2.7222C6.93681 2.62394 8.05092 2.69903 8.60483 2.87095Z"
                            fill="#282B3F"></path>
                    </svg>
                </span>
                <button class="sb-icon-search-button" type="submit"><span>Найти</span></button>
            </form>
        </li>
        <li class="selectedd"><a href="javascript:;"> Обзоры <span class="indicator"><i
                        class="fa fa-angle-down"></i></span></a>
            <ul class="dropdown">
                <li><a href="<?= $reviewCasino; ?>">Обзор Казино</a></li>
                <li><a href="<?= $reviewSlots; ?>">Обзор Слотов</a></li>
                <li><a href="<?= $reviewStreamers; ?>">Обзор Стримеров</a></li>
                <li><a href="<?= $cryptoCasino; ?>">Криптовалютные казино</a></li>
                <li><a href="<?= $blacklistCasino; ?>">Черный список казино</a></li>
                <li><a href="<?= $landCasinos; ?>">Наземные казино</a></li>
            </ul>
        </li>
        <li><a href="<?= $ratingCasino; ?>">Рейтинг казино</a></li>
        <li><a href="<?= $bonuses; ?>">Бонусы</a></li>
        <li><a href="<?= $bookmakers; ?>">Букмекеры</a></li>
        <li><a href="<?= $bibi; ?>">BIBI</a></li>
        <li><a href="<?= $news; ?>">Новости</a></li>
        <li class="selectedd"><a href="javascript:;"> Провайдеры <span class="indicator"><i
                        class="fa fa-angle-down"></i></span></a>
            <ul class="dropdown">
                <li><a href="<?= $freeGames; ?>">Бесплатные игры</a></li>
                <li><a href="<?= $providers; ?>">Провайдеры</a></li>
            </ul>
        </li>
        <li class="eshe"><a href="javascript:;"> Ещё <span class="indicator"><i class="fa fa-angle-down"></i></span></a>
            <ul class="dropdown">
                <li><a href="<?= $partners; ?>">Партнёрам</a></li>
                <li><a href="<?= $aboutUs; ?>">О нас</a></li>
                <li><a href="<?= $partnerPrograms; ?>">Партнёрские программы</a></li>
                <li><a href="<?= $responsibleGaming; ?>">Ответственная игра</a></li>
                <li><a href="<?= $faq; ?>">F.A.Q</a></li>
                <li><a href="<?= $contacts; ?>">Контакты</a></li>
                <li><a href="<?= $paymentSystems; ?>">Платежные системы</a></li>
            </ul>
        </li>
    </ul>
</nav>
<a href="javascript:;" class="gamburger mobile"><span>меню</span></a>