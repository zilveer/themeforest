<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
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
$shop_product_style = ot_get_option('shop_product_style', 'style1');
?>
<?php if ($shop_product_style === 'style2') { ?>
<div class="row">
	<div class="small-12 medium-8 medium-centered large-6 columns">
<?php } ?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s%s%s', '%s reviews for %s%s%s', $count, 'north' ), $count, '<span>', get_the_title(), '</span>' );
			else
				_e( 'Reviews', 'north' );
		?></h2>

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

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'north' ); ?></p>

		<?php endif; ?>
	</div>
	
	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>
	
		<a href="#comment_popup" id="add_review_button" rel="inline" data-class="review-popup" class="btn"><?php _e( 'Add Review', 'north' ); ?></a>
			
		<?php
			$commenter = wp_get_current_commenter();
			$comment_form = array(
				'title_reply' => false,
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'fields' => array(
					'author' => '<div class="row"><div class="small-12 medium-6 columns">' . '<label for="author">' . __( 'Name', 'north' ) . ' <span class="required">*</span></label> ' .
					            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div>',
					'email'  => '<div class="small-12 medium-6 columns"><label for="email">' . __( 'Email', 'north' ) . ' <span class="required">*</span></label> ' .
					            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>',
				),
				'label_submit' => __( 'Submit Review', 'north' ),
				'logged_in_as' => '',
				'comment_field' => ''
			);
		
			if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
		
				$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'north' ) .'</label><select name="rating" id="rating">
					<option value="">'.__( 'Rate&hellip;', 'north' ).'</option>
					<option value="5">'.__( 'Perfect', 'north' ).'</option>
					<option value="4">'.__( 'Good', 'north' ).'</option>
					<option value="3">'.__( 'Average', 'north' ).'</option>
					<option value="2">'.__( 'Not that bad', 'north' ).'</option>
					<option value="1">'.__( 'Very Poor', 'north' ).'</option>
				</select></p>';
				
				
			}
		
			$comment_form['comment_field'] .= '<div class="row"><div class="small-12 columns"><label for="comment">' . __( 'Your Review', 'north' ) . '</label><textarea id="comment" name="comment" cols="45" rows="22" aria-required="true"></textarea></div></div>';
		?>
		<aside id="comment_popup" class="mfp-hide">
			<div class="row no-padding">
				<div class="small-12 columns">
					<?php comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) ); ?>
				</div>
			</div>
		</aside>
	<?php else : ?>
	
		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'north' ); ?></p>
	
	<?php endif; ?>
</div>
<?php if ($shop_product_style === 'style2') { ?>
	</div>
</div>
<?php } ?>