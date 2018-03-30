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

$rating_enabled = get_option('woocommerce_enable_review_rating');
?>
<div id="reviews">
    <h4 class="p-font hd-block"><?php esc_html_e('Reviews Statistic','g5plus-academia'); ?></h4>
    <?php if($rating_enabled){
        $product = wc_get_product(get_the_ID());
        $rating_count = $product->get_rating_count();
        $average      = $product->get_average_rating();
        $average = round($average, 1);
        ?>
        <div class="rating-statistic">
            <div class="average">
                <div class="average-inner">
                    <div class="rating-value p-font"><?php echo wp_kses_post($average); ?></div>
                    <div class="star-rating">
                        <span style="width: <?php echo esc_attr($average*20) ?>%;"><strong itemprop="ratingValue"><?php echo esc_attr($average)?></strong><?php esc_html_e(' out of ','g5plus-academia');?> <?php echo esc_attr($average)?></span>
                    </div>
                    <div class="rating-count fs-14">
                        <?php echo sprintf(esc_html__('%s Ratings','g5plus-academia'),$rating_count) ; ?>
                    </div>
                </div>
            </div>

            <?php
            $args = array (
                'status'         => 'approve',
                'type'           => 'comment',
                'post_id'        => get_the_ID(),
            );

            // The Comment Query
            $course_reviews = new WP_Comment_Query;
            $course_comments = $course_reviews->query( $args );
            $rate1 = $rate2 = $rate3 = $rate4 = $rate5 = 0;
            if(is_array($course_comments)){
                foreach ( $course_comments as $comment ) {
                    $rate = get_comment_meta($comment->comment_ID, 'rating', true);
                    switch($rate) {
                        case 1:
                            $rate1++;
                            break;
                        case 2:
                            $rate2++;
                            break;
                        case 3:
                            $rate3++;
                            break;
                        case 4:
                            $rate4++;
                            break;
                        case 5:
                            $rate5++;
                            break;
                    }
                }
            }
            $rates = array(5=>$rate5,4=>$rate4,3=>$rate3,2=>$rate2,1=>$rate1);
            ?>
            <div class="detail">
                <?php foreach($rates as $key => $val): ?>
                    <div class="rate">
                        <span><?php echo sprintf(esc_html__('%s Start','g5plus-academia'),$key);?></span>
                                <span class="rate-bar">
                                    <span style="width: <?php echo esc_attr(round($val*100/$rating_count, 2));?>%"></span>
                                </span>
                        <?php echo $rates[$key]; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php } ?>

    <div id="comments" >
        <h2 ><?php
            if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
                printf( _n( '%s review for %s', '%s reviews for %s', $count, 'woocommerce' ), $count, get_the_title() );
            else
                esc_html_e( 'Reviews', 'woocommerce' );
            ?></h2>




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

            <p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

        <?php endif; ?>
    </div>

    <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

        <div id="review_form_wrapper">
            <div id="review_form">
                <?php
                $commenter = wp_get_current_commenter();

                $comment_form = array(
                    'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : esc_html__( 'Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
                    'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
                    'comment_notes_before' => '',
                    'comment_notes_after'  => '',
                    'fields'               => array(
                        'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'woocommerce' ) . ' <span class="required">*</span></label> ' .
                            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
                        'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'woocommerce' ) . ' <span class="required">*</span></label> ' .
                            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
                    ),
                    'label_submit'  => esc_html__( 'Submit', 'woocommerce' ),
                    'logged_in_as'  => '',
                    'comment_field' => ''
                );

                if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
                    $comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'woocommerce' ), esc_url( $account_page_url ) ) . '</p>';
                }

                if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                    $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'woocommerce' ) .'</label><select name="rating" id="rating">
							<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . esc_html__( 'Very Poor', 'woocommerce' ) . '</option>
						</select></p>';
                }

                $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your Review', 'woocommerce' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
                comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

                ?>
            </div>
        </div>

    <?php else : ?>

        <p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

    <?php endif; ?>

    <div class="clear"></div>
</div>
