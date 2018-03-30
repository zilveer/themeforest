<?php
/**
 * Media shortcodes, for youtube, vimeo and others video
 * 
 * @package WordPress
 * @subpackage YIW Themes
 */           


if ( ! function_exists( 'yiw_sc_youtube_func' ) ) :
/** 
 * YOUTUBE     
 * 
 * @description
 *    Embed the player youtube video.    
 * 
 * @example
 *   [youtube width="640" height="385" video_id="wSBIcNmCAX0"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   video_id - the id of video
 *      es.  URL : http://www.youtube.com/watch?v=RomZBcLH6do     video_id : RomZBcLH6do 
**/
function yiw_sc_youtube_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"width" => 640,
		"height" => 385,
		"video_id" => null
	), $atts));
	
	$html = "<div class=\"post_video youtube\"><iframe width=\"$width\" height=\"$height\" src=\"http://www.youtube.com/embed/$video_id\" frameborder=\"0\" allowfullscreen></iframe></div>";
	
// 	$html = '
// 	    <div class="post_video youtube">
//             <object width="'.$width.'" height="'.$height.'">
//                 <param name="movie" value="http://www.youtube.com/v/'.$video_id.'?fs=1"></param>
//                 <param name="allowFullScreen" value="true"></param>
//                 <param name="allowscriptaccess" value="always"></param>
//                 <embed src="http://www.youtube.com/v/'.$video_id.'?fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$width.'" height="'.$height.'"></embed>
//             </object>
//         </div>';
	
	return apply_filters( 'yiw_sc_youtube_html', $html );
}                                  
endif;
add_shortcode("youtube", "yiw_sc_youtube_func");     


if ( ! function_exists( 'yiw_sc_vimeo_func' ) ) :
/** 
 * VIMEO     
 * 
 * @description
 *    Embed the player vimeo video.    
 * 
 * @example
 *   [vimeo width="640" height="360" video_id="3109777"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   video_id - the id of video
 *      es.  URL : http://vimeo.com/3109777     video_id : 3109777 
**/
function yiw_sc_vimeo_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"width" => 640,
		"height" => 370,
		"video_id" => null
	), $atts));
	
	$html = "<div class=\"post_video vimeo\"><iframe src=\"http://player.vimeo.com/video/$video_id?title=0&amp;byline=0&amp;portrait=0\" width=\"$width\" height=\"$height\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>";
	
// 	$html = '
// 	    <div class="post_video vimeo">
//             <object width="'.$width.'" height="'.$height.'">
//                 <param name="allowfullscreen" value="true" />
//                 <param name="allowscriptaccess" value="always" />
//                 <param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id='.$video_id.'&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" />
//                 <embed src="http://vimeo.com/moogaloop.swf?clip_id='.$video_id.'&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="'.$width.'" height="'.$height.'"></embed>
//             </object>
//         </div>';
	
	return apply_filters( 'yiw_sc_vimeo_html', $html );
}                  
endif;
add_shortcode("vimeo", "yiw_sc_vimeo_func");     


if ( ! function_exists( 'yiw_sc_dailymotion_func' ) ) :
/** 
 * DAILYMOTION     
 * 
 * @description
 *    Embed the player dailymotion video.    
 * 
 * @example
 *   [dailymotion width="640" height="360" video_id="xgis0k"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   video_id - the id of video
 *      es.  URL : http://dailymotion.virgilio.it/video/xgp1c6     video_id : xgp1c6 
**/
function yiw_sc_dailymotion_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"width" => 640,
		"height" => 385,
		"video_id" => null
	), $atts));
	
	$html = '
	    <div class="post_video dailymotion">
            <object width="'.$width.'" height="'.$height.'">
                <param name="movie" value="http://dailymotion.virgilio.it/swf/video/'.$video_id.'?width='.$width.'&theme=none&foreground=%23F7FFFD&highlight=%23FFC300&background=%23171D1B&additionalInfos=1&hideInfos=1&start=&animatedTitle=&iframe=0&autoPlay=0"></param>
                <param name="allowFullScreen" value="true"></param>
                <param name="allowScriptAccess" value="always"></param>
                <embed type="application/x-shockwave-flash" src="http://dailymotion.virgilio.it/swf/video/'.$video_id.'?width='.$width.'&theme=none&foreground=%23F7FFFD&highlight=%23FFC300&background=%23171D1B&additionalInfos=1&hideInfos=1&start=&animatedTitle=&iframe=0&autoPlay=0" width="'.$width.'" height="'.$height.'" allowfullscreen="true" allowscriptaccess="always"></embed>
            </object>
        </div>';
	
	return apply_filters( 'yiw_sc_dailymotion_html', $html );
}                   
endif;
add_shortcode("dailymotion", "yiw_sc_dailymotion_func");       

?>