<?php
/**
 * The template for displaying search forms in humbleshop
 *
 * @package humbleshop
 */
?>
<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<!-- <span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'humbleshop' ); ?></span> -->
	<input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'humbleshop' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	<button class="btn btn-link" type="submit"><i class="fa fa-search"></i></button>
	<!-- <input type="submit" class="search-submit btn btn-link" value="<?php echo esc_attr_x( 'Search', 'submit button', 'humbleshop' ); ?>"> -->
</form>
