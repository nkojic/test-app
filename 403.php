<?php
header("HTTP/1.0 403 Forbidden");

$meta_description = '';
$meta_robots     = 'noindex, nofollow';
$page_title      = 'Pristup zabranjen | Inner Dynamic Method';
$body_class      = 'singlepost page body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page    = '';
$page_hero_icon  = 'icon-lock';
$page_hero_title = 'Pristup zabranjen';
$page_hero_bg    = 'images/hero.webp';
$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
include 'includes/header.php';
?>
        <section class="top_panel_image" style="background-image:url(<?php echo $page_hero_bg; ?>);">
            <div class="top_panel_image_hover"></div>
            <div class="top_panel_image_header">
                <div class="top_panel_image_icon <?php echo $page_hero_icon; ?>"></div>
                <h1 class="top_panel_image_title entry-title"><?php echo htmlspecialchars($page_hero_title); ?></h1>
            </div>
        </section>
        <div class="page_content_wrap page_paddings_yes">
            <div class="content_wrap">
                <div class="content">
                    <article class="post post_item_single">
                        <section class="post_content" style="text-align:center; padding: 3em 0;">
                            <h2 style="font-size:6em; margin:0; color:#af3850;">403</h2>
                            <h3>Pristup ovoj stranici je zabranjen.</h3>
                            <p>Nemate dozvolu za pristup ovom resursu.</p>
                            <div style="margin:1.5em 0;">
                                <img loading="lazy" src="images/404.jpg" alt="Pristup zabranjen" style="max-width:300px;">
                            </div>
                            <div style="margin-top:1.5em;">
                                <a href="index.php" class="sc_button sc_button_style_filled sc_button_size_medium">
                                    <span class="overlay"><span class="first">Nazad na početnu</span><span class="second">Nazad na početnu</span></span>
                                </a>
                            </div>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
