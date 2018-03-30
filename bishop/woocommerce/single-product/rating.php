<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
    return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$rating_html = $product->get_rating_html();

if ( $rating_count > 0 ) : ?>

    <div class="rating-single-product" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <?php
        // if we have some rating we'll show the div content.
        if ($rating_html!=''){
            echo $rating_html ." <span class='rating-text'> <span itemprop='reviewCount'>".$review_count." </span>". _n("REVIEW","REVIEWS",$review_count,"yit")." </span>";
        }
        ?>
        <meta itemprop="ratingValue" content="<?php echo $average; ?>" />
    </div>
    <div class="clearfix"></div>

<?php endif; ?>



