<?php
$meta_description = '';  // TODO: SEO opis stranice
$page_title       = 'O Coachingu | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'coaching';
$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'O Coachingu';
$featured_image     = '';
$featured_image_alt = '';
$page_hero_bg       = 'images/1170x700.jpg';
$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_en_url      = '/en/coaching.php';
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
                            <p>Coaching – prostor u kom počinju prave promene</p>
                            <p>Postoje trenuci u životu kada znamo da želimo promenu, ali ne znamo tačno odakle da krenemo. Ponekad imamo mnogo ideja, ali nedostaje jasnoća. Nekada osećamo da možemo više, ali nas nešto iznutra zaustavlja.</p>
                            <p>Upravo tu coaching ima svoju najveću vrednost.</p>
                            <p>Coaching je proces koji pomaže ljudima da jasnije sagledaju sebe, svoje misli, emocije i potencijale – i da pronađu sopstvena rešenja za izazove sa kojima se suočavaju.</p>
                            <p>To je strukturisan, ali istovremeno vrlo ličan proces razgovora, istraživanja i uvida koji vodi ka promeni.</p>
                            <p>Za razliku od saveta ili gotovih rešenja, coaching polazi od ideje da svaka osoba već u sebi ima odgovore i resurse – ponekad je potrebno samo pravo pitanje ili metoda da ih otkrijemo.</p>
                            <p>✨ Ako osećate da je vreme za sledeći korak u vašem životu ili karijeri, coaching može biti početak te promene.</p>
                            <p>Zakažite svoju sesiju i napravite prvi korak ka onome što želite.</p>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
