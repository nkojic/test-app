<?php
$meta_description = 'Learn about the Inner Dynamic Method approach. A combination of Bowen therapy, coaching, Wingwave® and Points of You® for holistic support in personal and professional change.';
$meta_keywords    = 'about me, Inner Dynamic Method, coaching, Bowen therapy, personal development, Belgrade';
$page_title       = 'About Me | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'o-meni';
$page_hero_icon   = 'icon-user';
$page_hero_title  = 'About Me';
$page_hero_bg     = '../images/hero.webp';
$header_scheme    = 'scheme_original';
$header_position  = 'top_panel_position_above';
$lang_sr_url      = '/o-meni.php';
$page_schema = '<script type="application/ld+json">{"@context":"https://schema.org","@type":"AboutPage","name":"About Me","description":"Inner Dynamic Method – an integrative approach combining Bowen therapy, coaching, Wingwave and Points of You for holistic support in personal and professional change.","url":"https://innerdynamicmethod.rs/en/about-me.php","isPartOf":{"@type":"WebSite","url":"https://innerdynamicmethod.rs"}}</script>';
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
                            <p>From dentistry to inner dynamics</p>
                            <p>My path was not a straight line — and I think that is precisely what makes it valuable.</p>
                            <p>I trained and worked as a dentist. For years I focused on the physical — on health, precision, care. But over time I became increasingly interested in something that went beyond the body: the inner processes that shape how people feel, how they make decisions, and how they change.</p>
                            <p>That curiosity gradually led me in a new professional direction.</p>
                            <h2>The Inner Dynamic Method</h2>
                            <p>Over the years I developed the Inner Dynamic Method — an integrative approach that connects work with the body, emotions and inner insights, because experience shows that real change often happens at the intersection of all three.</p>
                            <p>The name reflects exactly that: the dynamics that happen within us, beneath the surface of what we show to the world.</p>
                            <h2>What I work with</h2>
                            <p>In my practice I combine several complementary methods:</p>
                            <ul>
                                <li><strong>Bowen therapy</strong> – a gentle technique that works on deep relaxation of the nervous system and activates the body's natural healing mechanisms</li>
                                <li><strong>Coaching</strong> – a structured process of reflection and goal-setting that helps you see your situation more clearly and take purposeful steps forward</li>
                                <li><strong>Wingwave® method</strong> – a method of working with emotions that identifies and releases stress and inner blocks at their root</li>
                                <li><strong>Points of You® methodology</strong> – working with photographs and metaphors to open new perspectives and spark authentic insights</li>
                                <li><strong>S.F.E.R.A. mental training</strong> – a system for developing inner synchrony, resilience, energy management and focused activation</li>
                            </ul>
                            <h2>How I work</h2>
                            <p>Every person who comes to me brings their own story, their own pace and their own goals. That is why there is no universal programme — each process is shaped around the individual.</p>
                            <p>Sometimes we work primarily with the body. Sometimes with emotions. Sometimes with perspective and decisions. Often all three at once.</p>
                            <p>What does not change is my intention: to create a space where real change becomes possible.</p>
                            <p>✨ If you feel ready to take that first step, I will be glad to walk alongside you on that journey.</p>
                            <h2>See also</h2>
                            <ul>
                                <li><a href="/en/my-approach.php">My approach to work</a></li>
                                <li><a href="/en/the-connection.php">The connection that makes a difference</a></li>
                                <li><a href="/en/contact.php">Get in touch</a></li>
                            </ul>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
