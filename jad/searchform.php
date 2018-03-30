<form id="search" class="clearfix" method="get" action="<?php echo home_url(); ?>">
	<div class="field alignleft">
		<input type="text" name="s" value="<?php the_search_query(); ?>" />
	</div>
	<div class="search-btn">
		<input type="submit" value="" />
	</div>
</form>