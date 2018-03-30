<?php
/*  ----------------------------------------------------------------------------
    the blog index template
 */

get_header();

//set the template id, used to get the template specific settings - this was the old home.php template
$template_id = 'home';

//prepare the loop variables
global $loop_module_id, $loop_sidebar_position;
$loop_module_id = td_util::get_option('tds_' . $template_id . '_page_layout', 15); //module 1 is default
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)
?>

<div class="td-container td-blog-index">
    <div class="td-container-border">
        <div class="td-pb-row">
            <?php
            switch ($loop_sidebar_position) {
                default:
                    ?>
                        <div class="td-pb-span8 td-main-content">
                            <div class="td-ss-main-content">
                                <div class="td-page-header td-pb-padding-side">
                                    <?php echo td_page_generator::get_home_breadcrumbs(); ?>
                                </div>
                                <?php
                                    locate_template('loop.php', true);
                                    echo td_page_generator::get_pagination();
                                ?>
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
                    <div class="td-pb-span8 td-main-content td-sidebar-left-content">
                        <div class="td-ss-main-content">
                            <div class="td-page-header td-pb-padding-side">
                                <?php echo td_page_generator::get_home_breadcrumbs(); ?>
                            </div>
                            <?php
                            locate_template('loop.php', true);
                            echo td_page_generator::get_pagination();
                            ?>
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
                    td_global::$load_featured_img_from_template = 'full';

                    ?>
                    <div class="td-pb-span12 td-main-content">
                        <div class="td-ss-main-content">
                            <div class="td-page-header td-pb-padding-side">
                                <?php echo td_page_generator::get_home_breadcrumbs(); ?>
                            </div>
                            <?php
                                locate_template('loop.php', true);
                                echo td_page_generator::get_pagination();
                            ?>
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