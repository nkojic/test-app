<?php
$meta_description = '';
$page_title       = 'Zaleđenost - Freez mod | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';

$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Zaleđenost - Freez mod';

$featured_image     = 'images/zaledjenost-freez-mod.webp';
$featured_image_alt = 'Zaleđenost - Freez mod';
$page_hero_bg       = 'images/hero.webp';

$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_en_url     = '/en/freeze-mode.php';

include 'includes/header.php';
?>
        <!-- Hero banner commented out for now
        <section class="top_panel_image"<?php if (!empty($page_hero_bg)) echo ' style="background-image:url(' . $page_hero_bg . ');"'; ?>>
            <div class="top_panel_image_hover"></div>
            <div class="top_panel_image_header">
                <div class="top_panel_image_icon <?php echo $page_hero_icon; ?>"></div>
                <h1 class="top_panel_image_title entry-title"><?php echo htmlspecialchars($page_hero_title); ?></h1>
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
                            <!-- PAGE CONTENT — edit only this section                        -->
                            <!-- ============================================================ -->

                            <p>Postoji trenutak kad je jasno da je promena neophodna, ali ostajemo nepokretni. Znate šta želite. Znate šta treba da uradite, ali telo ne prati.
Bez vidljivog razloga i bez energije, kao da smo "zaglavljeni" između onoga što je jasno i onoga što se ne događa. Sve stoji u mestu i pored svake namere da se pokrenemo i krenemo dalje. Tada se, često, javlja dodatni pritisak nemoći i straha. Nižu se pitanja: "Zašto ne mogu?" "Šta nije u redu samnom?" "Zašto stojim kad je sve jasno?"</p>
                            <p>To nije slabost. Nije ni nedostatak volje.</p>
                            <p>To je način na koji nas naše nesvesno "štiti".</p>
                            <p>Kad je nečeg previše ili je preintenzivno, telo bira da stane i ne reaguje. Da se "zamrzne". Uspori da bi sačuvalo energiju. Čeka da opasnost prođe.</p>
                            <p>Nesvesno nas drži na sigurnom mestu. To je naš odbrambeni mehanizam i to je dobro.</p>
                            <p>Međutim, nekada taj obrazac ostane i kada više nema opasnosti ili kada je nije ni bilo, ali se našem nesvesnom učinilo da jeste.</p>
                            <p>Pokušaju da se "pogurate" ne daju rezultate. Ono što je neophodno da se desi nije primena discipline, nego razumevanje. Prepoznavanje šta se dešava ispod površine.</p>
                            <p>Kad razumemo i otpustimo taj unutrašnji zastoj, pokrećemo se prirodno i bez napora.</p>
                            <p>Telu se vraća sigurnost i kontakt sa sobom. Pokret se vraća. Energija počinje da teče. Koraci više nisu teški.</p>
                            <p>Ako osećate da ste negde "zaglavljeni", ne morate sami da tražite izlaz.</p>

                            <!-- ============================================================ -->
                            <!-- END OF CONTENT                                              -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
