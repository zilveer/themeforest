<?php
/**
 * Search form template
 *
 * @package wpv
 */
?>
<form role="search" method="get" class="searchform clearfix" action="<?php echo home_url( '/' ); ?>">
	<label for="search-text-widget" class="visuallyhidden"><?php _e('Search for:', 'health-center') ?></label>
	<input id="search-text-widget" type="text" value="" name="s" placeholder="<?php _e('Search', 'health-center')?>" required="required" />
	<input type="submit" value="<?php _e('Search', 'health-center')?>" />
	<?php if(defined('ICL_LANGUAGE_CODE')): ?>
		<input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE; ?>"/>
	<?php endif ?>
</form>