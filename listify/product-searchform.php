<?php
/**
 * The template for displaying a standard search form.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search for:', 'listify' ); ?></span>
		<input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search for:" />
	</label>
	<button type="submit" class="search-submit"><i class="ion-search-strong"></i></button>
	<input type="hidden" name="post_type" value="product" />
</form>
