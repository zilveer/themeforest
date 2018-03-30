<?php

class WPBakeryShortCode_blog extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
			
			$options = get_option('sf_supreme_options');
			$use_disqus = $options['use_disqus'];
			
		    $title = $width = $el_class = $output = $items = $item_figure = $content_output = $exclude_categories = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	"pagination" 	=> "no",
	        	"blog_type"		=> "standard",
	        	"excerpt_length" => '20',
	        	"item_count"	=> '5',
	        	"category"		=> '',
	        	"exclude_categories" => '',
	        	"content_output" => '',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
	        if ($category == "all") {$category = '';}
	        $category_slug = str_replace('_', '-', $category);
		    
    		// BLOG QUERY SETUP
    		global $post, $wp_query;
    		wp_reset_query();
    		
    		if ( get_query_var('paged') ) {
    		$paged = get_query_var('paged');
    		} elseif ( get_query_var('page') ) {
    		$paged = get_query_var('page');
    		} else {
    		$paged = 1;
    		}
    		    		
    		$blog_args = array(
    			'post_type' => 'post',
    			'post_status' => 'publish',
    			'paged' => $paged,
    			'category_name' => $category_slug,
    			'posts_per_page' => $item_count,
    			'ignore_sticky_posts' => 0,
  				'cat' => '"'.$exclude_categories.'"'
    			);
    			    		
    		$blog_items = new WP_Query( $blog_args );
    		
    		$list_class = '';
    		
    		if ($blog_type == "masonry") {
    		$list_class .= 'masonry-items';
    		} else if ($blog_type == "mini") {
    		$list_class .= 'mini-items';
    		} else {
    		$list_class .= 'standard-items';
    		}
    		
    		$items .= '<ul class="blog-items '. $list_class .' clearfix">';
    			
			while ( $blog_items->have_posts() ) : $blog_items->the_post();
				    				
				$post_format = get_post_format();
				$post_title = get_the_title();
				$post_author = get_the_author_link();
				$post_date = get_the_date();
				$post_categories = sf_get_custom_post_cat_list($post->ID);
				$post_comments = get_comments_number();
				$post_permalink = get_permalink();
				$custom_excerpt = get_post_meta($post->ID, 'sf_custom_excerpt', true);
				$post_excerpt = '';
				if ($custom_excerpt != '') {
				$post_excerpt = custom_excerpt($custom_excerpt, $excerpt_length);
				} else {
				$post_excerpt = excerpt($excerpt_length);
				}
				
				if ($content_output == "full_content") {
				$post_excerpt = get_the_content_with_formatting();
				}
				
				$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
				
				$thumb_image = $thumb_img_url = $thumb_width = $thumb_height = $bordered_thumb_width = $bordered_thumb_height = $video = $video_height = $bordered_video_height = $item_class = $link_config = $item_icon = '';
				
				if ($blog_type == "mini") {
					if ($sidebar_config == "no-sidebars") {
					$thumb_width = 446;
					$thumb_height = NULL;
					$video_height = 250;
					} else {
					$thumb_width = 290;
					$thumb_height = NULL;
					$video_height = 163;
					}
				} else if ($blog_type == "masonry") {
					$thumb_width = 298;
					$thumb_height = NULL;
					$video_height = 198;
					$bordered_thumb_width = 286;
					$bordered_thumb_height = 186;
					$bordered_video_height = 186;
				} else {
					$thumb_width = 640;
					$thumb_height = NULL;
					$video_height = 360;
					$bordered_thumb_width = 408;
					$bordered_thumb_height = 303;
					$bordered_video_height = 303;
				}
				
				$thumb_type = get_post_meta($post->ID, 'sf_thumbnail_type', true);
				$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
				$thumb_video = get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
				$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=blog-image' );
				$thumb_link_type = get_post_meta($post->ID, 'sf_thumbnail_link_type', true);
				$thumb_link_url = get_post_meta($post->ID, 'sf_thumbnail_link_url', true);
				$thumb_lightbox_thumb = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=large' );
				$thumb_lightbox_image = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
				$thumb_lightbox_video_url = get_post_meta($post->ID, 'sf_thumbnail_link_video_url', true);
				
				foreach ($thumb_image as $detail_image) {
					$thumb_img_url = $detail_image['url'];
					break;
				}
												
				if (!$thumb_image) {
					$thumb_image = get_post_thumbnail_id();
					$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
				}
				
				$thumb_lightbox_img_url = wp_get_attachment_url( $thumb_lightbox_image, 'full' );
				
				// LINK TYPE VARIABLES
				
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
					$link_config = 'href="'.$thumb_lightbox_video_url.'" class="fancybox-media"';
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
																	
					$item_figure .= '</ul><div class="open-item"><a '.$link_config.'><i class="icon-plus"></i></a></div></div>';
					
				} else {
				
					$image = aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false);
					
					if ($image) {
						
						$item_figure .= '<a '.$link_config.'>';
						
						if ($blog_type == "masonry") { 
						
						$item_figure .= '<div class="overlay"><div class="thumb-info">';
						$item_figure .= '<i class="icon-'.$item_icon.'"></i>';
						$item_figure .= '</div></div>';
						
						}
						
						$item_figure .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$post_title.'" />';
												
						$item_figure .= '</a>';
					}
				}
				
				$item_figure .= '</figure>';
				
				}
				
				
				// BLOG ITEM OUTPUT
				
				$items .= '<li class="blog-item">';
				
				if ($post_format == "quote") {
				$items .= '<div class="quote-display"><i class="icon-quote-left"></i></div>';
				} else {
				$items .= $item_figure;
				}
				
				$items .= '<div class="blog-details-wrap">';
				$items .= '<div class="item-cats">'. $post_categories .'</div>';
				if ($post_format != "aside") {
				if ($blog_type == "masonry") {
				$items .= '<h4><a href="'.$post_permalink.'">'. $post_title .'</a></h4>';
				} else {
				$items .= '<h3><a href="'.$post_permalink.'">'. $post_title .'</a></h3>';
				}
				}
				$items .= '<div class="blog-item-details">'. sprintf(__('By %1$s on %2$s', 'swiftframework'), $post_author, $post_date) .'</div>';
				if ($post_format == "quote") {
				$items .= '<div class="quote-excerpt heading-font">'. get_the_content() .'</div>';
				} else if ($post_format == "chat") {
				$items .= '<div class="excerpt">'. get_the_content() .'</div>';				
				} else {
				$items .= '<div class="excerpt">'. $post_excerpt .'</div>';
				}
				$items .= '<div class="read-more-bar"><a class="read-more" href="'.$post_permalink.'">'.__("Read more", "swiftframework").'<i class="icon-chevron-right"></i></a>';
				$items .= '<div class="comments-likes">';
				if ( comments_open() ) {
				if ($use_disqus) {
					$items .= '<a href="'.$post_permalink.'#comment-area"><i class="icon-comments"></i><span>'. disqus_count(false) .'</span></a> ';
				} else {
					$items .= '<a href="'.$post_permalink.'#comment-area"><i class="icon-comments"></i><span>'. $post_comments .'</span></a> ';
				}
				}
				if (function_exists( 'lip_love_it_link' )) {
				$items .= lip_love_it_link(get_the_ID(), '<i class="icon-heart"></i>', '<i class="icon-heart"></i>', false);
				}
				$items .= '</div></div>';
				
				$items .= '</div></li>';
				
				$item_figure = '';
				
			endwhile;
			
			wp_reset_postdata();
			$items .= '</ul>';
			
			
			// PAGINATION
			
			if ($pagination == "yes") {
			
				if ($blog_type == "masonry") {
				$items .= '<div class="pagination-wrap masonry-pagination">';
				} else {
				$items .= '<div class="pagination-wrap blog-pagination">';
				}
							
				$items .= pagenavi($blog_items);
				
				wp_reset_query();
													
				$items .= '</div>';
				
			}
			
 
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="wpb_blog_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper blog-wrap">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading"><span>'.$title.'</span></h3></div>' : '';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            if ($blog_type == "masonry") {
            global $include_isotope;
            $include_isotope = true;
            }
            
            global $has_blog;
            $has_blog = true;
            
            return $output;
		
    }
}

WPBMap::map( 'blog', array(
    "name"		=> __("Blog", "js_composer"),
    "base"		=> "blog",
    "class"		=> "wpb_blog",
    "icon"      => "icon-wpb-blog",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "js_composer"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "js_composer")
    	),
    	array(
    	    "type" => "dropdown",
    	    "heading" => __("Blog type", "js_composer"),
    	    "param_name" => "blog_type",
    	    "value" => array(__('Standard', "js_composer") => "standard", __('Mini', "js_composer") => "mini", __('Masonry', "js_composer") => "masonry"),
    	    "description" => __("Select the display type for the blog.", "js_composer")
    	),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "5",
            "description" => __("The number of blog items to show per page.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Blog category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('category'),
            "description" => __("Choose the category for the blog items.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Exclude categories", "js_composer"),
            "param_name" => "exclude_categories",
            "value" => "",
            "description" => __('If you would like to exclude categories from the blog list, then enter the category IDs here with a "-" infront of them, seperated by a comma (no spaces or quotes). E.g. "-1,-7,-23".', "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Content Output", "js_composer"),
            "param_name" => "content_output",
            "value" => array(__("Excerpt", "js_composer") => "excerpt", __("Full Content", "js_composer") => "full_content"),
            "description" => __("Choose whether to display the excerpt or the full content for the post. Full content is not available for the masonry view.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Excerpt Length", "js_composer"),
            "param_name" => "excerpt_length",
            "value" => "20",
            "description" => __("The length of the excerpt for the posts.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "js_composer"),
            "param_name" => "pagination",
            "value" => array(__("Yes", "js_composer") => "yes", __("No", "js_composer") => "no"),
            "description" => __("Show pagination.", "js_composer")
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