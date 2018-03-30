<?php 
function  webnus_videorow_shortcode($attributes, $content) {
    extract( shortcode_atts( array(

        "img" => '',
        "height" => '',
        'padding_top'  => 0,
        'padding_bottom'  => 0,
		'dark'=>'false',
		'class'=>'',
		'video_pattern'=>'true',
		'id'=>'',

		'video_src'=>'host',
		'video_sharing_url'=>'',
		'mp4_format'=>'',
		'webm_format'=>'',
		'ogg_format'=>'',
		'img_preview_video'=>'',

	), $attributes));

	if( is_numeric( $img_preview_video ) ) { $img_preview_video = wp_get_attachment_url( $img_preview_video ); }

	$height_style = ($height) ? ' min-height: ' . $height . 'px !important; ' : 'min-height: 380px;' ;
	$padding_style= " padding-top:{$padding_top}; padding-bottom:{$padding_bottom}; ";
	$id = ($id) ? 'id="' . $id . '"' : '' ;
	$spattern = ( $video_pattern == 'true' ) ? 'class="spattern"' : '' ;
	
		$out = '</div></section><section ' . $id . ' class="video-sec ' . $class . '" style="' . $padding_style . $height_style . '">';
		$out .= '<div class="wpb_row vc_row-fluid full-row">';
		$out .= '<div ' . $spattern . '>';

	if ( $video_src == 'host' ) :
		$default_screen_video = 'class="video-item" ';
		$out .= '<video autoplay loop muted preload="auto" ' . $default_screen_video . '>';
		$out .= ! empty( $mp4_format ) ? '<source src="' . $mp4_format . '" type="video/mp4">' : '';
		$out .= ! empty( $webm_format ) ? '<source src="' . $webm_format . '" type="video/webm">' : '';
		$out .= ! empty( $ogg_format ) ? '<source src="' . $ogg_format . '" type="video/ogg">' : '';
		$out .= 'Your browser does not support the video tag. I suggest you upgrade your browser.</video>';
		$out .= '<div style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; background-position: 50% 50%; background-repeat: no-repeat; background-size: auto 100%; background: transparent url(' . $img_preview_video . ') 50% 50% / cover no-repeat ;"></div>';
	elseif ( $video_src == 'video_sharing' ) :
		$out .= '<div class="youtube-wrap"><div class="yt-player" id="' . $video_sharing_url . '"></div></div>';
		$out .= '<div style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; background-position: 50% 50%; background-repeat: no-repeat; background-size: auto 100%; background: transparent url(' . $img_preview_video . ') 50% 50% / cover no-repeat ;"></div>';
		wp_enqueue_script('youtube-api');
	endif;

		$dark = ( $dark == 'true' ) ? ' dark ' : '';
	    $out .= '<article class="slides-content ' . $dark . '">';
	    $out .= '<div class="container">';	
	    $out .= do_shortcode($content);
	    $out .= '</div></article>'; 
	    $out .= '</div></div></section><section class="container"><div class="row-wrapper-x">';
	
    return $out;
}
add_shortcode("videorow", 'webnus_videorow_shortcode');
?>