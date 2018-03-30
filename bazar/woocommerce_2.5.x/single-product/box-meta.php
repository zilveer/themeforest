<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
if ( ! is_product() ) return;

global $product, $woocommerce, $post;

$count_buttons = 4;    // number of buttons to show
$wishlist = do_shortcode('[yith_wcwl_add_to_wishlist use_button_style="no"]');
$compare  = ( shortcode_exists( 'yith_compare_button' ) && ( get_option( 'yith_woocompare_compare_button_in_product_page' ) == 'yes' ) ) ? do_shortcode('[yith_compare_button type="link"]') : '';

$show_share = yit_get_option('shop-single-show-share');
$sharethis_allowed = false;

$share = '';
if( $show_share ) {

    if ( isset( $woocommerce->integrations->integrations['sharethis'] ) && $woocommerce->integrations->integrations['sharethis']->publisher_id ) {
        $sharethis_allowed = true;
        $share             = sprintf( '<a href="%s" rel="nofollow" title="%s" class="share" id="%s" onclick="return false;">%s</a>', '#', __( 'Share', 'yit' ), "share_$product->id", __( 'Share', 'yit' ) );
    }
    else {
        $share = sprintf( '<a href="#" class="yit_share share">' . __( 'Share', 'yit' ) . '</a>' );
    }
}

if ( ! yit_get_option('shop-single-show-wishlist' ) ) { $wishlist = ''; }
//if ( ! yit_get_option('shop-single-show-compare') )   { $compare  = ''; }


if ( get_option( 'yith_wcwl_enabled' ) != 'yes' || !function_exists( 'yith_wcwl_is_wishlist' ) ) { $wishlist = ''; }

if ( ! empty( $compare ) ) $compare .= '<a href="#" class="woo_compare_button_go hide" style="display: none;"></a>';

$request_a_quote = yit_ywraq_print_button_single_page();

$buttons = array( $wishlist, $compare, $share, $request_a_quote );

foreach ( array( 'wishlist', 'compare', 'share', 'request_a_quote' ) as $var ) if ( empty( ${$var} ) ) $count_buttons--;
?>
 
<div class="product-box group">
    <div class="border group">
        
        <?php if ( yit_product_form_position_is('in-sidebar') ) do_action( 'yit_product_box' ); ?>
        
        <div class="border borderstrong"></div>
        <div class="border"></div>
        <div class="border"></div>
        <div class="border"></div>
        
        <div class="buttons buttons_<?php echo $count_buttons ?> group"> 
            <?php echo implode( "\n", $buttons ) ?>
        </div>
    
    </div>
</div>

<?php if( $show_share ): ?>
    <?php if( $sharethis_allowed ): ?>
        <?php yit_add_sharethis_button_js() ?>
        <?php else: ?>
        <div class="product-share"><?php echo do_shortcode( apply_filters( 'yit_single-product_share_popup', '[share title="' . __('Share on:', 'yit') . ' " icon_type="default" socials="facebook, twitter, google, pinterest"]' ) ); ?></div>
    <?php endif; ?>
<?php endif; ?>
