<?php

/**
 * Search 
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>">
	<div>
		<label class="screen-reader-text" for="bbp_search"><?php esc_html_e( 'Search for:', 'hashmag' ); ?></label>
		<input type="hidden" name="action" value="bbp-search-request" />
		<input placeholder="<?php esc_html_e('Search the forum...', 'hashmag'); ?>" tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" />
		<input tabindex="<?php bbp_tab_index(); ?>" class="button" type="submit" id="bbp_search_submit" value="" />
	</div>
</form>
