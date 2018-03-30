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

$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">
		<div class="comment-body clearfix">
			<div class="avatar">
				<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?>
			</div>

			<div class="comment-text">
	
				<?php do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>
	
				<?php if ( $comment->comment_approved == '0' ) : ?>
	
					<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>
	
				<?php else : ?>
	
				<div class="author clearfix">
					<div class="comment-meta">
						<span itemprop="author"><?php comment_author(); ?></span> <?php
						
						if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
							if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
								echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';?>
						<div class="date" itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( __( get_option( 'date_format' ), 'woocommerce' ) ); ?></div>
					</div>
				</div>
	
				<?php endif; ?>
	
				<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
	
				<div itemprop="description" class="description"><?php comment_text(); ?></div>
	
				<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>

			</div>
		</div>
	</div>
