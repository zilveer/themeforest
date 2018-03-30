<?php get_header();
#Emulate default settings for page without personal ID
$gt3_theme_pagebuilder = gt3_get_default_pb_settings();
global $wp_query_in_shortcodes, $paged;
?>

<div class="content_wrapper">
    <div class="container">
        <div class="content_block <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?> row">
            <div class="fl-container <?php echo (($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <div class="row">
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea">
                            <?php
                            echo '<div class="row"><div class="span12 module_cont module_blog">';
                            while (have_posts()) : the_post();
                                get_template_part("bloglisting");
                            endwhile; gt3_get_theme_pagination(); wp_reset_query();
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

<script>
	jQuery(document).ready(function(){
		centerWindow();
	});
	jQuery(window).load(function(){
		centerWindow();
	});
	jQuery(window).resize(function(){
		centerWindow();
		setTimeout('centerWindow()',500);
		setTimeout('centerWindow()',1000);
	});
	function centerWindow() {
		setTop = (window_h - site_wrapper.height() - parseInt(site_wrapper.css('padding-top')) - parseInt(site_wrapper.css('padding-bottom')))/2;
		if (setTop < 0) {
			site_wrapper.addClass('fixed');
			site_wrapper.css('top', 0+'px');
		} else {
			site_wrapper.css('top', setTop +'px');
			site_wrapper.removeClass('fixed');
			jQuery('body').removeClass('addPadding');
		}
	}
</script>

<?php get_footer(); ?>