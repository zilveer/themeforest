<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}
?>

	

		<?php if ( have_comments() ) : ?>

			<!-- Reviews -->
			<ul class="product-reviews">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ul>
			
			
			<div class="animate-onscroll">	
				
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			
				echo '<div class="divider"></div><nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>
			</div>
			
			
		<?php else : ?>
		
			<ul class="product-reviews">
			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'candidate' ); ?></p>
			</ul>
			
		<?php endif; ?>
	

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'candidate' ) : __( 'Be the first to review', 'candidate' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'candidate' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="inline-inputs"><div class="col-lg-6 col-md-6 col-sm-6">' . '<label for="author">' . __( 'Name', 'candidate' ) . '*</label> ' .
							            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div>',
							'email'  => '<div class="col-lg-6 col-md-6 col-sm-6"><label for="email">' . __( 'Email', 'candidate' ) . '*</label> ' .
							            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>',
						),
						'label_submit'  => __( 'Submit', 'candidate' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<label for="rating">' . __( 'Your rating*', 'candidate' ) .'</label>
						<select name="rating" id="rating">
							<option value="">' . __( 'Rate&hellip;', 'candidate' ) . '</option>
							<option value="5">' . __( 'Perfect', 'candidate' ) . '</option>
							<option value="4">' . __( 'Good', 'candidate' ) . '</option>
							<option value="3">' . __( 'Average', 'candidate' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'candidate' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'candidate' ) . '</option>
						</select>';
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review*', 'candidate' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'candidate' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
