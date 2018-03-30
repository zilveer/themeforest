<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $woocommerce;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! comments_open() ) {
	return;
}
?>
<div id="reviews" class="row">

	<div id="comments" class="seven columns">
		<div class="dfd-wrapper">
		<?php
		echo '<div class="box-name">'.__( 'Reviews', 'dfd' ).'</div>';

		$title_reply = '';

		if ( have_comments() ) :

			?>

			<ol class="commentlist">

			<?php wp_list_comments( array( 'callback' => 'woocommerce_comments' ) ); ?>

			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'dfd' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'dfd' ) ); ?></div>
				</div>
			<?php endif;

			//echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button" data-rel="prettyPhoto" title="' . __( 'Add Your Review', 'dfd' ) . '"><i class="infinityicon-pencil"></i>' . __( 'Add Review', 'dfd' ) . '</a></p>';

			$title_reply = __( 'Add a review', 'dfd' );

		else :

			$title_reply = __( 'Be the first to review', 'dfd' ).' &ldquo;'.$post->post_title.'&rdquo;'; ?>

			<p class="noreviews"><?php _e( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form"><i class="infinityicon-pencil"></i>submit yours</a>?', 'dfd' ); ?></p>

		<?php endif;

		if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) :

		$commenter = wp_get_current_commenter(); ?>

		</div>
	</div>
	<div id="review_form_wrapper" class="five columns">
		<div id="review_form">

	<?php
	$comment_form = array(
		'title_reply' => $title_reply,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<p class="comment-form-author">' .
			            '<input id="author" name="author" type="text" placeholder="'. esc_attr('Name*', 'dfd') .'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
			'email'  => '<p class="comment-form-email">' .
			            '<input id="email" name="email" type="text" placeholder="'.esc_attr('Email*', 'dfd').'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
		),
		'label_submit' => __( 'Add Review', 'dfd' ),
		'logged_in_as' => '',
		'comment_field' => ''
	);

	$comment_form['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="1" placeholder="Your review" aria-required="true"></textarea></p>' . wp_nonce_field('comment_rating', true, false);

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$comment_form['comment_field'] .= '<p class="comment-form-rating"><label for="rating">' . __( 'Choose rating', 'dfd' ) .'</label><select name="rating" id="rating">
			<option value="">'.__( 'Rate&hellip;', 'dfd' ).'</option>
			<option value="5">'.__( 'Perfect', 'dfd' ).'</option>
			<option value="4">'.__( 'Good', 'dfd' ).'</option>
			<option value="3">'.__( 'Average', 'dfd' ).'</option>
			<option value="2">'.__( 'Not that bad', 'dfd' ).'</option>
			<option value="1">'.__( 'Very Poor', 'dfd' ).'</option>
		</select></p>';

	}

	comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

	endif; ?>
	
		</div>
	</div>

	<div class="clear"></div>
	
</div>