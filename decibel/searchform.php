<?php
/**
 * The template for displaying search forms
 *
 */
?>
<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php _e( 'Type and hit enter...', 'wolf' ); ?>" />
	<input type="submit" class="submit" id="searchsubmit" value="<?php _e( 'Search', 'wolf' ); ?>" />
</form>