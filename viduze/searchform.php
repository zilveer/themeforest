<form method="get" id="searchform" action="<?php echo home_url(); ?>/" class="form-search">
	<div id="search-text">
		<input class="" type="text" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" />
	</div>
	<input class="hover-style" type="submit" id="searchsubmit" value="Submit" />
</form>
<div> </div>