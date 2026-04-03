<?php
// -------------------------------------------------------
// Promeniti za svaku stranicu:
// -------------------------------------------------------
$meta_description = '';  // TODO: SEO opis stranice
$page_title       = 'Naziv stranice | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';           // vrednosti: 'home', 'coaching', 'coaching-gde-pravi-razliku', 'coaching-proces', 'business-coaching', 'sportski-coaching', 'life-coaching', 'wing-wave', 'wing-wave-sesija', 'points-of-you', 'points-of-you-sesija', 'primena-points-of-you', 'o-meni', 'utisci', 'ponude', 'kontakt'

$page_hero_icon   = 'icon-book-open';  // fontello ikona za hero baner
$page_hero_title  = 'Naziv stranice';  // naslov u hero baneru

$featured_image     = '';         // putanja do slike, npr. 'images/slika.jpg' — ostaviti prazno ako nema
$featured_image_alt = '';         // alt tekst za featured sliku
$page_hero_bg       = 'images/hero.webp'; // pozadinska slika hero banera
// -------------------------------------------------------
$header_scheme   = 'scheme_original';        // scheme_dark za home (over slider), scheme_original za unutrašnje
$header_position = 'top_panel_position_above'; // top_panel_position_over za home, top_panel_position_above za unutrašnje

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
                        <?php if ($featured_image): ?>
                        <section class="post_featured">
                            <div class="post_thumb">
                                <img width="600" alt="<?php echo htmlspecialchars($featured_image_alt); ?>" src="<?php echo $featured_image; ?>">
                            </div>
                        </section>
                        <?php endif; ?>
                        <section class="post_content">
                            <h1 class="post_title entry-title">
                                <span class="post_icon <?php echo $page_hero_icon; ?>"></span>
                                <?php echo htmlspecialchars($page_hero_title); ?>
                            </h1>

                            <!-- ============================================================ -->
                            <!-- SADRŽAJ STRANICE — menjati samo ovaj deo                    -->
                            <!-- ============================================================ -->

                            <p>Ovde ide sadržaj stranice.</p>

                            <!-- ============================================================ -->
                            <!-- KRAJ SADRŽAJA                                               -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
