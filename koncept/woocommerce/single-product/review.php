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

$rating   = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

$retina = krown_retina();
?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" id="li-comment-<?php comment_ID() ?>" class="comment clearfix">

	<div class="comment-avatar"><?php echo get_avatar( $comment, ( $retina === 'true' ? 130 : 65 ), $default='' ); ?></div>

	<div class="comment-content">

		<div class="comment-meta clearfix">

			<?php do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>

			<h6 class="comment-title"><?php echo (get_comment_author_url() != '' ? comment_author_link() : comment_author()); ?>

				<?php

					if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
							if ( $verified )
								echo '<span class="verified">' . __( 'verified owner', 'krown' ) . '</span> ';

					?>

			</h6>
			<span class="comment-date"><?php echo comment_date( __( 'F j, Y', 'krown' ) ); ?></span>

		</div>

		<div class="comment-text">
			
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="await"><?php _e( 'Your comment is awaiting moderation.', 'krown' ); ?></em>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
				<div itemprop="description" class="description"><?php comment_text(); ?></div>
			<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>

		</div>

		<?php if ( $rating && get_option('woocommerce_enable_review_rating') === 'yes' ) : ?>

			<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating clearfix" title="<?php echo sprintf(__( 'Rated %d out of 5', 'krown' ), $rating) ?>">
				<span style="display: none;" itemprop="ratingValue"><?php echo $rating; ?></span>
				<?php 
					for($i = 1; $i <= 5; $i++){
						if($i <= $rating)
							echo '<b class="star"></b>';
						else
							echo '<b class="no-star"></b>';
					}
				?>
			</div>

		<?php endif; ?>

	</div>