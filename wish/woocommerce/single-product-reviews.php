<?php
/**
 * Display single product reviews (comments)
 *
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version     2.3.2
 */
global $woocommerce, $product;

if ( !defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly
?>
<?php if ( comments_open() ) : ?>

    <div id="reviews">
        <div class="col-lg-6 col-md-6">
            <div id="comments">

                <?php
                if ( get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) {

                    $count = $product->get_review_count();

                    if ( $count > 0 ) {

                        $average = $product->get_average_rating();

                        echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

                        // echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'wish' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'wish' ).'</span></div>';

                        echo '<h2>' . sprintf( _n( '%s review', '%s reviews', $count, 'wish' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>', wptexturize( $post->post_title ) ) . '</h2>';

                        echo '</div>';
                    } else {

                        echo '<h2>' . __( 'Reviews', 'wish' ) . '</h2>';
                    }
                } else {

                    echo '<h2>' . __( 'Reviews', 'wish' ) . '</h2>';
                }

                $title_reply = '';

                if ( have_comments() ) :

                    echo '<ol class="commentlist">';

                    wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

                    echo '</ol>';

                    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                        ?>
                        <div class="navigation">
                            <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'wish' ) ); ?></div>
                            <div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'wish' ) ); ?></div>
                        </div>
        <?php
        endif;

//echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button" title="' . __( 'Add Your Review', 'wish' ) . '">' . __( 'Add Review', 'wish' ) . '</a></p>';

        $title_reply = __( 'Add a review', 'wish' );

    else :

        $title_reply = __( 'Be the first to write a review', 'wish' ) . '';

        echo '<p class="noreviews">' . __( 'There are no reviews yet!', 'wish' ) . '</p>';

    endif;

    $commenter = wp_get_current_commenter();
    ?>
            </div>
        </div>
        <div id="review_form_wrapper_visible" class="col-lg-6 col-md-6">
            <div id="review_form">

    <?php
    $comment_form = array(
        'title_reply' => $title_reply,
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'fields' => array(
            'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'wish' ) . '</label> ' . '<span class="required">*</span>' .
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
            'email' => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'wish' ) . '</label> ' . '<span class="required">*</span>' .
            '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
        ),
        'label_submit' => __( 'Submit Review', 'wish' ),
        'logged_in_as' => '',
        'comment_field' => ''
    );

    if ( get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) {

        $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'wish' ) . '</label><select name="rating" id="rating">
			<option value="">' . __( 'Rate&hellip;', 'wish' ) . '</option>
			<option value="5">' . __( 'Perfect', 'wish' ) . '</option>
			<option value="4">' . __( 'Good', 'wish' ) . '</option>
			<option value="3">' . __( 'Average', 'wish' ) . '</option>
			<option value="2">' . __( 'Not that bad', 'wish' ) . '</option>
			<option value="1">' . __( 'Very Poor', 'wish' ) . '</option>
		</select></p>';
    }

    $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'wish' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . wp_nonce_field( 'woocommerce-comment_rating', '_wpnonce', true, false );

    comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
    ?>

            </div>
        </div>
        <div class="clear"></div></div>
<?php endif; ?>
