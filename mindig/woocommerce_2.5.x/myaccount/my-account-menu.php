<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $woocommerce, $wp;

$my_account_url = get_permalink( wc_get_page_id( 'myaccount' ) );
?>


<div class="user-profile clearfix">

    <div class="user-image">
        <a href="<?php echo $my_account_url ?>" >
            <?php
                $current_user = wp_get_current_user();
                $user_id = $current_user->ID;
                echo get_avatar( $user_id, 90 );
            ?>
        </a>
    </div>
    <div class="user-logout">
        <span class="username"><?php echo $current_user->display_name?></span>
        <?php if( isset( $current_user ) && $current_user->ID != 0 ) : ?>
            <span class="logout"><a href="<?php echo wc_get_endpoint_url('customer-logout', '',  $my_account_url ); ?>"><?php _e( 'logout', 'yit' ) ?></a></span>
        <?php endif; ?>
    </div>

</div>

<div class="clear"></div>
<ul>
    <li>
        <span class="fa fa-folder-open"></span>
        <a href="<?php echo wc_get_endpoint_url( 'view-order', '', $my_account_url ) ?>" title="<?php _e( 'My Orders', 'yit' ); ?>" <?php echo  isset( $wp->query_vars['view-order'] )  ? ' class="active"' : ''; ?> ><?php _e( 'My Orders', 'yit' ); ?></a>
    </li>
    <li>
        <span class="fa fa-download"></span>
        <a href="<?php echo wc_get_endpoint_url('recent-downloads', '', $my_account_url ) ?>" title="<?php _e( 'My Download', 'yit' ); ?>"<?php echo isset( $wp->query_vars['recent-downloads'] ) ? ' class="active"' : ''; ?>><?php _e( 'My Downloads', 'yit' ) ?></a>
    </li>
    <?php if( defined( 'YITH_WCWL' ) ): ?>
    <li>
        <span class="fa fa-heart-o"></span>
        <a href="<?php echo wc_get_endpoint_url('myaccount-wishlist', '', $my_account_url ) ?>" title="<?php _e( 'My Wishlist', 'yit' ); ?>"<?php echo isset( $wp->query_vars['myaccount-wishlist'] ) ? ' class="active"' : ''; ?>><?php _e( 'My Wishlist', 'yit' ) ?></a>
    </li>
    <?php endif; ?>

    <?php do_action('yith_myaccount_menu');?>

    <li>
        <span class="fa fa-pencil-square-o"></span>
        <a href="<?php echo wc_get_endpoint_url('edit-address', '', $my_account_url ) ?>" title="<?php _e( 'Edit Address', 'yit' ); ?>"<?php echo isset( $wp->query_vars['edit-address'] ) ? ' class="active"' : ''; ?>><?php _e( 'Edit Address', 'yit' ) ?></a>
    </li>
    <li>
        <span class="fa fa-pencil-square-o"></span>
        <a href="<?php echo wc_get_endpoint_url('edit-account', '', $my_account_url ) ?>" title="<?php _e( 'Edit Account', 'yit' ); ?>"<?php echo isset( $wp->query_vars['edit-account'] ) ? ' class="active"' : ''; ?>><?php _e( 'Edit Account', 'yit' ) ?></a>
    </li>
    <?php if ( defined ( 'YITH_WCSTRIPE_PREMIUM' ) ) { ?>
        <li>
            <span class="fa fa-pencil-square-o"></span>
            <a href="<?php echo wc_get_endpoint_url('saved-cards', '',  get_permalink( wc_get_page_id( 'myaccount' ) ) ) ?>" title="<?php _e( 'Payment Cards', 'yit' ); ?>"<?php echo isset( $wp->query_vars['saved-cards'] ) ? ' class="active"' : ''; ?>><?php _e( 'Payment Cards', 'yit' ) ?></a>
        </li>
    <?php } ?>
    <?php if ( defined ( 'YITH_WCAUTHNET_PREMIUM' ) ) { ?>
        <li>
            <span class="fa fa-pencil-square-o"></span>
            <a href="<?php echo wc_get_endpoint_url('authorize-saved-cards', '',  get_permalink( wc_get_page_id( 'myaccount' ) ) ) ?>" title="<?php _e( 'Authorize.net Cards', 'yit' ); ?>"<?php echo isset( $wp->query_vars['authorize-saved-cards'] ) ? ' class="active"' : ''; ?>><?php _e( 'Authorize.net Cards', 'yit' ) ?></a>
        </li>
    <?php } ?>
</ul>

