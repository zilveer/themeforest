<?php

/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<form role="search" method="get" class="search-form" action="<?php bbp_search_url(); ?>">
	<div class="search-form-inner">
		<div class="input-group">
			<span class="input-group-addon" id="search-addon"><span class="fa fa-search"></span></span>
			<input type="hidden" name="action" value="bbp-search-request" />
			<input tabindex="<?php echo esc_attr( bbp_get_tab_index() ); ?>" type="text" name="bbp_search" class="form-control search-field" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'barcelona' ); ?>" title="<?php echo esc_attr_x( 'Search for:', 'label', 'barcelona' ) ?>" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" aria-describedby="search-addon" />
			<span class="input-group-btn">
				<button tabindex="<?php echo esc_attr( bbp_get_tab_index() ); ?>" type="submit" class="btn">
					<span class="screen-reader-text btn-search-text"><?php echo esc_attr_x( 'Search', 'submit button', 'default' ); ?></span>
					<span class="btn-search-icon"><span class="fa fa-search"></span></span>
				</button>
			</span>
		</div>
	</div>
</form>