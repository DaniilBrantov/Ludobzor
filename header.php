<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Каноническая ссылка -->
    <link rel="canonical" href="<?php echo esc_url(get_permalink()); ?>">
    
    <!-- Иконки -->
    <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri() . '/favicon.ico'); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/apple-touch-icon.webp'); ?>">

    <!-- Метаданные -->
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-TileImage" content="<?php echo esc_url(get_template_directory_uri() . '/assets/images/mstile-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">

    <!-- Заголовок -->
    <title><?php wp_title(''); ?> | <?php bloginfo('name'); ?></title>
    
    <?php wp_head(); ?>
</head>

<body>
<?php
$ulItemtype = "http://www.schema.org/SiteNavigationElement";

// Путь к главной странице
$main = home_url('/');

// Логотипы
$logoMain = get_template_directory_uri() . "/assets/images/logo.svg";
$logoMobile = get_template_directory_uri() . "/assets/images/logo.svg";

// Разделы сайта
$searchAction = home_url('/search/');
$reviewCasino = home_url('obzor-casino/');
$reviewSlots = home_url('obzor-slotov/');
$reviewStreamers = home_url('obzor-strimerov/');
$cryptoCasino = home_url('casino/');
$blacklistCasino = home_url('blacklist/');
$landCasinos = home_url('nazemnye-kazino/');
$ratingCasino = home_url('reyting-kazino/');
$bonuses = home_url('bonusy/');
$bookmakers = home_url('bookmakers/');
$bibi = home_url('bibi/');
$news = home_url('news/');
$freeGames = home_url('freegames/');
$providers = home_url('providers/');
$partners = home_url('partneram/');
$aboutUs = home_url('about-us/');
$partnerPrograms = home_url('partnyorki/');
$responsibleGaming = home_url('otvetstvennaya-igra/');
$faq = home_url('f-a-q/');
$contacts = home_url('contacts/');
$paymentSystems = home_url('payment-systems/');
?>

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12 fullheader">
                <a href="<?= $main; ?>" class="logo_ludobzor">
                    <img src="<?= $logoMain; ?>" alt="ludobzor.ru">
                </a>

                <?php
                    require_once 'inc/header/nav.php';
                    require_once 'inc/header/search.php';
                ?>
            </div>
        </div>
    </div>
</header>

</body>

</html>
