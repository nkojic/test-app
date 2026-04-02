<?php
$meta_description = 'Life coaching for a clearer direction, more balance and a deeper connection with yourself. We help you make decisions aligned with your values and your authentic life path.';
$meta_keywords    = 'life coaching, personal development, life change, balance, self-confidence, life direction';
$page_title       = 'Life Coaching | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'life-coaching';
$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Life Coaching';
$page_hero_bg     = '../images/1170x700.jpg';
$header_scheme    = 'scheme_original';
$header_position  = 'top_panel_position_above';
$lang_sr_url      = '/life-coaching.php';
$page_schema = '<script type="application/ld+json">{"@context":"https://schema.org","@type":"Service","name":"Life Coaching","description":"Life coaching for a clearer direction, more balance and a deeper connection with yourself.","provider":{"@type":"ProfessionalService","name":"Inner Dynamic Method","url":"https://innerdynamicmethod.rs"},"serviceType":"Life Coaching","areaServed":{"@type":"Country","name":"Serbia"},"url":"https://innerdynamicmethod.rs/en/life-coaching.php"}</script>';
include '../includes/en-header.php';
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
                            <p>Life coaching</p>
                            <p>A clearer direction, more balance and a deeper connection with yourself</p>
                            <p>In everyday life, we often focus on obligations, expectations and responsibilities. We rarely pause to ask ourselves where we are actually going and whether we are living in accordance with what truly matters to us.</p>
                            <p>Life coaching is a process that helps people better understand themselves, their values and desires, and make decisions that are in line with their authentic life direction.</p>
                            <p>It is a space where you can pause, see the bigger picture and explore questions that often remain on the sidelines in the everyday rush.</p>
                            <h2>Life coaching can help when:</h2>
                            <ul>
                                <li>you feel you are at a crossroads in life</li>
                                <li>you want a change in career or personal life</li>
                                <li>you are looking for more balance between different areas of life</li>
                                <li>you want to develop self-confidence and a clearer direction</li>
                                <li>you feel you can do more, but don't know where to start</li>
                            </ul>
                            <p>Through the coaching process, new insights, different perspectives and the courage to make changes that have long been waiting often emerge.</p>
                            <p>Sometimes all it takes is a little space for reflection for a completely new direction to appear.</p>
                            <p>✨ If you want more clarity, balance and connection with yourself, book a life coaching session.</p>
                            <h2>See also</h2>
                            <ul>
                                <li><a href="/en/coaching.php">About coaching</a></li>
                                <li><a href="/en/coaching-process.php">What the coaching process looks like</a></li>
                                <li><a href="/en/the-connection.php">The connection that makes a difference</a></li>
                            </ul>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
