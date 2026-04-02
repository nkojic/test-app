<?php
$meta_description = '';
$page_title       = 'Testimonials | Inner Dynamic Method';
$body_class       = 'singlepost single single-post body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'utisci';
$page_hero_icon   = 'icon-chat';
$page_hero_title  = 'Testimonials';
$page_hero_bg     = '../images/1170x700.jpg';
$header_scheme    = 'scheme_original';
$header_position  = 'top_panel_position_above';
$lang_sr_url      = '/utisci.php';
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
                            <div id="sc_testimonials_utisci" class="sc_testimonials sc_testimonials_style_testimonials-1 cu_fullwidth">
                                <div class="sc_slider_swiper swiper-slider-container sc_slider_nopagination sc_slider_controls sc_slider_controls_side" data-interval="7000" data-slides-min-width="250">
                                    <div class="slides swiper-wrapper">
                                        <div class="swiper-slide" data-style="width:100%;">
                                            <div class="sc_testimonial_item">
                                                <div class="sc_testimonial_content">
                                                    <p>I am 55 years old and my experience has been very positive. I am grateful for the help I received in relieving long-standing pain in my shoulder, upper arm and stiff back caused by sitting at work for long hours and poor posture. After just three sessions the pain in my shoulder and upper arm disappeared and my neck relaxed. I sleep more peacefully and my range of motion has greatly improved.</p>
                                                    <p>Warm recommendation!</p>
                                                </div>
                                                <div class="sc_testimonial_author">
                                                    <a href="#" class="sc_testimonial_author_name">Ivana, 55</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-style="width:100%;">
                                            <div class="sc_testimonial_item">
                                                <div class="sc_testimonial_content">
                                                    <p>This is the only approach that brought me deep relaxation already after the first session. It is good for both body and mind. The indescribable sense of peace and lightness after each session stays with me for days and keeps growing. Small, gentle moves — yet a big change.</p>
                                                    <p>A warm recommendation for everyone who wants to show themselves some love ❤️</p>
                                                </div>
                                                <div class="sc_testimonial_author">
                                                    <a href="#" class="sc_testimonial_author_name">Tanja, 47</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-style="width:100%;">
                                            <div class="sc_testimonial_item">
                                                <div class="sc_testimonial_content">
                                                    <p>I came across her completely by chance a few years ago — I had never even heard of this approach before. I decided to try it because of frequent back and muscle pain caused by stress and long hours of sitting. The experience was wonderful — the sessions are extremely pleasant and relaxing, and I would feel great relief immediately. But more than that, I want to highlight the relationship with clients — she is a wonderful, gentle, empathetic person who truly listens and understands.</p>
                                                    <p>I would recommend her to everyone, wholeheartedly!</p>
                                                </div>
                                                <div class="sc_testimonial_author">
                                                    <a href="#" class="sc_testimonial_author_name">Tamara, 48</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc_slider_controls_wrap">
                                        <a class="sc_slider_prev" href="#"></a>
                                        <a class="sc_slider_next" href="#"></a>
                                    </div>
                                    <div class="sc_slider_pagination_wrap"></div>
                                </div>
                            </div>
                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include '../includes/footer.php'; ?>
