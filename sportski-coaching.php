<?php
$meta_description = 'Sportski coaching za razvoj mentalne snage, samopouzdanja i fokusa. Pomažemo sportistima da prevaziđu blokade, upravljaju pritiskom i ostvare vrhunske performanse.';
$meta_keywords    = 'sportski coaching, mentalna priprema, sportske performanse, fokus, samopouzdanje, strah od greške';
$page_title       = 'Sportski Coaching | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'sportski-coaching';
$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Sportski Coaching';
$featured_image     = '';
$featured_image_alt = '';
$page_hero_bg       = 'images/hero.webp';
$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_en_url      = '/en/sports-coaching.php';
$page_schema = '<script type="application/ld+json">{"@context":"https://schema.org","@type":"Service","name":"Sportski Coaching","description":"Sportski coaching za razvoj mentalne snage, samopouzdanja i fokusa sportista.","provider":{"@type":"ProfessionalService","name":"Inner Dynamic Method","url":"https://innerdynamicmethod.rs"},"serviceType":"Sports Coaching","areaServed":{"@type":"Country","name":"Serbia"},"url":"https://innerdynamicmethod.rs/sportski-coaching.php"}</script>';
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
                            <p>Sportski coaching</p>
                            <p>Mentalna snaga koja pravi razliku</p>
                            <p>U vrhunskom sportu razlika između dobrog i izuzetnog rezultata često nije samo u fizičkoj spremi – već u mentalnoj snazi.</p>
                            <p>Sportisti se suočavaju sa pritiskom rezultata, očekivanjima okoline, strahom od greške i potrebom da u ključnim trenucima ostanu fokusirani i stabilni.</p>
                            <p>Sportski coaching pomaže sportistima da razviju mentalnu stabilnost, samopouzdanje i fokus koji su neophodni za vrhunske performanse.</p>
                            <h2>Kroz coaching proces sportisti uče kako da:</h2>
                            <ul>
                                <li>upravljaju stresom i pritiskom takmičenja</li>
                                <li>prevaziđu blokade i strah od neuspeha</li>
                                <li>razviju samopouzdanje</li>
                                <li>poboljšaju koncentraciju i fokus</li>
                                <li>izgrade stabilan mentalni pristup treningu i takmičenju</li>
                            </ul>
                            <p>Sportski coaching se koristi kako u individualnim sportovima, tako i u timskim sportovima, kao podrška sportistima na različitim nivoima razvoja.</p>
                            <p>Često je upravo mentalna priprema ono što pomaže sportisti da u ključnom trenutku ostvari svoj puni potencijal.</p>
                            <p>✨ Ako želite da razvijete mentalnu snagu i stabilnost u sportu, zakažite sportski coaching.</p>
                            <h2>Pročitajte i</h2>
                            <ul>
                                <li><a href="/coaching.php">O coachingu</a></li>
                                <li><a href="/sportski-klubovi.php">Saradnja sa sportskim klubovima</a></li>
                                <li><a href="/wing-wave.php">Wingwave® coaching emocija</a></li>
                            </ul>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
