<?php

if( ! function_exists('uxbarn_register_heading_shortcode')) {
	
	function uxbarn_register_heading_shortcode($atts) {
		$default_atts = array(
							'text' => __('Title', 'uxbarn'),
							'type' => 'h2', // h1, h2, h3, h4, h5
							'style' => '', // '', light
							'alignment' => '',
							'has_line' => 'false', // true, false
							'has_icon'=>'', // true, ''
							'icon'=>'',
							'icon_size'=>'',
							'icon_color'=>'',
							'css_animation'=>'',
							'extra_class' => '',
						);
		extract(shortcode_atts($default_atts, $atts));
		
		
		$class = '';
		$indicator = 0;
		
		if($style != '') {
			$indicator += 1;
		}
		
		if(trim($extra_class) != '') {
			$indicator += 1;
		}
		
		 
		if($css_animation != '') {
			$css_animation = uxbarn_get_css_animation_complete_class($css_animation);
			$indicator += 1;
		}
		
		if($alignment != '') {
			$indicator += 1;
		}
		
		if($has_line != 'false') {
			$has_line = ' has-line ';
			$indicator += 1;
		} else {
			$has_line = '';
		}
		
		if($indicator > 0) {
			$class = ' class="' . $style . ' ' . $extra_class . ' ' . $alignment . ' ' . $has_line . ' ' . $css_animation . '"';
		}
		
		
		if($has_icon == 'true') {
			
			$icon_size = trim($icon_size);
			$icon_color = trim($icon_color);
			
			if($icon_size != '') {
				if(is_numeric($icon_size)) {
					$icon_size = ' font-size: ' . $icon_size . 'px;';
				} else {
					$icon_size = ' font-size: 16px;';
				}
			} else {
				$icon_size = ' font-size: 16px;';
			}
			
			
			if($icon_color != '') {
				if(strpos($icon_color, '#') === false) {
					$icon_color = ' color: #' . $icon_color . ';';
				} else {
					if($icon_color == '#') {
						$icon_color = '';
					} else {
						$icon_color = ' color: ' . $icon_color . ';';
					}
				}
			} else {
				$icon_color = '';
			}
			
			$style = '';
			if($icon_color != '' || $icon_size != '') {
				$style = ' style="' . $icon_size . $icon_color . ' margin-right: 6px;"';
			}
			
			
			if(trim($icon) != '' && trim($icon) != 'icon-') {
				$icon = '<i class="fa fa-' . trim( $icon ) . '" ' . $style . '></i> ';
			} else {
				$icon = '';
			}
		} else {
			$icon = '';
		}
		
		return '<' . $type . $class . '>' . $icon . ' ' . $text . '</' . $type . '>';
	}

}


if( ! function_exists('uxbarn_register_video_shortcode')) {
	
	function uxbarn_register_video_shortcode($atts) {
		$default_atts = array(
							'source' => 'vimeo', // youtube, vimeo
							'video_id' => '', // ex: 23534361 (vimeo), G_G8SdXktHg (youtube)
							'size' => '', // 560x315 for ex.
							//'embed_code' => '',
						);
		extract(shortcode_atts($default_atts, $atts));
		
		// Currently not used
		$size = trim($size);
		if($size != '') {
			$raw_size = explode('x', $size);
			$size = ' height="' . $raw_size[0] . '" width="' . $raw_size[1] . '" ';
		}
		
		$video_id = trim($video_id);
		
		if($source == 'youtube') {
			return '<div class="embed"><iframe ' . $size . ' src="http://www.youtube.com/embed/' . $video_id . '?wmode=opaque" frameborder="0" allowfullscreen></iframe></div>';
			
		} else if($source == 'vimeo') {
			return '<div class="embed"><iframe ' . $size . '  src="http://player.vimeo.com/video/' . $video_id . '?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
		}
		
	}

}


if( ! function_exists('uxbarn_register_messagebox_shortcode')) {
	
	function uxbarn_register_messagebox_shortcode($atts, $content = null) {
		$default_atts = array(
							'type' => 'success', // success, error, info, warning
						);
		extract(shortcode_atts($default_atts, $atts));
		
		return '<div data-alert class="' . $type . ' box"><a href="#" class="close">&times;</a>' . do_shortcode($content) . '</div>';
	}
	
}


if( ! function_exists('uxbarn_register_blockquote_shortcode')) {
	
	function uxbarn_register_blockquote_shortcode($atts, $content = null) {
		$default_atts = array(
							'type' => '', // '', left, right
							'cite' => '',
							'extra_class' => '',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		$cite = trim($cite);
		
		$class = '';
		if($type == 'left' || $type == 'right') {
			$class = $type;
			
		} else if($type == '') {
			$class = '';
		}

		$class = ' class="' . $class . ' ' . $extra_class . '"';
		
		if($cite) {
			return 
			'<blockquote ' . $class . '>
				<p>
					' . $content . '
				</p>
				<cite>' . $cite . '</cite>
			</blockquote>';
		
		} else {
			return 
			'<blockquote ' . $class . '>
				<p>
					' . $content . '
				</p>
			</blockquote>';
		}
		
	}

}


if( ! function_exists('uxbarn_register_button_shortcode')) {
	
	function uxbarn_register_button_shortcode($atts) {
		$default_atts = array(
							'button_text' => __('Button Text', 'uxbarn'),
							'link' => '',
							'open_new_window' => '', // true, ''
							'button_color' => '', // '', secondary, alert, success
							'button_custom_color' => '',
							'button_size' => '', // small, '' (medium), large
							'button_border' => '', // '', radius, round
							'icon' => '', // '', Font Awesome class name
							'expanded' => '', // true, ''
							'bottom_right' => '', // true, ''
							'display_angle' => '', // true, ''
							'extra_class' => '',
						);
		extract(shortcode_atts($default_atts, $atts));
		
		
		if(trim($button_text) == '') {
			$button_text = __('Button Text', 'uxbarn');
		}
		
		/*if(trim($link) == '' || trim($link) == 'http://' || trim($link) == '#') {
			$link = '#';
		} else {
			if(strpos($link,'http://') === false) {
				$link = 'http://' . $link;
			}
		}*/
		$link = uxbarn_get_sanitized_url($link);
		
		if($open_new_window == 'true') {
			$open_new_window = ' target="_blank"';
		} else {
			$open_new_window = '';
		}
		
		if($expanded == 'true') {
			$expanded = 'expand';
		} else {
			$expanded = '';
		}
		
		if($bottom_right == 'true') {
			$bottom_right = 'bottom-right';
		} else {
			$bottom_right = '';
		}
		
		$angle = '';
		if($display_angle == 'true') {
			$display_angle = 'angle';
			$angle = '<span class="angle"><i class="fa fa-angle-right"></i></span>';
		} else {
			$display_angle = '';
		}
		
		if(trim($icon) != '' && trim($icon) != 'icon-') {
			$icon = '<i class="fa fa-' . trim( $icon ) . '"></i> ';
		} else {
			$icon = '';
		}
		
		$custom_color = '';
		if($button_color == 'custom') {
			$custom_color = ' style="background-color: ' . $button_custom_color . '" ';
		}
		
		return '<a' . $open_new_window. ' href="' . $link . '" class="'. $button_size . ' ' . $button_color . ' ' . $button_border . ' ' . $expanded . ' '. $extra_class . ' ' . $bottom_right . ' ' . $display_angle . ' flat button" ' . $custom_color . '>' . $icon . $button_text . $angle . '</a>';
	}

}


if( ! function_exists('uxbarn_register_testimonial_slider_shortcode')) {
   
	function uxbarn_register_testimonial_slider_shortcode($atts, $content = null) {
		$default_atts = array(
							'id_list' => '', 
							'type' => 'full-width', // full-width, left, right
							'width' => '', // % or px 
							'auto_rotation_duration' => 'disabled',
							'order_by' => 'ID',
							'order' => 'ASC',
							'extra_class' => '',
						);
		extract(shortcode_atts($default_atts, $atts));
		
		if(trim($id_list) == '') {
			return '<div class="error box">' . __('Cannot generate Testimonial Slider shortcode. ID list must be defined.', 'uxbarn') . '</div>';
		}
		
		// Moved to functions.php
		//wp_enqueue_script('uxbarn-carouFredSel');
		
		$id_list = explode(',', $id_list);
		
		$args = array(
					'post_type' => 'testimonials',
					'nopaging' => true,
					'post__in' => $id_list,
					'orderby' => $order_by,
					'order' => $order,
				);
				
		$testimonials = new WP_Query($args);
		
		$result = '';
		$thumbnail = '';
		$type_class = '';
		$corner_elements = '';
		
		if($type == 'full-width') {
			
			$type_class = '';
			$width = '';
			$corner_elements = '
							<div class="testimonial-angle"></div>
							<div class="testimonial-corner"></div>
							<div class="testimonial-corner-mirror"></div>';
			
		} else { // left, right
			
			$width = trim($width);
			$unit = '';
			if($width != '') {
				// Set default prefix to pixel unit if it is not specified
				if(strpos($width, 'px') === false && strpos($width, '%') === false) {
					$unit = 'px';
				}
				
			} else {
				// Default width if it is left blank
				//$width = '400';
				//$unit = 'px';
				$width = '100';
				$unit = '%';
			}
			
			$width = 'style="width: ' . $width . $unit . '"';
			$thumbnail = '';
			$type_class .= ' style2 ' . $type;
		}
		
		$result .= '<div class="testimonial-wrapper ' . $type_class . ' ' . $extra_class . '" ' . $width . '>
					<div class="testimonial-inner">
						<div class="testimonial-list" data-auto-rotation="' . $auto_rotation_duration . '">';
						
		if($testimonials->have_posts()) {
			while($testimonials->have_posts()) {
				$testimonials->the_post();
				
				$thumbnail_class = '';
				if($type == 'full-width' && has_post_thumbnail(get_the_ID())) {
					$thumbnail = get_the_post_thumbnail(get_the_ID(), 'large-square');
				} else {
					$thumbnail = '';
					$thumbnail_class = ' no-thumbnail ';
				}
				
				$cite = get_the_title();
				//$cite = uxbarn_get_translated_text_from_qTranslate(uxbarn_get_array_value(get_post_meta(get_the_ID(), 'ux_home_testimonial_cite_text'), 0));
				
				if(trim($cite) != '') {
					$cite = '<p class="cite">' . $cite . '</p>';
				}
				
				//$content = get_the_content();
				$content = uxbarn_get_translated_text_from_qTranslate(uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_testimonial_text'), 0));
				$smaller_class = '';
				
				/*if($thumbnail != '') {
					if(strlen($content) > 180) {
						$smaller_class = ' class="smaller"';
					}
				} else {
					if(strlen($content) > 250) {
						$smaller_class = ' class="smaller"';
					}
				}*/
				
				$result .= 
				'<div class="tmnlid-' . get_the_ID() . '">
					<div class="blockquote-wrapper ' . $thumbnail_class . '">
						<blockquote>
							<p ' . $smaller_class . '>
								' . $content . '
							</p>
						</blockquote>
						' . $cite . '
					</div>
					' . $thumbnail . '
				</div>';
				
			}  
		}  
		wp_reset_postdata();
		
		$result .= '</div>
					' . $corner_elements . '
				</div>
				<div class="testimonial-bullets"></div>
			</div>';
		
		return $result;
			  
	}

}


if( ! function_exists('uxbarn_register_googlemap_shortcode')) {
	
	function uxbarn_register_googlemap_shortcode($atts) {
		$default_atts = array(
							'latitude' => '40.714353',
							'longitude' => '-74.005973',
							'address' => '',
							'display_type' => 'ROADMAP',
							'zoom' => '17',
							'height' => '250',
							'extra_class' => '',
						);
		extract(shortcode_atts($default_atts, $atts));
		
		// Moved to functions.php
		//wp_enqueue_script('uxbarn-googleMap');
		
		return
			'<div class="google-map ' . $extra_class . '" data-latlng="' . $latitude . ', ' . $longitude . '" data-address="' . $address . '" data-display-type="' . $display_type . '" data-zoom-level="' . $zoom . '" data-height="' . $height . '"></div>';
	}
	
}


if( ! function_exists('uxbarn_register_searchform_shortcode')) {

	function uxbarn_register_searchform_shortcode($atts) {
		$default_atts = array(
							'title' => '',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		return 
			'<h3>' . $title . '</h3><form method="get" action="' . esc_url(home_url('')) . '">
				<span>
					<input type="text" name="s" placeholder="' . esc_attr(__('Type and hit enter ...', 'uxbarn')) . '" value="' . trim( get_search_query() ) . '" />
				</span>
			</form>';
	}
	
}


if( ! function_exists('uxbarn_register_icon_shortcode')) {
	
	function uxbarn_register_icon_shortcode($atts) {
		$default_atts = array(
							'code' => '', // icon-asterisk (sample)
							'size' => '', // numeric value
							'color' => '', // #FFFFFF (example)
							'alignment' => 'normal-align-left',
							'extra_class'=>'',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		$code = trim($code);
		$size = trim($size);
		$color = trim($color);
		
		if($size != '') {
			if(is_numeric($size)) {
				$size = ' font-size: ' . $size . 'px;';
			} else {
				$size = ' font-size: 16px;';
			}
		} else {
			$size = ' font-size: 16px;';
		}
		
		
		if($color != '') {
			if(strpos($color, '#') === false) {
				$color = ' color: #' . $color . ';';
			} else {
				if($color == '#') {
					$color = '';
				} else {
					$color = ' color: ' . $color . ';';
				}
			}
		} else {
			$color = '';
		}
		
		$style = '';
		if($color != '' || $size != '') {
			$style = ' style="' . $size . $color . '"';
		}
		
		return '<i class="fa fa-' . trim( $code ) . ' ' . ' ' . $alignment . ' ' . $extra_class . ' icon-shortcode"' . $style . '></i>';
	}

}


if( ! function_exists('uxbarn_register_dropcap_shortcode')) {
	
	function uxbarn_register_dropcap_shortcode($atts) {
		$default_atts = array(
							'style' => 'dark', 
							'character' => '',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		return '<span class="' . $style . ' dropcap">' . $character . '</span>';
	}
	
}


if( ! function_exists('uxbarn_register_highlight_shortcode')) {
	
	function uxbarn_register_highlight_shortcode($atts, $content = null) {
		$default_atts = array(
							'style' => 'dark',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		return '<span class="' . $style . ' highlight">' . $content . '</span>';
	}

}


if( ! function_exists('uxbarn_register_divider_shortcode')) {
	
	function uxbarn_register_divider_shortcode($atts) {
		$default_atts = array(
							'style' => 'thin', 
							'extra_class' => '',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		$style = str_replace('_', ' ', $style);
		
		return '<hr class="' . $style . ' ' . $extra_class . ' divider" />';
	}
	
}


if( ! function_exists('uxbarn_register_gallery_shortcode')) {

	function uxbarn_register_gallery_shortcode($atts) {
		$default_atts = array(
							'images' => '',
							'type' => 'grid', // grid, slider
							'style' => 'gallery1', // gallery1, gallery2 (only for grid type)
							'size' => 'full',
							'columns' => 'col4', // 3, 4, 5 (only for grid type)
							'link' => 'lightbox', // lightbox, link-window, none
							'auto_rotation_duration' => 'disabled',
							'extra_class' => '',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		
		$gallery_id = 'gallery_id_' . rand(0, 100000);
		$images = explode(',', $images);
		
		$output = '';
		
		$lightbox_class = '';
		if($link == 'lightbox') {
			//wp_enqueue_style('uxbarn-fancybox');
			//wp_enqueue_script('uxbarn-fancybox');
			$lightbox_class = ' class="image-box" rel="' . $gallery_id . '" ';
		}

		$target = '';
		if($link == 'link-window') {
			$target = ' target="_blank" ';
		}
		
		if($type == 'grid') { // grid type
			
			$output .= '<div class="' . $style . '-wrapper ' . $columns . ' ' . $extra_class . '">';
			
			$col_num = preg_replace('/[^\d]/', '', $columns); // get only number
			
			foreach($images as $attachment_id) {
				
				$attachment = uxbarn_get_attachment($attachment_id);

				$img_tag = wp_get_attachment_image($attachment_id, $size);
				//$alt = trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ));
				$title = $attachment['title'];
				
				if($title != '') {
					$title = ' title="' . $title . '" ';
				}
				
				$output .= '<div class="gallery-item-wrapper">
							<div class="gallery-item">';
				
				if($link == 'none') {
					$output .= $img_tag;
				} else {
					// Got an array [0] => url, [1] => width, [2] => height
					$img_fullsize = wp_get_attachment_image_src($attachment_id, 'full');
					
					$output .= '<a href="' . $img_fullsize[0] . '"' . $lightbox_class . $target . $title . '>' . $img_tag . '</a>';
					
				}
				
				$output .= '</div>'; // close "gallery-item"
				
				if($attachment['caption'] != '') {
					$output .= '<div class="image-caption">' . $attachment['caption'] . '</div>';
				}
				
				$output .= '</div>'; // close "gallery-item-wrapper"
					
			}
			
			$output .= '</div>'; // close "gallery-x-wrapper"
		
		} else { // slider type
			
			// Load required script (moved to functions.php)
			//wp_enqueue_script('uxbarn-carouFredSel');
			
			$output .= '<div class="image-slider-wrapper">';
			$output .= '<div class="image-slider" data-auto-rotation="' . $auto_rotation_duration . '">';
			
			foreach($images as $attachment_id) {
				
				$attachment = uxbarn_get_attachment($attachment_id);
			   
				$img_fullsize = $attachment['src']; 
				
				// Get an array: [0] => url, [1] => width, [2] => height
				$img_thumbnail = wp_get_attachment_image_src($attachment_id, $size);
				
				$title = $attachment['title']; //trim(esc_attr(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )));
				
				$anchor_title = '';
				if($title != '') {
					$anchor_title = ' title="' . $title . '" ';
				}
				
				
				// $output .= '<div class="image-slider-item" style="width: ' . $img_thumbnail[1] . 'px;">';
				
				
				/*if($size == 'full') {
					$output .= '<div class="image-slider-item" style="width: ' . $img_thumbnail[1] . 'px;">';
				} else {
					$output .= '<div class="image-slider-item" style="width: ' . $img_thumbnail[1] . 'px; height: ' . $img_thumbnail[2] . 'px;">';
				}*/
				
				// Don't need to apply "width" or "height" here, it's aleady done in css for 100% width.
				$output .= '<div class="image-slider-item">';
				
				$img_class = '';
				/*$stretch_img_class = '';
				if($stretch_image != '' ) {
					$stretch_img_class = ' stretch-image ';
					$img_class = ' class="' . $stretch_img_class . '" ';
				}*/
				
				$img_tag = '<img src="' . $img_thumbnail[0] . '" ' . $img_class . ' alt="' . $attachment['alt'] . '" width="' . $img_thumbnail[1] . '" height="' . $img_thumbnail[2] . '" />';
				
				if($link == 'none') {
					$output .= $img_tag;
					
				} else {
					
					$output .= '<a href="' . $img_fullsize . '"' . $lightbox_class . $target . $anchor_title . '>' . $img_tag . '</a>';
				}
				
				if(trim($attachment['caption']) != '') {
					$output .= '<div class="image-caption">' . $attachment['caption'] . '</div>';
				}
				
				$output .= '</div>'; // close "image-slider-item"
				
			}
			
			$output .= '</div>'; // close "image-slider"
			$output .= 
					'<div class="image-slider-controller">
						<a href="#" class="image-slider-prev"><i class="fa fa-angle-left"></i></a>
						<a href="#" class="image-slider-next"><i class="fa fa-angle-right"></i></a>
					</div>';
			$output .= '</div>'; // close "image-slider-wrapper"
			
		}

		return $output;
	}

}


if( ! function_exists('uxbarn_register_portfolio_shortcode')) {
	
	function uxbarn_register_portfolio_shortcode($atts) {
		$default_atts = array(
							'categories' => '',
							'max_item' => '',
							'display_desc' => 'true', // true, ''
							'title' => '', 
							'desc' => '',
							'display_line' => 'true', // true, ''
							'button_style' => 'angle-default', // no-angle-default, no-angle-bottom, angle-default, angle-bottom, none
							'button_text' => __('View all projects', 'uxbarn'),
							'button_url' => '',
							'columns' => 'col4', // 3, 4
							'category_filter_style' => 'none', // outside, inside, none
							'order_by' => 'ID',
							'order' => 'ASC',
							'extra_class' => '',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		if(trim($categories) == '') {
			return '<div class="error box">' . __('Cannot generate Portfolio shortcode. Categories must be defined.', 'uxbarn') . '</div>';
		}
		
		$category_id_list = explode(',', $categories);
		
		// If WPML is active, get translated category's ID
		if(function_exists('icl_object_id')) {
			
			$wpml_cat_list = array();
			
			foreach($category_id_list as $cat_id) {
				$wpml_cat_list[] = icl_object_id($cat_id, 'portfolio-category', false, ICL_LANGUAGE_CODE);
			}
			
			$category_id_list = $wpml_cat_list;
		}
		
		$max_item = trim($max_item);
		$title = trim($title);
		$desc = trim($desc);
		$button_text = trim($button_text);
		$button_url = trim($button_url);
		
		// Load required scripts (moved to functions.php)
		/*wp_enqueue_script('uxbarn-hoverdir');
		wp_enqueue_style('uxbarn-isotope');
		wp_enqueue_script('uxbarn-isotope');*/
		
		$portfolio_filter_id = 'portfolio-filter_' . rand(0, 100000);
		$portfolio_id = 'portfolio_' . rand(0, 100000);
		$desc_box_id = 'portfolio-desc_' . rand(0, 100000);
		$first_item_id = 'portfolio-first-item_' . rand(0, 100000);
		$first_item_id_set = ' id="' . $first_item_id . '" ';
		
		$animationEngine = '';
		$windowResizeCode = '$(window).resize(function(){
			
				$(container).find(".portfolio-item").css("height", "auto" );
				var firstItemHeight = $("#' . $first_item_id . '").height();
				$("#' . $desc_box_id . '").css("height", firstItemHeight );
				$(container).find(".portfolio-item").css("height", firstItemHeight );
				
				$grid = $(container).isotope({
					// update columnWidth to a percentage of container width
					masonry: { columnWidth: $("#' . $first_item_id . '").width(), }
				});
				
				$grid.isotope("layout");
				
			});';
		if(uxbarn_is_old_android()) { // If it's old Android, use jquery animation instead of default css
			$animationEngine = 'animationEngine : "jquery",';
			$windowResizeCode = '';
		}
		
		$output = '<script>
					/* <![CDATA[ */
					jQuery(document).ready(function($) {';
		$output .= 
			'var container = $("#' . $portfolio_id . '");
			 var firstItem = container.find(".portfolio-item:not(.fixed-box)").filter(":first");
			 var colNum = parseInt($(container).attr("data-col"));
			 
			$(container).imagesLoaded(function() {
				
				$(container).find(".portfolio-item").css("height", "auto" );
				var firstItemHeight = $("#' . $first_item_id . '").height();
				$("#' . $desc_box_id . '").css("height", firstItemHeight );
				$(container).find(".portfolio-item").css("height", firstItemHeight );
				
				$grid = $(container).isotope({
					resizable: false, // disable normal resizing
					itemSelector : ".portfolio-item",
					' . $animationEngine . '
					masonry: {
						columnWidth: $("#' . $first_item_id . '").width(),
					}
				});
				$(container).parents(".portfolio-root-wrapper").find(".loading-text").css("display", "none");
				$(container).parents(".portfolio-loaded-wrapper").stop().animate({
					"opacity" : 1,
				}, 800);
				
				$grid.isotope("layout");
			});    
			$("#' . $portfolio_filter_id . '").change(function() {
				var selector = $(this).val();
				$grid = $(container).isotope({
					filter : selector + ", .fixed-box"
				});
				$grid.isotope("layout");
				return false;
			});
			' . $windowResizeCode . '
			});
			/* ]]> */
			</script>';
		
		
		// Prepare category filter to be used later
		//<span class="select-cat-text">' . __('Select categories:', 'uxbarn') . '</span>
		
		$filter_string = '<p>
						<form class="portfolio-filter-wrapper custom">
							<select id="' . $portfolio_filter_id . '" class="portfolio-filter medium ' . ($category_filter_style == 'outside' ? 'outside' : '') . '">
								<option selected="selected" value="*">' . __('All Categories', 'uxbarn') . '</option>';
		$terms_args = array(
			'include' => $category_id_list,
			'orderyby' => 'menu_order',
		);
		$terms = get_terms('portfolio-category', $terms_args);
		if ($terms && ! is_wp_error($terms))  {
			foreach ($terms as $term) {
				$filter_string .= '<option value=".term_' . $term->term_id . '">' . $term->name . '</option>';
			}
		}
		$filter_string .=  '</select>
							</form>
						</p>';                        

		
		if(!is_numeric($max_item)) {
			$max_item = '';
		}
		
		if($max_item == '') {
			$args = array(
				'post_type' => 'portfolio',
				'nopaging' => true,
				'tax_query' => array(
									array(
									'taxonomy' => 'portfolio-category',
									'field' => 'id',
									'terms' => $category_id_list,
									),
								),
				'orderby' => $order_by,
				'order' => $order,
			);
			
		} else {
			
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => $max_item,
				'tax_query' => array(
									array(
									'taxonomy' => 'portfolio-category',
									'field' => 'id',
									'terms' => $category_id_list,
									),
								),
				'orderby' => $order_by,
				'order' => $order,
			);
			
		}
		
		
		$portfolio = new WP_Query($args);
		
		$output .= '<div class="portfolio-root-wrapper ' . $columns . ' ' . $extra_class . '">';
		
		$output .= '<span class="loading-text">' . __('Loading portfolio ...', 'uxbarn') . '</span>';
		
		$output .= '<div class="portfolio-loaded-wrapper">';
		
		if($category_filter_style == 'outside') {    
			$output .= $filter_string;
		}
		
		
		
		$output .= '<div id="' . $portfolio_id . '" class="portfolio-wrapper ' . $columns . '">';
		
		// Description box
		if($display_desc == 'true') {
			
			if($title != '') {
				$title = '<h2 class="smaller description-title">' . $title . '</h2>';
			} else {
				$title = '';
			}
			
			if($desc != '') {
				$desc = '<p class="description">' . $desc . '</p>';
			} else {
				$desc = '';
			}
			
			$output .= 
			'<div id="' . $desc_box_id . '" class="portfolio-item fixed-box' . ($display_line == 'true' ? ' bottom-line ' : '') . '">
				' . $title . $desc;
			
			if($category_filter_style == 'inside') {    
				$output .= $filter_string;
			}
			
			// Button 
			if($button_style != 'none') { // no-angle-default, no-angle-bottom, angle-default, angle-bottom
				if($button_style == 'no-angle-default') {
					$output .= '<a href="' . $button_url . '" class="flat button">' . $button_text . '</a>';
				} else if($button_style == 'no-angle-bottom') {
					$output .= '<a href="' . $button_url . '" class="bottom-right flat button">' . $button_text . '</a>';
				} else if($button_style == 'angle-default') {
					$output .= '<a href="' . $button_url . '" class="angle flat button">' . $button_text . '<span class="angle"><i class="fa fa-angle-right"></i></span></a>';
				} else {
					$output .= '<a href="' . $button_url . '" class="bottom-right angle flat button">' . $button_text . '<span class="angle"><i class="fa fa-angle-right"></i></span></a>';
				}
			}

			$output .= '</div>'; // close "portfolio-item fixed-box"
		}
		
		$i = 0;
		
		// Generate grid columns
		if($portfolio->have_posts()) {
			while($portfolio->have_posts()) {
				$portfolio->the_post();
				
				$term_list = '';
				$terms = get_the_terms(get_the_ID(), 'portfolio-category');
				
				if ($terms && ! is_wp_error($terms))  {
					foreach ($terms as $term) {
						$term_list .= 'term_' . $term->term_id . ' ';
					}
				}
				
				$thumbnail = '';
				if(has_post_thumbnail(get_the_ID())) {
					$thumbnail = get_the_post_thumbnail(get_the_ID(), 'large-square');
				} else {
					$thumbnail = '<img src="' . IMAGE_PATH . '/placeholders/large-square.gif" alt="' . __('No Thumbnail', 'uxbarn') . '" />';
				}
				
				if($i > 0) {
					$first_item_id_set = '';
				}
				
				$output .= '<div ' . $first_item_id_set . ' class="' . $term_list . ' portfolioid-' . get_the_ID() . ' portfolio-item">
								<div class="portfolio-item-hover">
									<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
									
				if ($terms && ! is_wp_error($terms))  {
					$output .= '<ul>';
					foreach ($terms as $term) {
						$output .= '<li><a href="' . get_term_link(intval($term->term_id), $term->taxonomy) . '">' . $term->name . '</a></li>';
					}
					$output .= '</ul>';
				}
				$output .= '</div>' . $thumbnail . '</div>';
				$i++;
			}
		}
		wp_reset_postdata();
		
		$output .= '</div>'; // close "portfolio-wrapper"
		$output .= '</div>'; // close "portfolio-loaded-wrapper"
		$output .= '</div>'; // close "portfolio-root-wrapper"
		
		return $output;
		
	}

}


if( ! function_exists('uxbarn_register_team_member_shortcode')) {
	
	function uxbarn_register_team_member_shortcode($atts) {
		$default_atts = array(
							'member_id' => '', // Name|ID
							'image_size' => 'full', 
							'link' => 'true', // true, false
							'heading_size' => 'large',
							'display_social' => 'true', // true, false
							'css_animation' => '',
							'extra_class' => '',
						);              
		
		extract(shortcode_atts($default_atts, $atts));
		
		if($member_id != '') {
			
			$member_id = explode('|', $member_id);
			$member_id = $member_id[1];
				
			// If WPML is active, get translated ID
			if( function_exists( 'icl_object_id' ) && is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
				
				$member_id = icl_object_id($member_id, 'team', false, ICL_LANGUAGE_CODE);
				// If the returned ID is NULL (meaning no translated post), return empty string.
				if(!isset($member_id)) {
					return '';
				}
				
			}
			
			
			$thumbnail ='';
			if(has_post_thumbnail($member_id)) {
				$thumbnail = get_the_post_thumbnail($member_id, $image_size);
			}
			$name = get_the_title($member_id);
			if($link == 'true') {
				$thumbnail = '<a href="' . get_permalink($member_id) . '">' . $thumbnail . '</a>';
				$name = '<a href="' . get_permalink($member_id) . '">' . $name . '</a>';
			}
			
			$position = uxbarn_get_translated_text_from_qTranslate(uxbarn_get_array_value(get_post_meta($member_id, 'uxbarn_team_meta_info_position'), 0));
			
			$excerpt = uxbarn_get_translated_text_from_qTranslate(uxbarn_get_array_value(get_post_meta($member_id, 'uxbarn_team_excerpt'), 0));
			
			$heading_name = 'h2';
			$heading_position = 'h3';
			if($heading_size == 'small') {
				$heading_name = 'h3';
				$heading_position = 'h4';
			}
			
			$css_animation = uxb_team_get_css_animation_complete_class( $css_animation );
			
			$output = '<div class="team-member ' . $extra_class . ' ' . $css_animation . ' teamid-' . $member_id . '">';
			$output .= '
				<div class="team-member-thumbnail">
					' . $thumbnail . '
				</div>
				<div class="team-member-info">
					<' . $heading_name . ' class="member-name">' . $name . '</' . $heading_name . '>
					<' . $heading_position . ' class="light">' . $position . '</' . $heading_position . '>
					<p class="description">
						' . $excerpt . '
					</p>';
				
			if($display_social == 'true') {
				
				$social_list_item_string = uxbarn_get_member_social_list_string($member_id);
				
				if($social_list_item_string != '') {
					$output .= '<ul class="team-social">' . $social_list_item_string . '</ul>';
				}
			}
			
			$output .= '</div>'; // close "team-member-info"
			$output .= '</div>'; // close "team-member"
			
			return $output;
			
		} else { // If no member selected
			return '';
		}
		
	} 
	
}


if( ! function_exists('uxbarn_register_cta_box_shortcode')) {
	
	function uxbarn_register_cta_box_shortcode($atts, $content = null) {
		$default_atts = array(
							'display_button' => 'true',
							'button_position' => 'right',
							'button_text' => '',
							'link' => '',
							'open_new_window' => '',
							'button_color' => '',
							'button_custom_color' => '',
							'button_size' => '',
							'button_border' => '',
							'icon_code' => '',
							'extra_class' => '',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		
		$button_text = trim($button_text);
		$link = trim($link);
		$icon = trim($icon_code);
		
		$output = '<div class="cta-box ' . $extra_class . '">';
		
		$content_class = '';
		if($display_button == 'false' || $button_position == 'bottom') {
			$content_class = ' full-width ';
		}
		
		$output .= '<div class="cta-box-content ' . $content_class . '">' . $content . '</div>';
		
		if($display_button == 'true') {
			
			if($button_text == '') {
				$button_text = 'Button Text';
			}
			
			/*if(trim($link) == '' || trim($link) == 'http://' || trim($link) == '#') {
				$link = '#';
			} else {
				if(strpos($link,'http://') === false) {
					$link = 'http://' . $link;
				}
			}*/
			$link = uxbarn_get_sanitized_url($link);
			
			if($open_new_window == 'true') {
				$open_new_window = ' target="_blank"';
			} else {
				$open_new_window = '';
			}
			
			if(trim($icon) != '' && trim($icon) != 'icon-') {
				$icon = '<i class="fa fa-' . trim( $icon ) . '"></i> ';
			} else {
				$icon = '';
			}
			
			$custom_color = '';
			if($button_color == 'custom') {
				$custom_color = ' style="background-color: ' . $button_custom_color . '" ';
			}
			
			$output .= '<div class="cta-box-button ' . $button_position . ' ' . $button_size . '">';
			
			$output .= '<a href="' . $link . '" ' . $open_new_window . ' class="' . $button_color . ' ' . $button_size . ' ' . $button_border . ' flat button" ' . $custom_color . '>' . $icon . ' ' . $button_text . '</a>';
			
			$output .= '</div>'; // close "cta-box-button"
		}
		
		$output .= '</div>'; // close "cta-box"
		
		return $output;
	}

}


if( ! function_exists('uxbarn_register_blog_posts_shortcode')) {
	
	function uxbarn_register_blog_posts_shortcode($atts, $content = null) {
		$default_atts = array(
							'blog_style' => 'grid', // grid, list, full 
							'categories' => '', // cat ids
							'max_item' => '', // max number of items to be displayed
							'thumbnail_style' => 'below', // below, above, none (for grid, full styles)
							'list_display_thumbnail' => 'true', // for "list" style
							'meta_info_display' => '', // mixed of "date author comment" classes
							'order_by' => 'ID',
							'order' => 'ASC',
							'extra_class' => '',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		if(trim($categories) == '') {
			return '<div class="error box">' . __('Cannot generate Blog Posts shortcode. Categories must be defined.', 'uxbarn') . '</div>';
		}
		
		
		$max_item = trim($max_item);
		$meta_info_display = explode(',', $meta_info_display);
					
		//$categories = explode(',', $categories);
		
		// If WPML is active, get translated category's ID
		/*if(function_exists('icl_object_id')) {
			
			$wpml_cat_list = array();
			
			foreach($categories as $cat_id) {
				$wpml_cat_list[] = icl_object_id($cat_id, 'category', false, ICL_LANGUAGE_CODE);
			}
			
			$categories = $wpml_cat_list;
		}*/
		
		$args = array(); 
		if($max_item == '') {
			$args = array(
				'post_type' => 'post',
				'nopaging' => true,
				'cat' => $categories,
				//'category__in' => $categories,
				'orderby' => $order_by,
				'order' => $order,
			);
			
		} else {
			if(!is_numeric($max_item)) {
				$max_item = 3;
			}
			
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $max_item,
				'cat' => $categories,
				//'category__in' => $categories,
				'orderby' => $order_by,
				'order' => $order,
			);
		}
		
		$custom_posts = new WP_Query($args);
		
		$output = '<div class="uxb_blog_posts ' . $extra_class . '">';
		$row_run = 1;
		$col_run = 1;
		$post_run = 1;
		
		if($custom_posts->have_posts()) {
			while($custom_posts->have_posts()) {
				$custom_posts->the_post();
				
				$date = get_the_time(get_option('date_format'));
				
				if($blog_style == 'grid') { // Grid style
				
					$excerpt = uxbarn_get_translated_text_from_qTranslate(uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_post_excerpt'), 0));
					if(trim($excerpt) != '') {
						$excerpt = uxbarn_the_excerpt_max_charlength($excerpt, 140);
					} else {
						/*$excerpt = uxbarn_the_excerpt_max_charlength(
											strip_shortcodes(preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', get_the_content())), 
											140);*/
						$excerpt = uxbarn_the_excerpt_max_charlength( get_the_excerpt(), 140 );
					}
					
					// ITEM BOX METHOD
					if($row_run == 1 && $col_run == 1) { // first item, display as "large-6"
						
						$date_code = '';
						$author_code = '';
						$comment_code = '';
						
						if(in_array('date', $meta_info_display)) {
							$date_code = '<span class="date">' . $date . '</span>';
						}
						
						if(in_array('author', $meta_info_display)) {
							$author_code = '<li><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a></li>';
						}
						
						if(in_array('comment', $meta_info_display)) {
								
							$comment_code = '<li><a href="' . get_comments_link() . '">' . uxbarn_get_comment_count_text(get_comments_number()) . '</a></li>';
						}
						
						$hr = '';
						if($date_code != '' || $author_code != '' || $comment_code != '') {
							$hr = '<hr />';
						}
					
						$info_code = 
								'<div class="info height-255">
									<div class="blog-meta">
										' . $date_code . '
										<ul class="author-comments">
											' . $author_code . $comment_code . '
										</ul>
									</div>
									' . $hr . '
									<h4 class="blog-title"><a href="' . get_permalink() . '">' . uxbarn_trim_string(get_the_title(), 70) . '</a></h4>
									<div class="excerpt">' . $excerpt . '</div>
								</div>';
						$thumbnail_code = '<div class="thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'rectangle') . '</a></div>';
					
						if($thumbnail_style == 'below') {
							$output .= 
								'<div class="blog-item">
									' . $info_code . $thumbnail_code . '
								</div>';
						
						} else if($thumbnail_style == 'above') {
							$output .= 
								'<div class="blog-item">
									' . $thumbnail_code . $info_code . '
								</div>';
							
						} else {
							$output .= 
								'<div class="blog-item">
									' . $info_code . '
								</div>';
						}
							
					} else { // other normal items
					
						$date_code = '';
						if(in_array('date', $meta_info_display)) {
							$date_code = '<span class="date">' . $date . '</span>';
						}
						
						$hr = '';
						if($date_code != '') {
							$hr = '<hr />';
						}
					
						$info_code = 
								'<div class="info height-255">
									<div class="blog-meta">
										' . $date_code . '
									</div>
									' . $hr . '
									<h4 class="sub-blog-title"><a href="' . get_permalink() . '">' . uxbarn_trim_string(get_the_title(), 90) . '</a></h4>
								</div>';
						$thumbnail_code = '<div class="thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'large-square') . '</a></div>';
						
						if($thumbnail_style == 'below') {
							$output .= '
								<div class="sub-blog-item">
									' . $info_code . $thumbnail_code . '
								</div>';
								
						} else if($thumbnail_style == 'above') {
							$output .= '
								<div class="sub-blog-item">
									' . $thumbnail_code . $info_code . '
								</div>';
								
						} else {
							$output .= '
								<div class="sub-blog-item">
									' . $info_code . '
								</div>';
							
						}
					}
					
					$col_run += 1;
					// END: ITEM BOX METHOD
				

				} else if($blog_style == 'grid-2-cols') {
					$excerpt = uxbarn_get_translated_text_from_qTranslate(uxbarn_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_post_excerpt'), 0));
					if(trim($excerpt) != '') {
						$excerpt = uxbarn_the_excerpt_max_charlength($excerpt, 130);
					} else {
						/*$excerpt = uxbarn_the_excerpt_max_charlength(
											strip_shortcodes(preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', get_the_content())), 
											130);//uxbarn_the_excerpt_max_charlength(get_the_content(), 140);*/
						$excerpt = uxbarn_the_excerpt_max_charlength( get_the_excerpt(), 130 );
					}    
				
					$date_code = '';
					$author_code = '';
					$comment_code = '';
					
					if(in_array('date', $meta_info_display)) {
						$date_code = '<span class="date">' . $date . '</span>';
					}
					
					if(in_array('author', $meta_info_display)) {
						$author_code = '<li><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a></li>';
					}
					
					if(in_array('comment', $meta_info_display)) {
							
						$comment_code = '<li><a href="' . get_comments_link() . '">' . uxbarn_get_comment_count_text(get_comments_number()) . '</a></li>';
					}
					
					$hr = '';
					if($date_code != '' || $author_code != '' || $comment_code != '') {
						$hr = '<hr />';
					}
				
					$info_code = 
							'<div class="info height-255">
								<div class="blog-meta">
									' . $date_code . '
									<ul class="author-comments">
										' . $author_code . $comment_code . '
									</ul>
								</div>
								' . $hr . '
								<h4 class="blog-title"><a href="' . get_permalink() . '">' . uxbarn_trim_string(get_the_title(), 70) . '</a></h4>
								<div class="excerpt">' . $excerpt . '</div>
							</div>';
					$thumbnail_code = '<div class="thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'rectangle') . '</a></div>';
				
					if($thumbnail_style == 'below') {
						$output .= 
							'<div class="blog-item">
								' . $info_code . $thumbnail_code . '
							</div>';
					
					} else if($thumbnail_style == 'above') {
						$output .= 
							'<div class="blog-item">
								' . $thumbnail_code . $info_code . '
							</div>';
						
					} else {
						$output .= 
							'<div class="blog-item">
								' . $info_code . '
							</div>';
					}
					
				} else if($blog_style == 'list') { // List style
					
					$thumbnail_code = '';
					$thumbnail_class = '';
					if($list_display_thumbnail == 'true') {
						$thumbnail_code = 
							'<div class="blog-item-list-style-thumbnail-wrapper">
								<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'small-square') . '</a>
							</div>';
					} else {
						$thumbnail_class = 'no-thumbnail';
					}
					
					$date_code = '';
					if(in_array('date', $meta_info_display)) {
						$date_code = '<span class="date">' . $date . '</span>';
					}
					
					$author_code = '';
					if(in_array('author', $meta_info_display)) {
						$author_code = '<span class="author"><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a></span>';
					}

					$comment_code = '';
					if(in_array('comment', $meta_info_display)) {
						$comment_code = '<span class="comment"><a href="' . get_comments_link() . '">' . uxbarn_get_comment_count_text(get_comments_number()) . '</a></span>';
					}
					
					$output .= 
						'<div class="blog-item-list-style-wrapper">
							' . $thumbnail_code . '
							<div class="blog-item-list-style-title-wrapper ' . $thumbnail_class . '">
								<h4 class="blog-item-list-style-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
								<div class="meta">' . $date_code . $author_code . $comment_code . '</div>
							</div>
						</div>';
					
				}
				
				
			}
		}
		wp_reset_postdata();
		
		$output .= '</div>'; // close "uxb_blog_posts"
		
		return $output;
		
	}
	
}
 
 
if( ! function_exists('uxbarn_register_shortcode_generator_button')) {
	
	function uxbarn_register_shortcode_generator_button() {
		// Allow only valid permission
		if (!current_user_can('edit_posts') && ! current_user_can('edit_pages'))
			return;
		
		if (get_user_option('rich_editing') == 'true') {
			add_filter('mce_external_plugins', 'uxbarn_add_tinymce_plugin');
			add_filter('mce_buttons', 'uxbarn_finalize_shortcode_generator_button');
		}
	}
	
}


if( ! function_exists('uxbarn_add_tinymce_plugin')) {
	
	function uxbarn_add_tinymce_plugin($plugin_array) {
		
		//echo var_dump(get_current_screen());
		
		$page = get_current_screen();
		
		// When opending VC modal, bypass checking the page
		if(!isset($page)) {
			return $plugin_array;
		}
		
		if($page->base == 'post' || 
			$page->base == 'post-new') {
		
			$plugin_array['uxbarn_home_shortcode_generator_button'] = get_template_directory_uri() . '/includes/shortcodes/scripts/generator.js';
			return $plugin_array;
		
		} else {
			return $plugin_array;
		}
	}
	
}


if( ! function_exists('uxbarn_finalize_shortcode_generator_button')) {
	
	function uxbarn_finalize_shortcode_generator_button($buttons) {
		// ux_shortcode_generator_button = generator button's ID
		array_push($buttons, "|", "uxbarn_home_shortcode_generator_button");
		return $buttons;
	}

}


if( ! function_exists('uxbarn_get_css_animation_complete_class')) {
	
	function uxbarn_get_css_animation_complete_class($css_animation) {
		// Code copied from "/lib/shortcodes.php" of VC plugin v3.6.5. Function: getCSSAnimation()
		if($css_animation != '') {
			wp_enqueue_script( 'waypoints' );
			return ' wpb_animate_when_almost_visible wpb_'.$css_animation;
		} else {
			return '';
		}
		
	}
	
}
/*
function uxbarn_register_test_shortcode($atts, $content = null) {
		$default_atts = array(
							'test' => '',
						);              
		extract(shortcode_atts($default_atts, $atts));
		
		$output = '<script type="text/javascript">
		
			jQuery(document).ready(function($) {
				
				$("body").css("background-color", "red");
				
			});
			
		</script>';
		
		return $output;
}
	
add_shortcode('test', 'uxbarn_register_test_shortcode');    */

add_shortcode('uxb_heading', 'uxbarn_register_heading_shortcode');
add_shortcode('uxb_button', 'uxbarn_register_button_shortcode');
add_shortcode('uxb_icon', 'uxbarn_register_icon_shortcode');
add_shortcode('uxb_video', 'uxbarn_register_video_shortcode');
add_shortcode('uxb_blockquote', 'uxbarn_register_blockquote_shortcode');
add_shortcode('uxb_messagebox', 'uxbarn_register_messagebox_shortcode');
add_shortcode('uxb_googlemap', 'uxbarn_register_googlemap_shortcode');
add_shortcode('uxb_testimonial_slider', 'uxbarn_register_testimonial_slider_shortcode');
add_shortcode('uxb_gallery', 'uxbarn_register_gallery_shortcode');
add_shortcode('uxb_portfolio', 'uxbarn_register_portfolio_shortcode');
add_shortcode('uxb_team_member', 'uxbarn_register_team_member_shortcode');
add_shortcode('uxb_divider', 'uxbarn_register_divider_shortcode');
add_shortcode('uxb_cta_box', 'uxbarn_register_cta_box_shortcode');
add_shortcode('uxb_blog_posts', 'uxbarn_register_blog_posts_shortcode');
add_shortcode('uxb_searchform', 'uxbarn_register_searchform_shortcode');

add_shortcode('uxb_dropcap', 'uxbarn_register_dropcap_shortcode');
add_shortcode('uxb_highlight', 'uxbarn_register_highlight_shortcode');

add_action('init', 'uxbarn_register_shortcode_generator_button');

