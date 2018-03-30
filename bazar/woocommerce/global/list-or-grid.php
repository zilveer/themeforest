<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
if ( is_single() ) return;

global $woocommerce_loop;

?>
<p class="list-or-grid">
    <?php _e( 'View as', 'yit' ) ?>
    <a class="grid-view<?php if ( $woocommerce_loop['view'] == 'grid' ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'view', 'grid' ) ) ?>" title="<?php _e( 'Switch to grid view', 'yit' ) ?>"><?php _e( 'grid', 'yit' ) ?></a>
    <a class="list-view<?php if ( $woocommerce_loop['view'] == 'list' ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'view', 'list' ) ) ?>" title="<?php _e( 'Switch to list view', 'yit' ) ?>"><?php _e( 'list', 'yit' ) ?></a>
</p>