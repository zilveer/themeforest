<?php
	/*	
	*	Goodlayers Size Registered Function
	*	---------------------------------------------------------------------
	*	This file contains the script to register the thumbnail size used in 
	*	the theme, you can add / remove your own size here.
	*	
	*	reference : 
	*	crop mode difference :
	*	---------------------------------------------------------------------
	*/

	$gdlr_thumbnail_size = array(
		'post-thumbnail-size' => array('width'=>750, 'height'=>330, 'crop'=>true),
		'round-personnel-size' => array('width'=>400, 'height'=>400, 'crop'=>true),
		'small-grid-size' => array('width'=>400, 'height'=>300, 'crop'=>true),
		'portrait' => array('width'=>440, 'height'=>550, 'crop'=>true),
		'post-slider-side' => array('width'=>750, 'height'=>360, 'crop'=>true),
		'full-slider' => array('width'=>980, 'height'=>380, 'crop'=>true),
		'portfolio-portrait' => array('width'=>500, 'height'=>550, 'crop'=>true),
		'blog-grid' => array('width'=>700, 'height'=>400, 'crop'=>true),

		
		//add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	);
	$gdlr_thumbnail_size = apply_filters('gdlr-thumbnail-size', $gdlr_thumbnail_size);
	
	// create the size from gdlr_thumbnail_size variable
	add_action( 'after_setup_theme', 'gdlr_register_thumbnail_size' );
	if( !function_exists('gdlr_register_thumbnail_size') ){
		function gdlr_register_thumbnail_size(){
			add_theme_support( 'post-thumbnails' );
		
			global $gdlr_thumbnail_size;		
			foreach($gdlr_thumbnail_size as $gdlr_size_slug => $gdlr_size){
				add_image_size($gdlr_size_slug, $gdlr_size['width'], $gdlr_size['height'], $gdlr_size['crop']);
			}
		}
	}
	
	// add the image size filter to admin option
	add_filter('image_size_names_choose', 'gdlr_set_custom_size_image');
	if( !function_exists('gdlr_set_custom_size_image') ){
		function gdlr_set_custom_size_image( $sizes ){	
			$additional_size = array();
			
			global $gdlr_thumbnail_size;
			foreach($gdlr_thumbnail_size as $gdlr_size_slug => $gdlr_size){
				$additional_size[$gdlr_size_slug] = $gdlr_size_slug;
			}
			
			return array_merge($sizes, $additional_size);
		}
	}		
	
	// get all available image sizes
	if( !function_exists('gdlr_get_thumbnail_list') ){
		function gdlr_get_thumbnail_list(){
			global $gdlr_thumbnail_size, $_wp_additional_image_sizes;
			
			$sizes = array();
			foreach( get_intermediate_image_sizes() as $size ){
				if(in_array( $size, array( 'thumbnail', 'medium', 'large' )) ){
					$sizes[$size] = $size . ' -- ' . get_option($size . '_size_w') . 'x' . get_option($size . '_size_h');
				}else if( !empty($gdlr_thumbnail_size[$size]) ){
					$sizes[$size] = $size . ' -- ' . $gdlr_thumbnail_size[$size]['width'] . 'x' . $gdlr_thumbnail_size[$size]['height'];
				}
				//else{
				//	if( isset($_wp_additional_image_sizes) && isset($_wp_additional_image_sizes[$s]) ){
				//		$sizes[$size] = $size . ' -- ' . $_wp_additional_image_sizes[$size]['width'] . 'x' . $_wp_additional_image_sizes[$size]['height'];
				//	}
				//}
			}
			$sizes['full'] = __('full size (Original Images)', 'gdlr_translate');
			
			return $sizes;
		}	
	}
	
	// video size 
	if( !function_exists('gdlr_get_video_size') ){
		function gdlr_get_video_size( $size ){
			global $_wp_additional_image_sizes, $theme_option, $gdlr_crop_video;

			// get video ratio
			if( !empty($theme_option['video-ratio']) && 
				preg_match('#^(\d+)[\/:](\d+)$#', $theme_option['video-ratio'], $number)){
				$ratio = $number[1]/$number[2];
			}else{
				$ratio = 16/9;
			}
			
			// get video size
			$video_size = array('width'=>620, 'height'=>9999);
			if( !empty($size) && is_numeric($size) ){
				$video_size['width'] = intval($size);
			}else if( !empty($size) && !empty($_wp_additional_image_sizes[$size]) ){
				$video_size = $_wp_additional_image_sizes[$size];
			}else if( !empty($size) && in_array($size, get_intermediate_image_sizes()) ){
				$video_size = array('width'=>get_option($size . '_size_w'), 'height'=>get_option($size . '_size_h'));
			}

			// refine video size
			if( $gdlr_crop_video || $video_size['height'] == 9999 ){
				return array('width'=>$video_size['width'], 'height'=>intval($video_size['width'] / $ratio));
			}else if( $video_size['width'] == 9999 ){
				return array('width'=>intval($video_size['height'] * $ratio), 'height'=>$video_size['height']);
			}
			return $video_size;
		}	
	}	
