<div class="gdl-search-form">
	<form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
		<?php
			$search_val = get_search_query();
			if( empty($search_val) ){
				$search_val = __("Type keywords..." , "gdlr_translate");
			}
		?>
		<div class="search-text" id="search-text">
			<input type="text" name="s" id="s" autocomplete="off" data-default="<?php echo $search_val; ?>" />
		</div>
		<input type="submit" id="searchsubmit" value="" />
		<div class="clear"></div>
	</form>
</div>