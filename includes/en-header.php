<?php
$_idc_pages          = ['inner-dynamic-coaching'];
$_coaching_pages     = ['coaching','coaching-gde-pravi-razliku','coaching-proces','business-coaching','sportski-coaching','life-coaching'];
$_wing_wave_pages    = ['wing-wave','wing-wave-sesija'];
$_poy_pages          = ['points-of-you','points-of-you-sesija','primena-points-of-you'];
$_sfera_pages        = ['sfera-mentalni-trening','proces-sfera-mentalnog-treninga'];
$_inner_pages        = array_merge($_idc_pages, $_coaching_pages, $_wing_wave_pages, $_poy_pages, $_sfera_pages);

$lang       = 'en';
$base_path  = '../';
if (!isset($lang_sr_url)) $lang_sr_url = '/index.php';
if (!isset($lang_en_url)) $lang_en_url = strtok($_SERVER['REQUEST_URI'], '?');
if (!isset($meta_robots)) $meta_robots = 'index, follow';
if (!isset($og_image))    $og_image    = '';

$_site_url  = 'https://innerdynamicmethod.rs';
$_canonical = $_site_url . strtok($_SERVER['REQUEST_URI'], '?');
$_og_image  = !empty($og_image) ? $og_image : $_site_url . '/images/logo.png';
?>
<!DOCTYPE html>
<html lang="en" class="scheme_original">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="robots" content="<?php echo htmlspecialchars($meta_robots); ?>">
    <?php if (!empty($meta_description)): ?>
    <meta name="description" content="<?php echo htmlspecialchars($meta_description, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>
    <?php if (!empty($meta_keywords)): ?>
    <meta name="keywords" content="<?php echo htmlspecialchars($meta_keywords, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>

    <!-- Canonical + hreflang -->
    <link rel="canonical" href="<?php echo htmlspecialchars($_canonical, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="alternate" hreflang="sr" href="<?php echo htmlspecialchars($_site_url . $lang_sr_url, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="alternate" hreflang="en" href="<?php echo htmlspecialchars($_site_url . $lang_en_url, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($_site_url . $lang_sr_url, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Inner Dynamic Method">
    <meta property="og:locale" content="en_US">
    <meta property="og:url" content="<?php echo htmlspecialchars($_canonical, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?>">
    <?php if (!empty($meta_description)): ?>
    <meta property="og:description" content="<?php echo htmlspecialchars($meta_description, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($_og_image, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?>">
    <?php if (!empty($meta_description)): ?>
    <meta name="twitter:description" content="<?php echo htmlspecialchars($meta_description, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>
    <meta name="twitter:image" content="<?php echo htmlspecialchars($_og_image, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel="apple-touch-icon" href="/images/logo.png">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "Inner Dynamic Method",
        "url": "https://innerdynamicmethod.rs",
        "telephone": "+381641112202",
        "email": "office@innerdynamiccoaching.rs",
        "logo": "https://innerdynamicmethod.rs/images/logo.png",
        "image": "https://innerdynamicmethod.rs/images/logo.png",
        "address": { "@type": "PostalAddress", "addressCountry": "RS" },
        "serviceType": ["Coaching", "Wing Wave Coaching", "Points of You Coaching"],
        "sameAs": [
            "https://www.instagram.com/ovdeisada_/",
            "https://www.facebook.com/ovdeisada",
            "https://www.linkedin.com/in/danijela-maric-pavlovic-6a616459/"
        ]
    }
    </script>
<?php if (!empty($page_schema)) echo $page_schema; ?>

    <!-- Google Fonts (preconnect + display=swap) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Dancing+Script:400,700|Droid+Serif:400,400i,700,700i|Montserrat:400,700|Mr+De+Haviland|Open+Sans:300,400,600,700,800|Raleway:100,200,300,300i,400,400i,500,600,700,700i,800,900&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese&display=swap' type='text/css' media='all' />
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?ver=4.3.0' type='text/css' media='all' />
    <link rel='stylesheet' href='../js/vendor/tooltipster/tooltipster.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../js/vendor/tooltipster/tooltipster-light.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../js/vendor/essgrid/esg.settings.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../js/vendor/revslider/rev.settings.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/core.animation.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/instagram-widget.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../css/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/custom-style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/responsive.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/skin.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/custom.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../js/vendor/grid.layout/grid.layout.min.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../css/core.messages.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../js/vendor/isotope/core.portfolio.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../js/vendor/hotspot/style.min.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../js/vendor/swiper/swiper.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../js/vendor/essgrid/lightbox.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../css/plugins.css' type='text/css' media='print' onload="this.media='all'" />
    <link rel='stylesheet' href='../css/custom.min.css' type='text/css' media='all' />
    <?php if (!empty($extra_head_html)) echo $extra_head_html; ?>
    <style>
    .menu_main_wrap .menu_main_nav > li > a { padding-left: 0.8em !important; padding-right: 1em !important; }
    .menu_main_wrap .menu_main_nav > li.menu-item-has-children > a { padding-right: 1.8em !important; }
    </style>
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
                        <img src="../images/logo.png" class="logo_main" alt="Inner Dynamic Method" width="238" height="56">
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
                                    <li class="menu-item<?php echo ($current_page == 'inner-dynamic-coaching') ? ' current-menu-item' : ''; ?>"><a href="inner-dynamic-coaching.php">Inner Dynamic Coaching Method</a></li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_coaching_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Coaching</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'coaching') ? ' current-menu-item' : ''; ?>"><a href="coaching.php">About Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'coaching-gde-pravi-razliku') ? ' current-menu-item' : ''; ?>"><a href="coaching-making-a-difference.php">Where Coaching Makes a Difference</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'coaching-proces') ? ' current-menu-item' : ''; ?>"><a href="coaching-process.php">Coaching Process</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'business-coaching') ? ' current-menu-item' : ''; ?>"><a href="business-coaching.php">Business Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'sportski-coaching') ? ' current-menu-item' : ''; ?>"><a href="sports-coaching.php">Sports Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'life-coaching') ? ' current-menu-item' : ''; ?>"><a href="life-coaching.php">Life Coaching</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_wing_wave_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Wing Wave</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'wing-wave') ? ' current-menu-item' : ''; ?>"><a href="wing-wave.php">Wing Wave Emotional Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'wing-wave-sesija') ? ' current-menu-item' : ''; ?>"><a href="wing-wave-session.php">Wing Wave Session</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_poy_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Points of You</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'points-of-you') ? ' current-menu-item' : ''; ?>"><a href="points-of-you.php">Points of You Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'points-of-you-sesija') ? ' current-menu-item' : ''; ?>"><a href="points-of-you-session.php">Points of You Session</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'primena-points-of-you') ? ' current-menu-item' : ''; ?>"><a href="points-of-you-application.php">Applying Points of You</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_sfera_pages) ? ' current-menu-ancestor' : ''; ?>"><a>S.F.E.R.A. Mental Training</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'sfera-mentalni-trening') ? ' current-menu-item' : ''; ?>"><a href="sfera-mental-training.php">S.F.E.R.A. Mental Training</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'proces-sfera-mentalnog-treninga') ? ' current-menu-item' : ''; ?>"><a href="sfera-mental-training-process.php">S.F.E.R.A. Mental Training Process</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['o-meni','moj-pristup-radu','spoj-koji-pravi-razliku']) ? ' current-menu-ancestor' : ''; ?>"><a>About Me</a>
                                <ul class="sub-menu">
                                    <li class="menu-item<?php echo ($current_page == 'o-meni') ? ' current-menu-item' : ''; ?>"><a href="about-me.php">About Me</a></li>
                                    <li class="menu-item<?php echo ($current_page == 'moj-pristup-radu') ? ' current-menu-item' : ''; ?>"><a href="my-approach.php">My Approach</a></li>
                                    <li class="menu-item<?php echo ($current_page == 'spoj-koji-pravi-razliku') ? ' current-menu-item' : ''; ?>"><a href="the-connection.php">The Connection That Makes a Difference</a></li>
                                </ul>
                            </li>
                            <li class="menu-item<?php echo ($current_page == 'utisci') ? ' current-menu-item' : ''; ?>"><a href="testimonials.php">Testimonials</a></li>
                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['ponude','sportski-klubovi','kompanije','sportski-klubovi-coaching','sportski-klubovi-sfera','sportski-klubovi-poy','sportski-klubovi-wing-wave','kompanije-coaching','kompanije-sfera','kompanije-poy','kompanije-poy-ttt','kompanije-wing-wave']) ? ' current-menu-ancestor' : (($current_page == 'ponude') ? ' current-menu-item' : ''); ?>"><a>Offers</a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['sportski-klubovi','sportski-klubovi-coaching','sportski-klubovi-sfera','sportski-klubovi-poy','sportski-klubovi-wing-wave']) ? ' current-menu-ancestor' : (($current_page == 'sportski-klubovi') ? ' current-menu-item' : ''); ?>"><a>Sports Clubs</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'sportski-klubovi-coaching') ? ' current-menu-item' : ''; ?>"><a href="sports-clubs-coaching.php">Inner Dynamic Coaching Method</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'sportski-klubovi-sfera') ? ' current-menu-item' : ''; ?>"><a href="sports-clubs-sfera-mental-training.php">S.F.E.R.A. Mental Training</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'sportski-klubovi-poy') ? ' current-menu-item' : ''; ?>"><a href="sports-clubs-points-of-you.php">Points of You Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'sportski-klubovi-wing-wave') ? ' current-menu-item' : ''; ?>"><a href="sports-clubs-wing-wave.php">Wing Wave Coaching</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['kompanije','kompanije-coaching','kompanije-sfera','kompanije-poy','kompanije-poy-ttt','kompanije-wing-wave']) ? ' current-menu-ancestor' : (($current_page == 'kompanije') ? ' current-menu-item' : ''); ?>"><a>Companies</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'kompanije-coaching') ? ' current-menu-item' : ''; ?>"><a href="companies-coaching.php">Inner Dynamic Coaching Method</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'kompanije-sfera') ? ' current-menu-item' : ''; ?>"><a href="companies-sfera-mental-training.php">S.F.E.R.A. Mental Training</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'kompanije-poy') ? ' current-menu-item' : ''; ?>"><a href="companies-points-of-you.php">Points of You Coaching</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'kompanije-poy-ttt') ? ' current-menu-item' : ''; ?>"><a href="companies-points-of-you-train-the-trainer.php">Points of You Train the Trainer</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'kompanije-wing-wave') ? ' current-menu-item' : ''; ?>"><a href="companies-wing-wave.php">Wing Wave Coaching</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item<?php echo ($current_page == 'kontakt') ? ' current-menu-item' : ''; ?>"><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="panel_bottom" style="padding:16px 20px;display:flex;flex-direction:column;gap:16px;align-items:flex-start;">
                    <a href="https://www.bowencentar.rs" target="_blank" rel="noopener" style="display:inline-block;padding:6px 14px;background-color:#af3850;color:#fff;text-decoration:none;font-family:'Montserrat',sans-serif;font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;white-space:nowrap;line-height:1.4;">bowencentar.rs</a>
                    <div style="display:flex;align-items:center;gap:16px;">
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
                            <div class="sc_socials_item">
                                <a href="https://www.linkedin.com/in/danijela-maric-pavlovic-6a616459/" target="_blank" rel="noopener" class="social_icons social_linkedin" aria-label="LinkedIn">
                                    <span class="icon-linkedin"></span>
                                </a>
                            </div>
                        </div>
                        <div style="display:flex;gap:10px;align-items:center;">
                            <a href="<?php echo htmlspecialchars($lang_sr_url, ENT_QUOTES, 'UTF-8'); ?>" lang="sr" aria-label="Srpski" title="Srpski" style="display:inline-flex;align-items:center;">
                                <img src="../images/flags/sr.svg" alt="Srpski" width="20" height="14" style="display:block;border:1px solid rgba(0,0,0,.15);border-radius:2px;" />
                            </a>
                            <a href="<?php echo htmlspecialchars($lang_en_url, ENT_QUOTES, 'UTF-8'); ?>" lang="en" aria-label="English" title="English" style="display:inline-flex;align-items:center;">
                                <img src="../images/flags/en.svg" alt="English" width="20" height="14" style="display:block;border:1px solid rgba(0,0,0,.15);border-radius:2px;" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mask"></div>
        </div>
        <header class="top_panel_wrap top_panel_style_6 <?php echo isset($header_scheme) ? $header_scheme : 'scheme_dark'; ?>">
            <div class="top_panel_wrap_inner top_panel_inner_style_6 <?php echo isset($header_position) ? $header_position : 'top_panel_position_over'; ?>">
                <div class="top_panel_top">
                    <div class="content_wrap clearfix">
                        <div class="top_panel_top_contact_area">
                            <span class="contact_icon icon-mail"></span>
                            <a id="emlLink" href="#"><script>document.addEventListener('DOMContentLoaded',function(){var u='office',d='innerdynamiccoaching.rs',e=document.getElementById('emlLink');e.href='mailto:'+u+'@'+d;e.textContent=u+'@'+d;});</script></a>
                        </div>
                        <div class="top_panel_top_contact_area">
                            <span class="contact_icon icon-icon_phone"></span>
                            <a href="tel:0641112202">064 111 22 02</a>
                        </div>
                        <div class="top_panel_top_user_area">
                            <div class="lang_switch" style="display:flex;gap:10px;align-items:center;margin-left:40px;">
                                <a href="<?php echo htmlspecialchars($lang_sr_url, ENT_QUOTES, 'UTF-8'); ?>" lang="sr" aria-label="Srpski" title="Srpski" style="display:inline-flex;align-items:center;">
                                    <img src="../images/flags/sr.svg" alt="Srpski" width="20" height="14" style="display:block;border:1px solid rgba(0,0,0,.15);border-radius:2px;" />
                                </a>
                                <a href="<?php echo htmlspecialchars($lang_en_url, ENT_QUOTES, 'UTF-8'); ?>" lang="en" aria-label="English" title="English" style="display:inline-flex;align-items:center;">
                                    <img src="../images/flags/en.svg" alt="English" width="20" height="14" style="display:block;border:1px solid rgba(0,0,0,.15);border-radius:2px;" />
                                </a>
                            </div>
                        </div>
                        <div class="top_panel_top_socials">
                            <span class="label"> </span>
                            <a href="https://www.bowencentar.rs" target="_blank" rel="noopener" style="display:inline-block;vertical-align:middle;position:relative;top:-9px;margin-right:30px;padding:5px 12px;background-color:#af3850;color:#fff;text-decoration:none;font-family:'Montserrat',sans-serif;font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;white-space:nowrap;line-height:1.4;">bowencentar.rs</a>
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
                                <div class="sc_socials_item">
                                    <a href="https://www.linkedin.com/in/danijela-maric-pavlovic-6a616459/" target="_blank" rel="noopener" class="social_icons social_linkedin" aria-label="LinkedIn">
                                        <span class="icon-linkedin"></span>
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
                                    <img src="../images/logo.png" class="logo_main" alt="Inner Dynamic Method" width="238" height="56">
                                    <img src="../images/logo.png" class="logo_fixed" alt="Inner Dynamic Method" width="238" height="56">
                                </a>
                            </div>
                        </div>
                        <div class="menu_main_wrap">
                            <nav class="menu_main_nav_area">
                                <ul class="menu_main_nav">
                                    <li class="menu-item<?php echo ($current_page == 'home') ? ' current-menu-item' : ''; ?>"><a href="index.php">Home</a></li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_inner_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Inner Dynamic Method</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'inner-dynamic-coaching') ? ' current-menu-item' : ''; ?>"><a href="inner-dynamic-coaching.php">Inner Dynamic Coaching Method</a></li>
                                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_coaching_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Coaching</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item<?php echo ($current_page == 'coaching') ? ' current-menu-item' : ''; ?>"><a href="coaching.php">About Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'coaching-gde-pravi-razliku') ? ' current-menu-item' : ''; ?>"><a href="coaching-making-a-difference.php">Where Coaching Makes a Difference</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'coaching-proces') ? ' current-menu-item' : ''; ?>"><a href="coaching-process.php">Coaching Process</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'business-coaching') ? ' current-menu-item' : ''; ?>"><a href="business-coaching.php">Business Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'sportski-coaching') ? ' current-menu-item' : ''; ?>"><a href="sports-coaching.php">Sports Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'life-coaching') ? ' current-menu-item' : ''; ?>"><a href="life-coaching.php">Life Coaching</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_wing_wave_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Wing Wave</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item<?php echo ($current_page == 'wing-wave') ? ' current-menu-item' : ''; ?>"><a href="wing-wave.php">Wing Wave Emotional Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'wing-wave-sesija') ? ' current-menu-item' : ''; ?>"><a href="wing-wave-session.php">Wing Wave Session</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_poy_pages) ? ' current-menu-ancestor' : ''; ?>"><a>Points of You</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item<?php echo ($current_page == 'points-of-you') ? ' current-menu-item' : ''; ?>"><a href="points-of-you.php">Points of You Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'points-of-you-sesija') ? ' current-menu-item' : ''; ?>"><a href="points-of-you-session.php">Points of You Session</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'primena-points-of-you') ? ' current-menu-item' : ''; ?>"><a href="points-of-you-application.php">Applying Points of You</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, $_sfera_pages) ? ' current-menu-ancestor' : ''; ?>"><a>S.F.E.R.A. Mental Training</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'sfera-mentalni-trening') ? ' current-menu-item' : ''; ?>"><a href="sfera-mental-training.php">S.F.E.R.A. Mental Training</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'proces-sfera-mentalnog-treninga') ? ' current-menu-item' : ''; ?>"><a href="sfera-mental-training-process.php">S.F.E.R.A. Mental Training Process</a></li>
                                        </ul>
                                    </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['o-meni','moj-pristup-radu','spoj-koji-pravi-razliku']) ? ' current-menu-ancestor' : ''; ?>"><a>About Me</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item<?php echo ($current_page == 'o-meni') ? ' current-menu-item' : ''; ?>"><a href="about-me.php">About Me</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'moj-pristup-radu') ? ' current-menu-item' : ''; ?>"><a href="my-approach.php">My Approach</a></li>
                                            <li class="menu-item<?php echo ($current_page == 'spoj-koji-pravi-razliku') ? ' current-menu-item' : ''; ?>"><a href="the-connection.php">The Connection That Makes a Difference</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item<?php echo ($current_page == 'utisci') ? ' current-menu-item' : ''; ?>"><a href="testimonials.php">Testimonials</a></li>
                                    <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['ponude','sportski-klubovi','kompanije','sportski-klubovi-coaching','sportski-klubovi-sfera','sportski-klubovi-poy','sportski-klubovi-wing-wave','kompanije-coaching','kompanije-sfera','kompanije-poy','kompanije-poy-ttt','kompanije-wing-wave']) ? ' current-menu-ancestor' : (($current_page == 'ponude') ? ' current-menu-item' : ''); ?>"><a>Offers</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['sportski-klubovi','sportski-klubovi-coaching','sportski-klubovi-sfera','sportski-klubovi-poy','sportski-klubovi-wing-wave']) ? ' current-menu-ancestor' : (($current_page == 'sportski-klubovi') ? ' current-menu-item' : ''); ?>"><a>Sports Clubs</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item<?php echo ($current_page == 'sportski-klubovi-coaching') ? ' current-menu-item' : ''; ?>"><a href="sports-clubs-coaching.php">Inner Dynamic Coaching Method</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'sportski-klubovi-sfera') ? ' current-menu-item' : ''; ?>"><a href="sports-clubs-sfera-mental-training.php">S.F.E.R.A. Mental Training</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'sportski-klubovi-poy') ? ' current-menu-item' : ''; ?>"><a href="sports-clubs-points-of-you.php">Points of You Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'sportski-klubovi-wing-wave') ? ' current-menu-item' : ''; ?>"><a href="sports-clubs-wing-wave.php">Wing Wave Coaching</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children<?php echo in_array($current_page, ['kompanije','kompanije-coaching','kompanije-sfera','kompanije-poy','kompanije-poy-ttt','kompanije-wing-wave']) ? ' current-menu-ancestor' : (($current_page == 'kompanije') ? ' current-menu-item' : ''); ?>"><a>Companies</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item<?php echo ($current_page == 'kompanije-coaching') ? ' current-menu-item' : ''; ?>"><a href="companies-coaching.php">Inner Dynamic Coaching Method</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'kompanije-sfera') ? ' current-menu-item' : ''; ?>"><a href="companies-sfera-mental-training.php">S.F.E.R.A. Mental Training</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'kompanije-poy') ? ' current-menu-item' : ''; ?>"><a href="companies-points-of-you.php">Points of You Coaching</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'kompanije-poy-ttt') ? ' current-menu-item' : ''; ?>"><a href="companies-points-of-you-train-the-trainer.php">Points of You Train the Trainer</a></li>
                                                    <li class="menu-item<?php echo ($current_page == 'kompanije-wing-wave') ? ' current-menu-item' : ''; ?>"><a href="companies-wing-wave.php">Wing Wave Coaching</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item<?php echo ($current_page == 'kontakt') ? ' current-menu-item' : ''; ?>"><a href="contact.php">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
