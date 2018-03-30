<?php
/*  ----------------------------------------------------------------------------
    the archive(s) template
 */

get_header();

global $loop_module_id, $loop_sidebar_position;

// get the current taxonomy object - note that it's note complete
$current_term_obj = get_queried_object();

//read the loop variables for this specific taxonomy
$loop_module_id = td_util::get_taxonomy_option($current_term_obj->taxonomy, 'tds_taxonomy_page_layout');
$loop_sidebar_position = td_util::get_taxonomy_option($current_term_obj->taxonomy, 'tds_taxonomy_sidebar_pos');

if (empty($loop_module_id)) {
    $loop_module_id = 1; // module_1 is the default
}
?>

    <div class="td-container">
        <div class="td-container-border">
            <div class="td-pb-row">
                <?php
                switch ($loop_sidebar_position) {
                    default:
                        ?>
                        <div class="td-pb-span8 td-main-content">
                            <div class="td-ss-main-content">
                                <div class="td-page-header td-pb-padding-side">
                                    <?php echo td_page_generator::get_taxonomy_breadcrumbs($current_term_obj); // get the breadcrumbs - /includes/wp_booster/td_page_generator.php ?>

                                    <h1 class="entry-title td-page-title">
                                        <span><?php echo $current_term_obj->name ?></span>
                                    </h1>
                                </div>

                                <?php locate_template('loop.php', true);?>

                                <?php echo td_page_generator::get_pagination(); // get the pagination - /includes/wp_booster/td_page_generator.php ?>
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
                                    <?php echo td_page_generator::get_taxonomy_breadcrumbs($current_term_obj); // get the breadcrumbs - /includes/wp_booster/td_page_generator.php ?>

                                    <h1 class="entry-title td-page-title">
                                        <span><?php echo $current_term_obj->name ?></span>
                                    </h1>
                                </div>

                                <?php locate_template('loop.php', true);?>

                                <?php echo td_page_generator::get_pagination(); // get the pagination - /includes/wp_booster/td_page_generator.php ?>
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
                                <div class="td-page-header td-pb-padding-side">
                                    <?php echo td_page_generator::get_taxonomy_breadcrumbs($current_term_obj); // get the breadcrumbs - /includes/wp_booster/td_page_generator.php ?>

                                    <h1 class="entry-title td-page-title">
                                        <span><?php echo $current_term_obj->name ?></span>
                                    </h1>
                                </div>
                                <?php locate_template('loop.php', true);?>

                                <?php echo td_page_generator::get_pagination(); // get the pagination - /includes/wp_booster/td_page_generator.php ?>
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