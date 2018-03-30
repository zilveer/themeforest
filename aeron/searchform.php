<div class="widget_search">
	<form name="search" id="search" method="get" action="<?php echo home_url(); ?>">
		<input name="s" type="text" placeholder="<?php _e('Search','ABdev_aeron'); ?>" value="<?php echo get_search_query(); ?>">
		<a class="submit"><i class="icon-search"></i></a>
	</form>
</div>