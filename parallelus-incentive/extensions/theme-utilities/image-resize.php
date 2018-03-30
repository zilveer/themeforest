<?php

/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Example use:
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
 * @param bool $high_res
 * @return array
 */
if ( ! function_exists( 'vt_resize' ) ) :

	function vt_resize( $attach_id = null, $img_url = null, $width = 0, $height = 0, $crop = false, $high_res = false ) {
		global  $blog_id;
		
		$cache = 'cache/';  // Cache folder name (set to '' for none)

		// create high DPI images?
		$hi_dpi = ( $high_res == false ) ? 'inactive' : 'active';	// default or unset: active

		// placeholder images
		$use_placeholders = false; // get_theme_var('options,placeholder_images');
		// $custom_placeholder = get_theme_var('options,custom_placeholder');
		if ( !$img_url && $use_placeholders ) {
			$img_url = ($custom_placeholder) ? $custom_placeholder : THEME_URL .'assets/images/placeholder.jpg';
		}
		
		// this is an attachment, so we have the ID
		if ( $attach_id ) {
		
			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$file_path = get_attached_file( $attach_id );
		
		// this is not an attachment, let's use the image url
		} else if ( $img_url ) {
			
			$file_path = parse_url( $img_url );
			$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
			
			if (!file_exists($file_path)) {
				// simple fix for direct links to images on multi-site installs
				if (isset($blog_id) && $blog_id > 0) {
					// uploaded images to media folders
					$imageParts = explode('/files/', $img_url, 2);
					if (isset($imageParts[1])) {
						$img_url = get_site_url(1) .'/wp-content/blogs.dir/'. $blog_id .'/files/'. $imageParts[1];
						$file_path = parse_url( $img_url );
						$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
					}
					// if not found in media folders check theme folders
					if (!file_exists($file_path)) {
						// files in the theme folder
						$imageParts = explode(THEME_URL, $img_url, 2);
						if (isset($imageParts[1])) {
							$file_path = THEME_DIR . $imageParts[1];
						}
					}
				}
			}
			
			if (file_exists($file_path)) {
				
				$orig_size = getimagesize( $file_path );
			
				$image_src[0] = $img_url;
				$image_src[1] = $orig_size[0];
				$image_src[2] = $orig_size[1];
				
			} else {
				// couldn't find the image so set the values back to what was provided and return
				$vt_image = array (
					'url' => $img_url,
					'width' => $width,
					'height' => $height,
					'hidpi' => $hi_dpi
				);
				
				return $vt_image;
			}
		}
		// if no image size was sent... use the original
		if (!$width) $width =  $image_src[1];
		if (!$height) $height =  $image_src[2];
	
		// checking if the original image is at least as big the requested output size
		// if it is smaller or the same size, stop right here and return
		if ( isset($image_src) && ($image_src[1] > $width || $image_src[2] > $height) ) {
	
			
			$file_info = pathinfo( $file_path );
			$extension = '.'. $file_info['extension'];
		
			// the image path without the extension
			$no_ext_path = $file_info['dirname'].'/'.$cache.$file_info['filename'];
				// $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

			// high DPI? Prepend filename with @2x
			$at2X = ($hi_dpi == 'active') ? '@2x' : '';
		
			$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$at2X.$extension;

			// check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
			if ( file_exists( $cropped_img_path ) ) {
	
				$cropped_img_url = str_replace( basename( $image_src[0] ), $cache.basename( $cropped_img_path ), $image_src[0] );
				// echo 'str_replace( '. basename( $image_src[0] ) .', '. basename( $cropped_img_path ) .', '. $image_src[0] .');';
				
				$vt_image = array (
					'url' => $cropped_img_url,
					'width' => $width,
					'height' => $height,
					'hidpi' => $hi_dpi
				);
				
				return $vt_image;
			}
	
			// $crop = false
			if ( $crop == false ) {
			
				// calculate the size proportionaly
				$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
				$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$at2X.$extension;			
	
				// checking if the file already exists
				if ( file_exists( $resized_img_path ) ) {
				
					$resized_img_url = str_replace( basename( $image_src[0] ), $cache.basename( $resized_img_path ), $image_src[0] );
	
					$vt_image = array (
						'url' => $resized_img_url,
						'width' => $proportional_size[0],
						'height' => $proportional_size[1],
						'hidpi' => $hi_dpi
					);
					
					return $vt_image;
				}
			}
	
			// no cache files - let's finally resize it
			// .............................................................

			// first, make sure the directory is writable.
			if (is_writable($file_info['dirname'])) {
				
				// Yea! It's writable!
				$new_suffix = $width.'x'.$height.$at2X; // this is appended to the saved file name
				
				// double sizes for high DPI
				$w = ($hi_dpi == 'active') ? $width  * 2 :  $width;
				$h = ($hi_dpi == 'active') ? $height * 2 :  $height;

				// make sure the image is big enough
				if ( $hi_dpi == 'active' && ($w > $image_src[1] || $h > $image_src[2]) ) {

					/*  High DPI image sizes are sometimes bigger than the original, although the original is still
					 *  larger than the requested size. For cases like this we want to resize to the maximum possible 
					 *  width or hight in the cropping proportions requested.
					*/ 
					
					// Get the max size of the requested image ratio
					$max_size = wp_constrain_dimensions( $w, $h, $image_src[1], $image_src[2]);
					
					// Updated size
					$w = $max_size[0];
					$h = $max_size[1];

					// Update the suffix width/height values
					$width      = floor($w/2);
					$height     = floor($h/2);
					$new_suffix = $width.'x'.$height.$at2X; // this is appended to the saved file name
				}

				$resized_img_path = $no_ext_path.'-'.$new_suffix.$extension; // What the final path would look like (mostly for testing if it already exists)

				// Double check the image doesn't already exist
				if ( !file_exists($resized_img_path) ) {

					// Check if the cache folder exists
					if( $cache && !file_exists($file_info['dirname'].'/'.$cache)) { 
						mkdir($file_info['dirname'].'/'.$cache, 0755); 
					}

					// let's do some resizing!
					// $new_img_path = image_resize( $file_path, $w, $h, $crop, $new_suffix, $file_info['dirname'].'/'.$cache, 100 );
					$image = wp_get_image_editor( $file_path );
					if ( !is_wp_error( $image ) ) {
						// $image->rotate( 90 );
						$image->resize( $w, $h, $crop );
						$image->save( $resized_img_path );
						$new_size = $image->get_size();
						$width  = ($hi_dpi == 'active') ? floor($new_size['width'] / 2) :  $new_size['width'];
						$height = ($hi_dpi == 'active') ? floor($new_size['height'] / 2) :  $new_size['height'];
						$resized_img_url = str_replace( basename( $image_src[0] ), $cache.basename( $resized_img_path ), $image_src[0] );
					}
					
					// check the new image size 
					// $new_img_size = getimagesize( $new_img_path );

					// $width  = ($hi_dpi == 'active') ? floor($new_img_size[0] / 2) :  $new_img_size[0];
					// $height = ($hi_dpi == 'active') ? floor($new_img_size[1] / 2) :  $new_img_size[1];

					// get the new image URL
					// $resized_img_url = str_replace( basename( $image_src[0] ), $cache.basename( $new_img_path ), $image_src[0] );

				} else {

					// Looks like we already have the image created
					$resized_img_url = str_replace( basename( $image_src[0] ), $cache.basename( $resized_img_path ), $image_src[0] );

				}

			} else {
				// nope, directory isn't writable. return the original file info
				$new_img_size[0] = $width;
				$new_img_size[1] = $height;
				$new_img = $img_url;
			}
	
			// set image data for output
			$vt_image = array (
				'url' => $resized_img_url,
				'width' => $width,
				'height' => $height,
				'hidpi' => $hi_dpi
			);
			
			return $vt_image;
		}
	
		if (isset($image_src )) {
			// default output - without resizing
			$vt_image = array (
				'url' => $image_src[0],
				'width' => $image_src[1],
				'height' => $image_src[2],
				'hidpi' => $hi_dpi
			);
		}
		
		return (isset($vt_image)) ? $vt_image : false;
	}

endif;


?>