<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;
?>
<?php if ( $rating_html = $product->get_rating_html() ) :
    $rating = $product->get_average_rating();
    $rating_html = $product->get_rating_html();
    $count = 0; ?>
    <div class="product-ratings">
<?php for( $i = 0; $i <(int)$rating; $i ++ ) {
        $count ++;
        echo '<span class="star active"></span>';
    }
    if( $rating -(int)$rating >= 0.5 ) {
        $count ++;
        echo '<span class="star active-half"></span>';
    }
    for( $i = $count; $i < 5; $i ++ ) {
        $count ++;
        echo '<span class="star"></span>';
    } ?>

        <span class="rating-amount">
            <?php
            $rev_count = $product->get_review_count();
            echo $rev_count." ";
            if($rev_count==0 || $rev_count>1){
                _e("Reviews",'mango');
            }elseif($rev_count==1){
                _e("Review",'mango');
            }
            ?>
        </span>
    </div>
<?php endif; ?>