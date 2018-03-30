<?php
/*  ----------------------------------------------------------------------------
    the blog index template
 */

get_header();

global $loop_module_id, $loop_sidebar_position, $cur_cat_obj;

$cur_cat_id = get_query_var('cat');
$cur_cat_obj = get_category($cur_cat_id);


//read the per category setting
$tdc_layout = td_util::get_category_option($cur_cat_id, 'tdc_layout');//swich by RADU A, get_tax_meta($cur_cat_id, 'tdc_layout');
$tdc_sidebar_pos = td_util::get_category_option($cur_cat_id, 'tdc_sidebar_pos');////swich by RADU A,  get_tax_meta($cur_cat_id, 'tdc_sidebar_pos');

//set the template id, used to get the template specific settings
$template_id = 'category';

//prepare the loop variables

$loop_module_id = td_util::get_option('tds_' . $template_id . '_page_layout', 1); //module 1 is default
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)

//override the category global template with the category specific settings
if (!empty($tdc_layout)) {
    $loop_module_id = $tdc_layout;
}

if (!empty($tdc_sidebar_pos)) {
    $loop_sidebar_position = $tdc_sidebar_pos;
}
?>

<?php td_api_category_template::_helper_show_category_template() ?>

<div class="td-container td-category-container">
    <div class="td-container-border">

        <?php td_api_category_top_posts_style::_helper_show_category_top_posts_style() ?>



        <!-- content -->
        <div class="td-pb-row">
            <?php
                switch ($loop_sidebar_position) {

                    default: //default: sidebar right
                        ?>
                            <div class="td-pb-span8 td-main-content">
                                <div class="td-ss-main-content">
                                    <?php locate_template('parts/page-category-header.php', true);?>
                                    <?php locate_template('loop.php', true);?>

                                    <?php echo td_page_generator::get_pagination(); ?>
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
                                <?php locate_template('parts/page-category-header.php', true);?>
                                <?php locate_template('loop.php', true);?>

                                <?php echo td_page_generator::get_pagination(); ?>
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
                        <div class="td-pb-span12 td-main-content">
                            <div class="td-ss-main-content">
                                <?php locate_template('parts/page-category-header.php', true);?>
                                <?php locate_template('loop.php', true);?>

                                <?php echo td_page_generator::get_pagination(); ?>
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