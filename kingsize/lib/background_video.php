<?php
/**
 * @KingSize 2014-2016
 * Fullscreen video background
 **/
global $data,$cnt_slider;

//background slider options validate	
	$show_slider = false;
if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_video_background', true ) == 'image' && $cnt_slider > 0 )
	$show_slider = true;
elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_video_background', true ) == 'image' && $cnt_slider > 0 )
	$show_slider = true;
elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_video_background', true ) == 'image' && $cnt_slider > 0 )
	$show_slider = true;

//Mobile detect object
$detectMobile = new Mobile_Detect;


if((is_single() || is_page()) && get_post_meta( $wp_query->post->ID, 'kingsize_page_slider_video_background', true )=='video'){	//page background


   //Checking for mobile	
   if((get_post_meta($wp_query->post->ID, 'page_enable_mobile_background', true ) == '1') && ($detectMobile->isMobile() || $detectMobile->isTablet() )) 
	{
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/supersized.3.2.6.min.js"></script>';
		echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/supersized.css" type="text/css" media="screen" />';

		$theme_custom_mobile_bg = get_post_meta( $wp_query->post->ID, 'page_mobile_video_background', true );
		
		if($theme_custom_mobile_bg == '')
			$theme_custom_mobile_bg = $data['wm_background_image'];

		echo '
		<script type="text/javascript">			
			jQuery(function($){				
				$.supersized({
					slides  :  	[ {image : "'.$theme_custom_mobile_bg.'"} ]
				});
		    });		    
		</script>';
			
	}else{

	//Video integration starts
	$video_url = get_post_meta( $wp_query->post->ID, 'kingsize_page_video_background', true );
	$ytube_video_id = parse_yturl($video_url); //Getting the Youtube video ID
	

	    if(preg_match('/vimeo/', $video_url)) /// VIMEO VIDEO
		{
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				if(get_post_meta( $wp_query->post->ID, 'kingsize_page_autoplay_video', true ))
					$autoplay = 1;
				else
					$autoplay = 0;

				if(get_post_meta( $wp_query->post->ID, 'kingsize_page_repeat_video', true )) 
					$loop_vimeo = 1;
				else
					$loop_vimeo = 0;

				$output = '<!-- Fullscreen vimeo video background -->';
				$output .= '<div class="backgroundvimeo widescreen vimeo video-content">    
								<iframe frameborder="0" src="//player.vimeo.com/video/'.$matches[1].'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='.$autoplay.'&amp;loop='.$loop_vimeo.'"  webkitallowfullscreen="" allowfullscreen=""></iframe>    
							</div>';
				$output .= '<!--vimeo video Background ends here-->';

			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'kslang');
			}

			echo $output;

		}
		else //YouTube OR MP4
		{
		?>
			<!-- Fullscreen video background -->
			<link href="//vjs.zencdn.net/5.6/video-js.min.css" rel="stylesheet">
			<script src="//vjs.zencdn.net/5.6/video.min.js"></script>
			<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/Youtube.js'></script>
			
			
			<div  class="backgroundvimeo widescreen vimeo video-content">
				<video
					id="example_video_1"
					class="video-js vjs-default-skin vjs-big-play-centered"
					controls
					<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_page_autoplay_video', true )) { ?>autoplay<?php } ?>
										
					data-setup='{ 
							<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_page_controlbar_video', true )) {?>"controlBar": false,<?php } ?> 
							<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_page_autoplay_video', true )) { ?>"autoplay": true,<?php } ?> 
							<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_page_repeat_video', true )) {?>"loop": true,<?php } ?> 
							"fluid":true,
							<?php if(!preg_match('/^.*\.(mp4|MP4)$/i', $video_url)) { ?>
							"techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "<?php echo $video_url;?>"}]
							<?php } else { ?> "preload": "auto" <?php }?>
								}'
				  >
					<?php if(preg_match('/^.*\.(mp4|MP4)$/i', $video_url)) { ?>
					<source src="<?php echo $video_url;?>" type='video/mp4' />
					<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
					<?php }?>
				</video>

			</div>
			<style>
			@media only screen and (max-width: 1280px) {
					.vjs-big-play-button { display: none !important; }
			}
			</style>		
			<script> 
				videojs("example_video_1").ready(function(){
				  var myPlayer = this;
				  <?php if(get_post_meta( $wp_query->post->ID, 'kingsize_page_autoplay_video', true )) { ?>	
				  // EXAMPLE: Start playing the video.
				  myPlayer.play();
				  <?php } ?>	
				});
			</script> 
			<!--Fullscreen video Background ends here-->
			<!--Youtube video Background ENDS here-->
		<?php
		}
	}
}
elseif((is_single() || is_page()) && get_post_meta( $wp_query->post->ID, 'kingsize_post_slider_video_background', true )=='video'){	//post background
	
	
	 //Checking for mobile	
   if((get_post_meta($wp_query->post->ID, 'post_enable_mobile_background', true ) == '1') && ($detectMobile->isMobile() || $detectMobile->isTablet() )) 
	{
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/supersized.3.2.6.min.js"></script>';
		echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/supersized.css" type="text/css" media="screen" />';

		$theme_custom_mobile_bg = get_post_meta( $wp_query->post->ID, 'post_mobile_video_background', true );
		
		if($theme_custom_mobile_bg == '')
			$theme_custom_mobile_bg = $data['wm_background_image'];

		echo '
		<script type="text/javascript">			
			jQuery(function($){				
				$.supersized({
					slides  :  	[ {image : "'.$theme_custom_mobile_bg.'"} ]
				});
		    });		    
		</script>';
			
	}else{
		
	$video_url = get_post_meta( $wp_query->post->ID, 'kingsize_post_video_background', true );

	
		if(preg_match('/vimeo/', $video_url)) /// VIMEO VIDEO
		{
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				if(get_post_meta( $wp_query->post->ID, 'kingsize_post_autoplay_video', true ))
					$autoplay = 1;
				else
					$autoplay = 0;

				if(get_post_meta( $wp_query->post->ID, 'kingsize_post_repeat_video', true )) 
					$loop_vimeo = 1;
				else
					$loop_vimeo = 0;

				$output = '<!-- Fullscreen vimeo video background -->';
				$output .= '<div class="backgroundvimeo widescreen vimeo">    
								<iframe frameborder="0" src="//player.vimeo.com/video/'.$matches[1].'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='.$autoplay.'&amp;loop='.$loop_vimeo.'"  webkitallowfullscreen="" allowfullscreen=""></iframe>    
							</div>';
				$output .= '<!--vimeo video Background ends here-->';

			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'kslang');
			}

			echo $output;

		}
		else //YOUTUBE and MP4 VIDEO
		{
		?>
			<!-- Fullscreen video background -->
			<link href="//vjs.zencdn.net/5.6/video-js.min.css" rel="stylesheet">
			<script src="//vjs.zencdn.net/5.6/video.min.js"></script>
			<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/Youtube.js'></script>
			
			
			<div  class="backgroundvimeo widescreen vimeo video-content">
				<video
					id="example_video_1"
					class="video-js vjs-default-skin vjs-big-play-centered"
					controls
					<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_post_autoplay_video', true )) { ?>autoplay<?php } ?>
										
					data-setup='{ 
							<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_post_controlbar_video', true )) {?>"controlBar": false,<?php } ?> 
							<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_post_autoplay_video', true )) { ?>"autoplay": true,<?php } ?> 
							<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_post_repeat_video', true )) {?>"loop": true,<?php } ?> 
							"fluid":true,
							<?php if(!preg_match('/^.*\.(mp4|MP4)$/i', $video_url)) { ?>
							"techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "<?php echo $video_url;?>"}]
							<?php } else { ?> "preload": "auto" <?php }?>
								}'
				  >
					<?php if(preg_match('/^.*\.(mp4|MP4)$/i', $video_url)) { ?>
					<source src="<?php echo $video_url;?>" type='video/mp4' />
					<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
					<?php }?>
				</video>

			</div>
			
			<script> 
				videojs("example_video_1").ready(function(){
				  var myPlayer = this;
				  <?php if(get_post_meta( $wp_query->post->ID, 'kingsize_post_autoplay_video', true )) { ?>	
				  // EXAMPLE: Start playing the video.
				  myPlayer.play();
				  <?php } ?>	
				});
			</script>
			<style>
			@media only screen and (max-width: 1280px) {
					.vjs-big-play-button { display: none !important; }
			}
			</style>	 
			<!--Fullscreen video Background ends here-->
			<!--Youtube video Background ENDS here-->

		<?php
		}
	}
}
elseif((is_single() || is_page()) && get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_slider_video_background', true )=='video'){	//portfolio background

	
   //Checking for mobile	
   if((get_post_meta($wp_query->post->ID, 'portfolio_enable_mobile_background', true ) == '1') && ($detectMobile->isMobile() || $detectMobile->isTablet() )) 
	{
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/supersized.3.2.6.min.js"></script>';
		echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/supersized.css" type="text/css" media="screen" />';

		$theme_custom_mobile_bg = get_post_meta( $wp_query->post->ID, 'portfolio_mobile_video_background', true );
		
		if($theme_custom_mobile_bg == '')
			$theme_custom_mobile_bg = $data['wm_background_image'];

		echo '
		<script type="text/javascript">			
			jQuery(function($){				
				$.supersized({
					slides  :  	[ {image : "'.$theme_custom_mobile_bg.'"} ]
				});
		    });		    
		</script>';
			
	}else{	

		$video_url = get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_video_background', true );

	
		if(preg_match('/vimeo/', $video_url)) /// VIMEO VIDEO
		{
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_autoplay_video', true ))
					$autoplay = 1;
				else
					$autoplay = 0;

				if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_repeat_video', true )) 
					$loop_vimeo = 1;
				else
					$loop_vimeo = 0;

				$output = '<!-- Fullscreen vimeo video background -->';
				$output .= '<div class="backgroundvimeo widescreen vimeo">   
								<iframe frameborder="0" src="//player.vimeo.com/video/'.$matches[1].'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='.$autoplay.'&amp;loop='.$loop_vimeo.'" webkitallowfullscreen="" allowfullscreen=""></iframe>
						  </div>';
				$output .= '<!--vimeo video Background ends here-->';

			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'kslang');
			}

			echo $output;

		}
		else //YOUTUBE OR MP4 CUSTOM URL VIDEO
		{
		?>
			<!-- Fullscreen video background -->
			<link href="//vjs.zencdn.net/5.6/video-js.min.css" rel="stylesheet">
			<script src="//vjs.zencdn.net/5.6/video.min.js"></script>
			<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/Youtube.js'></script>
			
			
			<div  class="backgroundvimeo widescreen vimeo video-content">
				<video
					id="example_video_1"
					class="video-js vjs-default-skin vjs-big-play-centered"
					controls
					<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_autoplay_video', true )) { ?>autoplay<?php } ?>
										
					data-setup='{ 
							<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_controlbar_video', true )) {?>"controlBar": false,<?php } ?> 
							<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_autoplay_video', true )) { ?>"autoplay": true,<?php } ?> 
							<?php if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_repeat_video', true )) {?>"loop": true,<?php } ?> 
							"fluid":true,
							<?php if(!preg_match('/^.*\.(mp4|MP4)$/i', $video_url)) { ?>
							"techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "<?php echo $video_url;?>"}]
							<?php } else { ?> "preload": "auto" <?php }?>
								}'
				  >
					<?php if(preg_match('/^.*\.(mp4|MP4)$/i', $video_url)) { ?>
					<source src="<?php echo $video_url;?>" type='video/mp4' />
					<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
					<?php }?>
				</video>

			</div>
			
			<script> 
				videojs("example_video_1").ready(function(){
				  var myPlayer = this;
				  <?php if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_autoplay_video', true )) { ?>	
				  // EXAMPLE: Start playing the video.
				  myPlayer.play();
				  <?php } ?>	
				});
			</script> 
			<style>
			@media only screen and (max-width: 1280px) {
					.vjs-big-play-button { display: none !important; }
			}
			</style>	
			<!--Fullscreen video Background ends here-->
			<!--Youtube video Background ENDS here-->

		<?php
		}
	}
}
elseif(is_home()) { //If Home page then show the video background

   //Checking for mobile	
   if(($data['wm_video_image_background_check'] == '1') && ($detectMobile->isMobile() || $detectMobile->isTablet() )) 
   {
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/supersized.3.2.6.min.js"></script>';
		echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/supersized.css" type="text/css" media="screen" />';

		
		$theme_custom_mobile_bg = $data['wm_background_image'];

		echo '
		<script type="text/javascript">			
			jQuery(function($){				
				$.supersized({
					slides  :  	[ {image : "'.$theme_custom_mobile_bg.'"} ]
				});
		    });		    
		</script>';
			
	}else{	

	if( $data['wm_background_type'] == 'Video Background' ) {	
		
		#### Home Page Video background ######
		global $data;
		$video_autoplay = $data['wm_autoplay_video'];

		$video_url = $data['wm_video_url']; //VIDEO URL
		
		if(preg_match('/vimeo/', $video_url)) /// VIMEO VIDEO
		{
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				if($video_autoplay)
					$autoplay = 1;
				else
					$autoplay = 0;

				if($data['wm_repeat_video']) 
					$loop_video = 1;
				else
					$loop_video = 0;

				$output = '<!-- Fullscreen vimeo video background -->';
				$output .= '<div class="backgroundvimeo widescreen vimeo">   
								<iframe frameborder="0" src="//player.vimeo.com/video/'.$matches[1].'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='.$autoplay.'&amp;loop='.$loop_video.'" webkitallowfullscreen="" allowfullscreen=""></iframe>
						  </div>';
				$output .= '<!--vimeo video Background ends here-->';

			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'kslang');
			}

			echo $output;

		}
		else //YOUTUBE OR MP4 CUSTOM URL VIDEO
		{
		?>
		
		<!-- Fullscreen video background -->
			<link href="//vjs.zencdn.net/5.6/video-js.min.css" rel="stylesheet">
			<script src="//vjs.zencdn.net/5.6/video.min.js"></script>
			<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/Youtube.js'></script>
			
			
			<div  class="backgroundvimeo widescreen vimeo video-content">
				<video
					id="example_video_1"
					class="video-js vjs-default-skin vjs-big-play-centered"
					controls
					<?php if($video_autoplay) { ?>autoplay<?php } ?>
										
					data-setup='{ 
							<?php if($data['wm_controlbar_video']) {?>"controlBar": false,<?php } ?> 
							<?php if($video_autoplay) { ?>"autoplay": true,<?php } ?> 
							<?php if($data['wm_repeat_video']) {?>"loop": true,<?php } ?> 
							"fluid":true,
							<?php if(!preg_match('/^.*\.(mp4|MP4)$/i', $video_url)) { ?>
							"techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "<?php echo $video_url;?>"}]
							<?php } else { ?> "preload": "auto" <?php }?>
								}'
				  >
					<?php if(preg_match('/^.*\.(mp4|MP4)$/i', $video_url)) { ?>
					<source src="<?php echo $video_url;?>" type='video/mp4' />
					<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
					<?php }?>
				</video>

			</div>
			
			<script> 
				videojs("example_video_1").ready(function(){
				  var myPlayer = this;
				  <?php if($video_autoplay) { ?>	
				  // EXAMPLE: Start playing the video.
				  myPlayer.play();
				  <?php } ?>	
				});
			</script> 
			<style>
			@media only screen and (max-width: 1280px) {
					.vjs-big-play-button { display: none !important; }
			}
			</style>	
			<!--Fullscreen video Background ends here-->
			<!--Youtube video Background ENDS here-->
		<?php
		}
	  }	
	}
}
else { //Default image slider OR Background image
	
	include (get_template_directory() . '/lib/background_slider.php'); 

}
?>
