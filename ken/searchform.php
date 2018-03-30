<form class="mk-searchform" method="get" id="searchform" action="<?php echo home_url(); ?>">
	<input type="text" class="text-input" value="<?php if(!empty($_GET['s'])) echo get_search_query(); ?>" name="s" id="s" />
	<i class="mk-icon-search"><input value="" type="submit" class="search-button" type="submit" /></i>
</form> 