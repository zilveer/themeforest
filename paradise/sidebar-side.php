<?php
/**
 * @package WordPress
 * @subpackage Paradise
 */
global $_theme_side_sidebar;
?>
		<!-- Sidebar -->
		<div id="sidebar">
			<?php if ($_theme_side_sidebar == 'disable' || !dynamic_sidebar($_theme_side_sidebar)): ?>
				<div class="widget-container widget_search">
					<h3><?php _e('Search', TEMPLATENAME); ?></h3>
					<?php get_search_form(); ?>
				</div>

				<div class="widget-container widget_archive">
				<h3><?php _e( 'Archives', TEMPLATENAME ); ?></h3>
					<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</div>

				<div class="widget-container widget_meta">
				<h3><?php _e( 'Meta', TEMPLATENAME ); ?></h3>
					<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
		<!-- End Sidebar -->
<script type="text/javascript">
	jQuery(window).load(function() {
		var offset = jQuery('#sidebar').height();
		jQuery('#content > .box').each(function(index) {
			offset -= this.offsetHeight + parseInt(jQuery(this).css('margin-top')) + parseInt(jQuery(this).css('margin-bottom'));
		});
		if (offset > 0)
			jQuery('#content .box:last-child').height(jQuery('#content .box:last-child').height() + offset);
	});
</script>