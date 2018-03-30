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

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
    return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

// if we have some rating we'll show the div content.
if ( $rating_count > 0 ) :
?>
    <div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <?php
        echo '<div class="star-rating"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"></span></div>';
        if( is_quick_view() ) {
            echo "<span class='woocommerce-review-link a-style-2' rel='nofollow'> <span itemprop='reviewCount'>" . $rating_count . " </span>" . _n( "review", "reviews", $rating_count, "yit" ) . " </span>";
        } else {
            echo "<a href='#reviews' class='woocommerce-review-link a-style-2' rel='nofollow'> <span itemprop='reviewCount'>" . $rating_count . " </span>" . _n( "review", "reviews", $rating_count, "yit" ) . " </a>";
        }
        ?>
        <meta itemprop="ratingValue" content="<?php echo esc_attr( $average ); ?>" />
    </div>
    <div class="clearfix"></div>
<?php
endif;
?>
