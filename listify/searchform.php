<?php
/**
 * The template for displaying a standard search form.
 *
 * @package Listify
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search for:', 'listify' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'listify' ); ?>" value=""
		name="s" title="<?php echo esc_attr_e( 'Search for:', 'listify' ); ?>" />
	</label>
	<button type="submit" class="search-submit"></button>
</form>
