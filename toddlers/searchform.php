<?php
/**
 * Search Form Template
**/
?>

<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-inline">
    <fieldset>
	    <div class="input-group">
		    <div class="inner-addon left-addon">
				 <i class="icon icon-search"></i>
		   		 <input type="text" name="s" placeholder="<?php _e("Search + Enter", "toddlers");?>" value="<?php the_search_query(); ?>" class="searchfield form-control" />
			</div>
	    </div>
    </fieldset>
</form>