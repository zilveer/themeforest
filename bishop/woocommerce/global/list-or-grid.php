<?php
/**
 * Shop list or grid
*/

if ( is_single() || yit_get_option( 'shop-grid-list-option' ) == 'no' || ! have_posts() ) return;

global $woocommerce_loop;

if ( !( isset( $woocommerce_loop['view'] ) && ! empty( $woocommerce_loop['view'] ) ) )
    $woocommerce_loop['view'] = yit_get_option( 'shop-view-type', 'grid' );

?>
<p id="list-or-grid">
    <span class="view-title"><?php _e( 'view style:', 'yit' ) ?></span>
    <a class="grid-view<?php if ( $woocommerce_loop['view'] == 'grid' ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'view', 'grid' ) ) ?>" title="<?php _e( 'Switch to grid view', 'yit' ) ?>">
        <span class="fa fa-th-large"></span>
    </a>
    <a class="list-view<?php if ( $woocommerce_loop['view'] == 'list' ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'view', 'list' ) ) ?>" title="<?php _e( 'Switch to list view', 'yit' ) ?>">
        <span class="fa fa-list-ul"></span>
    </a>
</p>