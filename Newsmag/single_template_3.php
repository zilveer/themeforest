<?php
// Template 3 - post-final-2.psd - normal full grid 2 column image + full title
//get the global sidebar position from td_single_template_vars.php

locate_template('includes/wp_booster/td_single_template_vars.php', true);

get_header();

global $loop_sidebar_position, $post;

$td_mod_single = new td_module_single($post);

?>
<div class="td-container td-post-template-3">
    <div class="td-container-border">
        <article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>
            <div class="td-pb-row">
                <div class="td-pb-span12">
                    <div class="td-post-header td-pb-padding-side">
                        <?php echo td_page_generator::get_single_breadcrumbs($td_mod_single->title); ?>

                        <?php echo $td_mod_single->get_category(); ?>

                        <header>
                            <?php echo $td_mod_single->get_title();?>


                            <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                                <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle'];?></p>
                            <?php } ?>


                            <div class="meta-info">

                                <?php echo $td_mod_single->get_author();?>
                                <?php echo $td_mod_single->get_date(false);?>
                                <?php echo $td_mod_single->get_views();?>
                                <?php echo $td_mod_single->get_comments();?>
                            </div>
                        </header>
                    </div>
                </div>
            </div> <!-- /.td-pb-row -->

            <div class="td-pb-row">
                <?php
                switch ($loop_sidebar_position) {
                    default: // sidebar right
                        ?>
                            <div class="td-pb-span8 td-main-content" role="main">
                                <div class="td-ss-main-content">
                                    <?php
                                    locate_template('loop-single-3.php', true);
                                    comments_template('', true);
                                    ?>
                                </div>
                            </div>
                            <div class="td-pb-span4 td-main-sidebar td-pb-border-top" role="complementary">
                                <div class="td-ss-main-sidebar">
                                    <?php get_sidebar(); ?>
                                </div>
                            </div>
                        <?php
                        break;

                    case 'sidebar_left':
                        ?>
                        <div class="td-pb-span8 td-main-content td-sidebar-left-content" role="main">
                            <div class="td-ss-main-content">
                                <?php
                                locate_template('loop-single-3.php', true);
                                comments_template('', true);
                                ?>
                            </div>
                        </div>
                        <div class="td-pb-span4 td-main-sidebar td-pb-border-top" role="complementary">
                            <div class="td-ss-main-sidebar">
                                <?php get_sidebar(); ?>
                            </div>
                        </div>
                        <?php
                        break;

                    case 'no_sidebar':
                        td_global::$load_featured_img_from_template = 'full';
                        ?>
                        <div class="td-pb-span12 td-main-content" role="main">
                            <div class="td-ss-main-content">
                                <?php
                                locate_template('loop-single-3.php', true);
                                comments_template('', true);
                                ?>
                            </div>
                        </div>
                        <?php
                        break;

                }
                ?>
            </div> <!-- /.td-pb-row -->
        </article> <!-- /.post -->
    </div>
</div> <!-- /.td-container -->

<?php

get_footer();