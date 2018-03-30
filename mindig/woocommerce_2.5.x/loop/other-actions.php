<?php
/**
 * Other actions (Compare, Wishlist)
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

$count_buttons = 3; //number of buttons to show

$wishlist = (  yit_get_option( 'shop-view-wishlist-button' ) == 'yes' && get_option( 'yith_wcwl_enabled' ) == 'yes' && shortcode_exists( 'yith_wcwl_add_to_wishlist' )  ) ? do_shortcode( '[yith_wcwl_add_to_wishlist use_button_style="no"]' ) : '';

$compare = ( yit_get_option( 'shop-view-compare-button' ) == 'yes' && shortcode_exists( 'yith_compare_button' ) ) ? do_shortcode( '[yith_compare_button type="link"]' ) : '';

$share = ( yit_get_option( 'shop-view-share-button' ) == 'yes' ) ? sprintf( '<div class="share-button"><a href="#" id="yit_share">' . __( 'Share it', 'yit' ) . '</a></div>' ) : '';

$buttons = array( $wishlist, $compare, $share );

foreach ( array( 'wishlist', 'compare', 'share' ) as $var ) {
    if ( empty( ${$var} ) ) {
        $count_buttons --;
    }
}


if( $count_buttons > 0 ) : ?>

    <div class="clearfix product-other-action buttons_<?php echo $count_buttons ?>" >
        <?php echo implode( "\n", $buttons ) ?>
    </div>

<?php endif;

if ( yit_get_option( 'shop-view-share-button' ) == 'yes' ) :

    echo '<div class="share-container"><h3>' . __( 'share on: ', 'yit' ) . '</h3>';
    yit_get_social_share( 'text' );
    echo '</div>';

endif; ?>


