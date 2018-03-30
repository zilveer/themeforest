<?php 
/*
	Show button for controling lightbox
	Input : 
		- Object $post : the current post.
		- string $class_fancy : class name of 'a' tag.
		- string $rel : the group name of lightbox.
		- boolean $begin_show : show or not control lightbox when page loaded.
	Ouput :
		the html of control lightbox.
*/
if(!function_exists('show_light_box')){
	function show_light_box($post,$class_fancy,$rel = '',$id = '',$begin_show = false){	
		// Get link lightbox for image or video (youtube or vimeo)
		if($video_link = get_post_meta($post->ID,THEME_SLUG.'video_portfolio',true)){
			$thumbnail = get_thumbnail_video($video_link, $width_thumb, $height_thumb);
			if(strstr($video_link,'youtube.com') || strstr($video_link,'youtu.be')){
				 $class_fancy .= ' youtube';
				 $big_image_url = 'http://www.youtube.com/watch?v='.  wp_parse_youtube_link($video_link);
			}
			else{
				$class_fancy .= ' vimeo';
				$big_image_url = $video_link;
			}
		}
		else {
			$big_image_id = get_post_thumbnail_id($post->ID);  
			$big_image_url = wp_get_attachment_image_src($big_image_id,'full');
			$big_image_url = $big_image_url[0];
		}
		?>
		<div class="fancybox_container"<?php if($id) echo " id='{$id}'";?><?php if(!$begin_show) echo " style='display:none'";?>>
			<a class="<?php echo $class_fancy;?> fancybox_control" title="<?php echo get_the_title($post->ID)?>" <?php if($rel) echo "rel='{$rel}'";?> href="<?php echo $big_image_url; ?>"><?php _e('LightBox','wpdance')?></a>
		</div>	
		<?php
	}
}	
?>