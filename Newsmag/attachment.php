<?php
/*  ----------------------------------------------------------------------------
    the attachment template
 */


get_header();




//set the template id, used to get the template specific settings
$template_id = 'attachment';

//prepare the loop variables
global $loop_sidebar_position;
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)
?>

<div class="td-container">
    <div class="td-container-border">
        <div class="td-pb-row">
            <?php
            switch ($loop_sidebar_position) {
                default:
                    ?>
                    <div class="td-pb-span8 td-main-content td-pb-padding">
                        <div class="td-ss-main-content">
                            <?php
                            if (!empty($post->post_parent) and !empty($post->post_title)) {
                                echo td_page_generator::get_attachment_breadcrumbs($post->post_parent, $post->post_title);
                            }

                            if (is_single()) {?>
                                <h1 class="entry-title td-page-title">
                                <span><?php the_title(); ?></span>
                                </h1><?php
                            } else {?>
                                <h1 class="entry-title td-page-title">
                                <a href="<?php ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                </h1><?php
                            }

                            get_template_part('loop', 'attachment');
                            ?>
                            <div class="td-attachment-prev"><?php previous_image_link(); ?></div>
                            <div class="td-attachment-next"><?php next_image_link(); ?></div>
                        </div>
                    </div>
                    <div class="td-pb-span4 td-main-sidebar">
                        <div class="td-ss-main-sidebar">
                            <?php get_sidebar(); ?>
                        </div>
                    </div>
                    <?php
                    break;

                case 'sidebar_left':
                    ?>
                    <div class="td-pb-span8 td-main-content td-pb-padding td-sidebar-left-content">
                        <div class="td-ss-main-content">
                            <?php
                            if (!empty($post->post_parent) and !empty($post->post_title)) {
                                echo td_page_generator::get_attachment_breadcrumbs($post->post_parent, $post->post_title);
                            }

                            if (is_single()) {?>
                                <h1 class="entry-title td-page-title">
                                <span><?php the_title(); ?></span>
                                </h1><?php
                            } else {?>
                                <h1 class="entry-title td-page-title">
                                <a href="<?php ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                </h1><?php
                            }

                            get_template_part('loop', 'attachment');
                            ?>
                            <div class="td-attachment-prev"><?php previous_image_link(); ?></div>
                            <div class="td-attachment-next"><?php next_image_link(); ?></div>
                        </div>
                    </div>
                    <div class="td-pb-span4 td-main-sidebar">
                        <div class="td-ss-main-sidebar">
                            <?php get_sidebar(); ?>
                        </div>
                    </div>
                    <?php
                    break;

                case 'no_sidebar':
                    ?>
                    <div class="td-pb-span12 td-main-content td-pb-padding">
                        <div class="td-ss-main-content">
                            <?php
                            if (!empty($post->post_parent) and !empty($post->post_title)) {
                                echo td_page_generator::get_attachment_breadcrumbs($post->post_parent, $post->post_title);
                            }


                            if (is_single()) {?>
                                <h1 class="entry-title td-page-title">
                                    <span><?php the_title(); ?></span>
                                </h1><?php
                            } else {?>
                                <h1 class="entry-title td-page-title">
                                    <a href="<?php ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                </h1><?php
                            }

                            get_template_part('loop', 'attachment');
                            ?>
                            <div class="td-attachment-prev"><?php previous_image_link(); ?></div>
                            <div class="td-attachment-next"><?php next_image_link(); ?></div>
                        </div>
                    </div>
                    <?php
                    break;
            }
            ?>
        </div> <!-- /.td-pb-row -->
    </div>
</div> <!-- /.td-container -->

<?php
get_footer();
?>