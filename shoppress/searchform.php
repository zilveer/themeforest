<?php require(gp_inc . 'options.php'); global $dirname; ?>

<form method="get" id="searchform" action="<?php echo home_url(); ?>/">

	<input type="text" name="s" id="searchbar" value="" placeholder="<?php _e('Search', 'gp_lang'); ?>" /><input type="submit" id="searchsubmit" value="<?php _e('Search', 'gp_lang'); ?>" />
	
	<?php if(get_option($dirname.'_search_criteria') == "Products") { ?>
		<input type="hidden" name="post_type" value="product" />
	<?php } elseif(get_option($dirname.'_search_criteria') == "Posts") { ?>
		<input type="hidden" name="post_type" value="post" />
	<?php } elseif(get_option($dirname.'_search_criteria') == "Posts and pages") { ?>
		<input type="hidden" name="post_type[]" value="post" />
		<input type="hidden" name="post_type[]" value="page" />	
	<?php } elseif(get_option($dirname.'_search_criteria') == "Posts, pages and products") { ?>
		<input type="hidden" name="post_type[]" value="post" />
		<input type="hidden" name="post_type[]" value="page" />	
		<input type="hidden" name="post_type[]" value="product" />
	<?php } ?>	

</form>