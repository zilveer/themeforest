<?php
/**
 * The template for displaying search forms in Blanco
 *
 */
?>


<?php 

if (etheme_is_woo_exist()) {
	$type = 'product';
} 

elseif (etheme_is_ec_exist()) {
	$type = 'wpsc-product';
}

else {
	$type = 'post';
}

if( get_search_query() == '' ){  
	$text = __('Search for products', ETHEME_DOMAIN);
} else {
	$text = get_search_query();
}

?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" value="<?php echo $text; ?>" name="s" id="s" onblur="if(this.value=='')this.value='<?php _e('Search for products', ETHEME_DOMAIN); ?>'" onfocus="if(this.value=='<?php _e('Search for products', ETHEME_DOMAIN); ?>')this.value=''" />
	<input type="submit" id="searchsubmit" class="button add_to_cart_button product_type_simple" value="<?php _e('Go', ETHEME_DOMAIN); ?>" />
	<input type="hidden" name="post_type" value="<?php echo $type; ?>" >
</form>