<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews">
	<div id="comments">
		<h4><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, THEME_LANGUAGE_DOMAIN ), $count, get_the_title() );
			else
				_e( 'Reviews', THEME_LANGUAGE_DOMAIN );
		?></h4>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="monospace"><?php _e( 'There are no reviews yet.', THEME_LANGUAGE_DOMAIN ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$sreview	= __( 'Your Review', THEME_LANGUAGE_DOMAIN );
					
					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', THEME_LANGUAGE_DOMAIN ) : __( 'Be the first to review', THEME_LANGUAGE_DOMAIN ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', THEME_LANGUAGE_DOMAIN ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', THEME_LANGUAGE_DOMAIN ) . ' <span class="required">*</span></label> ' .
							            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
							'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', THEME_LANGUAGE_DOMAIN ) . ' <span class="required">*</span></label> ' .
							            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
						),
						'label_submit'  => __( 'Submit', THEME_LANGUAGE_DOMAIN ),
						'class_submit'  => 'clapat-button',
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', THEME_LANGUAGE_DOMAIN ) .'</label><select name="rating" id="rating">
							<option value="">' . __( 'Rate&hellip;', THEME_LANGUAGE_DOMAIN ) . '</option>
							<option value="5">' . __( 'Perfect', THEME_LANGUAGE_DOMAIN ) . '</option>
							<option value="4">' . __( 'Good', THEME_LANGUAGE_DOMAIN ) . '</option>
							<option value="3">' . __( 'Average', THEME_LANGUAGE_DOMAIN ) . '</option>
							<option value="2">' . __( 'Not that bad', THEME_LANGUAGE_DOMAIN ) . '</option>
							<option value="1">' . __( 'Very Poor', THEME_LANGUAGE_DOMAIN ) . '</option>
						</select></p>';
					}

					$comment_form['comment_field'] .= '<textarea id="comment" name="comment" onfocus="if(this.value == \'' . $sreview . '\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'' . $sreview . '\'; }">' . $sreview . '</textarea>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', THEME_LANGUAGE_DOMAIN ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
