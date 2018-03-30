<?php
	/*	
	*	Goodlayers Media Management File
	*	---------------------------------------------------------------------
	*	This file contains functions that manage the media in the theme
	*	---------------------------------------------------------------------
	*/	

	// use for getting the video from link / shortcode
	if( !function_exists('gdlr_get_video_item') ){
		function gdlr_get_video_item($settings){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';		
		
			$ret  = '<div class="gdlr-video-item gdlr-item" ' . $item_id . $margin_style . ' >';
			$ret .= gdlr_get_video($settings['url']);
			$ret .= '</div>';
			
			return $ret;
		}
	}
	
	if( !function_exists('gdlr_get_video') ){
		function gdlr_get_video($video, $size = 'full'){
			if( empty($video) ) return '';
			
			$video_size = gdlr_get_video_size($size);
			$width = $video_size['width']; 
			$height = $video_size['height']; 

			// video shortcode
			if(preg_match('#^\[video\s.+\[/video\]#', $video, $match)){ 
				return do_shortcode($match[0]);
				
			// embed shortcode
			}else if(preg_match('#^\[embed.+\[/embed\]#', $video, $match)){ 
				global $wp_embed; 
				return $wp_embed->run_shortcode($match[0]);
				
			// youtube link
			}else if(strpos($video, 'youtube') !== false){
				preg_match('#[?&]v=([^&]+)(&.+)?#', $video, $id);
				$id[2] = empty($id[2])? '': $id[2];
				return '<iframe src="//www.youtube.com/embed/' . $id[1] . '?wmode=transparent' . $id[2] . '" width="' . $width . '" height="' . $height . '" ></iframe>';
			
			// youtu.be link
			}else if(strpos($video, 'youtu.be') !== false){
				preg_match('#youtu.be\/([^?&]+)#', $video, $id);
				return '<iframe src="//www.youtube.com/embed/' . $id[1] . '?wmode=transparent" width="' . $width . '" height="' . $height . '" ></iframe>';
			
			// vimeo link
			}else if(strpos($video, 'vimeo') !== false){
				preg_match('#https?:\/\/vimeo.com\/(\d+)#', $video, $id);
				return '<iframe src="//player.vimeo.com/video/' . $id[1] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $width . '" height="' . $height . '"></iframe>';
			
			// another link
			}else if(preg_match('#^https?://\S+#', $video, $match)){ 	
				$path_parts = pathinfo($match[0]);
				if( !empty($path_parts['extension']) ){
					return do_shortcode('[video width="' . $width . '" height="' . $height . '" src="' . $match[0] . '" ][/video]');
				}else{
					global $wp_embed; 
					$video_embed = '[embed width="' . $width . '" height="' . $height . '" ]' . $match[0] . '[/embed]';
					return $wp_embed->run_shortcode($video_embed);
				}				
			}
			return '';
		}
	}	
	
	// use for printing the image from  image id
	if( !function_exists('gdlr_get_image') ){
		function gdlr_get_image($image, $size = 'full', $link = array(), $attr = ''){
			if( empty($image) ) return '';
		
			if( is_numeric($image) ){
				$alt_text = get_post_meta($image , '_wp_attachment_image_alt', true);	
				$image_src = wp_get_attachment_image_src($image, $size);	
				if( empty($image_src) ) return '';
				
				if( $link === true ){ 
					$image_full = wp_get_attachment_image_src($image, 'full');
					$link = array('url'=>$image_full[0]);
				}else if( !empty($link) && empty($link['url']) ){
					$image_full = wp_get_attachment_image_src($image, 'full');
					$link['url'] = $image_full[0];				
				}
				$ret = '<img src="' . $image_src[0] . '" alt="' . $alt_text . '" width="' . $image_src[1] .'" height="' . $image_src[2] . '" ' . $attr . '/>';
			}else{
				if( $link === true ){ 
					$link = array('url'=>$image); 
				}else if( !empty($link) && empty($link['url']) ){
					$link['url'] = $image;		
				}
				$ret = '<img src="' . $image . '" alt="" ' . $attr . ' />';
			}
			
			if( !empty($link) ){
				if( is_numeric($image) ){
					$fancybox_title = gdlr_get_attachment_info($image, 'title');
					if( !empty($fancybox_title) ){
						$fancybox_title = 'title="' . esc_attr($fancybox_title) . '" ';
					}
				}
				
				$fancybox  = '<a href="' . $link['url'] . '" ' . $fancybox_title;
				$fancybox .= (empty($link['id']))? '': 'data-fancybox-group="gdlr-gal-' . $link['id'] . '" ';
				$fancybox .= (!empty($link['type']) && $link['type'] == 'link')? '': 'data-rel="fancybox" ';
				$fancybox .= (!empty($link['type']) && $link['type'] == 'video')? 'data-fancybox-type="iframe" ': '';
				$fancybox .= (!empty($link['new-tab']) && $link['new-tab'] == 'enable')? 'target="_blank" ': '';
				$fancybox .= '>' . $ret;
				$fancybox .= (!empty($link['close-tag']))? '': '</a>';
				return $fancybox;
			}
			return $ret;
		}
	}
	function gdlr_get_attachment_info($attachment_id, $type = '') {
		$attachment = get_post($attachment_id);
		if( !empty($attachment) ){
			$ret = array(
				'caption' => $attachment->post_excerpt,
				'description' => $attachment->post_content,
				'title' => $attachment->post_title
			);
			
			if( !empty($type) ) return $ret[$type];
			return $ret;
		}
		return array();
	}	
	
	// image frame item
	if( !function_exists('gdlr_get_image_frame_item') ){
		function gdlr_get_image_frame_item($settings){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';		
		
			$frame_style = (strpos($settings['frame-type'], 'solid') !== false)? ' style="background-color: ' . $settings['frame-background'] . ';" ': '';
		
			$ret  = '<div class="gdlr-image-frame-item gdlr-item" ' . $item_id . $margin_style . ' >';
			$ret .= '<div class="gdlr-frame frame-type-' . $settings['frame-type'] . '" ' . $frame_style . ' >';
			$ret .= '<div class="gdlr-image-link-shortcode" >';
			$ret .= gdlr_get_image($settings['image-id'], $settings['thumbnail-size']);

			if( !empty($settings['link-type']) && $settings['link-type'] != 'none' ){
				$attribute = ''; $icon = '';
				if( $settings['link-type'] == 'url' ){
					$icon = 'icon-link';
					$attribute = ' href="' . $settings['url'] . '" ';
				}else if( $settings['link-type'] == 'current' ){
					if( is_numeric($settings['image-id']) ){	
						$image_src = wp_get_attachment_image_src($settings['image-id'], 'full');
						$image_src = $image_src[0];
					}else{
						$image_src = $settings['image-id'];
					}
				
					$icon = 'icon-search';
					$attribute = ' href="' . $image_src . '" data-rel="fancybox" ';
				}else if( $settings['link-type'] == 'image' ){
					$icon = 'icon-search';
					$attribute = ' href="' . $settings['url'] . '" data-rel="fancybox" ';
				}else if( $settings['link-type'] == 'video' ){
					$icon = 'icon-play';
					$attribute = ' href="' . $settings['url'] . '" data-rel="fancybox" data-fancybox-type="iframe" ';
				}
			
				$ret .= '<a class="gdlr-image-link-overlay-wrapper" ' . $attribute . '  >';
				$ret .= '<span class="gdlr-image-link-overlay" >&nbsp;</span>';
				$ret .= '<span class="gdlr-image-link-icon"></span>';
				$ret .= '<i class="' . $icon . '"></i>';
				$ret .= '</a>';
			}
			
			$ret .= '</div>'; 
			$ret .= '</div>'; // gdlr-frame
			$ret .= '</div>';
			
			return $ret;
		}
	}	

	// use for printing slider
	if( !function_exists('gdlr_get_slider_item') ){
		function gdlr_get_slider_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$ret  = '<div class="gdlr-item gdlr-slider-item" ' . $item_id . $margin_style . ' >';
			$ret .= gdlr_get_slider($settings['slider'], $settings['thumbnail-size'], $settings['slider-type']);
			$ret .= '</div>';
			return $ret;
		}
	}
	
	// use for printing post slider
	if( !function_exists('gdlr_get_post_slider_item') ){
		function gdlr_get_post_slider_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$slide_order = array();
			$slide_data = array();
			
			// query posts section
			$args = array('post_type' => 'post', 'suppress_filters' => false);
			$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
			$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
			$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
			$args['ignore_sticky_posts'] = 1;

			if( is_numeric($settings['category']) ){
				$args['category'] = (empty($settings['category']))? '': $settings['category'];	
			}else{ 
				if( !empty($settings['category']) || !empty($settings['tag']) ){
					$args['tax_query'] = array('relation' => 'OR');
					
					if( !empty($settings['category']) ){
						array_push($args['tax_query'], array('terms'=>explode(',', $settings['category']), 'taxonomy'=>'category', 'field'=>'slug'));
					}
					if( !empty($settings['tag']) ){
						array_push($args['tax_query'], array('terms'=>explode(',', $settings['tag']), 'taxonomy'=>'post_tag', 'field'=>'slug'));
					}				
				}	
			}
			$query = new WP_Query( $args );	
			
			// set the excerpt length
			global $theme_option, $gdlr_excerpt_length, $gdlr_excerpt_read_more; 
			$gdlr_excerpt_read_more = false;
			$gdlr_excerpt_length = $settings['num-excerpt'];
			add_filter('excerpt_length', 'gdlr_set_excerpt_length');

			global $post;
			while($query->have_posts()){ $query->the_post();
				$image_id = get_post_thumbnail_id();
				
				if( !empty($image_id) ){
					$slide_order[] = $image_id;
					$slide_data[$image_id] = array(	
						'title'=> get_the_title(),
						'slide-link'=> 'url',
						'url'=> get_permalink(),
						'new-tab'=> 'disable',
						'caption-position'=>$settings['caption-style']
					);
					
					if( $settings['style'] == 'no-excerpt' ){
						$slide_data[$image_id]['caption']  = '<div class="gdlr-caption-date" >';
						$slide_data[$image_id]['caption'] .= '<i class="icon-calendar"></i>';
						$slide_data[$image_id]['caption'] .= get_the_time($theme_option['date-format']);				
						$slide_data[$image_id]['caption'] .= '</div>';				
						
						$slide_data[$image_id]['caption'] .= '<div class="gdlr-title-link" >';
						$slide_data[$image_id]['caption'] .= '<i class="icon-angle-right" ></i>';
						$slide_data[$image_id]['caption'] .= '</div>';		
					}else{
						$slide_data[$image_id]['caption']  = '<div class="blog-info blog-date"><i class="icon-calendar"></i>';
						$slide_data[$image_id]['caption'] .= get_the_time($theme_option['date-format']);
						$slide_data[$image_id]['caption'] .= '</div>';
						$slide_data[$image_id]['caption'] .= '<div class="blog-info blog-comment"><i class="icon-comment"></i>';
						$slide_data[$image_id]['caption'] .= get_comments_number();
						$slide_data[$image_id]['caption'] .= '</div>';					
						$slide_data[$image_id]['caption'] .= '<div class="clear"></div>';					
						$slide_data[$image_id]['caption'] .= get_the_excerpt();
					}
				}
			}	
			
			$gdlr_excerpt_read_more = true;
			remove_filter('excerpt_length', 'gdlr_set_excerpt_length');
			
			if( $settings['style'] == 'no-excerpt' ){
				$settings['caption-style'] = 'no-excerpt';
			}
			
			$ret  = '<div class="gdlr-item gdlr-post-slider-item style-' . $settings['caption-style'] . '" ' . $item_id . $margin_style . ' >';
			$ret .= gdlr_get_slider(array($slide_order, $slide_data), $settings['thumbnail-size'], 'flexslider');
			$ret .= '</div>';
			return $ret;
		}
	}	

	// use for printing stack images
	if( !function_exists('gdlr_get_stack_images') ){
		function gdlr_get_stack_images( $slider_data, $size = 'full' ){
			global $gdlr_gallery_id; $gdlr_gallery_id++;
		
			if( is_array($slider_data) ){
				$slide_order = $slider_data[0];
				$slide_data = $slider_data[1];
			}else{
				$slider_option = json_decode($slider_data, true);
				$slide_order = $slider_option[0];
				$slide_data = $slider_option[1];			
			}
			
			$slides = array();
			foreach($slide_order as $slide){
				$slides[$slide] = $slide_data[$slide];
			}
			
			$ret  = '<div class="gdlr-stack-image-wrapper">';
			foreach($slides as $slide_id => $slide){
				// image caption
				$caption = '';
				if( !empty($slide['title']) && !empty($slide['caption']) ){
					$slide['caption-position'] = empty($slide['caption-position'])? 'left': $slide['caption-position'];
				
					$caption .= '<div class="gdlr-caption-wrapper position-' . $slide['caption-position'] . '">';
					$caption .= '<div class="gdlr-caption-inner" >';
					$caption .= '<div class="gdlr-caption">';
					$caption .= empty($slide['title'])? '': '<div class="gdlr-caption-title">' . $slide['title'] . '</div>';
					$caption .= empty($slide['caption'])? '': '<div class="gdlr-caption-text">' . $slide['caption'] . '</div>';
					$caption .= '</div>'; // gdlr-slider-caption
					$caption .= '</div>'; // gdlr-slider-caption-wrapper
					$caption .= '</div>';
				}			
			
				$ret .= '<div class="gdlr-stack-image">';
				if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
					$ret .= gdlr_get_image($slide_id, $size) . $caption;
				}else if( $slide['slide-link'] == 'url' ){
					$ret .= gdlr_get_image($slide_id, $size, 
						array('url'=>$slide['url'], 'new-tab'=>$slide['new-tab'], 'close-tag'=>true));
					$ret .= $caption . '</a>';
				}else if( $slide['slide-link'] == 'current' ){	
					$ret .= gdlr_get_image($slide_id, $size, 
						array('id'=>$gdlr_gallery_id, 'close-tag'=>true));
					$ret .= $caption . '</a>';
				}else if( $slide['slide-link'] == 'image' ){
					$ret .= gdlr_get_image($slide_id, $size, 
						array('url'=>$slide['url'], 'id'=>$gdlr_gallery_id, 'close-tag'=>true));
					$ret .= $caption . '</a>';
				}else if( $slide['slide-link'] == 'video' ){
					$ret .= gdlr_get_image($slide_id, $size, 
						array('url'=>$slide['url'], 'type'=>'video', 'id'=>$gdlr_gallery_id, 'close-tag'=>true));
					$ret .= $caption . '</a>';
				}
				$ret .= '</div>';
			}		
			$ret .= '</div>';
			
			return $ret;
		}
	}	
	
	// use for printing slider
	if( !function_exists('gdlr_get_slider') ){
		function gdlr_get_slider( $slider_data, $thumbnail_size, $slider_type = 'flexslider' ){
			if( is_array($slider_data) ){
				$slide_order = $slider_data[0];
				$slide_data = $slider_data[1];
			}else{
				$slider_option = json_decode($slider_data, true);
				$slide_order = $slider_option[0];
				$slide_data = $slider_option[1];			
			}
			
			$slides = array();
			$slide_order = empty($slide_order)? array(): $slide_order;
			foreach($slide_order as $slide){
				$slides[$slide] = $slide_data[$slide];
			}
				
			if($slider_type == 'flexslider'){
				return gdlr_get_flex_slider($slides, array('size'=> $thumbnail_size));
			}else if($slider_type == 'nivoslider'){
				return gdlr_get_nivo_slider($slides, array('size'=> $thumbnail_size));
			}else{
				return 'slider is not defined';
			}
			
		}
	}	
	
	// use for printing flex slider
	if( !function_exists('gdlr_get_flex_slider') ){
		function gdlr_get_flex_slider($slides, $settings = array()){
			global $theme_option, $gdlr_gallery_id; $gdlr_gallery_id++;
			
			$ret  = '<div class="flexslider" ';
			$ret .= empty($settings['pausetime'])? 'data-pausetime="' . $theme_option['flex-pause-time'] . '" ': 
						'data-pausetime="' . $settings['pausetime'] . '" ';
			$ret .= empty($settings['slidespeed'])? 'data-slidespeed="' . $theme_option['flex-slide-speed'] . '" ': 
						'data-slidespeed="' . $settings['slidespeed'] . '" ';			
			$ret .= empty($settings['effect'])? 'data-effect="' . $theme_option['flex-slider-effects'] . '" ': 
						'data-effect="' . $settings['effect'] . '" ';	
						
			$ret .= empty($settings['columns'])? '': 'data-columns="' . $settings['columns'] . '" ';
			$ret .= empty($settings['carousel'])? '': 'data-type="carousel" ';
			$ret .= empty($settings['nav-container'])? '': 'data-nav-container="' . $settings['nav-container'] . '" ';
			$ret .= '>';
			$ret .= '<ul class="slides" >';
			
			$slides = empty($slides)? array(): $slides;
			foreach($slides as $slide_id => $slide){
				$ret .= '<li>';
				
				if( is_array($slide) ){

					// flex slider caption
					$caption = '';
					if( !empty($slide['title']) || !empty($slide['caption']) ){
						$slide['caption-position'] = empty($slide['caption-position'])? 'left': $slide['caption-position'];
					
						$caption .= '<div class="gdlr-caption-wrapper position-' . $slide['caption-position'] . '">';
						$caption .= '<div class="gdlr-caption-inner" >';
						$caption .= '<div class="gdlr-caption">';
						$caption .= empty($slide['title'])? '': '<div class="gdlr-caption-title">' . $slide['title'] . '</div>';
						$caption .= empty($slide['caption'])? '': '<div class="gdlr-caption-text">' . $slide['caption'] . '</div>';
						$caption .= '</div>'; // gdlr-slider-caption
						$caption .= '</div>'; // gdlr-slider-caption-wrapper
						$caption .= '</div>';
					}				
				
					// flex slider link
					if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
						$ret .= gdlr_get_image($slide_id, $settings['size']) . $caption;
					}else if( $slide['slide-link'] == 'url' ){
						$ret .= gdlr_get_image($slide_id, $settings['size'], 
							array('url'=>$slide['url'], 'new-tab'=>$slide['new-tab'], 'close-tag'=>true));
						$ret .= $caption . '</a>';
					}else if( $slide['slide-link'] == 'current' ){	
						$ret .= gdlr_get_image($slide_id, $settings['size'], 
							array('id'=>$gdlr_gallery_id, 'close-tag'=>true));
						$ret .= $caption . '</a>';
					}else if( $slide['slide-link'] == 'image' ){
						$ret .= gdlr_get_image($slide_id, $settings['size'], 
							array('url'=>$slide['url'], 'id'=>$gdlr_gallery_id, 'close-tag'=>true));
						$ret .= $caption . '</a>';
					}else if( $slide['slide-link'] == 'video' ){
						$ret .= gdlr_get_image($slide_id, $settings['size'], 
							array('url'=>$slide['url'], 'type'=>'video', 'id'=>$gdlr_gallery_id, 'close-tag'=>true));
						$ret .= $caption . '</a>';
					}
				}else{
					$ret .= gdlr_get_image($slide, $settings['size'], array('id'=>$gdlr_gallery_id));
				}
				$ret .= '</li>';
			}
			$ret .= '</ul>';
			$ret .= '</div>';
			
			return $ret;
		}
	}
	
	// use for printing nivo slider
	if( !function_exists('gdlr_get_nivo_slider') ){
		function gdlr_get_nivo_slider($slides, $settings = array()){
			global $theme_option, $gdlr_gallery_id; $gdlr_gallery_id++;
			
			$i = 0; $caption = '';
			$ret  = '<div class="nivoSlider-wrapper">';
			$ret .= '<div class="nivoSlider" ';
			$ret .= empty($settings['pausetime'])? 'data-pausetime="' . $theme_option['nivo-pause-time'] . '" ': 
						'data-pausetime="' . $settings['pausetime'] . '" ';
			$ret .= empty($settings['slidespeed'])? 'data-slidespeed="' . $theme_option['nivo-slide-speed'] . '" ': 
						'data-slidespeed="' . $settings['slidespeed'] . '" ';			
			$ret .= empty($settings['effect'])? 'data-effect="' . $theme_option['nivo-slider-effects'] . '" ': 
						'data-effect="' . $settings['effect'] . '" ';
			$ret .= '>';
			
			$slides = empty($slides)? array(): $slides;
			foreach($slides as $slide_id => $slide){ 
				if( is_array($slide) ){

					// nivo slider caption
					$id = 'nivo-caption' . $gdlr_gallery_id . '-' . $i; $i++;
					if( !empty($slide['title']) || !empty($slide['caption']) ){
						$slide['caption-position'] = empty($slide['caption-position'])? 'left': $slide['caption-position'];
						
						$caption .= '<div class="gdlr-nivo-caption" id="' . $id . '" >';
						$caption .= '<div class="gdlr-caption-wrapper position-' . $slide['caption-position'] . '">';
						$caption .= '<div class="gdlr-caption-inner" >';
						$caption .= '<div class="gdlr-caption">';
						$caption .= empty($slide['title'])? '': '<div class="gdlr-caption-title">' . $slide['title'] . '</div>';
						$caption .= empty($slide['caption'])? '': '<div class="gdlr-caption-text">' . $slide['caption'] . '</div>';
						$caption .= '</div>'; // gdlr-caption
						$caption .= '</div>'; // gdlr-caption-inner
						$caption .= '</div>'; // gdlr-caption-wrapper
						$caption .= '</div>'; // gdlr-nivo-caption
					}				
					
					// flex slider link
					$attr = ' title="#' . $id . '" '; 
					if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
						$ret .= gdlr_get_image($slide_id, $settings['size'], array(), $attr);
					}else if( $slide['slide-link'] == 'url' ){
						$ret .= gdlr_get_image($slide_id, $settings['size'], 
							array('url'=>$slide['url'], 'new-tab'=>$slide['new-tab']), $attr);
					}else if( $slide['slide-link'] == 'current' ){	
						$ret .= gdlr_get_image($slide_id, $settings['size'], 
							array('id'=>$gdlr_gallery_id), $attr);
					}else if( $slide['slide-link'] == 'image' ){
						$ret .= gdlr_get_image($slide_id, $settings['size'], 
							array('url'=>$slide['url'], 'id'=>$gdlr_gallery_id), $attr);
					}else if( $slide['slide-link'] == 'video' ){
						$ret .= gdlr_get_image($slide_id, $settings['size'], 
							array('url'=>$slide['url'], 'type'=>'video', 'id'=>$gdlr_gallery_id), $attr);
					}
				}else{
					$ret .= gdlr_get_image($slide, $settings['size'], array('id'=>$gdlr_gallery_id), $attr);
				}
			}
			$ret .= '</div>'; // nivoSlider
			$ret .= $caption;
			$ret .= '</div>'; // nivoSlider-wrapper
			
			return $ret;
		}
	}	
	
	// banner item
	if( !function_exists('gdlr_get_banner_item') ){
		function gdlr_get_banner_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$slider_option = json_decode($settings['slider'], true);
			$slide_order = $slider_option[0];
			$slide_data = $slider_option[1];
			
			$slides = array();
			foreach($slide_order as $slide){
				$slides[$slide] = $slide_data[$slide];
			}
			

			$ret  = '<div class="gdlr-banner-item-wrapper">';
			$ret .= '<div class="gdlr-banner-images gdlr-item" ' . $margin_style . '>';
			$ret .= gdlr_get_flex_slider($slides , array(
							'size'=> $settings['thumbnail-size'], 
							'columns'=> $settings['banner-columns'],
							'carousel'=> true,
							'nav-container'=> 'gdlr-banner-images'
					));
			$ret .= '</div>'; // gdlr-banner-images
			$ret .= '</div>'; // gdlr-banner-item-wrapper
			
			return $ret;
		}
	}	
	
	// banner with divider item
	if( !function_exists('gdlr_get_banner_with_divider_item') ){
		function gdlr_get_banner_with_divider_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$column_class = array('one' => 'twelve columns', 'two' => 'six columns', 'three' => 'four columns');
			
			$ret  = '<div class="gdlr-banner-with-divider-item-wrapper gdlr-item" ' . $margin_style . $item_id . '>';
			if( in_array($settings['column-no'], array('one', 'two', 'three')) ){
				$ret .= '<div class="gdlr-banner-with-divider-images ' . $column_class[$settings['column-no']] . '" >';
				if( !empty($settings['image-1']) ){
					if( empty($settings['link-1']) ){
						$ret .= gdlr_get_image($settings['image-1'], 'full');
					}else{
						$ret .= '<a href="' . $settings['link-1'] . '" >';
						$ret .= gdlr_get_image($settings['image-1'], 'full');
						$ret .= '</a>';
					}
				}
				$ret .= '</div>';
			}
			if( in_array($settings['column-no'], array('two', 'three')) ){
				$ret .= '<div class="gdlr-banner-with-divider-images ' . $column_class[$settings['column-no']] . '" >';
				if( !empty($settings['image-2']) ){
					if( empty($settings['link-2']) ){
						$ret .= gdlr_get_image($settings['image-2'], 'full');
					}else{
						$ret .= '<a href="' . $settings['link-2'] . '" >';
						$ret .= gdlr_get_image($settings['image-2'], 'full');
						$ret .= '</a>';
					}
				}
				$ret .= '</div>';
			}
			if( $settings['column-no'] == 'three' ){
				$ret .= '<div class="gdlr-banner-with-divider-images ' . $column_class[$settings['column-no']] . '" >';
				if( !empty($settings['image-3']) ){
					if( empty($settings['link-3']) ){
						$ret .= gdlr_get_image($settings['image-3'], 'full');
					}else{
						$ret .= '<a href="' . $settings['link-3'] . '" >';
						$ret .= gdlr_get_image($settings['image-3'], 'full');
						$ret .= '</a>';
					}
				}
				$ret .= '</div>';
			}
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>'; // gdlr-banner-item-wrapper
			
			return $ret;
		}
	}		

	// gallery item
	if( !function_exists('gdlr_get_gallery_item') ){
		function gdlr_get_gallery_item( $settings ){
			// title section	
			$ret .= gdlr_get_item_title($settings);		
		
			$slider_option = json_decode($settings['slider'], true);
			$slide_order = $slider_option[0];
			$slide_data = $slider_option[1];					
			
			$slides = array();
			foreach( $slide_order as $slide_id ){
				$slides[$slide_id] = $slide_data[$slide_id];
			}
			$settings['slider'] = $slides;
			
			if( $settings['gallery-style'] == 'thumbnail' ) return gdlr_get_gallery_thumbnail($settings);
			return $ret . gdlr_get_gallery($settings);
		}
	}	
	
	// print gallery function
	if( !function_exists('gdlr_get_gallery') ){
		function gdlr_get_gallery( $settings ){
			global $gdlr_gallery_id, $gdlr_spaces; $gdlr_gallery_id++; 

			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			// start printing gallery
			$current_size = 0;
			$settings['num-fetch'] = empty($settings['num-fetch'])? 9999: intval($settings['num-fetch']);
			$paged = (get_query_var('paged'))? get_query_var('paged') : 1;
			$num_page = ceil(sizeof($settings['slider']) / $settings['num-fetch']);
			
			$ret  = '<div class="gdlr-gallery-item gdlr-item" ' . $item_id . $margin_style . '>';
			foreach($settings['slider'] as $slide_id => $slide){
				if( ($current_size >= ($paged - 1) * $settings['num-fetch']) &&
					($current_size < ($paged) * $settings['num-fetch']) ){

					if( !empty($current_size) && ($current_size % $settings['gallery-columns'] == 0) ){
						$ret .= '<div class="clear"></div>';
					}			
					$ret .= '<div class="gallery-column ' . gdlr_get_column_class('1/' . $settings['gallery-columns']) . '">';
					$ret .= '<div class="gallery-item">';
					
					if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
						$ret .= gdlr_get_image($slide_id, $settings['thumbnail-size']);
					}else if($slide['slide-link'] == 'url' || $slide['slide-link'] == 'attachment'){		
						$ret .= gdlr_get_image($slide_id, $settings['thumbnail-size'], 
							array('url'=>$slide['url'], 'new-tab'=>$slide['new-tab']));				
					}else if($slide['slide-link'] == 'current'){
						$ret .= gdlr_get_image($slide_id, $settings['thumbnail-size'], 
							array('id'=>$gdlr_gallery_id));
					}else if($slide['slide-link'] == 'image'){
						$ret .= gdlr_get_image($slide_id, $settings['thumbnail-size'], 
							array('url'=>$slide['url'], 'id'=>$gdlr_gallery_id));
					}else if($slide['slide-link'] == 'video'){
						$ret .= gdlr_get_image($slide_id, $settings['thumbnail-size'], 
							array('url'=>$slide['url'], 'type'=>'video', 'id'=>$gdlr_gallery_id));
					}

					if($settings['show-caption'] != 'no'){
						$ret .= '<span class="gallery-caption">' . gdlr_get_attachment_info($slide_id, 'caption') . '</span>';
					}
					$ret .= '</div>'; // gallery item
					$ret .= '</div>'; // gallery column				
				}
				$current_size ++;
			}
			$ret .= '<div class="clear"></div>';
			$ret .= gdlr_get_pagination($num_page, $paged);
			$ret .= '</div>'; // gdlr-gallery-item
			
			return $ret;
		}
	}
	if( !function_exists('gdlr_get_gallery_thumbnail') ){
		function gdlr_get_gallery_thumbnail( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';			
			
			$ret  = '<div class="gdlr-gallery-item gdlr-item gdlr-gallery-thumbnail" ' . $item_id . $margin_style . '>';
			
			// full image
			$ret .= '<div class="gdlr-gallery-thumbnail-container">';
			foreach($settings['slider'] as $slide_id => $slide){
				$ret .= '<div class="gdlr-gallery-thumbnail" data-id="' . $slide_id . '" >';
				$ret .= gdlr_get_image($slide_id);
				if($settings['show-caption'] != 'no'){
					$ret .= '<div class="gallery-caption-wrapper">';
					$ret .= '<span class="gallery-caption">';
					$ret .= gdlr_get_attachment_info($slide_id, 'caption');
					$ret .= '</span>';
					$ret .= '</div>';
				}
				$ret .= '</div>';
			}
			$ret .= '</div>';
			
			// start printing gallery
			$current_size = 0;
			foreach($settings['slider'] as $slide_id => $slide){
				if( !empty($current_size) && ($current_size % $settings['gallery-columns'] == 0) ){
					$ret .= '<div class="clear"></div>';
				}			
			
				$ret .= '<div class="gallery-column ' . gdlr_get_column_class('1/' . $settings['gallery-columns']) . '">';
				$ret .= '<div class="gallery-item" data-id="' . $slide_id . '" >';
				$ret .= gdlr_get_image($slide_id, $settings['thumbnail-size']);
				$ret .= '</div>'; // gallery item
				$ret .= '</div>'; // gallery column
				$current_size ++;
			}
			$ret .= '<div class="clear"></div>';
			
			$ret .= '</div>'; // gdlr-gallery-item
			
			return $ret;
		}
	}	

	// twitter item
	if( !function_exists('gdlr_get_twitter_item') ){
		function gdlr_get_twitter_item( $settings ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';			
		
			$gdlr_twitter = get_option('gdlr_twitter', array());
			if( !is_array($gdlr_twitter) && !empty($gdlr_twitter) ){ 
				$gdlr_twitter = unserialize($gdlr_twitter);
			}
			if( !is_array($gdlr_twitter) ){	
				$gdlr_twitter = array(); 
			}
			
			$show_num = $settings['show-num'];
			$twitter_username = $settings['twitter-name'];
			if( empty($gdlr_twitter[$twitter_username][$show_num]['data']) ||
				empty($gdlr_twitter[$twitter_username][$show_num]['cache_time']) || 
				time() - intval($gdlr_twitter[$twitter_username][$show_num]['cache_time']) >= ($settings['cache-time'] * 3600)){
				
				$tweets_data = gdlr_get_tweets($settings['consumer-key'], $settings['consumer-secret'], 
					$settings['access-token'], $settings['access-token-secret'], 
					$settings['twitter-name'], $settings['show-num']);
				
				if( !empty($tweets_data) ){
					$gdlr_twitter[$twitter_username][$show_num]['data'] = $tweets_data;
					$gdlr_twitter[$twitter_username][$show_num]['cache_time'] = time();
					
					update_option('gdlr_twitter', $gdlr_twitter);	
				}
			}else{
				$tweets_data = $gdlr_twitter[$twitter_username][$show_num]['data'];
			}

			$ret  = gdlr_get_item_title($settings);	
			$ret .= '<div class="gdlr-item gdlr-twitter-item" ' . $item_id . $margin_style . ' >';	
			$ret .= '<div class="flexslider" data-type="carousel" data-columns="1" >';		
			$ret .= '<ul class="slides">';
			foreach( $tweets_data as $tweet_data ){
				$ret .= '<li>' . $tweet_data . '</li>';
			}
			$ret .= '</ul>';			
			$ret .= '</div>'; // flexslider
			$ret .= '</div>'; // gdlr-twitter-item

			return $ret;
		}
	}
?>