<?php
	global $woocommerce;

	if( is_page() ) {
		dynamic_sidebar( 'sidebar-page' );
	} 
	else if($woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag() || $woocommerce && is_product()){
		dynamic_sidebar( 'sidebar-woocommerce' );
	} 
	else {
		dynamic_sidebar('sidebar-blog');
	}
?>
    
