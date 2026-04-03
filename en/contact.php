<?php
$meta_description = 'Contact Inner Dynamic Method and book your coaching, Wingwave® or Points of You® session. Reach us by phone, email or contact form.';
$meta_keywords    = 'contact, book a session, coaching Belgrade, Inner Dynamic Method contact';
$page_title       = 'Contact | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'kontakt';
$page_hero_icon   = 'icon-mail';
$page_hero_title  = 'Contact';
$page_hero_bg     = '../images/hero.webp';
$header_scheme    = 'scheme_original';
$header_position  = 'top_panel_position_above';
$lang_sr_url      = '/kontakt.php';
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
                                <span class="post_icon icon-mail"></span>
                                Contact
                            </h1>
                            <p>Ready to take the first step?</p>
                            <p>Whether you have a specific question, want to learn more about a particular method, or are simply ready to schedule your first session — I am here.</p>
                            <p>Feel free to reach out. There are no obligations, no pressure — just an open conversation about what is possible.</p>
                            <h2>Ways to get in touch</h2>
                            <p>You can contact me by email or phone. I will respond as soon as possible, usually within one working day.</p>
                            <p>Sessions are held in person in Belgrade, as well as online via video call — so distance is not an obstacle.</p>
                            <h2>What happens after you get in touch?</h2>
                            <p>We begin with a short introductory conversation — free of charge — in which you share what brings you here and I explain how I can support you. Together we decide whether and how to continue.</p>
                            <p>There is no commitment until you feel ready.</p>
                            <h2>Newsletter</h2>
                            <p>If you would like to receive occasional insights, reflections and information about new content and events, you are welcome to subscribe to the newsletter. You can unsubscribe at any time.</p>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
