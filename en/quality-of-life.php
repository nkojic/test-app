<?php
$meta_description = '';
$page_title       = 'Quality of Life – You Choose | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = '';

$page_hero_icon   = 'icon-book-open';
$page_hero_title  = 'Quality of Life – You Choose';

$featured_image     = '../images/kvalitet-zivotav.webp';
$featured_image_alt = 'Quality of life';
$page_hero_bg       = '../images/hero.webp';

$header_scheme   = 'scheme_original';
$header_position = 'top_panel_position_above';
$lang_sr_url     = '/kvalitet-zivota.php';

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

                            <p>Over the years of working with people, patients and clients, and, indeed, working on myself, I have arrived at many truths.</p>

                            <p>One of them, perhaps the most significant, is that we have been "deceived" by aging programs when it comes to the functionality of body, mind and spirit.</p>

                            <p>There are sporadic cases that directly show us that the beliefs we hold about aging are not true. These are people who have transcended the collective mindset and, as they say, beaten the game.</p>

                            <p>Once, an old friend of my father's, in her eighties, told me: "You know, we don't age, only our body ages."</p>

                            <p>When you pause for a moment and set aside learned beliefs and programs, you will arrive at your desires and hopes from when you were, say, 15 or 16 years old. You will see that, essentially, they haven't changed much. That is you. What happened in the meantime is that those rigid "truths" – that life is a serious matter, that you must be responsible, that you must meet the expectations placed upon you as an adult – became your life. And so, gradually, you become increasingly inflexible in every way. It's immature to go out and dance all night, you shouldn't run in the street, you shouldn't shout, you shouldn't laugh loudly, it's not appropriate to show emotions in public, except sometimes to point out someone's "immature" and "ill-mannered" behaviour.</p>

                            <p>And so you go through life, time passes. Your learned rigid attitudes and the disuse of muscular and skeletal structures lead to rigidity on all levels. Physical, mental and emotional. Even the expression on your face and your wrinkles reveal the same picture.</p>

                            <p>Of course, over the years you start blaming life, genetics, "aging"… it's so much easier that way. And you blend in with the crowd… you fit in. If someone steps out of the mould, they are usually labelled as unserious and irresponsible. That they behave inappropriately for their age, whatever that means. You remember youth. You would gladly return to it… if you could.
                            Well, you can. So little is needed. Our body and our mind have an enormous capacity for adaptation. Use it. With small changes in your daily routines, you can gain a great deal. Quality of life, on every level, improves. Life takes on a completely different, phenomenal dimension. Or you can stay in the rut. Complain and blame whatever and whoever for the rest of your life. You choose!</p>

                            <p>If you need help getting started. If you have no idea where to begin. If you don't know what you can do. I am here to help. It's easy!</p>

                            <!-- ============================================================ -->
                            <!-- END OF CONTENT                                              -->
                            <!-- ============================================================ -->

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
