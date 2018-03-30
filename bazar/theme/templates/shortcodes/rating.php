<?php 
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

	//echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

		echo '<div class="star-rating shortcode" title="'.sprintf(__( 'Rated %s out of 5', 'yit' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'yit' ).'</span></div>';

	//echo '</div>';

	} else {

		_e('No Rating', 'yit');

	}

?>