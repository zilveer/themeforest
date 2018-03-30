<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('main-sidebar')): ?>
	
	<div class="sidebar-widget">
		<h4 class="widget-title"><?php _e('Search', ETHEME_DOMAIN) ?></h4>
		<?php get_search_form(); ?>
	</div>

<?php endif; ?>	