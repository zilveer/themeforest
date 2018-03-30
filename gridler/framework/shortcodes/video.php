<?php
//Video Shortcodes
function vimeo_code($atts,$content = null){

	extract(shortcode_atts(array(  
		"id" 		=> '',
		"width"		=> '', 
		"height" 	=> ''
	), $atts)); 
	 
	$data = "<object width='$width' height='$height' data='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com' type='application/x-shockwave-flash'>
			<param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='wmode' value='opaque'>
			<param name='movie' value='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com' />
		</object>";
	return $data;
} 
add_shortcode("vimeo_video", "vimeo_code"); 

#### YouTube eg http://www.youtube.com/v/MWYi4_COZMU&hl=en&fs=1& id="MWYi4_COZMU&hl=en&fs=1&"
function youTube_code($atts,$content = null){

	extract(shortcode_atts(array(  
      "id" 		=> '',
  		"width"		=> '', 
  		"height" 	=> ''
		 ), $atts)); 
	 
	$data = "<object width='$width' height='$height' data='http://www.youtube.com/v/$id' type='application/x-shockwave-flash'>			
      <param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='FlashVars' value='playerMode=embedded' />
			<param name='wmode' value='opaque'>
			<param name='movie' value='http://www.youtube.com/v/$id' />
		</object>";
	return $data;
} 
add_shortcode("youtube_video", "youTube_code");
