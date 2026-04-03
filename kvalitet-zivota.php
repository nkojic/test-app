<?php
$meta_description = '';
$page_title       = 'Kvalitet života | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';
$lang_en_url      = '/en/quality-of-life.php';

$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Kvalitet života';

$featured_image     = 'images/kvalitet-zivotav.webp';
$featured_image_alt = 'Kvalitet života';
$page_hero_bg       = 'images/hero.webp';

$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';

include 'includes/header.php';
?>
        <!-- Hero baner zakomentarisan za sada
        <section class="top_panel_image"<?php if (!empty($page_hero_bg)) echo ' style="background-image:url(' . $page_hero_bg . ');"'; ?>>
            <div class="top_panel_image_hover"></div>
            <div class="top_panel_image_header">
                <div class="top_panel_image_icon <?php echo $page_hero_icon; ?>"></div>
                <p class="top_panel_image_title entry-title"><?php echo htmlspecialchars($page_hero_title); ?></p>
            </div>
        </section>
        -->
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

                            <p>Tokom godina rada sa ljudima, pacijentima i klijentima, a, bogami, i rada na sebi, došla sam do mnogih istina.</p>

                            <p>Jedna od njih, možda i najznačajnija, je da smo "prevareni" programima starenja, što se tiče funkcionalnosti tela, uma i duha.</p>

                            <p>Postoje sporadični slučajevi koji nam direktno pokazuju da uverenja koja imamo o starenju nisu tačna. To su ljudi koji su prevazišli kolektivni mindset i, što se kaže, prešli igricu.</p>

                            <p>Jednom mi je stara tatina prijateljica u svojim osamdesetim godinama, rekla: "Znaš, mi ne starimo, samo naše telo stari."</p>

                            <p>Kada malo zastanete i sklonite naučena uverenja i programe, doćićete do svojih želja i nadanja sa svojih, recimo 15,16 godina. Videćete da se, u suštini, nisu mnogo promenila. To ste Vi. Ono što se u međuvremenu desilo je da su te krute "istine" da je život ozbiljna stvar, da morate da budete odgovorni, da ispunite očekivanja koja se postavljaju pred Vas kao odraslog čoveka, postale Vaš život. I tako, polako, postajete sve nefleksibilniji u svakom pogledu. Nezrelo je da izađete u grad i plešete celu noć, ne trči se po ulici, ne dovikuje se, ne smeje se glasno, nije primereno pokazivati emocije u javnosti, osim, nekada da ukažeš na nečije "nezrelo" i "nevaspitano" ponašanje.</p>

                            <p>I, tako, idete kroz život, prolazi vreme. Vaši naučeni kruti stavovi i ne korišćenje mišićnih i koštanih struktura, dovode do krutosti na svom nivoima. I fizičkom i mentalnom i emotivnomo. Čak i izraz Vašeg lica i bore odaju istu sliku.</p>

                            <p>Naravno, tokom godina krenete da krivite život, genetiku, "starenje"… tako je mnogo lakše. I stopite se sa masom… uklopite se. Ako neko iskoči iz šablona, obično je obeležen da je neozbiljan i neodgovoran. Da se ponaša neprimerno svojim godinama, šta god to značilo. Sećate se madosti. Rado bi se vratili u nju.. da možete.
                            E, pa, može. Toliko malo je potrebno. Naše telo i naš um imaju ogromnu moć prilagođavanja. Iskoristite to. Uz male promene u svojim dnevnim rutinama možete mnogo da dobijete. Kvalitet života, na svakom nivou, se popravlja. Život dobija potpuno drugu, fenomenalnu, dimenziju. Ili možete ostati u kolotečini. Žaliti se i kriviti šta god i koga god do kraja života. Vi birate!</p>

                            <p>Ako Vam je potrebna pomoć da se pokrenete. Ako nemate ideje odakle bi počeli. Ako ne znate šta sve možete da uradite. Ja sam tu da pomognem. Lako je!</p>

                            <!-- ============================================================ -->
                            <!-- KRAJ SADRŽAJA                                               -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
