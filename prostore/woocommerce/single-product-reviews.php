<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/single-product-reviews.php
 * @sub-package WooCommerce/Templates/single-product-reviews.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>
<?php if ( comments_open() ) : ?><div id="reviews"><?php

	echo '<div id="comments">';

	$count = $wpdb->get_var("
		SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = $post->ID
		AND comment_approved = '1'
		AND meta_value > 0
	");

	$rating = $wpdb->get_var("
		SELECT SUM(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = $post->ID
		AND comment_approved = '1'
	");

?>
	<div class="row reviews-intro">
		<div class="six columns">
			<?php

				if ( $count > 0 ) :

					echo '<h6>This product has '.sprintf( _n('%s review', '%s reviews', $count, 'woocommerce'), '<span itemprop="ratingCount" class="focus">'.$count.'</span>').'</h6>';

				else :

					echo '<h6>This product has <span class="alert-color">0</span> review yet.</h6>';

				endif;


				echo '<p class="add_review"><a href="#" class="inline review_form button alert"><em class="icon-chat"></em> <span class="helper">'.__('Add Review', 'woocommerce').'</span></a></p>';

			?>
		</div>
		<div class="six columns text-right">
			<?php

				if ( $count > 0 ) :

					$average = number_format($rating / $count, 2);

					echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';


					echo '<h6 class="star-rating-label">Average rating : <span itemprop="ratingValue" class="count">'.$average.'/5</span></h6>';

					echo '<div class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> '.__('out of 5', 'woocommerce').'</span></div>';

					echo '</div>';

				endif;
			?>
		</div>
	</div>

<?php

	$title_reply = '';

	if ( have_comments() ) :

		echo '<ol class="commentlist">';

		wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation clearfix">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav"><em class="icon-left-open"></em></span> Previous', 'woocommerce' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav"><em class="icon-right-open"></em></span>', 'woocommerce' ) ); ?></div>
			</nav>
		<?php endif;

		$title_reply = __('Add a review', 'woocommerce');

	else :

		$title_reply = __('Be the first to review', 'woocommerce').' <span class="alert-color">'.$post->post_title.'</span>';

	endif;

	$commenter = wp_get_current_commenter();

	echo '</div><div id="review_form"><div class="row container">';

	echo '<div class="alert-box" id="comment-status"></div>';

	$comment_form = array(
		'title_reply' => $title_reply,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
						'author' => '<div class="six columns"><p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'woocommerce' ) . '</label> ' . '<span class="required">*</span></p>' .
			            '<div class="row"><div class="twelve columns"><div class="row collapse"><div class="one mobile-one columns input"><span class="prefix"><em class="icon-user"></em></span></div><div class="eleven mobile-three columns input"><input id="author" name="author" type="text" class="dark" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="Your name" /></div></div></div></div></div>',
			'email'  => '<div class="six columns"><p class="comment-form-email"><label for="email">' . __( 'Email', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>' .
			            '<div class="row"><div class="twelve columns"><div class="row collapse"><div class="two mobile-one columns"><span class="prefix"><em class="icon-at"></em></span></p></div><div class="ten mobile-three columns"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" class="dark" placeholder="Your email address" /></div></div></div></div></div>',
		),
		'label_submit' => __('Submit Review', 'woocommerce'),
		'logged_in_as' => '',
		'comment_field' => ''
	);

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$comment_form['comment_field'] = '<div class="one column mobile-one text-right comment-form-rating"><label for="rating">' . __('Rating', 'woocommerce') .'</label></div><div class="eleven columns comment-field comment-form-rating"><select name="rating" id="rating">
			<option value="">'.__('Rate&hellip;', 'woocommerce').'</option>
			<option value="5">'.__('Perfect', 'woocommerce').'</option>
			<option value="4">'.__('Good', 'woocommerce').'</option>
			<option value="3">'.__('Average', 'woocommerce').'</option>
			<option value="2">'.__('Not that bad', 'woocommerce').'</option>
			<option value="1">'.__('Very Poor', 'woocommerce').'</option>
		</select></div>';

	}
	if(is_user_logged_in()) {
		global $userdata;
		get_currentuserinfo();

		$comment_form['comment_field'] .= '<div class="one column mobile-one logged_in_user text-right">'.get_avatar( $userdata->ID, 27 ).'</div><div class="eleven mobile-three columns logged_in_user_review"><p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . '</label></p><textarea id="comment" name="comment" class="logged_in_user dark" aria-required="true" placeholder="Your Review"></textarea></div>' . $woocommerce->nonce_field('comment_rating', true, false);
	} else {
		$comment_form['comment_field'] .= '<div class="twelve columns comment-field"><p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . '</label></p><textarea id="comment" name="comment" class="dark" aria-required="true" placeholder="Your Review"></textarea></div>' . $woocommerce->nonce_field('comment_rating', true, false);
	}

	comment_form( $comment_form );

	echo '</div></div>';

?><div class="clear"></div></div>
<?php endif; ?>