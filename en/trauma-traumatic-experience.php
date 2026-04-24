<?php
$meta_description = '';
$page_title       = 'Trauma – Traumatic Experience | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';

$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Trauma – Traumatic Experience';

$featured_image     = '../images/trauma-traumaticno-iskustvo.webp';
$featured_image_alt = 'Trauma – Traumatic experience';
$page_hero_bg       = '../images/hero.webp';

$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_sr_url     = '/trauma-traumaticno-iskustvo.php';

include '../includes/en-header.php';
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
                                <img width="600" loading="lazy" alt="<?php echo htmlspecialchars($featured_image_alt); ?>" src="<?php echo $featured_image; ?>">
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

                            <p>Some experiences do not stay behind us. They remain in our body, in the way we react, in the silence we cannot explain.</p>
                            <p>On the outside, it may seem as though we have left the past behind, but a part of us remains, still, bound to a moment that never had the space to come to an end.</p>
                            <p>Sometimes it manifests as tension in the body. Sometimes through emotions that appear suddenly, without a clear reason. Sometimes through a sense of vigilance or numbness, even when no real danger exists.</p>
                            <p>That is not weakness.</p>
                            <p>It is the way our body and mind, unconsciously, try to protect us — sometimes long after the traumatic event has passed.</p>
                            <p>We do not have to carry all of that in silence. Or allow it to affect us, sometimes on a daily basis, sometimes in certain situations when something triggers us.</p>
                            <p>Equally, we do not have to force ourselves to "dig" through it or relive everything from the beginning, sometimes over a very long period.</p>
                            <p>There is a different path.</p>
                            <p>There is a way for that experience to be slowly understood, released, and integrated — without pressure, at a safe pace that suits us.</p>
                            <p>Through work that involves the body, emotions, and mind, the experience that has remained locked in can begin to shift. It cannot be erased. What happened, happened. But it gradually loses its power over us and stops holding us in the same place.
When the moment comes, what once was finally finds its place — without the weight it once carried.</p>
                            <p>We stop being in "fight or flight" mode. The body relaxes, and the mind quiets down. We slowly regain a sense of peace and safety within ourselves.</p>
                            <p>You do not have to go through all of that alone. If you feel it is time to take a step forward and do something for yourself, I am here so that together, gently and without pressure, we can make that step.</p>

                            <!-- ============================================================ -->
                            <!-- END OF CONTENT                                              -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
