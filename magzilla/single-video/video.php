<?php
$video_channel = get_post_meta( get_the_ID(), 'fave_video_channel', true );
$video_id = get_post_meta( get_the_ID(), 'fave_video_id', true );
$video_duration = get_post_meta( get_the_ID(), 'fave_video_duration', true );

if ( $video_channel == 'vimeo' ) {

		$video_link = "https://player.vimeo.com/video/".$video_id."?color=ffcc3a";

	    echo '<div class="magazilla_video_wrapper"><iframe src="'.esc_url( $video_link ).'" frameborder="0" allowfullscreen></iframe></div>';

	} elseif ( $video_channel == 'youtube' ) {

		$video_link = "https://www.youtube.com/embed/".$video_id."";
	    echo '<div class="magazilla_video_wrapper"><iframe src="'.esc_url( $video_link ).'" frameborder="0" allowfullscreen></iframe></div>';

	} elseif ( $video_channel == 'dailymotion' ) {

		$video_link = "//www.dailymotion.com/embed/video/".$video_id."";
	    echo '<div class="magazilla_video_wrapper"><iframe width="1170" height="435" src="'. $video_link .'" frameborder="0" allowfullscreen></iframe></div>';

	} elseif ( $video_channel == 'embed_code' ) {

	    echo '<div class="magazilla_video_wrapper">'.$video_id.'</div>';

	}
?>