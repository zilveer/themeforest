<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Search Form Template
 * Created by CMSMasters
 * 
 */
?>

<div class="search_line">
	<form method="get" action="<?php echo home_url(); ?>">
		<p>
			<input name="s" id="error_search" placeholder="<?php _e('enter keywords', 'cmsmasters'); ?>" value="" type="text">
			<input value="" type="submit">
		</p>
	</form>
</div>
