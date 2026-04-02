<?php
// /includes/head.php

// Page vars (set in each page)
$page_title = $page_title ?? 'Bowen centar';
$page_description = $page_description ?? '';
$page_keywords = $page_keywords ?? 'Bowen, terapija, bol, stres';

// Optional (set per page if needed)
$preload_image = $preload_image ?? null; // e.g. "/images/stres.webp"
$canonical_url = $canonical_url ?? null; // e.g. "https://bowencentar.rs/index.php"

// Safety
function e($str) {
  return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title><?= e($page_title) ?></title>
<meta name="description" content="<?= e($page_description) ?>">
<meta name="keywords" content="<?= e($page_keywords) ?>">
<meta name="author" content="Danijela Marić Pavlović">

<?php if ($canonical_url): ?>
<link rel="canonical" href="<?= e($canonical_url) ?>">
<?php endif; ?>

<link rel="icon" type="image/png" sizes="32x32" href="/images/fav.png">

<?php if ($preload_image): ?>
<link rel="preload" as="image" href="<?= e($preload_image) ?>" fetchpriority="high" imagesrcset="<?= e($preload_image) ?> 1920w" imagesizes="100vw">
<?php endif; ?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5HK5X5PZ31"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-5HK5X5PZ31');
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i|Montserrat:400,700|Mr+De+Haviland|Open+Sans:300,400,600,700,800|Raleway:100,200,300,300i,400,400i,500,600,700,700i,800,900&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese&amp;display=swap"
      type="text/css" media="all" />

<link rel="stylesheet" href="/css/admin_icon.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?ver=4.3.0" type="text/css" media="all" />
<link rel="stylesheet" href="/js/vendor/essgrid/esg.settings.css" type="text/css" media="all" />
<link rel="stylesheet" href="/js/vendor/revslider/rev.settings.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/fontello/css/fontello.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/core.animation.css" type="text/css" media="all" />

<link rel="stylesheet" href="/css/shortcodes.css" type="text/css" media="all" />
<noscript><link rel="stylesheet" href="/css/shortcodes.css"></noscript>

<link rel="stylesheet" href="/js/vendor/booked/booked.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/instagram-widget.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/skin.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/custom-style.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/responsive.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/skin.responsive.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/custom.responsive.css" type="text/css" media="all" />
<link rel="stylesheet" href="/js/vendor/grid.layout/grid.layout.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/core.messages.css" type="text/css" media="all" />
<link rel="stylesheet" href="/js/vendor/swiper/swiper.css" type="text/css" media="all" />

<link rel="stylesheet" href="/js/vendor/essgrid/lightbox.css" type="text/css" media="all" />
<noscript><link rel="stylesheet" href="/js/vendor/essgrid/lightbox.css"></noscript>

<link rel="stylesheet" href="/css/plugins.css" type="text/css" media="all" />
<noscript><link rel="stylesheet" href="/css/plugins.css"></noscript>

<link rel="stylesheet" href="/css/custom.css" type="text/css" media="all" />
<?php //include __DIR__ . '/schema_localbusiness.php'; ?>
<?php
$schemaFile = __DIR__ . '/schema_localbusiness.php';
if (is_file($schemaFile)) {
  echo "\n<!-- SCHEMA_OK: $schemaFile -->\n";
  include $schemaFile;
} else {
  echo "\n<!-- SCHEMA_MISSING: $schemaFile -->\n";
}
?>