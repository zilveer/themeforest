<?php global $wp_query;
$arrgs = $wp_query->query_vars; ?>
<div class="searchingForm search-widget widget">
	<form method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
          <input value="<?php echo (isset($arrgs['s']) && $arrgs['s']) ? $arrgs['s'] : ''; ?>" name="s" id="s" type="text" class="span12" placeholder="<?php _e('Search', 'ct_theme')?>">
  </form>
</div>