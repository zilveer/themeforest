<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

/* Note: This file has been altered by Laborator */

global $is_related_products;

$class = 'col-sm-12';

if(SHOP_SIDEBAR && ! $is_related_products)
{
	$class = 'col-md-9 col-sm-8';

	if(get_data('shop_sidebar') == 'left')
		$class .= ' pull-right-md';
}

$shop_loop_masonry = get_data( 'shop_loop_masonry' );

if( $shop_loop_masonry ) {
	wp_enqueue_script( 'isotope' );
}
?>
<div class="products-container <?php echo $class; ?>">

	<div class="row">

		<div class="products <?php echo $shop_loop_masonry ? ' products-masonry' : ''; ?>"<?php if( $shop_loop_masonry ): ?> data-layout-mode="<?php echo get_data( 'shop_loop_masonry_layout_mode' ); ?>"<?php endif; ?>>