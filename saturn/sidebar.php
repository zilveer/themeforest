<?php 
if( !defined('ABSPATH') ) exit; // Don't access me directly.
if( is_single() && get_post_type() == 'product' || (function_exists( 'is_shop' ) && is_shop()) || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ){
	$default_sidebar = 'woocommerce-primary';
}
else{
	$default_sidebar = 'sidebar-primary';
}
if( !is_active_sidebar( apply_filters( 'saturn_custom_sidebar' , $default_sidebar ) ) )
	return;
?>
<div class="col-md-3 col-sidebar">
	<div class="sidebar">
		<?php dynamic_sidebar( apply_filters( 'saturn_custom_sidebar' , $default_sidebar ) );?>			
	</div><!-- end sidebar -->
</div><!-- end sidebar column -->