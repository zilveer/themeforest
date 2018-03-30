<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 * 
 * @cmsms_package 	Agriculture
 * @cmsms_version 	1.6.4
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment_container">
		<div class="cmsms_product_comment_info">
			<?php
				if ($comment->comment_approved == '0') {
					echo '<em>' . __( 'Your comment is awaiting approval', 'woocommerce' ) . '</em>';
				} else {
					echo '<strong class="cmsms_product_comment_author" itemprop="author">';
						comment_author();
					echo '</strong>';
						
					if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ) {
						if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) ) {
							echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';
						}
					}
					
					if ($rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes') {
						echo '<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="' . sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $rating) . '">' . 
							'<span style="width:' . ($rating / 5) * 100 . '%">' . 
								'<strong itemprop="ratingValue">' . $rating . '</strong>' . 
								__('out of 5', 'woocommerce') . 
							'</span>' . 
						'</div>';
					}
					
					echo '<time itemprop="datePublished" datetime="' . get_comment_date('c') . '">' . get_comment_date(__(get_option('date_format'), 'woocommerce')) . '</time>';
				}
			?>
		</div>
		<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '75' ), '', get_comment_author_email( $comment->comment_ID ) ); ?>
		<div itemprop="description" class="description comment-text">
			<?php comment_text(); ?>
		</div>
		<div class="clear"></div>
	</div>
