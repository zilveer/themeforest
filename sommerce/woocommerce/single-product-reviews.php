<?php
/**
 * Display single product reviews (comments)
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! comments_open() )
    return;

?>
<div id="reviews"><?php

    echo '<div id="comments">';

    if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_rating_count() ) ) {

        $average = number_format( $product->get_average_rating(), 2 );

        echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
        echo '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'yiw' ), $average ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __( 'out of 5', 'yiw' ) . '</span></div>';
        echo '<h2>' . sprintf( _n( '%s review for %s', '%s reviews for %s', $count, 'yiw' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>', wptexturize( $post->post_title ) ) . '</h2>';
        echo '</div>';

    }
    else {
        echo '<h2>' . __( 'Reviews', 'yiw' ) . '</h2>';
    }

    $title_reply = '';

    if ( have_comments() ) :

        echo '<ol class="commentlist">';

        wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) );

        echo '</ol>';

        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'yiw' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'yiw' ) ); ?></div>
            </div>
        <?php endif;

        $title_reply = __( 'Add a review', 'yiw' );

    else :

        $title_reply = __( 'Be the first to review', 'yiw' ) . ' &ldquo;' . $post->post_title . '&rdquo;';
        echo '<p class="noreviews">' . __( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'yiw' ) . '</p>';

    endif;

    $commenter = wp_get_current_commenter();

    echo '</div>';

    if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) {

    echo '<div id="review_form_wrapper"><div id="review_form">';

    $comment_form = array(
        'title_reply'          => $title_reply,
        'title_reply_to'       => __( 'Leave a Reply to %s', 'yiw' ),
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        'fields'               => array(
            'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'yiw' ) . '</label> ' . '<span class="required">*</span>' .
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'yiw' ) . '</label> ' . '<span class="required">*</span>' .
                '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
        ),
        'label_submit'         => __( 'Submit Review', 'yiw' ),
        'logged_in_as'         => '',
        'comment_field'        => ''
    );

    if ( get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) {

        $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'yiw' ) . '</label><select name="rating" id="rating">
			<option value="">' . __( 'Rate&hellip;', 'yiw' ) . '</option>
			<option value="5">' . __( 'Perfect', 'yiw' ) . '</option>
			<option value="4">' . __( 'Good', 'yiw' ) . '</option>
			<option value="3">' . __( 'Average', 'yiw' ) . '</option>
			<option value="2">' . __( 'Not that bad', 'yiw' ) . '</option>
			<option value="1">' . __( 'Very Poor', 'yiw' ) . '</option>
		</select></p>';

    }

    $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'yiw' ) .
        '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . wp_nonce_field( 'woocommerce-comment_rating', '_wpnonce', true, false );

    comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

    echo '</div></div>';

    }
    else {
      echo  '<p class="woocommerce-verification-required">'.__( "Only logged in customers who have purchased this product may leave a review.", "yiw" ).'</p>';
    }

    ?>
    <div class="clear"></div>
</div>
