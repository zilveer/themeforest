<?php
	global $post;
	
	$post_style = get_post_meta(get_the_ID(), 'post_style', true );
    $video_url = get_post_meta( $post->ID, $key = 'video_url', true);
	
	if((plsh_gs('post_style') == 'no-sidebar' && $post_style == 'global') || $post_style == 'no-sidebar')	//full width
	{
		$size_w = 970;
		$size_h = 546;		
	}
	else
	{
		$size_w = 640;
		$size_h = 360;
	}
	
	//enable autoplay
	$params = '';
	if(get_post_image_width($post->ID) == 'video_autoplay')
	{
		$params = '?autoplay=1&rel=0';
	}
    else
    {
        $params = '?ref=0';
    }
		
	if(!empty($video_url))
	{
		if(strpos($video_url, 'youtube'))	//youtube
		{
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match)) {
				$id = $match[1];
			}
			
			$video_url = 'https://www.youtube.com/embed/' . $id;
		}
		elseif(strpos($video_url, 'vimeo'))		//vimeo
		{
			$url_parts = parse_url($video_url);
			
			if(!empty($url_parts['path']))
			{
				preg_match_all('!\d+!', $url_parts['path'], $numbers);
				if(!empty($numbers[0]) && !empty($numbers[0][0]))
				{
					$id = $numbers[0][0];
					$video_url = 'https://player.vimeo.com/video/' . $id;
				}
			}
		}
		
		?>
		<div class="post-image-video-embed">
			<iframe width="<?php echo $size_w; ?>" height="<?php echo $size_h; ?>" src="<?php echo $video_url . $params; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		</div>
		<?php
	}
?>