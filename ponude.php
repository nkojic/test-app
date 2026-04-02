<?php
$meta_description = '';  // TODO: SEO opis stranice
$page_title       = 'Ponude | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'ponude';
$page_hero_icon   = 'icon-star';
$page_hero_title  = 'Ponude';
$featured_image     = '';
$featured_image_alt = '';
$page_hero_bg       = 'images/1170x700.jpg';
$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_en_url      = '/en/offers.php';
include 'includes/header.php';
?>
        <section class="top_panel_image"<?php if (!empty($page_hero_bg)) echo ' style="background-image:url(' . $page_hero_bg . ');"'; ?>>
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
                        <section class="post_content">
                            <h1 class="post_title entry-title">
                                <span class="post_icon <?php echo $page_hero_icon; ?>"></span>
                                <?php echo htmlspecialchars($page_hero_title); ?>
                            </h1>
                            <p>Sadržaj stranice "Ponude" — biće dodat naknadno.</p>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
