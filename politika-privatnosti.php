<?php
$meta_description = '';  // TODO: SEO opis stranice
$page_title       = 'Politika privatnosti | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'politika-privatnosti';
$page_hero_icon   = 'icon-lock';
$page_hero_title  = 'Politika privatnosti';
$page_hero_bg     = 'images/1170x700.jpg';
$header_scheme    = 'scheme_original';
$header_position  = 'top_panel_position_above';
$lang_en_url      = '/en/privacy-policy.php';
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

                            <p><strong>Poslednje ažuriranje:</strong> 15.01.2026.</p>

                            <p>Vaša privatnost nam je važna. Ova Politika privatnosti objašnjava koje podatke prikupljamo, na koji način ih koristimo i kako ih štitimo kada koristite ovaj veb-sajt.</p>

                            <h3>1. Koje podatke možemo prikupljati</h3>
                            <p>U zavisnosti od načina korišćenja sajta, možemo prikupljati:</p>
                            <ul>
                                <li><strong>Podatke koje dobrovoljno dostavite</strong> (npr. ime, e-mail adresa i sadržaj poruke putem kontakt forme)</li>
                                <li><strong>Tehničke podatke</strong> (npr. IP adresa, tip pregledača, jezik pregledača, operativni sistem, tip uređaja)</li>
                                <li><strong>Podatke o korišćenju sajta</strong> (npr. posećene stranice, vreme zadržavanja, približna lokacija na nivou grada/regiona – ukoliko je dostupno kroz analitiku)</li>
                            </ul>

                            <h3>2. U koje svrhe koristimo podatke</h3>
                            <p>Prikupljene podatke koristimo isključivo u legitimne svrhe, kao što su:</p>
                            <ul>
                                <li>odgovaranje na vaše upite i komunikacija putem kontakt forme</li>
                                <li>unapređenje sadržaja, funkcionalnosti i korisničkog iskustva</li>
                                <li>održavanje bezbednosti sajta i sprečavanje zloupotreba</li>
                                <li>osnovna statistika poseta (analitika)</li>
                            </ul>

                            <p><strong>Ne prodajemo, ne iznajmljujemo i ne trgujemo</strong> vašim ličnim podacima.</p>

                            <h3>3. Kolačići (Cookies)</h3>
                            <p>Sajt može koristiti kolačiće kako bi obezbedio pravilno funkcionisanje, zapamtio određene postavke ili prikupio anonimnu statistiku poseta.</p>
                            <p>Kolačiće možete u svakom trenutku obrisati ili onemogućiti u podešavanjima svog internet pregledača. Imajte u vidu da onemogućavanje kolačića može uticati na funkcionalnost određenih delova sajta.</p>

                            <h3>4. Treće strane i analitički servisi</h3>
                            <p>Možemo koristiti pouzdane servise trećih strana (npr. analitičke alate) koji obrađuju ograničene tehničke podatke u skladu sa sopstvenim politikama privatnosti. Ti servisi mogu koristiti kolačiće ili slične tehnologije.</p>

                            <h3>5. Bezbednost podataka</h3>
                            <p>Preduzimamo razumne tehničke i organizacione mere zaštite kako bismo umanjili rizik od neovlašćenog pristupa, gubitka ili zloupotrebe podataka. Ipak, nijedan prenos podataka putem interneta ne može biti 100% bezbedan.</p>

                            <h3>6. Koliko dugo čuvamo podatke</h3>
                            <p>Podatke čuvamo onoliko dugo koliko je potrebno za ostvarenje svrhe zbog koje su prikupljeni, osim ako zakon ne zahteva duže čuvanje.</p>

                            <h3>7. Prava korisnika</h3>
                            <p>U skladu sa važećim propisima, imate pravo da:</p>
                            <ul>
                                <li>zatražite informaciju da li obrađujemo vaše lične podatke</li>
                                <li>zatražite ispravku netačnih podataka</li>
                                <li>zatražite brisanje podataka, kada je to primenljivo</li>
                                <li>povučete saglasnost, kada je obrada zasnovana na saglasnosti</li>
                            </ul>

                            <h3>8. Izmene politike privatnosti</h3>
                            <p>Zadržavamo pravo da povremeno ažuriramo ovu Politiku privatnosti. Sve izmene biće objavljene na ovoj stranici uz ažuriran datum.</p>

                            <h3>9. Kontakt</h3>
                            <p>Ako imate pitanja u vezi sa ovom Politikom privatnosti, molimo vas da nas kontaktirate putem <a href="kontakt.php">kontakt forme</a> na sajtu.</p>

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
