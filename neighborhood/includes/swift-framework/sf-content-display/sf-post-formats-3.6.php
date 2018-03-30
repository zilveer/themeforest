<?php

	/*
	*
	*	Swift Page Builder - Post Format Output Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	
	/* MAIN GET MEDIA FUNCTION
	================================================== */ 
	function sf_get_post_media($postID, $media_width, $media_height, $video_height, $use_thumb_content) {
		
		$format = get_post_format($postID);
		$post_media = "";
		
		if ($format == "image") {
			$post_media = sf_image_post($postID, $media_width, $media_height, $use_thumb_content);
		} else if ($format == "video") {
			$post_media = sf_video_post($postID, $media_width, $video_height, $use_thumb_content);
		} else if ($format == "gallery") {
			$post_media = sf_gallery_post($postID, $use_thumb_content);
		} else if ($format == "audio") {
			$post_media = sf_audio_post($postID);
		} else if ($format == "link") {
			$post_media = sf_link_post($postID);
		} else if ($format == "chat") {
			$post_media = sf_chat_post($postID);
		}
		
		return $post_media;
	
	}
	
	
	/* GET IMAGE MEDIA
	================================================== */
	
	function sf_get_post_format_image_src($post_id){
	    $format_meta = get_post_format_meta($post_id);
	    $match = array();
	    if ($format_meta['image'] != "") {
	    preg_match('/<img.*?src="([^"]+)"/s', $format_meta['image'], $match);
	    return $match[1];
	    }
	}
	
	function sf_image_post($postID, $media_width, $media_height, $use_thumb_content) {
	
		$image = $media_image_url = "";
		
		if (function_exists('get_the_post_format_image')) {
		
			$media_image_url = sf_get_post_format_image_src($postID);
			
			$detail_image = aq_resize( $media_image_url, $media_width, $media_height, true, false);
					
			if ($detail_image) {
				$image = '<img src="'.$detail_image[0].'" width="'.$detail_image[1].'" height="'.$detail_image[2].'" />';
			}
		
		} else {
		
			if ($use_thumb_content) {
			$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full', $postID);
			} else {
			$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full', $postID);
			}
					
			foreach ($media_image as $detail_image) {
				$media_image_url = $detail_image['url'];
				break;
			}
											
			if (!$media_image) {
				$media_image = get_post_thumbnail_id();
				$media_image_url = wp_get_attachment_url( $media_image, 'full' );
			}
			
			$detail_image = aq_resize( $media_image_url, $media_width, $media_height, true, false);
					
			if ($detail_image) {
				$image = '<img src="'.$detail_image[0].'" width="'.$detail_image[1].'" height="'.$detail_image[2].'" />';
			}
			
		}
		
		return $image;
	}
	
	
	/* GET VIDEO MEDIA
	================================================== */ 
	function sf_video_post($postID, $media_width, $video_height, $use_thumb_content) {
		
		$video = $media_video = "";
		
		if (function_exists('get_the_post_format_media')) {
			
			$video = get_the_post_format_media( 'video', $null, 1 );
						
			if ($video == "") {
				if ($use_thumb_content) {
				$media_video = sf_get_post_meta($postID, 'sf_thumbnail_video_url', true);
				} else {
				$media_video = sf_get_post_meta($postID, 'sf_detail_video_url', true);
				}
				
				$video = video_embed($media_video, $media_width, $video_height);
			}
			
		} else {
					
			if ($use_thumb_content) {
			$media_video = sf_get_post_meta($postID, 'sf_thumbnail_video_url', true);
			} else {
			$media_video = sf_get_post_meta($postID, 'sf_detail_video_url', true);
			}
			
			$video = video_embed($media_video, $media_width, $video_height);
		
		}
		
		return $video;
	}
	
	
	/* GET GALLERY MEDIA
	================================================== */ 
	function sf_gallery_post($postID, $use_thumb_content) {
		
		$gallery = '<div class="flexslider item-slider">'."\n";
		$gallery .= '<ul class="slides">'."\n";
		
		if (function_exists('get_post_gallery')) {
			
			$args = array(
			    'orderby'        => 'menu_order ID',
			    'post_type'      => 'attachment',
			    'post_parent'    => $postID,
			    'post_mime_type' => 'image',
			    'post_status'    => null,
			    'numberposts'    => -1,
			    'exclude'		 => get_post_thumbnail_id()
			);
			$attachments = get_posts($args);
			
			foreach ( $attachments as $attachment ) {
				$src = wp_get_attachment_image_src( $attachment->ID, 'full-image');
				$gallery .= "<li><img src='{$src[0]}' width='{$src[1]}' height='{$src[2]}' /></li>";
			}
			
		} else {
			
			if ($use_thumb_content) {
			$media_gallery = rwmb_meta('sf_thumbnail_gallery', 'type=image&size=full-width-image-gallery', $postID);
			} else {
			$media_gallery = rwmb_meta( 'sf_detail_gallery', 'type=image&size=full-width-image-gallery', $postID);
			}
						
			foreach ( $media_gallery as $image ) {
				$gallery .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>";
			}
			
		}
																
		$gallery .= '</ul>'."\n";
		$gallery .= '</div>'."\n";
		
		return $gallery;
	}
	
	
	/* GET AUDIO MEDIA
	================================================== */ 
	function sf_audio_post($postID) {
		
		$audio = "";
		
		if (function_exists('get_the_post_format_media')) {
		
			$audio = do_shortcode(get_the_post_format_media( 'audio', $null, 1 ));
		
		}
		
		return $audio;
	}
	
	
	/* GET LINK MEDIA
	================================================== */ 
	function sf_link_post($postID) {
		
		$link = "";
		
		if (function_exists('get_the_post_format_url')) {

			$link = get_the_post_format_url();
			$link = '<a href="'.esc_url($link).'" target="_blank" class="link-post-link"><i class="fa-link"></i>'.$link.'</a>';

		}
		
		return $link;
	}


	/* GET CHAT MEDIA
	================================================== */ 
	function sf_chat_post($postID) {
		
		$chat = "";
		
		if (function_exists('get_the_post_format_chat')) {

			$chat  = '<dl class="chat">';
			$stanzas = get_the_post_format_chat();
		
			foreach ( $stanzas as $stanza ) {
				foreach ( $stanza as $row ) {
					$time = '';
					if ( ! empty( $row['time'] ) )
						$time = sprintf( '<time class="chat-timestamp">%s</time>', esc_html( $row['time'] ) );
		
					$chat .= sprintf(
						'<dt class="chat-author chat-author-%1$s vcard">%2$s <cite class="fn">%3$s</cite>: </dt>
							<dd class="chat-text">%4$s</dd>
						',
						esc_attr( sanitize_title_with_dashes( $row['author'] ) ), // Slug.
						$time,
						esc_html( $row['author'] ),
						$row['message']
					);
				}
			}
		
			$chat .= '</dl><!-- .chat -->';
		
		}
		
		return $chat;
	}
	
	
	/* GET POST ITEM
	================================================== */ 
	function sf_get_post_item($postID, $blog_type, $show_title = "yes", $show_excerpt = "yes", $show_details = "yes", $excerpt_length = "20", $content_output = "excerpt", $show_read_more = "no") {
	
		$post_item = "";
		
		$post_format = get_post_format($postID);
					
		global $sidebars;
		$post_format = get_post_format();
		if ( $post_format == "" ) {
			$post_format = 'standard';
		}
		$post_title = get_the_title();
		$post_author = get_the_author_link();
		$post_date = get_the_date();
		$post_categories = get_the_category_list(', ');
		$post_comments = get_comments_number();
		$post_permalink = get_permalink();
		$custom_excerpt = sf_get_post_meta($postID, 'sf_custom_excerpt', true);
		$post_excerpt = '';
		if ($content_output == "excerpt") {
			if ($custom_excerpt != '') {
			$post_excerpt = custom_excerpt($custom_excerpt, $excerpt_length);
			} else {
			if ($post_format == "quote") {
			$post_excerpt = get_the_content_with_formatting();
			} else {
			$post_excerpt = excerpt($excerpt_length);
			}
			}
		} else {
			$post_excerpt = get_the_content_with_formatting();
		}
		if ($post_format == "chat") {
		$post_excerpt = sf_chat_post($postID);
		}
		
		$post_item = $thumb_image = $thumb_width = $thumb_height = $bordered_thumb_width = $bordered_thumb_height = $video = $video_height = $bordered_video_height = $item_class = $link_config = $item_icon = '';
			
		if ($blog_type == "mini") {
			if ($sidebars == "no-sidebars") {
			$thumb_width = 446;
			$thumb_height = NULL;
			$video_height = 335;
			} else {
			$thumb_width = 290;
			$thumb_height = NULL;
			$video_height = 218;
			}
		} else if ($blog_type == "masonry") {
			if ($sidebars == "both-sidebars") {
			$item_class = "span3";
			} else {
			$item_class = "span4";
			}
			$thumb_width = 480;
			$thumb_height = NULL;
			$video_height = 360;
		} else {
			if ($sidebars == "both-sidebars") {
				if ($show_details == "yes") {
					$standard_post_width = "span5";
				} else {
					$standard_post_width = "span6";
				}
			} else if ($sidebars == "right-sidebar" || $sidebars == "left-sidebar" || $sidebars == "one-sidebar") {
				if ($show_details == "yes") {
					$standard_post_width = "span6";
				} else {
					$standard_post_width = "span7";
				}
			} else {
				if ($show_details == "yes") {
					$standard_post_width = "span10";
				} else {
					$standard_post_width = "span11";
				}
			}
			$thumb_width = 970;
			$thumb_height = NULL;
			$video_height = 728;
		}
		
		
		$thumb_type = sf_get_post_meta($postID, 'sf_thumbnail_type', true);
		$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
		$thumb_video = sf_get_post_meta($postID, 'sf_thumbnail_video_url', true);
		$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=blog-image' );
		$thumb_link_type = sf_get_post_meta($postID, 'sf_thumbnail_link_type', true);
		$thumb_link_url = sf_get_post_meta($postID, 'sf_thumbnail_link_url', true);
		$thumb_lightbox_thumb = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=large' );
		$thumb_lightbox_image = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
		$thumb_lightbox_video_url = sf_get_post_meta($postID, 'sf_thumbnail_link_video_url', true);
		
		foreach ($thumb_image as $detail_image) {
			$thumb_img_url = $detail_image['url'];
			break;
		}
										
		if (!$thumb_image) {
			$thumb_image = get_post_thumbnail_id();
			$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
		}
		
		$thumb_lightbox_img_url = wp_get_attachment_url( $thumb_lightbox_image, 'full' );
		
		$item_figure = $link_config = "";
		
		// LINK TYPE VARIABLES			
		if ($thumb_link_type == "link_to_url") {
			$link_config = 'href="'.$thumb_link_url.'" class="link-to-url"';
			$item_icon = "link";
		} else if ($thumb_link_type == "link_to_url_nw") {
			$link_config = 'href="'.$thumb_link_url.'" class="link-to-url" target="_blank"';
			$item_icon = "link";
		} else if ($thumb_link_type == "lightbox_thumb") {
			$link_config = 'href="'.$thumb_img_url.'" class="lightbox" data-rel="ilightbox['.$post_ID.']"';
			$item_icon = "search";
		} else if ($thumb_link_type == "lightbox_image") {
			$lightbox_image_url = '';
			foreach ($thumb_lightbox_image as $image) {
				$lightbox_image_url = $image['full_url'];
			}
			$link_config = 'href="'.$lightbox_image_url.'" class="lightbox" data-rel="ilightbox['.$post_ID.']"';
			$item_icon = "search";	
		} else if ($thumb_link_type == "lightbox_video") {
			$link_config = 'href="'.$thumb_lightbox_video_url.'" class="lightbox" data-rel="ilightbox['.$postID.']"';
			$item_icon = "facetime-video";
		} else {
			$link_config = 'href="'.$post_permalink.'" class="link-to-post"';
			$item_icon = "file-alt";
		}	
		
		// THUMBNAIL MEDIA TYPE SETUP
		
		if ($thumb_type != "none") {
		
		$item_figure .= '<figure>';
						
		if ($thumb_type == "video") {
			
			$video = video_embed($thumb_video, $thumb_width, $video_height);
			
			$item_figure .= $video;
			
		} else if ($thumb_type == "slider") {
			
			$item_figure .= '<div class="flexslider thumb-slider"><ul class="slides">';
						
			foreach ( $thumb_gallery as $image )
			{
			    $item_figure .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>";
			}
															
			$item_figure .= '</ul><div class="open-item"><a '.$link_config.'></a></div></div>';
			
		} else if ($thumb_type == "image") {
		
			$image = aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false);
			
			if ($image) {
				
				$item_figure .= '<a '.$link_config.'>';
				
				if ($blog_type != "standard") {
				$item_figure .= '<div class="overlay"><div class="thumb-info">';
				$item_figure .= '<i class="fa-'.$item_icon.'"></i>';
				$item_figure .= '</div></div>';
				}
							
				$item_figure .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
							
				$item_figure .= '</a>';
			}
		}
		
		$item_figure .= '</figure>';
		
		}
			
		// MASONRY STYLING				
		if ($blog_type == "masonry") {
			
			if ($post_format == "quote") {
				$post_item .= '<div class="quote-display"><i class="fa-quote-left"></i></div>';
			} else {
				$post_item .= $item_figure;
			}
			
			$post_item .= '<div class="details-wrap">';
			
			if ($show_title == "yes") {
				if ($post_format == "link") {
				$post_item .= '<h4>'.sf_link_post($postID).'</h4>'; 	
				} else {
				$post_item .= '<h4><a href="'.$post_permalink.'">'.$post_title.'</a></h4>'; 				
				}
			}
			
			// POST EXCERPT
			if ($post_excerpt != "0" && $show_excerpt == "yes") {
				$post_item .= '<div class="excerpt">'. $post_excerpt .'</div>';
			}
			
			if ($show_read_more == "yes") {
			$post_item .= '<a class="read-more" href="'.$post_permalink.'">'.__("Read more", "swiftframework").'<i class="fa-angle-right"></i></a>';
			}
		
			$post_item .= '</div>';
		
			// POST DETAILS 
			if ($show_details == "yes") {
			$post_item .= '<div class="post-item-details clearfix">';
			$post_item .= '<span class="post-date">'.$post_date.'</span>';
			$post_item .= '<div class="comments-likes">';
			if ( comments_open() ) {
			$post_item .= '<a href="'.$post_permalink.'#comment-area"><i class="fa-comments"></i><span>'. $post_comments .'</span></a> ';
			}
			if (function_exists( 'lip_love_it_link' )) {
			$post_item .= lip_love_it_link(get_the_ID(), '<i class="fa-heart"></i>', '<i class="fa-heart"></i>', false);
			}
			$post_item .= '</div>';				
			$post_item .= '</div>';
			}
			
		// MINI STYLING
		} else if ($blog_type == "mini") {
		
			$post_item .= $item_figure;
		
			$post_item .= '<div class="blog-details-wrap">';
			
			if ($show_title == "yes") {
			if ($post_format == "link") {
			$post_item .= '<h3>'.sf_link_post($postID).'</h3>'; 	
			} else {
			$post_item .= '<h3><a href="'.$post_permalink.'">'. $post_title .'</a></h3>';
			}				
			}	
			
			if ($show_details == "yes") {
			$post_item .= '<div class="blog-item-details">'. sprintf(__('By <a href="%2$s">%1$s</a> on %3$s', 'swiftframework'), $post_author, get_author_posts_url(get_the_author_meta( 'ID' )), $post_date) .'</div>';
			
			$post_item .= '<div class="comments-likes">';
			if ( comments_open() ) {
				$post_item .= '<a href="'.$post_permalink.'#comment-area"><i class="fa-comments"></i><span>'. $post_comments .'</span></a> ';
			}
			if (function_exists( 'lip_love_it_link' )) {
				$post_item .= lip_love_it_link(get_the_ID(), '<i class="fa-heart"></i>', '<i class="fa-heart"></i>', false);
			}
			$post_item .= '</div>';
			}
			if ($show_excerpt == "yes") {
			if ($post_format == "quote") {
				$post_item .= '<div class="quote-excerpt heading-font">'. $post_excerpt .'</div>';
			} else {
				$post_item .= '<div class="excerpt">'. $post_excerpt .'</div>';
			}
			}
			
			if ($show_read_more == "yes") {
			$post_item .= '<a class="read-more" href="'.$post_permalink.'">'.__("Read more", "swiftframework").'<i class="fa-angle-right"></i></a>';
			}
			
			$post_item .= '</div>';
		
		// STANDARD STYLING
		} else {
			
			$post_item .= '<div class="row">'; // open row
			
			if ($sidebars == "no-sidebars") {
			$post_item .= '<div class="standard-post-author span1">';
			if(function_exists('get_avatar')) {
			$post_item .= '<div class="author-avatar">'. get_avatar(get_the_author_meta('ID'), '164') .'</div>';
			}
			$post_item .= '<span class="standard-post-author-name">'.__("Posted by", "swiftframework").' '.$post_author.'</span>';
			$post_item .= '</div>';
			} else if ($sidebars == "right-sidebar" || $sidebars == "left-sidebar" || $sidebars == "one-sidebar") {
			$post_item .= '<div class="standard-post-author span1">';
			if(function_exists('get_avatar')) {
			$post_item .= '<div class="author-avatar">'. get_avatar(get_the_author_meta('ID'), '164') .'</div>';
			}
			$post_item .= '<span class="standard-post-author-name">'.__("Posted by", "swiftframework").' '.$post_author.'</span>';
			$post_item .= '</div>';
			}
			
			$post_item .= '<div class="standard-post-content '.$standard_post_width.'">'; // open standard-post-content
		
			if ($post_format == "quote") {
				$post_item .= '<div class="quote-display"><i class="fa-quote-left"></i></div>';
			} else {
				$post_item .= $item_figure;
				if ($show_title) {
				if ($post_format == "link") {
				$post_item .= '<h2>'.sf_link_post($postID).'</h2>'; 	
				} else {
				$post_item .= '<h2><a href="'.$post_permalink.'">'. $post_title .'</a></h2>';
				}
				}
			}
			
			if ($show_excerpt == "yes") {					
			if ($post_format == "quote") {
				$post_item .= '<div class="quote-excerpt heading-font">'. $post_excerpt .'</div>';
			} else {
				$post_item .= '<div class="excerpt">'. $post_excerpt .'</div>';
			}
			}
			
			if ($show_read_more == "yes") {
			$post_item .= '<a class="read-more" href="'.$post_permalink.'">'.__("Read more", "swiftframework").'<i class="fa-angle-right"></i></a>';
			}
		
			$post_item .= '</div>'; // close standard-post-content
			
			if ($show_details == "yes") {
				$post_item .= '<div class="standard-post-details span1">'; // open standard-post-details
				if ($sidebars == "both-sidebars") {
				$post_item .= '<div class="standard-post-author">';
				if(function_exists('get_avatar')) {
				$post_item .= '<div class="author-avatar">'. get_avatar(get_the_author_meta('ID'), '164') .'</div>';
				}
				$post_item .= '<span class="standard-post-author-name">'.__("Posted by", "swiftframework").' '.$post_author.'</span>';
				$post_item .= '</div>';
				}
				$post_item .= '<span class="standard-post-date">'.$post_date.'</span>';
				$post_item .= '<div class="comments-likes">';
				
				if ( comments_open() ) {
					$post_item .= '<div class="comments-wrapper"><a href="'.$post_permalink.'#comment-area"><i class="fa-comments"></i><span>'. $post_comments .'</span></a></div>';
				}
				
				if (function_exists( 'lip_love_it_link' )) {
					$post_item .= lip_love_it_link(get_the_ID(), '<i class="fa-heart"></i>', '<i class="fa-heart"></i>', false);
				}
				
				$post_item .= '</div>';
				$post_item .= '</div>'; // close standard-post-details
			}
			
			$post_item .= '</div>'; // close row
			
		}		
		
		return $post_item;
	}

?>