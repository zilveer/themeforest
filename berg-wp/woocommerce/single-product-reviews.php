<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return;
?>
<div class="reviews" id="reviews">
	
		<h3 class="h4"><?php
				_e( 'Reviews', 'woocommerce' );
		?></h3>

		<?php if ( have_comments() ) : ?>
			<div class="controls-reviews owl-theme"></div>
			<div class="owl-carousel" id="reviews-carousel">
			
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</div>	

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				// echo '<nav class="woocommerce-pagination">';
				// paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
				// 	'prev_text' => '&larr;',
				// 	'next_text' => '&rarr;',
				// 	'type'      => 'list',
				// ) ) );
				// echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

		<?php endif; ?>
	

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		
		<div class="reviews-form">
			<?php
				$commenter = wp_get_current_commenter();

				$comment_form = array(
					'title_reply'          => have_comments() ? __( 'Add a review', 'woocommerce' ) : __( 'Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
					'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => array(
						'author' => '<div class="col-md-6"><div class="form-group"><input class="form-control form-email-error" id="author" placeholder="'.__('Name', 'woocommerce').'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div></div>',
						'email'  => '<div class="col-md-6"><div class="form-group"><input class="form-control form-email-error" id="email" placeholder="'.__('Email', 'woocommerce').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>'
					),
					'label_submit'  => __( 'Submit', 'woocommerce' ),
					'logged_in_as'  => '',
					'comment_field' => ''
				);

				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {

					$comment_form['comment_field'] = '<div class="rating rating-select"><span><span></span></span>
						<select name="rating" id="rating">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>';
				}

				$comment_form['comment_field'] .= '<div class="col-md-12"><div class="form-group"><textarea class="form-control input-row-2" rows="3" id="comment" name="comment" placeholder="Review" aria-required="true"></textarea></div></div>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
			?>
		</div>
	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
