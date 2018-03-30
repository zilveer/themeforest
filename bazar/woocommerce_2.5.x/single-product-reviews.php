<?php
/**
 * Display single product reviews (comments)
 *
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

?>
<div id="reviews"><?php

    echo '<div id="comments">';

    if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

        $count = $product->get_rating_count();

        $average = $product->get_average_rating();

        if ( $count > 0 ) {

            echo '<div itemprop="aggregateRating" id="aggregate_rating" itemscope itemtype="http://schema.org/AggregateRating">';

            echo '<meta itemprop="bestRating" content = "5"><div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'yit' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'yit' ).'</span></div>';

            echo '<h2>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'yit'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h2>';

            echo '</div>';

        } else {

            echo '<h2>'.__('Reviews', 'yit').'</h2>';

        }

    }

    if ( have_comments() ) :

        echo '<ol class="commentlist" id="comment-reviews">';

        wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

        echo '</ol>';

        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

            <?php if(defined( 'YITH_YWAR_INIT' )):?>
                <?php
                echo '<nav class="woocommerce-pagination">';
                paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
                    'prev_text' => '&larr;',
                    'next_text' => '&rarr;',
                    'type'      => 'list',
                ) ) );
                echo '</nav>';
                ?>
            <?php else: ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'yit' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'yit' ) ); ?></div>
            </div>
            <?php endif; ?>

        <?php endif;

    else  :

        echo '<p class="noreviews">'.__('There are no reviews yet', 'yit').'</p>';

    endif;

    echo '</div>';

    if( ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) ) {

        echo '<p class="add_review">'.__('Would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'yit').'</p>';

        $commenter = wp_get_current_commenter();

        echo '<div id="review_form_wrapper"><div id="review_form">';

        $comment_form = array(
            'title_reply'          => have_comments() ? __( 'Add a review', 'yit' ) : __( 'Be the first to review', 'yit' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
            'title_reply_to'       => __( 'Leave a Reply to %s', 'yit' ),
            'comment_notes_after' => '',
            'fields' => array(
                'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'yit' ) . '</label> ' . '<span class="required">*</span>' .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
                'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'yit' ) . '</label> ' . '<span class="required">*</span>' .
                    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
            ),
            'label_submit' => __('Submit Review', 'yit'),
            'logged_in_as' => '',
            'comment_field' => ''
        );

        if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

            $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __('Rating', 'yit') .'</label><select name="rating" id="rating">
			<option value="">'.__('Rate&hellip;', 'yit').'</option>
			<option value="5">'.__('Perfect', 'yit').'</option>
			<option value="4">'.__('Good', 'yit').'</option>
			<option value="3">'.__('Average', 'yit').'</option>
			<option value="2">'.__('Not that bad', 'yit').'</option>
			<option value="1">'.__('Very Poor', 'yit').'</option>
		</select></p>';

        }

        $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'yit' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'YOUR REVIEW', 'yit' ) . '"></textarea></p>' . wp_nonce_field( 'woocommerce-comment_rating', '_wpnonce', true, false );

        comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

        echo '</div></div>';

    }

    else {
        echo '<p class="woocommerce-verification-required">'._e( 'Only logged in customers who have purchased this product may leave a review.', 'yit' ).'</p>';
    }

    ?><div class="clear"></div></div>
