<?php

class WPBakeryShortCode_recent_posts extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
    		
    		$options = get_option('sf_flexform_options');

		    $title = $width = $excerpt_length = $el_class = $output = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	"item_count"	=> '4',
	        	"category"		=> '',
	        	"excerpt_length" => '20',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
	        if ($category == "all") {$category = '';}
	        $category_slug = str_replace('_', '-', $category);
		    
    		global $post, $wp_query;
    		
    		$sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
    		
    		if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
    		$item_class = 'span2';
    		} else if ($sidebar_config == "both-sidebars") {
    		$item_class = 'span-bs-quarter';
    		} else {
    		$item_class = 'span3';
    		}
    		
    		$args=array(
	    		'post_type' => 'post',
	    		'post_status' => 'publish',
	    		'category_name' => $category_slug,
	    		'posts_per_page' => $item_count
       		);
    		$blog_items = query_posts($args);
    		
    		if( have_posts() ) {
    		
    			$items .= '<ul class="recent-posts row clearfix">';
    	
    			while ( have_posts() ) {
    				
    				the_post();
    				
    				$thumb_type = get_post_meta($post->ID, 'sf_thumbnail_type', true);
					$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
    				$thumb_video = get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
    				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image' );

    				foreach ($thumb_image as $detail_image) {
    					$thumb_img_url = $detail_image['url'];
    					break;
    				}
    												
    				if (!$thumb_image) {
    					$thumb_image = get_post_thumbnail_id();
    					$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
    				}
    					    				
    				$item_title = get_the_title();
    				$post_author = get_the_author_link();
    				$post_date = get_the_date();
    				$post_permalink = get_permalink();
    				$post_comments = get_comments_number();
    				$custom_excerpt = get_post_meta($post->ID, 'sf_custom_excerpt', true);
    				$post_excerpt = '';
    				if ($custom_excerpt != '') {
    				$post_excerpt = custom_excerpt($custom_excerpt, $excerpt_length);
    				} else {
    				$post_excerpt = excerpt($excerpt_length);
    				}
    				
    				$thumb_link_type = get_post_meta($post->ID, 'sf_thumbnail_link_type', true);
    				$thumb_link_url = get_post_meta($post->ID, 'sf_thumbnail_link_url', true);
    				$thumb_lightbox_thumb = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=large' );
    				$thumb_lightbox_image = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
    				$thumb_lightbox_video_url = get_post_meta($post->ID, 'sf_thumbnail_link_video_url', true);
    				
    				$thumb_lightbox_img_url = wp_get_attachment_url( $thumb_lightbox_image, 'full' );
    				
    				if ($thumb_link_type == "link_to_url") {
    					$link_config = 'href="'.$thumb_link_url.'" class="link-to-url"';
    					$item_icon = "link";
    				} else if ($thumb_link_type == "link_to_url_nw") {
    					$link_config = 'href="'.$thumb_link_url.'" class="link-to-url" target="_blank"';
    					$item_icon = "link";
    				} else if ($thumb_link_type == "lightbox_thumb") {
    					$link_config = 'href="'.$thumb_img_url.'" class="view"';
    					$item_icon = "search";
    				} else if ($thumb_link_type == "lightbox_image") {
    					$lightbox_image_url = '';
    					foreach ($thumb_lightbox_image as $image) {
    						$lightbox_image_url = $image['full_url'];
    					}
    					$link_config = 'href="'.$lightbox_image_url.'" class="view"';	
    					$item_icon = "search";
    				} else if ($thumb_link_type == "lightbox_video") {
    					$link_config = 'href="'.$thumb_lightbox_video_url.'" rel="prettyPhoto"';
    					$item_icon = "facetime-video";				
    				} else {
    					$link_config = 'href="'.$post_permalink.'" class="link-to-post"';
    					$item_icon = "file-alt";
    				}
    				
    				$items .= '<li class="recent-post '.$item_class.' clearfix">';
    				
    				$items .= '<figure>';
    								
    				if ($thumb_type == "video") {
    					
    					$video = video_embed($thumb_video, 270, 202);
    					
    					$items .= $video;
    					
    				} else if ($thumb_type == "slider") {
    					
    					$items .= '<div class="flexslider thumb-slider"><ul class="slides">';
    								
    					foreach ( $thumb_gallery as $image )
    					{
    						$alt = $image['alt'];
    						if (!$alt) {
    						$alt = $image['title'];
    						}
    					    $items .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$alt}' /></li>";
    					}
    																	
    					$items .= '</ul><div class="open-item"><a '.$link_config.'><i class="icon-plus"></i></a></div></div>';
    					
    				} else {
    				
    					$image = aq_resize( $thumb_img_url, 420, 315, true, false);
    					
    					$items .= '<a '.$link_config.'>';
    					
    					$items .= '<div class="overlay"><div class="thumb-info">';
    					$items .= '<i class="icon-'.$item_icon.'"></i>';
    					$items .= '</div></div>';
    					    					  					    					
    					if ($image) {
    					$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$item_title.'" />';
    					}
    					
    					$items .= '</a>';
    				}
    				
    				$items .= '</figure>';
    				
    				$items .= '<div class="details-wrap">';
    				$items .= '<h4><a href="'.$post_permalink.'">'.$item_title.'</a></h4>';    				
    				if ($excerpt_length != "0") {
    				$items .= '<div class="excerpt">'. $post_excerpt .'</div>';
    				}
					$items .= '</div>';
					$items .= '<div class="post-item-details clearfix">';
					$items .= '<span class="post-date">'.$post_date.'</span>';
					$items .= '<div class="comments-likes">';
					if ( comments_open() ) {
					$items .= '<a href="'.$post_permalink.'#comment-area"><i class="icon-comments"></i><span>'. $post_comments .'</span></a> ';
					}
					if (function_exists( 'lip_love_it_link' )) {
					$items .= lip_love_it_link(get_the_ID(), '<i class="icon-heart"></i>', '<i class="icon-heart"></i>', false);
					}
					$items .= '</div>';				
					$items .= '</div>';
					$items .= '</li>';
    			
    			}
    			
    			wp_reset_query();
    					
    			$items .= '</ul>';
    
    		}
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="wpb_recent_posts_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper recent-posts-wrap">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading"><span>'.$title.'</span></h3></div>' : '';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

WPBMap::map( 'recent_posts', array(
    "name"		=> __("Recent Posts", "js_composer"),
    "base"		=> "recent_posts",
    "class"		=> "wpb_recent_posts",
    "icon"      => "icon-wpb-recent-posts",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "js_composer"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "js_composer")
    	), 
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "4",
            "description" => __("The number of blog items to show per page.", "js_composer")
        ),
		array(
		  	"type" => "select-multiple",
		   	"heading" => __("Blog category", "js_composer"),
		   	"param_name" => "category",
		   	"value" => get_category_list('category'),
		   	"description" => __("Choose the category for the blog items.", "js_composer")
		),
        array(
            "type" => "textfield",
            "heading" => __("Excerpt Length", "js_composer"),
            "param_name" => "excerpt_length",
            "value" => "20",
            "description" => __("The length of the excerpt for the posts.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    )
) );

?>