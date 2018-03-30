<?php
/**
 * Advanced Review  Template
 *
 * @author        Yithemes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $YWAR_AdvancedReview;

$rating      = $YWAR_AdvancedReview->get_meta_value_rating( $review->ID );
$approved    = $YWAR_AdvancedReview->get_meta_value_approved( $review->ID );
$product_id  = $YWAR_AdvancedReview->get_meta_value_product_id( $review->ID );
$review_date = mysql2date( get_option( 'date_format' ), $review->post_date );

$author = $YWAR_AdvancedReview->get_meta_value_author( $review->ID );
$user   = isset( $author["review_user_id"] ) ? get_userdata( $author["review_user_id"] ) : null;

if ( $user ) {
	$author_name = $user->display_name;
} else if ( isset( $author["review_user_id"] ) ) {
	$author_name = $author["review_author"];
} else {
	$author_name = __( 'Anonymous', 'yit' );
}

?>

<?php apply_filters( 'yith_advanced_reviews_before_review', $review ); ?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" id="li-comment-<?php echo $review->ID; ?>"
    class="<?php echo $classes; ?>">

	<div id="comment-<?php echo $review->ID; ?>" class="comment_container <?php echo $classes; ?>">

		<div class="comment-text <?php echo $classes; ?>">
			<?php if ( $featured ) : ?>
				<img class="featured-badge" src="<?php echo YITH_YWAR_ASSETS_URL . '/images/featured-review.png'; ?>">
			<?php endif; ?>

            <?php if ( $user ):
                echo get_avatar( $user->ID, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '', $user->user_email );
            else:
                echo get_avatar( $author["review_author_email"], apply_filters( 'woocommerce_review_gravatar_size', '60' ), '', $author["review_author_email"] );
            endif; ?>

            <?php if ( $approved == '0' ) : ?>

                <p class="meta"><em><?php _e( 'Your comment is waiting for approval', 'yit' ); ?></em></p>

            <?php else : ?>

                <div class="meta">
                     <span class="vcard author" itemprop="author">
                        <span class="fn"><?php echo $author_name; ?></span>
                    </span>  <?php

                    if ( $user && get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ) {
                        if ( wc_customer_bought_product( $user->user_email, $user->ID, $product_id ) ) {
                            echo '<em class="verified">(' . __( 'verified owner', 'yit' ) . ')</em> ';
                        }
                    }

                    ?>&ndash;

                    <time itemprop="datePublished"
                          datetime="<?php echo mysql2date( 'c', $review_date ); ?>"><?php echo $review_date; ?></time>

                    <?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

                        <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="product-rating" >
                            <span class="star-empty">
                                <span class="star" style="width:<?php echo ( intval($rating )*20 ) ?>%"></span>
                            </span>
                            <meta itemprop="ratingValue" content="<?php echo $rating; ?>" />
                        </div>

                    <?php endif; ?>
                </div>

            <?php endif; ?>


			<div itemprop="description" class="description">
				<p><?php echo apply_filters( 'yith_advanced_reviews_review_content', $review ); ?></p>
			</div>
            <div class="clear"></div>
		</div>
        <div class="clear"></div>
	</div>
</li>