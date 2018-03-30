<?php get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$gt3_pagebuilder = get_theme_pagebuilder(get_the_ID());

$pf = get_post_format();
if (empty($pf)) $pf = "default";
$pfIcon = get_pf_icon($pf);
$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );

the_pb_custom_bg_and_color($gt3_pagebuilder);

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
                                    <h2 class="title"><?php the_title(); ?></h2>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="blog_post_preview">
                                        <?php include ("ext/pf_type1.php"); ?>
                                        <div class="blog_info">
                                            <div class="blog_info_block">
                                                <span class="author_name"><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("posted_by") : __('Posted by','theme_localization')); ?>: <?php the_author_posts_link(); ?></span>
                                                <span class="category">In: <?php the_category(', '); ?></span>
                                                <span class="date"><?php the_date( "d M Y" ) ?></span>
                                                <span class="comments"><a href="<?php echo get_comments_link(); ?>">
                                                    <?php echo ((get_theme_option("translator_status") == "enable") ? get_text("comments_number") : __('Comments','theme_localization')).": "; echo comments_number( '0', '1', '%' ); ?>
                                                </a></span>
                                                <?php the_tags("<span class='blog_tags'>".((get_theme_option("translator_status") == "enable") ? get_text("tags_caption") : __('Tags: ','theme_localization')), ', ', '</span>'); ?>
                                            </div>
                                            <div class="portfolio_share">
                                                <a href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>" class="ico_socialize_facebook2 ico_socialize type2"></a>
                                                <a href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>" class="ico_socialize_twitter2 ico_socialize type2"></a>
                                                <a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>" class="ico_socialize_pinterest ico_socialize type2"></a>
                                                <a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="ico_socialize_google2 ico_socialize type2"></a>
                                                <div class="clear"><!-- ClearFix --></div>
                                            </div>
                                        </div>

                                        <?php
                                        if (!post_password_required()) { the_pb_parser((isset($gt3_pagebuilder['modules']) ? $gt3_pagebuilder['modules'] : array())); }

                                        global $contentAlreadyPrinted;
                                        if ($contentAlreadyPrinted !== true) {
                                            echo '<div class="row-fluid"><div class="span12">';
                                            the_content(((get_theme_option("translator_status") == "enable") ? get_text("read_more_link") : __('Read more...','theme_localization')));
                                            echo '</div><div class="clear"></div></div>';
                                        }
                                        ?>
                                        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . ((get_theme_option("translator_status") == "enable") ? get_text("translate_pages") : __('Pages','theme_localization')) . ': </span>', 'after' => '</div>' ) ); ?>
                                        <div class="dn">
                                            <?php previous_posts_link(); ?>
                                            <?php next_posts_link(); ?>
                                        </div>
                                    </div>
                                    <?php comments_template(); ?>
                                </div>
                            </div>
                            <?php

                            if (get_theme_option("related_posts") == "on") {

                                if ($gt3_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") {
                                    $posts_per_line = 4;
                                } else {
                                    $posts_per_line = 3;
                                }

                                echo '<div class="row-fluid" style="padding-top:30px;"><div class="span12 module_cont module_feature_posts">';
                                echo do_shortcode("[feature_posts
                                heading_color=''
                                heading_size='h4'
                                heading_text='".((get_theme_option("translator_status") == "enable") ? get_text("translate_related_posts") : __('Related Posts','theme_localization'))."'
                                number_of_posts='20'
                                posts_per_line=".$posts_per_line."
                                sorting_type='random'
                                related='no'
                                post_type='post'][/feature_posts]");
                                echo '</div></div>';
                            }
                            ?>

                            <div class="row-fluid">
                                <div class="span12">
                                    <a class="btn_back" href="<?php echo esc_js("javascript:history.back()");?>"><?php (get_theme_option("translator_status") == "enable") ? the_text("back_button") : _e('Back','theme_localization'); ?><span></span></a>
                                </div>
                            </div>

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

<?php get_footer() ?>