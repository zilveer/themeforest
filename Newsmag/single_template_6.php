<?php
// Template 6 - post-final-6.psd - full image background
//get the global sidebar position from td_single_template_vars.php

locate_template('includes/wp_booster/td_single_template_vars.php', true);

get_header();

global $loop_sidebar_position, $post;

$td_post_featured_image = td_util::get_featured_image_src($post->ID, 'full');

//if we have a featured image, show it
if (!empty($td_post_featured_image)) {

	ob_start();

	?>
	<script>

		(function() {

			var td_homepage_full_bg_image_wrapper1 = jQuery('<div class="td-full-screen-header-image-wrap"></div>');
			var td_homepage_full_bg_image_wrapper2 = jQuery('<div id="td-full-screen-header-image" class="td-image-gradient"></div>');
			var td_homepage_full_bg_image = jQuery('<img class="td-backstretch" src="<?php echo $td_post_featured_image ?>"/>');

			td_homepage_full_bg_image_wrapper1.append(td_homepage_full_bg_image_wrapper2);
			td_homepage_full_bg_image_wrapper2.append(td_homepage_full_bg_image);

			// add to body
			jQuery('#td-outer-wrap').prepend(td_homepage_full_bg_image_wrapper1);

			// run the backstracher
			var td_backstr_item = new tdBackstr.item();
			td_backstr_item.wrapper_image_jquery_obj = td_homepage_full_bg_image_wrapper1;
			td_backstr_item.image_jquery_obj = td_homepage_full_bg_image;
			tdBackstr.add_item(td_backstr_item);

		})();

	</script>
	<?php
	$buffer = ob_get_clean();
	$js = "\n". td_util::remove_script_tag($buffer);
	td_js_buffer::add_to_footer($js);
}

$td_mod_single = new td_module_single($post);

?>
<article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class('td-post-template-6'));?>" <?php echo $td_mod_single->get_item_scope();?>>


    <div class="template6-header">
        <div class="td-post-header td-container td-parallax-header" id="td_parallax_header_6">

            <header class="td-pb-padding-side">
                <?php echo $td_mod_single->get_category(); ?>
                <?php echo $td_mod_single->get_title();?>


                <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                    <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle']; ?></p>
                <?php } ?>


                <div class="meta-info">

                    <?php echo $td_mod_single->get_author();?>
                    <?php echo $td_mod_single->get_date(false);?>
                    <?php echo $td_mod_single->get_views();?>
                    <?php echo $td_mod_single->get_comments();?>
                </div>
                <div class="td-read-down"><a href="#"><i class="td-icon-read-down"></i></a></div>
            </header>
        </div>
    </div>


    <div class="template6-content">
        <div class=" td-container">
            <div class="td-container-border">
                <div class="td-pb-row">
                    <?php
                    switch ($loop_sidebar_position) {
                        default: // sidebar right
                            ?>
                                <div class="td-pb-span8 td-main-content" role="main">
                                    <div class="td-ss-main-content">
                                        <?php
                                        locate_template('loop-single-6.php', true);
                                        comments_template('', true);
                                        ?>
                                    </div>
                                </div>
                                <div class="td-pb-span4 td-main-sidebar" role="complementary">
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
                                    locate_template('loop-single-6.php', true);
                                    comments_template('', true);
                                    ?>
                                </div>
                            </div>
                            <div class="td-pb-span4 td-main-sidebar" role="complementary">
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
                                    locate_template('loop-single-6.php', true);
                                    comments_template('', true);
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
    </div>
</article> <!-- /.post -->

<?php

get_footer();