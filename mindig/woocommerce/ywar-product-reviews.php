<?php
/**
 * Display single product reviews (comments)
 *
 * @author        Yithemes
 */

global $product;
global $YWAR_AdvancedReview;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open( $product->id ) ) {
	return;
}

$reviews_count = count( $YWAR_AdvancedReview->get_product_reviews_by_rating( $product->id ) );
?>

<?php do_action( 'yith_advanced_reviews_before_reviews' ); ?>
<div id="reviews">
	<div id="comments">
		<h3><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && $reviews_count ) {
				printf( _n( '%s review for %s', '%s reviews for %s', $reviews_count, 'yit' ), $reviews_count, get_the_title() );
			} else {
				_e( 'Reviews', 'yit' );
			}
			?>
		</h3>

		<?php if ( $reviews_count ) : ?>

			<?php do_action( 'yith_advanced_reviews_before_review_list', $product ); ?>

			<ol class="commentlist">
				<?php $YWAR_AdvancedReview->reviews_list( $product->id,
					apply_filters( 'yith_advanced_reviews_reviews_list', null, $product->id ), true ); ?>
			</ol>

			<?php do_action( 'yith_advanced_reviews_after_review_list', $product ); ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'yit' ); ?></p>

		<?php endif; ?>
	</div>
    <?php
    /** @var YITH_WooCommerce_Advanced_Reviews_Premium $YWAR_AdvancedReview */
    $can_submit = $YWAR_AdvancedReview->user_can_submit_review ( $product->id );
    ?>

		<div id="review_form_wrapper" <?php echo ! $can_submit ? 'style="display:none"' : ''; ?>>
			<div id="review_form">
				<?php
				$commenter = wp_get_current_commenter();
				//todo check for reviews not comments

				$comment_form = array(
					'title_reply'          => $reviews_count ? __( 'Add a review', 'yit' ) : __( 'Be the first to review', 'yit' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
					'title_reply_to'       => __( 'Write a reply', 'yit' ),
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => array(
						'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'yit' ) . ' <span class="required">*</span></label> ' .
						            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
						'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'yit' ) . ' <span class="required">*</span></label> ' .
						            '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
					),
					'label_submit'         => __( 'Submit', 'yit' ),
					'logged_in_as'         => '',
					'comment_field'        => ''
				);

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'yit' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

				$comment_form['comment_field'] .= '<input type="hidden" name="action" value="submit-form" />';
				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

    <?php if ( ! $can_submit ) : ?>
        <div class="box info-box woocommerce-verification-required"><?php echo apply_filters ( 'ywar_product_reviews_submit_reviews_denied_text', __ ( 'Only logged in customers who have purchased this product may write a review.', 'yit' ), $product->id ); ?>
            <span class="ico"></span>
        </div>
        <p class="woocommerce-verification-required">
            <?php if ( $YWAR_AdvancedReview->reviews_edit_enabled () && $YWAR_AdvancedReview->customer_reviews_for_product ( $product->id ) ): ?>
                <a href="#" class="edit-my-reviews"
                   data-product-id="<?php echo $product->id; ?>"><?php _e ( "Edit my reviews", 'yit' ); ?></a>
            <?php endif; ?>
        </p>
    <?php endif; ?>

	<div class="clear"></div>
</div>
