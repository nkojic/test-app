<?php
$meta_description = '';
$page_title       = 'Clarity and Direction | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';

$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Clarity and Direction';

$featured_image     = '';
$featured_image_alt = '';
$page_hero_bg       = '../images/hero.webp';

$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_sr_url     = '/jasnoca-i-usmerenje.php';

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

                            <!-- ============================================================ -->
                            <!-- PAGE CONTENT — edit only this section                        -->
                            <!-- ============================================================ -->

                            <p>Sometimes you reach a phase in life where, from the outside, everything seems to work. Yet inside, you feel that something is not quite in its place.</p>
                            <p>You work, make decisions, move forward… but there is a part of you that doubts, that withdraws, that reacts differently than you would like. And you often think you need to "fix yourself". To be stronger, more focused, more confident. But in reality, you simply are not hearing all parts of yourself.</p>
                            <p>Inner Dynamic Method creates exactly that space for you. A space where we do not look for a quick fix. Instead, we pause and look at what is truly happening inside.</p>
                            <p>Which part of you wants one thing, and which wants another. Where you lose energy. Where you are already strong, but are not using it.</p>
                            <p>Through the work, you slowly begin to connect things that until now seemed unrelated. Reactions start to make sense. Patterns become visible and without forcing, without pressure — change begins. Not because you "learned something new". But because you started using what you already have within you.</p>
                            <p>Perspective changes. Decisions become clearer. And the inner feeling becomes more stable.</p>
                            <p>Inner Dynamic Method is not a technique. Nor is it counselling. It is a process in which you learn to understand yourself more deeply, to align what you think, feel and do, and to function from that place with more confidence and authenticity.</p>
                            <p>And perhaps what you need right now is not another strategy. But a space to connect with yourself — in a way that makes sense just for you.</p>

                            <!-- ============================================================ -->
                            <!-- END OF CONTENT                                              -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
