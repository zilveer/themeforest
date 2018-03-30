<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce_loop, $mango_shop_page_settings,$columns ;

$mango_shop_page_settings = array();
$mango_shop_page_settings['grid_ver'] = '';
$mango_shop_page_settings['list_ver']  = '';
$mango_shop_page_settings['mango_shop_view']  = mango_shop_view();
if($mango_shop_page_settings['mango_shop_view']=='grid'){
    $mango_shop_page_settings['grid_ver'] = mango_shop_grid_version();
}else{
    $mango_shop_page_settings['list_ver'] = mango_shop_list_version();
}
$columns = '';
if(is_shop()  || is_product_taxonomy() ){
    $columns = mango_shop_columns();
}else{
    $columns = $woocommerce_loop['columns'];
}

if(isset($_GET['product_cols']) && $_GET['product_cols']){
    $cols = array(1,2,3,4,5,6);
    if(in_array($_GET['product_cols'], $cols)) {
        $columns = $_GET[ 'product_cols' ];
    }
}
$pr_id = apply_filters("mango_filter_product_container_id","product_list");
$pr_class = apply_filters("mango_filter_product_container_class","mango_products_container");
?>
    <div id="<?php echo esc_attr($pr_id); ?>" class="<?php echo  esc_attr($pr_class); ?> clearfix products"  data-columns="<?php echo ($columns)?$columns:1; ?>" data-view="<?php echo $mango_shop_page_settings['mango_shop_view']; ?>" >