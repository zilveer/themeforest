<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<?php
// Related products extra class
$new_class = '';
if ( is_product() ) {
	$upsells_qty = (handy_get_option('upsells_qty') != '') ? handy_get_option('upsells_qty') : '2';
	$related_qty = (handy_get_option('related_products_qty') != '') ? handy_get_option('related_products_qty') : '4';
	$new_class = ' related-cols-'.esc_attr($related_qty).' upsells-cols-'.esc_attr($upsells_qty).' lazyload';
	if (class_exists('WCV_Vendors')) {
		$wcv_related_qty = (handy_get_option('wcv_qty') != '') ? handy_get_option('wcv_qty') : '4';
		$new_class .= ' wcv-cols-'.esc_attr($wcv_related_qty);
	}
}
?>
<ul class="products<?php echo esc_attr($new_class); ?>" data-expand="-100">
