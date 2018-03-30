<?php 
if(!function_exists ('wd_parse_daily_link')){
	function wd_parse_daily_link($daily_link){
		if (preg_match('/dailymotion.com\/video\/(.*)/', $daily_link, $match)) {
			return $match[1];
		}
		else{
			return substr($video_url,10,strlen($video_url));
		}
	}
}

if(!function_exists ('wd_parse_youtube_link')){
	function wd_parse_youtube_link($youtube_link){
		preg_match('%(?:youtube\.com/(?:user/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_link, $match);
		if(count($match) >= 2)
			return $match[1];
		else
			return '';
	}
}

if(!function_exists ('wd_parse_vimeo_link')){
	function wd_parse_vimeo_link($video_url){
		if (preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $match)) {
			return $match[1];
		}
		else{
			return substr($video_url,10,strlen($video_url));
		}
	}
}

if(!function_exists ('wd_get_embbed_daily')){
	function wd_get_embbed_daily($video_url,$width = 940,$height = 558){
		$url_embbed = "http://www.dailymotion.com/swf/".wd_parse_daily_link($video_url);
		return '<object width="'.$width.'" height="'.$height.'">
					<param name="movie" value="'.$url_embbed.'"></param>
					<param name="allowFullScreen" value="true"></param>
					<param name="allowScriptAccess" value="always"></param>
					<embed type="application/x-shockwave-flash" src="'.$url_embbed.'" width="'.$width.'" height="'.$height.'" allowfullscreen="true" allowscriptaccess="always"></embed>
				</object>';
	}
}


if(!function_exists ('wd_get_embbed_vimeo')){
	function wd_get_embbed_vimeo($video_url,$width,$height){
		return '<iframe src="//player.vimeo.com/video/'.wd_parse_vimeo_link($video_url).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
	}
}

if(!function_exists ('wd_get_embbed_video')){
	function wd_get_embbed_video($video_url,$width = 940,$height = 558){
		if(strstr($video_url,'youtube.com') || strstr($video_url,'youtu.be')){
			return "<iframe id='youtube-iframe' title='YouTube video player' class='youtube-player' type='text/html'
				 width='{$width}' height='{$height}' src='http://www.youtube.com/embed/".wd_parse_youtube_link($video_url)."?wmode=transparent'
			 frameborder='0' allowFullScreen></iframe>";
						
		}
		elseif(strstr($video_url,'vimeo.com')){
			return wd_get_embbed_vimeo($video_url,$width,$height);
		}
		elseif(strstr($video_url,'dailymotion.com')){
			return wd_get_embbed_daily($video_url,$width,$height);
		}	
	}
}
?>