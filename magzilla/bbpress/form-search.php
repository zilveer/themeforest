<?php

/**
 * Search 
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form method="get" id="bbp-search-form" class="form-horizontal" action="<?php bbp_search_url(); ?>">
	<div class="form-group">
		<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
			<label class="screen-reader-text hidden" for="bbp_search"><?php _e( 'Search for:', 'bbpress' ); ?></label>
			<input type="hidden" name="action" value="bbp-search-request" />
			<input tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" class="form-control fave-search" />
		</div>
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
			<input tabindex="<?php bbp_tab_index(); ?>" class="button btn btn-theme btn-block" type="submit" id="bbp_search_submit" value="<?php esc_attr_e( 'Search', 'bbpress' ); ?>" />
		</div>
	</div>
</form>
