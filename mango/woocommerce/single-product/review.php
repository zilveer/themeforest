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

<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class("media"); ?> id="li-comment-<?php comment_ID() ?>">

        <div class="media-left">

	    <?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?>

        </div>

		<div class="comment-text media-body">

			<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="product-ratings star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'woocommerce' ), $rating ) ?>">

                        <?php

                        $count = 0;

                        for( $i = 0; $i <(int)$rating; $i ++ ) {

                            $count ++;

                            echo '<span class="star active"></span>';

                        }

                        if( $rating -(int)$rating >= 0.5 ) {

                            $count ++;

                            echo '<span class="star active-half"></span>';

                        }

                        for( $i = $count; $i < 5; $i ++ ) {

                            $count ++;

                            echo '<span class="star"></span>';

                        } ?>

				</div>

			<?php endif; ?>

			<?php if ( $comment->comment_approved == '0' ) : ?>



				<h4 class="meta media-heading"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></h4>

			<?php else : ?>

					<h4 class="media-heading" itemprop="author"><?php comment_author(); ?></h4>

                <?php

                if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )

                   if ( $verified )

								echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';

					?>

					<time class="comment-date" itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>">

					<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>">

					<?php echo get_comment_date( wc_date_format() ); ?></time>

			<?php endif; ?>



			<p itemprop="description" class="description"><?php comment_text(); ?></p>

		</div>

</li>