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
global $woocommerce_loop;
$columns = isset($woocommerce_loop['columns']) && absint($woocommerce_loop['columns']) > 0 ? ' columns-'.absint($woocommerce_loop['columns']) : ' columns-'.dh_get_theme_option('woo-per-row',3);
$data_columns = isset($woocommerce_loop['columns']) && absint($woocommerce_loop['columns']) > 0 ? absint($woocommerce_loop['columns']) : absint(dh_get_theme_option('woo-per-row',3));
?>
<ul class="products<?php echo esc_attr($columns)?>" data-columns="<?php echo esc_attr($data_columns)?>">