<?php
/**
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<div>
		<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'stag' ) ?></label>
		<input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="<?php _e( 'Search here', 'stag' ) ?>" />
		<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'stag' ) ?>" />
		<input type="hidden" name="post_type" value="product" />
	</div>
</form>
