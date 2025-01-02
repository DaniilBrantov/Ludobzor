<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="canonical" href="<?php echo esc_url(get_permalink()); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url(file_exists(get_template_directory() . '/favicon.ico') ? get_template_directory_uri() . '/favicon.ico' : ''); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri() . '/upload/cssinliner_webp/apple-touch-icon.webp'); ?>">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-TileImage" content="<?php echo esc_url(get_template_directory_uri() . '/mstile-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">
    <meta name="robots" content="noindex, nofollow">

    <title><?php wp_title(''); ?> | <?php bloginfo('name'); ?></title>
    
    <?php wp_head(); ?>
</head>


<body>
<?php
$ulItemtype = "http://www.schema.org/SiteNavigationElement";
$main = "/";
$logoMain = get_template_directory_uri() . "/assets/images/logo.svg";
$logoMobile = get_template_directory_uri() . "/assets/images/logo.svg";
$searchAction = "search/";
$reviewCasino = "obzor-casino/";
$reviewSlots = "obzor-slotov/";
$reviewStreamers = "obzor-strimerov/";
$cryptoCasino = "casino/";
$blacklistCasino = "blacklist/";
$landCasinos = "nazemnye-kazino/";
$ratingCasino = "reyting-kazino/";
$bonuses = "bonusy/";
$bookmakers = "bookmakers/";
$bibi = "bibi/";
$news = "news/";
$freeGames = "freegames/";
$providers = "providers/";
$partners = "partneram/";
$aboutUs = "about-us/";
$partnerPrograms = "partnyorki/";
$responsibleGaming = "otvetstvennaya-igra/";
$faq = "f-a-q/";
$contacts = "contacts/";
$paymentSystems = "payment-systems/";
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