<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Paradise
 */
?>
<?php get_sidebar('footer'); ?>
	<!-- Start Footer  -->
<div id="footer">
	<p class="copy"><?php echo get_option('copyright'); ?></p>
	<p class="developed_by"><?php _e('Developed By:', TEMPLATENAME); ?>&nbsp;<a href="http://themeforest.net/user/ThemeMakers?ref=ThemeMakers">ThemeMakers</a></p>
	<div class="clear"></div>
</div>
	<!-- End Footer  -->
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();

if (is_portfolio() || is_tax('gallery')):
?>

<!-- PrettyPhoto Lightbox Plugin Init -->
<script type="text/javascript">
function reloadPrettyPhoto() {
	jQuery(".pp_pic_holder").remove();
	jQuery(".pp_overlay").remove();
	jQuery(".ppt").remove();
	init_pretty();
}

function init_pretty(){
	jQuery('a[rel^="prettyPhoto"]').prettyPhoto({
		animationSpeed: 'normal',
		opacity: 0.70,
		showTitle: false,
		allowresize: true,
		counter_separator_label: '/',
		theme: '<?php echo get_option('lightbox_skin'); ?>'
	});
};

jQuery(document).ready(function($){
// Image Preload
	$('a.gall').preloader({
		delay:300,
		check_timer:100,
		ondone: init_pretty,
		oneachload:function(image){  },
		fadein:300,
		icon_src: '<?php echo get_bloginfo('template_url').'/images/loader.gif'; ?>'
	});
});
</script>
<?php endif; ?>
</body>
</html>