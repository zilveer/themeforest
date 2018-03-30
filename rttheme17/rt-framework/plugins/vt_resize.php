<?php

/*
 *
 *	This is the edited version of vtresize for RT-Themes Version 
 *	v2.0
 */ 


/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */ 

	
function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

	$file_path = "";
	$image_src = array();

	//clean if thumbnail used instead of full image
	if ( $img_url ) $img_url = rt_clean_thumbnail_ext($img_url);


	// this is an attachment, so we have the ID
	if ( $attach_id ) {
	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id ); 
	
	
	// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		
		$file_path = parse_url( $img_url );
		$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

		/* alternative find paths
			$file_path = parse_url( $img_url );
			$uploads = wp_upload_dir();  
			$file_path = $uploads['basedir'] . str_replace("/wp-content/uploads","", $file_path['path']);
		*/
		
		$orig_size = file_exists($file_path) ? getimagesize( $file_path ) : false;

		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
		
		
		//let WP find image urls
		if(!$orig_size) { 
			
			$get_image_id_from_url = rt_get_attachment_id_from_src($img_url); 
			if($get_image_id_from_url){  
				$image_src = wp_get_attachment_image_src( $get_image_id_from_url, 'full' );
				$file_path = get_attached_file( $get_image_id_from_url );  
			}  
		}
	}
	 


	$file_info = pathinfo( $file_path );
	$extension = isset($file_info['extension']) ? '.'. $file_info['extension'] : "";

	// the image path without the extension
	$no_ext_path = isset( $file_info['dirname'] ) && isset( $file_info['filename'] ) ? $file_info['dirname'].'/'.$file_info['filename'] : "";

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( isset($image_src[1]) && $image_src[1] > $width || isset($image_src[2]) && $image_src[2] > $height ) {

		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if ( file_exists( $cropped_img_path)  && $crop != false) {

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

		$new_img_path = wp_get_image_editor( $file_path );
		if ( ! is_wp_error( $new_img_path ) ) { 

			$resized = $new_img_path->resize( $width, $height, $crop ); 

			if ( ! is_wp_error( $resized ) ){
				$dest_file = $new_img_path->generate_filename();
				$saved = $new_img_path->save( $dest_file );

				if ( ! is_wp_error( $saved ) ){
					$new_img_path = $saved["path"]; 
				}else{
					$new_img_path = $file_path; 
				}
			}else{
				$new_img_path = $file_path; 
			}
		}else{
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
		'url' => isset($image_src[0]) ? $image_src[0] : "" ,
		'width' => isset($image_src[0]) ? $image_src[1] : "" ,
		'height' => isset($image_src[0]) ? $image_src[2] : "" 
	);
	
	return $vt_image;
}
?>