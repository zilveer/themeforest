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
		<h5><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'woocommerce' ), $count, get_the_title() );
			else
				_e( 'Reviews', 'woocommerce' );
		?></h5>

		<?php if ( have_comments() ) : ?>

			<ol class="comments-list media-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				$links = paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
                    'prev_text'    => "<span aria-hidden='true'><i class='fa fa-angle-left'></i></span>",
                    'next_text'    => "<span aria-hidden='true'><i class='fa fa-angle-right'></i></span>",
					'type'      => 'array',
                    'echo'      => false,
				) ) );
                echo "<ul class='pagination'>";
                //print_r($links);
                foreach($links as $link){
                    if(preg_match("/^<span class='page-numbers current'>/", $link)){
                        echo "<li class='active'>";
                    }else{
                        echo "<li>";
                    }
                    echo $link;
                    echo "</li>";
                }
                echo "</ul>";
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<h5 class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'woocommerce' ); ?></h5>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form" class="review-respond">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'woocommerce' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="row"><div class="col-sm-12"><div class="form-group comment-form-author"><label class="input-desc" for="author">' . __( 'Name', 'woocommerce' ) . ' <span class="required-field">*</span></label> ' .
							            '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="'.__("Your name (required)",'mango').'" required /></div>',
							'email'  => '<div class="form-group comment-form-email"><label class="input-desc" for="email">' . __( 'Email', 'woocommerce' ) . ' <span class="required-field">*</span></label> ' .
							            '<input id="email" name="email"  class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="'.__("Your email (required)",'mango').'" required /></div></div></div>',
						),
						'label_submit'  => __( 'Send Review', 'mango' ),
						'logged_in_as'  => '',
                        'class_submit' => 'btn btn-custom2 min-width',
						'comment_field' => ''
					);

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="form-group comment-form-rating"><label class="input-desc" for="rating">' . __( 'Your Rating', 'mango' ) .'</label><select name="rating" id="rating">
							<option value="">' . __( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . __( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . __( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . __( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'woocommerce' ) . '</option>
						</select></div>';
					}

					$comment_form['comment_field'] .= '<div class="form-group last comment-form-comment"><label for="comment"  class="input-desc">' . __( 'Your Review', 'woocommerce' ) . '<span class="required-field">*</span></label><textarea id="comment" class="form-control" rows="7" name="comment" cols="45" placeholder="'.__("Your review",'mango').'" required aria-required="true"></textarea></div>';
					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>