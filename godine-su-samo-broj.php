<?php
$meta_description = '';
$page_title       = 'Godine su samo broj | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';

$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Godine su samo broj';

$featured_image     = 'images/godine-su-samo-brojv.webp';
$featured_image_alt = 'Godine su samo broj';
$page_hero_bg       = 'images/1170x700.jpg';

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

                            <p>Negde sam pročitala: "Ne veruje svemu što misliš." Pazite, ovaj tekst će Vas dovesti do ozbiljnih preispitivanja svega što ste do sada mislili i u šta ste verovali.
                            Često volim da kažem da su godine samo broj. Ja ih ne osećam i nikada nisam imala neki poseban stav po pitanju starenja. Viđam ljude u pedesetim godinama koji smatraju da su u dubokoj starosti, tako se ponašaju, a, često tako i izgledaju. S'druge strane, dolaze mi osobe u sedamdesetim, vitalne, pune života. Ono što razlikuje jedne od drugih je njihov mindset.</p>

                            <p>Mogli bi reći da mnogo toga zavisi od genske predispozicije. Ipak, danas su nam poznati principi epigenetike. Dokazano je da se samo 5% genetskog materijala manifestuje, dok će mogućnost manifestacije preostalih 95% zavisiti od raznih spoljašnjih faktora. Pored uslova u kojima živimo, ishrane, fizičke aktivnosti, načina na koji živimo, količine stresa i stresogenih faktora, jedan od najbitnijih, često zapostavljen su naše misli. One kreiraju naše emocije koje utiču na naš biohemijski status. Dolazi do smanjenog ili povećanog lučenja hormona, neurotransmitera što, u krajnjem ishodu, dovodi do promena na fizičkom nivou.</p>

                            <p>Sve to podržava teoriju da ono što mislimo, to nam je. Ako mislimo da smo stari, stari smo. Ako mislimo da smo bolesni, ako i nismo, bićemo ubrzo. Ako mislimo da je život gotov, gotov je za nas. Možda nećemo umreti, ali ćemo životariti do kraja života, a to mu dođe na isto.</p>

                            <p>Moj savet: Uzmite, što pre, život u svoje ruke. Oslobodite se predrasuda i programa koji Vam ne služe. Upoznajte, ponovo, sebe, onu autentičnu stranu, setite se ko ste. I pokrenite se u pravcu svojih želja, svojih nadanja, svog cora. Budite ono što jeste i što ste oduvek bili. To je jedini način da budete srećni.</p>

                            <p>Ako Vam treba pomoć, nije teško zatražiti je. Ja sam tu. Biće mi zadovoljstvo da učestvujem u Vašoj promeni. Programi su spremni!</p>

                            <!-- ============================================================ -->
                            <!-- KRAJ SADRŽAJA                                               -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
