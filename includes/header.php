<?php
$_coaching_pages     = ['coaching','coaching-gde-pravi-razliku','coaching-proces','business-coaching','sportski-coaching','life-coaching'];
$_wing_wave_pages    = ['wing-wave','wing-wave-sesija'];
$_poy_pages          = ['points-of-you','points-of-you-sesija','primena-points-of-you'];
$_inner_pages        = array_merge($_coaching_pages, $_wing_wave_pages, $_poy_pages);

// Jezički switcher — TODO: ažurirati $lang_en_url po stranicama kada se napravi EN verzija
if (!isset($lang_sr_url)) $lang_sr_url = strtok($_SERVER['REQUEST_URI'], '?');
if (!isset($lang_en_url)) $lang_en_url = '/en/index.php';
?>
<!DOCTYPE html>
<html lang="sr" class="scheme_original">

<head>
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php if (!empty($meta_description)): ?>
    <meta name="description" content="<?php echo htmlspecialchars($meta_description, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Inner Dynamic Method">
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?>">
    <?php if (!empty($meta_description)): ?>
    <meta property="og:description" content="<?php echo htmlspecialchars($meta_description, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>
    <?php if (!empty($og_image)): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i|Montserrat:400,700|Mr+De+Haviland|Open+Sans:300,400,600,700,800|Raleway:100,200,300,300i,400,400i,500,600,700,700i,800,900&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese' type='text/css' media='all' />
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?ver=4.3.0' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/tooltipster/tooltipster.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/tooltipster/tooltipster-light.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/essgrid/esg.settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/revslider/rev.settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/core.animation.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/instagram-widget.css' type='text/css' media='all' />
    <!-- css/skin.css uklonjen — prazan fajl (0 bytes) -->
    <link rel='stylesheet' href='css/custom-style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/skin.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/grid.layout/grid.layout.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/core.messages.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/isotope/core.portfolio.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/hotspot/style.min.css' type='text/css' media='all' />
    <!-- tooltipster.css već učitan gore (js/vendor/tooltipster/tooltipster.css) -->
    <link rel='stylesheet' href='js/vendor/swiper/swiper.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/essgrid/lightbox.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/plugins.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom.css' type='text/css' media='all' />
    <?php if (!empty($extra_head_html)) echo $extra_head_html; ?>
</head>

<body class="<?php echo $body_class; ?>">

<div id="page_preloader"></div>

<div class="body_wrap">
    <div class="page_wrap">
        <div class="top_panel_fixed_wrap"></div>
        <div class="header_mobile">
            <div class="content_wrap">
                <div class="menu_button icon-menu"></div>
                <div class="logo">
                    <a href="index.php">
                        <img src="images/logo_dark-1.png" class="logo_main" alt="Inner Dynamic Method" width="238" height="56">
                    </a>
                </div>
            </div>
            <div class="side_wrap">
                <div class="close">Close</div>
                <div class="panel_top">
                    <nav class="menu_main_nav_area">
                        <ul class="menu_main_nav">
                            <li class="menu-item<?php echo ($current_page == 'home') ? ' current-menu-item' : ''; ?>"><a href="index.php">Home</a></li>
                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_inner_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Inner Dynamic Method</a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_coaching_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Coaching</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'coaching') ? ' current-menu-item' : ''; ?>"><a href="coaching.php">O Coachingu</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'coaching-gde-pravi-razliku') ? ' current-menu-item' : ''; ?>"><a href="coaching-gde-pravi-razliku.php">Gde Coaching pravi razliku</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'coaching-proces') ? ' current-menu-item' : ''; ?>"><a href="coaching-proces.php">Coaching Proces</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'business-coaching') ? ' current-menu-item' : ''; ?>"><a href="business-coaching.php">Business Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'sportski-coaching') ? ' current-menu-item' : ''; ?>"><a href="sportski-coaching.php">Sportski Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'life-coaching') ? ' current-menu-item' : ''; ?>"><a href="life-coaching.php">Life Coaching</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_wing_wave_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Wing Wave</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'wing-wave') ? ' current-menu-item' : ''; ?>"><a href="wing-wave.php">Wing Wave Coaching Emocija</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'wing-wave-sesija') ? ' current-menu-item' : ''; ?>"><a href="wing-wave-sesija.php">Wing Wave Sesija</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_poy_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Points of You</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'points-of-you') ? ' current-menu-item' : ''; ?>"><a href="points-of-you.php">Points of You Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'points-of-you-sesija') ? ' current-menu-item' : ''; ?>"><a href="points-of-you-sesija.php">Points of You Sesija</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'primena-points-of-you') ? ' current-menu-item' : ''; ?>"><a href="primena-points-of-you.php">Primena Points of You</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['o-meni','moj-pristup-radu','spoj-koji-pravi-razliku']) ? ' current-menu-ancestor' : (($current_page == 'o-meni') ? ' current-menu-item' : ''); ?>"><a href="o-meni.php">O Meni</a>
                                <ul class="sub-menu">
                                    <li class="menu-item<?php echo ($current_page == 'moj-pristup-radu') ? ' current-menu-item' : ''; ?>"><a href="moj-pristup-radu.php">Moj pristup radu</a></li>
                                    <li class="menu-item<?php echo ($current_page == 'spoj-koji-pravi-razliku') ? ' current-menu-item' : ''; ?>"><a href="spoj-koji-pravi-razliku.php">Spoj koji pravi razliku</a></li>
                                </ul>
                            </li>
                            <li class="menu-item<?php echo ($current_page == 'utisci') ? ' current-menu-item' : ''; ?>"><a href="utisci.php">Utisci</a></li>
                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['ponude','sportski-klubovi','kompanije']) ? ' current-menu-ancestor' : (($current_page == 'ponude') ? ' current-menu-item' : ''); ?>"><a href="ponude.php">Ponude</a>
                                <ul class="sub-menu">
                                    <li class="menu-item<?php echo ($current_page == 'sportski-klubovi') ? ' current-menu-item' : ''; ?>"><a href="sportski-klubovi.php">Sportski klubovi</a></li>
                                    <li class="menu-item<?php echo ($current_page == 'kompanije') ? ' current-menu-item' : ''; ?>"><a href="kompanije.php">Kompanije</a></li>
                                </ul>
                            </li>
                            <li class="menu-item<?php echo ($current_page == 'kontakt') ? ' current-menu-item' : ''; ?>"><a href="kontakt.php">Kontakt</a></li>
                        </ul>
                    </nav>
                    <div class="search_wrap search_style_regular search_state_fixed search_ajax">
                        <div class="search_form_wrap">
                            <form role="search" method="get" class="search_form" action="#">
                                <button type="submit" class="search_submit icon-search-1" title="Start search"></button>
                                <input type="text" class="search_field" placeholder="Search" value="" name="s" />
                            </form>
                        </div>
                        <div class="search_results widget_area scheme_original">
                            <a class="search_results_close icon-cancel"></a>
                            <div class="search_results_content"></div>
                        </div>
                    </div>
                </div>
                <div class="panel_bottom"></div>
            </div>
            <div class="mask"></div>
        </div>
        <header class="top_panel_wrap top_panel_style_6 <?php echo isset($header_scheme) ? $header_scheme : 'scheme_dark'; ?>">
            <div class="top_panel_wrap_inner top_panel_inner_style_6 <?php echo isset($header_position) ? $header_position : 'top_panel_position_over'; ?>">
                <div class="top_panel_top">
                    <div class="content_wrap clearfix">
                        <div class="top_panel_top_contact_area">
                            <span class="contact_icon icon-mail"></span>
                            <a href="mailto:office@bowencentar.rs">office@bowencentar.rs</a>
                        </div>
                        <div class="top_panel_top_contact_area">
                            <span class="contact_icon icon-icon_phone"></span>
                            <a href="tel:0641112202">064 111 22 02</a>
                        </div>
                        <div class="top_panel_top_user_area">
                            <div class="lang_switch" style="display:flex;gap:10px;align-items:center;">
                                <a href="<?php echo htmlspecialchars($lang_sr_url, ENT_QUOTES, 'UTF-8'); ?>" lang="sr" aria-label="Srpski" title="Srpski" style="display:inline-flex;align-items:center;">
                                    <img src="images/flags/sr.svg" alt="Srpski" width="20" height="14" style="display:block;border:1px solid rgba(0,0,0,.15);border-radius:2px;" />
                                </a>
                                <a href="<?php echo htmlspecialchars($lang_en_url, ENT_QUOTES, 'UTF-8'); ?>" lang="en" aria-label="English" title="English" style="display:inline-flex;align-items:center;">
                                    <img src="images/flags/en.svg" alt="English" width="20" height="14" style="display:block;border:1px solid rgba(0,0,0,.15);border-radius:2px;" />
                                </a>
                            </div>
                        </div>
                        <div class="top_panel_top_socials">
                            <span class="label"> </span>
                            <div class="sc_socials sc_socials_type_icons sc_socials_shape_square sc_socials_size_tiny">
                                <div class="sc_socials_item">
                                    <a href="https://www.instagram.com/ovdeisada_/" target="_blank" rel="noopener" class="social_icons social_instagramm" aria-label="Instagram">
                                        <span class="icon-instagramm"></span>
                                    </a>
                                </div>
                                <div class="sc_socials_item">
                                    <a href="https://www.facebook.com/ovdeisada" target="_blank" rel="noopener" class="social_icons social_facebook" aria-label="Facebook">
                                        <span class="icon-facebook"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top_panel_middle">
                    <div class="content_wrap">
                        <div class="contact_logo">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="images/logo_dark-1.png" class="logo_main" alt="Inner Dynamic Method" width="238" height="56">
                                    <img src="images/logo_dark-1.png" class="logo_fixed" alt="Inner Dynamic Method" width="238" height="56">
                                </a>
                            </div>
                        </div>
                        <div class="menu_main_wrap">
                            <nav class="menu_main_nav_area">
                                <ul class="menu_main_nav">
                                    <li class="menu-item<?php echo ($current_page == 'home') ? ' current-menu-item' : ''; ?>"><a href="index.php">Home</a></li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_inner_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Inner Dynamic Method</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_coaching_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Coaching</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item<?php echo ($current_page == 'coaching') ? ' current-menu-item' : ''; ?>"><a href="coaching.php">O Coachingu</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'coaching-gde-pravi-razliku') ? ' current-menu-item' : ''; ?>"><a href="coaching-gde-pravi-razliku.php">Gde Coaching pravi razliku</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'coaching-proces') ? ' current-menu-item' : ''; ?>"><a href="coaching-proces.php">Coaching Proces</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'business-coaching') ? ' current-menu-item' : ''; ?>"><a href="business-coaching.php">Business Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'sportski-coaching') ? ' current-menu-item' : ''; ?>"><a href="sportski-coaching.php">Sportski Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'life-coaching') ? ' current-menu-item' : ''; ?>"><a href="life-coaching.php">Life Coaching</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_wing_wave_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Wing Wave</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item<?php echo ($current_page == 'wing-wave') ? ' current-menu-item' : ''; ?>"><a href="wing-wave.php">Wing Wave Coaching Emocija</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'wing-wave-sesija') ? ' current-menu-item' : ''; ?>"><a href="wing-wave-sesija.php">Wing Wave Sesija</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_poy_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Points of You</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item<?php echo ($current_page == 'points-of-you') ? ' current-menu-item' : ''; ?>"><a href="points-of-you.php">Points of You Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'points-of-you-sesija') ? ' current-menu-item' : ''; ?>"><a href="points-of-you-sesija.php">Points of You Sesija</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'primena-points-of-you') ? ' current-menu-item' : ''; ?>"><a href="primena-points-of-you.php">Primena Points of You</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['o-meni','moj-pristup-radu','spoj-koji-pravi-razliku']) ? ' current-menu-ancestor' : (($current_page == 'o-meni') ? ' current-menu-item' : ''); ?>"><a href="o-meni.php">O Meni</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'moj-pristup-radu') ? ' current-menu-item' : ''; ?>"><a href="moj-pristup-radu.php">Moj pristup radu</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'spoj-koji-pravi-razliku') ? ' current-menu-item' : ''; ?>"><a href="spoj-koji-pravi-razliku.php">Spoj koji pravi razliku</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item<?php echo ($current_page == 'utisci') ? ' current-menu-item' : ''; ?>"><a href="utisci.php">Utisci</a></li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['ponude','sportski-klubovi','kompanije']) ? ' current-menu-ancestor' : (($current_page == 'ponude') ? ' current-menu-item' : ''); ?>"><a href="ponude.php">Ponude</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'sportski-klubovi') ? ' current-menu-item' : ''; ?>"><a href="sportski-klubovi.php">Sportski klubovi</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'kompanije') ? ' current-menu-item' : ''; ?>"><a href="kompanije.php">Kompanije</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item<?php echo ($current_page == 'kontakt') ? ' current-menu-item' : ''; ?>"><a href="kontakt.php">Kontakt</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
