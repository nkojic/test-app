<?php
$meta_description = 'Explore Inner Dynamic Method offers – individual and group coaching sessions, Wingwave® and Points of You® treatments. Find the package that suits your needs.';
$meta_keywords    = 'offers, coaching packages, Wingwave session, Points of You session, Inner Dynamic Method pricing';
$page_title       = 'Offers | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'ponude';
$page_hero_icon   = 'icon-star';
$page_hero_title  = 'Offers';
$page_hero_bg     = '../images/hero.webp';
$header_scheme    = 'scheme_original';
$header_position  = 'top_panel_position_above';
$lang_sr_url      = '/ponude.php';
$page_schema = '<script type="application/ld+json">{"@context":"https://schema.org","@type":"WebPage","name":"Offers","description":"Individual coaching sessions, Wingwave, Points of You and Bowen therapy packages at Inner Dynamic Method.","url":"https://innerdynamicmethod.rs/en/offers.php","isPartOf":{"@type":"WebSite","url":"https://innerdynamicmethod.rs"}}</script>';
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
                            <p>A session for every kind of change</p>
                            <p>Change is not a single event — it is a process. Depending on where you are and what you need, different approaches work best at different moments.</p>
                            <p>Below you will find an overview of the individual sessions and packages I offer. If you are unsure which one suits you best, we can figure that out together in a short introductory call.</p>
                            <h2>Individual sessions</h2>
                            <p>Each session lasts approximately 60 minutes and is tailored to your topic and goal for that day.</p>
                            <ul>
                                <li><strong>Coaching session</strong> – structured conversation, reflection and goal-setting for clarity and purposeful action</li>
                                <li><strong>Wingwave® session</strong> – working with emotional stress, inner blocks and limiting beliefs</li>
                                <li><strong>Points of You® session</strong> – a different kind of conversation, through photographs and metaphors, for new perspectives and authentic insights</li>
                                <li><strong>Bowen therapy</strong> – gentle bodywork for deep nervous system relaxation and natural recovery</li>
                                <li><strong>Combined session</strong> – integrating two or more methods depending on the topic and your needs</li>
                            </ul>
                            <h2>Coaching packages</h2>
                            <p>For deeper and more lasting change, a series of sessions is often more effective than working session by session. Packages offer continuity — and continuity creates real transformation.</p>
                            <ul>
                                <li><strong>Starter package</strong> – 3 sessions to clarify your direction and take the first steps</li>
                                <li><strong>Change package</strong> – 6 sessions for a deeper and more sustained process of change</li>
                                <li><strong>Transformation package</strong> – 10 sessions for long-term personal or professional development</li>
                            </ul>
                            <h2>Group workshops</h2>
                            <p>Points of You® and Wingwave® are also available in group formats — for teams, workshops, or small groups of up to 8 people. These can be held in person or online.</p>
                            <h2>Custom programmes</h2>
                            <p>For companies, sports clubs and organisations, I design tailored programmes based on your specific needs and goals.</p>
                            <p>✨ Not sure which option is right for you? Reach out and we will find the best fit together.</p>
                            <h2>See also</h2>
                            <ul>
                                <li><a href="/en/coaching.php">About coaching</a></li>
                                <li><a href="/en/wing-wave.php">Wingwave® emotional coaching</a></li>
                                <li><a href="/en/points-of-you.php">Points of You coaching</a></li>
                                <li><a href="/en/contact.php">Get in touch</a></li>
                            </ul>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
