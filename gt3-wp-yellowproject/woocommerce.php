<?php
get_header();

/* EMULATE PAGE BUILDER ARRAY */
$gt3_pagebuilder['settings']['layout-sidebars'] = get_theme_option("default_sidebar_layout");
$gt3_pagebuilder['settings']['left-sidebar'] = "WooCommerce";
$gt3_pagebuilder['settings']['right-sidebar'] = "WooCommerce";
$gt3_pagebuilder['settings']['show_breadcrumb'] = "no";
/*$gt3_pagebuilder['settings']['bg_image']['status'] = get_theme_option("show_bg_img_by_default");
$gt3_pagebuilder['settings']['bg_image']['src'] = get_theme_option("bg_img");
$gt3_pagebuilder['settings']['custom_color']['status'] = get_theme_option("show_bg_color_by_default");
$gt3_pagebuilder['settings']['custom_color']['value'] = get_theme_option("default_bg_color");
$gt3_pagebuilder['settings']['bg_image']['type'] = get_theme_option("default_bg_img_position");*/
?>
<!-- C O N T E N T -->
<div class="content_wrapper <?php echo ((isset($gt3_pagebuilder['settings']['show_breadcrumb']) && $gt3_pagebuilder['settings']['show_breadcrumb'] == "yes" && get_theme_option("show_breadcrumb") !== "off") ? 'withbreadcrumb' : 'withoutbreadcrumb') ?>">
    <div class="container">
        <?php /*if (function_exists('the_breadcrumb') && isset($gt3_pagebuilder['settings']['show_breadcrumb']) && $gt3_pagebuilder['settings']['show_breadcrumb'] == "yes") the_breadcrumb();*/ ?>
        <div class="content_block woo_wrap <?php echo esc_attr($gt3_pagebuilder['settings']['layout-sidebars']) ?> row">
            <div class="fl-container <?php echo (($gt3_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                <div class="row">
                    <div class="posts-block <?php echo (($gt3_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" || $gt3_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                        <div class="contentarea woocommerce_container">
                            <?php
                            if (!post_password_required()) { the_pb_parser((isset($gt3_pagebuilder['modules']) ? $gt3_pagebuilder['modules'] : array())); }

                            global $contentAlreadyPrinted;
                            if ($contentAlreadyPrinted !== true) {
                                echo '<div class="row-fluid"><div class="span12">';
                                woocommerce_content();
                                echo '</div><div class="clear"></div></div>';
                            }
                            ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . ((get_theme_option("translator_status") == "enable") ? get_text("translate_pages") : __('Pages','theme_localization')) . ': </span>', 'after' => '</div>' ) );
                            ?>
                        </div><!-- .contentarea -->
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
                <div class="clear"><!-- ClearFix --></div>
            </div><!-- .fl-container -->
            <?php get_sidebar('right'); ?>
            <div class="clear"><!-- ClearFix --></div>
        </div>
    </div><!-- .container -->
</div><!-- .content_wrapper -->

<?php get_footer() ?>