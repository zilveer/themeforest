<form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
	<div id="search-text">
		<?php 
			$gdl_search_text = get_search_query();
			global $gdl_admin_translator;
			
			if( $gdl_admin_translator == 'enable' ){
				$gdl_default_text = get_option(THEME_SHORT_NAME.'_search_text','Search...');
			}else{
				$gdl_default_text = __('Search...','gdl_front_end');
			}
			
			if( empty($gdl_search_text) ){
				$gdl_search_text = $gdl_default_text;
			} 
		
		?>
		<input type="text" name="s" id="gdl-search-input" value="<?php echo $gdl_search_text ?>" data-default="<?php echo $gdl_default_text ?>" autocomplete="off" />
		<input type="submit" id="searchsubmit" value="" />
	</div>
	<br class="clear">
</form>
