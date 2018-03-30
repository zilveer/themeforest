<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product, $venedor_woo_version;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<?php if ( comments_open() ) : ?><div id="reviews"><?php

	echo '<div id="comments">';

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

        if ( version_compare($venedor_woo_version, '2.3', '<') ) {
    		$count = $product->get_rating_count();
        } else {
            $count = $product->get_review_count();
        }

		if ( $count > 0 ) {

			echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

			$rating = $product->get_average_rating();
            $rating_html = $product->get_rating_html();
            if ( $rating_html = $product->get_rating_html() ) : ?>
            <div class="star-rating ratings">
                <span class="star" data-value="<?php echo $rating ?>" data-toggle="tooltip" data-title="<?php echo $rating ?>">
                    <?php 
                    $j = 0;
                    for ($i = 0; $i < (int)$rating; $i++) {
                        $j++;
                        echo '<i class="fa fa-star"></i>';
                    }
                    if ($rating - (int)$rating >= 0.5) {
                        $j++;
                        echo '<i class="fa fa-star-half-full"></i>';
                    }
                    for ($i = $j; $i < 5; $i++) {
                        $j++;
                        echo '<i class="fa fa-star-o"></i>';
                    } ?>
                </span>
            </div>
            <?php endif;

			echo '<h2>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', '<strong>"'.wptexturize($post->post_title) ).'"</strong></h2>';

			echo '</div>';

		} else {

			echo '<h2>'.__( 'Reviews', 'woocommerce' ).'</h2>';

		}

	} else {

		echo '<h2>'.__( 'Reviews', 'woocommerce' ).'</h2>';

	}

	$title_reply = '';

	if ( have_comments() ) :

		echo '<ol class="commentlist">';

		wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( '<span class="fa fa-angle-left"></span>' ); ?></div>
				<div class="nav-next"><?php next_comments_link( '<span class="fa fa-angle-right"></span>' ); ?></div>
			</div>
		<?php endif; 

		echo '<p class="add_review"><a href="#review-form" class="inline show-review-form button" title="' . __( 'Add a review', 'woocommerce' ) . '">' . __( 'Add a review', 'woocommerce' ) . '</a></p>';

		$title_reply = __( 'Add a review', 'woocommerce' );

	else :

		$title_reply = sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() );

		echo '<p class="noreviews">'.__( 'There are no reviews yet.', 'woocommerce' ).' <a href="#review-form" class="inline show-review-form" title="' . __( 'Add a review', 'woocommerce' ) . '">' . __( 'Add a review', 'woocommerce' ) . '</a></p>';

	endif;

	$commenter = wp_get_current_commenter();

	echo '</div><div id="review_form_wrapper" style="display:none;"><div id="review-form">';

	$comment_form = array(
		'title_reply' => $title_reply,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<p class="comment-form-author input-field">' . '<label for="author"><span class="fa fa-user"></span>' . __( 'Username', 'woocommerce' ) . ' <span class="required">*</span></label> ' . 
			            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="' . __( 'Username', 'woocommerce' ) . '" /></p>',
			'email'  => '<p class="comment-form-email input-field"><label for="email"><span class="fa fa-envelope"></span>' . __( 'Email', 'woocommerce' ) . ' <span class="required">*</span></label> ' . 
			            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="' . __( 'Email', 'woocommerce' ) . '" /></p>',
		),
		'label_submit' => __( 'Submit', 'woocommerce' ),
		'logged_in_as' => '',
		'comment_field' => ''
	);

    if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
        $comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'woocommerce' ), esc_url( $account_page_url ) ) . '</p>';
    }

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$comment_form['comment_field'] = '<p class="comment-form-rating input-field"><label for="rating"><span class="fa fa-star"></span>' . __( 'Your Rating', 'woocommerce' ) . ' <span class="required">*</span></label><select name="rating" id="rating">
			<option value="">'.__( 'Rate&hellip;', 'woocommerce' ).'</option>
			<option value="5">'.__( 'Perfect', 'woocommerce' ).'</option>
			<option value="4">'.__( 'Good', 'woocommerce' ).'</option>
			<option value="3">'.__( 'Average', 'woocommerce' ).'</option>
			<option value="2">'.__( 'Not that bad', 'woocommerce' ).'</option>
			<option value="1">'.__( 'Very Poor', 'woocommerce' ).'</option>
		</select></p>';

	}

	$comment_form['comment_field'] .= '<p class="comment-form-comment textarea-field"><label for="comment"><span class="fa fa-edit"></span>' . __( 'Your Review', 'woocommerce' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'Your Review', 'woocommerce' ) . '"></textarea></p>';

	comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

	echo '</div></div>';

?><div class="clear"></div></div>
<script type="text/javascript">
jQuery(function($) {
    $('.show-review-form').click(function() {
        $('#review_form_wrapper').slideToggle();
    });
});
</script>
<?php endif; ?>