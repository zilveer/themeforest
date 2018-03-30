<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$count = $product->get_rating_count();
?>

<?php if ( comments_open() ) : ?>

    <div id="reviews" class="<?php if( $count > 0 ) echo 'with_reviews'?>">

        <div id="comments">

            <?php if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

                if ( $count > 0 ) {

                    $average = $product->get_average_rating();

                    echo '<div>';
                    echo '<h3>'.sprintf( _n('%s review for this item', '%s reviews for this item', $count, 'yit'), '<span class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h3>';
                    echo '</div>';

                } else {
                    echo '<h3>'.__( 'There are no review yet!', 'yit' ).'</h3>';
                }

            } else {
                echo '<h3>'.__( 'Reviews', 'yit' ).'</h3>';
            }

            $title_reply = __( 'Be the first to review this items', 'yit' );

            if ( have_comments() ) :

                echo '<ol class="commentlist">';

                wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) );

                echo '</ol>';

                if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                    <div class="navigation">
                        <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'yit' ) ); ?></div>
                        <div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'yit' ) ); ?></div>
                    </div>
                <?php endif;

                $title_reply = __( 'Add your review', 'yit' );

            endif;

            $commenter = wp_get_current_commenter(); ?>

        </div><!-- #comments -->

            <div id="review_form_wrapper" class="<?php if( $count > 0) echo 'with_reviews'; ?>">

                <div id="review_form">

                    <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

                        <?php
                        $comment_form = array(
                            'title_reply' => $title_reply,
                            'title_reply_to'       => __( 'Leave a Reply to %s', 'yit' ),
                            'comment_notes_before' => '',
                            'comment_notes_after' => '',
                            'fields' => array(
                                'author' => '<p class="comment-form-author">' .
                                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="Name"/></p>',
                                'email'  => '<p class="comment-form-email">' .
                                    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="email"/></p>',
                            ),
                            'label_submit' => __( 'Submit Review', 'yit' ),
                            'logged_in_as' => '',
                            'comment_field' => '',
                        );

                        if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

                            $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'yit' ) .'</label><select name="rating" id="rating">
                            <option value="">'.__( 'Rate&hellip;', 'yit' ).'</option>
                            <option value="5">'.__( 'Perfect', 'yit' ).'</option>
                            <option value="4">'.__( 'Good', 'yit' ).'</option>
                            <option value="3">'.__( 'Average', 'yit' ).'</option>
                            <option value="2">'.__( 'Not that bad', 'yit' ).'</option>
                            <option value="1">'.__( 'Very Poor', 'yit' ).'</option>
                        </select></p>';

                        }

                        $comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="REVIEW"></textarea>' . wp_nonce_field( 'woocommerce-comment_rating', '_wpnonce', true, false ) . '</p>';

                        comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) ); ?>

                    <?php else : ?>

                        <h3><?php _e( 'Verification is required' ) ?></h3>
                        <p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'yit' ); ?></p>

                    <?php endif; ?>

                </div><!-- #review_form -->

            </div><!-- #review_form_wrapper -->

            <div class="clear"></div>
</div><!-- #reviews -->

<?php endif; ?>