<?php
header("HTTP/1.0 404 Not Found");

$meta_description = '';  // TODO: SEO opis stranice
$page_title      = 'Stranica nije pronađena | Inner Dynamic Method';
$body_class      = 'singlepost page body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page    = '';
$page_hero_icon  = 'icon-attention';
$page_hero_title = 'Stranica nije pronađena';
$page_hero_bg    = 'images/1170x700.jpg';
$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
include 'includes/header.php';
?>
        <section class="top_panel_image" style="background-image:url(<?php echo $page_hero_bg; ?>);">
            <div class="top_panel_image_hover"></div>
            <div class="top_panel_image_header">
                <div class="top_panel_image_icon <?php echo $page_hero_icon; ?>"></div>
                <p class="top_panel_image_title entry-title"><?php echo htmlspecialchars($page_hero_title); ?></p>
            </div>
        </section>
        <div class="page_content_wrap page_paddings_yes">
            <div class="content_wrap">
                <div class="content">
                    <article class="post post_item_single">
                        <section class="post_content" style="text-align:center; padding: 3em 0;">
                            <h2 style="font-size:6em; margin:0; color:#f9a392;">404</h2>
                            <h3>Na žalost, ova stranica nije pronađena.</h3>
                            <p>Stranica koju tražite ne postoji ili je premeštena.</p>
                            <div style="margin:1.5em 0;">
                                <img src="images/404.jpg" alt="Stranica nije pronađena" style="max-width:300px;">
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
