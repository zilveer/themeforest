<?php get_header();
#Emulate default settings for page without personal ID
$gt3_pagebuilder = get_default_pb_settings();
?>

<div class="content_wrapper <?php echo ((isset($gt3_pagebuilder['settings']['show_breadcrumb']) && $gt3_pagebuilder['settings']['show_breadcrumb'] == "yes" && get_theme_option("show_breadcrumb") !== "off") ? 'withbreadcrumb' : 'withoutbreadcrumb') ?>">
    <div class="container">
        <?php if (function_exists('the_breadcrumb') && isset($gt3_pagebuilder['settings']['show_breadcrumb']) && $gt3_pagebuilder['settings']['show_breadcrumb'] == "yes") the_breadcrumb(); ?>
        <div class="content_block <?php echo esc_attr($gt3_pagebuilder['settings']['layout-sidebars']) ?> row">
            <div class="fl-container <?php echo (($gt3_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                <div class="row">
                    <div class="posts-block <?php echo (($gt3_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" || $gt3_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                        <div class="contentarea">
                            <?php if ($gt3_pagebuilder['settings']['show_page_title'] !== "no") { ?>
                            <div class="row-fluid">
                                <div class="span12">
                                    <h2 class="title"><?php (get_theme_option("translator_status") == "enable") ? the_text("translator_header_404") : _e('Not Found','theme_localization'); ?></h2>
                                </div>
                            </div>
                            <?php }

                            if (!post_password_required()) { the_pb_parser((isset($gt3_pagebuilder['modules']) ? $gt3_pagebuilder['modules'] : array())); }

                            global $contentAlreadyPrinted;
                            if ($contentAlreadyPrinted !== true) {
                                echo '<div class="row-fluid"><div class="span12">';
                                echo (get_theme_option("translator_status") == "enable") ? the_text("translator_text_404") : _e('Apologies, but we were unable to find what you were looking for. Perhaps searching will help.','theme_localization');
                                echo '</div><div class="clear"></div></div>';
                            }
                            ?>

                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
            </div>
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>