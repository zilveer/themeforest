<?php global $wp_query; $arrgs = $wp_query->query_vars; ?>
<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">

	<label class="<?php echo is_404() ? '' : 'hide'?>"" for="s"><?php _e('Search for:', 'ct_theme'); ?> </label>
	<input type="text" value="<?php echo (isset($arrgs['s']) && $arrgs['s']) ? $arrgs['s'] : ''; ?>" name="s" id="s" class="search-query input-medium" placeholder="<?php _e('Type and press enter', 'ct_theme'); ?>">
</form>