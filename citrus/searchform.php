<?php $search_text = empty($_GET['s']) ? '' : get_search_query(); ?> 
<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url('/')); ?>">
    <input id="s" name="s" type="text" value="<?php echo $search_text;?>" class="text_input" placeholder="<?php _e('Search', 'dt_themes'); ?>" />
    <input type="hidden" name="search-type" value="default" />
	<input type="submit" value="" />
</form>