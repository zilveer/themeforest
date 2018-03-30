<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php /*echo get_avatar( $GLOBALS['comment'], $size='48' );*/ ?>

		<div class="comment-text">

			<?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
				<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'dfd' ); ?></em></p>
			<?php else : ?>
				<div class="box-name author" itemprop="author"><?php comment_author(); ?></div><div class="clear"></div> <?php

					if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
						if ( woocommerce_customer_bought_product( $GLOBALS['comment']->comment_author_email, $GLOBALS['comment']->user_id, $post->ID ) )
							echo '<em class="verified">(' . __( 'verified owner', 'dfd' ) . ')</em> ';

				?><time itemprop="datePublished" time datetime="<?php echo get_comment_date('c'); ?>" class="subtitle left"><?php echo get_comment_date(__( get_option('date_format'), 'dfd' )); ?></time>
			<?php endif; ?>

			<?php /*if ( get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>

				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf(__( 'Rated %d out of 5', 'dfd' ), $rating) ?>">
					<span style="width:<?php echo ( intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ); ?></strong> <?php _e( 'out of 5', 'dfd' ); ?></span>
				</div>

			<?php endif;*/ ?>

			<div class="clear"></div>
			<div itemprop="description" class="comment-description"><?php comment_text(); ?></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>