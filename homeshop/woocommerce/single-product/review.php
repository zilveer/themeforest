<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );
?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

    <p><strong><?php comment_author_link(); ?></strong></p>
   
    
	
		<?php
		/**
		 * The woocommerce_review_before hook
		 *
		 * @hooked woocommerce_review_display_gravatar - 10
		 */
		remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
		do_action( 'woocommerce_review_before', $comment );
		?>
	
	<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '', get_comment_author() ); ?>
	<span class="date"><?php echo get_comment_date( wc_date_format() ); ?></span>
	
	<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) : ?>
	<div class="rating-box">
		<div class="rating readonly-rating" data-score="<?php echo $rating; ?>"></div>
	</div>
	<?php endif; ?>
	<br>
	
	<?php do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>
	
	
	<?php if ( $comment->comment_approved == '0' ) : ?>

		<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'homeshop' ); ?></em></p>

	<?php else : ?>

		<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
	
		<div itemprop="description" class="description"><?php comment_text(); ?></div>

		<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
	
	<?php endif; ?>

</li>