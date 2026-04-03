<?php
$meta_description = 'Terms of use of the Inner Dynamic Method website – rules and conditions for using the website and its content.';
$meta_keywords    = 'terms of use, conditions, Inner Dynamic Method';
$page_title       = 'Terms of Use | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'uslovi-koriscenja';
$page_hero_icon   = 'icon-doc-text';
$page_hero_title  = 'Terms of Use';
$page_hero_bg     = '../images/1170x700.jpg';
$header_scheme    = 'scheme_original';
$header_position  = 'top_panel_position_above';
$lang_sr_url      = '/uslovi-koriscenja.php';
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
                            <p><strong>Last updated:</strong> 15.01.2026.</p>

                            <p>The content of this website is intended exclusively for informational and educational purposes. The information published on the site does not constitute medical advice, diagnosis or treatment and cannot replace the advice of a qualified healthcare professional.</p>

                            <h2>1. Use of content</h2>
                            <p>All content on the site (texts, images, graphics and other materials) is protected by copyright and related rights regulations. Use of the content is permitted exclusively for personal, non-commercial purposes.</p>

                            <h2>2. Prohibited activities</h2>
                            <ul>
                                <li>Unauthorised copying, distribution or modification of content</li>
                                <li>Using content for commercial purposes without the consent of the site owner</li>
                                <li>Misuse of the site or attempts at unauthorised access</li>
                            </ul>

                            <h2>3. Limitation of liability</h2>
                            <p>The site owner is not responsible for any damage arising from the use of or reliance on the information available on the site, nor for temporary unavailability or technical issues.</p>

                            <h2>4. External links</h2>
                            <p>The site may contain links to other websites. We are not responsible for their content, privacy policies or practices.</p>

                            <h2>5. Changes to the terms</h2>
                            <p>We reserve the right to modify these terms at any time. Continued use of the site following changes is considered acceptance of the new terms.</p>

                            <h2>6. Governing law</h2>
                            <p>These terms of use are governed by the laws of the Republic of Serbia.</p>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
