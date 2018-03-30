<?php
global $cs_theme_option, $cs_position, $cs_page_builder, $cs_meta_page, $cs_node;

//$cs_theme_option = get_option('cs_theme_option');
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta charset="<?php bloginfo('charset'); ?>" />

        <?php
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');

        cs_header_settings();

        wp_head();
        ?>

    </head>

    <body <?php
    body_class();
    cs_bg_image();
    cs_bgcolor_pattern();
    ?> >

        <?php
        cs_custom_styles();

        cs_under_construction();

        cs_color_switcher();
        ?>

        <!-- Wrapper Start -->

        <div class="<?php cs_wrapper_class() ?>" id="wrappermain-pix">

            <?php
            cs_get_header();

            // Header sticky menu

            if (isset($cs_theme_option['header_sticky_menu']) and $cs_theme_option['header_sticky_menu'] == "on") {

                cs_scrolltofixed_script();
                ?>

                <script type="text/javascript">

                    jQuery(document).ready(function () {

                        cs_menu_sticky();

                    });

                </script>

                <?php
            }
            ?>

            <?php
            if (is_home() || is_front_page()) {

                //Home page Slider Start

                cs_get_home_slider();

                //Home page Slider End 
            } else {

                // Subheader
                ?>

                <div class="breadcrumb default-image backcolr">

                    <div class="container">

                        <div class="breadcrumb-inner">

                            <?php
                            if (function_exists("is_shop") and is_shop()) {

                                $cs_shop_id = woocommerce_get_page_id('shop');

                                echo "<div class=\"subtitle\"><h1 class=\"cs-page-title\">" . get_the_title($cs_shop_id) . "</h1></div>";
                            } else if (function_exists("is_shop") and ! is_shop()) {

                                echo '<div class="subtitle">';

                                get_subheader_title();

                                echo '</div>';
                            } else {

                                echo '<div class="subtitle">';

                                get_subheader_title();

                                echo '</div>';
                            }

                            if (isset($cs_theme_option['beadcrumbs_type']) and $cs_theme_option['beadcrumbs_type'] == 'breadcrumbs' && $cs_theme_option['show_beadcrumbs'] == 'on') {

                                cs_breadcrumbs();
                            } else if (isset($cs_theme_option['beadcrumbs_type']) and $cs_theme_option['beadcrumbs_type'] == 'custome_style' && $cs_theme_option['breadcrumb_text'] <> '') {

                                echo do_shortcode(html_entity_decode($cs_theme_option['breadcrumb_text']));
                            }
                            ?>

                        </div>

                    </div>

                </div>

                <?php
                /* Header Slider and Map Code start  */

                if (is_page()) {

                    $cs_meta_page = cs_meta_page('cs_page_builder');

                    if (!empty($cs_meta_page)) {

                        echo '<div class="header_element">';

                        foreach ($cs_meta_page->children() as $cs_node) {

                            if ($cs_node->getName() == "map" and $cs_node->map_view == "header") {

                                echo cs_map_page();
                            } elseif ($cs_node->getName() == "slider" and $cs_node->slider_view == "header" and $cs_node->slider_type != "Custom Slider") {

                                get_template_part('page_slider', 'page');

                                $cs_position = 'absolute';
                            }
                        }

                        echo '</div>';
                    }
                }

                /* Header Slider and Map Code End  */
            }
            ?>