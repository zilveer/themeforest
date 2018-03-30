<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( !defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

$redux_wish = wish_redux();
global $post, $product;
$meta_icons = 'yes';
$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="product_meta">
    <div class="divider"></div>

    <?php do_action( 'woocommerce_product_meta_start' ); ?>

    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

        <span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span>.</span>

    <?php endif; ?>

    <?php echo wish_filter_html( $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '.</span>' ) ); ?>

    <?php echo wish_filter_html( $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ) ); ?>

    <?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>

<?php  
$show_fb_share = $redux_wish["wish-woocommerce-show-fb-share"];
$show_tw_share = $redux_wish["wish-woocommerce-show-tw-share"];
$show_pin_share = $redux_wish["wish-woocommerce-show-pin-share"];
$show_gp_share = $redux_wish["wish-woocommerce-show-gp-share"];


?>


<?php if ( $meta_icons == 'yes' ) { ?>
    <div class="social-icons">

        <?php if($show_fb_share){ ?><a class="facebook-icon" href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><span class="fa fa-facebook"></span></a><?php } ?>

        <?php if($show_tw_share){ ?><a class="twitter-icon" href="https://twitter.com/share?url=<?php echo get_permalink(); ?>" target="_blank"><span class="fa fa-twitter"></span></a><?php } ?>

        <?php if($show_pin_share){ ?><a class="pinterest-icon" href="//pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&amp;description=<?php echo get_the_title(); ?>" target="_blank"><span class="fa fa-pinterest"></span></a><?php } ?>

        <?php if($show_gp_share){ ?><a class="googleplus-icon" href="//plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank"><span class="fa fa-google-plus"></span></a><?php } ?>

    </div>
<?php } ?>