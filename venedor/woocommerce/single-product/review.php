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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $venedor_woo_version;
$rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
$count = 0;

if (version_compare($venedor_woo_version, '2.5', '>=')) {
    $verified = wc_review_is_from_verified_owner( $comment->comment_ID );
}

?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?>

		<div class="comment-text">

			<?php if ( get_option('woocommerce_enable_review_rating') === 'yes' ) : ?>

				<?php
                $rating = get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true );
                ?>
                <div class="star-rating ratings" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" ><meta content="<?php echo $rating; ?>" itemprop="ratingValue" />
                    <span class="star" data-value="<?php echo $rating ?>" data-toggle="tooltip" data-title="<?php echo $rating ?>">
                        <?php 
                        for ($i = 0; $i < (int)$rating; $i++) {
                            $count++;
                            echo '<i class="fa fa-star"></i>';
                        }
                        if ($rating - (int)$rating >= 0.5) {
                            $count++;
                            echo '<i class="fa fa-star-half-full"></i>';
                        }
                        for ($i = $count; $i < 5; $i++) {
                            $count++;
                            echo '<i class="fa fa-star-o"></i>';
                        } ?>
                    </span>
                </div>

			<?php endif; ?>

            <?php do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>

			<?php if ($comment->comment_approved == '0') : ?>
				<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>
			<?php else : ?>
				<p class="meta">
					<strong itemprop="author"><?php comment_author(); ?></strong> <?php

						if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
                            if ( version_compare($venedor_woo_version, '2.5', '>=') ? $verified : wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
								echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';

					?>&ndash; <time itemprop="datePublished" datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>:
				</p>
			<?php endif; ?>

                <?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>

				<div itemprop="description" class="description"><?php comment_text(); ?></div>

                <?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>

				<div class="clear"></div>
			</div>
		<div class="clear"></div>
	</div>
