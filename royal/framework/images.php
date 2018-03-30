<?php 

// **********************************************************************// 
// ! Function to get post image
// **********************************************************************//  

function etheme_get_image( $attachment_id = 0, $width = null, $height = null, $crop = true, $post_id = null, $get_sizes = false ) {
	global $post;
	if (!$attachment_id) {
		if (!$post_id) {
			$post_id = $post->ID;
		}
		if ( has_post_thumbnail( $post_id ) ) {
			$attachment_id = get_post_thumbnail_id( $post_id );
		} 
		else {
			$attached_images = (array)get_posts( array(
				'post_type'   => 'attachment',
				'numberposts' => 1,
				'post_status' => null,
				'post_parent' => $post_id,
				'orderby'     => 'menu_order',
				'order'       => 'ASC'
			) );
			if ( !empty( $attached_images ) )
				$attachment_id = $attached_images[0]->ID;
		}
	}
	
	if (!$attachment_id)
		return;
		
	$image_url = etheme_get_resized_url($attachment_id,$width, $height, $crop, $get_sizes);
	
	return apply_filters( 'et_product_image', $image_url );
}

// **********************************************************************// 
// ! Get all images uploaded to posts
// **********************************************************************//  

function etheme_get_images($width = null, $height = null, $crop = true, $post_id = null ) {
	global $post;
	
	if (!$post_id) {
		$post_id = $post->ID;
	}	
	
	if ( has_post_thumbnail( $post_id ) ) {
		$attachment_id = get_post_thumbnail_id( $post_id );
	} 
	
	$args = array(
	    'post_type' => 'attachment',
	    'post_status' => null,
	    'post_parent' => $post_id,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'exclude' => get_post_thumbnail_id( $post_id )
	);
	
	$attachments = get_posts($args);
	
	if (empty( $attachments) && empty($attachment_id))
		return;
		
	$image_urls = array();
	
	if(!empty($attachment_id))
		$image_urls[] = etheme_get_resized_url($attachment_id,$width, $height, $crop);
		
	foreach($attachments as $one) {
		$image_urls[] = etheme_get_resized_url($one->ID,$width, $height, $crop);
	}

	return apply_filters( 'blanco_attachment_image', $image_urls );
}

function etheme_get_resized_url($id,$width, $height, $crop, $get_sizes = false) {
	if ( function_exists("gd_info") && (($width >= 10) && ($height >= 10)) && (($width <= 1024) && ($height <= 1024)) ) {
		$vt_image = vt_resize( $id, '', $width, $height, $crop );
		if ($vt_image)  {
			if ($get_sizes) {
				$image_url = $vt_image;
			} else {
				$image_url = $vt_image['url'];
			}
		}
		else
			$image_url = false;
	}
	else {
		$full_image = wp_get_attachment_image_src( $id, 'full');
		if (!empty($full_image[0]))
			$image_url = $full_image[0];
		else
			$image_url = false;
	}
	
    if( is_ssl() && !strstr(  $image_url, 'https' ) ) str_replace('http', 'https', $image_url);
    
    return $image_url;
}


if ( !function_exists('vt_resize') ) {
	function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false) {
	

		// this is an attachment, so we have the ID
		if ( $attach_id ) {
		
			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$file_path = get_attached_file( $attach_id );
		
		// this is not an attachment, let's use the image url
		} else if ( $img_url ) {

			
			$file_path = parse_url( $img_url );
			$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
			
			if(is_multisite()) $file_path = et_trim_multisite_folder($file_path);

			//$file_path = ltrim( $file_path['path'], '/' );
			//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
			
			$orig_size = @getimagesize( $file_path );
			
			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}
		
		$file_info = pathinfo( $file_path );
	
		// check if file exists
		$base_file = $file_info['dirname'].'/'.$file_info['filename'].'.'.$file_info['extension'];
		if ( !file_exists($base_file) )
			return;
		 
		$extension = '.'. $file_info['extension'];
	
		// the image path without the extension
		$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
		
		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return
		if ( $image_src[1] > $width || $image_src[2] > $height ) {
	
			if ( $crop == true ) {
			
				$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;
				
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
			}
			elseif ( $crop == false ) {
			
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
	
			// check if image width is smaller than set width
			$img_size = getimagesize( $file_path );
			if ( $img_size[0] <= $width ) $width = $img_size[0];		
	
			// no cache files - let's finally resize it
			//$new_img_path = image_resize( $file_path, $width, $height, $crop );

			$image = wp_get_image_editor( $file_path );
			if ( ! is_wp_error( $image ) ) {
			    $image->resize( $width, $height, $crop );
			    $new_img_path = $image->save();
			    $new_img_path = $new_img_path['path'];
			} else{
				$new_img_path = $file_path;
			}

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
	}
}



if(!function_exists('et_trim_multisite_folder')) {
	/* function remove unnecessary multisite folder from url path */
	function et_trim_multisite_folder($path) {

		$upload_dir = wp_upload_dir();

		$path = explode('wp-content/', $path);

		$uploads_path = explode('uploads', $upload_dir['basedir']);

		return $uploads_path[0] . '/' . $path[1];
	}
}


if(!function_exists('et_resize')) {
	function et_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
		if( !$attach_id )
			$attach_id = et_attach_id_from_src($image_url);
		
		$upload_dir = wp_upload_dir();
		$image = wp_get_attachment_metadata($attach_id);
		
		if( !wp_attachment_is_image($attach_id) || !$image )
			return null;
		
		if($width > $image['width'])
			$width = $image['width'];
		
		if($height > $image['height'])
			$height = $image['height'];
		
		if($width == -1)
			$width = round( ( $image['width'] / $image['height'] ) * $height );
		
		if($height == -1)
			$height = round( ( $image['height'] / $image['width'] ) * $width );
		
		if( $image['width'] == $width && $image['height'] == $height )
			return wp_get_attachment_url($attach_id);
		
		foreach( $image['sizes'] as $image_size_name => $image_size ) {
			if( $image_size['width'] == $width && $image_size['height'] == $height ) {
				$new_image = wp_get_attachment_image_src($attach_id, $image_size_name);
				$vt_image = array (
					'url' => $new_image[0],
					'width' => $new_image[1],
					'height' => $new_image[2]
				);
				return $vt_image;
			}
		}
		
		$image_editor = wp_get_image_editor($upload_dir['basedir'] . '/' . $image['file']);
		
		if( is_wp_error($image_editor) )
			return null;
		
		$image_editor->set_quality(100);
		$image_editor->resize($width, $height, $crop);
		$thumb = $image_editor->save();
		
		$image_size_name = $thumb['width'] . 'x' . $thumb['height'];
		$image['sizes'][$image_size_name] = Array(
			'file' => $thumb['file'],
			'width' => $thumb['width'],
			'height' => $thumb['height'],
			'mime-type' => $thumb['mime-type']
		);
		
		wp_update_attachment_metadata($attach_id, $image);
		

		
		$new_image = wp_get_attachment_image_src($attach_id, $image_size_name);
		$vt_image = array (
			'url' => $new_image[0],
			'width' => $new_image[1],
			'height' => $new_image[2]
		);
		return $vt_image;
	}	
}


if(!function_exists('et_attach_id_from_src')) {
	function et_attach_id_from_src($image_src) {
		global $wpdb;
		
		$id = $wpdb->get_var(
			$wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid = '%s'", $image_src )
		);
		
		return $id;
	}
}
?>