<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating   = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

        <div class="comment-text arrow-down">

                <?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>

                <div itemprop="description" class="description"><?php comment_text(); ?></div>

                <?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
        </div>

        <div class="clearfix comment-info">

            <?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '71' ), '' ); ?>

            <?php if ($comment->comment_approved == '0') : ?>
                <p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'yit' ); ?></em></p>
            <?php else : ?>

                <div class="meta">

                <span class="vcard author" itemprop="author">
                        <span class="fn"><?php comment_author(); ?></span>
                    </span>

                    <?php
                    //check if the user is registered
                    $user_id = ! get_user_by( 'id', $comment->user_id ) ? false : $comment->user_id;

                    if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
                        if ( $verified )
                            echo '<em class="verified">(' . __( 'verified owner', 'yit' ) . ')</em> ';
                    ?>

                    <time class='timestamp-link' expr:href='data:post.url' title='permanent link' itemprop="datePublished">
                        <abbr class='updated published' expr:title='data:post.timestampISO8601'>
                            <data:post.timestamp/>
                            <?php echo get_comment_date(__( get_option('date_format'), 'yit' )); ?>
                        </abbr>
                    </time>

                    <?php if ( $rating && get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>
                        <div class="woocommerce-product-rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'yit' ), $rating ) ?>">
                            <div class="star-rating">
                                <span style="width:<?php echo ( ( $rating / 5 ) * 100 ) ?>%"></span>
                            </div>
                            <meta itemprop="ratingValue" content="<?php echo $rating; ?>" />
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
