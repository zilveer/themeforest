<?php
function dropcap_func($atts, $content) {
	extract(shortcode_atts(array(
		'style' => 1
	), $atts));

	//get first char
	$first_char = substr($content, 0, 1);
	$text_len = strlen($content);
	$rest_text = substr($content, 1, $text_len);

	$return_html = '<span class="dropcap'.$style.'">'.$first_char.'</span>';
	$return_html.= do_shortcode($rest_text);
	$return_html.= '<br class="clear"/><br/>';

	return $return_html;

}
add_shortcode('dropcap', 'dropcap_func');


function quote_func($atts, $content) {
	$return_html = '<blockquote>'.do_shortcode($content).'</blockquote>';
	$return_html.= '<br class="clear"/>';

	return $return_html;
}
add_shortcode('quote', 'quote_func');


function pre_func($atts, $content) {
	$return_html = '<pre>'.strip_tags($content).'</pre>';

	return $return_html;
}
add_shortcode('pre', 'pre_func');


function tg_button_func($atts, $content) {
	extract(shortcode_atts(array(
		'href' => '',
		'align' => '',
		'bg_color' => '',
		'text_color' => '',
		'size' => 'small',
		'style' => '',
		'color' => '',
		'target' => '_self',
	), $atts));

	if(!empty($color))
	{
		switch(strtolower($color))
		{
			case 'black':
				$bg_color = '#000000';
				$text_color = '#ffffff';
			break;

			case 'grey':
				$bg_color = '#7F8C8D';
				$text_color = '#ffffff';
			break;

			case 'white':
				$bg_color = '#f5f5f5';
				$text_color = '#444444';
			break;

			case 'blue':
				$bg_color = '#3498DB';
				$text_color = '#ffffff';
			break;

			case 'yellow':
				$bg_color = '#F1C40F';
				$text_color = '#ffffff';
			break;

			case 'red':
				$bg_color = '#E74C3C';
				$text_color = '#ffffff';
			break;

			case 'orange':
				$bg_color = '#ff9900';
				$text_color = '#ffffff';
			break;

			case 'green':
				$bg_color = '#2ECC71';
				$text_color = '#ffffff';
			break;

			case 'pink':
				$bg_color = '#ed6280';
				$text_color = '#ffffff';
			break;

			case 'purple':
				$bg_color = '#9B59B6';
				$text_color = '#ffffff';
			break;
		}
	}
	
	if(!empty($bg_color))
	{
		$border_color = $bg_color;
	}
	else
	{
		$border_color = 'transparent';
	}
	
	//Get darker shadow color
	$shadow_color = '#'.hex_darker(substr($bg_color, 1), 12);
	
	if(!empty($bg_color))
	{
		$return_html = '<a class="button '.$size.' '.$align.'" style="background-color:'.$bg_color.' !important;color:'.$text_color.' !important;border:1px solid '.$bg_color.' !important;'.$style.'"';
	}
	else
	{
		$return_html = '<a class="button '.$size.' '.$align.'"';
	}
	
	if(!empty($href))
	{
		$return_html.= ' onclick="window.open(\''.$href.'\', \''.$target.'\')"';
	}

	$return_html.= '>'.$content.'</a>';

	return $return_html;

}
add_shortcode('tg_button', 'tg_button_func');


function tg_social_icons_func($atts, $content) {

	$return_html = '<div class="social_wrapper shortcode"><ul>';
	
	$pp_facebook_username = get_option('pp_facebook_username');		    		
	if(!empty($pp_facebook_username))
	{
		$return_html.='<li class="facebook"><a target="_blank" title="Facebook" href="http://facebook.com/'.$pp_facebook_username.'"><img src="'.get_template_directory_uri().'/images/social/facebook.png" alt=""/></a></li>';
	}
	
	$pp_twitter_username = get_option('pp_twitter_username');
	if(!empty($pp_twitter_username))
	{
		$return_html.='<li class="twitter"><a target="_blank" title="Twitter" href="http://twitter.com/'.$pp_twitter_username.'"><img src="'.get_template_directory_uri().'/images/social/twitter.png" alt=""/></a></li>';
	}
	
	$pp_flickr_username = get_option('pp_flickr_username');
		    		
	if(!empty($pp_flickr_username))
	{
		$return_html.='<li class="flickr"><a target="_blank" title="Flickr" href="http://flickr.com/people/'.$pp_flickr_username.'"><img src="'.get_template_directory_uri().'/images/social/flickr.png" alt=""/></a></li>';
	}
		    		
	$pp_youtube_username = get_option('pp_youtube_username');
	if(!empty($pp_youtube_username))
	{
		$return_html.='<li class="youtube"><a target="_blank" title="Youtube" href="http://youtube.com/user/'.$pp_youtube_username.'"><img src="'.get_template_directory_uri().'/images/social/youtube.png" alt=""/></a></li>';
	}

	$pp_vimeo_username = get_option('pp_vimeo_username');
	if(!empty($pp_vimeo_username))
	{
		$return_html.='<li class="vimeo"><a target="_blank" title="Vimeo" href="http://vimeo.com/'.$pp_vimeo_username.'"><img src="'.get_template_directory_uri().'/images/social/vimeo.png" alt=""/></a></li>';
	}

	$pp_tumblr_username = get_option('pp_tumblr_username');
	if(!empty($pp_tumblr_username))
	{
		$return_html.='<li class="tumblr"><a target="_blank" title="Tumblr" href="http://'.$pp_tumblr_username.'.tumblr.com"><img src="'.get_template_directory_uri().'/images/social/tumblr.png" alt=""/></a></li>';
	}
	
	$pp_google_username = get_option('pp_google_username');
		    		
	if(!empty($pp_google_username))
	{
		$return_html.='<li class="google"><a target="_blank" title="Google+" href="'.$pp_google_username.'"><img src="'.get_template_directory_uri().'/images/social/google.png" alt=""/></a></li>';
	}
		    		
	$pp_dribbble_username = get_option('pp_dribbble_username');
	if(!empty($pp_dribbble_username))
	{
		$return_html.='<li class="dribbble"><a target="_blank" title="Dribbble" href="http://dribbble.com/'.$pp_dribbble_username.'"><img src="'.get_template_directory_uri().'/images/social/dribbble.png" alt=""/></a></li>';
	}
	
	$pp_linkedin_username = get_option('pp_linkedin_username');
	if(!empty($pp_linkedin_username))
	{
		$return_html.='<li class="linkedin"><a target="_blank" title="Linkedin" href="'.$pp_linkedin_username.'"><img src="'.get_template_directory_uri().'/images/social/linkedin.png" alt=""/></a></li>';
	}
		            
	$pp_pinterest_username = get_option('pp_pinterest_username');
	if(!empty($pp_pinterest_username))
	{
		$return_html.='<li class="pinterest"><a target="_blank" title="Pinterest" href="http://pinterest.com/'.$pp_pinterest_username.'"><img src="'.get_template_directory_uri().'/images/social/pinterest.png" alt=""/></a></li>';
	}
		        	
	$pp_instagram_username = get_option('pp_instagram_username');
	if(!empty($pp_instagram_username))
	{
		$return_html.='<li class="instagram"><a target="_blank" title="Instagram" href="http://instagram.com/'.$pp_instagram_username.'"><img src="'.get_template_directory_uri().'/images/social/instagram.png" alt=""/></a></li>';
	}
	
	$return_html.= '</ul></div>';

	return $return_html;

}
add_shortcode('tg_social_icons', 'tg_social_icons_func');


function tg_social_share_func($atts, $content) {
	$return_html = '<div class="social_share_wrapper shortcode">';
	$return_html.='<h5>'.__( 'Share On', THEMEDOMAIN ).'</h5>';
	$return_html.='<ul>';
	$return_html.='<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.get_permalink().'"><i class="fa fa-facebook marginright"></i>'.__( 'Facebook', THEMEDOMAIN ).'</a></li>';
	$return_html.='<li><a target="_blank" href="https://twitter.com/intent/tweet?original_referer='.get_permalink().'&url='.get_permalink().'"><i class="fa fa-twitter marginright"></i>'.__( 'Twitter', THEMEDOMAIN ).'</a></li>';
	$return_html.='<li><a target="_blank" href="http://www.pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'"><i class="fa fa-pinterest marginright"></i>'.__( 'Pinterest', THEMEDOMAIN ).'</a></li>';
	$return_html.='<li><a target="_blank" href="https://plus.google.com/share?url='.get_permalink().'"><i class="fa fa-google-plus marginright"></i>'.__( 'Google+', THEMEDOMAIN ).'</a></li>';
	$return_html.='</ul>';
	$return_html.='</div>';

	return $return_html;
}
add_shortcode('tg_social_share', 'tg_social_share_func');


function highlight_func($atts, $content) {
	extract(shortcode_atts(array(
		'type' => 'yellow',
	), $atts));
	
	$return_html = '';
	$return_html.= '<span class="highlight_'.$type.'">'.strip_tags($content).'</span>';

	return $return_html;
}
add_shortcode('highlight', 'highlight_func');


function one_half_func($atts, $content) {
	extract(shortcode_atts(array(
		'class' => '',
	), $atts));

	$return_html = '<div class="one_half '.$class.'">'.do_shortcode($content).'</div>';	

	return $return_html;
}
add_shortcode('one_half', 'one_half_func');


function one_half_last_func($atts, $content) {
	extract(shortcode_atts(array(
		'class' => '',
	), $atts));

	$return_html = '<div class="one_half last '.$class.'">'.do_shortcode($content).'</div><br class="clear"/>';

	return $return_html;
}
add_shortcode('one_half_last', 'one_half_last_func');


function one_third_func($atts, $content) {
	$return_html = '<div class="one_third">'.do_shortcode($content).'</div>';

	return $return_html;
}
add_shortcode('one_third', 'one_third_func');


function one_third_last_func($atts, $content) {
	$return_html = '<div class="one_third last">'.do_shortcode($content).'</div><br class="clear"/>';

	return $return_html;
}
add_shortcode('one_third_last', 'one_third_last_func');


function two_third_func($atts, $content) {
	$return_html = '<div class="two_third">'.do_shortcode($content).'</div>';

	return $return_html;
}
add_shortcode('two_third', 'two_third_func');


function two_third_last_func($atts, $content) {
	$return_html = '<div class="two_third last">'.do_shortcode($content).'</div><br class="clear"/>';

	return $return_html;
}
add_shortcode('two_third_last', 'two_third_last_func');


function one_fourth_func($atts, $content) {
	$return_html = '<div class="one_fourth">'.do_shortcode($content).'</div>';

	return $return_html;
}
add_shortcode('one_fourth', 'one_fourth_func');


function one_fourth_last_func($atts, $content) {
	$return_html = '<div class="one_fourth last">'.do_shortcode($content).'</div><br class="clear"/>';

	return $return_html;
}
add_shortcode('one_fourth_last', 'one_fourth_last_func');


function one_fifth_func($atts, $content) {
	$return_html = '<div class="one_fifth">'.do_shortcode($content).'</div>';

	return $return_html;
}
add_shortcode('one_fifth', 'one_fifth_func');


function one_fifth_last_func($atts, $content) {
	$return_html = '<div class="one_fifth last">'.do_shortcode($content).'</div><br class="clear"/>';

	return $return_html;
}
add_shortcode('one_fifth_last', 'one_fifth_last_func');


function one_sixth_func($atts, $content) {
	$return_html = '<div class="one_sixth">'.do_shortcode($content).'</div>';

	return $return_html;
}
add_shortcode('one_sixth', 'one_sixth_func');


function one_sixth_last_func($atts, $content) {
	$return_html = '<div class="one_sixth last">'.do_shortcode($content).'</div><br class="clear"/>';

	return $return_html;
}
add_shortcode('one_sixth_last', 'one_sixth_last_func');


function tg_pre_func($atts, $content) {
	extract(shortcode_atts(array(
		'title' => '',
		'close' => 1,
	), $atts));
	
	$return_html = '';
	$return_html.= '<pre>';
	$return_html.= $content;
	$return_html.= '</pre>';

	return $return_html;
}
add_shortcode('tg_pre', 'tg_pre_func');


function tg_map_func($atts) {
	//extract short code attr
	extract(shortcode_atts(array(
		'width' => 400,
		'height' => 300,
		'lat' => 0,
		'long' => 0,
		'zoom' => 12,
		'type' => '',
		'popup' => '',
		'address' => '',
	), $atts));

	$custom_id = time().rand();
	$return_html = '<div class="map_shortcode_wrapper" id="map'.$custom_id.'" style="width:'.$width.'px;height:'.$height.'px"></div>';
	
	$ext_attr = array(
		'id' => 'map'.$custom_id,
		'lat' => $lat,
		'long' => $long,
		'zoom' => $zoom,
		'type' => $type,
		'popup' => $popup,
		'address' => $address,
	);
	
	$ext_attr_serialize = serialize($ext_attr);
	
	wp_enqueue_script("script-contact-map".$custom_id, get_stylesheet_directory_uri()."/templates/script-map-shortcode.php?data=".$ext_attr_serialize, false, THEMEVERSION, true);

	return $return_html;

}

add_shortcode('tg_map', 'tg_map_func');


function video_func($atts) {
	extract(shortcode_atts(array(
		'width' => 640,
		'height' => 385,
		'img_src' => '',
		'video_src' => '',
	), $atts));

	$custom_id = time().rand();

	$return_html = '<div id="video_self_'.$custom_id.'" style="width:'.$width.'px;height:'.$height.'px">';
	$return_html.= '<div id="self_hosted_vid_'.$custom_id.'"></div>';
	$return_html.= '<script type="text/javascript">';
	$return_html.= 'jwplayer("#self_hosted_vid_'.$custom_id.'").setup({';
	$return_html.= 'flashplayer: "'.get_template_directory_uri().'/js/player.swf",';
	$return_html.= 'file: "'.$video_src.'",';
	$return_html.= 'image: "'.$img_src.'",';
	$return_html.= 'width: '.$width.',';
	$return_html.= 'height: '.$height;
	$return_html.= '});';
	$return_html.= '</script>';
	$return_html.= '</div>';

	return $return_html;
}
add_shortcode('video', 'video_func');


function tg_thumb_gallery_func($atts, $content) {
	extract(shortcode_atts(array(
		'gallery_id' => '',
	), $atts));

	$images_arr = get_post_meta($gallery_id, 'wpsimplegallery_gallery', true);
	$return_html = '';

	if(!empty($images_arr))
	{
		foreach($images_arr as $key => $image)
		{
			$image_url = wp_get_attachment_image_src($image, 'original', true);
			$small_image_url = wp_get_attachment_image_src($image, 'thumbnail', true);
			
			$image_title = get_the_title($image);
		    $image_caption = get_post_field('post_excerpt', $image);
		    $image_desc = get_post_field('post_content', $image);
		    
		    $pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
    		$pp_social_sharing = get_option('pp_social_sharing');
			
			$return_html.= '<div class="post_img small square_thumb" style="float:left;margin-right:10px;margin-bottom:10px">';
			$return_html.= '<a rel="gallery" class="fancy-gallery" href="'.$image_url[0].'" ';
			
			if(!empty($pp_portfolio_enable_slideshow_title)) 
			{
				$return_html.= 'data-title="<strong>'.$image_title.'</strong> ';
			}
			if(!empty($image_desc)) 
			{
				$return_html.= htmlentities($image_desc);
			}
			if(!empty($pp_social_sharing)) 
			{
				$return_html.= '<br/><br/><br/><br/><a class=\'button\' href=\''.get_permalink($image).'\'>'.__( 'Comment & share', THEMEDOMAIN ).'</a>';
			}
			if(!empty($pp_portfolio_enable_slideshow_title)) 
			{
				$return_html.='"';
			}
			
			$return_html.= '>';
			$return_html.= '<img src="'.$small_image_url[0].'" alt=""/>';
			$return_html.=	'<div class="mask"><div class="mask_circle"><i class="fa fa-share"/></i></div></div>';
			$return_html.= '</a>';
			$return_html.= '</div>';
		}
	}
	else
	{
		$return_html.= 'Empty gallery item. Please make sure you have upload image to it or check the short code.';
	}

	$return_html.= '<br class="clear"/>';

	return $return_html;
}
add_shortcode('tg_thumb_gallery', 'tg_thumb_gallery_func');


function tg_masonry_gallery_func($atts, $content) {
	extract(shortcode_atts(array(
		'gallery_id' => '',
	), $atts));

	$images_arr = get_post_meta($gallery_id, 'wpsimplegallery_gallery', true);
	$return_html = '';
	$custom_id = time().rand();

	if(!empty($images_arr))
	{
		$return_html.= '<div id="'.$custom_id.'" class="photo_wall_wrapper shortcode" data-columns="4">';
		
		foreach($images_arr as $key => $image)
		{
			$image_url = wp_get_attachment_image_src($image, 'original', true);
			$small_image_url = wp_get_attachment_image_src($image, 'gallery_m_fh', true);
			
			$image_title = get_the_title($image);
			$image_desc = get_post_field('post_content', $image);
		    
		    $pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
    		$pp_social_sharing = get_option('pp_social_sharing');
			
			$return_html.= '<div class="wall_entry four_cols">';
			$return_html.= '<div class="wall_thumbnail dynamic_height gallery_type animated'.($key+1).'">';
			$return_html.= '<a rel="gallery" class="fancy-gallery" href="'.$image_url[0].'" ';
			
			if(!empty($pp_portfolio_enable_slideshow_title)) 
			{
				$return_html.= 'data-title="<strong>'.$image_title.'</strong> ';
			}
			if(!empty($image_desc)) 
			{
				$return_html.= htmlentities($image_desc);
			}
			if(!empty($pp_social_sharing)) 
			{
				$return_html.= '<br/><br/><br/><br/><a class=\'button\' href=\''.get_permalink($image).'\'>'.__( 'Comment & share', THEMEDOMAIN ).'</a>';
			}
			if(!empty($pp_portfolio_enable_slideshow_title)) 
			{
				$return_html.='"';
			}
			
			$return_html.= '>';
			$return_html.= '<img src="'.$small_image_url[0].'" alt=""/>';
			$return_html.= '<div class="thumb_content"><h4>'.$image_title.'</h4></div>';
			$return_html.= '</a>';
			$return_html.= '</div>';
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	else
	{
		$return_html.= 'Empty gallery item. Please make sure you have upload image to it or check the short code.';
	}

	$return_html.= '<br class="clear"/>';
	wp_enqueue_script("script-portfolio-shortcode-".$custom_id, get_template_directory_uri()."/templates/script-gallery-shortcode.php?id=".$custom_id, false, THEMEVERSION, true);

	return $return_html;
}
add_shortcode('tg_masonry_gallery', 'tg_masonry_gallery_func');


function tg_image_func($atts, $content) {
	extract(shortcode_atts(array(
		'src' => '',
		'animation' => '',
		'style' => '',
	), $atts));

	$return_html = '<img src="'.$src.'" alt="" class="animated" data-animation="'.$animation.'" style="'.$style.'" />';

	return $return_html;

}
add_shortcode('tg_image', 'tg_image_func');


function tg_grid_portfolio_func($atts, $content) {
	extract(shortcode_atts(array(
		'columns' => '3',
		'items' => '-1',
		'cat' => '',
	), $atts));

	//Get portfolios items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('portfolios'),
	    'suppress_filters' => 0,
	);

	if(!empty($cat))
	{
		$args['portfoliosets'] = $cat;
	}
	
	$portfolios_arr = get_posts($args);
	
	$columns_class = 'three_cols';
	switch($columns)
	{
		case 2:
			$columns_class = 'two_cols';
		break;
		
		case 3:
		default:
			$columns_class = 'three_cols';
			$columns = 3;
		break;
		
		case 4:
			$columns_class = 'four_cols';
		break;
	}
	
	$return_html = '';
	$custom_id = time().rand();

	if(!empty($portfolios_arr))
	{
		$return_html.= '<div id="'.$custom_id.'" class="photo_wall_wrapper shortcode" data-columns="'.$columns.'">';
		
		foreach($portfolios_arr as $key => $portoflio_item)
		{
			$image_url = '';
	    	$portfolio_ID = $portoflio_item->ID;
	    			
	    	if(has_post_thumbnail($portfolio_ID, 'original'))
	    	{
	    	    $image_id = get_post_thumbnail_id($portfolio_ID);
	    	    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
	    	    
	    	    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_m_fh', true);
	    	}
	    	
	    	$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
	    	
	    	if(empty($portfolio_link_url))
	    	{
	    	    $permalink_url = get_permalink($portfolio_ID);
	    	}
	    	else
	    	{
	    	    $permalink_url = $portfolio_link_url;
	    	}
	    	
	    	$last_class = '';
	    	if(($key)%3==0)
	    	{
	    		$last_class = 'last';
	    	}
	    	
	    	$return_html.= '<div class="wall_entry '.$columns_class.'">';
	    	
	    	if(!empty($image_url[0]))
			{
				$return_html.= '<div class="wall_thumbnail dynamic_height gallery_type animated'.($key+1).'">';
				
		    	$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
		    	$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
		    		
		    	switch($portfolio_type)
		    	{
		    		case 'External Link':
		    			$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
		    	
				    	$return_html.= '<a target="_blank" href="'.$portfolio_link_url.'">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
	
				        $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
		    	
		    		break;
		    		//end external link
		    		
		    		case 'Portfolio Content':
	        		default:

						$return_html.= '<a href="'.get_permalink($portfolio_ID).'">
			        		<img src="'.$small_image_url[0].'" alt="" />
			        	';
		    	
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
		        
		    		break;
		    		//end external link
		    		
		    		case 'Fullscreen Vimeo Video':
	        		case 'Fullscreen Youtube Video':
	        		case 'Fullscreen Self-Hosted Video':

			        	$return_html.= '<a href="'.get_permalink($portfolio_ID).'">
			        		<img src="'.$small_image_url[0].'" alt="" />
			        	';
		    	
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
		        
	        		break;
	        		//end fullscreen video Content
	        		
	        		case 'Image':
		    	
				    	$return_html.= '<a data-title="<strong>'.$portoflio_item->post_title.'</strong>'.htmlentities($portoflio_item->post_content).'" href="'.$image_url[0].'" class="fancy-gallery">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
			    	
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
		    	
		    		break;
		    		//end image
		    		
		    		case 'Youtube Video':
		    	
				    	$return_html.= '<a title="'.$portoflio_item->post_title.'" href="#video_'.$portfolio_video_id.'" class="lightbox_youtube">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
			    	
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
			    		
				    	$return_html.= '<div style="display:none;">
				    	    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:488px" class="video-container">
				    	        
				    	        <iframe title="YouTube video player" width="900" height="488" src="http://www.youtube.com/embed/'.$portfolio_video_id.'?theme=dark&amp;rel=0&amp;wmode=transparent" allowfullscreen></iframe>
				    	        
				    	    </div>	
				    	</div>';
		    	
		    		break;
		    		//end youtube
		    	
			    	case 'Vimeo Video':
				    	$return_html.= '<a title="'.$portoflio_item->post_title.'" href="#video_'.$portfolio_video_id.'" class="lightbox_vimeo">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
			
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
				    		
				    	$return_html.= '<div style="display:none;">
				    	    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:506px" class="video-container">
				    	    
				    	        <iframe src="http://player.vimeo.com/video/'.$portfolio_video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506"></iframe>
				    	        
				    	    </div>	
				    	</div>';
			    	
			    	break;
			    	//end vimeo
			    		
			    	case 'Self-Hosted Video':
			    	
			    		//Get video URL
			    		$portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
			    		$preview_image = wp_get_attachment_image_src($image_id, 'large', true);

				    	$return_html.= '<a title="'.$portoflio_item->post_title.'" href="#video_self_'.$key.'" class="lightbox_vimeo">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
			
				    	$return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'></h4>
				    	</div>
				    	</a>';
				    		
				    	$return_html.= '<div style="display:none;">
				    	    <div id="video_self_'.$key.'" style="width:900px;height:488px" class="video-container">
				    	    
				    	        <div id="self_hosted_vid_'.$key.'"></div>';
				    	$return_html.= do_shortcode('[jwplayer id="self_hosted_vid_'.$key.'" file="'.$portfolio_mp4_url.'" image="'.$preview_image[0].'" width="900" height="488"]');
			    	        
			    	    $return_html.= '</div></div>';
			    	
			    		break;
			    		//end self-hosted
			    	}
			    	//end switch
				
				$return_html.= '</div>';
			}
	    	
	    	$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	else
	{
		$return_html.= 'Empty portfolio item. Please make sure you have created portfolio item or check the short code.';
	}

	$return_html.= '<br class="clear"/>';
	wp_enqueue_script("script-portfolio-shortcode-".$custom_id, get_template_directory_uri()."/templates/script-portfolio-shortcode.php?id=".$custom_id, false, THEMEVERSION, true);

	return $return_html;
}
add_shortcode('tg_grid_portfolio', 'tg_grid_portfolio_func');


function tg_filter_portfolio_func($atts, $content) {
	extract(shortcode_atts(array(
		'columns' => '3',
		'items' => '-1',
		'cat' => '',
	), $atts));

	//Get portfolios items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('portfolios'),
	    'suppress_filters' => 0,
	);

	if(!empty($cat))
	{
		$args['portfoliosets'] = $cat;
	}
	
	$portfolios_arr = get_posts($args);
	
	$columns_class = 'three_cols';
	switch($columns)
	{
		case 2:
			$columns_class = 'two_cols';
		break;
		
		case 3:
		default:
			$columns_class = 'three_cols';
			$columns = 3;
		break;
		
		case 4:
			$columns_class = 'four_cols';
		break;
	}
	
	$return_html = '';
	
	//Get all sets and sorting option
	$pp_portfolio_set_sort = get_option('pp_portfolio_set_sort');
	
	$sets_arr = get_terms('portfoliosets', 'hide_empty=0&hierarchical=0&parent=0&orderby='.$pp_portfolio_set_sort);
	
	//Random portfolio wrapper ID
	$portfolio_wrapper_id = rand().time();
	    
	if(!empty($sets_arr) && empty($term))
	{
	    $return_html.= '<ul class="portfolio_filters portfolio-main filter shortcode"> 
	    	<li class="all-projects active">
	    		<a data-target="'.$portfolio_wrapper_id.'" class="active" href="javascript:;" data-filter="*">'.__( 'All', THEMEDOMAIN ).'</a>
	    		<span class="separator">/</span>
	    	</li>';
	    	
	    	foreach($sets_arr as $key => $set_item)
	    	{
		    	$return_html.= '<li class="cat-item '.$set_item->slug.'" data-type="'.$set_item->slug.'" style="clear:none">
		    		<a data-target="'.$portfolio_wrapper_id.'" data-filter=".'.$set_item->slug.'" href="javascript:;" title="'.$set_item->name.'">'.$set_item->name.'</a>
		    		<span class="separator">/</span>
		    	</li>';
	    	}
	    $return_html.= '</ul><br class="clear"/>';
	}

	if(!empty($portfolios_arr))
	{
		$return_html.= '<div id="'.$portfolio_wrapper_id.'" class="photo_wall_wrapper shortcode" data-columns="'.$columns.'">';
		
		foreach($portfolios_arr as $key => $portoflio_item)
		{
			$image_url = '';
	    	$portfolio_ID = $portoflio_item->ID;
	    			
	    	if(has_post_thumbnail($portfolio_ID, 'original'))
	    	{
	    	    $image_id = get_post_thumbnail_id($portfolio_ID);
	    	    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
	    	    
	    	    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_m_fh', true);
	    	}
	    	
	    	$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
	    	
	    	if(empty($portfolio_link_url))
	    	{
	    	    $permalink_url = get_permalink($portfolio_ID);
	    	}
	    	else
	    	{
	    	    $permalink_url = $portfolio_link_url;
	    	}
	    	
	    	$last_class = '';
	    	if(($key)%3==0)
	    	{
	    		$last_class = 'last';
	    	}
	    	
	    	$portfolio_item_set = '';
	    	$portfolio_item_sets = wp_get_object_terms($portfolio_ID, 'portfoliosets');
	    	
	    	if(is_array($portfolio_item_sets))
	    	{
	    	    foreach($portfolio_item_sets as $set)
	    	    {
	    	    	$portfolio_item_set.= $set->slug.' ';
	    	    }
	    	}
	    	
	    	$return_html.= '<div class="wall_entry '.$columns_class.' '.$portfolio_item_set.'">';
	    	
	    	if(!empty($image_url[0]))
			{
				$return_html.= '<div class="wall_thumbnail dynamic_height gallery_type animated'.($key+1).'">';
				
		    	$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
		    	$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
		    		
		    	switch($portfolio_type)
		    	{
		    		case 'External Link':
		    			$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
		    	
				    	$return_html.= '<a target="_blank" href="'.$portfolio_link_url.'">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
	
				        $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
		    	
		    		break;
		    		//end external link
		    		
		    		case 'Portfolio Content':
	        		default:

						$return_html.= '<a href="'.get_permalink($portfolio_ID).'">
			        		<img src="'.$small_image_url[0].'" alt="" />
			        	';
		    	
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
		        
		    		break;
		    		//end external link
		    		
		    		case 'Fullscreen Vimeo Video':
	        		case 'Fullscreen Youtube Video':
	        		case 'Fullscreen Self-Hosted Video':

			        	$return_html.= '<a href="'.get_permalink($portfolio_ID).'">
			        		<img src="'.$small_image_url[0].'" alt="" />
			        	';
		    	
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
		        
	        		break;
	        		//end fullscreen video Content
	        		
	        		case 'Image':
		    	
				    	$return_html.= '<a data-title="<strong>'.$portoflio_item->post_title.'</strong>'.htmlentities($portoflio_item->post_content).'" href="'.$image_url[0].'" class="fancy-gallery">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
			    	
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
		    	
		    		break;
		    		//end image
		    		
		    		case 'Youtube Video':
		    	
				    	$return_html.= '<a title="'.$portoflio_item->post_title.'" href="#video_'.$portfolio_video_id.'" class="lightbox_youtube">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
			    	
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
			    		
				    	$return_html.= '<div style="display:none;">
				    	    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:488px" class="video-container">
				    	        
				    	        <iframe title="YouTube video player" width="900" height="488" src="http://www.youtube.com/embed/'.$portfolio_video_id.'?theme=dark&amp;rel=0&amp;wmode=transparent" allowfullscreen></iframe>
				    	        
				    	    </div>	
				    	</div>';
		    	
		    		break;
		    		//end youtube
		    	
			    	case 'Vimeo Video':
				    	$return_html.= '<a title="'.$portoflio_item->post_title.'" href="#video_'.$portfolio_video_id.'" class="lightbox_vimeo">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
			
			            $return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'</h4>
				    	</div>
				    	</a>';
				    		
				    	$return_html.= '<div style="display:none;">
				    	    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:506px" class="video-container">
				    	    
				    	        <iframe src="http://player.vimeo.com/video/'.$portfolio_video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506"></iframe>
				    	        
				    	    </div>	
				    	</div>';
			    	
			    	break;
			    	//end vimeo
			    		
			    	case 'Self-Hosted Video':
			    	
			    		//Get video URL
			    		$portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
			    		$preview_image = wp_get_attachment_image_src($image_id, 'large', true);

				    	$return_html.= '<a title="'.$portoflio_item->post_title.'" href="#video_self_'.$key.'" class="lightbox_vimeo">
				    		<img src="'.$small_image_url[0].'" alt="" />
				    	';
			
				    	$return_html.= '<div class="thumb_content">
				    	    <h4>'.$portoflio_item->post_title.'></h4>
				    	</div>
				    	</a>';
				    		
				    	$return_html.= '<div style="display:none;">
				    	    <div id="video_self_'.$key.'" style="width:900px;height:488px" class="video-container">
				    	    
				    	        <div id="self_hosted_vid_'.$key.'"></div>';
				    	$return_html.= do_shortcode('[jwplayer id="self_hosted_vid_'.$key.'" file="'.$portfolio_mp4_url.'" image="'.$preview_image[0].'" width="900" height="488"]');
			    	        
			    	    $return_html.= '</div></div>';
			    	
			    		break;
			    		//end self-hosted
			    	}
			    	//end switch
				
				$return_html.= '</div>';
			}
	    	
	    	$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	else
	{
		$return_html.= 'Empty portfolio item. Please make sure you have created portfolio item or check the short code.';
	}

	$return_html.= '<br class="clear"/>';
	wp_enqueue_script("script-portfolio-shortcode-".$portfolio_wrapper_id, get_template_directory_uri()."/templates/script-portfolio-shortcode.php?id=".$portfolio_wrapper_id, false, THEMEVERSION, true);

	return $return_html;
}
add_shortcode('tg_filter_portfolio', 'tg_filter_portfolio_func');


function tg_promo_box_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'border' => '',
		'shadow' => '',
		'button_text' => '',
		'button_url' => '',
	), $atts));
	
	$return_html = '<div class="promo_box ';
	if(!empty($shadow))
	{
		$return_html.= 'shadow';
	}
	$return_html.= '" ';
	if(!empty($border))
	{
		$return_html.= 'style="border-top:2px solid '.$border.'"';
	}
	$return_html.= '>';
	if(!empty($button_text))
	{
		$return_html.= '<a href="'.$button_url.'" class="button">'.$button_text.'</a>';
	}
	if(!empty($title))
	{
		$return_html.= '<h5>'.$title.'</h5>';
	}
	$return_html.= $content;
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('tg_promo_box', 'tg_promo_box_func');


function tg_alert_box_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'style' => 'general',
	), $atts));
	
	$fa_class = 'fa-bullhorn';
	switch($style)
	{
		case 'error':
			$fa_class = 'fa-exclamation-circle';
		break;
		
		case 'success':
			$fa_class = 'fa-flag';
		break;
		
		case 'notice':
			$fa_class = 'fa-info-circle';
		break;
	}
	
	$custom_id = time().rand();
	
	$return_html = '<div id="'.$custom_id.'" class="alert_box '.$style.'">';
	$return_html.= '<i class="fa '.$fa_class.' alert_icon"></i>';
	$return_html.= '<div class="alert_box_msg">'.do_shortcode($content).'</div>';
	$return_html.= '<a href="#" class="close_alert" data-target="'.$custom_id.'"><i class="fa fa-times"></i></a>';
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('tg_alert_box', 'tg_alert_box_func');


function tg_tab_func($atts, $content) {
	//extract short code attr
	extract(shortcode_atts(array(
		'tab1' => '',
		'tab2' => '',
		'tab3' => '',
		'tab4' => '',
		'tab5' => '',
		'tab6' => '',
		'tab7' => '',
		'tab8' => '',
		'tab9' => '',
		'tab10' => '',
	), $atts));
	
	$tab_arr = array(
		$tab1,
		$tab2,
		$tab3,
		$tab4,
		$tab5,
		$tab6,
		$tab7,
		$tab8,
		$tab9,
		$tab10,
	);

	//Add jquery ui script dynamically
	wp_enqueue_script("jquery-ui-core");
	wp_enqueue_script("jquery-ui-tabs");
	wp_enqueue_script('custom-tab', get_stylesheet_directory_uri()."/js/custom-tab.js", false, THEMEVERSION, true);

	$return_html = '<div class="tabs"><ul>';

	foreach($tab_arr as $key=>$tab)
	{
		//display title1
		if(!empty($tab))
		{
			$return_html.= '<li><a href="#tabs-'.($key+1).'">'.$tab.'</a></li>';
		}
	}

	$return_html.= '</ul>';
	$return_html.= do_shortcode($content);
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('tg_tab', 'tg_tab_func');


function tg_ver_tab_func($atts, $content) {
	//extract short code attr
	extract(shortcode_atts(array(
		'tab1' => '',
		'tab2' => '',
		'tab3' => '',
		'tab4' => '',
		'tab5' => '',
		'tab6' => '',
		'tab7' => '',
		'tab8' => '',
		'tab9' => '',
		'tab10' => '',
		'align' => 'left',
	), $atts));
	
	$tab_arr = array(
		$tab1,
		$tab2,
		$tab3,
		$tab4,
		$tab5,
		$tab6,
		$tab7,
		$tab8,
		$tab9,
		$tab10,
	);

	//Add jquery ui script dynamically
	wp_enqueue_script("jquery-ui-core");
	wp_enqueue_script("jquery-ui-tabs");
	wp_enqueue_script('custom-tab', get_stylesheet_directory_uri()."/js/custom-tab.js", false, THEMEVERSION, true);

	$return_html = '<div class="tabs vertical '.$align.'"><ul>';

	foreach($tab_arr as $key=>$tab)
	{
		//display title1
		if(!empty($tab))
		{
			$return_html.= '<li><a href="#tabs-'.($key+1).'">'.$tab.'</a></li>';
		}
	}

	$return_html.= '</ul>';
	$return_html.= do_shortcode($content);
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('tg_ver_tab', 'tg_ver_tab_func');


function tab_func($atts, $content) {
	//extract short code attr
	extract(shortcode_atts(array(
		'id' => '',
	), $atts));
	
	$return_html = '';
	$return_html.= '<div id="tabs-'.$id.'" class="tab_wrapper"><br class="clear"/>'.do_shortcode($content).'</div>';

	return $return_html;

}

add_shortcode('tab', 'tab_func');


function tg_accordion_func($atts, $content) {
	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'close' => 0,
	), $atts));

	$close_class = '';

	if(!empty($close))
	{
		$close_class = 'pp_accordion_close';
	}
	else
	{
		$close_class = 'pp_accordion';
	}

	//Add jquery ui script dynamically
	wp_enqueue_script("jquery-ui-core");
	wp_enqueue_script("jquery-ui-accordion");
	wp_enqueue_script('custom-accordion', get_stylesheet_directory_uri()."/js/custom-accordion.js", false, THEMEVERSION, true);

	$return_html = '<div class="'.$close_class.'"><h3><a href="#">'.$title.'</a></h3>';
	$return_html.= '<div><p>';
	$return_html.= do_shortcode($content);
	$return_html.= '</p></div></div>';

	return $return_html;
}

add_shortcode('tg_accordion', 'tg_accordion_func');


function tg_service_list_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'items' => 3,
		'category' => '',
		'align' => 'left',
	), $atts));

	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$return_html = '';
	
	$service_order = 'ASC';
	$service_order_by = 'menu_order';
	
	//Get service items
	$args = array(
	    'numberposts' => $items,
	    'order' => $service_order,
	    'orderby' => $service_order_by,
	    'post_type' => array('services'),
	);
	
	if(!empty($category))
	{
		$args['servicecats'] = $category;
	}
	$services_arr = get_posts($args);

	if(!empty($services_arr) && is_array($services_arr))
	{
		$return_html.= '<ul class="icon_list">';
	
		foreach($services_arr as $key => $service)
		{
			
			$return_html.= '<li>';
			
			$image_url = '';
			$service_ID = $service->ID;
					
			//check if use font awesome
			$service_icon_code ='';
			$service_font_awesome = get_post_meta($service_ID, 'service_font_awesome', true);
					
			if(!empty($service_font_awesome))
			{
				$service_icon_code = get_post_meta($service_ID, 'service_font_awesome_code', true);
			}
			else
			{
				if(has_post_thumbnail($service_ID, 'large'))
				{
				    $image_id = get_post_thumbnail_id($service_ID);
				    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
				    $service_icon_code = '<img src="'.$image_url[0].'" alt="" />';
				}
			}
			
			if(!empty($service_icon_code))
			{
				$return_html.= '<div class="animated service_icon '.$align.'" data-animation="bigEntrance">'.$service_icon_code.'</div>';
			}
			
			$return_html.= '<div class="service_wrapper '.$align.'">';
			
			$return_html.= '<div class="service_title">';
			$return_html.= '<strong>'.$service->post_title.'</strong>';
			$return_html.= '</div>';
			
			$return_html.= '<div class="service_content">'.$service->post_content.'</div>';
			
			$return_html.= '</div>';
			
			$return_html.= '</li>';
		}
		
		$return_html.= '</ul>';
	}
	
	return $return_html;
}

add_shortcode('tg_service_list', 'tg_service_list_func');


function tg_divider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'style' => 'normal'
	), $atts));

	$return_html = '<hr class="'.$style.'"/>';
	if($style == 'totop')
	{
		$return_html.= '<a class="hr_totop" href="#">'.__( 'Go to top', THEMEDOMAIN ).'&nbsp;<i class="fa fa-arrow-up"></i></a>';
	}

	return $return_html;

}

add_shortcode('tg_divider', 'tg_divider_func');


function tg_team_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'columns' => 3,
		'items' => 4,
		'cat' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	if(!is_numeric($columns))
	{
		$columns = 3;
	}
	
	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$return_html ='<div>';
	
	$portfolio_order = 'ASC';
	$portfolio_order_by = 'menu_order';
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	
	switch($columns)
	{	
		case 2:
			$count_column = 2;
			$columns_class = 'one_half';
		break;
		
		case 3:
		default:
			$count_column = 3;
			$columns_class = 'one_third';
		break;
		
		case 4:
			$count_column = 4;
			$columns_class = 'one_fourth';
		break;
	}
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'order' => $portfolio_order,
	    'orderby' => $portfolio_order_by,
	    'post_type' => array('team'),
	);
	
	if(!empty($cat))
	{
		$args['teamcats'] = $cat;
	}
	$team_arr = get_posts($args);
	
	if(!empty($team_arr) && is_array($team_arr))
	{
		$return_html.= '<div class="team_wrapper">';
	
		foreach($team_arr as $key => $member)
		{
			$image_url = '';
			$member_ID = $member->ID;
					
			if(has_post_thumbnail($member_ID, 'team_member'))
			{
			    $image_id = get_post_thumbnail_id($member_ID);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'team_member', true);
			}
			
			$last_class = '';
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			
			//Begin display HTML
			$return_html.= '<div class="'.$columns_class.' animated'.($key+1).' '.$last_class.'">';
			
			if(!empty($small_image_url[0]))
			{
				$return_html.= '<div class="post_img animate ';
				
				$member_facebook = get_post_meta($member_ID, 'member_facebook', true);
			    $member_twitter = get_post_meta($member_ID, 'member_twitter', true);
			    $member_google = get_post_meta($member_ID, 'member_google', true);
			    $member_linkedin = get_post_meta($member_ID, 'member_linkedin', true);
				
				if(empty($member_facebook) && empty($member_twitter) && empty($member_google) && empty($member_linkedin))
				{
					$return_html.= 'static';
				}
				
				$return_html.='" style="margin-bottom:10px"><img class="team_pic" src="'.$small_image_url[0].'" alt=""/>';
				
				if(!empty($member_facebook) OR !empty($member_twitter) OR !empty($member_google) OR !empty($member_linkedin))
				{
					$return_html.= '<div class="thumb_content">';
					$return_html.= '<div class="social_follow">'.__( 'Follow', THEMEDOMAIN ).'</div><ul class="social_wrapper team">';
					
					if(!empty($member_twitter))
					{
					    $return_html.= '<li><a title="Twitter" target="_blank" class="tipsy" href="http://twitter.com/'.$member_twitter.'"><img src="'. get_stylesheet_directory_uri().'/images/social/twitter.png" alt=""/></a></li>';
					}
	 
					if(!empty($member_facebook))
					{
					    $return_html.= '<li><a title="Facebook" target="_blank" class="tipsy" href="http://facebook.com/'.$member_facebook.'"><img src="'. get_stylesheet_directory_uri().'/images/social/facebook.png" alt=""/></a></li>';
					}
					
					if(!empty($member_google))
					{
					    $return_html.= '<li><a title="Google+" target="_blank" class="tipsy" href="'.$member_google.'"><img src="'.get_stylesheet_directory_uri().'/images/social/google.png" alt=""/></a></li>';
					}
					    
					if(!empty($member_linkedin))
					{
					    $return_html.= '<li><a title="Linkedin" target="_blank" class="tipsy" href="'.$member_linkedin.'"><img src="'. get_stylesheet_directory_uri().'/images/social/linkedin.png" alt=""/></a></li>';
					}
					
					$return_html.= '</ul>';
					$return_html.= '</div>';
				}
				
				$return_html.= '</div>';
			    
			}
			
			$team_position = get_post_meta($member_ID, 'team_position', true);
			
			//Display portfolio detail
			$return_html.= '<br class="clear"/><div id="portfolio_desc_'.$member_ID.'" class="portfolio_desc portfolio3 '.$last_class.'">';
            $return_html.= '<h5>'.$member->post_title.'</h5>';
            if(!empty($team_position))
            {
            	$return_html.= '<span class="portfolio_excerpt">'.$team_position.'</span>';
            }
            if(!empty($member->post_content))
            {
            	$return_html.= '<p>'.$member->post_content.'</p>';
            }
			$return_html.= '</div>';
			$return_html.= '</div>';
			
			if(($key+1)%$count_column==0)
			{
				$return_html.= '<br class="clear"/>';
			}
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('tg_team', 'tg_team_func');


function tg_client_func($atts, $content) {
	extract(shortcode_atts(array(
		'columns' => '3',
		'items' => '-1',
		'cat' => '',
	), $atts));

	//Get portfolios items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('clients'),
	);

	if(!empty($cat))
	{
		$args['clientcats'] = $cat;
	}
	
	$clients_arr = get_posts($args);
	
	$columns_class = 'three_cols';
	switch($columns)
	{
		case 2:
			$columns_class = 'two_cols';
		break;
		
		case 3:
		default:
			$columns_class = 'three_cols';
			$columns = 3;
		break;
		
		case 4:
			$columns_class = 'four_cols';
		break;
	}
	
	$return_html = '';
	$custom_id = time().rand();

	if(!empty($clients_arr))
	{
		$return_html.= '<div id="'.$custom_id.'" class="photo_wall_wrapper shortcode" data-columns="'.$columns.'">';
		
		foreach($clients_arr as $key => $client_item)
		{
			$image_url = '';
	    	$client_ID = $client_item->ID;
	    			
	    	if(has_post_thumbnail($client_ID, 'original'))
	    	{
	    	    $image_id = get_post_thumbnail_id($client_ID);
	    	    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
	    	    $small_image_url = wp_get_attachment_image_src($image_id, 'original', true);
	    	}
	    	
	    	$last_class = '';
	    	if(($key)%3==0)
	    	{
	    		$last_class = 'last';
	    	}
	    	
	    	$return_html.= '<div class="wall_entry '.$columns_class.'">';
	    	
	    	if(!empty($image_url[0]))
			{
				$return_html.= '<div class="dynamic_height gallery_type animated'.($key+1).'">';
				
				$client_website_url = get_post_meta($client_item->ID, 'client_website_url', true);
	    		if(empty($client_website_url))
	    		{
		    		$client_website_url = '#';
	    		}
				
				$return_html.= '<a href="'.$client_website_url.'" ';
				
	    	    if(!empty($client_item->post_content))
	    	    {
		    	    $return_html.= 'class="client_content" title="'.$client_item->post_content.'"';
	    	    }
		    	$return_html.= '><img src="'.$small_image_url[0].'" alt="" /></a>';
				$return_html.= '</div>';
			}
	    	
	    	$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	else
	{
		$return_html.= 'Empty portfolio item. Please make sure you have created portfolio item or check the short code.';
	}

	$return_html.= '<br class="clear"/>';
	
	wp_enqueue_style("tipsy-css", get_template_directory_uri()."/css/tipsy.css", false, THEMEVERSION, "all");
	wp_enqueue_script("tipsy-js", get_template_directory_uri()."/js/jquery.tipsy.js", false, THEMEVERSION, true);
	wp_enqueue_script("script-client-shortcode-".$custom_id, get_template_directory_uri()."/templates/script-client-shortcode.php?id=".$custom_id, false, THEMEVERSION, true);

	return $return_html;
}
add_shortcode('tg_client', 'tg_client_func');


function tg_lightbox_func($atts, $content) {

	extract(shortcode_atts(array(
		'type' => 'image',
		'src' => '',
		'href' => '',
		'youtube_id' => '',
		'vimeo_id' => '',
	), $atts));

	$class = 'lightbox';

	if($type != 'image')
	{
		$class.= '_'.$type;
	}

	if($type == 'youtube')
	{
		$href = '#video_'.$youtube_id;
	}

	if($type == 'vimeo')
	{
		$href = '#video_'.$vimeo_id;
	}
	
	$return_html = '<div class="post_img">';
	$return_html.= '<a href="'.$href.'" class="img_frame">';
	
	if(!empty($src))
	{
		$return_html.= '<img src="'.$src.'"img_frame"/>';
	}

	if(!empty($youtube_id))
	{
		$return_html.= '<div style="display:none;"><div id="video_'.$youtube_id.'" style="width:900px;height:488px;overflow:hidden;" class="video-container"><iframe width="900" height="488" src="http://www.youtube.com/embed/'.$youtube_id.'?theme=dark&amp;rel=0&amp;wmode=opaque" frameborder="0"></iframe></div></div>';
	}

	if(!empty($vimeo_id))
	{
		$return_html.= '<div style="display:none;"><div id="video_'.$vimeo_id.'" style="width:900px;height:506px;overflow:hidden;" class="video-container"><iframe src="http://player.vimeo.com/video/'.$vimeo_id.'?title=0&amp;byline=0&amp;portrait=0" width="900" height="506" frameborder="0"></iframe></div></div>';
	}
	
	$return_html.= '</a></div>';

	return $return_html;

}

add_shortcode('tg_lightbox', 'tg_lightbox_func');


function tg_youtube_func($atts) {
	extract(shortcode_atts(array(
		'width' => 640,
		'height' => 385,
		'video_id' => '',
	), $atts));

	$custom_id = time().rand();

	$return_html = '<div class="video-container"><iframe title="YouTube video player" width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe></div>';

	return $return_html;
}

add_shortcode('tg_youtube', 'tg_youtube_func');


function tg_vimeo_func($atts, $content) {
	extract(shortcode_atts(array(
		'width' => 640,
		'height' => 385,
		'video_id' => '',
	), $atts));

	$custom_id = time().rand();

	$return_html = '<div class="video-container"><iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe></div>';

	return $return_html;
}

add_shortcode('tg_vimeo', 'tg_vimeo_func');

function tg_animate_counter_func($atts, $content) {
	extract(shortcode_atts(array(
		'start' => 0,
		'end' => 100,
		'fontsize' => 60,
	), $atts));

	$custom_id = time().rand();

	wp_enqueue_style("odometer-theme", get_template_directory_uri()."/css/odometer-theme-minimal.css", false, THEMEVERSION, "all");
	wp_enqueue_script("odometer-js", get_template_directory_uri()."/js/odometer.min.js", false, THEMEVERSION, true);
	wp_enqueue_script("script-animate-counter".$custom_id, get_template_directory_uri()."/templates/script-animate-counter-shortcode.php?id=".$custom_id."&start=".$start."&end=".$end."&fontsize=".$fontsize, false, THEMEVERSION, true);
	
	$return_html = '<div class="animate_counter_wrapper">';
	$return_html.= '<div id="'.$custom_id.'" class="odometer" style="font-size:'.$fontsize.'px;line-height:'.$fontsize.'px">'.$start.'</div>';
	$return_html.= '<div class="counter_subject">'.$content.'</div>';
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('tg_animate_counter', 'tg_animate_counter_func');


function tg_animate_bar_func($atts, $content) {
	extract(shortcode_atts(array(
		'percent' => 0,
		'color' => '',
	), $atts));
	
	if($percent < 0)
	{
		$percent = 0;
	}
	
	if($percent > 100)
	{
		$percent = 100;
	}
	
	$return_html = '<div class="progress_bar">';
	$return_html.= '<div class="progress_bar_content" data-score="'.$percent.'" style="width:0;background:'.$color.'">';
	$return_html.= '<div class="progress_bar_title">'.$content.'</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;
}

add_shortcode('tg_animate_bar', 'tg_animate_bar_func');


function tg_pricing_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'items' => 3,
		'category' => '',
		'columns' => '3',
	), $atts));

	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$return_html = '';
	
	$pricing_order = 'ASC';
	$pricing_order_by = 'menu_order';
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'order' => $pricing_order,
	    'orderby' => $pricing_order_by,
	    'post_type' => array('pricing'),
	);
	
	if(!empty($category))
	{
		$args['pricingcats'] = $category;
	}
	$pricing_arr = get_posts($args);
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	
	switch($columns)
	{
		case 2:
			$count_column = 2;
			$columns_class = 'one_half';
		break;
		
		case 3:
		default:
			$count_column = 3;
			$columns_class = 'one_third';
		break;
		
		case 4:
			$count_column = 4;
			$columns_class = 'one_fourth';
		break;
	}

	if(!empty($pricing_arr) && is_array($pricing_arr))
	{
		$return_html.= '<div class="pricing_content_wrapper">';
		$last_class = '';
	
		foreach($pricing_arr as $key => $pricing)
		{
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			else
			{
				$last_class = '';
			}
			
			$return_html.= '<div class="pricing '.$columns_class.' '.$last_class.'">';
			$return_html.= '<ul class="pricing_wrapper">';
			
			//Check if featured
			$priing_featured_class = '';
			$priing_button_class = '';
			$pricing_plan_featured = get_post_meta($pricing->ID, 'pricing_featured', true);
			if(!empty($pricing_plan_featured))
			{
				$priing_featured_class = 'featured';
			}
			
			$return_html.= '<li class="title_row '.$priing_featured_class.'">'.$pricing->post_title.'</li>';
			
			//Check price
			$pricing_plan_currency = get_post_meta($pricing->ID, 'pricing_plan_currency', true);
			$pricing_plan_price = get_post_meta($pricing->ID, 'pricing_plan_price', true);
			$pricing_plan_time = get_post_meta($pricing->ID, 'pricing_plan_time', true);
			
			$return_html.= '<li class="price_row">';
			$return_html.= '<strong>'.$pricing_plan_currency.'</strong>';
			$return_html.= '<em class="exact_price">'.$pricing_plan_price.'</em>';
			$return_html.= '<em class="time">'.$pricing_plan_time.'</em>';
			$return_html.= '</li>';
			
			//Get pricing features
			$pricing_plan_features = get_post_meta($pricing->ID, 'pricing_plan_features', true);
			$pricing_plan_features = trim($pricing_plan_features);
			$pricing_plan_features_arr = explode("\n", $pricing_plan_features);
			$pricing_plan_features_arr = array_filter($pricing_plan_features_arr, 'trim');
			
			foreach ($pricing_plan_features_arr as $feature) {
			    $return_html.= '<li>'.$feature.'</li>';
			}
			
			//Get button
			$pricing_button_text = get_post_meta($pricing->ID, 'pricing_button_text', true);
			$pricing_button_url = get_post_meta($pricing->ID, 'pricing_button_url', true);
			
			$return_html.= '<li class="button_row"><a href="'.$pricing_button_url.'" class="button">'.$pricing_button_text.'</a></li>';
			
			$return_html.= '</ul>';
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/>';
	
	return $return_html;
}

add_shortcode('tg_pricing', 'tg_pricing_func');


function pp_audio_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'src' => '',
		'width' => '80',
		'height' => '30',
	), $atts));

	$custom_id = time().rand();
	
	wp_enqueue_style("mediaelementplayer", get_template_directory_uri()."/js/mediaelement/mediaelementplayer.css", false, THEMEVERSION, "all");
	wp_enqueue_script("mediaelement-and-player.min", get_template_directory_uri()."/js/mediaelement/mediaelement-and-player.min.js", false, THEMEVERSION);
	wp_enqueue_script("script-audio-shortcode", get_template_directory_uri()."/templates/script-audio-shortcode.php?id=".$custom_id, false, THEMEVERSION, true);
	
	$return_html = '<audio id="'.$custom_id.'" src="'.$src.'" width="'.$width.'" height="'.$height.'"></audio>';
	return $return_html;
}

add_shortcode('pp_audio', 'pp_audio_func');


function jwplayer_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'id' => '',
		'file' => '',
		'image' => '',
		'width' => '80',
		'height' => '30',
	), $atts));
	
	wp_enqueue_style("mediaelementplayer", get_template_directory_uri()."/js/mediaelement/mediaelementplayer.css", false, THEMEVERSION, "all");
	wp_enqueue_script("mediaelement-and-player.min", get_template_directory_uri()."/js/mediaelement/mediaelement-and-player.min.js", false, THEMEVERSION);
	wp_enqueue_script("script-jwplayer-shortcode", get_template_directory_uri()."/templates/script-jwplayer-shortcode.php?id=".$id."&file=".$file."&image=".$image."&width=".$width."&height=".$height, false, THEMEVERSION, true);
}

add_shortcode('jwplayer', 'jwplayer_func');


function googlefont_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'font' => '',
		'fontsize' => '',
	), $atts));

	$return_html = '';

	if(!empty($font))
	{
		$encoded_font = urlencode($font);
		wp_enqueue_style($encoded_font, "http://fonts.googleapis.com/css?family=".$encoded_font, false, "", "all");
		
		$return_html = '<div class="googlefont" style="font-family:'.$font.';font-size:'.$fontsize.'px">'.$content.'</div>';
	}

	return $return_html;
}

add_shortcode('googlefont', 'googlefont_func');


// Actual processing of the shortcode happens here
function pp_last_run_shortcode( $content ) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();
 
    add_shortcode( 'one_half', 'one_half_func' );
    add_shortcode( 'one_half_last', 'one_half_last_func' );
    add_shortcode( 'one_third', 'one_third_func' );
    add_shortcode( 'one_third_last', 'one_third_last_func' );
    add_shortcode( 'two_third', 'two_third_func' );
    add_shortcode( 'two_third_last', 'two_third_last_func' );
    add_shortcode( 'one_fourth', 'one_fourth_func' );
    add_shortcode( 'one_fourth_last', 'one_fourth_last_func' );
    add_shortcode( 'one_fifth', 'one_fifth_func' );
    add_shortcode( 'one_fifth_last', 'one_fifth_last_func' );
    add_shortcode( 'tg_gallery', 'tg_gallery_func' );
    add_shortcode( 'tg_image', 'tg_image_func' );
    add_shortcode( 'tg_tab', 'tg_tab_func' );
	add_shortcode( 'tg_ver_tab', 'tg_ver_tab_func' );
    add_shortcode( 'tab', 'tab_func' );
    add_shortcode( 'tg_accordion', 'tg_accordion_func' );
    add_shortcode( 'pp_pre', 'pp_pre_func' );
 
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter( 'the_content', 'pp_last_run_shortcode', 7 );

?>