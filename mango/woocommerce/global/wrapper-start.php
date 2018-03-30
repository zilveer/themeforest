<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $mango_settings,$args,$mango_layout_columns, $post,$woocommerce_loop;
if ( empty( $woocommerce_loop['columns'] ) ) {
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

$mango_layout_columns = mango_page_columns();
$mango_class_name = mango_class_name ();
?>
<div class="<?php echo mango_main_container_class() ?> mango">
    <div class="row">
        <?php if(!is_product()){ ?>
<!--    data-columns="--><?php //echo $woocommerce_loop['columns']; ?><!--" data-view="--><?php //echo mango_shop_view(); ?><!--"-->
    <div id="products_container" class="<?php echo esc_attr($mango_class_name); ?>">
        <?php }else{ ?>
            <div class="<?php echo esc_attr($mango_class_name); ?>">
        <?php } ?>