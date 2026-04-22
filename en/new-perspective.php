<?php
$meta_description = '';
$page_title       = 'New Perspective | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';

$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Points of You Coaching';

$featured_image     = '';
$featured_image_alt = '';
$page_hero_bg       = '../images/hero.webp';

$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_sr_url     = '/nova-perspektiva.php';

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
                            <div class="page-intro-image" style="text-align:center; margin-bottom:30px;">
                                <img src="../images/points-of-you-stranica.webp" alt="Points of You Coaching" style="max-width:100%; height:auto;">
                            </div>
                            <h1 class="post_title entry-title">
                                <span class="post_icon <?php echo $page_hero_icon; ?>"></span>
                                New Perspective
                            </h1>

                            <!-- ============================================================ -->
                            <!-- PAGE CONTENT — edit only this section                        -->
                            <!-- ============================================================ -->

                            <p>There comes a moment when you know you need to stop. Not because you do not have the answer, but because in the rapid succession of events and the noise of life you can no longer hear it.</p>
                            <p>Points of You is precisely that space.</p>
                            <p>A space where you pause. Breathe. And for the first time in a long while truly look at where you are, what is happening around you, what you spend most of your day doing, how you feel.</p>
                            <p>This method, seemingly light, uses photographs, words and simple questions, but what it sets in motion is much deeper. Because an image bypasses the "I already know", "I should", "I must"… and goes directly to what you truly feel and think.</p>
                            <p>It is interesting that our brain reacts much faster to images than to words. That is why it often happens that a single photograph triggers a thought or emotion you would never have reached by thinking alone. And that is exactly where the shift begins.</p>
                            <p>Through this process, almost imperceptibly, things begin to change. Perspective widens. What seemed complicated becomes clearer. And the answers you were seeking outside begin to come from within.</p>
                            <p>You are not looking for "the right answer", but the one that makes sense for you.</p>
                            <p>When you change the way you look at a situation, the way you experience it changes too. And from that place everything changes – the way you see reality, the choices you make, the decisions you take.</p>
                            <p>Points of You is not analysis. Nor is it a classical conversation.</p>
                            <p>It is an experience.</p>
                            <p>An experience in which you learn to hear yourself more clearly, to understand what truly matters to you and to allow yourself a different perspective. Your own, authentic one. And perhaps that is exactly what you need right now. Not another answer, but a new way to see what is already there, within you.</p>
                            <p>If you feel it is time to stop, take a pause and look differently, perhaps this is the right moment to experience it.</p>
                            <p>All the answers are within you!</p>

                            <!-- ============================================================ -->
                            <!-- END OF CONTENT                                              -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
