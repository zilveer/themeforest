<?php get_header(); ?>

<div id="main" role="main">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <?php
            if (is_home() || is_front_page()) {
                ?>

                <div class="col-lg-12 col-lg-12 col-lg-12">

                    <div class="widget-announce-section" <?php
                    if (isset($cs_theme_option['show_slider']) and $cs_theme_option['show_slider'] == "") {
                        echo 'style="margin-top: 65px;"';
                    }
                    ?>>

                        <?php
                        global $cs_theme_option;

                        $blog_category = isset($cs_theme_option['announcement_blog_category']) ? $cs_theme_option['announcement_blog_category'] : '';

                        $announcement_no_posts = isset($cs_theme_option['announcement_no_posts']) ? $cs_theme_option['announcement_no_posts'] : '';



                        if (isset($blog_category) && $blog_category <> '0') {

                            if (empty($_GET['page_id_all']))
                                $_GET['page_id_all'] = 1;

                            if (empty($announcement_no_posts)) {
                                $announcement_no_posts = 5;
                            }

                            $args = array('posts_per_page' => "$announcement_no_posts", 'paged' => $_GET['page_id_all'], 'category_name' => "$blog_category", 'post_status' => 'publish');

                            $custom_query = new WP_Query($args);

                            cs_enqueue_flexslider_script();
                            ?>

                            <script type="text/javascript">

                                jQuery(window).load(function () {
        <?php if (isset($cs_theme_option['flex_animation_speed'])) {
            ?>
                                        var speed = <?php echo $cs_theme_option['flex_animation_speed']; ?>;
        <?php } ?>
        <?php if (isset($cs_theme_option['flex_pause_time'])) {
            ?>
                                        var slidespeed = <?php echo $cs_theme_option['flex_pause_time']; ?>;
        <?php } ?>
                                    jQuery('.announcement-ticker .flexslider').flexslider({
                                        animation: "fade",
                                        animationLoop: false,
                                    });

                                    jQuery(".flex-direction-nav a.flex-prev").append('<em class="fa fa-angle-left"></em>')

                                    jQuery(".flex-direction-nav a.flex-next").append('<em class="fa fa-angle-right"></em>')

                                });

                            </script>

                            <div class="announcement-ticker fullwidth">

                                <h3 class="float-left colr"><?php echo isset($cs_theme_option['announcement_title']) ? $cs_theme_option['announcement_title'] : ''; ?> <em class="fa fa-caret-right"></em></h3>

                                <div class="ticker-wrapp">

                                    <div class="flexslider">

                                        <ul class="slides">

                                            <?php
                                            while ($custom_query->have_posts()) : $custom_query->the_post();
                                                ?>

                                                <li>

                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <time datetime="<?php echo date('d F Y', strtotime(get_the_date())); ?>"><?php echo date('d F Y', strtotime(get_the_date())); ?></time>

                                                </li>



                                            <?php endwhile; ?>



                                        </ul>

                                    </div>

                                </div>

                            </div>

                        <?php } ?>

                        <div class="multiple-widgets fullwidth">

                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-widget')) : ?><?php endif; ?>

                        </div>

                    </div>

                </div>

                <?php
            }
            ?>



            <?php
            wp_reset_query();

            if (post_password_required()) {



                echo '<div class="rich_editor_text">' . cs_password_form() . '</div>';
            } else {

                $cs_meta_page = cs_meta_page('cs_page_builder');

                if (count($cs_meta_page) > 0) {

                    if ($cs_meta_page->sidebar_layout->cs_layout <> '' and $cs_meta_page->sidebar_layout->cs_layout <> "none" and $cs_meta_page->sidebar_layout->cs_layout == 'left') :
                        ?>

                        <aside class="col-md-3">

                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_meta_page->sidebar_layout->cs_sidebar_left)) : endif; ?>

                        </aside>

                    <?php endif; ?>

                    <?php if ($cs_meta_page->cs_layout == 'both_left') : ?>

                        <?php cs_meta_sidebar(); ?>

                    <?php endif; ?>

                    <div class="<?php echo cs_meta_content_class(); ?> ">

                        <?php
                        wp_reset_query();

                        if ($cs_meta_page->page_content == "Yes") {

                            echo '<div class="rich_editor_text">';

                            the_content();

                            wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'AidReform') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));

                            echo '</div>';
                        }

                        global $cs_counter_node;

                        foreach ($cs_meta_page->children() as $cs_node) {



                            if ($cs_node->getName() == "blog") {

                                $cs_counter_node++;

                                $layout = $cs_meta_page->sidebar_layout->cs_layout;

                                if ($cs_node->cs_blog_cat <> "")
                                    get_template_part('page_blog', 'page');
                            }

                            else if ($cs_node->getName() == "gallery") {

                                $cs_counter_node++;

                                if ($cs_node->album <> "" and $cs_node->album <> "0") {

                                    get_template_part('page_gallery', 'page');
                                }
                            } else if ($cs_node->getName() == "event") {

                                $cs_counter_node++;

                                if ($cs_node->cs_event_category <> "") {

                                    get_template_part('page_event', 'page');
                                }
                            } else if ($cs_node->getName() == "slider" and $cs_node->slider_view == "content") {

                                $cs_counter_node++;

                                get_template_part('page_slider', 'page');
                            } elseif ($cs_node->getName() == "cause") {

                                $cs_counter_node++;

                                get_template_part('page_cause', 'page');
                            } elseif ($cs_node->getName() == "contact") {

                                $cs_counter_node++;

                                get_template_part('page_contact', 'page');
                            } elseif ($cs_node->getName() == "client") {

                                $cs_counter_node++;

                                cs_client_page();
                            } elseif ($cs_node->getName() == "services") {

                                $cs_counter_node++;

                                cs_services_page();
                            } elseif ($cs_node->getName() == "column") {

                                $cs_counter_node++;

                                cs_column_page();
                            } elseif ($cs_node->getName() == "map" and ( $cs_node->map_view == "content" || $cs_node->map_view == "contact us")) {

                                $cs_counter_node++;

                                echo cs_map_page();
                            }
                        }

                        wp_reset_query();

                        if (comments_open()) :

                            comments_template('', true);

                        endif;
                        ?>

                    </div>

                    <?php if ($cs_meta_page->sidebar_layout->cs_layout <> '' and $cs_meta_page->sidebar_layout->cs_layout <> "none" and $cs_meta_page->sidebar_layout->cs_layout == 'right') : ?>

                        <aside class="col-md-3">

                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_meta_page->sidebar_layout->cs_sidebar_right)) : endif; ?>

                        </aside>

                    <?php endif; ?>



                <?php }else { ?>

                    <div class="rich_editor_text">

                        <?php
                        while (have_posts()) : the_post();

                            the_content();

                            wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'AidReform') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));

                        endwhile;

                        if (comments_open()) {

                            comments_template('', true);
                        }

                        wp_reset_query();
                        ?>

                    </div>

                    <?php
                }
            }
            ?>

            <?php get_footer(); ?>

            <!-- Columns End -->