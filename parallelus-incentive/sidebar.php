<?php 
/**
 *
 * This template is only used as a fallback. If the theme's Layout Manager is disabled 
 * or a layout is not assigned the theme falls back to the default WP template structure 
 * and this file may be loaded to include the default sidebar.
 */

if ( is_active_sidebar( 'sidebar-default' ) && ! has_layout() ) : 
	?>
	<div id="sidebar" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-default' ); ?>
	</div><!-- .widget-area -->
	<?php 
endif; 
?>