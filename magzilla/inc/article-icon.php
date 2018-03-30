<?php
if( get_post_meta( get_the_ID(), 'fave_review_checkbox', true ) == 1 ) {

		$fave_score_display_type = get_post_meta( get_the_ID(), 'fave_score_display_type', true );
		$fave_final_score = get_post_meta( get_the_ID(), 'fave_final_score', true );
		$fave_final_score_override = get_post_meta( get_the_ID(), 'fave_final_score_override', true );


		$fave_review_final_score = intval($fave_final_score);

		if ( $fave_score_display_type == 'percentage' ) {
			$fave_score_output = $fave_review_final_score . '%';
		}

		if ( $fave_score_display_type == 'points' ) {
			$fave_score_output = $fave_review_final_score /10;
		}
		?>

		<div class="score-label score-label-2"><?php echo $fave_score_output; ?></div>

<?php		
		
} else {
	if ( 'gallery' == get_post_format() ): // Gallery
	    echo '<div class="post-type-icon"><i class="fa fa-picture-o"></i></div>';
	elseif ( 'video' == get_post_format() ): // Video
	    echo '<div class="post-type-icon"><i class="fa fa-video-camera"></i></div>';
	elseif ( 'audio' == get_post_format() ): // Audio
	    echo '<div class="post-type-icon"><i class="fa fa-microphone"></i></div>';
	elseif ( 'link' == get_post_format() ): // Link
	    echo '<div class="post-type-icon"><i class="fa fa-link"></i></div>';
	endif;
}
?>
