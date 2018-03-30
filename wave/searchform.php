<?php
/**
 * The template for displaying search form
 */
?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'dd_string' ); ?>" />
		<input type="submit" class="submit button" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'SEARCH', 'dd_string' ); ?>" />
	</form>
