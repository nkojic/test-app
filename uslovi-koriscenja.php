<?php
$page_title       = 'Uslovi korišćenja | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'uslovi-koriscenja';
$page_hero_icon   = 'icon-doc-text';
$page_hero_title  = 'Uslovi korišćenja';
$page_hero_bg     = 'images/1170x700.jpg';
$header_scheme    = 'scheme_original';
$header_position  = 'top_panel_position_above';
$lang_en_url      = '/en/terms-of-use.php';
include 'includes/header.php';
?>
        <section class="top_panel_image"<?php if (!empty($page_hero_bg)) echo ' style="background-image:url(' . $page_hero_bg . ');"'; ?>>
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
                        <section class="post_content">
                            <h1 class="post_title entry-title">
                                <span class="post_icon <?php echo $page_hero_icon; ?>"></span>
                                <?php echo htmlspecialchars($page_hero_title); ?>
                            </h1>

                            <p><strong>Poslednje ažuriranje:</strong> 15.01.2026.</p>

                            <p>Sadržaj ovog veb-sajta namenjen je isključivo informativnim i edukativnim svrhama.
                            Informacije objavljene na sajtu ne predstavljaju medicinski savet, dijagnozu niti terapiju
                            i ne mogu zameniti savet kvalifikovanog zdravstvenog radnika.</p>

                            <h3>1. Korišćenje sadržaja</h3>
                            <p>Sav sadržaj na sajtu (tekstovi, slike, grafika i drugi materijali) zaštićen je propisima
                            o autorskim i srodnim pravima. Dozvoljeno je korišćenje sadržaja isključivo u lične,
                            nekomercijalne svrhe.</p>

                            <h3>2. Zabranjene radnje</h3>
                            <ul>
                                <li>Neovlašćeno kopiranje, distribucija ili izmena sadržaja</li>
                                <li>Korišćenje sadržaja u komercijalne svrhe bez saglasnosti vlasnika sajta</li>
                                <li>Zloupotreba sajta ili pokušaj neovlašćenog pristupa</li>
                            </ul>

                            <h3>3. Ograničenje odgovornosti</h3>
                            <p>Vlasnik sajta ne snosi odgovornost za eventualnu štetu nastalu korišćenjem ili
                            oslanjanjem na informacije dostupne na sajtu, kao ni za privremenu nedostupnost
                            ili tehničke probleme.</p>

                            <h3>4. Spoljni linkovi</h3>
                            <p>Sajt može sadržati linkove ka drugim veb-sajtovima. Ne snosimo odgovornost
                            za njihov sadržaj, politike privatnosti ili praksu.</p>

                            <h3>5. Izmene uslova</h3>
                            <p>Zadržavamo pravo izmene ovih uslova u bilo kom trenutku. Nastavak korišćenja
                            sajta nakon izmena smatra se prihvatanjem novih uslova.</p>

                            <h3>6. Merodavno pravo</h3>
                            <p>Ovi uslovi korišćenja uređeni su u skladu sa zakonima Republike Srbije.</p>

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
