<?php
$meta_description = '';
$page_title       = 'Age Is Just a Number | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';

$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Age Is Just a Number';

$featured_image     = '../images/godine-su-samo-brojv.webp';
$featured_image_alt = 'Age is just a number';
$page_hero_bg       = '../images/hero.webp';

$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_sr_url     = '/godine-su-samo-broj.php';

include '../includes/en-header.php';
?>
        <!-- Hero banner commented out for now
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
                            <!-- PAGE CONTENT — edit only this section                        -->
                            <!-- ============================================================ -->

                            <p>I read somewhere: "Don't believe everything you think." Be warned, this text will lead you to seriously question everything you have thought and believed until now.
                            I often like to say that age is just a number. I don't feel it and I've never had any particular attitude about aging. I see people in their fifties who consider themselves deeply old, they behave that way, and often look that way too. On the other hand, people in their seventies come to me, vital, full of life. What sets them apart is their mindset.</p>

                            <p>We could say that a lot depends on genetic predisposition. However, today we are familiar with the principles of epigenetics. It has been proven that only 5% of genetic material is expressed, while the possibility of expressing the remaining 95% depends on various external factors. In addition to our living conditions, diet, physical activity, lifestyle, the amount of stress and stressors, one of the most important, often neglected factors, are our thoughts. They create our emotions which affect our biochemical status. This leads to decreased or increased secretion of hormones and neurotransmitters, which ultimately results in changes at the physical level.</p>

                            <p>All of this supports the theory that what we think is what we become. If we think we are old, we are old. If we think we are sick, even if we aren't, we will be soon. If we think life is over, it's over for us. We may not die, but we will merely exist until the end, which amounts to the same thing.</p>

                            <p>My advice: Take your life into your own hands as soon as possible. Free yourself from prejudices and programs that don't serve you. Get to know yourself again, your authentic side, remember who you are. And start moving toward your desires, your hopes, your core. Be what you are and what you've always been. That is the only way to be happy.</p>

                            <p>If you need help, it's not hard to ask for it. I am here. It will be my pleasure to participate in your transformation. The programs are ready!</p>

                            <!-- ============================================================ -->
                            <!-- END OF CONTENT                                              -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
