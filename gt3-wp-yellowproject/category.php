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
                            <?php
                            if (!post_password_required()) { the_pb_parser((isset($gt3_pagebuilder['modules']) ? $gt3_pagebuilder['modules'] : array())); }
                                echo '<div class="row-fluid"><div class="span12">';
                                while (have_posts()) : the_post();
                                    get_template_part("bloglisting");
                                endwhile; get_pagination();
                                echo '</div><div class="clear"></div></div>';
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