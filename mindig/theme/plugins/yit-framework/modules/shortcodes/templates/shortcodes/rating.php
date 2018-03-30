<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for print a product rating
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

	global $wpdb;

	$count = $wpdb->get_var( $wpdb->prepare("
		SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = %d
		AND comment_approved = '1'
		AND meta_value > 0
	", $id ) );

	$rating = $wpdb->get_var( $wpdb->prepare("
		SELECT SUM(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = %d
		AND comment_approved = '1'
	", $id ) );

	if ( $count > 0 ) {

		$average = number_format($rating / $count, 2);	
		echo '<div class="star-rating shortcode" title="'.sprintf(__( 'Rated %s out of 5', 'yit' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'yit' ).'</span></div>';

	} else {

		echo '<div class="star-rating shortcode">' .__('No Rating', 'yit') . '</div>';

	}

?>