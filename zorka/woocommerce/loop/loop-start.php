<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce_loop,$zorka_product_layout;
if (empty( $woocommerce_loop['columns'] ) ) {
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns',4);
}
$woocommerce_loop['loop'] = '';
$class = array();
$class[] = 'product-listing woocommerce row clearfix';
$class[] = 'columns-' . $woocommerce_loop['columns'];
if (isset($zorka_product_layout) && $zorka_product_layout == 'slider') {
    $class[] = 'product-slider';
}
//$class[] = 'product_animated';

$class_names = join(' ',$class);

if (isset($zorka_product_layout) && ($zorka_product_layout  == 'slider')) {

    $data_plugin_options = '{"items" :' . $woocommerce_loop["columns"] .',"pagination" : false, "navigation" : true';

    if ($woocommerce_loop['columns'] < 4) {
        switch ($woocommerce_loop['columns']) {
            case 3 :
                $data_plugin_options .= ',"itemsDesktop" : [1199,3]';
            break;
            case 2 :
                $data_plugin_options .= ',"itemsDesktop" : [1199,2], "itemsDesktopSmall" : [980,2]';
            break;
            case 1 :
                $data_plugin_options .= ',"singleItem": true';
            break;
        }
    }
    $data_plugin_options .= '}';

}

?>
<div data-col="<?php echo esc_attr($woocommerce_loop['columns']); ?>" class="<?php echo esc_attr($class_names); ?>">
<?php if (isset($zorka_product_layout) && ($zorka_product_layout  == 'slider')) : ?>
<div class="owl-carousel" data-plugin-options='<?php echo wp_kses_post($data_plugin_options); ?>'>
<?php endif; ?>