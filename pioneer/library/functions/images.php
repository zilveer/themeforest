<?php

/**************************************
** DEFINE IMAGE SIZES **
***************************************/

define('EPIC_FULLWIDTH_FEATURED_WIDTH', '900'); 	// Width of fullwidth images
define('EPIC_FULLWIDTH_WIDTH', '900'); 	// Width of fullwidth images
define('EPIC_REGULAR_WIDTH', '610');	// Width of regular post images ++
define('EPIC_SLIDER_REGULAR_WIDTH', '630');	// Width of regular post images ++
define('EPIC_430_WIDTH', '460');	// Width of regular post images ++
define('EPIC_280_WIDTH', '280');	// Width of regular post images ++
define('EPIC_210_WIDTH', '220');	// Width of regular post images ++

define('EPIC_FULLWIDTH_GALLERY_HEIGHT', get_option('epic_thumbnail_galleryfullwidth_image_height'));
define('EPIC_REGULAR_GALLERY_HEIGHT', 	get_option('epic_thumbnail_galleryregular_image_height'));
define('EPIC_SLIDER_FULLWIDTH_HEIGHT', 	get_option('epic_thumbnail_slideshowfullwidth_image_height'));
define('EPIC_SLIDER_REGULAR_HEIGHT', 	get_option('epic_thumbnail_slideshowregular_image_height'));
define('EPIC_THUMBNAIL_900_HEIGHT', 	get_option('epic_thumbnail_900_image_height'));
define('EPIC_THUMBNAIL_590_HEIGHT', 	get_option('epic_thumbnail_590_image_height'));
define('EPIC_THUMBNAIL_210_HEIGHT', 	get_option('epic_thumbnail_210_image_height'));
define('EPIC_THUMBNAIL_280_HEIGHT', 	get_option('epic_thumbnail_280_image_height'));
define('EPIC_THUMBNAIL_430_HEIGHT', 	get_option('epic_thumbnail_430_image_height'));
define('EPIC_THUMBNAIL_FEATURED_HEIGHT',get_option('epic_thumbnail_featured_image_height'));
        
        
add_image_size('Admin-thumbnail', 200, 0, false); 
        
if (function_exists('add_image_size') && get_option('epic_image_resize') == 'wordpress') {
           
    add_image_size('Thumbnail-galleryfullwidth', EPIC_FULLWIDTH_WIDTH, EPIC_FULLWIDTH_GALLERY_HEIGHT, true); // Fullwidth gallery image  
    add_image_size('Thumbnail-galleryregular', EPIC_REGULAR_WIDTH, EPIC_REGULAR_GALLERY_HEIGHT, true); // Default gallery image  
    add_image_size('Featured', EPIC_280_WIDTH, EPIC_THUMBNAIL_FEATURED_HEIGHT, true);
    add_image_size('Thumbnail-210', EPIC_210_WIDTH, EPIC_THUMBNAIL_210_HEIGHT, true); 
    add_image_size('Thumbnail-280', EPIC_280_WIDTH, EPIC_THUMBNAIL_280_HEIGHT, true); 
 	add_image_size('Thumbnail-430', EPIC_430_WIDTH, EPIC_THUMBNAIL_430_HEIGHT, true); 
 	add_image_size('Thumbnail-portfolio', 200, 9999, false); 
 	add_image_size('Featured-portfolio', EPIC_REGULAR_WIDTH, EPIC_THUMBNAIL_590_HEIGHT, false); 
 	add_image_size('Thumbnail-590', EPIC_REGULAR_WIDTH, EPIC_THUMBNAIL_590_HEIGHT, true); 
 	add_image_size('Thumbnail-900', EPIC_FULLWIDTH_WIDTH, EPIC_THUMBNAIL_900_HEIGHT, true);
 	add_image_size('Thumbnail-slideshowregular', EPIC_SLIDER_REGULAR_WIDTH, EPIC_SLIDER_REGULAR_HEIGHT, true); 
 	add_image_size('Thumbnail-slideshowfullwidth',  EPIC_FULLWIDTH_WIDTH, EPIC_SLIDER_FULLWIDTH_HEIGHT, true); 
 	add_image_size('Slider-thumbnail', 70, 40, true);
    add_image_size('Micro', 64, 40, true); 
    }
    

/* FUNCTION FOR INSERTING IMAGES 
===================================================*/

function epic_image($post_id,$size,$link){

	global $post;
	
	$out = '';
		
	if(!empty($link)){
		$out.= '<a href="'.get_permalink($post_id).'">';
	}
	
	if(get_option('epic_image_resize') == 'wordpress'){
	
		global $post;
		$out.= '<figure class="'.$size.'">';
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
		//$out.= '<img src="'.$thumbnail_src[0].'" />';
		$out.= get_the_post_thumbnail($post_id, $size);
		$out.= '</figure>';
		
	}
	
	if(get_option('epic_image_resize') == 'vt-resize'){
		
		global $post;
		/* $url =  wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ),'');
		$src = $url[0];
		$imageid = get_attachment_id_from_src($src);
		*/
		$imageid = get_post_thumbnail_id($post_id);
		$url =  wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ),'full');
		switch($size){
		
			case 'Thumbnail-590':
				
				$imagem = vt_resize( $imageid, '' , EPIC_REGULAR_WIDTH, EPIC_THUMBNAIL_590_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"   alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Thumbnail-900':
				
				$imagem = vt_resize( $imageid, '' , EPIC_FULLWIDTH_WIDTH, EPIC_THUMBNAIL_900_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"   alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Thumbnail-590':
				
				$imagem = vt_resize( $imageid, '' , EPIC_REGULAR_WIDTH, EPIC_THUMBNAIL_590_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"   alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Thumbnail-portfolio':
				
				$imagem = vt_resize( $imageid, '' , 280, 0, false );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"   alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Featured-portfolio':
				
				$imagem = vt_resize( $imageid, '' , EPIC_REGULAR_WIDTH, '0', false );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"   alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Thumbnail-430':
				
				$imagem = vt_resize( $imageid, '' , EPIC_430_WIDTH, EPIC_THUMBNAIL_430_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"   alt="'.$url[0].'"/></figure>';


			break;
			
			
			case 'Thumbnail-280':
				
				$imagem = vt_resize( $imageid, '' , EPIC_280_WIDTH, EPIC_THUMBNAIL_280_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"    alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Thumbnail-210':
				
				$imagem = vt_resize( $imageid, '' , EPIC_210_WIDTH, EPIC_THUMBNAIL_210_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"    alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Thumbnail-featured':
				
				$imagem = vt_resize( $imageid, '' , EPIC_280_WIDTH, EPIC_THUMBNAIL_FEATURED_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"   alt="'.$url[0].'"/></figure>';


			break;
			
	
			case 'Thumbnail-galleryregular':
				
				$imagem = vt_resize( $imageid, '' , EPIC_REGULAR_WIDTH, EPIC_REGULAR_GALLERY_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"  alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Thumbnail-galleryfullwidth':
				
				$imagem = vt_resize( $imageid, '' , EPIC_FULLWIDTH_WIDTH, EPIC_FULLWIDTH_GALLERY_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"  alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Thumbnail-slideshowregular':
				
				$imagem = vt_resize( $imageid, '' , EPIC_SLIDER_REGULAR_WIDTH, EPIC_SLIDER_REGULAR_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"    alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Slider-thumbnail':
				
				$imagem = vt_resize( $imageid, '' , 70, 40, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"   alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Thumbnail-slideshowfullwidth':
				
				$imagem = vt_resize( $imageid, '' , 900, EPIC_SLIDER_FULLWIDTH_HEIGHT, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"   alt="'.$url[0].'"/></figure>';


			break;
			
			case 'Micro':
				
				$imagem = vt_resize( $imageid, '' , 64, 64, true );
				$out.= '<figure class="'.$size.'"><img src="' . $imagem["url"] .'"  alt="'.$url[0].'"/></figure>';


			break;		
		}
		
				
		
		
	}
	
	if(get_option('epic_image_resize') == 'timthumb'){
	
	$url =  wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ),'full');
	
	switch($size){
	
	case 'Post-regular':
		
		$out.= '<figure class="'.$size.'"><img src="'. epic_image_resize($url[0], 580, EPIC_POST_REGULAR_HEIGHT, true).'" width="580" height="200" alt="'.$url[0].'"/></figure>';


	break;
	
	
	
	case 'Post-fullwidth':
	
		$out.= '<figure class="'.$size.'"><img src="';
		$out.= epic_image_resize($url[0], 900, EPIC_POST_FULLWIDTH_HEIGHT, true);
		$out.= '" width="960" height="'.EPIC_POST_FULLWIDTH_HEIGHT.'" alt="'.$url[0].'" /></figure>';

		
	break;
	
	
	case 'Slider':
	
		$out.= '<figure class="'.$size.'"><img src="';
		$out.= epic_image_resize($url[0], 900, EPIC_SLIDER_FULLWIDTH_HEIGHT, true);
		$out.= '" width="960" height="'.EPIC_SLIDER_FULLWIDTH_HEIGHT.'" alt="'.$url[0].'" /></figure>';
				
	break;
	
	case 'Slider-thumbnail':
	
		$out.= '<figure class="'.$size.'"><img src="';
		$out.= epic_image_resize($url[0], 160, 90, true);
		$out.= '" width="160" height="90" alt="'.$url[0].'" />';
				
	break;
	
		
	case 'Gallery-regular':
	
		$out.= '<figure class="'.$size.'"><img src="'.epic_image_resize($url[0], EPIC_POST_EXPANDED_WIDTH, 0, false).'"  alt="'.$url[0].'"/></figure>';
		
	break;
	
	case 'Gallery-fullwidth':
	
		$out.= '<figure class="'.$size.'"><img src="';
		$out.= epic_image_resize($url[0], 900, 0, false);
		$out.= '" width="960" alt="'.$url[0].'"/></figure>';
		
	break;
	
	case 'Thumbnail-210':
	
		$out.= '<figure class="'.$size.'"><img src="';
		$out.= epic_image_resize($url[0], 210, EPIC_THUMBNAIL_210_HEIGHT, true);
		$out.= '"   alt="'.$url[0].'"/><span class="overlay"></span></figure>';			

	break;
	
	case 'Thumbnail-280':
	
		$out.= '<figure class="'.$size.'"><img src="';
		$out.= epic_image_resize($url[0], 280, EPIC_THUMBNAIL_280_HEIGHT, true);
		$out.= '"   alt="'.$url[0].'"/><span class="overlay"></span></figure>';			

	break;
	
	case 'Micro':
	
		$out.= '<figure class="'.$size.'"><img src="';
		$out.= epic_image_resize($url[0], 60, 40, true);
		$out.= '" width="64" height="40"  alt="'.$url[0].'" /></figure>';

	break;

	}
	
}
	
	if(!empty($link)){
		$out.= '</a>';
	}
	
	return $out;
}


function epic_image_src($post_id,$size){

	$resizemethod = get_option('epic_image_resize');

	if( $resizemethod == 'wordpress'){
	
		$url =  wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ), $size);
		return $url[0];
	}
	
	
	else {
		//$url = vt_resize( $attachment->ID,'' , 110, 90 );
		$url =  wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ),'full');
		return $url[0];
	}
	
}
    
    



/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */
function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
	
	$file_path = null;
	$extension = '';
	$dirname = null; 
	$image_src = null;
	// this is an attachment, so we have the ID
	if ( $attach_id ) {
	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id );
	
	// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		
		$file_path = parse_url( $img_url );
		$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
		
		//$file_path = ltrim( $file_path['path'], '/' );
		//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
		
		$orig_size = getimagesize( $file_path );
		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	}
	
	$file_info = pathinfo( $file_path );
	$extension = '.'. $file_info['extension'];
	
	// the image path without the extension
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
	
	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {

			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
			
			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			
			return $vt_image;
		}

		// $crop = false
		if ( $crop == false ) {
		
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
			
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size[0],
					'height' => $proportional_size[1]
				);
				
				return $vt_image;
			}
		}

		// no cache files - let's finally resize it
		$new_img_path = image_resize( $file_path, $width, $height, $crop );
		$new_img_size = getimagesize( $new_img_path );
		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

		// resized output
		$vt_image = array (
			'url' => $new_img,
			'width' => $new_img_size[0],
			'height' => $new_img_size[1]
		);
		
		return $vt_image;
	}

	// default output - without resizing
	$vt_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	
	return $vt_image;
}?>