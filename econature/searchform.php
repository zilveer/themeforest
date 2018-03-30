<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Search Form Template
 * Created by CMSMasters
 * 
 */
?>

<div class="search_bar_wrap">
	<form method="get" action="<?php echo home_url(); ?>">
		<p>
			<input name="s" placeholder="<?php _e('enter keywords', 'cmsmasters'); ?>" value="" type="text" />
			<button type="submit" class="cmsms-icon-search-7"></button>
		</p>
	</form>
</div>

