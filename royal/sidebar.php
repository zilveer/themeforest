<?php 

	$l = et_page_config();

	if(!$l['sidebar'] || $l['sidebar'] == 'without' || $l['sidebar'] == 'no_sidebar') return;

	$sidebar = 'main-sidebar';

	if(!empty($l['widgetarea']) && $l['widgetarea'] != 'default') {
		$sidebar = $l['widgetarea'];
	}

 ?>

<div class="<?php esc_attr_e( $l['sidebar-class'] ); ?> sidebar sidebar-<?php esc_attr_e( $l['sidebar'] ); ?>">
	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)): ?>
		
		<div class="sidebar-widget widget_search">
			<h4 class="widget-title"><span><?php _e('Search', ET_DOMAIN) ?></span></h4>
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>	
</div>