<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce_loop,$g5plus_woocommerce_loop;

$columns = $g5plus_woocommerce_loop['columns'];
if (!isset($columns) || empty($columns)) {
    $columns =  $woocommerce_loop['columns'];
}


$class = array();
$class[] = 'product-listing woocommerce clearfix';
$archive_product_layout =  isset($g5plus_woocommerce_loop['layout']) ? $g5plus_woocommerce_loop['layout'] : '';
$masonry = isset($g5plus_woocommerce_loop['masonry']) ? $g5plus_woocommerce_loop['masonry'] : '';
if ($archive_product_layout == 'slider') {
    $class[] = 'product-slider';
} else {
    if($masonry=='')
        $class[] = 'columns-' . $columns;
}

$class_names = join(' ', $class);

if ($archive_product_layout == 'slider') {

    $autoPlay = isset($g5plus_woocommerce_loop['autoPlay']) ? $g5plus_woocommerce_loop['autoPlay'] : 'false';

    $autoHeight = isset($g5plus_woocommerce_loop['autoHeight']) ? $g5plus_woocommerce_loop['autoHeight'] : 'false';

    $transitionStyle = isset($g5plus_woocommerce_loop['transitionStyle']) ? $g5plus_woocommerce_loop['transitionStyle'] : 'false';

    $data_plugin_options = '{"items" :' . $columns . ',"pagination" : false, "navigation" : true';


    if ($autoPlay != 'false') {
        $data_plugin_options .= ', "autoPlay" : '.$autoPlay;
    }


    if ($transitionStyle != 'false') {
        $data_plugin_options .= ', "transitionStyle" : "'.$transitionStyle .'"';
    }

    if ($autoHeight != 'false') {
        $data_plugin_options .= ', "autoHeight" : '.$autoHeight;
    }

    switch ($columns) {
        case 3 :
            $data_plugin_options .= ',"itemsDesktop" : [1199,3],"itemsTablet" : [768, 3], "itemsTabletSmall": [600, 2]';
            break;
        case 2 :
            $data_plugin_options .= ',"itemsDesktop" : [1199,2], "itemsDesktopSmall" : [980,2]';
            break;
        case 1 :
            $data_plugin_options .= ',"singleItem": true';
            break;
        default:
            $data_plugin_options .= ',"itemsDesktop" : [1199,'.$columns.'], "itemsDesktopSmall" : [980,3], "itemsTablet" : [768, 3], "itemsTabletSmall": [600, 2]';
            break;
    }
    $data_plugin_options .= '}';
}

?>
<div class="<?php echo esc_attr($class_names); ?>">
<?php if ($archive_product_layout == 'slider') : ?>
<div class="owl-carousel" data-plugin-options='<?php echo wp_kses_post($data_plugin_options); ?>'>
<?php endif; ?>
