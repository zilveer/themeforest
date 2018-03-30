<?php
	add_shortcode('ot-caption', 'caption_handler');
	
	function caption_handler($atts, $content=null, $code="") {
	
		/* title */
		if(isset($atts["title"])) {
			$title_i = $atts["title"];
		} else {
			$title_i = "";
		}
		
		/* url */
		if(isset($atts["url"])) {
			$url_i = $atts["url"];
		} else {
			$url_i = "";
		}
		
		$image = get_post_thumb(false, 820, 480, false, $url_i);
		$blog_url = get_template_directory_uri();
			$return =  '		
				<div class="wp-caption aligncenter">
					<a href="'.$url_i.'" class="hover-img lightbox-photo" title="'.$title_i.'">
						<img class="size-full" alt="'.$title_i.'" src="'.$image['src'].'" />
					</a>

					<p class="wp-caption-text">'.$title_i.'</p>
				</div>
				';


		return $return;
	}
?>