<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

if ( ! comments_open() )
    return;
?>
<div id="reviews">
    <div id="comments">
        <h3><?php
            if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_rating_count() ) )
                printf( _n( '%s review for %s', '%s reviews for %s', $count, 'yit' ), $count, get_the_title() );
            else
                _e( 'Reviews', 'yit' );
            ?></h3>

        <?php if ( have_comments() ) : ?>

            <ol class="commentlist">
                <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
            </ol>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                echo '<nav class="woocommerce-pagination">';
                paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
                    'prev_text' => '&larr;',
                    'next_text' => '&rarr;',
                    'type'      => 'list',
                ) ) );
                echo '</nav>';
            endif; ?>

        <?php else : ?>

            <p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'yit' ); ?></p>

        <?php endif; ?>
    </div>


    <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

        <div id="review_form_wrapper">
            <div id="review_form">

                <?php
                $commenter = wp_get_current_commenter();

                $comment_form = array(
                    'title_reply'          => have_comments() ? __( 'Add a review', 'yit' ) : __( 'Be the first to review', 'yit' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
                    'title_reply_to'       => __( 'Leave a Reply to %s', 'yit' ),
                    'comment_notes_before' => '',
                    'comment_notes_after'  => '',
                    'fields'               => array(
                        'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'yit' ) . ' <span class="required">*</span></label> ' .
                            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
                        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'yit' ) . ' <span class="required">*</span></label> ' .
                            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
                    ),
                    'label_submit'  => __( 'Submit', 'yit' ),
                    'logged_in_as'  => '',
                    'comment_field' => ''
                );

                if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                    $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', 'yit' ) .'</label><select name="rating" id="rating">
							<option value="">' . __( 'Rate&hellip;', 'yit' ) . '</option>
							<option value="5">' . __( 'Perfect', 'yit' ) . '</option>
							<option value="4">' . __( 'Good', 'yit' ) . '</option>
							<option value="3">' . __( 'Average', 'yit' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'yit' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'yit' ) . '</option>
						</select></p>';
                }

                $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'yit' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

                comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                ?>

            </div>
        </div>

    <?php else : ?>

        <div class="box info-box woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'yit' ); ?>
            <span class="ico"></span>
        </div>

    <?php endif; ?>

    <div class="clear"></div>
</div>