<div class="clearfix">
<form action="<?php echo esc_url(home_url("/")); ?>" id="searchform" method="get" role="search">
	<input name="s" id="s" type="text" class="search" placeholder="<?php _e("Search..",'Pixelentity Theme/Plugin'); ?>" value="<?php echo get_search_query() ? get_search_query() : ""; ?>">
	<input type="submit" value="<?php _e("Go",'Pixelentity Theme/Plugin'); ?>" class="search-submit" />
</form>
</div>