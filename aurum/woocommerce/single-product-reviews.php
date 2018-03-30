<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */

/* Note: This file has been altered by Laborator */

global $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return;

# start: modified by Arlind Nushi
add_action('comment_form_before_fields', 'laborator_comment_before_fields');
add_action('comment_form_after_fields', 'laborator_comment_after_fields');

add_action('comment_form_logged_in', 'laborator_comment_before_fields');
add_action('comment_form_logged_in_after', 'laborator_comment_after_fields');
# end: modified by Arlind Nushi
?>
<div id="reviews">
	<div id="comments">
		<h4><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'aurum' ), $count, get_the_title() );
		?></h4>

		<?php if ( have_comments() ) : ?>

			<div class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</div>


			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo str_replace("<ul class='page-numbers'>", "<ul class='pagination pagination-center'>", paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
					'type'      => 'list',
					'echo'		=> false
				) ) ) );
			endif; ?>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'aurum' ) : __( 'Be the first to review', 'aurum' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'aurum' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="col-sm-6">' .
											'<div class="form-group comment-form-author">' .
												'<input id="author" name="author" type="text" class="form-control" placeholder="' . esc_attr(__( 'Name', 'aurum' )) . ' *" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />' .
											'</div>' .
										'</div>',

							'email'  => '<div class="col-sm-6">' .
											'<div class="form-group comment-form-email">' .
												'<input id="email" name="email" type="text" class="form-control" placeholder="' . esc_attr(__( 'Email', 'aurum' )) . ' *" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />' .
											'</div>' .
										'</div>',
						),
						'label_submit'  => __( 'Submit review', 'aurum' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {

						$comment_form['comment_field'] = '<div class="comment-form-rating">' .
							'<label for="rating">' . __( 'Your Rating', 'aurum' ) .'</label>' .
							'<select name="rating" id="rating">
								<option value="">' . __( 'Rate&hellip;', 'aurum' ) . '</option>
								<option value="5">' . __( 'Perfect', 'aurum' ) . '</option>
								<option value="4">' . __( 'Good', 'aurum' ) . '</option>
								<option value="3">' . __( 'Average', 'aurum' ) . '</option>
								<option value="2">' . __( 'Not that bad', 'aurum' ) . '</option>
								<option value="1">' . __( 'Very Poor', 'aurum' ) . '</option>
							</select>' .
						'</div>';
					}

					$comment_form['comment_field'] .= '<div class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control autogrow" placeholder="' . esc_attr( __( 'Your Review', 'aurum' ) ) . '"></textarea></div>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'aurum' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>