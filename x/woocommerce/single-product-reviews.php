<?php

// =============================================================================
// WOOCOMMERCE/SINGLE-PRODUCT-REVIEWS.PHP
// -----------------------------------------------------------------------------
// @version 2.3.2
// =============================================================================

GLOBAL $product;

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
  return;
}

$stack         = x_get_stack();
$stack_comment = 'x_' . $stack . '_comment';

if ( $stack == 'ethos' ) {
  $placeholder_name    = ' placeholder="' . __( 'Your Name *', '__x__' ) . '"';
  $placeholder_email   = ' placeholder="' . __( 'Your Email *', '__x__' ) . '"';
  $placeholder_comment = ' placeholder="' . __( 'Your Comment *', '__x__' ) . '"';
} else {
  $placeholder_name    = '';
  $placeholder_email   = '';
  $placeholder_comment = '';
}

?>

<div id="reviews">
  <div id="comments" class="x-comments-area">

    <h2>
      <?php
      if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_rating_count() ) ) {
        printf( _n( '%s review for %s', '%s reviews for %s', $count, '__x__' ), $count, get_the_title() );
      } else {
        _e( 'Reviews', '__x__' );
      }
      ?>
    </h2>

    <?php if ( have_comments() ) : ?>
      <ol class="x-comments-list">
        <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => $stack_comment ) ) ); ?>
      </ol>
      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav class="x-pagination">
          <?php
          paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
            'prev_text' => '&larr;',
            'next_text' => '&rarr;',
            'type'      => 'list',
          ) ) );
          ?>
        </nav>
      <?php endif; ?>
    <?php else : ?>
      <p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', '__x__' ); ?></p>
    <?php endif; ?>

  </div>

  <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

    <div id="review_form_wrapper">
      <div id="review_form">

        <?php

        $commenter = wp_get_current_commenter();

        $comment_form = array(
          'title_reply'          => have_comments() ? __( '<span>Add a Review</span>', '__x__' ) : __( 'Be the First to Review', '__x__' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
          'title_reply_to'       => __( 'Leave a Reply to %s', '__x__' ),
          'comment_notes_before' => '',
          'comment_notes_after'  => '',
          'fields'               => array(
            'author' => '<p class="comment-form-author">'
                        . '<label for="author">' . __( 'Name', '__x__' ) . ' <span class="required">*</span></label>'
                        . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $placeholder_name . ' aria-required="true" /></p>',
            'email'  => '<p class="comment-form-email">'
                        . '<label for="email">' . __( 'Email', '__x__' ) . ' <span class="required">*</span></label>'
                        . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $placeholder_email . ' aria-required="true" /></p>',
          ),
          'label_submit'  => __( 'Submit Review', '__x__' ),
          'logged_in_as'  => '',
          'comment_field' => ''
        );

        if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {

          $comment_form['comment_field'] = '<select name="rating" id="rating">
                                              <option value="">'  . __( 'Rate&hellip;', '__x__' ) . '</option>
                                              <option value="5">' . __( 'Perfect', '__x__' ) . '</option>
                                              <option value="4">' . __( 'Good', '__x__' ) . '</option>
                                              <option value="3">' . __( 'Average', '__x__' ) . '</option>
                                              <option value="2">' . __( 'Not that bad', '__x__' ) . '</option>
                                              <option value="1">' . __( 'Very Poor', '__x__' ) . '</option>
                                            </select>';

        }

        $comment_form['comment_field'] .= '<p class="comment-form-comment">'
                                          // . '<label for="comment">' . __( 'Your Review', '__x__' ) . '</label>'
                                          . '<textarea id="comment" name="comment" cols="45" rows="8"' . $placeholder_comment . ' aria-required="true"></textarea></p>';

        comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

        ?>

      </div>
    </div>

  <?php else : ?>

    <p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', '__x__' ); ?></p>

  <?php endif; ?>

  <div class="clear"></div>
</div>