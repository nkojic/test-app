<?php
$meta_description = '';
$page_title       = 'Aging as a Choice | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';

$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Aging as a Choice';

$featured_image     = '../images/starenje-kao-izborv.webp';
$featured_image_alt = 'Aging as a choice';
$page_hero_bg       = '../images/hero.webp';

$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_sr_url     = '/starenje-kao-izbor.php';

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

                            <p>I've been thinking about the whole concept of aging. About all the trends and imposed expectations. Especially for women. And where and when it all begins.</p>

                            <p>I have nothing against skincare. There are so many natural ways to preserve a youthful appearance and vitality well into later years. Besides physical appearance, the absence or reduction of wrinkles, maintaining muscle tone, mobility and flexibility of the body are equally important.</p>

                            <p>Yet, the most important thing that makes the difference and gives quality to our lives is the way we think.</p>

                            <p>What does that mean?</p>

                            <p>To simplify, you could say it comes down to whether the glass is half full or half empty. Will you see opportunity in problems or will you give up? When things don't go as planned, will you get frustrated, curse the day, the people, the circumstances, or will you accept it all, try to turn it to your advantage, or simply let go? Will you focus on what is good or what is bad? Will you choose to be at peace or to be right?</p>

                            <p>If you view life as a journey from point A to point B, it's clear that you can travel it in a thousand different ways. Regardless of circumstances. You choose. So why not choose to go through it with ease, with laughter, with happiness and love?</p>

                            <p>As for expectations and trends, you choose there too. Do you want to live life by society's standards or by your own? Do you have the courage to be authentic, even at the cost of not belonging to the majority?</p>

                            <p>You always have a choice. Never forget that. You always have plenty of choices. You are free to be easy-going in life. Regardless of wrinkles, tone and flexibility, that will be what shines through.</p>

                            <p>If things are hard. If you don't know where to start. If you want an authentic life but lack the courage. If you would like to have a quality life in every aspect even after fifty. Reach out, I am here to help you.</p>

                            <!-- ============================================================ -->
                            <!-- END OF CONTENT                                              -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/en-footer.php'; ?>
