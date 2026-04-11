<?php
$meta_description = 'S.F.E.R.A. Mental Training for sports clubs – Inner Dynamic Method. Systematic approach to developing mental skills in athletes.';
$page_title       = 'S.F.E.R.A. Mental Training for Sports Clubs | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'sportski-klubovi-sfera';
$page_hero_icon   = 'icon-star';
$page_hero_title  = 'S.F.E.R.A. Mental Training';
$featured_image     = '';
$featured_image_alt = '';
$page_hero_bg       = '../images/hero.webp';
$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_sr_url     = '/sportski-klubovi-sfera-mentalni-trening.php';
include '../includes/en-header.php';
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
                            <p>Page under construction.</p>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
