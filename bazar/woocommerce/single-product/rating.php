<?php
/**
 * Single Product Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
    return;

$averange_rating= $product->get_rating_html();
$rating_count= $product->get_rating_count();

if ( $rating_count > 0 ) : ?>

<div class="rating-single-product">
<?php
// if we have some rating we'll show the div content.
if ($averange_rating!=''){
echo $averange_rating ." <span class='rating-text'>".$rating_count." ". _n("REVIEW","REVIEWS",$rating_count,"yit")." </span>";
}
?>
</div>
<div class="clearfix"></div>

<?php endif; ?>
