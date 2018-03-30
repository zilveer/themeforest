<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $woocommerce_loop;
// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', etheme_get_option('prodcuts_per_row') );

    $view_mode = etheme_get_option('view_mode'); 
    if( !empty($woocommerce_loop['view_mode'])) {
            $view_mode = $woocommerce_loop['view_mode'];
    } else {
            $woocommerce_loop['view_mode'] = $view_mode;
    }
    
    if($view_mode == 'list' || $view_mode == 'list_grid') {
        $view_class = 'products-list'; 
    }else{
        $view_class = 'products-grid'; 
    }
    
?>
<div class="row products-loop <?php echo $view_class; ?> row-count-<?php echo $woocommerce_loop['columns']; ?>">