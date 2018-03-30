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
<div id="reviews">

    <?php if ( have_comments() ) { ?>
	<div class="row">
												
		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="category-results">
				<p><?php _e( 'Results 1-6 of', 'homeshop' ); ?> <?php comments_number( 'no responses', '1', '%' ); ?></p>
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6">
		
		<?php 
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<div class="pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' 	=> '<div class="previous"><i class="icons icon-left-dir"></i></div>',
					'next_text' 	=> '<div class="next"><i class="icons icon-right-dir"></i></div>',
					'type'			=> 'plain',
				) ) );
				echo '</div>';
		endif; ?>

		</div>
	
	</div>
    <?php } ?>


		<?php if ( have_comments() ) : ?>

			<ul class="comments" style="list-style:none; padding:0;">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments') ) ); ?>
			</ul>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'homeshop' ); ?></p>

		<?php endif; ?>
	
	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'WRITE A REVIEW', 'homeshop' ) : __( 'Be the first to review', 'homeshop' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'homeshop' ),
						'comment_notes_before' => '<p>' . __( 'Now please write a (short) review....(min. 200, max. 2000 characters)', 'homeshop' ) . '</p>',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'homeshop' ) . ' <span class="required">*</span></label> ' .
							            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
							'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'homeshop' ) . ' <span class="required">*</span></label> ' .
							            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
						),
						'label_submit'  => __( 'Submit a review', 'homeshop' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);
					
					$comment_form['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'homeshop' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' . wp_nonce_field( 'woocommerce-comment_rating', '_wpnonce', true, false ) . '</p>';

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] .= '<p>' . __( 'First: Rate the product. Please select a rating between 0 (poorest) and 5 stars (best)', 'homeshop' ) . '</p>
						<p class="comment-form-rating"><label for="rating" style="float:left;font-size: 13px; color: #7a8188; vertical-align: middle;" >' . __( 'Rating', 'homeshop' ) .': </label>
						
						
						<select name="rating" id="rating" >
							<option value="">' . __( 'Rate&hellip;', 'homeshop' ) . '</option>
							<option value="5">' . __( 'Perfect', 'homeshop' ) . '</option>
							<option value="4">' . __( 'Good', 'homeshop' ) . '</option>
							<option value="3">' . __( 'Average', 'homeshop' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'homeshop' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'homeshop' ) . '</option>
						</select>
						</p>';
					}

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'homeshop' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>